const str = '<img alt="Hero" srcSet="/_next/image?url=%2Fimages%2Fwadeem-gardens%2Fhero-1.png&amp;w=640&amp;q=75 640w" src="/_next/image?url=%2Fimages%2Fwadeem-gardens%2Fhero-1.png&amp;w=3840&amp;q=75" class="slideImage">';

let cleaned = str.replace(/srcset="[^"]*"/gi, '');
cleaned = cleaned.replace(/src="\/_next\/image\?url=([^&"]+)[^"]*"/gi, (match, p1) => {
  return `src="${decodeURIComponent(p1)}"`;
});

console.log('Result:', cleaned);
