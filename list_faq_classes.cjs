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
    
    // Find class names used in this section
    const classes = new Set();
    const classMatches = secHtml.matchAll(/class="([^"]+)"/g);
    for (const m of classMatches) {
        m[1].split(/\s+/).forEach(c => {
            if (c.toLowerCase().includes('faq')) classes.add(c);
        });
    }
    console.log(`\n=== ${file} ===`);
    console.log('FAQ Classes:', Array.from(classes).join(', '));
}
