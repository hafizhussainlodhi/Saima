<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeoController extends Controller
{
    public function index()
    {
        $settings = [
            'indexing_enabled' => SiteSetting::isIndexingEnabled(),
            'default_title' => SiteSetting::get('seo_default_title', 'Hudayriyat Island – Luxury Villas & Waterfront Living in Abu Dhabi'),
            'default_description' => SiteSetting::get('seo_default_description', 'Discover Hudayriyat Island, a premier luxury waterfront community in Abu Dhabi offering exclusive villas, mansions, and world-class amenities.'),
            'default_keywords' => SiteSetting::get('seo_default_keywords', 'hudayriyat island, abu dhabi villas, luxury waterfront, modon properties, saima group'),
            'og_image' => SiteSetting::get('seo_og_image', '/images/hero/slide-1.jpg'),
            'canonical_url' => SiteSetting::get('seo_canonical_url', url('/')),
            'header_scripts' => SiteSetting::get('seo_header_scripts', ''),
            'sitemap_url' => url('/sitemap.xml'),
        ];

        return view('admin.seo.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'indexing_enabled'     => ['nullable'],
            'default_title'        => ['required', 'string', 'max:255'],
            'default_description'  => ['nullable', 'string', 'max:1000'],
            'default_keywords'     => ['nullable', 'string', 'max:500'],
            'og_image'             => ['nullable', 'string', 'max:500'],
            'og_image_file'        => ['nullable', 'image', 'max:5120'],
            'canonical_url'        => ['nullable', 'url', 'max:255'],
            'header_scripts'       => ['nullable', 'string'],
        ]);

        // Toggle indexing ON/OFF
        $indexingEnabled = $request->boolean('indexing_enabled') ? '1' : '0';
        SiteSetting::set('seo_indexing_enabled', $indexingEnabled, 'boolean', 'seo');

        SiteSetting::set('seo_default_title', $data['default_title'], 'string', 'seo');
        SiteSetting::set('seo_default_description', $data['default_description'] ?? '', 'textarea', 'seo');
        SiteSetting::set('seo_default_keywords', $data['default_keywords'] ?? '', 'string', 'seo');
        SiteSetting::set('seo_canonical_url', $data['canonical_url'] ?? '', 'string', 'seo');
        SiteSetting::set('seo_header_scripts', $data['header_scripts'] ?? '', 'code', 'seo');

        if ($request->hasFile('og_image_file')) {
            $file = $request->file('og_image_file');
            $filename = 'og_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/seo');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            SiteSetting::set('seo_og_image', '/images/seo/' . $filename, 'image', 'seo');
        } elseif ($request->filled('og_image')) {
            SiteSetting::set('seo_og_image', $request->input('og_image'), 'image', 'seo');
        }

        SiteSetting::flushCache();

        return redirect()->route('admin.seo.index')->with('success', 'Global SEO & Indexing settings updated successfully.');
    }
}
