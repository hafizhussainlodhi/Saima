const fs = require('fs');
const path = require('path');

const cssDir = path.join(__dirname, 'public', 'css', 'communities');
const files = fs.readdirSync(cssDir).filter(f => f.endsWith('.css'));

for (const file of files) {
    const content = fs.readFileSync(path.join(cssDir, file), 'utf8');
    const matches = content.match(/[^{}]*(?:faq|answer|question)[^{}]*\{[^{}]*\}/gi) || [];
    if (matches.length > 0) {
        console.log(`\n=== CSS: ${file} ===`);
        matches.slice(0, 10).forEach(m => console.log(m.trim().substring(0, 150)));
    }
}
