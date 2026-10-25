const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/wadeem-gardens.blade.php', 'utf8');
const match = html.match(/<li><button[^>]*class="[^"]*mobileNavLink[^"]*"[^>]*>[\s\S]*?<\/li>/);
if (match) console.log(match[0]);
