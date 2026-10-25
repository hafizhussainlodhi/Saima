const fs = require('fs');
const html = fs.readFileSync('C:/Users/Administrator/Desktop/backend/resources/views/communities/wadeem-gardens.blade.php', 'utf8');

const match = html.match(/<section[^>]*Gallery[\s\S]*?<\/section>/);
if (match) {
  const g = match[0];
  console.log('Has carouselContainer?', g.includes('carouselContainer'));
  console.log('Has prevBtn?', g.includes('prevBtn'));
  console.log('Has nextBtn?', g.includes('nextBtn'));
  console.log('Has track?', g.includes('track'));
  console.log('Has card?', g.includes('card'));
  console.log('Has dotsWrapper?', g.includes('dotsWrapper'));
  console.log('Has dot?', g.includes('dot'));
}
