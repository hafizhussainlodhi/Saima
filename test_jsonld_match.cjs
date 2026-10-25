const fs = require('fs');
const content = fs.readFileSync('resources/views/communities/al-naseem-villas.blade.php', 'utf8');
const matches = [...content.matchAll(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/gi)];
console.log('Matches found:', matches.length);
matches.forEach((m, idx) => {
    console.log(`--- Match ${idx+1} ---`);
    console.log(m[1].substring(0, 300));
});
