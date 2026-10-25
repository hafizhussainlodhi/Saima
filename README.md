
---

## 🌐 GLOBAL PORT CONVENTIONS & RULES

Always use the following assigned ports when referring to, running, or testing the projects:
- **Laravel Backend Project**: Runs on **Port 8000** (`http://127.0.0.1:8000`).
- **Next.js Frontend Project**: Runs on **Port 3000** (`http://localhost:3000`).

Both projects feature 100% identical UI styling, typography (`Ubuntu`, standard clamp heading hierarchy, 16px body text), sticky frosted glass header, Ken Burns hero carousel, 6 quick metric badges, 10 featured communities, Island Overview residential rundown, Investment Potential with Flexible Financing card, Hudayriyat Island Overview and Location with 4 key location cards, Accepted Payment Methods, 10 interactive real estate FAQs, Contact callback section, and List Your Property modal.

---
# Hudayriyat Island – Full-Stack Laravel Web Application

A full-stack **Laravel 12** web application replicating 100% of the UI design, layout, typography, components, and interactive features from the original Next.js project for **Hudayriyat Island** by **Modon Properties** in Abu Dhabi, UAE.

---

## 🔐 Admin CMS & Dynamic Content (`/admin`)

- **Admin Login Route**: `http://127.0.0.1:8000/admin`
- **Default Landing**: When opening the admin CMS or logging in, the application immediately directs straight to the **Dashboard** (`/admin/dashboard`).
- **Default Admin Credentials**:
  - **Email**: `admin@hudayriyat.com`
  - **Password**: `Admin@12345`
- **Theme**: Clean, elegant White/Light theme with `#856d52` luxury bronze branding.
- **Key Admin Modules**:
  1. **Dashboard** (`/admin/dashboard`): Lead statistics, 14-day activity chart, status breakdown, and recent submissions. Always opens first upon login or navigating to `/admin`.
  2. **Centralized Pages Management** (`/admin/pages`): All standard pages (`Home`, `About Us`, `Contact Us`, `Privacy Policy`, `Terms of Service`) and all dynamic **Project Detail Pages** (such as `/wadeem-gardens`, `/hudayriyat-golf-estates`, `/bashayer-residences`, `/al-naseem-villas`, etc.) are now centrally managed in a single unified **Pages** module:
     - Breadcrumbs: `Manage > Pages` / `Home - Manage - Pages`.
     - Live real-time search filter (`Search...`).
     - Minimal table showing **`# ▲`**, **`NAME / SLUG`**, **`TYPE`** (Badges distinguishing `[Project Page]`, `[Home]`, `[Standard Page]`), and **`ACTIONS`** (Edit pencil icon, View live eye icon, and Delete trash icon with confirmation).
     - Faint dotted row dividers for clean, uncluttered reading.
     - **Inline Add Page Builder**: Single unified screen with drag-and-drop section arrangement and in-place content editing.
  3. **Dedicated Property Cards Manager** (`/admin/projects`): The `Projects` module has been transformed into a dedicated **Property Cards Manager** that powers the Featured Property Cards on the website:
     - **Dedicated Database Table**: Backed by the `projects` table (separate from page content).
     - **Card Fields Managed**:
       - `title`: Community/project name (e.g., `Wadeem Gardens`, `Hudayriyat Golf Estates`).
       - `location`: Location tagline (e.g., `Hudayriyat Island, Abu Dhabi`).
       - `price`: Launch Price badge text (e.g., `Launch Price: 8.7M AED`).
       - `delivery_date`: Delivery Date badge text (e.g., `Delivery Date: Q2 2031`).
       - `developer`: Developer badge (e.g., `Modon Properties`).
       - `payment_plan`: Payment Plan badge (e.g., `Flexible Payment Plan`).
       - `image`: Card photo URL or direct file upload.
       - `page_id`: Dynamic Detail Page Link Dropdown connecting the card directly to its target page in `/admin/pages`.
     - **Actions**: Live search, "+ Add Property Card" inline creator, full edit modal, active/inactive toggle, drag/order sequencing, and delete action.
  4. **Page & Project Editor** (`/admin/pages/{id}/edit`): Modern, simplified minimalist editor:
     - Breadcrumbs: `Manage {Page Name}` / `Home - Pages - Manage {Page Name}`.
     - Clickable live `🔗 Page URL` banner card.
     - Clean two-column layout with vertical tab navigation.
     - **Home Page Editor Optimization**: Manual card creation repeaters were removed from `/admin/pages/1/edit` and replaced with an alert card that points administrators directly to the dedicated **Property Cards Manager** (`/admin/projects`).
     - All section content, Summernote WYSIWYG editor, repeater cards, and save functionality 100% preserved.
  5. **Website Content** (`/admin/content`): Global key-value text editor for site-wide defaults.
  6. **Sidebar Navigation**: Cleaned up to focus strictly on Overview (`Dashboard`), Content (`Pages`, `Projects`), and Site Settings (`Global SEO & Indexing`, `Footer & Newsletter`, `Users & Permissions`). The Sales / Leads section has been removed from the sidebar.

---

## 📑 Page-Wise & Section-Wise CMS Architecture

### 1. Database Schema & Migrations
- **Migration**: `2026_10_20_113000_create_pages_and_sections_tables.php`
- **`pages` Table**:
  - `id`: Auto-incrementing primary key.
  - `title`: Page display title (e.g., `Home`, `About Us`, `Wadeem Gardens`).
  - `slug`: Unique page route / URI slug (e.g., `/`, `about-us`, `wadeem-gardens`).
  - `in_navbar`: Boolean flag indicating whether the page appears in primary navigation.
  - `navbar_order`: Integer sorting sequence in navbar menus.
  - `is_published`: Boolean visibility toggle for the page.
  - `meta_title`, `meta_description`, `meta_keywords`, `og_image`: Custom SEO & OpenGraph fields.
  - `created_at` & `updated_at`: Timestamps.

- **`page_sections` Table**:
  - `id`: Auto-incrementing primary key.
  - `page_id`: Foreign key cascade-linking to `pages.id`.
  - `section_key`: Unique programmatic identifier per page (e.g. `hero`, `highlights`, `overview`, `investment`, `contact`).
  - `section_name`: Human-readable label for the section tab (e.g. `Hero Banner & Form`, `Residential Overview`).
  - `order`: Integer sorting sequence for section tabs.
  - `is_active`: Boolean toggle allowing sections to be activated/deactivated on demand.
  - `content`: JSON column storing key-value pairs of section fields (title, subtitle, badge, cards, buttons, etc.).
  - `created_at` & `updated_at`: Timestamps.

- **`projects` Table (Property Cards Manager)**:
  - **Migration**: `2026_10_25_160000_create_projects_table.php`
  - `id`: Auto-incrementing primary key.
  - `page_id`: Nullable foreign key cascade-linking to `pages.id` (dynamic project detail page link).
  - `title`: Property/community title (e.g., `Wadeem Gardens`, `Hudayriyat Golf Estates`).
  - `slug`: Unique property card identifier.
  - `location`: Location tagline (e.g., `Hudayriyat Island, Abu Dhabi`).
  - `price`: Launch Price badge text (e.g., `Launch Price: 8.7M AED`).
  - `delivery_date`: Delivery Date badge text (e.g., `Delivery Date: Q2 2031`).
  - `developer`: Developer badge text (e.g., `Modon Properties`).
  - `payment_plan`: Payment plan badge text (e.g., `Flexible Payment Plan`).
  - `image`: Card photo URL or direct file upload path (`/images/...` or `/uploads/...`).
  - `order`: Integer sorting sequence for card display on the website.
  - `is_active`: Boolean visibility toggle for the property card.
  - `created_at` & `updated_at`: Timestamps.

### 2. Controllers & Routes
Registered under the `admin.` route group and protected by the `auth` middleware:

#### Pages Management:
- `GET /admin/pages` (`admin.pages.index`) -> `PageController@index`
- `POST /admin/pages` (`admin.pages.store`) -> `PageController@store`
- `GET /admin/pages/{page}/edit` (`admin.pages.edit`) -> `PageController@edit`
- `PUT /admin/pages/{page}` (`admin.pages.update`) -> `PageController@update`
- `DELETE /admin/pages/{page}` (`admin.pages.destroy`) -> `PageController@destroy`
- `PATCH /admin/pages/{page}/toggle-navbar` (`admin.pages.toggle-navbar`) -> `PageController@toggleNavbar`
- `PATCH /admin/pages/{page}/toggle-published` (`admin.pages.toggle-published`) -> `PageController@togglePublished`
- `POST /admin/pages/{page}/reorder-sections` (`admin.pages.reorder-sections`) -> `PageController@reorderSections`

#### Dedicated Property Cards Manager:
- `GET /admin/projects` (`admin.projects.index`) -> `ProjectController@index`
- `POST /admin/projects` (`admin.projects.store`) -> `ProjectController@store`
- `PUT /admin/projects/{project}` (`admin.projects.update`) -> `ProjectController@update`
- `DELETE /admin/projects/{project}` (`admin.projects.destroy`) -> `ProjectController@destroy`
- `PATCH /admin/projects/{project}/toggle` (`admin.projects.toggle`) -> `ProjectController@toggle`
- `POST /admin/projects/reorder` (`admin.projects.reorder`) -> `ProjectController@reorder`

### 3. Page Creation Flow: Global vs Custom Sections

Administrators can create new pages from `/admin/pages` using the **"Create New Page"** flow with two distinct options:

#### Option A: Global Page Sections (Modular Assembly)
- **Concept**: Attach reusable pre-built global components on demand.
- **Available Components**:
  - `hero`: Header banner with headline, subtitle, badge, background image & callback form.
  - `highlights`: 6-card quick facts grid (Developer, Price, Handover, Type, Bedrooms, Payment Plan).
  - `about`: Story overview, narrative paragraphs & video player.
  - `amenities`: Curated lifestyle amenities with iconography (Gym, Pool, Beach, Clubhouse, Yoga, etc.).
  - `gallery`: Responsive photo showcase gallery with hover animations.
  - `floor_plans`: Tabbed unit layouts with specifications and architectural blueprints.
  - `payment_plan`: Transparent milestone installment schedule.
  - `payment_methods`: Financing cards, escrow accounts, mortgages, and 10-Year Golden Visa info.
  - `faq`: Interactive accordion with frequently asked questions.
  - `master_plan`: High-resolution master plan visualization.
  - `location`: Abu Dhabi landmark driving times (Downtown, Airport, Louvre, Grand Mosque).
  - `toc`: Dynamic Table of Contents sidebar with deep anchor scrolling.
  - `contact`: Lead capture inquiry form and direct advisor contact details.

#### Option B: Custom Page (Full Section Builder)
- **Concept**: Automatically loads the complete 12-section community template matching the official luxury community layouts.
- **Pre-populated Defaults**: All headings (H1, H2, H3), paragraphs, unit plans, and milestone tables come pre-populated with authentic website content, allowing the administrator to modify text easily rather than starting from scratch.

### 4. Summernote WYSIWYG Editor Integration
- **Asset Location**: Self-contained locally in `public/vendor/summernote/` (`summernote-lite.min.css`, `summernote-lite.min.js`, `jquery-3.7.1.min.js`, and `font/summernote.woff2|woff|ttf`) with CDN fallback.
- **Supported Formatting**:
  - Headings: H1, H2, H3, H4, Paragraph (`<p>`), Blockquote.
  - Styling: Bold, Italic, Underline, Strikethrough, Color picker, Clear formatting.
  - Content: Ordered lists, Unordered lists, Tables, Links, and Media.
- **Frontend Sync**:
  - All rich content entered via Summernote is stored in MySQL as sanitized HTML.
  - Frontend Blade templates render this content using unescaped Blade tags: `{!! page_section($section, $field) !!}` ensuring all visual formatting and hyperlinks render seamlessly.
  - Dynamic page catch-all route `/{slug}` automatically serves newly created pages through `resources/views/dynamic-page.blade.php`.

### 5. Frontend Blade Integration & Global Helpers
Seamlessly renders dynamic page content from MySQL with zero-downtime fallbacks:
- `page_data(?string $slug = null)`: Fetches the cached `Page` model with eager-loaded `sections`.
- `page_section(string $sectionKey, string $fieldKey, $default = null, ?string $pageSlug = null)`: Retrieves a specific field value within a page's section, falling back to `$default` if not set or inactive.
- `navbar_pages()`: Fetches all published pages marked for navbar inclusion sorted by `navbar_order`.
- Dynamic SEO metadata automatically injected into `layouts/app.blade.php`: `<title>`, `<meta name="description">`, `<meta name="keywords">`, `<meta property="og:title">`, `<meta property="og:description">`.

### 6. Hero Section SEO, Dynamic Image Alt Text & H1 Heading Architecture
- **CMS Editor Field (`/admin/pages/{id}/edit?tab=hero`)**:
  - Located directly alongside the **Hero Background Image (Change Photo / Upload)** module.
  - Form input: `sections[hero][bg_image_alt]` allows administrators to configure custom, SEO-descriptive alternative text for any page's hero image.
  - Persisted in MySQL JSON column `page_sections.content` (`bg_image_alt` and synced to `image_alt`).
- **Dynamic Frontend Image Alt Rendering**:
  - Evaluated on every page via:
    ```blade
    <img src="{{ $heroBg }}" alt="{{ page_section('hero', 'bg_image_alt', page_section('hero', 'image_alt', 'Default Alt Text', $pageSlug), $pageSlug) }}" class="slideImage">
    ```
  - Replaces all hardcoded alt tags across all templates (`partials/hero.blade.php`, `dynamic-page.blade.php`, and all 10 community page templates: `al-naseem-villas`, `bashayer-residences`, `bashayer-villas`, `hudayriyat-golf-estates`, `masyaf-plots`, `nawayef-east-hills`, `nawayef-park-views`, `nawayef-village`, `wadeem-gardens`, `wadeem-plots`).
  - When an admin saves changes in the CMS, page cache is invalidated automatically and the new alt text appears in the frontend HTML without delay.
- **Strict H1 Heading SEO Enforcement**:
  - Across all hero templates without exception, the hero main heading is strictly rendered within a single primary `<h1 class="...">` tag per page for optimal search engine crawlability and index ranking.

### 7. Table of Contents (TOC) Dynamic Synchronization & H2 Auto-Scroll Targeting
- **Automatic ID Injection on CMS Save**:
  When an administrator saves article content via the unified Summernote editor (`sections[content][html]`), `PageController@ensureHeadingIds` automatically parses all `<h2>` tags. Any heading lacking an `id` attribute is automatically assigned a clean, unique slug ID based on its text (e.g. `id="about-the-developers"`).
- **Client-Side Live Heading Discovery & Dynamic TOC Sync**:
  On page load, the frontend (`partials/article.blade.php`) discovers all `<h2>` headings inside `.saimaContentCol`, ensures unique IDs are set, and dynamically synchronizes the Table of Contents list. Any newly added, renamed, or reordered heading from the CMS appears immediately in the TOC list.
- **Smooth Auto-Scroll with Fixed Navbar Offset**:
  Clicking any TOC list item (or direct URL hash navigation like `/wadeem-gardens#about-the-developers`) triggers a smooth animated scroll with a 95px fixed navbar offset so that headings are never concealed behind the sticky header.
- **Scroll Spy**:
  Dynamically tracks the user's scroll position and highlights the corresponding TOC list link in `#856d52` luxury bronze.
- **Database Schema**:
  Added `body` column (`longText`, nullable) to `pages` table via migration `2026_10_22_125119_add_body_to_pages_table.php` to mirror rich HTML content alongside `page_sections.content`.

---

## 🌟 Key Architecture & Features

### 1. Database Integration (MySQL)
- **Database Name**: `hudayriyat` (configured in `.env` via phpMyAdmin / XAMPP).
- **Leads Table (`leads`)**:
  - `id`: Primary key
  - `name`: Lead full name
  - `phone`: Contact phone number with detected country dial code
  - `email`: Lead email address
  - `comment`: Client requirement, preferred units, or comments
  - `project`: Specific community or form origin (e.g. *Hudayriyat Island - Sidebar Appointment*)
  - `ip_address`: Visitor IP address
  - `country`: Visitor ISO country code
  - `status`: Lead status (default: `new`)
  - `created_at` & `updated_at`: Automated timestamps

### 2. Frontend UI Replication (100% Identical to Next.js)
- **Color Scheme & Luxury Aesthetic**: Strictly preserved gold/charcoal theme (`#856d52` gold primary, `#1a1a1a` dark charcoal, `#f8f9fa` light bg, `#e9ecef` borders).
- **Typography (`theleadmarketing.com` standard / Image 2)**:
  - **H2 Headings**: 30px (`1.85rem`), 700 bold, line-height 1.35.
  - **H3 Headings**: 24px (`1.5rem`), 700 bold, line-height 1.4.
  - **Body Text (`p`)**: 17.5px (`1.1rem`), line-height 1.75, Open Sans font family.
- **Header**:
  - Sticky glassmorphic bar on scroll.
  - Desktop navigation with interactive *PROJECTS* dropdown (all 10 communities).
  - *LIST YOUR PROPERTY* button triggering animated modal.
  - Mobile slide-out drawer with backdrop.
- **Hero Section**:
  - Background carousel with cinematic **Ken Burns zoom effect** (5-second cross-fade).
  - Quick callback lead capture form connected to `/api/leads`.
- **Project Highlights**:
  - 6 luxury metric badges with custom SVG icons (Developer: Modon Properties, Launch Price: AED 4.3M, Handover: Q3 2030, Property Type: Villas & Apartments, Payment Plan: Flexible, Location: Hudayriyat Island).
- **10 Featured Communities**:
  - Wadeem Gardens, Hudayriyat Golf Estates, Bashayer Residences, Nawayef East Hills, Bashayer Villas, Al Naseem Villas, Masyaf Plots, Nawayef Village, Wadeem Plots, Nawayef Park Views.
  - High-res images, pricing badges, handover milestones, and explore buttons.
- **2-Column Article Layout**:
  - **Interactive Table of Contents (TOC)**:
    - Collapsible toggle control (*Hide* / *Show*).
    - Hierarchical nested links for all major H2 and H3 headings.
    - Smooth scrolling with offset compensation (`scroll-margin-top: 100px`).
    - Real-time scroll spy highlighting current reading section.
  - **Complete Editorial Coverage**:
    - About Developers (Modon Properties), Location, Location Connectivity Map (`TOC1.png`).
    - Master Plan, Floor Plans (`TOC2.png` – `TOC7.png`), Payment Plans (`TOC8.png` – `TOC13.png`).
    - Milestone Financing Plan, Communities Summary Grid, and World-Class Facilities.
- **Sticky Sidebar Appointment Form**:
  - Aligned neatly near the right edge.
  - Dynamic country flag & dial code dropdown (`+971`, `+92`, `+91`, `+966`, `+44`, `+1`, etc.).
  - AJAX lead submission storing directly in MySQL `hudayriyat` database with immediate success checkmark.
  - **Latest Projects** card list highlighting top 6 communities with thumbnail images and direct links.
- **Interactive FAQ Accordion**:
  - 8 real estate investment questions with smooth expand/collapse.
- **Contact & Callback Section**:
  - Full-width background image with gradient overlay.
  - Consultation inquiry form storing into database.
- **Floating Scroll-To-Top**:
  - Circular gold button that fades in when scrolling past 300px.
- **"List Your Property" Modal**:
  - Accessible from the header and mobile menu with instant submission.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2)
- **Database**: MySQL (`hudayriyat`) via Eloquent ORM
- **Frontend**: Blade Templating Engine + Vanilla CSS (`public/css/hudayriyat.css`)
- **Assets**: 560+ optimized images and SVG logos located in `public/`

---

## 🚀 How to Run

1. **Start Apache & MySQL** in XAMPP.
2. In terminal, navigate to the `backend` folder:
   ```bash
   cd backend
   ```
3. Run migrations (already executed):
   ```bash
   php artisan migrate
   ```
4. Start the Laravel development server:
   ```bash
   php artisan serve --port=8000
   ```
5. Open your browser and visit:
   ```
   http://127.0.0.1:8000
   ```

## 🔄 Update Log: 100% Frontend Parity & Phone Flag Selector Match (Port 3000 & 8000)

- **Top Navigation Bar Right Alignment**:
  - Ensured `.headerContainer` has `display: flex; justify-content: space-between; align-items: center;`.
  - Grouped all navigation items (`HOME`, `PROJECTS ▾`, `FAQ`, `CONTACT US`, and `LIST YOUR PROPERTY` button) inside `.nav` (`margin-left: auto !important`) and `<ul class="navList">` with `gap: 26px`.
  - Resolved previous centering issue on Laravel (Port 8000), making the top bar 100% identical to Next.js (Port 3000).

- **Phone Input Flag Selector & Pre-fill**:
  - Implemented the exact `react-international-phone` layout across both the Hero Callback form and Sidebar Appointment form.
  - Features real, crisp SVG country flags (UAE `+971`, Pakistan `+92`, Saudi Arabia `+966`, India `+91`, Qatar `+974`, Kuwait `+965`, Oman `+968`, Bahrain `+973`, UK `+44`, USA `+1`).
  - Pre-fills `+971 ` in the phone input with seamless country change upon dropdown selection.
  - Fixes Windows Chrome/Edge emoji rendering bug where country flags were failing to render.

- **Typography & Layout Synchronized**:
  - **Font Family**: Unified to `'Open Sans', sans-serif` across headings, body paragraphs, and forms.
  - **H2 Headings**: Set to 28px - 32px (30px in article), font-weight 700.
  - **H3 Headings**: Set to 22px - 25px (24px in article), font-weight 700.
  - **Body Paragraphs**: Set to 17.5px with 1.75 line-height and `#4a4a4a` color.
  - **Sidebar Form**: Removed duplicate `<label>` tag in article sidebar form; matched 42px height and styling to `SidebarAppointmentForm.tsx`.

### 🎯 Parity Update: Hero Phone Input & Below-Hero Sections Complete Match
- **Hero Phone Input (Image 1 vs Image 2 Fix)**:
  - Redesigned phone input into a unified single-row container (`.phoneUnifiedContainer`) with 48px height, rounded corners, and soft grey background.
  - Left side contains the UAE SVG flag with dropdown caret arrow and vertical divider line `|`.
  - Right side contains `+971 ` prefilled input field, perfectly aligned with `Full Name` and `E-mail` inputs.
- **Highlights Badges (Image 3 vs Image 4 Fix)**:
  - Replaced unstyled vertical list with the 6 floating highlight cards in a 6-column grid (`highlightsGrid`).
  - Added brown accent circle behind each SVG icon and two-line typography (`highlightLabel` and `highlightValue`).
- **Projects Showcase (Image 3 vs Image 4 Fix)**:
  - Converted section header to `--- Projects ---` with brown accent lines.
  - Implemented 4-column `.cardCustom` grid featuring dark gradient bottom overlay, `MÖDON` badge, sparkle action button, and launch price / delivery date badges.
- **FAQ & Contact Sections**:
  - Synchronized accordion animations, 8 full FAQs, and VIP Consultation callback form with Next.js implementation.

### 🚀 Additional Parity Fixes (Mobile Drawer, Sticky Navbar & Centered Cards)
1. **Mobile Drawer Navigation (Image 1 vs Image 2)**:
   - Replaced full-width grey button with clean, sharp SVG close cross `✕` on the top-right.
   - Removed logo inside drawer and redundant link dumps; aligned exactly to Port 3000 (`HOME`, `PROJECTS ⌄` with accordion dropdown, `FAQ`, `CONTACT US`, and `LIST YOUR PROPERTY` button).
2. **Sticky Navbar on Scroll (Image 3)**:
   - Implemented fixed sticky header with `backdrop-filter: blur(10px)` and slide-down transition upon scrolling past 40px.
3. **Centered 9th & 10th Cards (Image 4 vs Image 5)**:
   - Applied `.centeredRowStart` (`grid-column: 2 / 3 !important;`) on `Wadeem Plots`, positioning Cards 9 and 10 in columns 2 and 3 of the 4-column grid with empty side columns, matching Port 3000 perfectly.

### 🎯 Parity Update: Sidebar Appointment Form & Missing Image Fix
1. **Nawayef Park Views Image Fix**:
   - Corrected image file reference from `nawayef-park.jpg` to `nawayef-park-views.jpg` in `resources/views/partials/communities.blade.php`.
   - Card 10 now displays the full project render identically to Port 3000 instead of a broken black box.
2. **Sidebar Appointment Form Height & Proportions**:
   - Resolved CSS conflict where ContactSection `.formCard` padding (38px 34px) was overriding the sidebar form card.
   - Reduced padding to 20px 18px and input gap to 12px, making the form clean, compact, and proportional to Table of Contents.
3. **Phone Input 1-Row Alignment (Flag + Input)**:
   - Replaced unstyled block container with unified `.phoneUnifiedContainer` (38px height).
   - Flag, dropdown caret arrow, vertical separator, and `+971 ` input field are now strictly locked in one horizontal row matching Port 3000.
4. **Button & Script Polish**:
   - Replaced text with `SUBMIT →` and added animated processing states on appointment booking.


### 🎯 Parity Update: Full Dedicated Contact Us Page (/contact-us)
1. **Dedicated View & Routing**:
   - Created `resources/views/contact-us.blade.php` matching Next.js `src/app/contact-us/ContactUsClient.tsx` 100% identically.
   - Added `Route::get('/contact-us')` and alias `Route::get('/contact')` redirect in `routes/web.php`.
2. **Top Navigation & Drawer**:
   - Updated navbar and mobile drawer `CONTACT US` links to point to `/contact-us` instead of `#contact`.
3. **Hero Banner & 4 Contact Channels**:
   - Darkened hero banner on `slide-1.jpg` with pill badge `HUDAYRIYAT ISLAND • ABU DHABI`, title `Contact Us`, and subtitle.
   - 4 Direct Channels Cards grid: WhatsApp Us, Direct Call (+971 50 000 0000), Email Inquiries (info@hudayriyat-island.ae), and Location (Hudayriyat Island, Abu Dhabi, UAE).
4. **2-Column Overview & Get in Touch Form**:
   - Left column featuring emerging properties overview, 3 paragraphs, and 3 feature cards (Exclusive Island Living, 100% Freehold Ownership, Prompt Advisory).
   - Right column with `Get in Touch` card, unified 1-row UAE flag phone input, and submit handling to `/api/leads`.


### 🎯 Parity Update: Navbar Color & Global Footer Parity
1. **Navbar Color & Translucency**:
   - Synchronized `.sticky-header` background to `rgba(25, 25, 25, 0.45)` with `backdrop-filter: blur(5px)` (matching Next.js `globals.css:225` and Screenshot 1 & 2).
   - Removed opaque/overly-dark background so it delivers the exact frosted glass taupe effect when scrolled over white or image backgrounds.
2. **Footer Component (100% Port 3000 Parity)**:
   - Replaced unstyled footer with exact 4-column layout (`#000000` pitch black background, white serif logo with brightness invert filter).
   - Col 1: Logo & advisory description.
   - Col 2: About Hudayriyat (Home, Projects, About Us, Contact Us, Privacy Policy, Terms & Condition, Disclaimer).
   - Col 3: Properties (10 communities from Wadeem Gardens to Nawayef Park Views).
   - Col 4: Connect With Us (Email icon + Contact Us link).
   - Bottom bar with complete legal disclaimer text and copyright `© 2026 hudayriyat-island.ae All Rights Reserved.`


### 🎯 Parity Update: Full Dedicated About Us Page (/about-us)
1. **Dedicated View & Routing**:
   - Created `resources/views/about-us.blade.php` matching Next.js `src/app/about-us/AboutUsClient.tsx` 100% identically.
   - Added `Route::get('/about-us')` and alias `Route::get('/about')` redirect in `routes/web.php`.
2. **Hero Header**:
   - Dark gradient hero banner with golden badge `HUDAYRIYAT ISLAND • ABU DHABI`, title `About Us`, and subtitle.
3. **Intro & Featured Image**:
   - Lead paragraph and subtext paired with 480px luxury waterfront architecture container (`form image.jpg`).
4. **Core Services, Pillars & Why Choose Us**:
   - 3 Core Services cards (Property Advisory, Property Listings, Market Insights).
   - 3 Pillars cards (Mission, Vision, Values).
   - 3 Why Choose Us cards (Local Market Knowledge, Client-First Approach, Simple Property Search).
5. **Looking for Your Dream Property Form Section**:
   - Journey benefits checklist paired with inquiry form card (Full Name, Email, UAE Flag Phone Input 🇦🇪, SUBMIT NOW button).


### 🎯 Parity Update: List Your Property Navbar Modal (100% Port 3000 Parity)
1. **Interactive Trigger**:
   - Wired navbar and mobile drawer `LIST YOUR PROPERTY` buttons with `.open-list-modal` to open the modal smoothly with `fadeIn` background and `slideUp` card animation.
   - Added Escape key and outside backdrop click to dismiss.
2. **Form Layout & Fields**:
   - Header: `LIST YOUR PROPERTY` (20px bold uppercase) with sharp close `✕` icon.
   - Row 1: Name * (`Your Name`) & Email * (`your.email@example.com`).
   - Row 2: Phone * with unified UAE Flag 🇦🇪 + dropdown caret + `+971 ` & Property Type * dropdown (Villa, Apartment, Penthouse, Compound, Plot, Showroom).
   - Row 3: Attachment (Optional) file uploader with note `Upload floor plans, photos, or deed documents (Max 10MB).`
   - Row 4: Comments / Specifications textarea (`Tell us about the property (bedrooms, plot size, community, expected price)...`).
   - Row 5: `SUBMIT PROPERTY` button in brand accent brown (`#856d52`).


### 🎯 Parity Update: List Your Property Click Fix & Reliable Modal Trigger
1. **Click Bug Resolution**:
   - Fixed redundant syntax block in `layouts/app.blade.php` that caused script parsing stoppage.
   - Added `window.openListModal()` and `window.closeListModal()` directly to global window scope.
   - Attached `onclick="window.openListModal ? window.openListModal() : null"` directly on the navbar and mobile drawer `LIST YOUR PROPERTY` buttons.
2. **Modal Form Parity (100% Match to Screenshot)**:
   - 2-column grid layout with `Name *`, `Email *`, `Phone *` (UAE Flag 🇦🇪 + unified input), `Property Type *` dropdown.
   - Full-width `Attachment (Optional)` file chooser with note, `Comments / Specifications` textarea, and `SUBMIT PROPERTY` brown button.


### 🎯 Parity Update: Full Live Home Page & Layout Replication from Port 3000 (`hudayriayt_new`)
1. **Removed TOC & Book an Appointment Sidebar from Home Page**:
   - As per project specifications, removed the dynamic Table of Contents (TOC) and sticky "Book an Appointment" sidebar from the Home Page.
2. **Added Exact Matching Next.js Sections**:
   - **Island Overview (`partials.island-overview`)**: Comprehensive editorial rundown covering all 14 communities & plot developments (Wadeem Gardens, Hudayriyat Golf Estates, Nawayef East Hills, Nawayef Village, Nawayef Park Views, Al Naseem Villas, Bashayer, Bashayer Residences, Wadeem plots, Masyaf plots, Sunset Cliff, Quays, Sahl, and Hills).
   - **Investment Potential & Flexible Financing (`partials.investment-potential`)**: 2-column section with Key Investment Highlights (7 bullet items with circular check icons, "Contact a Property Investment Consultant" button) and Flexible Financing Options Card (5 financing highlights with green/gold check icons, "Contact a Mortgage Specialist" button).
   - **Hudayriyat Island Overview and Location (`partials.overview-location`)**: 2-column layout with detailed overview text and high-res overview image (`hudayriyat-overview.jpg`), accompanied by a 4-item location connectivity bar (Al Bateen, Saadiyat Island, Abu Dhabi City Centre, Qasr Al Watan & Emirates Palace).
   - **Accepted Payment Methods (`partials.payment-methods`)**: 4-card grid showcasing accepted payment avenues (Card, Cheque, Cash, Bitcoin) with crisp iconography.
3. **Synchronized FAQs & Contact Section**:
   - Expanded FAQ section to all 10 official questions and answers with smooth interactive accordion toggle matching `FaqAccordion.tsx`.
   - Updated Contact Section (`partials.contact`) with `LET'S CONNECT` pre-title, `Invest in Your Future` headline, background image (`form image.jpg`), and instant VIP callback request form.
4. **Unified Typography to Ubuntu**:
   - Standardized primary font-family to Google Fonts `Ubuntu` across all layouts, components, and stylesheets (`hudayriyat.css`).
   - Matched font sizes, weights, and clamp calculations strictly to `hudayriayt_new`'s `globals.css` and CSS modules.
5. **JSON-LD Schema & Laravel 12 `@context` Resolution**:
   - Resolved `ParseError: syntax error, unexpected end of file, expecting "elseif" or "else" or "endif"` caused by Laravel 12 compiling the JSON-LD `@context` key as a Blade directive (`context()->has(...)`).
   - Encoded the schema via `{!! json_encode([...], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}` in `layouts/app.blade.php`, allowing the view to compile and render seamlessly.


### 🎯 Parity Update: Saima Mangrove Residences Editorial Section Across All Project Pages
1. **Interactive Table of Contents (TOC)**:
   - Designed 100% faithful to `theleadmarketing.com` screenshots with crisp border (`#dcdcdc`), header toggle button `[::=]`, and nested numbered list (1–10 with 5.1–5.6 and 7.1–7.6 sub-items).
   - Real-time scroll spy highlighting active section with red `#d9232d` accent and smooth scroll offset.
2. **Editorial Content & Strict Theme Preservation**:
   - Incorporated the exact user-provided text for Saima Mangrove Residences, About the Developers (with Lead Marketing link), NOC, Location, Location Map, Floor Plans (Types A, A-1, A-2, A-3, B, C), Master Plan, Payment Plans (Types A, A-1, A-2, A-3, B, C), Installation Plan, Apartments for Sale, and Facilities & Amenities.
   - Headings styled in bold `#d9232d` red (H2: 26px, H3: 20px) on clean Open Sans / sans-serif typography.
3. **TOC Public Images Integration (`TOC1.png` – `TOC13.png`)**:
   - Integrated all 13 images located in `backend/public/`:
     - `TOC1.png`: Location Connectivity Map
     - `TOC2.png`: 3-Room Apartments – Type C
     - `TOC3.png`: 4-Room Apartments – Type B
     - `TOC4.png`: 5-Room Apartment – Type A
     - `TOC5.png`: 5-Room Apartments – Type A-1
     - `TOC6.png`: 5-Room Apartments – Type A-2
     - `TOC7.png`: 5-Room Apartments – Type A-3
     - `TOC8.png`: Payment Plan Type A – 5-room Apartment
     - `TOC9.png`: Payment Plan Type A-1 – 5 Room Apartment
     - `TOC10.png`: Payment Plan Type A-2 – 5 Room Apartment
     - `TOC11.png`: Payment Plan Type A-3 – 5 Rooms Apartment
     - `TOC12.png`: Payment Plan Type B – 4 Rooms Apartment
     - `TOC13.png`: Payment Plan Type C – 3 Rooms Apartment
4. **Sticky Right Sidebar with Book An Appointment & Latest Projects**:
   - **BOOK AN APPOINTMENT**: Card with centered bold title, inputs (`Name`, `Phone`, `Email`), textarea (`Leave a comment here`), and red `#d9232d` `SUBMIT` button with AJAX submission to `/api/leads` and instant success feedback.
   - **Latest Projects**: Real estate project showcase featuring Lorévia Collection, Samana South Haven 2, Lily Tower, Avana Residences, and Elan Tower with preview thumbnails.
5. **Universal Deployment Across All 10 Community Pages**:
   - Integrated `@include('partials.article')` across:
     - `/wadeem-gardens`
     - `/hudayriyat-golf-estates`
     - `/bashayer-villas`
     - `/bashayer-residences`
     - `/al-naseem-villas`
     - `/nawayef-east-hills`
     - `/masyaf-plots`
     - `/nawayef-village`
     - `/wadeem-plots`
     - `/nawayef-park-views`

### 🎯 Parity Update: TOC Collapse by Default, Black Hudayriyat Theme & Professional LP1-LP5 Projects
1. **TOC Collapsed by Default**:
   - Table of Contents (`#saimaTocContent`) is closed/collapsed by default (`display: none`).
   - Integrated a clean toggle button with "Show" / "Hide" text and animated chevron indicator that opens/closes the TOC on demand.
2. **Black Theme (Hudayriyat Parity)**:
   - TOC links styled in clean black `#1a1a1a` (no red underlines or default red links).
   - Article headings (`H2` & `H3`) unified to `#1a1a1a` (matching Hudayriyat Island's signature aesthetic).
3. **Streamlined TOC Targets (H2 Only)**:
   - Removed cluttered sub-items (5.1–5.6, 7.1–7.6) from the TOC list.
   - Now targets strictly the 10 main `<h2>` sections for clean, readable navigation.
4. **Latest Projects Cards with `LP1.png` – `LP5.png`**:
   - Integrated the 5 images saved in `public/` (`LP1.png` through `LP5.png`).
   - Upgraded card design with larger thumbnail height (80px height x 95px width), crisp rounded borders (`border-radius: 6px`), subtle elevation shadow, and hover animations.

### 🎯 Parity Update: Universal Sticky Navbar on Scroll Across All Pages
1. **Dynamic Scroll Listener**:
   - Attached an active window scroll listener that monitors user scroll position (`window.scrollY > 40`).
   - Dynamically adds the `.sticky-header` class when scrolling down, and removes it smoothly when back at the top.
2. **Glassmorphic Fixed Navbar Styling**:
   - Defined `.sticky-header` across `hudayriyat.css` and `communities/global.css`:
     - `position: fixed !important; top: 0; left: 0; right: 0; width: 100%;`
     - Translucent dark glass backdrop (`background: rgba(20, 20, 20, 0.75)` with `backdrop-filter: blur(8px)`).
     - Elevation shadow (`box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15)`), compact padding (`12px 0`), and `z-index: 1000`.
3. **Universal Coverage**:
   - Operates seamlessly across the Home page, legal pages, About/Contact pages, and all 10 community project pages.

### 🎯 Parity Update: Typography Enhancement & Signature #856d52 Theme Color Integration
1. **Typography & Readability Enlargement (Exact Image 2 Parity)**:
   - Standardized font-family to Google Fonts `'Open Sans'` across the entire article, TOC, and sidebar components.
   - Increased body paragraph font size to **19.5px** with generous **1.88 line-height** and **24px bottom margin**, achieving 100% visual parity with the spacious editorial layout in reference Image 2.
   - **H2 Headings**: Scaled up to **34px** bold in `#856d52` with negative letter-spacing for prominent visibility.
   - **H3 Headings**: Scaled up to **26px** bold in `#856d52`.
   - **TOC Navigation**: Title increased to **22px** and list items to **18px** for easy readability.
   - **Form Fields & Button**: Sized up input fields to **16px** with generous padding, and SUBMIT button to **16px** bold.
2. **Signature Color Matching (Image 3 Parity)**:
   - Extracted the exact gold/brown theme color from the `DOWNLOAD BROCHURE` button in Image 3: **`#856d52`** (hover: `#725c43`).
   - **H2 Headings**: Colored in bold `#856d52` with 34px size.
   - **H3 Headings**: Colored in `#856d52` with 26px size.
   - **BOOK AN APPOINTMENT SUBMIT Button**: Colored in `#856d52` with `#725c43` hover state, 16px bold uppercase font, and subtle golden box shadow (`0 4px 12px rgba(133, 109, 82, 0.25)`).
   - **In-text & TOC Active Links**: Accented with `#856d52`.

### 🎯 Parity Update: Project Gallery Image Alignment & Responsive Centering Fix (100% Port 3000 Parity)
1. **Resolved Gallery Right-Edge Cutoff & Giant Image Sizing**:
   - Diagnosed root causes:
     - Broad CSS selector `div[class*="Gallery"]` was erroneously matching gallery child elements (`viewport`, `track`, and `card`), forcing `width: 100% !important` and stretching a single card across the entire container width.
     - Scope narrowed strictly to `section[id="gallery"]` so that individual cards maintain their exact designed dimensions (`cardWidth x cardHeight`).
   - **Exact Next.js Port 3000 Parity Implementation (`initStandardGallery`)**:
     - Desktop (`viewportWidth >= 992px`): Exactly **2 cards** centered side-by-side (`itemsInCenter = 2`), card width `Math.min(600, Math.max(300, (viewportWidth - gap - 80) / 2))`, 24px gap, and aspect ratio 600:400 (`cardHeight = cardWidth * 400 / 600`).
     - Card 3 peeks into view on the right edge, matching Port 3000 identically.
     - Mobile/Tablet (`viewportWidth < 992px`): Exactly 1 card centered with 16px gap and side margins.
     - **Full Next/Prev & Dot Navigation**:
       - Forward button (`>`) smoothly slides the carousel to the next card index.
       - Backward button (`<`) smoothly slides to the previous card index.
       - Pagination dots activate dynamically and navigate directly on click.
       - Category filter tabs ("ALL", "Exterior") dynamically filter slides and reset to slide 0.
       - Fullscreen Lightbox opens with high-resolution view on card click.
2. **Universal Gallery Fallback Styles in `global.css`**:
   - Container styles for `.carouselContainer`, `.viewport`, `.track`, `.card`, and `img` guaranteeing 18px rounded corners and smooth hover zoom effects.
3. **Article Images Enhancement (`TOC1.png` - `TOC13.png`)**:
   - Centered all floor plan and location map images in `partials/article.blade.php` with `margin: 28px auto 32px auto;`, `border-radius: 8px;`, subtle shadow, and clean light border.
4. **Underscore URL Route Aliases**:
   - Added support in `backend/routes/web.php` for underscore URLs (e.g. `/wadeem_gardens` -> `/wadeem-gardens`, etc.) ensuring both hyphenated and underscore URLs resolve seamlessly.

### 🎯 Parity Update: Wadeem Amenities Section Restoration (100% Port 3000 Parity)
1. **Isolated Gallery Rules from Amenities Cards**:
   - Resolved visual distortion where a broad gallery `.card` selector had unintentionally applied `background: #f4ede5`, `overflow: hidden`, and stretched the 28x28 icon images across the entire card background.
   - Strictly scoped all gallery selectors under `section[id="gallery"]`.
2. **Restored Pristine Port 3000 Amenities Design**:
   - Card container: Clean pure white background (`background: #ffffff`), subtle border (`1px solid #e5e7eb`), soft shadow (`box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02)`), and `border-radius: 8px`.
   - Icon box: 48x48px container in signature brand brown (`#856d52`) with centered 28x28px white icon (`filter: brightness(0) invert(1)`).
   - Typography: 16.5px bold title (`#222222`) aligned beside the icon.
   - Responsive grid: 4 columns on desktop, 2 columns on tablet, 1 column on mobile.

### 🎯 Feature Update: Dedicated "Content" Section Tab & Unified Summernote Editor Across All Pages
1. **Unified Single Summernote Editor**:
   - Replaced fragmented heading/paragraph inputs and separate repeater fields with a single, comprehensive Summernote WYSIWYG editor under the **"Content"** tab (`section_key = 'content'`, `section_name = 'Content'`).
   - Every page in the CMS now has a dedicated **"Content"** section.
2. **Pre-filled Website Content**:
   - **Home (`/`)**: Pre-filled with the complete residential communities article (`<h2>Hudayriyat Island Projects: The Residential Communities</h2>`, intro narrative, and all 10 residential communities with `<h3>` and paragraphs).
   - **Community Pages** (`wadeem-gardens`, `hudayriyat-golf-estates`, `bashayer-residences`, etc.): Pre-filled with the complete editorial article (intro, `<h2>` sections for Developers, NOC, Location, Location Map image `TOC1.png`, Floor Plans images `TOC2.png`-`TOC7.png`, Master Plan, Payment Plans images `TOC8.png`-`TOC13.png`, Installation Plan, Apartments for Sale, and Facilities & Amenities).
   - **About Us, Contact Us & Legal Pages**: Pre-filled with their respective body text and structured headings.
3. **Typography & Image Integration**:
   - Summernote style dropdown provides native support for Heading 1 (`h1`), Heading 2 (`h2`), Heading 3 (`h3`), and Normal (`p`).
   - Images are rendered directly inside the editor (`<img>`) with responsive sizing, border radius, and shadow.
4. **Live Frontend Rendering**:
   - Updates made in the Summernote editor save to the database and immediately reflect on the live website.
   - `partials/island-overview.blade.php` and `partials/article.blade.php` dynamically render the content HTML if configured.
5. **Seeder & Database Synchronization**:
   - Updated `database/seeders/PageSeeder.php` and `PageBlueprintService.php` to include the `content` section for all pages by default.


### 🎯 Frontend Fix: Navbar "PROJECTS" Dropdown Menu
1. **Root Cause**:
   - Community pages (`nawayef-village`, `masyaf-plots`, `wadeem-plots`) used `<ul class="ProjectHeader-module__jLMilW__dropdownMenu">`, which did not match `div[class*="dropdownMenu"]` in `global.css`.
   - As a result, the background defaulted to `#1f1b16` (dark) with `max-height: 420px; overflow-y: auto;` causing an unsightly native Windows OS scrollbar and low-contrast text.
2. **Resolution**:
   - Broadened selector in `public/css/communities/global.css` to `[class*="dropdownMenu"], [class*="DropdownMenu"], .dropdownMenu` with pure white background (`#ffffff`), soft shadow (`box-shadow: 0 15px 35px rgba(0,0,0,0.18)`), and elegant border.
   - Removed ugly native scrollbar by setting `max-height: none` and `overflow: visible` (with thin sleek scrollbars fallback).
   - High-contrast text `#2b2b2b` with gold `#856d52` luxury hover and active styling.
   - Updated `public/css/communities/nawayef-village.css`, `masyaf-plots.css`, `wadeem-plots.css`, and injected head `<style>` in corresponding blade templates for instant, cache-resilient presentation.

### 🎯 Feature Update: "Add Page" Modal with Hero Section Component & Summernote Editor
1. **Renamed Action**:
   - Primary action button and modal header renamed from "Create New Page" / "Create New Website Page" to **"Add Page"**.
2. **Simplified Section Selection**:
   - Replaced previous Global vs. Custom radio choices with an intuitive **"Available Sections"** component card.
3. **Hero Section Component**:
   - Features a visual thumbnail previewing `public/hero.png`.
   - **Click-to-Add**: Clicking the card adds the Hero section to the page (`✓ Added`).
   - **Click-to-Edit Drawer**: Clicking the added card or the "Edit Content" button expands a customization drawer.
   - **Pre-populated Fields**: Main Heading (H1), Subtitle/Tagline, Badge/Pretitle, and Background Image (`/hero.png`).
   - **Integrated Summernote Editor**: Includes an interactive WYSIWYG Summernote editor pre-populated with ready-to-edit HTML content.
4. **Backend Persistence**:
   - `PageController::store` accepts customized Hero fields and Summernote HTML, updating both the `hero` section and `content` section (`pages.body`).

---

### 💬 Fixed Floating WhatsApp Widget Across All Pages
- **Sitewide Floating Widget**: Added to `resources/views/layouts/app.blade.php` so it renders automatically across all public pages (Home, Community projects, About, Contact, Legal pages, etc.).
- **Fixed Positioning**: Anchored at `position: fixed; bottom: 25px; left: 25px; z-index: 99999;` so it remains completely locked in place when scrolling.
- **Design Elements (Matching Image 1)**:
  - Circular official WhatsApp green button (`#25D366`) with crisp white WhatsApp SVG icon.
  - Notification alert badge with red pill (`1`) in the top-right corner of the icon.
  - White callout pill text: `"Contact us for details"`.
  - Links directly to WhatsApp chat (`wa.me`) in a new tab.
  - Smooth hover scale and shadow transitions; optimized for mobile screens.

---

### 📩 Modular Add Page Builder: Contact & Callback Section Component
1. **New Available Section**:
   - Added **Contact Section** (`contact`) directly after the FAQ Section in the Add Page visual builder (`/admin/pages`).
   - Thumbnail preview uses `public/contact_section.png` (`asset('contact_section.png')`).
   - Available sections count badge updated to **7 Available** (`Hero`, `Project Highlights`, `About Community`, `Article & Booking`, `Project Cards`, `FAQ Section`, `Contact Section`).
2. **Visual Builder Workflow**:
   - Clicking "+ Click to Add" adds the large visual card into the upper selected sections builder layout with order badge, drag-and-drop handle, and remove button (`✕`).
   - Expandable drawer **"✎ Edit Content"** allows customizing:
     - Pre-Title (e.g. `LET'S CONNECT`)
     - Main Heading (e.g. `Invest in Your Future`)
     - Subtitle / Narrative
     - Form Top Label (`REQUEST`)
     - Form Main Title (`A CALL BACK`)
     - Submit Button text (`REQUEST NOW`)
     - Background image URL (`/images/form image.jpg`)
3. **Backend & Frontend Sync**:
   - `PageController@store` attaches the `contact` section to the page and persists custom fields.
   - Frontend `dynamic-page.blade.php` dynamically renders `partials.contact` right after FAQ (or according to administrator drag-and-drop order).

