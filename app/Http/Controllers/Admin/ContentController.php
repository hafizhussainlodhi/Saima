<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsContent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContentController extends Controller
{
    /**
     * Show all editable website text grouped by section.
     */
    public function index(Request $request)
    {
        // Self-heal: make sure every registered key exists in the DB
        foreach (config('cms.content', []) as $key => $item) {
            CmsContent::firstOrCreate(['key' => $key], $item);
        }

        $groups = config('cms.groups');
        $contents = CmsContent::orderBy('id')->get()->groupBy('group');
        $active = $request->query('group', array_key_first($groups));

        if (! isset($groups[$active])) {
            $active = array_key_first($groups);
        }

        $registeredKeys = array_keys(config('cms.content', []));

        return view('admin.content.index', compact('groups', 'contents', 'active', 'registeredKeys'));
    }

    /**
     * Bulk update the values of one section.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'contents'   => ['required', 'array'],
            'contents.*' => ['nullable', 'string', 'max:20000'],
            'group'      => ['nullable', 'string'],
        ]);

        $changed = 0;
        foreach ($data['contents'] as $key => $value) {
            $record = CmsContent::where('key', $key)->first();
            if ($record && $record->value !== $value) {
                $record->value = $value;
                $record->save();
                $changed++;
            }
        }

        return redirect()
            ->route('admin.content.index', ['group' => $data['group'] ?? null])
            ->with('success', $changed ? "{$changed} content block(s) updated. Changes are live on the website." : 'No changes detected.');
    }

    /**
     * Create a new custom content block.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'key'   => ['required', 'string', 'max:100', 'regex:/^[a-z0-9_]+$/', 'unique:cms_contents,key'],
            'label' => ['required', 'string', 'max:255'],
            'group' => ['required', Rule::in(array_keys(config('cms.groups')))],
            'type'  => ['required', Rule::in(['text', 'textarea', 'list'])],
            'value' => ['nullable', 'string', 'max:20000'],
        ], [
            'key.regex' => 'Key may only contain lowercase letters, numbers and underscores.',
        ]);

        CmsContent::create($data);

        return redirect()
            ->route('admin.content.index', ['group' => $data['group']])
            ->with('success', "Content block \"{$data['key']}\" created. Use {{ cms('{$data['key']}') }} in any Blade view.");
    }

    /**
     * Delete a custom content block (registered core blocks are protected).
     */
    public function destroy(CmsContent $content)
    {
        if (array_key_exists($content->key, config('cms.content', []))) {
            return back()->with('error', 'Core website content blocks cannot be deleted.');
        }

        $group = $content->group;
        $content->delete();

        return redirect()
            ->route('admin.content.index', ['group' => $group])
            ->with('success', 'Custom content block deleted.');
    }

    /**
     * Reset a core block to its original default text.
     */
    public function reset(CmsContent $content)
    {
        $default = config("cms.content.{$content->key}.value");

        if ($default === null) {
            return back()->with('error', 'This block has no default value.');
        }

        $content->update(['value' => $default]);

        return redirect()
            ->route('admin.content.index', ['group' => $content->group])
            ->with('success', "\"{$content->label}\" reset to its default text.");
    }
}
