const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/hudayriyat-golf-estates.blade.php', 'utf8');
const headerMatch = html.match(/<header[\s\S]*?<\/header>/);
if (headerMatch) {
  console.log(headerMatch[0]);
} else {
  console.log('No header found');
}
