<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of all Property Cards.
     */
    public function index(Request $request)
    {
        $projects = Project::with('page')
            ->orderBy('order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $pages = Page::orderBy('title', 'asc')->get(['id', 'title', 'slug']);
        $totalProjects = $projects->count();
        $activeProjects = $projects->where('is_active', true)->count();

        return view('admin.projects.index', compact('projects', 'pages', 'totalProjects', 'activeProjects'));
    }

    /**
     * Store a newly created Property Card.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255'],
            'page_id'       => ['nullable', 'exists:pages,id'],
            'location'      => ['nullable', 'string', 'max:255'],
            'price'         => ['nullable', 'string', 'max:255'],
            'delivery_date' => ['nullable', 'string', 'max:255'],
            'developer'     => ['nullable', 'string', 'max:255'],
            'payment_plan'  => ['nullable', 'string', 'max:255'],
            'image'         => ['nullable', 'string', 'max:500'],
            'image_file'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:5120'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $validated['image'] = '/images/projects/' . $filename;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Auto-assign max order + 1
        $maxOrder = Project::max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;
        $validated['is_active'] = $request->boolean('is_active', true);

        // Remove temporary upload field
        unset($validated['image_file']);

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', "Property card '{$validated['title']}' created successfully.");
    }

    /**
     * Update the specified Property Card.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255'],
            'page_id'       => ['nullable', 'exists:pages,id'],
            'location'      => ['nullable', 'string', 'max:255'],
            'price'         => ['nullable', 'string', 'max:255'],
            'delivery_date' => ['nullable', 'string', 'max:255'],
            'developer'     => ['nullable', 'string', 'max:255'],
            'payment_plan'  => ['nullable', 'string', 'max:255'],
            'image'         => ['nullable', 'string', 'max:500'],
            'image_file'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:5120'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $validated['image'] = '/images/projects/' . $filename;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : $project->is_active;

        unset($validated['image_file']);

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', "Property card '{$project->title}' updated successfully.");
    }

    /**
     * Remove the specified Property Card.
     */
    public function destroy(Project $project)
    {
        $title = $project->title;
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', "Property card '{$title}' removed successfully.");
    }

    /**
     * Toggle active/published status of a Property Card.
     */
    public function toggle(Project $project)
    {
        $project->is_active = !$project->is_active;
        $project->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success'   => true,
                'is_active' => $project->is_active,
                'message'   => "Status updated to " . ($project->is_active ? 'Active' : 'Inactive')
            ]);
        }

        return redirect()->route('admin.projects.index')->with('success', "Property card '{$project->title}' status updated.");
    }

    /**
     * Reorder property cards via drag/drop or order array.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => ['required', 'array'],
        ]);

        foreach ($request->input('order') as $index => $id) {
            Project::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
