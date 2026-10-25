const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

const allData = {};

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const matches = [...content.matchAll(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/gi)];
    for (const m of matches) {
        let jsonStr = m[1].replace(/@@/g, '@');
        try {
            const data = JSON.parse(jsonStr);
            if (data['@type'] === 'FAQPage' && Array.isArray(data.mainEntity)) {
                allData[file] = data.mainEntity.map(item => ({
                    q: item.name,
                    a: item.acceptedAnswer ? item.acceptedAnswer.text : ''
                }));
                break;
            }
        } catch (e) {}
    }
}

console.log(JSON.stringify(allData, null, 2));
