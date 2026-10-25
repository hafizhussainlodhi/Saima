const http = require('http');

http.get('http://localhost:3000/wadeem-gardens', res => {
  let data = '';
  res.on('data', chunk => data += chunk);
  res.on('end', () => {
    const imgMatches = data.match(/<img[^>]+src="([^">]+)"/g) || [];
    console.log('Total images on page:', imgMatches.length);
    console.log('Sample images:', imgMatches.slice(0, 10));
  });
});
