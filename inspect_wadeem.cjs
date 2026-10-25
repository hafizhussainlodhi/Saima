const fs = require('fs');
const path = require('path');

const content = fs.readFileSync(path.join(__dirname, 'resources', 'views', 'communities', 'wadeem-gardens.blade.php'), 'utf8');
const idx = content.indexOf('id="faq"');
console.log('=== wadeem-gardens FAQ ===');
console.log(content.substring(idx - 200, idx + 1500));

// Also check scripts at the bottom of wadeem-gardens.blade.php
const lastScripts = content.substring(content.lastIndexOf('<script'));
console.log('=== wadeem-gardens Scripts ===');
console.log(lastScripts);
