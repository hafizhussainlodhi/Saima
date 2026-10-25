const fs = require('fs');
const content = fs.readFileSync('C:/Users/Administrator/Desktop/backend/public/js/communities/community-interactions.js', 'utf8');
const match = content.match(/function initCommunitiesDropdown\(\) \{[\s\S]*?\n  \}/);
if (match) console.log(match[0]);
