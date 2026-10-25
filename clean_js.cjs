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

  // Remove initMobileDrawer() call from DOMContentLoaded
  content = content.replace(/\n\s*initMobileDrawer\(\);/g, '');

  // Remove the entire initMobileDrawer function
  const mobileDrawerRegex = /\/\/ =+\s*\/\/ Universal Mobile Drawer[\s\S]*$/;
  content = content.replace(mobileDrawerRegex, '');

  fs.writeFileSync(jsFile, content, 'utf8');
  console.log(`Cleaned community-interactions.js in ${jsFile}`);
}
