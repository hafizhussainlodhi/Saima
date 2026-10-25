const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/wadeem-gardens.blade.php', 'utf8');
const matches = html.match(/href="(\/[a-z\-]+)"/g);
console.log([...new Set(matches)]);
