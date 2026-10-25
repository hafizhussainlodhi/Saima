const fs = require('fs');

const file = 'resources/views/communities/hudayriyat-golf-estates.blade.php';
const content = fs.readFileSync(file, 'utf8');

const regexFaq = /faq/gi;
let match;
while ((match = regexFaq.exec(content)) !== null) {
    console.log(`Found "faq" at index ${match.index}:`);
    console.log(content.substring(Math.max(0, match.index - 50), Math.min(content.length, match.index + 100)));
}
