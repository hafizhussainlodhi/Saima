const http = require('http');

http.get('http://localhost:3000/wadeem-gardens', res => {
  let data = '';
  res.on('data', chunk => data += chunk);
  res.on('end', () => {
    const styleMatches = data.match(/<style[^>]*>[\s\S]*?<\/style>/gi) || [];
    console.log('Inline styles count:', styleMatches.length);
    const linkMatches = data.match(/<link[^>]*rel=["']stylesheet["'][^>]*>/gi) || [];
    console.log('CSS links:', linkMatches);
  });
});
