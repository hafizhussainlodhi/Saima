const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/wadeem-gardens.blade.php', 'utf8');

const match = html.match(/<aside[\s\S]*?<\/aside>/);
if (match) {
  console.log(match[0]);
} else {
  // Check for mobileDrawer div
  const match2 = html.match(/<div class="[^"]*mobileDrawer[^"]*"[\s\S]*?<\/div>/);
  if (match2) console.log(match2[0].substring(0, 1000));
  else console.log('No aside or mobileDrawer found');
}
