<header id="siteHeader" class="header">
    <div class="container headerContainer">
        <!-- Logo on the left -->
        <a href="/" class="logoLink">
            <img src="{{ asset('logo_saima.png') }}" alt="Saima Group" class="logoImg">
        </a>

        <!-- Desktop Navigation aligned to the RIGHT -->
        <nav class="nav">
            <ul class="navList">
                <li class="navItem">
                    <a href="/" class="navLink navLinkActive">HOME</a>
                </li>
                <li class="navItem" id="navProjectsItem">
                    <button type="button" class="navLink" id="navProjectsBtn" style="background: none; border: none; cursor: pointer;">
                        PROJECTS
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="dropdownMenu" id="navProjectsDropdown">
                        <a href="/wadeem-gardens" class="dropdownItem">Wadeem Gardens</a>
                        <a href="/hudayriyat-golf-estates" class="dropdownItem">Hudayriyat Golf Estates</a>
                        <a href="/bashayer-residences" class="dropdownItem">Bashayer Residences</a>
                        <a href="/nawayef-east-hills" class="dropdownItem">Nawayef East Hills</a>
                        <a href="/bashayer-villas" class="dropdownItem">Bashayer Villas</a>
                        <a href="/al-naseem-villas" class="dropdownItem">Al Naseem Villas</a>
                        <a href="/masyaf-plots" class="dropdownItem">Masyaf Plots</a>
                        <a href="/nawayef-village" class="dropdownItem">Nawayef Village</a>
                        <a href="/wadeem-plots" class="dropdownItem">Wadeem Plots</a>
                        <a href="/nawayef-park-views" class="dropdownItem">Nawayef Park Views</a>
                    </div>
                </li>
                <li class="navItem">
                    <a href="#faq" class="navLink">FAQ</a>
                </li>
                <li class="navItem">
                    <a href="/contact-us" class="navLink">CONTACT US</a>
                </li>
                <!-- LIST YOUR PROPERTY Button right beside Contact Us -->
                <li class="navItem">
                    <button type="button" class="btn-get-started open-list-modal" onclick="window.openListModal ? window.openListModal() : null" style="font-size: 13px; padding: 8px 18px; font-weight: 600; cursor: pointer;">
                        LIST YOUR PROPERTY
                    </button>
                </li>
            </ul>
        </nav>

        <!-- Mobile Menu Toggle Button (Visible ONLY on mobile <= 1024px) -->
        <button type="button" id="mobileMenuBtn" class="mobileToggle" aria-label="Toggle navigation menu">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>
            </svg>
        </button>
    </div>
</header>

<!-- Mobile Navigation Backdrop -->
<div id="mobileBackdrop" class="mobileDrawerOverlay"></div>

<!-- Mobile Navigation Drawer (EXACT MATCH TO IMAGE 2 FROM PORT 3000) -->
<aside id="mobileDrawer" class="mobileDrawer">
    <!-- Clean Close Cross Button on Top Right -->
    <button type="button" id="mobileDrawerClose" class="mobileCloseBtn" aria-label="Close menu">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>

    <!-- Clean Navigation Links (Home, Projects, FAQ, Contact Us, List Your Property) -->
    <ul class="mobileNavList">
        <li>
            <a href="/" class="mobileNavLink">HOME</a>
        </li>
        <li>
            <button type="button" id="mobileProjectsToggle" class="mobileNavLink">
                <span>PROJECTS</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="mobileChevronIcon" style="transition: transform 0.25s ease;">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>
            <div id="mobileProjectsSubmenu" class="mobileSubList" style="display: none;">
                <a href="/wadeem-gardens" class="mobileSubItem">Wadeem Gardens</a>
                <a href="/hudayriyat-golf-estates" class="mobileSubItem">Hudayriyat Golf Estates</a>
                <a href="/bashayer-residences" class="mobileSubItem">Bashayer Residences</a>
                <a href="/nawayef-east-hills" class="mobileSubItem">Nawayef East Hills</a>
                <a href="/bashayer-villas" class="mobileSubItem">Bashayer Villas</a>
                <a href="/al-naseem-villas" class="mobileSubItem">Al Naseem Villas</a>
                <a href="/masyaf-plots" class="mobileSubItem">Masyaf Plots</a>
                <a href="/nawayef-village" class="mobileSubItem">Nawayef Village</a>
                <a href="/wadeem-plots" class="mobileSubItem">Wadeem Plots</a>
                <a href="/nawayef-park-views" class="mobileSubItem">Nawayef Park Views</a>
            </div>
        </li>
        <li>
            <a href="#faq" class="mobileNavLink">FAQ</a>
        </li>
        <li>
            <a href="/contact-us" class="mobileNavLink">CONTACT US</a>
        </li>
        <li style="margin-top: 10px;">
            <button type="button" class="btn-get-started open-list-modal" onclick="window.openListModal ? window.openListModal() : null" style="font-size: 13px; padding: 8px 18px; font-weight: 600; cursor: pointer;">
                LIST YOUR PROPERTY
            </button>
        </li>
    </ul>
</aside>

<script>
    // 1. Projects Dropdown Hover & Click on Desktop
    const projectsItem = document.getElementById('navProjectsItem');
    const projectsDropdown = document.getElementById('navProjectsDropdown');
    const projectsBtn = document.getElementById('navProjectsBtn');

    projectsBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        projectsDropdown?.classList.toggle('dropdownOpen');
    });

    projectsItem?.addEventListener('mouseenter', () => {
        projectsDropdown?.classList.add('dropdownOpen');
    });

    projectsItem?.addEventListener('mouseleave', () => {
        projectsDropdown?.classList.remove('dropdownOpen');
    });

    document.addEventListener('click', () => {
        projectsDropdown?.classList.remove('dropdownOpen');
    });

    // 2. STICKY NAVBAR ON SCROLL (EXACT MATCH TO IMAGE 3)
    const siteHeader = document.getElementById('siteHeader');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 40) {
            siteHeader?.classList.add('sticky-header');
        } else {
            siteHeader?.classList.remove('sticky-header');
        }
    });

    // 3. Mobile Navigation Drawer Controls
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileDrawer = document.getElementById('mobileDrawer');
    const mobileBackdrop = document.getElementById('mobileBackdrop');
    const mobileDrawerClose = document.getElementById('mobileDrawerClose');
    const mobileProjectsToggle = document.getElementById('mobileProjectsToggle');
    const mobileProjectsSubmenu = document.getElementById('mobileProjectsSubmenu');
    const mobileChevronIcon = document.getElementById('mobileChevronIcon');

    const openMenu = () => {
        mobileDrawer?.classList.add('mobileDrawerOpen');
        mobileBackdrop?.classList.add('mobileDrawerOverlayActive');
        document.body.style.overflow = 'hidden';
    };

    const closeMenu = () => {
        mobileDrawer?.classList.remove('mobileDrawerOpen');
        mobileBackdrop?.classList.remove('mobileDrawerOverlayActive');
        document.body.style.overflow = '';
    };

    mobileMenuBtn?.addEventListener('click', openMenu);
    mobileDrawerClose?.addEventListener('click', closeMenu);
    mobileBackdrop?.addEventListener('click', closeMenu);

    // Close on any link click
    document.querySelectorAll('.mobileNavLink, .mobileSubItem').forEach(item => {
        if (item.id !== 'mobileProjectsToggle') {
            item.addEventListener('click', closeMenu);
        }
    });

    // Toggle Mobile Projects Submenu
    mobileProjectsToggle?.addEventListener('click', (e) => {
        e.preventDefault();
        const isOpen = mobileProjectsSubmenu.style.display === 'flex';
        mobileProjectsSubmenu.style.display = isOpen ? 'none' : 'flex';
        mobileChevronIcon.style.transform = isOpen ? 'none' : 'rotate(180deg)';
    });
</script>