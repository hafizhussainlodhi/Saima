const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

for (const b of BACKEND_DIRS) {
  const headerFile = path.join(b, 'resources/views/partials/header.blade.php');
  if (!fs.existsSync(headerFile)) continue;

  let content = fs.readFileSync(headerFile, 'utf8');

  // Replace desktop dropdown links
  const oldDesktop = `<div class="dropdownMenu" id="navProjectsDropdown">
                        <a href="#communities" class="dropdownItem">Wadeem Gardens</a>
                        <a href="#communities" class="dropdownItem">Hudayriyat Golf Estates</a>
                        <a href="#communities" class="dropdownItem">Bashayer Residences</a>
                        <a href="#communities" class="dropdownItem">Nawayef East Hills</a>
                        <a href="#communities" class="dropdownItem">Bashayer Villas</a>
                        <a href="#communities" class="dropdownItem">Al Naseem Villas</a>
                        <a href="#communities" class="dropdownItem">Masyaf Plots</a>
                        <a href="#communities" class="dropdownItem">Nawayef Village</a>
                        <a href="#communities" class="dropdownItem">Wadeem Plots</a>
                        <a href="#communities" class="dropdownItem">Nawayef Park Views</a>
                    </div>`;

  const newDesktop = `<div class="dropdownMenu" id="navProjectsDropdown">
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
                    </div>`;

  // Replace mobile drawer links
  const oldMobile = `<div id="mobileProjectsSubmenu" class="mobileSubList" style="display: none;">
                <a href="#communities" class="mobileSubItem">Wadeem Gardens</a>
                <a href="#communities" class="mobileSubItem">Hudayriyat Golf Estates</a>
                <a href="#communities" class="mobileSubItem">Bashayer Residences</a>
                <a href="#communities" class="mobileSubItem">Nawayef East Hills</a>
                <a href="#communities" class="mobileSubItem">Bashayer Villas</a>
                <a href="#communities" class="mobileSubItem">Al Naseem Villas</a>
                <a href="#communities" class="mobileSubItem">Masyaf Plots</a>
                <a href="#communities" class="mobileSubItem">Nawayef Village</a>
                <a href="#communities" class="mobileSubItem">Wadeem Plots</a>
                <a href="#communities" class="mobileSubItem">Nawayef Park Views</a>
            </div>`;

  const newMobile = `<div id="mobileProjectsSubmenu" class="mobileSubList" style="display: none;">
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
            </div>`;

  content = content.replace(oldDesktop, newDesktop).replace(oldMobile, newMobile);
  fs.writeFileSync(headerFile, content, 'utf8');
  console.log(`Updated header in ${headerFile}`);
}
