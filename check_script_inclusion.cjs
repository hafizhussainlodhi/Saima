const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const hasScript = content.includes('community-interactions.js');
    console.log(`${file}: includes community-interactions.js? ${hasScript}`);
}

const dynContent = fs.readFileSync('resources/views/dynamic-page.blade.php', 'utf8');
console.log(`dynamic-page.blade.php: includes community-interactions.js? ${dynContent.includes('community-interactions.js')}`);
