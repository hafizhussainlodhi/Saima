const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

const mobileDrawerScript = `
  // ========================================================================
  // Universal Mobile Drawer & Submenu (Port 3000 Parity)
  // ========================================================================
  function initMobileDrawer() {
    var mobileToggle = document.querySelector('button[class*="mobileToggle"], #mobileMenuBtn');
    if (!mobileToggle) return;

    var communities = [
      { name: "Wadeem Gardens", href: "/wadeem-gardens" },
      { name: "Hudayriyat Golf Estates", href: "/hudayriyat-golf-estates" },
      { name: "Bashayer Residences", href: "/bashayer-residences" },
      { name: "Nawayef East Hills", href: "/nawayef-east-hills" },
      { name: "Bashayer Villas", href: "/bashayer-villas" },
      { name: "Al Naseem Villas", href: "/al-naseem-villas" },
      { name: "Masyaf Plots", href: "/masyaf-plots" },
      { name: "Nawayef Village", href: "/nawayef-village" },
      { name: "Wadeem Plots", href: "/wadeem-plots" },
      { name: "Nawayef Park Views", href: "/nawayef-park-views" }
    ];

    // Ensure Backdrop exists
    var backdrop = document.getElementById('commMobileBackdrop');
    if (!backdrop) {
      backdrop = document.createElement('div');
      backdrop.id = 'commMobileBackdrop';
      backdrop.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.65);backdrop-filter:blur(4px);z-index:99998;display:none;';
      document.body.appendChild(backdrop);
    }

    // Check if a mobile drawer already exists in DOM
    var drawer = document.querySelector('div[class*="mobileDrawer"], aside[class*="mobileDrawer"]');

    if (!drawer) {
      drawer = document.createElement('div');
      drawer.id = 'commUniversalMobileDrawer';
      drawer.style.cssText = 'position:fixed;top:0;right:-320px;width:300px;height:100vh;background:#18191c;z-index:99999;padding:28px 24px 40px;box-sizing:border-box;transition:right 0.3s cubic-bezier(0.25,1,0.5,1);overflow-y:auto;';
      
      var commLinksHtml = communities.map(function(c) {
        return '<a href="' + c.href + '" style="color:rgba(255,255,255,0.8);font-size:14px;text-decoration:none;padding:7px 0;display:block;">' + c.name + '</a>';
      }).join('');

      drawer.innerHTML = \`
        <button type="button" class="drawerCloseBtn" style="background:none;border:none;color:#ffffff;cursor:pointer;margin-bottom:20px;display:flex;align-items:center;">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;">
          <li><a href="/" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:block;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.08);">Home</a></li>
          <li>
            <button type="button" class="mobileDrawerProjectsBtn" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:flex;align-items:center;justify-content:space-between;width:100%;background:none;border:none;padding:8px 0;text-align:left;cursor:pointer;border-bottom:1px solid rgba(255,255,255,0.08);font-family:inherit;">
              <span>Projects</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="drawerChevron" style="transition:transform 0.25s ease;"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div class="mobileSubList" style="display:none;padding-left:14px;flex-direction:column;gap:8px;margin-top:10px;">
              \${commLinksHtml}
            </div>
          </li>
          <li><a href="#floorplans" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:block;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.08);">Floor Plan</a></li>
          <li><a href="#master" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:block;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.08);">Master Plan</a></li>
          <li><a href="#paymentplan" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:block;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.08);">Payment Plan</a></li>
          <li><a href="#faq" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:block;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.08);">FAQ</a></li>
          <li><a href="/contact-us" style="color:#ffffff;font-size:16px;font-weight:600;text-decoration:none;display:block;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.08);">Contact Us</a></li>
          <li style="margin-top:12px;">
            <button type="button" class="listPropBtnMobile" onclick="window.openListModal ? window.openListModal() : null" style="width:100%;background:#856d52;color:#ffffff;border:none;border-radius:4px;padding:12px;font-size:14px;font-weight:700;text-transform:uppercase;cursor:pointer;">
              LIST YOUR PROPERTY
            </button>
          </li>
        </ul>
      \`;
      document.body.appendChild(drawer);
    } else {
      // If drawer already exists in DOM (like in Wadeem Gardens or Golf Estates)
      // Ensure the mobileSubList exists inside the Projects li
      var projLi = drawer.querySelector('li button, li a');
      var existingSub = drawer.querySelector('.mobileSubList, div[class*="mobileSubList"]');
      if (!existingSub) {
        var allBtns = drawer.querySelectorAll('button, a');
        allBtns.forEach(function(btn) {
          if ((btn.innerText || '').toUpperCase().includes('PROJECT')) {
            var subDiv = document.createElement('div');
            subDiv.className = 'mobileSubList';
            subDiv.style.cssText = 'display:none;padding-left:14px;flex-direction:column;gap:8px;margin-top:10px;';
            subDiv.innerHTML = communities.map(function(c) {
              return '<a href="' + c.href + '" class="mobileSubItem" style="color:rgba(255,255,255,0.85);font-size:14px;text-decoration:none;padding:7px 0;display:block;">' + c.name + '</a>';
            }).join('');
            btn.parentElement.appendChild(subDiv);
          }
        });
      }
    }

    // Controls
    function openDrawer() {
      drawer.style.right = '0';
      drawer.classList.add('mobileDrawerOpen');
      drawer.style.display = 'block';
      backdrop.style.display = 'block';
      document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
      drawer.style.right = '-320px';
      drawer.classList.remove('mobileDrawerOpen');
      backdrop.style.display = 'none';
      document.body.style.overflow = '';
    }

    mobileToggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      openDrawer();
    });

    backdrop.addEventListener('click', closeDrawer);

    var closeBtn = drawer.querySelector('button[class*="mobileCloseBtn"], .drawerCloseBtn');
    if (closeBtn) {
      closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        closeDrawer();
      });
    }

    // Projects Button in Drawer Toggle Submenu
    var drawerProjectsBtns = drawer.querySelectorAll('button, a');
    drawerProjectsBtns.forEach(function(btn) {
      if ((btn.innerText || '').toUpperCase().includes('PROJECT')) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          var sub = btn.parentElement.querySelector('.mobileSubList, div[class*="mobileSubList"]');
          var chevron = btn.querySelector('svg');
          if (sub) {
            var isHidden = (sub.style.display === 'none' || sub.style.display === '');
            sub.style.display = isHidden ? 'flex' : 'none';
            if (chevron) {
              chevron.style.transform = isHidden ? 'rotate(180deg)' : 'none';
              chevron.style.transition = 'transform 0.25s ease';
            }
          }
        });
      }
    });

    // Close drawer when clicking any link that navigates
    drawer.querySelectorAll('a').forEach(function(link) {
      link.addEventListener('click', function() {
        closeDrawer();
      });
    });
  }
`;

for (const b of BACKEND_DIRS) {
  const jsFile = path.join(b, 'public/js/communities/community-interactions.js');
  if (!fs.existsSync(jsFile)) continue;

  let content = fs.readFileSync(jsFile, 'utf8');

  // Replace initCommunitiesDropdown implementation with initMobileDrawer call
  content = content.replace('initCommunitiesDropdown();', 'initCommunitiesDropdown();\n    initMobileDrawer();');
  content = content + '\n' + mobileDrawerScript;
  
  fs.writeFileSync(jsFile, content, 'utf8');
  console.log(`Added initMobileDrawer to ${jsFile}`);
}
