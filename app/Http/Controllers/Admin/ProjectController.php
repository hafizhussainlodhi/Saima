<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Page;
use App\Services\PageBlueprintService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of all Property Cards.
     */
    public function index(Request $request)
    {
        $projects = Project::with(['page.sections'])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $pages = Page::orderBy('title', 'asc')->get(['id', 'title', 'slug']);
        $totalProjects = $projects->count();
        $activeProjects = $projects->where('is_active', true)->count();

        $communities = \App\Models\Community::with('city')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.projects.index', compact('projects', 'pages', 'totalProjects', 'activeProjects', 'communities'));
    }

    /**
     * Store a newly created Property Card and its linked Detail Page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255'],
            'page_id'       => ['nullable', 'exists:pages,id'],
            'headline'      => ['nullable', 'string', 'max:500'],
            'location'      => ['nullable', 'string', 'max:255'],
            'price'         => ['nullable', 'string', 'max:255'],
            'delivery_date' => ['nullable', 'string', 'max:255'],
            'developer'     => ['nullable', 'string', 'max:255'],
            'payment_plan'  => ['nullable', 'string', 'max:255'],
            'image'         => ['nullable', 'string', 'max:500'],
            'image_file'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:5120'],
            'badges'        => ['nullable'],
            'is_active'     => ['nullable', 'boolean'],
            'status'        => ['nullable', 'string', 'in:publish,draft,sold_out'],
        ]);

        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }
        $isActive = ($status !== 'draft');

        $title = trim($validated['title']);
        $rawSlug = trim($request->input('slug') ?: $title);
        $slug = Str::slug($rawSlug);

        // Handle Property Card Image first so Hero auto-syncs with it
        $cardImage = $validated['image'] ?? '/images/communities/wadeem-gardens.png';
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $cardImage = '/images/projects/' . $filename;
        }

        // Hero image auto-syncs from card image unless a distinct hero file was uploaded
        $heroBgImage = $cardImage;
        if ($request->hasFile('section_files.hero.bg_image')) {
            $file = $request->file('section_files.hero.bg_image');
            $filename = time() . '_hero_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $heroBgImage = '/images/projects/' . $filename;
        } elseif ($request->filled('sections.hero.bg_image') && $request->input('sections.hero.bg_image') !== '/images/hero/slide-1.jpg') {
            $heroBgImage = $request->input('sections.hero.bg_image');
        }

        // 1. Determine or Create Linked Detail Page
        $pageId = $request->input('page_id');
        $page = null;
        if (!empty($pageId)) {
            $page = Page::find($pageId);
        }

        // If no existing page selected, create a new Detail Page
        if (!$page) {
            $uniqueSlug = $slug;
            $count = 1;
            while (Page::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $slug . '-' . $count;
                $count++;
            }

            $page = Page::create([
                'title'            => $title,
                'slug'             => $uniqueSlug,
                'in_navbar'        => $request->boolean('in_navbar', true),
                'navbar_order'     => (int) ($request->input('navbar_order') ?: (((int) Page::max('navbar_order')) + 1)),
                'status'           => $status,
                'is_published'     => $request->boolean('is_published', $isActive),
                'meta_title'       => $request->input('meta_title') ?: ($title . ' | Luxury Properties'),
                'meta_description' => $request->input('meta_description') ?: ("Explore {$title}. Discover luxury residences, pricing, master plan, and world-class amenities."),
                'meta_keywords'    => $request->input('meta_keywords') ?: ("{$title}, luxury villas, properties"),
                'og_image'         => $heroBgImage,
            ]);

            // Attach standard sections
            $sectionKeys = PageBlueprintService::getCustomPageSectionKeys();
            PageBlueprintService::attachSectionsToPage($page, $sectionKeys);

            // Populate / override sections from submitted form
            $submittedSections = $request->input('sections', []);

            // 1. Hero
            $heroSec = $page->sections()->where('section_key', 'hero')->first();
            if ($heroSec) {
                $hContent = $heroSec->content ?? [];
                $hContent['bg_image'] = $heroBgImage;
                $hContent['bg_image_alt'] = $request->input('sections.hero.bg_image_alt') ?: ($title . ' at ' . ($validated['location'] ?? ''));
                $hContent['badge'] = $request->input('sections.hero.badge') ?: 'Freehold for All Nationalities';
                $hContent['title'] = $request->input('sections.hero.title') ?: $title;
                
                // Headline automatically updates the inner page hero section subtitle
                $headline = trim($request->input('headline') ?? '');
                if (!empty($headline)) {
                    $hContent['subtitle'] = $headline;
                } elseif ($request->filled('sections.hero.subtitle')) {
                    $hContent['subtitle'] = $request->input('sections.hero.subtitle');
                } else {
                    $hContent['subtitle'] = "Exclusive Lifestyle Destination";
                }

                $heroSec->update(['content' => $hContent]);
            }

            // 2. Highlights
            $hlSec = $page->sections()->where('section_key', 'highlights')->first();
            if ($hlSec) {
                $hlContent = $hlSec->content ?? [];
                if (!empty($submittedSections['highlights']['items']) && is_array($submittedSections['highlights']['items'])) {
                    $hlContent['items'] = array_values(array_filter($submittedSections['highlights']['items'], fn($item) => !empty(trim($item['label'] ?? ''))));
                }
                $hlSec->update(['content' => $hlContent]);
            }

            // 3. About
            $aboutSec = $page->sections()->where('section_key', 'about')->first();
            if ($aboutSec) {
                $aContent = $aboutSec->content ?? [];
                if (!empty($submittedSections['about']['title'])) $aContent['title'] = $submittedSections['about']['title'];
                if (!empty($submittedSections['about']['description'])) $aContent['description'] = $submittedSections['about']['description'];
                if (!empty($submittedSections['about']['video_url'])) $aContent['video_url'] = $submittedSections['about']['video_url'];
                if (!empty($submittedSections['about']['video_poster'])) $aContent['video_poster'] = $submittedSections['about']['video_poster'];
                if ($request->hasFile('section_files.about.video_poster')) {
                    $file = $request->file('section_files.about.video_poster');
                    $safeName = time() . '_poster_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/projects'), $safeName);
                    $aContent['video_poster'] = '/images/projects/' . $safeName;
                }
                $aboutSec->update(['content' => $aContent]);
            }

            // 4. Content
            $contentSec = $page->sections()->where('section_key', 'content')->first();
            if ($contentSec) {
                $cContent = $contentSec->content ?? [];
                if (!empty($submittedSections['content']['html'])) {
                    $cContent['html'] = $submittedSections['content']['html'];
                    $cContent['body'] = $submittedSections['content']['html'];
                    $page->update(['body' => $submittedSections['content']['html']]);
                }
                $contentSec->update(['content' => $cContent]);
            }

            // 5. Amenities
            $amenitiesSec = $page->sections()->where('section_key', 'amenities')->first();
            if ($amenitiesSec) {
                $amContent = $amenitiesSec->content ?? [];
                if (!empty($submittedSections['amenities']['title'])) $amContent['title'] = $submittedSections['amenities']['title'];
                if (!empty($submittedSections['amenities']['subtitle'])) $amContent['subtitle'] = $submittedSections['amenities']['subtitle'];
                if (!empty($submittedSections['amenities']['items']) && is_array($submittedSections['amenities']['items'])) {
                    $amContent['items'] = array_values(array_filter($submittedSections['amenities']['items'], fn($item) => !empty(trim($item['name'] ?? ''))));
                }
                $amenitiesSec->update(['content' => $amContent]);
            }

            // 6. Gallery
            $galSec = $page->sections()->where('section_key', 'gallery')->first();
            if ($galSec) {
                $gContent = $galSec->content ?? [];
                if (!empty($submittedSections['gallery']['title'])) $gContent['title'] = $submittedSections['gallery']['title'];
                if (!empty($submittedSections['gallery']['images']) && is_array($submittedSections['gallery']['images'])) {
                    $gContent['images'] = array_values(array_filter($submittedSections['gallery']['images'], fn($item) => !empty(trim($item['src'] ?? ''))));
                }
                $galSec->update(['content' => $gContent]);
            }

            // 7. Payment Plan
            $ppSec = $page->sections()->where('section_key', 'payment_plan')->first();
            if ($ppSec) {
                $ppContent = $ppSec->content ?? [];
                if (!empty($submittedSections['payment_plan']['title'])) $ppContent['title'] = $submittedSections['payment_plan']['title'];
                if (!empty($submittedSections['payment_plan']['description'])) $ppContent['description'] = $submittedSections['payment_plan']['description'];
                if (!empty($submittedSections['payment_plan']['down_payment'])) $ppContent['down_payment'] = $submittedSections['payment_plan']['down_payment'];
                if (!empty($submittedSections['payment_plan']['during_construction'])) $ppContent['during_construction'] = $submittedSections['payment_plan']['during_construction'];
                if (!empty($submittedSections['payment_plan']['on_handover'])) $ppContent['on_handover'] = $submittedSections['payment_plan']['on_handover'];
                if (!empty($submittedSections['payment_plan']['items']) && is_array($submittedSections['payment_plan']['items'])) {
                    $ppContent['items'] = array_values(array_filter($submittedSections['payment_plan']['items'], fn($item) => !empty(trim($item['milestone'] ?? ''))));
                }
                $ppSec->update(['content' => $ppContent]);
            }

            // 8. FAQ
            $faqSec = $page->sections()->where('section_key', 'faq')->first();
            if ($faqSec) {
                $fContent = $faqSec->content ?? [];
                if (!empty($submittedSections['faq']['title'])) $fContent['title'] = $submittedSections['faq']['title'];
                if (!empty($submittedSections['faq']['description'])) $fContent['description'] = $submittedSections['faq']['description'];
                if (!empty($submittedSections['faq']['items']) && is_array($submittedSections['faq']['items'])) {
                    $fContent['items'] = array_values(array_filter($submittedSections['faq']['items'], fn($item) => !empty(trim($item['question'] ?? ''))));
                }
                $faqSec->update(['content' => $fContent]);
            }

            // 9. Master Plan
            $mpSec = $page->sections()->where('section_key', 'master_plan')->first();
            if ($mpSec) {
                $mpContent = $mpSec->content ?? [];
                if (!empty($submittedSections['master_plan']['title'])) $mpContent['title'] = $submittedSections['master_plan']['title'];
                if (!empty($submittedSections['master_plan']['description'])) $mpContent['description'] = $submittedSections['master_plan']['description'];
                if (!empty($submittedSections['master_plan']['image'])) $mpContent['image'] = $submittedSections['master_plan']['image'];
                if ($request->hasFile('section_files.master_plan.image')) {
                    $file = $request->file('section_files.master_plan.image');
                    $safeName = time() . '_master_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/projects'), $safeName);
                    $mpContent['image'] = '/images/projects/' . $safeName;
                }
                $mpSec->update(['content' => $mpContent]);
            }

            // 10. Contact
            $cntSec = $page->sections()->where('section_key', 'contact')->first();
            if ($cntSec) {
                $cntContent = $cntSec->content ?? [];
                if (!empty($submittedSections['contact']['title'])) $cntContent['title'] = $submittedSections['contact']['title'];
                if (!empty($submittedSections['contact']['subtitle'])) $cntContent['subtitle'] = $submittedSections['contact']['subtitle'];
                if (!empty($submittedSections['contact']['button_text'])) $cntContent['button_text'] = $submittedSections['contact']['button_text'];
                if (!empty($submittedSections['contact']['phone'])) $cntContent['phone'] = $submittedSections['contact']['phone'];
                if (!empty($submittedSections['contact']['email'])) $cntContent['email'] = $submittedSections['contact']['email'];
                $cntSec->update(['content' => $cntContent]);
            }

            // 11. Location
            $locSec = $page->sections()->where('section_key', 'location')->first();
            if ($locSec) {
                $locContent = $locSec->content ?? [];
                if (!empty($submittedSections['location']['title'])) $locContent['title'] = $submittedSections['location']['title'];
                if (!empty($submittedSections['location']['description'])) $locContent['description'] = $submittedSections['location']['description'];
                if (!empty($submittedSections['location']['items']) && is_array($submittedSections['location']['items'])) {
                    $locContent['items'] = array_values(array_filter($submittedSections['location']['items'], fn($item) => !empty(trim($item['place'] ?? ''))));
                }
                $locSec->update(['content' => $locContent]);
            }
        }

        // 2. Extract metrics from highlights for project card if not explicitly set
        $submittedHighlights = $submittedSections['highlights']['items'] ?? [];
        $extractedPrice = $validated['price'] ?? null;
        $extractedDelivery = $validated['delivery_date'] ?? null;
        $extractedDeveloper = $validated['developer'] ?? null;
        $extractedPaymentPlan = $validated['payment_plan'] ?? null;

        foreach ($submittedHighlights as $item) {
            $lbl = strtolower(trim($item['label'] ?? ''));
            $val = trim($item['value'] ?? '');
            if (!$val) continue;

            if (!$extractedPrice && (str_contains($lbl, 'price') || str_contains($lbl, 'cost'))) {
                $extractedPrice = $val;
            }
            if (!$extractedDelivery && (str_contains($lbl, 'date') || str_contains($lbl, 'handover') || str_contains($lbl, 'completion'))) {
                $extractedDelivery = $val;
            }
            if (!$extractedDeveloper && str_contains($lbl, 'developer')) {
                $extractedDeveloper = $val;
            }
            if (!$extractedPaymentPlan && str_contains($lbl, 'payment')) {
                $extractedPaymentPlan = $val;
            }
        }

        // 2. Badges for project card
        $badgesInput = $request->input('badges');
        if (is_string($badgesInput)) {
            $badgesInput = json_decode($badgesInput, true) ?: [];
        }
        $badges = is_array($badgesInput) ? array_values(array_filter(array_map('trim', $badgesInput))) : [];

        // 3. Create Project Card (placed at the top of the list)
        Project::query()->increment('order');
        $project = Project::create([
            'title'         => $title,
            'slug'          => $page->slug ?? $slug,
            'page_id'       => $page->id,
            'location'      => $validated['location'] ?? null,
            'price'         => null,
            'delivery_date' => null,
            'badges'        => $badges,
            'developer'     => $extractedDeveloper ?? 'Modon Properties',
            'payment_plan'  => $extractedPaymentPlan ?? 'Flexible Payment Plan',
            'image'         => $cardImage,
            'status'        => $status,
            'is_active'     => $isActive,
            'order'         => 1,
        ]);

        // Automatically put new project at TOP of Home page featured projects (Selected cards)
        try {
            $homePage = Page::where('slug', '/')->first() ?? Page::find(1);
            if ($homePage) {
                $sec = $homePage->sections()->whereIn('section_key', ['communities', 'projects'])->first();
                if ($sec) {
                    $c = $sec->content ?? [];
                    $selected = (array) ($c['selected_ids'] ?? ($c['project_ids'] ?? []));
                    array_unshift($selected, (int)$project->id);
                    $selected = array_values(array_unique(array_map('intval', $selected)));
                    $c['selected_ids'] = $selected;
                    $c['project_ids'] = $selected;
                    
                    $unselected = (array) ($c['unselected_ids'] ?? []);
                    $c['unselected_ids'] = array_values(array_diff(array_map('intval', $unselected), [(int)$project->id]));
                    $sec->update(['content' => $c]);
                }
            }
        } catch (\Throwable $e) {}

        return redirect()->route('admin.projects.index')->with('success', "Property Card '{$title}' and Detail Page ('/{$page->slug}') created successfully!");
    }

    /**
     * Show the full tabbed editor for the project (matching Screenshot 1).
     */
    public function edit(Project $project)
    {
        if (!$project->page_id) {
            $page = Page::where('slug', $project->slug)->first();
            if (!$page) {
                $page = Page::create([
                    'title'        => $project->title,
                    'slug'         => $project->slug ?: Str::slug($project->title),
                    'status'       => $project->status ?? 'publish',
                    'is_published' => $project->is_active ?? true,
                    'in_navbar'    => false,
                    'navbar_order' => 0,
                ]);
            }
            $project->update(['page_id' => $page->id]);
        }

        return redirect()->route('admin.pages.edit', ['page' => $project->page_id, 'from' => 'project']);
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
            'headline'      => ['nullable', 'string', 'max:500'],
            'location'      => ['nullable', 'string', 'max:255'],
            'price'         => ['nullable', 'string', 'max:255'],
            'delivery_date' => ['nullable', 'string', 'max:255'],
            'badges'        => ['nullable'],
            'developer'     => ['nullable', 'string', 'max:255'],
            'payment_plan'  => ['nullable', 'string', 'max:255'],
            'image'         => ['nullable', 'string', 'max:500'],
            'image_file'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:5120'],
            'is_active'     => ['nullable', 'boolean'],
            'status'        => ['nullable', 'string', 'in:publish,draft,sold_out'],
        ]);

        $imageUpdated = false;
        $newImage = null;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/projects'), $filename);
            $validated['image'] = '/images/projects/' . $filename;
            $newImage = $validated['image'];
            $imageUpdated = true;
        } elseif ($request->filled('image') && $request->input('image') !== $project->image) {
            $newImage = $validated['image'];
            $imageUpdated = true;
        }

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->has('status')) {
            $status = $request->input('status', 'publish');
            if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
                $status = 'publish';
            }
            $validated['status'] = $status;
            $validated['is_active'] = ($status !== 'draft');
        } else {
            $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : $project->is_active;
        }

        // Process badges and clear legacy price/delivery text from cards
        if ($request->has('badges')) {
            $bInput = $request->input('badges');
            if (is_string($bInput)) {
                $bInput = json_decode($bInput, true) ?: [];
            }
            $validated['badges'] = is_array($bInput) ? array_values(array_filter(array_map('trim', $bInput))) : [];
        }
        $validated['price'] = null;
        $validated['delivery_date'] = null;

        unset($validated['image_file']);
        $headline = $request->input('headline');
        unset($validated['headline']);

        $project->update($validated);

        // Sync to linked detail page & hero section automatically
        if ($project->page) {
            $page = $project->page;
            $heroSec = $page->sections()->where('section_key', 'hero')->first();
            if ($heroSec) {
                $hContent = $heroSec->content ?? [];
                $changed = false;

                // 1. Headline sync to hero section subtitle
                if (!empty($headline)) {
                    $hContent['subtitle'] = $headline;
                    $changed = true;
                }

                // 2. Image sync to hero section background
                if ($imageUpdated && $newImage) {
                    $hContent['bg_image'] = $newImage;
                    $page->update(['og_image' => $newImage]);
                    $changed = true;
                }

                if ($changed) {
                    $heroSec->update(['content' => $hContent]);
                }
            } elseif ($imageUpdated && $newImage) {
                $page->update(['og_image' => $newImage]);
            }

            if (isset($validated['status'])) {
                $page->update([
                    'status'       => $validated['status'],
                    'is_published' => ($validated['status'] !== 'draft'),
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', "Property card '{$project->title}' updated successfully.");
    }

    /**
     * Remove the specified Property Card and its linked Detail Page.
     */
    public function destroy(Project $project)
    {
        $title = $project->title;

        // Delete the linked Page and its sections so it doesn't linger in Pages list
        $page = $project->page ?: ($project->slug ? Page::where('slug', $project->slug)->first() : null);
        if ($page) {
            $page->sections()->delete();
            $page->delete();
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', "Property card '{$title}' and its detail page removed successfully.");
    }

    /**
     * Update status (publish, draft, sold_out) of a Property Card and linked Page.
     */
    public function updateStatus(Request $request, Project $project)
    {
        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }

        $project->status = $status;
        $project->is_active = ($status !== 'draft');
        $project->save();

        if ($project->page) {
            $project->page->status = $status;
            $project->page->is_published = ($status !== 'draft');
            $project->page->save();
        }

        $label = match($status) {
            'sold_out' => 'Sold out',
            'draft'    => 'Draft',
            default    => 'Publish',
        };

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'status'  => $status,
                'label'   => $label,
                'message' => "Status updated to {$label}"
            ]);
        }

        return redirect()->route('admin.projects.index')->with('success', "Property '{$project->title}' status updated to {$label}.");
    }

    /**
     * Toggle active/published status of a Property Card.
     */
    public function toggle(Project $project)
    {
        $project->is_active = !$project->is_active;
        $project->status = $project->is_active ? 'publish' : 'draft';
        $project->save();

        if ($project->page) {
            $project->page->status = $project->status;
            $project->page->is_published = $project->is_active;
            $project->page->save();
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success'   => true,
                'is_active' => $project->is_active,
                'status'    => $project->status,
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
