const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

const communities = [
  { name: "Wadeem Gardens", href: "/wadeem-gardens" },
  { name: "Hudayriyat Golf Estates", href: "/hudayriyat-golf-estates" },
  { name: "Bashayer Residences", href: "/bashayer-residences" },
  { name: "Nawayef East Hills", href: "/nawayef-east-hills" },
  { name: "Bashayer Villas", href: "/bashayer-villas" },
  { name: "Al Naseem Villas", href: "/al-naseem-villas" },
  { name: "Masyaf Plots", href: "/masyaf-plots" },
  { name: "Nawayef Village", href: "/nawayef-village" },
  { name: "Wadeem Plots", href: "/wadeem-plots" },
  { name: "Nawayef Park Views", href: "/nawayef-park-views" },
];

const subListHtml = `<div class="mobileSubList" style="display: none; padding-left: 14px; flex-direction: column; gap: 8px; margin-top: 8px;">
` + communities.map(c => `  <a href="${c.href}" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">${c.name}</a>`).join('\n') + `\n</div>`;

for (const b of BACKEND_DIRS) {
  const dir = path.join(b, 'resources/views/communities');
  if (!fs.existsSync(dir)) continue;

  const files = fs.readdirSync(dir);
  for (const f of files) {
    if (!f.endsWith('.blade.php')) continue;
    const fp = path.join(dir, f);
    let content = fs.readFileSync(fp, 'utf8');

    // Check if mobileSubList already exists in this file
    if (!content.includes('mobileSubList')) {
      // Find the mobile button containing Projects
      // Regex matches: (<li><button[^>]*class="[^"]*mobileNavLink[^"]*"[^>]*>[\s\S]*?Projects[\s\S]*?<\/button>)
      const regex = /(<li><button[^>]*class="[^"]*mobileNavLink[^"]*"[^>]*>[\s\S]*?Projects[\s\S]*?<\/button>)/i;
      if (regex.test(content)) {
        content = content.replace(regex, `$1\n${subListHtml}`);
        fs.writeFileSync(fp, content, 'utf8');
        console.log(`Inserted mobileSubList in ${f} in ${b}`);
      } else {
        console.log(`Could not find mobile Projects button in ${f}`);
      }
    } else {
      console.log(`mobileSubList already present in ${f}`);
    }
  }
}
