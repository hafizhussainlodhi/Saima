<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TocItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TocController extends Controller
{
    public function index(Request $request)
    {
        $items = TocItem::whereNull('parent_id')
            ->with(['children' => fn ($q) => $q->ordered()])
            ->ordered()
            ->get();

        $editing = $request->filled('edit') ? TocItem::find($request->query('edit')) : null;
        $parents = TocItem::whereNull('parent_id')->ordered()->get(['id', 'title']);

        return view('admin.toc.index', compact('items', 'editing', 'parents'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['order'] = (int) TocItem::where('parent_id', $data['parent_id'])->max('order') + 1;

        TocItem::create($data);

        return redirect()->route('admin.toc.index')->with('success', 'Table of Contents item added.');
    }

    public function update(Request $request, TocItem $toc)
    {
        $data = $this->validated($request, $toc);

        if (($data['parent_id'] ?? null) == $toc->id) {
            $data['parent_id'] = null;
        }

        $toc->update($data);

        return redirect()->route('admin.toc.index')->with('success', 'Table of Contents item updated.');
    }

    public function destroy(TocItem $toc)
    {
        $toc->delete();

        return redirect()->route('admin.toc.index')->with('success', 'Table of Contents item deleted.');
    }

    public function toggle(TocItem $toc)
    {
        $toc->update(['is_active' => ! $toc->is_active]);

        return back()->with('success', $toc->is_active ? 'Item is now visible on the website.' : 'Item hidden from the website.');
    }

    /**
     * Move an item up or down among its siblings.
     */
    public function move(Request $request, TocItem $toc)
    {
        $direction = $request->input('direction') === 'up' ? 'up' : 'down';

        $siblings = TocItem::where('parent_id', $toc->parent_id)->ordered()->get()->values();
        $index = $siblings->search(fn ($item) => $item->id === $toc->id);
        $swapIndex = $direction === 'up' ? $index - 1 : $index + 1;

        if ($index !== false && isset($siblings[$swapIndex])) {
            $list = $siblings->all();
            [$list[$index], $list[$swapIndex]] = [$list[$swapIndex], $list[$index]];
            foreach ($list as $position => $item) {
                if ($item->order !== $position + 1) {
                    $item->update(['order' => $position + 1]);
                }
            }
        }

        return back();
    }

    /**
     * AJAX drag-and-drop reorder of TOC items.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'integer', 'exists:toc_items,id'],
            'items.*.order' => ['required', 'integer'],
        ]);

        foreach ($request->input('items') as $row) {
            TocItem::where('id', $row['id'])->update([
                'order' => (int) $row['order'],
            ]);
        }

        TocItem::flushCache();

        return response()->json([
            'success' => true,
            'message' => 'Table of Contents reordered successfully.',
        ]);
    }

    private function validated(Request $request, ?TocItem $toc = null): array
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'target_id'    => ['nullable', 'string', 'max:255'],
            'parent_id'    => ['nullable', 'integer', 'exists:toc_items,id'],
            'is_active'    => ['nullable', 'boolean'],
            'content'      => ['nullable', 'string'],
            'image'        => ['nullable', 'string', 'max:500'],
            'image_file'   => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $slug = Str::slug($data['target_id'] ?: $data['title']);
        $baseSlug = $slug;
        $counter = 1;
        while (TocItem::where('target_id', $slug)->when($toc, fn ($q) => $q->where('id', '!=', $toc->id))->exists()) {
            $counter++;
            $slug = $baseSlug . '-' . $counter;
        }

        $data['target_id'] = $slug;
        $data['parent_id'] = $data['parent_id'] ?? null;
        $data['level'] = $data['parent_id'] ? 3 : 2;
        $data['is_active'] = $request->boolean('is_active');
        $data['content'] = $request->input('content');

        // Handle Image Upload / URL / Removal
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'toc_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/toc');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image'] = '/images/toc/' . $filename;
        } elseif ($request->boolean('remove_image')) {
            $data['image'] = null;
        } elseif ($request->filled('image')) {
            $data['image'] = $request->input('image');
        } elseif ($toc) {
            $data['image'] = $toc->image;
        } else {
            $data['image'] = null;
        }

        unset($data['image_file'], $data['remove_image']);

        return $data;
    }
}
