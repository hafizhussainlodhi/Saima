const http = require('http');
const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

const PAGES = [
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

async function build() {
  console.log("=== STARTING COMMUNITY PAGES BUILDER ===");

  // Ensure directories exist in both backends
  for (const b of BACKEND_DIRS) {
    if (!fs.existsSync(b)) continue;
    fs.mkdirSync(path.join(b, 'resources/views/communities'), { recursive: true });
    fs.mkdirSync(path.join(b, 'public/css/communities'), { recursive: true });
    fs.mkdirSync(path.join(b, 'public/js/communities'), { recursive: true });
  }

  // 1. Download global CSS bundle
  console.log("Fetching global CSS...");
  const globalCssContent = await fetchUrl('http://localhost:3000/_next/static/chunks/%5Broot-of-the-server%5D__1wmhobf._.css');
  for (const b of BACKEND_DIRS) {
    if (fs.existsSync(b)) {
      fs.writeFileSync(path.join(b, 'public/css/communities/global.css'), globalCssContent, 'utf8');
    }
  }

  // 2. Process each page
  for (const slug of PAGES) {
    console.log(`Processing ${slug}...`);
    const html = await fetchUrl(`http://localhost:3000/${slug}`);

    // Extract page-specific CSS file
    const cssMatch = html.match(/href="(\/_next\/static\/chunks\/[^"]+\.css)"/g) || [];
    let pageCssContent = '';
    for (const link of cssMatch) {
      const cleanHref = link.replace(/href="|"/g, '');
      if (!cleanHref.includes('1wmhobf')) {
        const cssUrl = `http://localhost:3000${cleanHref}`;
        pageCssContent += '\n' + (await fetchUrl(cssUrl));
      }
    }

    // Save page CSS
    for (const b of BACKEND_DIRS) {
      if (fs.existsSync(b)) {
        fs.writeFileSync(path.join(b, `public/css/communities/${slug}.css`), pageCssContent, 'utf8');
      }
    }

    // Extract <main> ... </main>
    const mainMatch = html.match(/<main[\s\S]*?<\/main>/);
    if (!mainMatch) {
      console.error(`Failed to extract main for ${slug}`);
      continue;
    }

    let mainHtml = mainMatch[0];

    // Clean Next.js images: /_next/image?url=%2Fimages%2F... -> /images/...
    mainHtml = mainHtml.replace(/srcset="[^"]*"/gi, '');
    mainHtml = mainHtml.replace(/src="\/_next\/image\?url=([^&"]+)[^"]*"/gi, (m, p1) => {
      return `src="${decodeURIComponent(p1)}"`;
    });

    // Clean Next.js route prefetching and attributes
    mainHtml = mainHtml.replace(/data-nimg="[^"]*"/gi, '');
    mainHtml = mainHtml.replace(/decoding="async"/gi, '');
    mainHtml = mainHtml.replace(/loading="lazy"/gi, '');

    // Construct Blade View
    const bladeTemplate = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>${slug.split('-').map(s => s.charAt(0).toUpperCase() + s.slice(1)).join(' ')} | Hudayriyat Island Abu Dhabi</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/communities/global.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/communities/' . '${slug}' . '.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/hudayriyat.css') }}?v={{ time() }}">
    
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        color: #222222;
        background-color: #ffffff;
      }
      .slideHidden {
        display: none !important;
      }
      .slideActive {
        display: block !important;
      }
      .tabHidden {
        display: none !important;
      }
      .tabActive {
        display: block !important;
      }
      .accClosed {
        max-height: 0px !important;
        overflow: hidden !important;
        opacity: 0 !important;
        transition: max-height 0.35s ease, opacity 0.35s ease;
      }
      .accOpen {
        max-height: 1000px !important;
        opacity: 1 !important;
        transition: max-height 0.35s ease, opacity 0.35s ease;
      }
      .modalHidden {
        display: none !important;
      }
      .modalVisible {
        display: flex !important;
      }
    </style>
</head>
<body>
    ${mainHtml}

    <!-- Community Client JavaScript -->
    <script src="{{ asset('js/communities/community-interactions.js') }}?v={{ time() }}"></script>
</body>
</html>
`;

    for (const b of BACKEND_DIRS) {
      if (fs.existsSync(b)) {
        fs.writeFileSync(path.join(b, `resources/views/communities/${slug}.blade.php`), bladeTemplate, 'utf8');
      }
    }
  }

  console.log("=== ALL COMMUNITY BLADE VIEWS & CSS GENERATED ===");
}

build().catch(console.error);
