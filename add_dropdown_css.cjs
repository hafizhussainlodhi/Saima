const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

const dropdownCss = `
/* ==========================================================================
   Universal Community Navbar Dropdown - 100% Port 3000 Parity
   ========================================================================== */
div[class*="dropdownMenu"], div[class*="DropdownMenu"], .dropdownMenu {
  position: absolute !important;
  top: 100% !important;
  left: 0 !important;
  background: #ffffff !important;
  border-radius: 6px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18) !important;
  min-width: 250px !important;
  max-height: 380px !important;
  overflow-y: auto !important;
  padding: 8px 0 !important;
  border: 1px solid rgba(0, 0, 0, 0.08) !important;
  z-index: 99999 !important;
  display: none;
  flex-direction: column !important;
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
}

div[class*="dropdownMenu"].dropdownOpen, div[class*="DropdownMenu"].dropdownOpen, .dropdownOpen {
  display: flex !important;
  flex-direction: column !important;
  opacity: 1 !important;
  visibility: visible !important;
  transform: translateY(0) !important;
  pointer-events: auto !important;
}

div[class*="dropdownMenu"] a, div[class*="DropdownMenu"] a, .dropdownItem, a[class*="dropdownItem"] {
  display: block !important;
  width: 100% !important;
  padding: 11px 20px !important;
  color: #2b2b2b !important;
  font-size: 13.5px !important;
  font-weight: 500 !important;
  text-decoration: none !important;
  text-align: left !important;
  white-space: nowrap !important;
  box-sizing: border-box !important;
  border-bottom: 1px solid #f2ede7 !important;
  transition: background 0.2s ease, color 0.2s ease, padding 0.2s ease !important;
}

div[class*="dropdownMenu"] a:last-child, div[class*="DropdownMenu"] a:last-child {
  border-bottom: none !important;
}

div[class*="dropdownMenu"] a:hover, div[class*="DropdownMenu"] a:hover, .dropdownItem:hover, a[class*="dropdownItem"]:hover {
  background: #f7f3ee !important;
  color: #856d52 !important;
  padding-left: 24px !important;
}

/* Custom Sleek Scrollbar for Dropdown */
div[class*="dropdownMenu"]::-webkit-scrollbar, div[class*="DropdownMenu"]::-webkit-scrollbar {
  width: 5px;
}
div[class*="dropdownMenu"]::-webkit-scrollbar-track, div[class*="DropdownMenu"]::-webkit-scrollbar-track {
  background: #f1f1f1;
}
div[class*="dropdownMenu"]::-webkit-scrollbar-thumb, div[class*="DropdownMenu"]::-webkit-scrollbar-thumb {
  background: #c5b5a5;
  border-radius: 4px;
}
`;

for (const b of BACKEND_DIRS) {
  // 1. Update public/css/communities/global.css
  const globalCss = path.join(b, 'public/css/communities/global.css');
  if (fs.existsSync(globalCss)) {
    let css = fs.readFileSync(globalCss, 'utf8');
    if (!css.includes('Universal Community Navbar Dropdown')) {
      fs.writeFileSync(globalCss, css + '\n' + dropdownCss, 'utf8');
      console.log(`Updated ${globalCss}`);
    }
  }

  // 2. Update public/css/hudayriyat.css
  const mainCss = path.join(b, 'public/css/hudayriyat.css');
  if (fs.existsSync(mainCss)) {
    let css = fs.readFileSync(mainCss, 'utf8');
    if (!css.includes('Universal Community Navbar Dropdown')) {
      fs.writeFileSync(mainCss, css + '\n' + dropdownCss, 'utf8');
      console.log(`Updated ${mainCss}`);
    }
  }
}
