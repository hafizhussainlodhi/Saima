const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/wadeem-gardens.blade.php', 'utf8');

const match = html.match(/<li><button type="button" class="[^"]*mobileNavLink[^"]*">Projects[\s\S]*?<\/li>/);
if (match) {
  console.log(match[0]);
} else {
  console.log('Not found');
}
