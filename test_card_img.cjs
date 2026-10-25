const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/wadeem-gardens.blade.php', 'utf8');

const match = html.match(/<div class="[^"]*card[^"]*"[^>]*>([\s\S]*?)<\/div>/);
if (match) {
  console.log('Card innerHTML:', match[1]);
}
