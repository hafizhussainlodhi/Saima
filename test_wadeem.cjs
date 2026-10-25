const http = require('http');
const fs = require('fs');
const path = require('path');

function fetchUrl(url) {
  return new Promise((resolve, reject) => {
    http.get(url, res => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve(data));
      res.on('error', reject);
    });
  });
}

async function testWadeem() {
  console.log('Fetching wadeem-gardens from port 3000...');
  const html = await fetchUrl('http://localhost:3000/wadeem-gardens');
  
  // Extract CSS
  const cssMatches = html.match(/href="(\/_next\/static\/chunks\/[^"]+\.css)"/g) || [];
  console.log('CSS files:', cssMatches);
  
  // Extract main
  const mainMatch = html.match(/<main[\s\S]*?<\/main>/);
  if (!mainMatch) {
    console.error('No main found!');
    return;
  }
  
  console.log('Main length:', mainMatch[0].length);
}

testWadeem();
