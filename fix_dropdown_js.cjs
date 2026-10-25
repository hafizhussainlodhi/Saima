const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

for (const b of BACKEND_DIRS) {
  const jsFile = path.join(b, 'public/js/communities/community-interactions.js');
  if (!fs.existsSync(jsFile)) continue;

  let content = fs.readFileSync(jsFile, 'utf8');

  // Replace initCommunitiesDropdown with comprehensive initProjectsAndCommunitiesDropdown
  const oldFuncRegex = /function initCommunitiesDropdown\(\) \{[\s\S]*?\n  \}/;

  const newFunc = `function initCommunitiesDropdown() {
    // 1. Desktop Nav Projects / Communities Dropdown (Hover & Click)
    var navItems = document.querySelectorAll('li[class*="navItem"], .navItem');
    navItems.forEach(function(item) {
      var dropdown = item.querySelector('div[class*="dropdownMenu"], div[class*="DropdownMenu"], ul[class*="dropdown"], div[class*="dropdown"]');
      var btn = item.querySelector('button');
      if (!dropdown || !btn) return;

      var btnText = (btn.innerText || '').toUpperCase();
      if (btnText.includes('PROJECT') || btnText.includes('COMMUNIT')) {
        var isOpen = false;

        function showDropdown() {
          isOpen = true;
          dropdown.style.opacity = '1';
          dropdown.style.visibility = 'visible';
          dropdown.style.transform = 'translateY(0)';
          dropdown.style.pointerEvents = 'auto';
          dropdown.style.display = 'block';
          dropdown.classList.add('dropdownOpen');
          dropdown.style.zIndex = '9999';
        }

        function hideDropdown() {
          isOpen = false;
          dropdown.style.opacity = '0';
          dropdown.style.visibility = 'hidden';
          dropdown.style.transform = 'translateY(10px)';
          dropdown.style.pointerEvents = 'none';
          dropdown.classList.remove('dropdownOpen');
        }

        // Hover for Desktop
        item.addEventListener('mouseenter', showDropdown);
        item.addEventListener('mouseleave', hideDropdown);

        // Click for Touch / Mobile
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          if (isOpen) {
            hideDropdown();
          } else {
            showDropdown();
          }
        });
      }
    });

    // Close on click outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('li[class*="navItem"], .navItem')) {
        document.querySelectorAll('div[class*="dropdownMenu"], div[class*="DropdownMenu"]').forEach(function(d) {
          d.style.opacity = '0';
          d.style.visibility = 'hidden';
          d.style.transform = 'translateY(10px)';
          d.style.pointerEvents = 'none';
          d.classList.remove('dropdownOpen');
        });
      }
    });

    // 2. Mobile Navigation Drawer Controls
    var mobileToggle = document.querySelector('button[class*="mobileToggle"], #mobileMenuBtn');
    var mobileDrawer = document.querySelector('aside[class*="mobileDrawer"], div[class*="mobileDrawer"], #mobileDrawer');
    var mobileClose = document.querySelector('button[class*="mobileCloseBtn"], #mobileDrawerClose');
    var mobileOverlay = document.querySelector('div[class*="mobileDrawerOverlay"], #mobileBackdrop');
    var mobileProjectsToggle = document.querySelector('#mobileProjectsToggle, button[class*="mobileNavLink"]');
    var mobileSubmenu = document.querySelector('div[class*="mobileSubList"], #mobileProjectsSubmenu');

    if (mobileToggle && mobileDrawer) {
      mobileToggle.addEventListener('click', function(e) {
        e.preventDefault();
        mobileDrawer.style.right = '0';
        mobileDrawer.classList.add('mobileDrawerOpen');
        if (mobileOverlay) mobileOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
      });
    }

    function closeMobile() {
      if (mobileDrawer) {
        mobileDrawer.style.right = '-320px';
        mobileDrawer.classList.remove('mobileDrawerOpen');
      }
      if (mobileOverlay) mobileOverlay.style.display = 'none';
      document.body.style.overflow = '';
    }

    if (mobileClose) mobileClose.addEventListener('click', closeMobile);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobile);

    // Mobile submenu toggle
    var mobileNavBtns = document.querySelectorAll('button[class*="mobileNavLink"]');
    mobileNavBtns.forEach(function(btn) {
      if (btn.innerText && btn.innerText.includes('PROJECT')) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          var sub = btn.parentElement.querySelector('div[class*="mobileSubList"]');
          if (sub) {
            var isShown = sub.style.display === 'flex' || sub.style.display === 'block';
            sub.style.display = isShown ? 'none' : 'flex';
          }
        });
      }
    });
  }`;

  content = content.replace(oldFuncRegex, newFunc);
  fs.writeFileSync(jsFile, content, 'utf8');
  console.log(`Updated community-interactions.js in ${jsFile}`);
}
