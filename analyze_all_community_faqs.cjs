const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const faqIdx = content.indexOf('id="faq"');
    if (faqIdx === -1) {
        console.log(`\n=== ${file}: NO id="faq" ===`);
        continue;
    }
    
    // Find the enclosing or following section
    const secStart = content.lastIndexOf('<section', faqIdx);
    const secEnd = content.indexOf('</section>', faqIdx);
    const secHtml = content.substring(secStart !== -1 ? secStart : faqIdx, secEnd !== -1 ? secEnd + 10 : faqIdx + 1000);
    
    // Count buttons and answers
    const buttons = secHtml.match(/<button[\s\S]*?<\/button>/gi) || [];
    const answers = (secHtml.match(/class="[^"]*(?:answer|content|body|faqAnswer)[^"]*"/gi) || []);
    
    console.log(`\n=== ${file} ===`);
    console.log(`Section length: ${secHtml.length}, Buttons: ${buttons.length}`);
    buttons.forEach((b, idx) => {
        // extract text
        const text = b.replace(/<[^>]+>/g, '').trim().replace(/\s+/g, ' ');
        console.log(`  Button ${idx + 1}: ${text.substring(0, 50)}`);
    });
    console.log(`Answer containers found: ${answers.length}`);
}
