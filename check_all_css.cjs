const http = require('http');

const pages = [
  "wadeem-gardens",
  "hudayriyat-golf-estates",
  "bashayer-villas",
  "bashayer-residences",
  "al-naseem-villas",
  "nawayef-east-hills",
  "masyaf-plots",
  "nawayef-village",
  "wadeem-plots",
  "nawayef-park-views"
];

async function check() {
  for (const p of pages) {
    await new Promise(resolve => {
      http.get(`http://localhost:3000/${p}`, res => {
        let data = '';
        res.on('data', chunk => data += chunk);
        res.on('end', () => {
          const links = (data.match(/href="(\/_next\/static\/chunks\/[^"]+\.css)"/g) || [])
            .map(x => x.replace(/href="|"/g, ''));
          console.log(p, '->', links);
          resolve();
        });
      });
    });
  }
}

check();
