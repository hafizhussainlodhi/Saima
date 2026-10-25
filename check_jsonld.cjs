const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const jsonLdMatch = content.match(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/i);
    if (jsonLdMatch) {
        try {
            const data = JSON.parse(jsonLdMatch[1]);
            if (data['@type'] === 'FAQPage' && data.mainEntity) {
                console.log(`${file}: Found FAQPage JSON-LD with ${data.mainEntity.length} Q&As!`);
            } else {
                console.log(`${file}: JSON-LD type = ${data['@type']}`);
            }
        } catch (e) {
            console.log(`${file}: JSON parse error: ${e.message}`);
        }
    } else {
        console.log(`${file}: NO JSON-LD`);
    }
}
