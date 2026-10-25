const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const idx = content.indexOf('id="faq"');
    if (idx !== -1) {
        console.log(`=== ${file} ===`);
        console.log(content.substring(idx - 50, idx + 400));
    }
}
