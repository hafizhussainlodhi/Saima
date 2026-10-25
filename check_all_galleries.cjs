const fs = require('fs');
const dir = 'C:/Users/Administrator/Desktop/backend/resources/views/communities/';
const files = fs.readdirSync(dir);
for (const f of files) {
  if (!f.endsWith('.blade.php')) continue;
  const c = fs.readFileSync(dir + f, 'utf8');
  const m = c.match(/class="([^"]*Gallery[^"]*)"/g);
  console.log(f, '->', m ? m.slice(0, 3) : 'NONE');
}
