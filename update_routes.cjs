const fs = require('fs');
const path = require('path');

const BACKEND_DIRS = [
  'C:/Users/Administrator/Desktop/backend',
  'C:/Users/Administrator/Desktop/hudayriayt_git/backend'
];

const newRoutesCode = `<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('home');
})->name('home');

// API & Form Leads Endpoints
Route::post('/api/leads', [LeadController::class, 'store'])->name('leads.store');
Route::get('/api/detect-country', [LeadController::class, 'detectCountry'])->name('leads.detect-country');

// Dedicated Community Property Pages (100% Port 3000 Parity)
Route::get('/wadeem-gardens', function () { return view('communities.wadeem-gardens'); })->name('wadeem-gardens');
Route::get('/hudayriyat-golf-estates', function () { return view('communities.hudayriyat-golf-estates'); })->name('hudayriyat-golf-estates');
Route::get('/bashayer-villas', function () { return view('communities.bashayer-villas'); })->name('bashayer-villas');
Route::get('/bashayer-residences', function () { return view('communities.bashayer-residences'); })->name('bashayer-residences');
Route::get('/al-naseem-villas', function () { return view('communities.al-naseem-villas'); })->name('al-naseem-villas');
Route::get('/nawayef-east-hills', function () { return view('communities.nawayef-east-hills'); })->name('nawayef-east-hills');
Route::get('/masyaf-plots', function () { return view('communities.masyaf-plots'); })->name('masyaf-plots');
Route::get('/nawayef-village', function () { return view('communities.nawayef-village'); })->name('nawayef-village');
Route::get('/wadeem-plots', function () { return view('communities.wadeem-plots'); })->name('wadeem-plots');
Route::get('/nawayef-park-views', function () { return view('communities.nawayef-park-views'); })->name('nawayef-park-views');

// Dedicated Contact Us Page (Port 3000 Parity)
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');

Route::get('/contact', function () {
    return redirect('/contact-us');
});

// Dedicated About Us Page (Port 3000 Parity)
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/about', function () {
    return redirect('/about-us');
});

// Footer Legal Pages (100% Port 3000 Parity)
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/privacy', function () {
    return redirect('/privacy-policy');
});

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/terms', function () {
    return redirect('/terms-and-conditions');
});

Route::get('/disclaimer', function () {
    return view('disclaimer');
})->name('disclaimer');
`;

for (const b of BACKEND_DIRS) {
  if (fs.existsSync(b)) {
    const p = path.join(b, 'routes/web.php');
    fs.writeFileSync(p, newRoutesCode, 'utf8');
    console.log(`Updated routes in ${p}`);
  }
}
