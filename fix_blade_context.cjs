const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

for (const b of BACKEND_DIRS) {
  const dir = path.join(b, 'resources/views/communities');
  if (!fs.existsSync(dir)) continue;

  const files = fs.readdirSync(dir);
  for (const f of files) {
    if (!f.endsWith('.blade.php')) continue;
    const fp = path.join(dir, f);
    let content = fs.readFileSync(fp, 'utf8');
    // Escape @context -> @@context, @type -> @@type
    content = content.replace(/"@context"/g, '"@@context"');
    content = content.replace(/"@type"/g, '"@@type"');
    content = content.replace(/"@id"/g, '"@@id"');
    fs.writeFileSync(fp, content, 'utf8');
  }
}

console.log("All @context/@type escaped successfully!");
