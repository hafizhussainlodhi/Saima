<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = FooterSection::current();
        return view('admin.footer.index', compact('footer'));
    }

    public function update(Request $request)
    {
        $footer = FooterSection::current();

        $data = $request->validate([
            'brand_title'         => ['nullable', 'string', 'max:255'],
            'brand_description'   => ['nullable', 'string', 'max:2000'],
            'newsletter_title'    => ['nullable', 'string', 'max:255'],
            'newsletter_subtitle' => ['nullable', 'string', 'max:1000'],
            'newsletter_enabled'  => ['nullable'],
            'social_links'        => ['nullable', 'array'],
            'columns'             => ['nullable', 'array'],
            'disclaimer_text'     => ['nullable', 'string'],
            'copyright_text'      => ['nullable', 'string', 'max:255'],
        ]);

        $footer->brand_title = $data['brand_title'] ?? 'Saima';
        $footer->brand_description = $data['brand_description'] ?? '';
        $footer->newsletter_title = $data['newsletter_title'] ?? '';
        $footer->newsletter_subtitle = $data['newsletter_subtitle'] ?? '';
        $footer->newsletter_enabled = $request->boolean('newsletter_enabled');

        // Process Social Links
        $socialLinks = [];
        if (!empty($data['social_links'])) {
            foreach ($data['social_links'] as $item) {
                if (!empty($item['platform'])) {
                    $socialLinks[] = [
                        'platform' => trim($item['platform']),
                        'url'      => trim($item['url'] ?? ''),
                    ];
                }
            }
        }
        $footer->social_links = $socialLinks;

        // Process Columns & Links (with drag and drop order preserved)
        $cleanColumns = [];
        if (!empty($data['columns'])) {
            foreach ($data['columns'] as $col) {
                $header = trim($col['header'] ?? '');
                $rawLinks = $col['links'] ?? [];
                $cleanLinks = [];
                foreach ($rawLinks as $lnk) {
                    $label = trim($lnk['label'] ?? '');
                    $url = trim($lnk['url'] ?? '');
                    if ($label !== '' || $url !== '') {
                        $cleanLinks[] = [
                            'label' => $label,
                            'url'   => $url,
                        ];
                    }
                }
                $cleanColumns[] = [
                    'header' => $header,
                    'links'  => $cleanLinks,
                ];
            }
        } else {
            $cleanColumns = FooterSection::defaultColumns();
        }
        $footer->columns = $cleanColumns;

        $footer->disclaimer_text = $data['disclaimer_text'] ?? '';
        $footer->copyright_text = $data['copyright_text'] ?? '';

        $footer->save();
        FooterSection::flushCache();

        $activeTab = $request->input('active_tab', 'columns');
        return redirect()->route('admin.footer.index', ['tab' => $activeTab])
            ->with('success', 'Footer & Newsletter configuration saved successfully.');
    }
}
