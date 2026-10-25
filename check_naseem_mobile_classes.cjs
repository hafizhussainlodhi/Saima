const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/al-naseem-villas.blade.php', 'utf8');
const matches = html.match(/class="[^"]*mobile[^"]*"/gi) || [];
console.log([...new Set(matches)]);
