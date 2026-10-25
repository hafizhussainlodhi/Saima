const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const matches = [...content.matchAll(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/gi)];
    matches.forEach(m => {
        let jsonStr = m[1].replace(/@@/g, '@');
        try {
            const data = JSON.parse(jsonStr);
            if (data['@type'] === 'FAQPage' && Array.isArray(data.mainEntity)) {
                console.log(`${file}: FAQPage has ${data.mainEntity.length} questions and answers!`);
            }
        } catch (e) {
            console.log(`${file}: parse error`, e.message);
        }
    });
}
