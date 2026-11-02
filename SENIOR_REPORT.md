# SENIOR & DEVOPS DATABASE / BACKEND MIGRATION REPORT
> **Hudayriyat Island Project – Live Production Safe Deployment & Audit**

This document tracks all backend updates, database schema changes, migrations, and model/controller modifications to ensure seamless deployment to live servers without corrupting live data or SEO content.

---

## 📌 1. Updated/Created Backend Files (Controllers, Models, Routes)

### Controllers:
- **`app/Http/Controllers/LeadController.php`**:
  - Enhanced telephone validation rules (`min:7|max:50`) and integrated IP/country detection support.
  - Safe against SQL injection and rejects invalid phone numbers.
- **`app/Http/Controllers/Admin/AmenityController.php`**:
  - Created dedicated CMS CRUD controller for global amenities with SVG/image icons and category tags.
- **`app/Http/Controllers/Admin/BlogController.php`**:
  - Full CRUD management for Blog articles, categories, publication statuses (`draft`/`published`), and SEO meta tags.
- **`app/Http/Controllers/Admin/CityController.php`**:
  - Controller managing City landing pages, multi-property card assignments, Summernote body content, and SEO tags.
- **`app/Http/Controllers/Admin/CommunityController.php`**:
  - Controller for Community project detail landing pages, highlights, and gallery assets.
- **`app/Http/Controllers/Admin/ProjectController.php`**:
  - Dedicated Property Cards Manager controller with 13 vertical tabs (general metrics, hero, highlights, summernote article, amenities, payment plan, FAQ, etc.).
- **`app/Http/Controllers/Admin/PageController.php`**:
  - Centralized page builder controller handling standard pages, project pages, section ordering, and dynamic hero badge parameters.
- **[`app/Http/Controllers/SitemapController.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/SitemapController.php)**:
  - Dynamic XML Sitemap generator providing `/sitemap.xml` root index and dedicated `/sitemap/page-sitemap.xml` delivering the 6 core pages (Home with priority 1.0, and Contact, About, Privacy Policy, Disclaimer, Terms with priority 0.5) with real-time `updated_at` timestamps from the database.

### Models:
- **`app/Models/Amenity.php`**: Model for site-wide reusable amenities and facility icons.
- **`app/Models/Blog.php`**: Model for Blog articles with casts for SEO and publication toggles.
- **`app/Models/City.php`**: Model for Cities with casts for `selected_project_ids` (JSON) and status fields.
- **`app/Models/Community.php`**: Model for Communities table.
- **`app/Models/Project.php`**: Model for dedicated property cards linked to `pages`.
- **`app/Models/Page.php`**: Enhanced page model with `status`, `body`, and section relations.
- **`app/Models/PageSection.php`**: Section model storing JSON content per section key.

### Helpers & Providers:
- **[`app/helpers.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/helpers.php)**:
  - Added `get_navbar_projects($currentSlug, $currentPageId)` helper to dynamically aggregate active, published projects along with core communities, while strictly excluding the currently active page/property.
- **[`app/Providers/AppServiceProvider.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Providers/AppServiceProvider.php)**:
  - Updated global view composer for `partials.header` and `layouts.app` to provide filtered `navbarProjects` utilizing `get_navbar_projects()`.

### Views & Templates:
- **[`resources/views/partials/article.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/article.blade.php)**:
  - Compact TOC & article headings: reduced H2 to 21px, H3 to 17px, line spacing to 1.55, paragraph margin-bottom to 12px.
  - Reduced TOC box padding and link spacing.
  - Sidebar "Latest Projects" widget strictly limited to 5 projects (`take(5)`) and excludes current property.
- **[`resources/views/partials/header.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/header.blade.php)**:
  - Updated desktop and mobile PROJECTS dropdown to use `get_navbar_projects()` excluding currently viewed property.
- **[`resources/views/dynamic-page.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/dynamic-page.blade.php)**:
  - Dynamic city, community, and property navigation dropdown connected to `get_navbar_projects()`.
- **[`resources/views/communities/*.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/communities)**:
  - Updated all 10 community views to render dynamic project dropdowns that exclude the currently active community page.

### Routes:
- **[`routes/web.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/routes/web.php)**:
  - Dynamic XML Sitemap routes: `GET /sitemap.xml`, `GET /sitemap` (301 redirect), `GET /sitemap/page-sitemap.xml`, `GET /page-sitemap.xml`, and `GET /sitemap/page-sitemap` (301 redirect).
  - Routes for `/api/leads` and `/api/detect-country`.
  - Admin CMS route group (`/admin/...`) for `amenities`, `blogs`, `cities`, `communities`, `projects`, and `pages`.
  - Dynamic fallback route resolving slug variants without colliding with admin routes.

---

## 📌 2. New/Modified Migrations

The following migrations have been introduced in local development that must be executed on production:

1. **`2026_10_25_160000_create_projects_table.php`** (New Table)
   - Creates the dedicated `projects` table for Property Cards.
2. **`2026_10_26_105924_add_status_to_projects_and_pages_tables.php`** (Column Addition)
   - Adds `status` (`draft`/`published`) to both `projects` and `pages` tables.
3. **`2026_10_26_115557_add_badges_to_projects_table.php`** (Column Addition)
   - Adds badge columns to `projects` table.
4. **`2026_10_27_093815_create_cities_table.php`** (New Table)
   - Creates the `cities` table for dedicated city pages.
5. **`2026_10_27_164500_create_communities_table.php`** (New Table)
   - Creates the `communities` table.
6. **`2026_10_28_110000_create_blogs_table.php`** (New Table)
   - Creates the `blogs` table for news and articles.
7. **`2026_10_28_120000_add_seo_to_blogs_table.php`** (Column Addition)
   - Adds `meta_title`, `meta_description`, `meta_keywords`, and `canonical_url` to `blogs` table.
8. **`2026_10_30_120000_create_amenities_table.php`** (New Table)
   - Creates the `amenities` table for centralized amenity icon management.
9. **`2026_11_02_120000_add_dropdown_options_to_projects_and_pages_tables.php`** (Column Addition)
   - Adds `show_in_projects` and `show_in_commercial` booleans to both `projects` and `pages` tables.

---

## 📌 3. Database Tables/Columns Changes

### New Tables:
1. **`projects`**:
   - `id`, `page_id` (foreign key to `pages`), `title`, `slug`, `location`, `price`, `handover_date`, `developer`, `payment_plan`, `image`, `is_active`, `sort_order`, `status`, `show_in_projects`, `show_in_commercial`, `badges` (JSON), `timestamps`.
2. **`cities`**:
   - `id`, `name`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `status`, `sort_order`, `selected_project_ids` (JSON), `timestamps`.
3. **`communities`**:
   - `id`, `name`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `status`, `sort_order`, `timestamps`.
4. **`blogs`**:
   - `id`, `title`, `slug`, `content`, `excerpt`, `image`, `category`, `author`, `is_published`, `status`, `published_at`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `timestamps`.
5. **`amenities`**:
   - `id`, `name`, `icon`, `category`, `sort_order`, `is_active`, `timestamps`.

### Modified Columns in Existing Tables:
1. **`projects`**:
   - Added column `show_in_projects` (boolean, default: `true`).
   - Added column `show_in_commercial` (boolean, default: `false`).
2. **`pages`**:
   - Added column `status` (enum/string: `'published'`, `'draft'`) default `'published'`.
   - Added column `body` (longText, nullable) for direct Summernote HTML content.
   - Added column `show_in_projects` (boolean, default: `true`).
   - Added column `show_in_commercial` (boolean, default: `false`).
3. **`page_sections`**:
   - `content` (JSON field): Updated hero section records to remove static hardcoded `'Freehold for All Nationalities'` badge, allowing administrators to optionally set or omit the badge text via CMS (`sections[hero][badge]`).

---

## 📋 Latest Task Log: Flag-Based Phone Validation & Hero Book Now Update

### Updated/Created Backend Files (Controllers, Models, Routes):
- **`app/Http/Controllers/LeadController.php`**:
  - Updated validation rule for `phone` to `required|string|min:7|max:50` ensuring invalid/too short inputs are rejected safely.
- **`database/seeders/PageSeeder.php`**:
  - Updated all hero section seed configurations replacing hardcoded `'badge' => 'Freehold for All Nationalities'` with `'badge' => ''` so newly seeded pages do not enforce static badges.

### New/Modified Migrations:
- *No new migration required for this task.* (Schema already accommodates optional hero section badge JSON data and lead records).

### Database Tables/Columns Changes:
- **`page_sections` Table (`content` column)**:
  - Cleaned all existing records where `section_key = 'hero'` and `badge` contained static `'Freehold for All Nationalities'`.
  - The badge is now strictly dynamic and driven by CMS input (`sections[hero][badge]`). If empty, frontend views omit the badge tag entirely.

---

## 📋 Latest Task Log: Homepage Hero Section "BOOK NOW" Button Addition

### Updated/Created Backend Files (Controllers, Models, Routes):
- *No Controller/Model/Route modifications required.*
- **Frontend & Styles Updated**:
  - `resources/views/partials/hero.blade.php`: Added the `BOOK NOW` button to Homepage Hero (`.heroBtnRow > .heroBookBtn`) matching property detail pages, smoothly scrolling and focusing the callback lead form on click.
  - `public/css/hudayriyat.css`: Added `.heroBtnRow` and `.heroBookBtn` styles matching the dark green `#1a4731` CTA button with hover elevation effects.

### New/Modified Migrations:
- *None.*

### Database Tables/Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Project Edit Context & Route Retention (/admin/projects/{id}/edit)

### Updated/Created Backend Files (Controllers, Models, Routes):
- **`app/Http/Controllers/Admin/ProjectController.php`**:
  - Updated `edit(Project $project)` method: Eliminated redirect to `/admin/pages/{id}/edit`. Directly renders the comprehensive tabbed editor at the dedicated `/admin/projects/{project}/edit` URL with `$isProjectContext = true`.
  - Updated `update(Request $request, Project $project)` method: When submitted from the full project tabbed editor, delegates update to `PageController::update` with `from_project` context and redirects back to `/admin/projects/{project}/edit`.
- **`app/Http/Controllers/Admin/PageController.php`**:
  - Updated `update(Request $request, Page $page)` method: Added check for `from_project` / project context so redirects stay at `admin.projects.edit` instead of bouncing back to `admin.pages.edit`.
- **`resources/views/admin/pages/edit.blade.php`**:
  - Made title, breadcrumbs (`Home – Projects – Manage {Project Title}`), back button (`Back to Projects` -> `admin.projects.index`), and form action (`route('admin.projects.update', $projectObj)`) fully dynamic based on project context.
- **`resources/views/admin/projects/index.blade.php`**:
  - Updated action buttons so editing either card attributes or full detail page stays within `route('admin.projects.edit', $project)`.

### New/Modified Migrations:
- *None.*

### Database Tables/Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Dynamic Sidebar Amenities Dropdown Sync (Project Highlights & Facilities)

### Updated/Created Backend Files (Controllers, Models, Routes):
- **`app/Providers/AppServiceProvider.php`**:
  - Confirmed and utilized global view composer sharing `$allAmenities` (`Amenity::where('is_active', true)->orderBy('sort_order')->get()`) across all `admin.*` Blade views.
- **`routes/web.php`**:
  - Leveraged `Route::get('/admin/api/amenities', [AdminAmenityController::class, 'listJson'])` for live asynchronous client-side synchronization.
- **Frontend & Admin Views Updated**:
  - **`resources/views/partials/highlight-icon.blade.php`**:
    - Enhanced to inline local SVG icons on-the-fly with `stroke="#ffffff"` (or `fill="#ffffff"`), 20px calibrated dimensions, and fallback to `<img>` with `filter: brightness(0) invert(1) !important` for PNG/JPG/WebP so ALL icons appear pure white (`#ffffff`) and stand out crisply on the dark green background.
  - **`resources/views/partials/highlights.blade.php` & `resources/views/partials/page-highlights.blade.php`**:
    - Embedded dedicated scoped `<style>` blocks guaranteeing `.accentCircle` is perfectly centered (`top: 50% !important; left: 50% !important; transform: translate(-50%, -50%) !important; width: 38px !important; height: 38px !important;`) and `.svgIcon` / `img` / `svg` are 20px and pure white across both homepage and community pages regardless of cache.
  - **`resources/views/layouts/app.blade.php` & `resources/views/dynamic-page.blade.php`**:
    - Injected global highlight rules into `<style id="sitewide-green-theme">` and `<style>` block ensuring no offset green circles or dark icons anywhere site-wide.
  - **All 10 Community CSS Files (`public/css/communities/*.css`)**:
    - Replaced legacy `top: 3px; right: 3px; width: 30px; height: 30px;` offset definitions with centered 38px dimensions and `#ffffff` icon styling.
  - **`resources/views/admin/projects/index.blade.php` (+ Add Property Drawer)**:
    - Updated Project Highlights: Removed extra visible Label/Name text input (now stored via hidden input), removed standard metrics from dropdown so it strictly lists sidebar amenities with icon & name, leaving only the Value text input alongside the dropdown.
    - Updated Amenities & Facilities: Removed duplicate text input completely; aligned dropdown right beside the icon in a sleek single flex row (`[Icon Preview] [Dropdown] [✕ Delete]`) with hidden icon input.
    - Embedded `window.ALL_AMENITIES` and `syncAmenitiesFromApi()` targeting `/admin/api/amenities` for dynamic real-time CRUD synchronization.
  - **`resources/views/admin/pages/edit.blade.php` (Page & Project Editor)**:
    - Updated Highlights Repeater: Dropdown strictly lists sidebar amenities (no standard metrics), removed redundant visible label input (now hidden), maintaining only the Value text input.
    - Updated Amenities & Facilities: Removed duplicate text input; rendered icon preview, dropdown selector, and delete button in a single row (`[Icon Preview] [Dropdown] [✕ Delete]`) with hidden icon input.
    - Embedded `window.ALL_AMENITIES` and `syncAmenitiesFromApi()` targeting `/admin/api/amenities`.
  - **`resources/views/communities/wadeem-gardens.blade.php` & `bashayer-villas.blade.php`**:
    - Added dynamic `page_section('amenities', 'items', null, $slug)` rendering with seamless fallback to default static items.

### New/Modified Migrations:
- *None.* (The `amenities` table and `page_sections.content` JSON schema fully support this feature).

### Database Tables/Columns Changes:
- *None.* (Stores selected amenities seamlessly in `page_sections.content` JSON `items` array under `highlights` and `amenities` sections).

---

## 📋 Latest Task Log: Amenity Rename Cascade Sync & Amenities Repeater Card Deletion Persistence

### Updated/Created Backend Files (Controllers, Models, Routes):
- **`app/Http/Controllers/Admin/AmenityController.php`**:
  - In `update(Request $request, Amenity $amenity)`: Added automatic cascading updates across all `page_sections` JSON records (`section_key` in `['highlights', 'amenities']`). When an amenity's name or icon is updated in `/admin/amenities`, existing saved page sections automatically reflect the new name and icon immediately without requiring manual re-saving of every single page.
- **`app/Http/Controllers/Admin/PageController.php`**:
  - In `update(Request $request, Page $page)`: Fixed repeater field deletion issue. When all cards in repeater sections (e.g., `amenities`, `highlights`, `floor_plans`, `payment_methods`) are deleted from the DOM, the request payload contains no `items` array. Enhanced the check to detect `_has_items` or explicit repeater section keys so that empty arrays properly overwrite and clear `$currentContent['items']` instead of preserving stale database records.
- **`app/Http/Controllers/Admin/ProjectController.php`**:
  - In `update(Request $request, Project $project)`: Updated `highlights` and `amenities` section handling to support `_has_items` and explicit empty arrays so deleted items are completely removed from database JSON.
- **`resources/views/admin/pages/edit.blade.php`**:
  - **Issue 1 Fix (Dropdown label sync)**: Added `name="sections[highlights][items][...][label]"` directly to the `<select>` dropdown and eliminated redundant hidden label inputs. This ensures submitting the form always captures the currently selected amenity name from the dropdown.
  - **Issue 2 Fix (Amenities card deletion)**: Added `<input type="hidden" name="sections[amenities][_has_items]" value="1">` inside the Amenities tab body, ensuring the server knows the section was submitted even if all cards are deleted. Implemented reliable `removeAmenityCard(btn)` using `btn.closest('.adm-card').remove()` and unique timestamped keys `am_` + Date.now().
- **`resources/views/admin/projects/index.blade.php`**:
  - Added `name="sections[highlights][items][...][label]"` directly on the highlight `<select>` and removed redundant hidden inputs.
  - Added `<input type="hidden" name="sections[amenities][_has_items]" value="1">` and updated `removeAmenityCard()` for consistent card deletion.
- **Frontend Views (`resources/views/partials/highlights.blade.php`, `resources/views/partials/page-highlights.blade.php`, `resources/views/dynamic-page.blade.php`)**:
  - Enhanced frontend highlight rendering with dynamic `Amenity` lookup fallback: if an amenity is matched by name or icon path in the `amenities` table, the frontend dynamically uses the latest amenity name and icon, ensuring instant live parity even before a page re-save.

### New/Modified Migrations:
- *None.* (Existing `amenities` and `page_sections` schema accommodates the fix).

### Database Tables/Columns Changes:
- *None.* (`page_sections.content` JSON now cleanly clears deleted repeater items and synchronizes amenity names/icons).

---

## 📋 Latest Task Log: Project Gallery Extra Fields Cleanup ("ALL" & "Exterior" Removal)

### Updated/Created Backend Files (Controllers, Models, Routes):
- *No Controller/Model/Route modifications required.*
- **Frontend & Admin Views Updated**:
  - **`resources/views/partials/project-gallery.blade.php`**:
    - Removed category tab extraction logic and the `tabNav` button bar (`ALL`, `Exterior`, etc.) rendered above the carousel.
    - All gallery photos are displayed directly in the clean centered carousel under the gallery title without extra category tabs.
  - **`resources/views/admin/projects/index.blade.php`**:
    - In Add Property drawer (`#add_tab_gallery`): Removed the extra visible Alt text input (`placeholder="Alt text (e.g. Exterior View)"`) and replaced it with a clean hidden input. Now each gallery card only has the single Image URL input alongside the thumbnail preview.
    - Updated `addAddGalleryItem()` JS function to omit the redundant visible Alt input.
  - **`resources/views/admin/pages/edit.blade.php`**:
    - Removed the hardcoded `'Exterior'` default fallback value from hidden `adm-gal-cat` inputs and dynamic JS file upload templates.

### New/Modified Migrations:
- *None.*

### Database Tables/Columns Changes:
- *None.*

---

## 📋 Latest Task Log: About Section Video Tag & Play Icon Removal Across All Pages

### Updated/Created Backend Files (Controllers, Models, Routes):
- *No Controller/Model/Route modifications required.*
- **Frontend Views Updated**:
  - **`resources/views/partials/page-about.blade.php`**:
    - Replaced the `<video poster="{{ $aboutPoster }}" ...><source ...></video>` and `<button class="GolfAboutVideo-module__mC9tiq__playButton">` play icon overlay with a clean static `<img>` element styled with `width: 100%; height: 100%; object-fit: cover; display: block; border-radius: inherit;`.
    - Automatically applies to `/hussain` and all current and future dynamically created property/community pages (`dynamic-page.blade.php`).
  - **Community Views Updated (8 Files)**:
    - `resources/views/communities/al-naseem-villas.blade.php`
    - `resources/views/communities/bashayer-residences.blade.php`
    - `resources/views/communities/bashayer-villas.blade.php`
    - `resources/views/communities/hudayriyat-golf-estates.blade.php`
    - `resources/views/communities/nawayef-east-hills.blade.php`
    - `resources/views/communities/nawayef-park-views.blade.php`
    - `resources/views/communities/nawayef-village.blade.php`
    - `resources/views/communities/wadeem-gardens.blade.php`
    - Replaced their respective `<video>` tags and `.playButton` overlays in the about section with clean, responsive `<img>` tags retaining `page_section('about', 'video_poster', ...)` and full responsive container aesthetics.
  - **Home Page (`resources/views/welcome.blade.php`)**:
    - Verified clean; does not contain any video tags or play icon buttons.

### New/Modified Migrations:
- *None.*

### Database Tables/Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Blank Property Page Creation & Hero Image Auto-Sync to Property Card

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- [PageBlueprintService.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Services/PageBlueprintService.php):
  - Changed `getDefaultSectionContent()` so that all new property sections default to completely empty strings/arrays instead of dummy placeholder data (Modon text, dummy highlight cards, dummy amenities, dummy payment plan rows, dummy FAQs).
- [ProjectController.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/ProjectController.php):
  - In `store()`: Property card image now automatically derives from the Hero background image (`$heroBgImage`), removing the redundant separate Property Image input requirement. Default fallbacks for card text (`'Freehold for All Nationalities'`, `'Exclusive Lifestyle Destination'`) removed, and `'developer'`, `'payment_plan'` set to empty/null by default.
- [PageController.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/PageController.php):
  - In `update()`: Added automatic synchronization so when the Hero background image is updated in CMS Page Builder, the linked Property Card (`projects.image`) is immediately and automatically updated.
  - Removed hardcoded `'Modon Properties'` defaults from `meta_keywords` and community items.
- [index.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/projects/index.blade.php):
  - Removed "Property Image" input block from Add Property drawer. Added informative note in Hero Banner Tab that the Hero background image automatically syncs to the property card.
- [edit.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/pages/edit.blade.php):
  - Removed "Property Card Image" input field and removed `/images/hero/slide-1.jpg` default fallback from Hero Background Image input.
- [page-hero.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/page-hero.blade.php):
  - Removed hardcoded Modon fallback subtitle; subtitle element now only renders when content is provided.
- [page-about.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/page-about.blade.php):
  - Removed default Modon description text. Section only renders on frontend when description or image has content.
- [page-highlights.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/page-highlights.blade.php):
  - Removed 5 dummy fallback items; wrapped in `@if(!empty($commHighlights))` so it only renders when real items exist.
- [dynamic-page.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/dynamic-page.blade.php):
  - Guarded amenities, floor plans, payment plan, master plan, location, and FAQ sections so they only render when user has entered actual data. No empty tables, empty headers, or dummy questions render.
- [article.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/article.blade.php):
  - Guarded entire article wrapper and style/script assets so that for any non-Saima Mangrove page without custom content, no Table of Contents box and no dummy Saima paragraphs/headings render.
- [contact.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/contact.blade.php):
  - Dynamic `project` and `developer` bindings replacing hardcoded `'Modon Properties'`.
- [page-communities.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/page-communities.blade.php):
  - Removed hardcoded `'Modon Properties'` fallback from card `aria-label`.

### 2. New / Modified Migrations:
- *None.* (Uses existing JSON content structure in `page_sections.content` and `projects.image` column).

### 3. Database Tables / Columns Changes:
- *None.* (No schema modifications; verified 100% backward compatible).

---

## 📋 Latest Task Log: Content Section & Appointment Form Conditional Visibility

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- [article.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/article.blade.php):
  - Added robust content validation stripping empty HTML tags (such as Summernote default `<p><br></p>` or `&nbsp;`) and checking for media (`<img>`, `<iframe>`, `<video>`).
  - Ensured that if the Content section is blank, the entire article container including the sticky "BOOK AN APPOINTMENT" sidebar form is completely hidden.
  - When text or media is added to the Content section in CMS, the article content and appointment sidebar form appear automatically together.
- [ProjectController.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/ProjectController.php):
  - Sanitized Summernote HTML in `store()` so empty tags (`<p><br></p>`) are saved as clean empty strings.
- [PageController.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/PageController.php):
  - Sanitized Summernote HTML in `update()` so empty tags are converted to empty strings in both `page_sections.content` and `pages.body`.

### 2. New / Modified Migrations:
- *None.*

### 3. Database Tables / Columns Changes:
- *None.*

---

## 📋 Latest Task Log: CMS Auto-Fill Bug Fix & Strict Section Visibility on UI

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- [edit.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/pages/edit.blade.php):
  - **Removed hardcoded auto-fill defaults**: Eliminated all hardcoded fallbacks that populated dummy values into form inputs when saving any page in CMS:
    - `sections[location][title]`: Changed fallback from `($page->title . ' Location & Attractions')` to `''`.
    - `sections[location][image]`: Changed fallback from `'/images/20231014_191447.webp'` to `''` for both input value and preview image.
    - `sections[master_plan]`: Removed `$page->title . ' Master Plan'`, `'Click to Enlarge'`, and `'/images/' . $page->slug . '/master-plan.png'` default fallbacks.
    - `sections[payment_plan]`: Removed `$page->title . ' Payment Plan'`, `'DOWNLOAD PAYMENT PLAN'`, and `'#'` default fallbacks.
    - `sections[floor_plans]`: Removed `$page->title . ' Floor Plan'`, `'Download Floor Plan'`, and `'#'` default fallbacks.
    - `sections[about]`: Removed `$page->title . ' by Modon'` and `video_poster` fallback paths.
    - `sections[gallery]`, `sections[amenities]`, `sections[payment_methods]`, `sections[overview_location]`, `sections[investment]`, `sections[contact]`, `sections[intro]`: Cleared all hardcoded dummy fallback strings so sections start 100% empty until user explicitly inputs data.
- [page-hero.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/page-hero.blade.php):
  - Fixed repeating background text bug: Changed `$heroBgImg` fallback from `'/hero.png'` (which contained hardcoded text baked into the graphic) to a clean text-free aerial background photo `'/images/hero/slide-1.jpg'`. This prevents background headline duplication/overlap when no custom hero banner photo is uploaded.
- [dynamic-page.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/dynamic-page.blade.php):
  - **Strict Section Rendering Rules**:
    - `location` / `overview_location`: Updated condition so the section only renders if the user actually configured attraction categories (`!empty($locCategories)`), destination items (`!empty($locItems)`), or provided both a subtitle and a verified custom graphic. If all destination categories are empty, the entire section remains hidden.
    - `master_plan`: Added file existence check (`file_exists(public_path(...))`) so broken placeholder image paths do not trigger rendering when no actual plan was uploaded.
- **Database Cleanup for Test Pages**:
  - Cleaned stray `location`, `master_plan`, and `payment_plan` dummy records from `danish` (Page ID 91) that were previously populated by form defaults.

### 2. New / Modified Migrations:
- *None.*

### 3. Database Tables / Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Complete Removal of Floating WhatsApp Widget Across All Pages

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- [app.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/layouts/app.blade.php):
  - Completely deleted the fixed floating WhatsApp widget element (`#floatingWhatsappWidget`) along with its animated ping circle, badge, SVG icon, "Contact us for details" pill, and responsive CSS stylesheet.
  - Verified that all pages extending the main application layout (Homepage `/`, `/about-us`, `/privacy-policy`, `/terms-and-conditions`, `/disclaimer`, `/blogs`) and dynamic community/project pages now render cleanly without the bottom-left floating WhatsApp button.

### 2. New / Modified Migrations:
- *None.*

### 3. Database Tables / Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Dynamic Navbar Projects Dropdown, Payment Plan Fixes & CMS Fields Cleanup

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- [helpers.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/helpers.php):
  - **Dynamic Dropdown**: Removed hardcoded `$coreCommunities` array from `get_navbar_projects()`.
  - The navbar dropdown now exclusively loads genuine, published property records from the `projects` table (`Project::with('page')->where('is_active', true)->...`).
  - Whichever property or community page the user is currently viewing is strictly excluded from the dropdown list.
- [dynamic-page.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/dynamic-page.blade.php):
  - **Payment Plan `<p>` Tag Fix**: Replaced HTML-escaped `{{ $payDesc }}` inside `<p>` with unescaped `{!! $payDesc !!}` inside a wrapper `<div>`, preventing Summernote paragraphs from printing literal `<p>` characters on the frontend.
  - **Default Download Button**: Updated the payment plan section so that whenever milestone rows are configured, a default "DOWNLOAD PAYMENT PLAN" button is rendered automatically (triggering the contact inquiry modal / smooth scrolling to `#contact`).
- [communities/*.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/communities):
  - Updated all 9 community templates (`wadeem-gardens`, `wadeem-plots`, `nawayef-village`, `nawayef-park-views`, `nawayef-east-hills`, `hudayriyat-golf-estates`, `bashayer-villas`, `bashayer-residences`, `al-naseem-villas`) to render `$payDesc` with `{!! $payDesc !!}` cleanly without literal `<p>` tags.
- [edit.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/pages/edit.blade.php):
  - **Payment Plan CMS Fields Cleanup**: Deleted redundant inputs: `sections[payment_plan][plan_tabs]` (Plan Tabs), `sections[payment_plan][download_text]` (Download Button Text), `sections[payment_plan][download_url]` (Download Brochure URL), and `section_files[payment_plan][download_file]` (Choose File upload).
  - **About Community CMS Cleanup**: Deleted extra input `sections[about][video_url]` (Featured Video Stream URL).
- [index.blade.php (Projects)](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/projects/index.blade.php):
  - Removed `sections[about][video_url]` input from the "Add Property" modal to guarantee that newly added properties follow the exact same clean schema.
- [PageBlueprintService.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Services/PageBlueprintService.php):
  - Removed default keys `'video_url'` and `'plan_tabs'` from blueprint schema generation so newly instantiated property pages remain clean.

### 2. New / Modified Migrations:
- *None.*

### 3. Database Tables / Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Home Page Green Headings & Matching TOC Heading Sizes

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- [hudayriyat.css](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/public/css/hudayriyat.css):
  - Updated Home page section title `.section-header h2` to theme forest green `#1a4731` (previously `#2e3135`).
  - Updated Home page article / overview headings (`.overviewMainTitle`, `.overviewSubHeading`, `.blogContainer h1/h2/h3/h4`, `.overviewSection h1/h2/h3/h4`) to `#1a4731 !important`.
- [island-overview.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/island-overview.blade.php):
  - Added dedicated green color styles inside `<style>` block to guarantee all dynamic Summernote headings in the Home page article render with `#1a4731 !important`.
- [article.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/article.blade.php):
  - **TOC Heading Sizes Match**: Synchronized property article headings (`.saimaH2, .saimaContentCol h2, .saimaDynamicArticleContent h2`) to `26px !important` (font-weight: 700, line-height: 1.35), making them dicto identical to the Home page H2 heading size.
  - Updated H3 to `20px !important` (font-weight: 700, line-height: 1.4) and H4 to `17px !important` (font-weight: 700, line-height: 1.4) to match Home page H3/H4.
  - Updated `.saimaTocTitle` ("Table of Contents") to theme green `#1a4731` and `18px`.

### 2. New / Modified Migrations:
- *None.*

### 3. Database Tables / Columns Changes:
- *None.*

---

## 📋 Latest Task Log: Commercial Navbar Dropdown & Property Placement Checkboxes (Projects / Commercial)

### 1. Updated / Created Backend Files (Controllers, Models, Routes):
- **[`routes/web.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/routes/web.php)**:
  - Added public API endpoint `/api/navbar-items`: Accepts `current_slug` or `current_page_id` query parameters and returns JSON payload `{ projects: [...], commercial: [...] }` with active properties properly categorized and the active property strictly excluded.
- **[`app/Models/Project.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Models/Project.php)**:
  - Added `show_in_projects` and `show_in_commercial` to `$fillable`.
  - Added `show_in_projects` and `show_in_commercial` boolean casts to `$casts`.
- **[`app/Models/Page.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Models/Page.php)**:
  - Added `show_in_projects` and `show_in_commercial` to `$fillable`.
  - Added `show_in_projects` and `show_in_commercial` boolean casts to `$casts`.
- **[`app/helpers.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/helpers.php)**:
  - Added generalized `get_navbar_items($type = 'projects', $currentSlug = null, $currentPageId = null)` helper that queries published, active properties filtering by `show_in_projects` or `show_in_commercial`, while strictly filtering out the current property by slug, normalized slug, and page ID.
  - Refactored `get_navbar_projects()` to call `get_navbar_items('projects', $currentSlug, $currentPageId)`.
  - Added `get_navbar_commercial($currentSlug = null, $currentPageId = null)` helper calling `get_navbar_items('commercial', $currentSlug, $currentPageId)`.
- **[`app/Providers/AppServiceProvider.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Providers/AppServiceProvider.php)**:
  - Updated global View Composer for `partials.header` and `layouts.app` to supply both `$navbarProjects` and `$navbarCommercial`.
- **[`app/Http/Controllers/Admin/ProjectController.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/ProjectController.php)**:
  - Updated `store()` to validate `show_in_projects` and `show_in_commercial` (boolean), persist them on the new `Project` record, and synchronize them to the linked `Page` model.
  - Updated `update()` to validate and persist `show_in_projects` and `show_in_commercial` on both `Project` and linked `Page`.
- **[`app/Http/Controllers/Admin/PageController.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/PageController.php)**:
  - Updated `update()` to validate and persist `show_in_projects` and `show_in_commercial` on `Page`, and synchronize them to any linked `Project` record.
- **[`resources/views/admin/projects/index.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/projects/index.blade.php)**:
  - In "+ Add Property" modal General Settings tab: Added checkboxes for `Show in Projects Dropdown` (checked by default) and `Show in Commercial Dropdown`.
  - In "Edit Property Card" modal: Added checkboxes for `Show in Projects Dropdown` and `Show in Commercial Dropdown`.
  - In `openEditModal(project)` JavaScript function: Populates both checkboxes dynamically from project data.
- **[`resources/views/admin/pages/edit.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/pages/edit.blade.php)**:
  - In General tab: Added checkboxes for `Show in Projects Dropdown` and `Show in Commercial Dropdown`.
- **Blade Navbar Views**:
  - **[`resources/views/partials/header.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/partials/header.blade.php)**: Added Commercial dropdown beside Projects in desktop navigation, mobile drawer collapsible Commercial menu, and click/hover/backdrop/toggle JS handlers.
  - **[`resources/views/dynamic-page.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/dynamic-page.blade.php)**: Added Commercial dropdown beside Projects on desktop and mobile drawer, with CSS hover display rules and active page omission.
  - **[`resources/views/communities/*.blade.php`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/communities)**: Dynamically connected all 10 dedicated community templates (`al-naseem-villas`, `bashayer-residences`, `bashayer-villas`, `hudayriyat-golf-estates`, `masyaf-plots`, `nawayef-east-hills`, `nawayef-park-views`, `nawayef-village`, `wadeem-gardens`, `wadeem-plots`) to `get_navbar_projects()` and `get_navbar_commercial()`, rendering both Projects and Commercial dropdowns on desktop and mobile with active property exclusion.
- **Client-Side Scripts & Styles**:
  - **[`public/js/communities/community-interactions.js`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/public/js/communities/community-interactions.js)**:
    - Updated `initCommunitiesDropdown()`: Added `btnText.includes('COMMERCIAL')` to desktop dropdown event listeners (`mouseenter`, `mouseleave`, `click`).
    - Added explicit inline visibility rules (`display: block !important`, `opacity: 1 !important`, `visibility: visible !important`, `pointer-events: auto !important`) on dropdown display.
    - Updated mobile drawer navigation: Added click toggling and chevron animation for the `Commercial` submenu.
  - **[`public/css/communities/global.css`](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/public/css/communities/global.css)**:
    - Added universal CSS `:hover` selectors for all navbar item variations: `li[class*="navItem"]:hover > [class*="dropdownMenu"]`, `.navItem:hover > .dropdownMenu`, `li:hover > [class*="dropdownMenu"]`.

### 2. New / Modified Migrations:
- **`2026_11_02_120000_add_dropdown_options_to_projects_and_pages_tables.php`**:
  - Adds `show_in_projects` (boolean, default: `true`, after `status`) and `show_in_commercial` (boolean, default: `false`, after `show_in_projects`) to the `projects` table.
  - Adds `show_in_projects` (boolean, default: `true`, after `status`) and `show_in_commercial` (boolean, default: `false`, after `show_in_projects`) to the `pages` table.
  - Fully migrated on local database (`php artisan migrate` completed successfully).

### 3. Database Tables / Columns Changes:
- **`projects` Table**:
  - Added column `show_in_projects` (`TINYINT(1)`, default: `1`)
  - Added column `show_in_commercial` (`TINYINT(1)`, default: `0`)
- **`pages` Table**:
  - Added column `show_in_projects` (`TINYINT(1)`, default: `1`)
  - Added column `show_in_commercial` (`TINYINT(1)`, default: `0`)


### 4. Hero Heading Typography Parity (Home Page Matching on All Property Pages)
- **Problem**:
  - Previously, property pages (e.g. `http://127.0.0.1:8000/hasan` or any newly created property/community page) used `.GolfHero-module__9JtUKq__title` or community-specific CSS modules where the hero `<h1>` title was hardcoded to `52px` with `font-weight: 800`.
  - This caused the heading ("Wadeem Gardens at Hudayriyat Island") to be excessively large, unwieldy, and wrap across 3 lines compared to the balanced Home page hero heading.
- **Home Page Reference Typography (`public/css/hudayriyat.css`)**:
  - `font-size: clamp(32px, 3.8vw, 46px)`
  - `font-weight: 700`
  - `line-height: 1.22`
  - `letter-spacing: -0.015em`
  - `text-shadow: 0 2px 10px rgba(0, 0, 0, 0.45)`
  - `margin-bottom: 18px`
  - Responsive: `36px` on tablet (`<= 991px`), `30px` on mobile (`<= 576px`)
  - Subtitle: `font-size: clamp(15px, 1.35vw, 18px); font-weight: 400; line-height: 1.55; margin-bottom: 16px;`
- **Implemented Fixes**:
  1. **`public/css/communities/hudayriyat-golf-estates.css`**:
     - Updated `.GolfHero-module__9JtUKq__title` to `font-size: clamp(32px, 3.8vw, 46px); font-weight: 700; line-height: 1.22;` with `36px` on mobile/tablet.
     - Updated `.GolfHero-module__9JtUKq__subtitle` to `clamp(15px, 1.35vw, 18px)`.
  2. **`public/css/communities/global.css`**:
     - Added global fallback rules under `UNIVERSAL HERO TYPOGRAPHY (MATCHING HOME PAGE HERO)`:
       - Applied `clamp(32px, 3.8vw, 46px) !important`, `font-weight: 700 !important`, `line-height: 1.22 !important`, and responsive queries across `.GolfHero-module__9JtUKq__title`, `[class*="Hero-module__"][class*="__title"]`, and `.heroTitle`.
       - Standardized all community hero subtitles to `clamp(15px, 1.35vw, 18px) !important`.
  3. **`resources/views/dynamic-page.blade.php`**:
     - Injected scoped CSS ensuring any dynamic page or newly created property enforces the exact Home page hero typography regardless of cached stylesheets.
  4. **`resources/views/partials/page-hero.blade.php`**:
     - Added helper classes `heroTitle` and `heroSubtitle` to `<h1 class="GolfHero-module__9JtUKq__title heroTitle">` and `<p class="GolfHero-module__9JtUKq__subtitle heroSubtitle">` for universal style targeting across all pages.

### 5. Universal Contact Form, Auto Country Flag Detection & Dynamic Phone Validation
- **Requirement & Problem**:
  - Previously, the contact form below the FAQ section on dynamic pages (`dynamic-page.blade.php`, e.g., `/hasan`, `/hussain`, Cities, Community, Blog) had non-functioning flag dropdowns because the script was only declared inside `layouts/app.blade.php`.
  - Community templates had 150KB of dead static HTML containing broken dropdowns without CSRF tokens or working submission.
  - The dropdown only had 15 hardcoded countries instead of all worldwide countries sorted alphabetically.
  - There was no strict numbers-only typing restriction and no dynamic adaptation to each country's phone length/format.
- **Implemented Architecture**:
  1. **Comprehensive 218 Countries Dataset (`public/js/countries-data.json` & `public/js/universal-phone-selector.js`)**:
     - Contains all 218 countries worldwide, sorted strictly alphabetically (A to Z) from Afghanistan (+93) to Zimbabwe (+263).
     - Each entry specifies: Country Name, 2-letter ISO code, Dial Code, Min Digits, Max Digits, and dynamic Placeholder.
     - Uses high-performance FlagCDN images (`https://flagcdn.com/w40/{code}.png`).
  2. **Instant Auto-Detection (Timezone + IP Geolocation)**:
     - Detects user's country instantly with 0ms delay via client timezone (`Intl.DateTimeFormat().resolvedOptions().timeZone`) with mapping across 40+ global regions.
     - Performs non-blocking asynchronous IP check via `https://api.country.is` (fallback: `ipapi.co`) and caches in `sessionStorage`.
     - Automatically selects and displays the user's detected country flag and dial code by default.
  3. **Alphabetical Dropdown with Real-Time Search**:
     - Clicking the flag opens a dropdown containing all 218 countries in alphabetical order (A, B, C...).
     - Sticky search input (`.countrySearchInput`) allows typing country name or dial code (e.g. `+971`, `pak`, `unit`, `saud`) to filter instantly.
     - Clicking any country switches the active country globally across all phone fields.
  4. **Strict Numbers-Only Enforcement & Dynamic Validation**:
     - Non-numeric characters (letters, symbols) are blocked on `keydown`, `input`, and `paste`.
     - Preserves the selected country's dial code prefix (e.g. `+971 ` or `+92 `).
     - Dynamically adapts input placeholder, max length, and validation rules to the selected country's specific digit requirements (e.g., 9 digits for UAE, 10 for Pakistan/USA/India, 8 for Qatar/Kuwait/Oman/Bahrain).
     - Intercepts form submission and displays native browser validation messages (`reportValidity()`) if the phone number length is invalid.
  5. **Global Site-Wide Deployment**:
     - Contact Section below FAQ on all pages (`partials/contact.blade.php`).
     - Dynamic pages (`dynamic-page.blade.php` for Cities, Community, Custom Pages like `/hasan`).
     - All 10 Community Blade templates (`resources/views/communities/*.blade.php`) - replaced dead static 151KB blocks with `@include('partials.contact')` and loaded `universal-phone-selector.js`.
     - Home page hero callback form (`partials/hero.blade.php`).
     - List Your Property modal (`layouts/app.blade.php`).
     - Dedicated Contact Us page (`contact-us.blade.php`).
     - About Us page (`about-us.blade.php`).
     - Sidebar appointment forms (`partials/article.blade.php`, `partials/page-article.blade.php`, `blogs/show.blade.php`).
     - Blog details page (`blogs/show.blade.php`) - added contact section below FAQ.


  6. **UI Bug Fixes & Dropdown Interaction Hardening**:
     - **Resolved Raw Text Bug**: In `resources/views/partials/contact.blade.php`, an erroneous early `</script>` tag was closed after the loader routine, leaving the `contactLeadForm` submit listener outside of `<script>` tags and rendering raw code text onto the UI beneath the contact form card. Removed the stray tag so that all scripts remain properly encapsulated.
     - **Fixed Flag Click & Dropdown Visibility**: In `public/css/communities/global.css`, the universal navbar dropdown rule `[class*="dropdownMenu"]` was broadly matching `.countryDropdownMenu` and enforcing `opacity: 0` and `visibility: hidden`. Excluded `.countryDropdownMenu` from this selector and added explicit active states (`.dropdownOpen`, `.isOpen`) with `pointer-events: none` on inner flag/caret child elements. Clicking the flag now reliably opens the 218-country searchable dropdown with instant visual responsiveness.

  7. **Duplicate Dropdown Fix in Appointment Forms**:
     - **Issue**: In `BOOK AN APPOINTMENT` sidebar forms (e.g. in `resources/views/partials/page-article.blade.php`, `article.blade.php`, and `blogs/show.blade.php`), the input was already structured inside a `phoneUnifiedContainer`. An auto-discovery loop in `public/js/universal-phone-selector.js` was erroneously injecting a second nested `phoneUnifiedContainer` beside the existing trigger button, causing two side-by-side dropdown buttons to render on the UI.
     - **Fix**: Added a guard condition `if (input.closest('.phoneUnifiedContainer') || input._phoneInstance) return;` so that inputs already encased in unified containers are never duplicated. Verified on live pages that exactly one clean flag trigger button and dropdown are rendered.


   8. **Site-Wide n8n Webhook & Lead Automation Integration**:
      - **Objective**: Connect every lead capture form on the website (Contact sections, Hero callback, Appointment sidebars, List Your Property modal, Contact Us, About Us, Community pages) to an external n8n webhook endpoint via HTTP POST with header authentication and strict JSON schema compliance.
      - **Webhook Endpoint**: `https://n8n.srv1625508.hstgr.cloud/webhook/979a4b97-a515-4ee0-96e3-5d0ddb475e99`
      - **Authentication Header**: Header Auth verified with raw token format `Authorization: fsa_n8n_secret_token_2026_x99a` (along with redundant `X-Token` and `token` headers).
      - **Required JSON Payload Architecture**:
```json
{
  "name": "{{ $json.body.name }}",
  "phone": "{{ $json.body.phone }}",
  "email": "{{ $json.body.email }}",
  "source": "{{ $json.body.source || '' }}",
  "sub_source": "{{ $json.body.sub_source || '' }}",
  "utm_campaign": "{{ $json.body.utm_campaign || '' }}",
  "campaign_url": "{{ $json.body.campaign_url || '' }}",
  "project": "{{ $json.body.project || '' }}",
  "developer": "{{ $json.body.developer || '' }}",
  "community": "{{ $json.body.community || '' }}",
  "property_type": "{{ $json.body.property_type || '' }}",
  "key_requirement": "{{ $json.body.key_requirement || '' }}",
  "activity_description": "{{ $json.body.activity_description || '' }}"
}
```
      - **Centralized Dispatcher (`app/Http/Controllers/LeadController.php`)**:
        - All website forms route to `POST /api/leads` handled by `LeadController@store`.
        - Centralized webhook dispatch inside `LeadController::dispatchToN8n(array $payload)`.
        - Uses Laravel's `Http::withHeaders(...)->withoutVerifying()->timeout(10)->post(...)` with try-catch resilience so external webhook latency or outages never disrupt user UX or database storage.
        - Persists all lead entries to MySQL `leads` table for Admin Dashboard visibility while transmitting payload simultaneously to n8n.
        - Logs status and response details to `storage/logs/laravel.log`.
      - **Configuration & Secrets**:
        - Added `N8N_WEBHOOK_URL` and `N8N_WEBHOOK_TOKEN` to `backend/.env`.
        - Configured `'n8n'` service block in `backend/config/services.php`.
      - **Enriched Form Metadata Across All Templates**:
        - `partials/contact.blade.php`: Sends source, sub_source, utm_campaign, campaign_url, community, property_type, key_requirement.
        - `partials/hero.blade.php`: Sends source, sub_source, utm_campaign, campaign_url, developer, community, property_type, key_requirement, activity_description.
        - `partials/page-article.blade.php` & `partials/article.blade.php`: Sends appointment metadata, project context, and user comment as key_requirement.
        - `blogs/show.blade.php`: Sends blog appointment metadata and campaign URL.
        - `layouts/app.blade.php`: Appends listing metadata, property type, and seller specifications to FormData.
        - `contact-us.blade.php` & `about-us.blade.php`: Sends channel metadata and user message as key_requirement.
        - `public/js/communities/community-interactions.js`: Sends community metadata.
      - **End-to-End Live Verification**:
        - Verified all 4 distinct form types via automated live test script:
          1. General Contact Section -> HTTP 200 {"message":"Workflow was started"}
          2. Book An Appointment Sidebar -> HTTP 200 {"message":"Workflow was started"}
          3. Homepage Hero Callback -> HTTP 200 {"message":"Workflow was started"}
          4. List Your Property Modal -> HTTP 200 {"message":"Workflow was started"}

   9. **Lead Payload Defaults Update (sub_source & campaign_url)**:
      - As per specific client/boss requirements for CRM routing:
        - `sub_source` is strictly configured and dispatched as `"saima project"` across all website forms.
        - `campaign_url` is strictly configured and dispatched as `"https://saimaprojects.com/"`.
      - Updated across backend controller (`LeadController.php`) and all frontend views/scripts (`partials/contact.blade.php`, `partials/hero.blade.php`, `partials/page-article.blade.php`, `partials/article.blade.php`, `blogs/show.blade.php`, `layouts/app.blade.php`, `contact-us.blade.php`, `about-us.blade.php`, and `public/js/communities/community-interactions.js`).
      - Verified live with n8n HTTP 200 `{"message":"Workflow was started"}`.

   10. **Dynamic XML Sitemap Architecture (`/sitemap.xml` & `/sitemap`)**:
      - **Objective**: Automatically generate a search-engine-compliant XML sitemap dynamically pulling all published pages, projects, cities, communities, blogs, and core routes from the MySQL database with zero manual intervention.
      - **Endpoints**:
        - `GET /sitemap.xml`: Responds with `Content-Type: application/xml; charset=utf-8` and caching header (`public, max-age=3600`).
        - `GET /sitemap`: 301 permanent redirect pointing directly to `/sitemap.xml`.
      - **Controller**: `App\Http\Controllers\SitemapController@index`
      - **Automated Data Discovery (Dynamic Database Synchronization)**:
        1. **Core Static Pages**:
           - Home (`/`) [Priority: 1.0, Changefreq: daily]
           - About Us (`/about-us`) [Priority: 0.8, Changefreq: monthly]
           - Contact Us (`/contact-us`) [Priority: 0.9, Changefreq: monthly]
           - Blog Archive (`/blogs`) [Priority: 0.8, Changefreq: daily]
           - Legal Pages (`/privacy-policy`, `/terms-and-conditions`, `/disclaimer`) [Priority: 0.3, Changefreq: yearly]
        2. **Published Pages (`pages` table)**:
           - Automatically fetches all pages where `is_published = 1` and `status != 'draft'` (e.g. `/hasan`, `/lahore`, `/karachi`, `/punjab`).
           - Discards duplicates of core routes. Includes dynamic `updated_at` ISO lastmod timestamp.
        3. **Published Projects (`projects` table & luxury community templates)**:
           - Automatically fetches all active project cards where `is_active = 1` and `status != 'draft'` (e.g. `/wadeem-gardens`, `/hasan`).
           - Also includes all 10 luxury community project templates (`/hudayriyat-golf-estates`, `/bashayer-residences`, `/bashayer-villas`, `/al-naseem-villas`, `/nawayef-east-hills`, `/masyaf-plots`, `/nawayef-village`, `/wadeem-plots`, `/nawayef-park-views`) [Priority: 0.9, Changefreq: weekly].
        4. **Published Cities (`cities` table)**:
           - Automatically queries all active cities (`is_active = 1`, `status != 'draft'`).
        5. **Published Communities (`communities` table)**:
           - Automatically queries all active neighbourhoods (`is_active = 1`, `status != 'draft'`, e.g. `/jamshed-road-number`).
        6. **Published Blogs (`blogs` table)**:
           - Automatically queries all published blog articles where `is_published = 1` and `status = 'publish'`. Formats as `/blog/{slug}` [Priority: 0.7, Changefreq: weekly].
      - **Robots.txt Directive**:
        - Updated `public/robots.txt` to disallow internal admin and api routes (`/admin/`, `/api/`) and expose `Sitemap: https://saimaprojects.com/sitemap.xml`.
      - **Verification**:
        - Live tested via HTTP curl: returned HTTP 200 with valid XML structure, XML encoding, and complete URL set.

   11. **Global Hero Section: "BOOK NOW" Button Red Color Update**:
      - **Objective**: Change the background color of the "BOOK NOW" CTA button in all hero sections across the entire website from theme green (`#1a4731`) to bold brand red (`#d9232d`).
      - **Styling Applied**:
        - Normal State: `background-color: #d9232d !important;`, `color: #ffffff;`, `box-shadow: 0 4px 12px rgba(217, 35, 45, 0.35) !important;`
        - Hover State: `background-color: #b71a23 !important;`, `transform: translateY(-2px);`, `box-shadow: 0 6px 18px rgba(217, 35, 45, 0.5) !important;`
      - **Files Updated**:
        - `public/css/hudayriyat.css`: Updated `.heroBookBtn` & `.heroBookBtn:hover`.
        - `resources/views/layouts/app.blade.php`: Enforced global rule across all hero buttons (`.heroBookBtn`, `[class*="heroSection"] [class*="brochureBtn"]`, `[class*="Hero"] [class*="brochureBtn"]`).
        - `public/css/communities/global.css`: Enforced global community hero button red background.
        - `resources/views/dynamic-page.blade.php`: Injected scoped hero button red background rule.
        - All 10 community CSS stylesheets in `public/css/communities/` (`hudayriyat-golf-estates.css`, `al-naseem-villas.css`, `wadeem-gardens.css`, etc.).
      - **Verification**:
        - Verified live on `http://127.0.0.1:8000/`: computed background color is `#d9232d !important`.

   12. **Admin CMS Edit Form: In-Place Save & Active Section Retention**:
      - **Problem**: In the CMS admin panel (e.g. `http://127.0.0.1:8000/admin/cities/2/edit` or `/admin/communities/{id}/edit`), clicking "Save Changes" executed `return redirect()->route('admin.cities.index')` or `admin.communities.index`. This kicked administrators out of their edit screen back to the list table page, losing their active section context and requiring them to navigate back and find the tab again.
      - **User Requirement**: When clicking "Save Changes", the editor must stay on the SAME edit page and on the EXACT SAME tab/section where changes were made (`jis section pr save change kiya to usi section pr rahe ga`). The user should only go back when explicitly clicking the "Back" button (`jb me chao to me back jaoga otherwise ye khud se nhi jaye ga`).
      - **Root Cause & Technical Resolution**:
        1. **City Controller (`app/Http/Controllers/Admin/CityController.php`)**:
           - Replaced `return redirect()->route('admin.cities.index')` with:
             ```php
             $activeTab = $request->input('active_tab', $request->query('tab', 'general'));
             return redirect()->route('admin.cities.edit', ['city' => $city->id, 'tab' => $activeTab])
                 ->with('success', "City '{$name}' updated successfully! Changes are saved.");
             ```
        2. **City Edit Blade View (`resources/views/admin/cities/edit.blade.php`)**:
           - Added hidden input `<input type="hidden" name="active_tab" id="active_tab_input" value="{{ $currentTab }}">`.
           - Dynamically bound active state on tab buttons: `class="adm-tab {{ $currentTab === 'content' ? 'is-active' : '' }}"`.
           - Dynamically bound active state on panes: `class="tab-pane {{ $currentTab === 'content' ? 'active' : '' }}"`.
           - Enhanced `switchEditTab(tabId)` to sync `#active_tab_input.value = tabId` and update browser history URL with `?tab={tabId}` via `history.replaceState`.
           - Added `DOMContentLoaded` listener to auto-activate the tab from the URL query parameter upon reload or save.
        3. **Neighbourhood / Community Controller & View (`app/Http/Controllers/Admin/CommunityController.php` & `resources/views/admin/communities/edit.blade.php`)**:
           - Applied identical in-place redirect architecture: `return redirect()->route('admin.communities.edit', ['community' => $community->id, 'tab' => $activeTab])`.
           - Updated blade tabs, panes, hidden input, and `switchEditTab` logic.
        4. **Blog Controller (`app/Http/Controllers/Admin/BlogController.php`)**:
           - Updated `update()` to redirect to `route('admin.blogs.index', ['id' => $blog->id])` so blog editing remains open in edit mode after saving.
      - **Verification**:
        - Live tested via test runner: PUT update with `active_tab=content` on City ID 2 returned HTTP 302 redirecting to `http://localhost/admin/cities/2/edit?tab=content`.
        - Verified that subsequent GET request to edit page renders `edit_tab_content` as the active pane and sets hidden `active_tab` input to `content`.
        - Verified Community update with `active_tab=faq` returned HTTP 302 redirecting to `http://localhost/admin/communities/{id}/edit?tab=faq`.

   13. **Universal Property URLs Restructuring (`/project/{slug}`) & Automatic 301 Redirects**:
       - **Client Requirement**:
         - Previous Property URL format: `http://127.0.0.1:8000/wadeem-gardens`
         - Required Property URL format: `http://127.0.0.1:8000/project/wadeem-gardens`
         - Scope: Applies to **every** single property/project across the platform (`/ ke baad project lagaye ga then endpoint ajayega`).
       - **Routing Architecture (`routes/web.php`)**:
         - Created explicit `/project/{slug}` route:
           - Handles slug formatting, underscore replacements (e.g. `wadeem_gardens` -> `wadeem-gardens`), and canonical redirects.
           - Checks published DB pages (`Page` model) and active DB projects (`Project` model).
           - Checks static luxury community templates (`resources/views/communities/{slug}.blade.php`).
           - Renders appropriate dynamic or community blade views, or throws 404 for nonexistent/unpublished pages.
         - Updated root catch-all `/{slug}` route:
           - If `$isProjectSlug` is detected (`Page::projectSlugs()`, `Project::where('slug')`, or community templates), automatically triggers a **`301 Moved Permanently`** HTTP redirect to `/project/{slug}`.
           - All other website routes (Cities `/lahore`, Communities `/jamshed-road-number`, General Pages `/about-us`, Blogs `/blog/{slug}`) preserve their existing standard URLs without interference.
         - Added `/project` base route redirecting seamlessly to `/#communities`.
       - **Models, Helpers & Views Updates**:
         - **`app/Models/Project.php`**: Updated `getUrlAttribute()` accessor to dynamically generate `/project/{slug}`.
         - **`app/helpers.php`**: Updated `get_navbar_items()` so all dropdown property links output `/project/{slug}`. Updated exclusion logic to strip `project/` from active request paths so the currently viewed property is properly omitted from dropdowns.
         - **`resources/views/partials/communities.blade.php` & `page-communities.blade.php`**: Updated all community card links to `/project/{slug}`.
         - **`resources/views/partials/article.blade.php` & `blogs/show.blade.php`**: Updated sidebar "Latest Projects" card links to `/project/{slug}`.
         - **`app/Models/FooterSection.php`**: Updated default footer property links to `/project/{slug}`.
         - **`app/Http/Controllers/SitemapController.php`**: Updated XML sitemap generation so all project and community URLs are emitted under `/project/{slug}` (e.g. `<loc>https://saimaprojects.com/project/wadeem-gardens</loc>`).
         - **Admin Panel Live Previews**: Updated `admin/pages/edit.blade.php` ("View Live Page" button and top Page URL banner) and `admin/projects/index.blade.php` to display `/project/{slug}`.
       - **Verification & Testing (`scratch/test_project_routing.php`)**:
         - Direct Access `GET /project/wadeem-gardens` -> HTTP 200 (Success)
         - Direct Access `GET /project/hudayriyat-golf-estates` -> HTTP 200 (Success)
         - Legacy Redirect `GET /wadeem-gardens` -> HTTP 301 to `http://localhost/project/wadeem-gardens` (Success)
         - Underscore Redirect `GET /wadeem_gardens` -> HTTP 301 to `http://localhost/project/wadeem-gardens` (Success)
         - Non-project safety `GET /contact-us`, `GET /about-us`, `GET /lahore` -> HTTP 200 (No redirection, Success)
         - Model accessor `Project::first()->url` -> `http://localhost/project/wadeem-gardens` (Success)
         - Navigation helper `get_navbar_projects()` URLs -> `/project/wadeem-gardens` (Success)
         - Dynamic Sitemap `GET /sitemap.xml` -> `<loc>https://saimaprojects.com/project/wadeem-gardens</loc>` (Success)

   14. **City & Community URL Prefixes Restructuring (`/city/{slug}` & `/area/{slug}`)**:
       - **Requirements**:
         - All City pages (existing and future): `http://127.0.0.1:8000/city/{endpoint}` (e.g. `/city/lahore`, `/city/karachi`, `/city/punjab`).
         - All Community/Neighbourhood pages (existing and future): `http://127.0.0.1:8000/area/{endpoint}` (e.g. `/area/jamshed-road-number`).
         - Legacy URLs (e.g. `/lahore` or `/jamshed-road-number`) must issue a **301 Moved Permanently** redirect to `/city/lahore` and `/area/jamshed-road-number`.
         - Explicit Client Request: `sitemap.xml` was intentionally untouched (`sitemap.xml ka kuch bhi nhi kerna us ka me baad me karoga`).
       - **Routing Implementation (`routes/web.php`)**:
         - Dedicated City Route: `Route::get('/city/{slug}')` with underscore redirect support and City/Page lookup.
         - Dedicated Area Route: `Route::get('/area/{slug}')` with underscore redirect support and Community/Page lookup.
         - Catch-All Route `/{slug}`:
           - Automatically detects whether slug is a project, city, or community.
           - If City: 301 redirects to `/city/{slug}`.
           - If Community: 301 redirects to `/area/{slug}`.
           - If Project: 301 redirects to `/project/{slug}`.
           - Reserved route isolation ensures `/admin/`, `/project/`, `/city/`, `/area/`, and `/blog/` are never intercepted.
       - **Models Updated**:
         - [City.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Models/City.php): `$city->url` accessor updated to dynamically format as `/city/{slug}`.
         - [Community.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Models/Community.php): `$community->url` accessor updated to dynamically format as `/area/{slug}`.
       - **CMS Admin Controllers & Views**:
         - [CityController.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/CityController.php): `store()` and `update()` strip any leading `city/` prefix from input slug.
         - [CommunityController.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/app/Http/Controllers/Admin/CommunityController.php): `store()` and `update()` strip any leading `area/` prefix from input slug.
         - [admin/cities/index.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/cities/index.blade.php): Page URL preview, slug field prefix, table listing slug badge, and "View Public Page" action button updated to `/city/`.
         - [admin/cities/edit.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/cities/edit.blade.php): "View City Page" button, top Live URL banner, and slug field prefix updated to `/city/`.
         - [admin/communities/index.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/communities/index.blade.php): Page URL preview, slug field prefix, table listing slug badge, and "View Public Page" action button updated to `/area/`.
         - [admin/communities/edit.blade.php](file:///c:/Users/Administrator/Desktop/hudayriayt_git/backend/resources/views/admin/communities/edit.blade.php): "View Community Page" button, top Live URL banner, and slug field prefix updated to `/area/`.
       - **Live Verification (`scratch/test_city_area_routing.php`)**:
         - `City::url` -> `http://localhost/city/lahore` (PASS)
         - `Community::url` -> `http://localhost/area/jamshed-road-number` (PASS)
         - `GET /city/lahore` -> HTTP 200 (PASS)
         - `GET /city/karachi` -> HTTP 200 (PASS)
         - `GET /lahore` -> HTTP 301 to `http://localhost/city/lahore` (PASS)
         - `GET /karachi` -> HTTP 301 to `http://localhost/city/karachi` (PASS)
         - `GET /area/jamshed-road-number` -> HTTP 200 (PASS)
         - `GET /jamshed-road-number` -> HTTP 301 to `http://localhost/area/jamshed-road-number` (PASS)
         - `GET /jamshed_road_number` -> HTTP 301 to `http://localhost/area/jamshed-road-number` (PASS)
         - General pages (`/contact-us`, `/about-us`) -> HTTP 200 without redirection (PASS)

    15. **Dedicated Core Pages XML Sitemap (`/sitemap/page-sitemap.xml`)**:
        - **Objective**: Standardize and deliver the core static/landing pages XML sitemap complying with modern SEO crawlers and search index standards.
        - **Target Endpoint**: `https://saimaprojects.com/sitemap/page-sitemap.xml` (also accessible via dev server `http://127.0.0.1:8000/sitemap/page-sitemap.xml` and `/page-sitemap.xml`).
        - **Included Pages & Priority Weights**:
          1. **Home Page** (`/`): Priority `1.0` (`changefreq: daily`)
          2. **Contact Us** (`/contact-us`): Priority `0.5` (`changefreq: monthly`)
          3. **About Us** (`/about-us`): Priority `0.5` (`changefreq: monthly`)
          4. **Privacy Policy** (`/privacy-policy`): Priority `0.5` (`changefreq: yearly`)
          5. **Disclaimer** (`/disclaimer`): Priority `0.5` (`changefreq: yearly`)
          6. **Terms & Conditions** (`/terms-and-conditions`): Priority `0.5` (`changefreq: yearly`)
        - **Dynamic Timestamps**: Dynamically pulls the exact ISO 8601 UTC timestamp from the MySQL `pages` table (`updated_at` column) for each page slug, updating automatically whenever pages are edited via Admin CMS.
        - **Files Updated**:
          - **`app/Http/Controllers/SitemapController.php`**: Reordered entries so Disclaimer precedes Terms & Conditions, and verified priority values (Home: `1.0`, rest: `0.5`).
          - **`routes/web.php`**: Registered `Route::get('/sitemap/page-sitemap.xml', [SitemapController::class, 'pageSitemap'])->name('sitemap.page');`, `Route::get('/page-sitemap.xml', ...);`, and `Route::get('/sitemap/page-sitemap', ... 301);`.
        - **Verification & Testing**:
          - Direct access `http://127.0.0.1:8000/sitemap/page-sitemap.xml` returned HTTP 200 with `application/xml; charset=utf-8` and valid XML structure.
          - Root `http://127.0.0.1:8000/sitemap.xml` properly references `https://saimaprojects.com/sitemap/page-sitemap.xml`.

    16. **Complete Multi-Sitemap Architecture & Dynamic Sub-Sitemaps**:
        - **Objective**: Implement comprehensive XML sitemap ecosystem adhering to Google and Yoast SEO indexing architecture, featuring a unified root index and dedicated sub-sitemaps for each content silo.
        - **Root Index Endpoint (`/sitemap.xml`)**:
          - Outputs all 6 sub-sitemap endpoints with their dynamic latest modification timestamps:
            1. `https://saimaprojects.com/sitemap/page-sitemap.xml` (Core 6 pages)
            2. `https://saimaprojects.com/sitemap/project-sitemap.xml` (All Project pages)
            3. `https://saimaprojects.com/sitemap/city-sitemap.xml` (All City landing pages)
            4. `https://saimaprojects.com/sitemap/area-sitemap.xml` (All Community / Neighbourhood pages)
            5. `https://saimaprojects.com/sitemap/blog-sitemap.xml` (All Blog posts & index)
            6. `https://saimaprojects.com/sitemap/dynamic-sitemap.xml` (All custom dynamic pages added via `+ Add Page` in Manage Pages CMS)
        - **Sub-Sitemap Endpoints & Specifications**:
          - **Project Sitemap (`/sitemap/project-sitemap.xml`)**:
            - Scope: All 10 luxury property templates and active database projects under `/project/{slug}`.
            - Priority: Strictly **0.8** (`changefreq: weekly`).
          - **City Sitemap (`/sitemap/city-sitemap.xml`)**:
            - Scope: All published and active city records from `cities` table under `/city/{slug}` (e.g. Lahore, Karachi, Punjab).
            - Priority: Strictly **0.8** (`changefreq: weekly`).
          - **Area / Community Sitemap (`/sitemap/area-sitemap.xml`)**:
            - Scope: All published and active communities from `communities` table under `/area/{slug}` (e.g. Jamshed Road Number).
            - Priority: Strictly **0.8** (`changefreq: weekly`).
          - **Blog Sitemap (`/sitemap/blog-sitemap.xml`)**:
            - Scope: All published blog articles from `blogs` table under `/blog/{slug}` plus root `/blogs`.
            - Priority: Strictly **0.8** (`changefreq: weekly`).
          - **Dynamic Pages Sitemap (`/sitemap/dynamic-sitemap.xml`)**:
            - Scope: Any new custom pages added via the `+ Add Page` button in Manage Pages CMS (Image 2) excluding the 6 core pages, projects, cities, and communities.
            - Priority: Strictly **0.8** (`changefreq: weekly`).
        - **Files Updated**:
          - **`app/Http/Controllers/SitemapController.php`**: Implemented `index()`, `pageSitemap()`, `projectSitemap()`, `citySitemap()`, `areaSitemap()`, `blogSitemap()`, and `dynamicSitemap()`.
          - **`routes/web.php`**: Registered all 6 sitemap endpoints, aliases without `/sitemap/`, and 301 redirects for trailing slugs.
        - **Verification & Testing**:
          - Direct access to `/sitemap.xml` verified with HTTP 200 containing all 6 sitemaps.
          - Direct access to all 5 new sub-sitemaps returned HTTP 200 with XML content type and priority 0.8.

    17. **Refinement: Dynamic CMS Sync for Project Sitemap (`/sitemap/project-sitemap.xml`)**:
        - **Problem Identified**: Previously, static luxury community template slugs were pre-populated, emitting 10 projects even though CMS Manage Projects (`/admin/projects`) only had 1 active published project (`Wadeem Gardens`) and 1 draft (`Hasan`).
        - **Fix Implemented**:
          - Removed static slug injection from `app/Http/Controllers/SitemapController.php` (`projectSitemap()` and `index()`).
          - Strictly query the database: `Project::where('is_active', true)->where(fn($q) => $q->whereNull('status')->orWhere('status', '!=', 'draft'))`.
          - Projects in `Draft` status (such as `Hasan`) are strictly omitted.
          - Only genuinely published property cards in CMS are rendered in `/sitemap/project-sitemap.xml`.
        - **Verification**:
          - Direct check on `http://127.0.0.1:8000/sitemap/project-sitemap.xml` returns exactly 1 project (`https://saimaprojects.com/project/wadeem-gardens`) matching CMS status.
