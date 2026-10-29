<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Community;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Project;
use App\Services\PageBlueprintService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommunityController extends Controller
{
    /**
     * Display a listing of all Neighbourhoods / Communities.
     */
    public function index(Request $request)
    {
        $communities = Community::with(['city', 'page.sections'])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $cities = City::where('is_active', true)->orderBy('name', 'asc')->get();
        $allProjects = Project::with('page')->orderBy('order', 'asc')->get();
        $totalCommunities = $communities->count();
        $activeCommunities = $communities->where('is_active', true)->count();

        return view('admin.communities.index', compact('communities', 'cities', 'allProjects', 'totalCommunities', 'activeCommunities'));
    }

    /**
     * Store a newly created Neighbourhood / Community and its linked Detail Page.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'city_id'     => ['nullable', 'exists:cities,id'],
            'slug'        => ['nullable', 'string', 'max:255'],
            'status'      => ['nullable', 'string', 'in:publish,draft,sold_out'],
        ]);

        $name = trim($validated['name']);
        $cityId = !empty($validated['city_id']) ? (int) $validated['city_id'] : null;
        $cityName = $cityId ? City::find($cityId)?->name : null;

        $rawSlug = trim($request->input('slug') ?: $name);
        $slug = Str::slug($rawSlug);

        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }
        $isActive = ($status !== 'draft');

        // Hero Background Image Handling
        $heroBgImage = '/images/hero/slide-1.jpg';
        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $uploadDir = public_path('images/communities');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time() . '_hero_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $heroBgImage = '/images/communities/' . $filename;
        } elseif ($request->filled('sections.hero.bg_image')) {
            $heroBgImage = $request->input('sections.hero.bg_image');
        }

        // Unique slug for Page
        $uniqueSlug = $slug;
        $count = 1;
        while (Page::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $count;
            $count++;
        }

        // 1. Create linked Page
        $page = Page::create([
            'title'            => $name,
            'slug'             => $uniqueSlug,
            'in_navbar'        => $request->boolean('in_navbar', true),
            'navbar_order'     => ((int) Page::max('navbar_order')) + 1,
            'status'           => $status,
            'is_published'     => $isActive,
            'meta_title'       => $request->input('meta_title') ?: ($name . ($cityName ? ' ' . $cityName : '') . ' Properties | Luxury Investment & Community Guide'),
            'meta_description' => $request->input('meta_description') ?: ("Explore luxury waterfront homes, real estate, and investment projects in {$name}" . ($cityName ? ", {$cityName}" : "") . "."),
            'meta_keywords'    => $request->input('meta_keywords') ?: ("{$name}, real estate in {$name}, properties for sale in {$name}"),
            'og_image'         => $heroBgImage,
        ]);

        // 2. Attach only the requested 6 vertical sections in order:
        // Hero, TOC/Content, Project Cards, About Community, FAQ, Contact Section
        $orderedKeys = ['hero', 'content', 'communities', 'about', 'faq', 'contact'];
        $orderNum = 1;
        foreach ($orderedKeys as $key) {
            $sectionName = match($key) {
                'hero'        => 'Hero Banner',
                'content'     => 'Table of Contents & Article',
                'communities' => 'Project Cards',
                'about'       => 'About ' . $name,
                'faq'         => 'Frequently Asked Questions',
                'contact'     => 'Contact & Booking CTA',
                default       => ucwords(str_replace('_', ' ', $key)),
            };

            $defaultContent = PageBlueprintService::getDefaultSectionContent($key, $name);
            PageSection::create([
                'page_id'      => $page->id,
                'section_key'  => $key,
                'section_name' => $sectionName,
                'order'        => $orderNum++,
                'is_active'    => true,
                'content'      => $defaultContent,
            ]);
        }

        // 3. Customize Sections with form inputs
        $submittedSections = $request->input('sections', []);

        // 3.1 Hero
        $heroSec = $page->sections()->where('section_key', 'hero')->first();
        if ($heroSec) {
            $hContent = $heroSec->content ?? [];
            $hContent['bg_image'] = $heroBgImage;
            $hContent['title'] = $request->input('sections.hero.title') ?: $name;
            $hContent['subtitle'] = $request->input('sections.hero.subtitle') ?: ("Explore Premier Properties & Real Estate Investment in " . $name . ($cityName ? ', ' . $cityName : ''));
            $hContent['badge'] = $request->input('sections.hero.badge') ?: 'Prime Community';
            $heroSec->update(['content' => $hContent]);
        }

        // 3.2 TOC / Content
        $contentSec = $page->sections()->where('section_key', 'content')->first();
        if ($contentSec) {
            $cContent = $contentSec->content ?? [];
            if ($request->filled('sections.content.title')) {
                $cContent['title'] = $request->input('sections.content.title');
            }
            if ($request->filled('sections.content.intro')) {
                $cContent['intro'] = $request->input('sections.content.intro');
            }
            if ($request->filled('sections.content.html')) {
                $cContent['html'] = $request->input('sections.content.html');
                $cContent['body'] = $request->input('sections.content.html');
                $page->update(['body' => $request->input('sections.content.html')]);
            }
            if ($request->filled('sections.content.appt_title')) {
                $cContent['appt_title'] = $request->input('sections.content.appt_title');
            }
            $contentSec->update(['content' => $cContent]);
        }

        // 3.3 Project Cards (Communities)
        $commSec = $page->sections()->where('section_key', 'communities')->first();
        if ($commSec) {
            $commContent = $commSec->content ?? [];
            $commContent['heading'] = $request->input('sections.communities.heading') ?: ("Featured Projects in " . $name);
            $commContent['subtitle'] = $request->input('sections.communities.subtitle') ?: ("Explore premier residential developments and waterfront master communities in " . $name);

            $selectedCardIds = $request->input('selected_project_ids', []);
            $cleanSelectedIds = array_values(array_filter(array_map('intval', (array)$selectedCardIds)));
            $commContent['selected_ids'] = $cleanSelectedIds;
            $commContent['project_ids'] = $cleanSelectedIds;
            $commSec->update(['content' => $commContent]);
        }

        // 3.4 About Community
        $aboutSec = $page->sections()->where('section_key', 'about')->first();
        if ($aboutSec) {
            $aContent = $aboutSec->content ?? [];
            if ($request->filled('sections.about.heading')) {
                $aContent['heading'] = $request->input('sections.about.heading');
                $aContent['title'] = $request->input('sections.about.heading');
            }
            if ($request->filled('sections.about.description')) {
                $aContent['description'] = $request->input('sections.about.description');
            }
            if ($request->filled('sections.about.video_url')) {
                $aContent['video_url'] = $request->input('sections.about.video_url');
            }
            if ($request->hasFile('about_poster_file')) {
                $file = $request->file('about_poster_file');
                $uploadDir = public_path('images/communities');
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $safeName = time() . '_about_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadDir, $safeName);
                $aContent['poster_image'] = '/images/communities/' . $safeName;
                $aContent['video_poster'] = '/images/communities/' . $safeName;
            } elseif ($request->filled('sections.about.poster_image')) {
                $aContent['poster_image'] = $request->input('sections.about.poster_image');
                $aContent['video_poster'] = $request->input('sections.about.poster_image');
            }
            $aboutSec->update(['content' => $aContent]);
        }

        // 3.5 FAQ
        $faqSec = $page->sections()->where('section_key', 'faq')->first();
        if ($faqSec) {
            $fContent = $faqSec->content ?? [];
            if ($request->filled('sections.faq.title')) {
                $fContent['title'] = $request->input('sections.faq.title');
                $fContent['heading'] = $request->input('sections.faq.title');
            } elseif ($request->filled('sections.faq.heading')) {
                $fContent['heading'] = $request->input('sections.faq.heading');
                $fContent['title'] = $request->input('sections.faq.heading');
            }
            if ($request->filled('sections.faq.subtitle')) {
                $fContent['subtitle'] = $request->input('sections.faq.subtitle');
            }

            if ($request->has('faq_q') && is_array($request->input('faq_q'))) {
                $qs = (array) $request->input('faq_q');
                $as = (array) $request->input('faq_a');
                $items = [];
                foreach ($qs as $idx => $q) {
                    $qText = trim($q);
                    $aText = trim($as[$idx] ?? '');
                    if ($qText !== '') {
                        $items[] = ['q' => $qText, 'a' => $aText];
                    }
                }
                $fContent['items'] = $items;
            } elseif (!empty($submittedSections['faq']['items']) && is_array($submittedSections['faq']['items'])) {
                $fContent['items'] = array_values(array_filter($submittedSections['faq']['items'], fn($item) => !empty(trim($item['q'] ?? ($item['question'] ?? '')))));
            }
            $faqSec->update(['content' => $fContent]);
        }

        // 3.6 Contact CTA
        $contactSec = $page->sections()->where('section_key', 'contact')->first();
        if ($contactSec) {
            $ctContent = $contactSec->content ?? [];
            if (!empty($submittedSections['contact']['title'])) {
                $ctContent['title'] = $submittedSections['contact']['title'];
            }
            if (!empty($submittedSections['contact']['subtitle'])) {
                $ctContent['subtitle'] = $submittedSections['contact']['subtitle'];
            }
            if (!empty($submittedSections['contact']['button_text'])) {
                $ctContent['button_text'] = $submittedSections['contact']['button_text'];
            }
            if (!empty($submittedSections['contact']['phone'])) {
                $ctContent['phone'] = $submittedSections['contact']['phone'];
            }
            if (!empty($submittedSections['contact']['email'])) {
                $ctContent['email'] = $submittedSections['contact']['email'];
            }
            $contactSec->update(['content' => $ctContent]);
        }

        // 4. Create Community record
        Community::create([
            'city_id'   => $cityId,
            'name'      => $name,
            'slug'      => $uniqueSlug,
            'page_id'   => $page->id,
            'image'     => $heroBgImage,
            'status'    => $status,
            'order'     => ((int) Community::max('order')) + 1,
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.communities.index')->with('success', "Neighbourhood/Community '{$name}' created successfully!");
    }

    /**
     * Show edit form for Neighbourhood / Community.
     */
    public function edit(Community $community)
    {
        $community->load(['city', 'page.sections']);
        $page = $community->page;
        $sections = $page ? $page->sections->keyBy('section_key') : collect();
        $commContent = $sections['communities']->content ?? [];
        $selectedProjectIds = (array) ($commContent['selected_ids'] ?? ($commContent['project_ids'] ?? []));
        $faqContent = $sections['faq']->content ?? [];
        $faqItems = (array) ($faqContent['items'] ?? []);
        $allProjects = Project::with('page')->orderBy('order', 'asc')->get();
        $cities = City::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('admin.communities.edit', compact('community', 'page', 'sections', 'selectedProjectIds', 'faqItems', 'allProjects', 'cities'));
    }

    /**
     * Update an existing Neighbourhood / Community.
     */
    public function update(Request $request, Community $community)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'slug'    => ['nullable', 'string', 'max:255'],
            'status'  => ['nullable', 'string', 'in:publish,draft,sold_out'],
        ]);

        $name = trim($validated['name']);
        $cityId = !empty($validated['city_id']) ? (int) $validated['city_id'] : null;
        $cityName = $cityId ? City::find($cityId)?->name : null;

        $rawSlug = trim($request->input('slug') ?: $name);
        $slug = Str::slug($rawSlug);

        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }
        $isActive = ($status !== 'draft');

        // Check slug uniqueness
        $existingPage = Page::where('slug', $slug)->where('id', '!=', $community->page_id)->first();
        if ($existingPage) {
            $slug = $slug . '-' . $community->id;
        }

        // Update Community
        $community->update([
            'city_id'   => $cityId,
            'name'      => $name,
            'slug'      => $slug,
            'status'    => $status,
            'is_active' => $isActive,
        ]);

        // Update Page
        $page = $community->page;
        if ($page) {
            $page->update([
                'title'            => $name,
                'slug'             => $slug,
                'status'           => $status,
                'is_published'     => $isActive,
                'meta_title'       => $request->input('meta_title') ?: ($name . ($cityName ? ' ' . $cityName : '') . ' Properties | Luxury Investment & Community Guide'),
                'meta_description' => $request->input('meta_description') ?: ("Explore luxury waterfront homes, real estate, and investment projects in {$name}" . ($cityName ? ", {$cityName}" : "") . "."),
                'meta_keywords'    => $request->input('meta_keywords') ?: ("{$name}, real estate in {$name}, properties for sale in {$name}"),
            ]);

            // Hero
            $heroSec = $page->sections()->where('section_key', 'hero')->first();
            if ($heroSec) {
                $hContent = $heroSec->content ?? [];
                if ($request->hasFile('hero_image_file')) {
                    $file = $request->file('hero_image_file');
                    $uploadDir = public_path('images/communities');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $filename = time() . '_hero_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->move($uploadDir, $filename);
                    $hContent['bg_image'] = '/images/communities/' . $filename;
                    $community->update(['image' => '/images/communities/' . $filename]);
                } elseif ($request->filled('sections.hero.bg_image')) {
                    $hContent['bg_image'] = $request->input('sections.hero.bg_image');
                    $community->update(['image' => $request->input('sections.hero.bg_image')]);
                }
                $hContent['title'] = $request->input('sections.hero.title') ?: $name;
                $hContent['subtitle'] = $request->input('sections.hero.subtitle') ?: ("Explore Premier Properties & Real Estate Investment in " . $name . ($cityName ? ', ' . $cityName : ''));
                $hContent['badge'] = $request->input('sections.hero.badge') ?: 'Prime Community';
                $heroSec->update(['content' => $hContent]);
            }

            // TOC / Content
            $contentSec = $page->sections()->where('section_key', 'content')->first();
            if ($contentSec) {
                $cContent = $contentSec->content ?? [];
                if ($request->filled('sections.content.title')) $cContent['title'] = $request->input('sections.content.title');
                if ($request->filled('sections.content.intro')) $cContent['intro'] = $request->input('sections.content.intro');
                if ($request->filled('sections.content.html')) {
                    $cContent['html'] = $request->input('sections.content.html');
                    $cContent['body'] = $request->input('sections.content.html');
                    $page->update(['body' => $request->input('sections.content.html')]);
                }
                if ($request->filled('sections.content.appt_title')) $cContent['appt_title'] = $request->input('sections.content.appt_title');
                $contentSec->update(['content' => $cContent]);
            }

            // Project Cards
            $commSec = $page->sections()->where('section_key', 'communities')->first();
            if ($commSec) {
                $commContent = $commSec->content ?? [];
                if ($request->filled('sections.communities.heading')) $commContent['heading'] = $request->input('sections.communities.heading');
                if ($request->filled('sections.communities.subtitle')) $commContent['subtitle'] = $request->input('sections.communities.subtitle');
                if ($request->has('selected_project_ids')) {
                    $cleanSelectedIds = array_values(array_filter(array_map('intval', (array)$request->input('selected_project_ids'))));
                    $commContent['selected_ids'] = $cleanSelectedIds;
                    $commContent['project_ids'] = $cleanSelectedIds;
                } else {
                    $commContent['selected_ids'] = [];
                    $commContent['project_ids'] = [];
                }
                $commSec->update(['content' => $commContent]);
            }

            // About
            $aboutSec = $page->sections()->where('section_key', 'about')->first();
            if ($aboutSec) {
                $aContent = $aboutSec->content ?? [];
                if ($request->filled('sections.about.title')) $aContent['title'] = $request->input('sections.about.title');
                if ($request->filled('sections.about.heading')) {
                    $aContent['heading'] = $request->input('sections.about.heading');
                    $aContent['title'] = $request->input('sections.about.heading');
                }
                if ($request->filled('sections.about.description')) $aContent['description'] = $request->input('sections.about.description');
                if ($request->filled('sections.about.video_url')) $aContent['video_url'] = $request->input('sections.about.video_url');
                if ($request->filled('sections.about.video_poster')) $aContent['video_poster'] = $request->input('sections.about.video_poster');
                if ($request->filled('sections.about.poster_image')) {
                    $aContent['poster_image'] = $request->input('sections.about.poster_image');
                    $aContent['video_poster'] = $request->input('sections.about.poster_image');
                }
                if ($request->hasFile('about_poster_file')) {
                    $file = $request->file('about_poster_file');
                    $uploadDir = public_path('images/communities');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $safeName = time() . '_about_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->move($uploadDir, $safeName);
                    $aContent['video_poster'] = '/images/communities/' . $safeName;
                    $aContent['poster_image'] = '/images/communities/' . $safeName;
                }
                $aboutSec->update(['content' => $aContent]);
            }

            // FAQ
            $faqSec = $page->sections()->where('section_key', 'faq')->first();
            if ($faqSec) {
                $fContent = $faqSec->content ?? [];
                if ($request->filled('sections.faq.title')) {
                    $fContent['title'] = $request->input('sections.faq.title');
                    $fContent['heading'] = $request->input('sections.faq.title');
                } elseif ($request->filled('sections.faq.heading')) {
                    $fContent['heading'] = $request->input('sections.faq.heading');
                    $fContent['title'] = $request->input('sections.faq.heading');
                }
                if ($request->filled('sections.faq.subtitle')) $fContent['subtitle'] = $request->input('sections.faq.subtitle');

                if ($request->has('faq_q') && is_array($request->input('faq_q'))) {
                    $qs = (array) $request->input('faq_q');
                    $as = (array) $request->input('faq_a');
                    $items = [];
                    foreach ($qs as $idx => $q) {
                        $qText = trim($q);
                        $aText = trim($as[$idx] ?? '');
                        if ($qText !== '') {
                            $items[] = ['q' => $qText, 'a' => $aText];
                        }
                    }
                    $fContent['items'] = $items;
                } elseif ($request->has('sections.faq.items') && is_array($request->input('sections.faq.items'))) {
                    $fContent['items'] = array_values(array_filter($request->input('sections.faq.items'), fn($i) => !empty(trim($i['q'] ?? ($i['question'] ?? '')))));
                }
                $faqSec->update(['content' => $fContent]);
            }

            // Contact
            $contactSec = $page->sections()->where('section_key', 'contact')->first();
            if ($contactSec) {
                $ctContent = $contactSec->content ?? [];
                if ($request->filled('sections.contact.title')) $ctContent['title'] = $request->input('sections.contact.title');
                if ($request->filled('sections.contact.subtitle')) $ctContent['subtitle'] = $request->input('sections.contact.subtitle');
                if ($request->filled('sections.contact.button_text')) $ctContent['button_text'] = $request->input('sections.contact.button_text');
                if ($request->filled('sections.contact.phone')) $ctContent['phone'] = $request->input('sections.contact.phone');
                if ($request->filled('sections.contact.email')) $ctContent['email'] = $request->input('sections.contact.email');
                $contactSec->update(['content' => $ctContent]);
            }
        }

        return redirect()->route('admin.communities.index')->with('success', "Neighbourhood/Community '{$name}' updated successfully!");
    }

    /**
     * Delete a Neighbourhood / Community and its linked Page.
     */
    public function destroy(Community $community)
    {
        $name = $community->name;
        if ($community->page) {
            $community->page->delete();
        }
        $community->delete();

        return redirect()->route('admin.communities.index')->with('success', "Neighbourhood/Community '{$name}' deleted successfully!");
    }

    /**
     * Quick status toggle.
     */
    public function updateStatus(Request $request, Community $community)
    {
        $status = $request->input('status', 'publish');
        if (!in_array($status, ['publish', 'draft', 'sold_out'])) {
            $status = 'publish';
        }
        $isActive = ($status !== 'draft');

        $community->update([
            'status'    => $status,
            'is_active' => $isActive,
        ]);

        if ($community->page) {
            $community->page->update([
                'status'       => $status,
                'is_published' => $isActive,
            ]);
        }

        return back()->with('success', "Status for '{$community->name}' updated to " . ucfirst(str_replace('_', ' ', $status)));
    }
}
