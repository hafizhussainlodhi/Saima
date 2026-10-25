const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const faqIdx = content.indexOf('id="faq"');
    if (faqIdx === -1) continue;
    const secStart = content.lastIndexOf('<section', faqIdx);
    const secEnd = content.indexOf('</section>', faqIdx);
    const secHtml = content.substring(secStart !== -1 ? secStart : faqIdx, secEnd !== -1 ? secEnd + 10 : faqIdx + 1000);
    
    console.log(`\n================== ${file} ==================`);
    console.log(secHtml.substring(0, 800));
}
