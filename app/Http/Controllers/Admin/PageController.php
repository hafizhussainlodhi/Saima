<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\PageBlueprintService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a centralized listing of all pages (Home, About Us, Contact Us, and all Project Detail Pages).
     */
    public function index(Request $request)
    {
        $projectSlugs = Page::projectSlugs();
        $projectPageIds = \App\Models\Project::whereNotNull('page_id')->pluck('page_id')->all();
        $cityPageIds = \App\Models\City::whereNotNull('page_id')->pluck('page_id')->all();
        $citySlugs = \App\Models\City::pluck('slug')->all();
        $commPageIds = \App\Models\Community::whereNotNull('page_id')->pluck('page_id')->all();
        $commSlugs = \App\Models\Community::pluck('slug')->all();

        $excludedIds = array_merge($projectPageIds, $cityPageIds, $commPageIds);
        $excludedSlugs = array_merge($projectSlugs, $citySlugs, $commSlugs);

        $pages = Page::withCount('sections')
            ->orderBy('id', 'asc')
            ->get();

        $totalPagesCount = $pages->count();
        $generalCount = $pages->reject(fn($p) => in_array($p->slug, $excludedSlugs, true) || in_array($p->id, $excludedIds, true))->count();
        $projectsCount = $totalPagesCount - $generalCount;
        $globalSections = PageBlueprintService::getGlobalSections();
        $projectPages = Page::whereIn('slug', $projectSlugs)->orderBy('title', 'asc')->get(['id', 'title', 'slug']);
        $allProjects = \App\Models\Project::with('page')->orderBy('order', 'asc')->get();

        return view('admin.pages.index', compact('pages', 'globalSections', 'generalCount', 'projectsCount', 'totalPagesCount', 'projectPages', 'projectSlugs', 'projectPageIds', 'cityPageIds', 'citySlugs', 'commPageIds', 'commSlugs', 'allProjects'));
    }

    /**
     * Redirect to the dedicated Property Cards manager.
     */
    public function projects(Request $request)
    {
        return redirect()->route('admin.projects.index');
    }

    /**
     * Store a newly created page with either Global Reusable Sections or Full Custom Page sections.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['required', 'string', 'max:255', 'unique:pages,slug'],
            'page_type'        => ['nullable', 'string', 'in:global,custom'],
            'global_sections'  => ['nullable', 'array'],
            'in_navbar'        => ['nullable', 'boolean'],
            'is_published'     => ['nullable', 'boolean'],
            'status'           => ['nullable', 'string', 'in:publish,draft,sold_out'],
            'has_hero'         => ['nullable'],
            'hero_title'       => ['nullable', 'string', 'max:500'],
            'hero_subtitle'    => ['nullable', 'string', 'max:1000'],
            'hero_badge'       => ['nullable', 'string', 'max:255'],
            'hero_bg_image'       => ['nullable', 'string', 'max:500'],
            'hero_content'        => ['nullable', 'string'],
            'has_highlights'      => ['nullable'],
            'highlights_title'    => ['nullable', 'string', 'max:255'],
            'highlights_items'    => ['nullable', 'array'],
            'has_about'           => ['nullable'],
            'about_title'         => ['nullable', 'string', 'max:500'],
            'about_description'   => ['nullable', 'string'],
            'about_video_poster'  => ['nullable', 'string', 'max:500'],
            'about_video_src'     => ['nullable', 'string', 'max:1000'],
            'has_content'         => ['nullable'],
            'article_title'       => ['nullable', 'string', 'max:500'],
            'article_intro'       => ['nullable', 'string'],
            'article_summernote'  => ['nullable', 'string'],
            'article_appt_title'  => ['nullable', 'string', 'max:255'],
            'has_communities'      => ['nullable'],
            'communities_heading'  => ['nullable', 'string', 'max:255'],
            'communities_subtitle' => ['nullable', 'string', 'max:500'],
            'communities_items'    => ['nullable', 'array'],
            'has_faq'              => ['nullable'],
            'faq_heading'          => ['nullable', 'string', 'max:255'],
            'faq_subtitle'         => ['nullable', 'string', 'max:1000'],
            'faq_items'            => ['nullable', 'array'],
            'section_order'       => ['nullable'],
        ]);

        $rawSlug = trim($validated['slug']);
        $cleanSlug = ltrim($rawSlug, '/');
        if (empty($cleanSlug)) {
            $cleanSlug = Str::slug($validated['title']);
        } else {
            $cleanSlug = Str::slug($cleanSlug);
        }

        // Process Hero Background Image (File upload or URL)
        $heroBgImage = '/images/hero/slide-1.jpg';
        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $uploadDir = public_path('images/uploads');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $safeName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $safeName);
            $heroBgImage = '/images/uploads/' . $safeName;
        } elseif ($request->filled('hero_bg_image')) {
            $heroBgImage = $request->input('hero_bg_image');
        }

        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }
        $isPublished = ($status !== 'draft');

        // Create page
        $page = Page::create([
            'title'            => $validated['title'],
            'slug'             => $cleanSlug,
            'in_navbar'        => $request->boolean('in_navbar', false),
            'navbar_order'     => ((int) Page::max('navbar_order')) + 1,
            'status'           => $status,
            'is_published'     => $request->boolean('is_published', $isPublished),
            'meta_title'       => $validated['title'] . ' | Hudayriyat Island Abu Dhabi',
            'meta_description' => 'Explore ' . $validated['title'] . ' on Hudayriyat Island, Abu Dhabi. Discover freehold residences, pricing, master plan, and world-class amenities.',
            'meta_keywords'    => $validated['title'] . ', Hudayriyat Island, Abu Dhabi villas, Modon Properties',
            'og_image'         => $heroBgImage,
        ]);

        $pageType = $request->input('page_type', 'custom');
        if ($pageType === 'global') {
            $selectedKeys = $request->input('global_sections', []);
            if (empty($selectedKeys)) {
                $selectedKeys = ['hero', 'highlights', 'about', 'contact'];
            }
            if (!in_array('hero', $selectedKeys)) {
                array_unshift($selectedKeys, 'hero');
            }
            PageBlueprintService::attachSectionsToPage($page, $selectedKeys);
        } else {
            // Check if section_order was submitted (JSON string or array)
            $rawOrder = $request->input('section_order');
            $orderedKeys = [];
            if (!empty($rawOrder)) {
                if (is_string($rawOrder)) {
                    $decoded = json_decode($rawOrder, true);
                    if (is_array($decoded)) {
                        $orderedKeys = array_values(array_filter($decoded));
                    }
                } elseif (is_array($rawOrder)) {
                    $orderedKeys = array_values(array_filter($rawOrder));
                }
            }

            // Fallback if section_order was not passed
            if (empty($orderedKeys)) {
                if ($request->input('has_hero') == '1' || $request->filled('hero_title')) {
                    $orderedKeys[] = 'hero';
                }
                if ($request->input('has_highlights') == '1' || $request->filled('highlights_items')) {
                    $orderedKeys[] = 'highlights';
                }
                if ($request->input('has_about') == '1' || $request->filled('about_title')) {
                    $orderedKeys[] = 'about';
                }
                if ($request->input('has_content') == '1' || $request->filled('article_intro') || $request->filled('article_summernote')) {
                    $orderedKeys[] = 'content';
                }
                if ($request->input('has_communities') == '1' || $request->has('communities_items')) {
                    $orderedKeys[] = 'communities';
                }
                if ($request->input('has_faq') == '1' || $request->has('faq_items')) {
                    $orderedKeys[] = 'faq';
                }
                if ($request->input('has_contact') == '1' || $request->filled('contact_heading')) {
                    $orderedKeys[] = 'contact';
                }
            }

            // If user added specific sections (hero, highlights, about, content, communities), attach only those
            if (!empty($orderedKeys)) {
                if ($request->filled('hero_content') && !in_array('content', $orderedKeys)) {
                    $orderedKeys[] = 'content';
                }

                $globalSections = PageBlueprintService::getGlobalSections();
                $orderNum = 1;
                foreach ($orderedKeys as $key) {
                    $name = $globalSections[$key]['name'] ?? ucwords(str_replace('_', ' ', $key));
                    $defaultContent = PageBlueprintService::getDefaultSectionContent($key, $page->title);

                    PageSection::create([
                        'page_id'      => $page->id,
                        'section_key'  => $key,
                        'section_name' => $name,
                        'order'        => $orderNum++,
                        'is_active'    => true,
                        'content'      => $defaultContent,
                    ]);
                }
            } else {
                // Full Custom Page with all standard sections
                $sectionKeys = PageBlueprintService::getCustomPageSectionKeys();
                PageBlueprintService::attachSectionsToPage($page, $sectionKeys);
            }
        }

        // Apply customized Hero Section & Summernote content if supplied
        $heroSection = $page->sections()->where('section_key', 'hero')->first();
        if ($heroSection) {
            $hContent = $heroSection->content ?? [];
            if ($request->filled('hero_title')) {
                $hContent['title'] = $request->input('hero_title');
                $heroCleanTitle = preg_replace('/\s+/', ' ', trim(strip_tags($request->input('hero_title'))));
                $hContent['bg_image_alt'] = $heroCleanTitle;
                $hContent['image_alt'] = $heroCleanTitle;
            }
            if ($request->filled('hero_subtitle')) {
                $hContent['subtitle'] = $request->input('hero_subtitle');
            }
            if ($request->filled('hero_badge')) {
                $hContent['badge'] = $request->input('hero_badge');
            }
            $hContent['bg_image'] = $heroBgImage;

            if ($request->filled('hero_content')) {
                $hContent['content'] = $request->input('hero_content');
                $hContent['description'] = $request->input('hero_content');
            }
            $heroSection->update(['content' => $hContent]);
        }

        // Apply customized Project Highlights section if present
        $hlSection = $page->sections()->where('section_key', 'highlights')->first();
        if ($hlSection) {
            $hlContent = $hlSection->content ?? [];
            if ($request->filled('highlights_title')) {
                $hlContent['title'] = $request->input('highlights_title');
            }
            if ($request->has('highlights_items') && is_array($request->input('highlights_items'))) {
                $cleanItems = [];
                foreach ($request->input('highlights_items') as $raw) {
                    if (!empty($raw['label']) || !empty($raw['value'])) {
                        $cleanItems[] = [
                            'label' => trim($raw['label'] ?? ''),
                            'value' => trim($raw['value'] ?? ''),
                            'icon'  => trim($raw['icon'] ?? 'building'),
                        ];
                    }
                }
                if (!empty($cleanItems)) {
                    $hlContent['items'] = $cleanItems;
                }
            }
            $hlSection->update(['content' => $hlContent]);
        }

        // Apply customized About Community section if present
        $aboutSection = $page->sections()->where('section_key', 'about')->first();
        if ($aboutSection) {
            $aboutContent = $aboutSection->content ?? [];
            if ($request->filled('about_title')) {
                $aboutContent['title'] = $request->input('about_title');
            }
            if ($request->filled('about_description')) {
                $aboutContent['description'] = $request->input('about_description');
            }
            if ($request->filled('about_video_poster')) {
                $aboutContent['video_poster'] = $request->input('about_video_poster');
            }
            if ($request->filled('about_video_src')) {
                $aboutContent['video_src'] = $request->input('about_video_src');
            }
            $aboutSection->update(['content' => $aboutContent]);
        }

        // Apply customized Article / Content & Booking section if present
        $contentSection = $page->sections()->where('section_key', 'content')->first();
        if ($contentSection) {
            $cContent = $contentSection->content ?? [];
            if ($request->filled('article_title')) {
                $cContent['title'] = $request->input('article_title');
            }
            if ($request->filled('article_intro')) {
                $cContent['intro'] = $request->input('article_intro');
            }
            if ($request->filled('article_summernote')) {
                $cContent['html'] = $request->input('article_summernote');
                $cContent['body'] = $request->input('article_summernote');
                $page->update(['body' => $request->input('article_summernote')]);
            }
            if ($request->filled('article_appt_title')) {
                $cContent['appt_title'] = $request->input('article_appt_title');
            }
            $contentSection->update(['content' => $cContent]);
        }

        // Also save Summernote hero_content into content section & page body if supplied from legacy hero
        if ($request->filled('hero_content') && !$request->filled('article_summernote')) {
            $heroHtml = $request->input('hero_content');
            $page->update(['body' => $heroHtml]);

            if ($contentSection) {
                $cContent = $contentSection->content ?? [];
                $cContent['title'] = $cContent['title'] ?? $request->input('hero_title', $page->title);
                $cContent['body']  = $heroHtml;
                $cContent['html']  = $heroHtml;
                $contentSection->update(['content' => $cContent]);
            }
        }

        // Apply customized Communities / Project Cards section if present
        $commSection = $page->sections()->where('section_key', 'communities')->first();
        if ($commSection) {
            $commContent = $commSection->content ?? [];
            if ($request->filled('communities_heading')) {
                $commContent['heading'] = $request->input('communities_heading');
            }
            if ($request->filled('communities_subtitle')) {
                $commContent['subtitle'] = $request->input('communities_subtitle');
            }
            if ($request->has('selected_project_ids') && is_array($request->input('selected_project_ids'))) {
                $selectedIds = array_values(array_filter($request->input('selected_project_ids')));
                $commContent['project_ids'] = $selectedIds;

                $cleanItems = [];
                foreach ($selectedIds as $pid) {
                    $proj = \App\Models\Project::with('page')->find($pid);
                    if ($proj) {
                        $href = $proj->page ? ($proj->page->slug === '/' ? '/' : '/' . ltrim($proj->page->slug, '/')) : ($proj->slug ? '/' . ltrim($proj->slug, '/') : '#');
                        $cleanItems[] = [
                            'id'          => $proj->id,
                            'name'        => $proj->title,
                            'location'    => $proj->location ?: 'Hudayriyat Island, Abu Dhabi',
                            'price'       => $proj->price ?: '',
                            'delivery'    => $proj->delivery_date ?: '',
                            'developer'   => $proj->developer ?: 'Modon Properties',
                            'paymentPlan' => $proj->payment_plan ?: 'Flexible Payment Plan',
                            'href'        => $href,
                            'image'       => $proj->image ?: '/images/communities/wadeem-gardens.png',
                        ];
                    }
                }
                $commContent['items'] = $cleanItems;
            } elseif ($request->has('communities_items') && is_array($request->input('communities_items'))) {
                $cleanItems = [];
                foreach ($request->input('communities_items') as $idx => $raw) {
                    $itemName = trim($raw['name'] ?? '');
                    $itemHref = trim($raw['href'] ?? '');
                    if (!empty($itemName) || !empty($itemHref)) {
                        $img = trim($raw['image'] ?? '/images/communities/wadeem-gardens.png');

                        if ($request->hasFile("communities_items.{$idx}.image_file")) {
                            $file = $request->file("communities_items.{$idx}.image_file");
                            $uploadDir = public_path('images/uploads');
                            if (!file_exists($uploadDir)) {
                                mkdir($uploadDir, 0777, true);
                            }
                            $safeName = time() . "_{$idx}_" . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                            $file->move($uploadDir, $safeName);
                            $img = '/images/uploads/' . $safeName;
                        }

                        $cleanItems[] = [
                            'name'        => $itemName ?: 'Project ' . ($idx + 1),
                            'location'    => trim($raw['location'] ?? 'Hudayriyat Island, Abu Dhabi'),
                            'price'       => trim($raw['price'] ?? ''),
                            'delivery'    => trim($raw['delivery'] ?? ''),
                            'developer'   => trim($raw['developer'] ?? 'Modon Properties'),
                            'paymentPlan' => trim($raw['paymentPlan'] ?? ($raw['payment_plan'] ?? '')),
                            'href'        => $itemHref ?: '#',
                            'image'       => $img,
                        ];
                    }
                }
                if (!empty($cleanItems)) {
                    $commContent['items'] = $cleanItems;
                }
            }
            $commSection->update(['content' => $commContent]);
        }

        // Apply customized FAQ section if present
        $faqSection = $page->sections()->where('section_key', 'faq')->first();
        if ($faqSection) {
            $faqContent = $faqSection->content ?? [];
            if ($request->filled('faq_heading')) {
                $faqContent['heading'] = $request->input('faq_heading');
                $faqContent['title'] = $request->input('faq_heading');
            }
            if ($request->filled('faq_subtitle')) {
                $faqContent['subtitle'] = $request->input('faq_subtitle');
                $faqContent['description'] = $request->input('faq_subtitle');
            }
            if ($request->has('faq_items') && is_array($request->input('faq_items'))) {
                $cleanFaqItems = [];
                foreach ($request->input('faq_items') as $idx => $raw) {
                    $q = trim($raw['q'] ?? ($raw['question'] ?? ''));
                    $a = trim($raw['a'] ?? ($raw['answer'] ?? ''));
                    if (!empty($q) || !empty($a)) {
                        $cleanFaqItems[] = [
                            'q'        => $q,
                            'a'        => $a,
                            'question' => $q,
                            'answer'   => $a,
                        ];
                    }
                }
                if (!empty($cleanFaqItems)) {
                    $faqContent['items'] = $cleanFaqItems;
                }
            }
            $faqSection->update(['content' => $faqContent]);
        }

        // Apply customized Contact section if present
        $contactSection = $page->sections()->where('section_key', 'contact')->first();
        if ($contactSection) {
            $cContent = $contactSection->content ?? [];
            if ($request->filled('contact_pretitle')) {
                $cContent['pretitle'] = $request->input('contact_pretitle');
            }
            if ($request->filled('contact_heading')) {
                $cContent['heading'] = $request->input('contact_heading');
                $cContent['title'] = $request->input('contact_heading');
            }
            if ($request->filled('contact_subtitle')) {
                $cContent['subtitle'] = $request->input('contact_subtitle');
                $cContent['description'] = $request->input('contact_subtitle');
            }
            if ($request->filled('contact_form_small')) {
                $cContent['form_small'] = $request->input('contact_form_small');
            }
            if ($request->filled('contact_form_large')) {
                $cContent['form_large'] = $request->input('contact_form_large');
            }
            if ($request->filled('contact_submit_button')) {
                $cContent['submit_button'] = $request->input('contact_submit_button');
                $cContent['button_text'] = $request->input('contact_submit_button');
            }
            if ($request->filled('contact_bg_image')) {
                $cContent['bg_image'] = $request->input('contact_bg_image');
            }
            $contactSection->update(['content' => $cContent]);
        }

        return redirect()
            ->route('admin.pages.edit', $page)
            ->with('success', "Page '{$page->title}' created successfully! All sections have been pre-populated with default values ready for editing.");
    }

    /**
     * Delete a created page (Home page is protected).
     */
    public function destroy(Page $page)
    {
        if ($page->slug === '/' || $page->slug === 'home') {
            return back()->with('error', 'The Home page cannot be deleted.');
        }

        $title = $page->title;
        $page->sections()->delete();
        $page->delete();

        return back()
            ->with('success', "Page '{$title}' and its sections were deleted successfully.");
    }

    /**
     * Show the form for editing the specified page with tabbed sections.
     */
    public function edit(Page $page)
    {
        $page->load(['sections' => fn($q) => $q->orderBy('order')]);

        if ($page->slug !== 'about-us' && $page->slug !== 'about_us') {
            // Ensure page has a 'content' section ready
            $contentSection = $page->sections->firstWhere('section_key', 'content');
            if (!$contentSection) {
                $overviewSection = $page->sections->firstWhere('section_key', 'overview');
                if ($overviewSection) {
                    $overviewSection->update([
                        'section_key' => 'content',
                        'section_name' => 'Content',
                    ]);
                }
            }
        }

        $projectSlugs = Page::projectSlugs();
        $projectPages = Page::whereIn('slug', $projectSlugs)->orderBy('title', 'asc')->get(['id', 'title', 'slug']);
        $linkedProject = \App\Models\Project::where('page_id', $page->id)->orWhere('slug', $page->slug)->first();

        $allProjects = \App\Models\Project::with('page')->orderBy('order', 'asc')->get();

        $commSection = $page->sections->firstWhere('section_key', 'communities') 
                    ?? $page->sections->firstWhere('section_key', 'projects');
        $commContent = $commSection ? ($commSection->content ?? []) : [];
        $unselectedProjectIds = (array) ($commContent['unselected_ids'] ?? []);

        // By default: every project is selected! Any newly added project has an ID NOT in unselected_ids, so it defaults to selected.
        if (isset($commContent['unselected_ids'])) {
            $allIds = $allProjects->pluck('id')->all();
            $activeSelected = array_values(array_diff($allIds, array_map('intval', $unselectedProjectIds)));
            
            if (!empty($commContent['selected_ids']) && is_array($commContent['selected_ids'])) {
                $ordered = [];
                foreach ($commContent['selected_ids'] as $sid) {
                    $sid = (int) $sid;
                    if (in_array($sid, $activeSelected, true)) {
                        $ordered[] = $sid;
                    }
                }
                $newIds = [];
                foreach ($activeSelected as $sid) {
                    if (!in_array($sid, $ordered, true)) {
                        $newIds[] = $sid;
                    }
                }
                // Prepend newly added projects at the TOP!
                $selectedProjectIds = array_merge($newIds, $ordered);
            } else {
                $selectedProjectIds = $activeSelected;
            }
        } elseif (isset($commContent['selected_ids']) || isset($commContent['project_ids'])) {
            $rawSelected = (array) ($commContent['selected_ids'] ?? $commContent['project_ids']);
            $selectedProjectIds = array_values(array_unique(array_map('intval', $rawSelected)));
            // Also prepend any newly created project that isn't in selectedProjectIds yet at the TOP!
            $newProjects = [];
            foreach ($allProjects as $p) {
                if (!in_array($p->id, $selectedProjectIds, true)) {
                    $newProjects[] = $p->id;
                }
            }
            $selectedProjectIds = array_merge($newProjects, $selectedProjectIds);
        } else {
            // Default: ALL projects are selected!
            $selectedProjectIds = $allProjects->pluck('id')->all();
        }

        return view('admin.pages.edit', compact('page', 'projectPages', 'linkedProject', 'projectSlugs', 'allProjects', 'selectedProjectIds'));
    }

    /**
     * Update the page general information, SEO meta, and section contents.
     */
    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['required', 'string', 'max:255', 'unique:pages,slug,' . $page->id],
            'in_navbar'        => ['nullable', 'boolean'],
            'navbar_order'     => ['nullable', 'integer'],
            'is_published'     => ['nullable', 'boolean'],
            'status'           => ['nullable', 'string', 'in:publish,draft,sold_out'],
            'location'         => ['nullable', 'string', 'max:255'],
            'badges'           => ['nullable'],
            'card_image'       => ['nullable', 'string', 'max:500'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'meta_keywords'    => ['nullable', 'string', 'max:1000'],
            'og_image'         => ['nullable', 'string', 'max:500'],
            'sections'         => ['nullable', 'array'],
        ]);

        $status = $request->input('status', $page->status ?? 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }
        $isPublished = $request->has('status') ? ($status !== 'draft') : $request->boolean('is_published');

        $page->update([
            'title'            => $validated['title'],
            'slug'             => $validated['slug'],
            'in_navbar'        => $request->boolean('in_navbar'),
            'navbar_order'     => $validated['navbar_order'] ?? 0,
            'status'           => $status,
            'is_published'     => $isPublished,
            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords'] ?? null,
            'og_image'         => array_key_exists('og_image', $validated) ? $validated['og_image'] : $page->og_image,
        ]);

        // Sync linked project card if exists
        $linkedProject = \App\Models\Project::where('page_id', $page->id)->orWhere('slug', $page->slug)->first();
        if ($linkedProject) {
            $projectUpdates = [
                'title'     => $validated['title'],
                'slug'      => $validated['slug'],
                'status'    => $status,
                'is_active' => $isPublished,
            ];

            if ($request->has('location')) {
                $projectUpdates['location'] = $request->input('location');
            }

            if ($request->has('badges')) {
                $bInput = $request->input('badges');
                if (is_string($bInput)) {
                    $bInput = json_decode($bInput, true) ?: [];
                }
                $projectUpdates['badges'] = is_array($bInput) ? array_values(array_filter(array_map('trim', $bInput))) : [];
            }

            if ($request->hasFile('card_image_file')) {
                $file = $request->file('card_image_file');
                $uploadDir = public_path('images/projects');
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $safeName = time() . '_card_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDir, $safeName);
                $projectUpdates['image'] = '/images/projects/' . $safeName;
            } elseif ($request->filled('card_image')) {
                $projectUpdates['image'] = $request->input('card_image');
            }

            $linkedProject->update($projectUpdates);
        }

        // Update Section Contents
        if (!empty($validated['sections'])) {
            foreach ($validated['sections'] as $secKey => $contentData) {
                if (!is_array($contentData)) {
                    continue;
                }

                $section = PageSection::firstOrNew([
                    'page_id' => $page->id,
                    'section_key' => $secKey,
                ]);

                if (!$section->exists) {
                    $section->section_name = ucwords(str_replace('_', ' ', $secKey));
                    $section->order = $page->sections()->count() + 1;
                    $section->is_active = true;
                }

                // If is_active is explicitly passed
                if (isset($contentData['is_active'])) {
                    $section->is_active = (bool) $contentData['is_active'];
                    unset($contentData['is_active']);
                }

                // If nested content key exists, unpack it
                if (isset($contentData['content']) && is_array($contentData['content'])) {
                    $contentData = array_merge($contentData, $contentData['content']);
                    unset($contentData['content']);
                }

                // Merge or update content array
                $currentContent = $section->content ?? [];

                // If repeater items are present or explicitly enabled for this section
                if (isset($contentData['_has_items'])) {
                    $rawItems = $contentData['items'] ?? [];
                    if (is_array($rawItems)) {
                        foreach ($rawItems as $rIdx => &$rItem) {
                            if (!is_array($rItem)) continue;
                            // Check for uploaded image file for this item/card
                            if ($request->hasFile("section_files.{$secKey}.items.{$rIdx}.image")) {
                                $f = $request->file("section_files.{$secKey}.items.{$rIdx}.image");
                                if ($f && $f->isValid()) {
                                    $uploadDir = public_path('uploads/pages');
                                    if (!file_exists($uploadDir)) {
                                        @mkdir($uploadDir, 0777, true);
                                    }
                                    $safeName = time() . "_{$secKey}_{$rIdx}_" . \Illuminate\Support\Str::slug(pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $f->getClientOriginalExtension();
                                    $f->move($uploadDir, $safeName);
                                    $rItem['image'] = '/uploads/pages/' . $safeName;
                                }
                            }
                            // Check for uploaded icon file for this item/card
                            if ($request->hasFile("section_files.{$secKey}.items.{$rIdx}.icon")) {
                                $f = $request->file("section_files.{$secKey}.items.{$rIdx}.icon");
                                if ($f && $f->isValid()) {
                                    $uploadDir = public_path('uploads/pages');
                                    if (!file_exists($uploadDir)) {
                                        @mkdir($uploadDir, 0777, true);
                                    }
                                    $safeName = time() . "_{$secKey}_{$rIdx}_" . \Illuminate\Support\Str::slug(pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $f->getClientOriginalExtension();
                                    $f->move($uploadDir, $safeName);
                                    $rItem['icon'] = '/uploads/pages/' . $safeName;
                                }
                            }
                        }
                        unset($rItem);
                    }
                    $currentContent['items'] = array_values(array_filter($rawItems, function ($item) {
                        if (!is_array($item)) return false;
                        foreach ($item as $subVal) {
                            if (!empty(trim((string)$subVal))) return true;
                        }
                        return false;
                    }));
                    unset($contentData['_has_items'], $contentData['items']);
                }

                if (isset($contentData['_has_locations'])) {
                    $rawLocs = $contentData['locations'] ?? [];
                    $currentContent['locations'] = array_values(array_filter($rawLocs, function ($loc) {
                        return is_array($loc) && (!empty(trim($loc['name'] ?? '')) || !empty(trim($loc['distance'] ?? '')));
                    }));
                    unset($contentData['_has_locations'], $contentData['locations']);
                }

                if (isset($contentData['_has_investment_highlights'])) {
                    $rawHl = $contentData['investment_highlights'] ?? [];
                    $currentContent['investment_highlights'] = array_values(array_filter($rawHl, function ($item) {
                        $txt = is_array($item) ? ($item['text'] ?? '') : $item;
                        return !empty(trim((string)$txt));
                    }));
                    unset($contentData['_has_investment_highlights'], $contentData['investment_highlights']);
                }

                if (isset($contentData['_has_financing_highlights'])) {
                    $rawFin = $contentData['financing_highlights'] ?? [];
                    $currentContent['financing_highlights'] = array_values(array_filter($rawFin, function ($item) {
                        $txt = is_array($item) ? ($item['text'] ?? '') : $item;
                        return !empty(trim((string)$txt));
                    }));
                    unset($contentData['_has_financing_highlights'], $contentData['financing_highlights']);
                }

                if (isset($contentData['_has_benefits'])) {
                    $rawBen = $contentData['benefits'] ?? [];
                    $currentContent['benefits'] = array_values(array_filter($rawBen, function ($item) {
                        $txt = is_array($item) ? ($item['text'] ?? '') : $item;
                        return !empty(trim((string)$txt));
                    }));
                    unset($contentData['_has_benefits'], $contentData['benefits']);
                }

                if (isset($contentData['_has_features'])) {
                    $rawFeat = $contentData['features'] ?? [];
                    $currentContent['features'] = array_values(array_filter($rawFeat, function ($item) {
                        if (!is_array($item)) return false;
                        foreach ($item as $subVal) {
                            if (!empty(trim((string)$subVal))) return true;
                        }
                        return false;
                    }));
                    unset($contentData['_has_features'], $contentData['features']);
                }

                // Handle specialized rich section formats
                if (isset($contentData['categories']) && is_array($contentData['categories'])) {
                    $cleanCategories = [];
                    foreach ($contentData['categories'] as $cItem) {
                        if (!is_array($cItem) || empty(trim($cItem['name'] ?? ''))) continue;
                        $catName = html_entity_decode(trim($cItem['name']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $rawSubItems = $cItem['items'] ?? [];
                        $cleanSubItems = [];
                        if (is_array($rawSubItems)) {
                            foreach ($rawSubItems as $sub) {
                                if (is_array($sub) && !empty(trim($sub['name'] ?? ''))) {
                                    $cleanSubItems[] = [
                                        'name' => html_entity_decode(trim($sub['name']), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                                        'time' => html_entity_decode(trim($sub['time'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                                    ];
                                }
                            }
                        }
                        $cleanCategories[] = [
                            'name' => $catName,
                            'items' => array_values($cleanSubItems),
                        ];
                    }
                    $currentContent['categories'] = array_values($cleanCategories);
                    unset($contentData['categories']);
                }

                if (isset($contentData['rows']) && is_array($contentData['rows'])) {
                    $cleanRows = [];
                    foreach ($contentData['rows'] as $r) {
                        if (is_array($r) && (!empty(trim($r['installment'] ?? '')) || !empty(trim($r['percentage'] ?? '')))) {
                            $cleanRows[] = [
                                'installment' => html_entity_decode(trim($r['installment'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                                'percentage'  => html_entity_decode(trim($r['percentage'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                                'milestone'   => html_entity_decode(trim($r['milestone'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                            ];
                        }
                    }
                    $currentContent['rows'] = array_values($cleanRows);
                    unset($contentData['rows']);
                }

                if (isset($contentData['plan_tabs'])) {
                    if (is_string($contentData['plan_tabs'])) {
                        $rawTabs = array_values(array_filter(array_map('trim', explode(',', $contentData['plan_tabs']))));
                    } elseif (is_array($contentData['plan_tabs'])) {
                        $rawTabs = array_values(array_filter(array_map('trim', $contentData['plan_tabs'])));
                    } else {
                        $rawTabs = [];
                    }
                    $currentContent['plan_tabs'] = array_values(array_filter($rawTabs, function($t) {
                        $cl = strtolower(trim($t));
                        return !str_contains($cl, 'without finance') && !str_contains($cl, 'with finance');
                    }));
                    unset($contentData['plan_tabs']);
                }

                if (isset($contentData['images']) && is_array($contentData['images'])) {
                    $cleanImages = [];
                    foreach ($contentData['images'] as $slotIdx => $img) {
                        if (is_array($img)) {
                            $cleanImages[$slotIdx] = [
                                'src' => trim($img['src'] ?? ''),
                                'category' => html_entity_decode(trim($img['category'] ?? 'Exterior'), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                                'alt' => html_entity_decode(trim($img['alt'] ?? 'Project Photo'), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                            ];
                        }
                    }
                    $currentContent['images'] = $cleanImages;
                    unset($contentData['images']);
                }

                foreach ($contentData as $k => $v) {
                    if ($k === 'items' && is_array($v)) {
                        $currentContent[$k] = array_values(array_filter($v, function ($item) {
                            if (!is_array($item)) return false;
                            foreach ($item as $subVal) {
                                if (!empty(trim((string)$subVal))) return true;
                            }
                            return false;
                        }));
                    } elseif ($k === 'locations' && is_array($v)) {
                        $currentContent[$k] = array_values(array_filter($v, function ($item) {
                            return is_array($item) && (!empty(trim($item['name'] ?? '')) || !empty(trim($item['distance'] ?? '')));
                        }));
                    } elseif (is_string($v)) {
                        $currentContent[$k] = html_entity_decode($v, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    } else {
                        $currentContent[$k] = $v;
                    }
                }

                if ($secKey === 'hero') {
                    $heroHeadingClean = isset($contentData['title']) ? preg_replace('/\s+/', ' ', trim(strip_tags((string)$contentData['title']))) : '';
                    $altVal = '';
                    if (isset($contentData['bg_image_alt'])) {
                        $altVal = html_entity_decode(trim($contentData['bg_image_alt']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    } elseif (isset($contentData['image_alt'])) {
                        $altVal = html_entity_decode(trim($contentData['image_alt']), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    }
                    if (empty($altVal) && !empty($heroHeadingClean)) {
                        $altVal = $heroHeadingClean;
                    }
                    $currentContent['bg_image_alt'] = $altVal;
                    $currentContent['image_alt'] = $altVal;
                }

                if (isset($currentContent['html']) && is_string($currentContent['html'])) {
                    $currentContent['html'] = $this->ensureHeadingIds($currentContent['html']);
                }
                if (isset($currentContent['body']) && is_string($currentContent['body'])) {
                    $currentContent['body'] = $this->ensureHeadingIds($currentContent['body']);
                }

                if ($secKey === 'content' || $secKey === 'overview') {
                    $bodyVal = $currentContent['html'] ?? ($currentContent['body'] ?? null);
                    if ($bodyVal !== null && \Illuminate\Support\Facades\Schema::hasColumn('pages', 'body')) {
                        $page->update(['body' => $bodyVal]);
                    }
                }

                // Check for uploaded files for this section (runs AFTER text fields so files always take precedence)
                $uploadedSectionFiles = $request->file('section_files.' . $secKey);
                if (!empty($uploadedSectionFiles) || $request->hasFile('section_files.' . $secKey)) {
                    $uploadDir = public_path('uploads/pages');
                    if (!file_exists($uploadDir)) {
                        @mkdir($uploadDir, 0777, true);
                    }

                    if (is_array($uploadedSectionFiles)) {
                        foreach ($uploadedSectionFiles as $fKey => $fVal) {
                            if ($fKey === 'images' && is_array($fVal)) {
                                foreach ($fVal as $gIdx => $gFile) {
                                    $actualFile = is_array($gFile) ? ($gFile['file'] ?? null) : $gFile;
                                    if ($actualFile instanceof \Illuminate\Http\UploadedFile && $actualFile->isValid()) {
                                        $ext = strtolower($actualFile->getClientOriginalExtension());
                                        if (in_array($ext, ['jpg', 'jpeg', 'webp', 'png']) && $actualFile->getSize() <= 2097152) {
                                            $fileName = time() . '_' . uniqid() . '.' . $ext;
                                            $actualFile->move($uploadDir, $fileName);
                                            if (!isset($currentContent['images'][$gIdx])) {
                                                $currentContent['images'][$gIdx] = ['alt' => 'Project Photo', 'category' => 'Exterior'];
                                            }
                                            $currentContent['images'][$gIdx]['src'] = '/uploads/pages/' . $fileName;
                                        }
                                    }
                                }
                            } elseif ($fKey === 'items' && is_array($fVal)) {
                                foreach ($fVal as $itemIdx => $itemFiles) {
                                    if (is_array($itemFiles)) {
                                        foreach ($itemFiles as $subKey => $uploadedFile) {
                                            if ($uploadedFile instanceof \Illuminate\Http\UploadedFile && $uploadedFile->isValid() && file_exists($uploadedFile->getPathname())) {
                                                $fileName = time() . "_{$secKey}_{$itemIdx}_" . \Illuminate\Support\Str::slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $uploadedFile->getClientOriginalExtension();
                                                $uploadedFile->move($uploadDir, $fileName);
                                                if (isset($currentContent['items'][$itemIdx])) {
                                                    $currentContent['items'][$itemIdx][$subKey] = '/uploads/pages/' . $fileName;
                                                }
                                            }
                                        }
                                    }
                                }
                            } elseif ($fVal instanceof \Illuminate\Http\UploadedFile && $fVal->isValid()) {
                                $fileName = time() . '_' . uniqid() . '.' . $fVal->getClientOriginalExtension();
                                $fVal->move($uploadDir, $fileName);
                                $filePath = '/uploads/pages/' . $fileName;
                                $currentContent[$fKey] = $filePath;
                                if ($fKey === 'download_file') {
                                    $currentContent['download_url'] = $filePath;
                                }
                            }
                        }
                    }
                }

                if (isset($currentContent['images']) && is_array($currentContent['images'])) {
                    $filteredImages = array_values(array_filter($currentContent['images'], function ($im) {
                        return is_array($im) && !empty(trim($im['src'] ?? ''));
                    }));
                    $currentContent['images'] = array_slice($filteredImages, 0, 10);
                }

                if ($secKey === 'highlights' && !empty($currentContent['items'])) {
                    foreach ($currentContent['items'] as $hItem) {
                        if (!empty($hItem['key'])) {
                            $currentContent[$hItem['key']] = $hItem['value'] ?? '';
                        }
                    }
                }

                if ($secKey === 'communities' || $secKey === 'projects') {
                    $hasDualPicker = $request->has('selected_project_ids') 
                                  || $request->has('unselected_project_ids') 
                                  || $request->has('dual_boxes_submitted')
                                  || isset($contentData['selected_ids']) 
                                  || isset($contentData['unselected_ids']);

                    if ($hasDualPicker) {
                        $rawSel = $request->input('selected_project_ids', $contentData['selected_ids'] ?? []);
                        $rawUnsel = $request->input('unselected_project_ids', $contentData['unselected_ids'] ?? []);

                        $cleanSelected = array_values(array_filter(array_map('intval', (array) $rawSel)));
                        $cleanUnselected = array_values(array_filter(array_map('intval', (array) $rawUnsel)));

                        // Crucial fix: Any project that is in selected MUST be removed from unselected!
                        $cleanUnselected = array_values(array_diff($cleanUnselected, $cleanSelected));

                        $currentContent['selected_ids'] = $cleanSelected;
                        $currentContent['project_ids'] = $cleanSelected;
                        $currentContent['unselected_ids'] = $cleanUnselected;
                    }
                }

                $section->content = $currentContent;
                $section->save();
            }
        }

        // Catch top-level selected/unselected project IDs if submitted outside sections array
        if ($request->has('selected_project_ids') || $request->has('unselected_project_ids') || $request->has('dual_boxes_submitted')) {
            $commSection = $page->sections()->whereIn('section_key', ['communities', 'projects'])->first();
            if ($commSection) {
                $cData = $commSection->content ?? [];
                $cleanSelected = array_values(array_filter(array_map('intval', (array) $request->input('selected_project_ids', []))));
                $cleanUnselected = array_values(array_filter(array_map('intval', (array) $request->input('unselected_project_ids', []))));
                
                // Crucial fix: Any project that is in selected MUST be removed from unselected!
                $cleanUnselected = array_values(array_diff($cleanUnselected, $cleanSelected));

                $cData['selected_ids'] = $cleanSelected;
                $cData['project_ids'] = $cleanSelected;
                $cData['unselected_ids'] = $cleanUnselected;
                $commSection->update(['content' => $cData]);
            }
        }

        // Update overall section order if submitted
        if ($request->has('section_order') && is_array($request->input('section_order'))) {
            foreach ($request->input('section_order') as $index => $secKey) {
                $page->sections()->where('section_key', $secKey)->update(['order' => $index + 1]);
            }
        }

        $activeTab = $request->input('active_tab', 'general');

        return redirect()
            ->route('admin.pages.edit', ['page' => $page->id, 'tab' => $activeTab])
            ->with('success', "Page '{$page->title}' updated successfully. Changes are live!");
    }

    /**
     * Reorder page sections via drag & drop.
     */
    public function reorderSections(Request $request, Page $page)
    {
        $request->validate([
            'order' => ['required', 'array'],
        ]);

        foreach ($request->input('order') as $index => $sectionKey) {
            $page->sections()->where('section_key', $sectionKey)->update(['order' => $index + 1]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Page sections reordered successfully.',
            'order' => $request->input('order'),
        ]);
    }

    /**
     * Toggle the navbar visibility of a page.
     */
    public function toggleNavbar(Page $page)
    {
        $page->update(['in_navbar' => !$page->in_navbar]);

        return back()->with('success', "Navbar visibility for '{$page->title}' updated.");
    }

    /**
     * Toggle the published status of a page.
     */
    public function togglePublished(Page $page)
    {
        $page->is_published = !$page->is_published;
        $page->status = $page->is_published ? 'publish' : 'draft';
        $page->save();

        $linkedProject = \App\Models\Project::where('page_id', $page->id)->orWhere('slug', $page->slug)->first();
        if ($linkedProject) {
            $linkedProject->status = $page->status;
            $linkedProject->is_active = $page->is_published;
            $linkedProject->save();
        }

        return back()->with('success', "Publication status for '{$page->title}' updated.");
    }

    /**
     * Update the publication status (publish, draft, sold_out) of a page and linked project card.
     */
    public function updateStatus(Request $request, Page $page)
    {
        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }

        $page->status = $status;
        $page->is_published = ($status !== 'draft');
        $page->save();

        $linkedProject = \App\Models\Project::where('page_id', $page->id)->orWhere('slug', $page->slug)->first();
        if ($linkedProject) {
            $linkedProject->status = $status;
            $linkedProject->is_active = ($status !== 'draft');
            $linkedProject->save();
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

        return back()->with('success', "Page '{$page->title}' status updated to {$label}.");
    }

    /**
     * Automatically inject slug id attributes into all <h2> tags in HTML content
     * so Table of Contents anchors can accurately target and scroll to them.
     */
    /**
     * Clean HTML content to strip default/auto-injected IDs and classes,
     * ensuring only pure clean tags remain (e.g. <h2> instead of <h2 id="...">,
     * and <table> instead of <table class="table table-bordered">).
     */
    protected function ensureHeadingIds(string $html): string
    {
        if (empty(trim($html))) {
            return $html;
        }

        // Strip default table classes
        $html = preg_replace('/<table\s+class=["\'](?:table\s+table-bordered|table-bordered\s+table|table|table-bordered)["\']/i', '<table', $html);

        // Strip auto-generated id attributes from headings (h1 to h6)
        $html = preg_replace_callback('/<(h[1-6])([^>]*)>/i', function ($m) {
            $tag = $m[1];
            $attrs = $m[2];
            $attrs = preg_replace('/\s*\bid\s*=\s*["\'][^"\']*["\']/i', '', $attrs);
            $attrs = preg_replace('/\s*\bclass\s*=\s*["\']\s*["\']/i', '', $attrs);
            return '<' . $tag . $attrs . '>';
        }, $html);

        // Strip empty class="" or id=""
        $html = preg_replace('/\s*(?:class|id)\s*=\s*["\']\s*["\']/i', '', $html);

        return $html;
    }
}
