const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');
const files = fs.readdirSync(commDir).filter(f => f.endsWith('.blade.php'));

for (const file of files) {
    const content = fs.readFileSync(path.join(commDir, file), 'utf8');
    const hasFaqId = content.includes('id="faq"');
    const hasFaqQuestion = content.includes('faqQuestion');
    const hasFaqCard = content.includes('faqCard');
    const hasFaqSection = content.includes('faqSection') || content.includes('Faq');
    
    // Check how many questions and answers exist
    const qCount = (content.match(/faqQuestion/g) || []).length;
    const aCount = (content.match(/faqAnswer/g) || []).length;
    
    console.log(`${file}: id=faq? ${hasFaqId}, questions=${qCount}, answers=${aCount}`);
}

// Also check dynamic-page.blade.php
const dynContent = fs.readFileSync(path.join(__dirname, 'resources', 'views', 'dynamic-page.blade.php'), 'utf8');
console.log(`dynamic-page.blade.php: id=faq? ${dynContent.includes('id="faq"')}, questions=${(dynContent.match(/faqQuestion/g) || []).length}, answers=${(dynContent.match(/faqAnswer/g) || []).length}`);

// Also check partials/faq.blade.php
const partialContent = fs.readFileSync(path.join(__dirname, 'resources', 'views', 'partials', 'faq.blade.php'), 'utf8');
console.log(`partials/faq.blade.php: id=faq? ${partialContent.includes('id="faq"')}, questions=${(partialContent.match(/faqQuestion/g) || []).length}, answers=${(partialContent.match(/faqAnswer/g) || []).length}`);
