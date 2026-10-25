const fs = require('fs');

function inspectFaq(file) {
    const content = fs.readFileSync(file, 'utf8');
    const idx = content.indexOf('id="faq"');
    if (idx !== -1) {
        console.log(`=== ${file} ===`);
        console.log(content.substring(idx - 50, idx + 800));
    }
}

inspectFaq('resources/views/communities/al-naseem-villas.blade.php');
inspectFaq('resources/views/communities/wadeem-gardens.blade.php');
