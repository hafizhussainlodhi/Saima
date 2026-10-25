const fs = require('fs');
const content = fs.readFileSync('resources/views/communities/al-naseem-villas.blade.php', 'utf8');
const faqIdx = content.indexOf('id="faq"');
const secEnd = content.indexOf('</section>', faqIdx);
console.log(content.substring(faqIdx, secEnd + 10));
