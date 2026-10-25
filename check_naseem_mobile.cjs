const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/al-naseem-villas.blade.php', 'utf8');
const match = html.match(/<div class="[^"]*mobileDrawer[^"]*"[\s\S]*?<\/div>/);
if (match) {
  console.log(match[0].substring(0, 800));
} else {
  console.log('No mobileDrawer div in al-naseem-villas');
}
