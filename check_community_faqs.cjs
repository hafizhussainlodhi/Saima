const fs = require('fs');
const path = require('path');

const dir = 'resources/views/communities';
const files = fs.readdirSync(dir);

for (const file of files) {
    if (!file.endsWith('.blade.php')) continue;
    const content = fs.readFileSync(path.join(dir, file), 'utf8');
    const hasFaqSection = content.includes('id="faq"') || content.includes('faqSection');
    const cardMatches = content.match(/class="[^"]*faqCard[^"]*"/g) || [];
    const answerMatches = content.match(/class="[^"]*faqAnswer[^"]*"/g) || [];
    const questionMatches = content.match(/class="[^"]*faqQuestion[^"]*"/g) || [];
    
    // Check if there is any script for faq
    const hasFaqScript = content.includes('toggleFaq') || content.includes('faqQuestion');
    console.log(`${file}:`);
    console.log(`  hasFaqSection: ${hasFaqSection}`);
    console.log(`  cards: ${cardMatches.length}, answers: ${answerMatches.length}, questions: ${questionMatches.length}`);
}
