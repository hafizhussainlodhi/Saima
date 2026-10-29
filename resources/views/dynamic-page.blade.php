<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $page->meta_title ?: ($page->title . ' | Hudayriyat Island Abu Dhabi') }}</title>
    
@if($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    
@endif
@if($page->meta_keywords)
        <meta name="keywords" content="{{ $page->meta_keywords }}">
    
@endif
@if(is_indexing_enabled()
)
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    @else
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    
@endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Libre+Franklin:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/communities/global.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/communities/hudayriyat-golf-estates.css') }}?v={{ time() }}">
    
@if(file_exists(public_path('css/communities/' . $page->slug . '.css')
) && $page->slug !== 'hudayriyat-golf-estates')
    <link rel="stylesheet" href="{{ asset('css/communities/' . $page->slug . '.css') }}?v={{ time() }}">
    
@endif
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
    <main style="min-height:100vh;background-color:#ffffff"><header class="GolfHeader-module__ZF_nIG__header "><div class="container GolfHeader-module__ZF_nIG__headerContainer"><a class="GolfHeader-module__ZF_nIG__logoLink" href="/"><img src="{{ asset('logo_saima.png') }}" alt="Saima Group" class="GolfHeader-module__ZF_nIG__logoImg" style="color:transparent; height: 50px; width: auto; max-height: 54px; object-fit: contain;"/></a><nav class="GolfHeader-module__ZF_nIG__nav"><ul class="GolfHeader-module__ZF_nIG__navList"><li class="GolfHeader-module__ZF_nIG__navItem"><a class="GolfHeader-module__ZF_nIG__navLink" href="/">HOME</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><button type="button" class="GolfHeader-module__ZF_nIG__navLink" style="background:none;border:none;cursor:pointer">PROJECTS<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg></button><div class="GolfHeader-module__ZF_nIG__dropdownMenu "><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/wadeem-gardens">Wadeem Gardens</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/hudayriyat-golf-estates">Hudayriyat Golf Estates</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/bashayer-residences">Bashayer Residences</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/nawayef-east-hills">Nawayef East Hills</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/bashayer-villas">Bashayer Villas</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/al-naseem-villas">Al Naseem Villas</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/masyaf-plots">Masyaf Plots</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/nawayef-village">Nawayef Village</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/wadeem-plots">Wadeem Plots</a><a class="GolfHeader-module__ZF_nIG__dropdownItem" href="/nawayef-park-views">Nawayef Park Views</a></div></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#floorplans" class="GolfHeader-module__ZF_nIG__navLink">FLOOR PLAN</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#master" class="GolfHeader-module__ZF_nIG__navLink">MASTER PLAN</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#paymentplan" class="GolfHeader-module__ZF_nIG__navLink">PAYMENT PLAN</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#faq" class="GolfHeader-module__ZF_nIG__navLink">FAQ</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a class="GolfHeader-module__ZF_nIG__navLink" href="/contact-us">CONTACT US</a></li></ul></nav><button type="button" class="GolfHeader-module__ZF_nIG__mobileToggle" aria-label="Toggle navigation menu"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu" aria-hidden="true"><path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path></svg></button></div></header><div class="GolfHeader-module__ZF_nIG__mobileDrawer "><button type="button" class="GolfHeader-module__ZF_nIG__mobileCloseBtn" aria-label="Close menu"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x" aria-hidden="true"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button><ul class="GolfHeader-module__ZF_nIG__mobileNavList"><li><a class="GolfHeader-module__ZF_nIG__mobileNavLink" href="/">Home</a></li><li><button type="button" class="GolfHeader-module__ZF_nIG__mobileNavLink">Projects<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down" aria-hidden="true" style="transform:none;transition:transform 0.2s"><path d="m6 9 6 6 6-6"></path></svg></button>
<div class="mobileSubList" style="display: none; padding-left: 14px; flex-direction: column; gap: 8px; margin-top: 8px;">
  <a href="/wadeem-gardens" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Wadeem Gardens</a>
  <a href="/hudayriyat-golf-estates" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Hudayriyat Golf Estates</a>
  <a href="/bashayer-residences" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Bashayer Residences</a>
  <a href="/nawayef-east-hills" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Nawayef East Hills</a>
  <a href="/bashayer-villas" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Bashayer Villas</a>
  <a href="/al-naseem-villas" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Al Naseem Villas</a>
  <a href="/masyaf-plots" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Masyaf Plots</a>
  <a href="/nawayef-village" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Nawayef Village</a>
  <a href="/wadeem-plots" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Wadeem Plots</a>
  <a href="/nawayef-park-views" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">Nawayef Park Views</a>
</div></li><li><a href="#floorplans" class="GolfHeader-module__ZF_nIG__mobileNavLink">Floor Plans</a></li><li><a href="#master" class="GolfHeader-module__ZF_nIG__mobileNavLink">Master Plan</a></li><li><a href="#paymentplan" class="GolfHeader-module__ZF_nIG__mobileNavLink">Payment Plan</a></li><li><a href="#faq" class="GolfHeader-module__ZF_nIG__mobileNavLink">FAQ</a></li><li><a class="GolfHeader-module__ZF_nIG__mobileNavLink" href="/contact-us">Contact Us</a></li><li style="margin-top:12px"><button type="button" class="GolfHeader-module__ZF_nIG__listPropBtnMobile">LIST YOUR PROPERTY</button></li></ul></div>
@php
    $orderedSections = $page->sections()->where('is_active', true)->orderBy('order', 'asc')->get();
    $articleRendered = false;
    $communitiesRendered = false;
    $GLOBALS['communitiesRenderedGlobal'] = false;
@endphp
@foreach($orderedSections as $sec)
    @if($sec->section_key === 'hero')
        @include('partials.page-hero')
    @elseif($sec->section_key === 'highlights')
        @include('partials.page-highlights')
    @elseif($sec->section_key === 'about')
        @include('partials.page-about')
    @elseif($sec->section_key === 'amenities')
        @php
            $amTitle = page_section('amenities', 'title', $page->title . ' Amenities', $page->slug);
            $amSub = page_section('amenities', 'subtitle', $page->title . ' offers a range of world-class facilities designed for comfortable living and recreation.', $page->slug);
            $amItems = page_section('amenities', 'items', [
                ['name' => 'Gymnasium', 'icon' => '/images/nawayef-park-views/asset_16.png'],
                ['name' => 'Yoga Zone', 'icon' => '/images/nawayef-park-views/asset_17.png'],
                ['name' => 'Co-working Area', 'icon' => '/images/nawayef-park-views/asset_18.png'],
                ['name' => 'Game Room', 'icon' => '/images/nawayef-park-views/asset_19.png'],
                ['name' => 'Private Beach', 'icon' => '/images/nawayef-park-views/asset_20.png'],
                ['name' => 'Concierge & Valet', 'icon' => '/images/nawayef-park-views/asset_21.png'],
                ['name' => 'Swimming Pool', 'icon' => '/images/nawayef-park-views/asset_22.png'],
                ['name' => 'Club House', 'icon' => '/images/nawayef-park-views/asset_23.png'],
            ], $page->slug);
        @endphp
        <section id="amenities" class="GolfAmenities-module__j5-r4q__amenitiesSection">
            <div class="container">
                <div class="GolfAmenities-module__j5-r4q__header">
                    <h2 class="GolfAmenities-module__j5-r4q__title">{!! $amTitle !!}</h2>
                    <p class="GolfAmenities-module__j5-r4q__subtitle">{{ $amSub }}</p>
                </div>
                <div class="GolfAmenities-module__j5-r4q__grid">
                    @foreach($amItems as $amItem)
                        <div class="GolfAmenities-module__j5-r4q__card">
                            <div class="GolfAmenities-module__j5-r4q__iconBox">
                                <img alt="{{ $amItem['name'] ?? 'Amenity' }}" width="30" height="30" class="GolfAmenities-module__j5-r4q__iconImg" style="color:transparent" src="{{ $amItem['icon'] ?? '/images/golf-estates/amenity-golf.png' }}"/>
                            </div>
                            <p class="GolfAmenities-module__j5-r4q__amenityName">{{ $amItem['name'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif($sec->section_key === 'gallery')
        @include('partials.project-gallery', ['slug' => $page->slug])
    @elseif(($sec->section_key === 'content' || $sec->section_key === 'toc') && !$articleRendered)
        @php $articleRendered = true; @endphp
        @include('partials.article', ['slug' => $page->slug, 'page' => $page])
    @elseif($sec->section_key === 'floor_plans')
        <section id="floorplans" class="GolfFloorPlans-module__Vvrdhq__floorPlansSection">
            <div class="container">
                <div class="GolfFloorPlans-module__Vvrdhq__header">
                    <h2 class="GolfFloorPlans-module__Vvrdhq__title">{!! page_section('floor_plans', 'title', $page->title . ' Floor Plans', $page->slug) !!}</h2>
                    <p class="GolfFloorPlans-module__Vvrdhq__subtitle">Explore the thoughtfully designed layouts created for modern island living.</p>
                </div>
            </div>
        </section>
    @elseif($sec->section_key === 'payment_plan')
        <section id="paymentplan" style="padding: 70px 0; background: #faf8f5;">
            <div class="container">
                <div style="text-align: center; margin-bottom: 35px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 10px;">{!! page_section('payment_plan', 'title', 'Payment Plan', $page->slug) !!}</h2>
                    @if($payDesc = page_section('payment_plan', 'description', '', $page->slug))
                        <p style="font-size: 15px; color: #666; max-width: 800px; margin: 0 auto; line-height: 1.6;">{{ $payDesc }}</p>
                    @endif
                </div>
                @php
                    $rawPlanTabs = page_section('payment_plan', 'plan_tabs', [], $page->slug);
                    $planTabs = is_array($rawPlanTabs) ? array_values(array_filter($rawPlanTabs, function($t) {
                        $cl = strtolower(trim($t));
                        return !str_contains($cl, 'without finance') && !str_contains($cl, 'with finance');
                    })) : [];
                    $payRows = page_section('payment_plan', 'rows', [], $page->slug);
                @endphp
                @if(!empty($planTabs))
                    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 25px; flex-wrap: wrap;">
                        @foreach($planTabs as $tIdx => $tabName)
                            <button type="button" style="padding: 9px 20px; border-radius: 20px; border: 1px solid #1a4731; background: {{ $tIdx === 0 ? '#1a4731' : '#fff' }}; color: {{ $tIdx === 0 ? '#fff' : '#1a4731' }}; font-weight: 600; font-size: 13px; cursor: pointer;">{{ $tabName }}</button>
                        @endforeach
                    </div>
                @endif
                <div style="background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); overflow-x: auto; max-width: 1000px; margin: 0 auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead>
                            <tr style="background: #1a4731; color: #fff; font-weight: 700;">
                                <th style="padding: 14px 18px;">Installment</th>
                                <th style="padding: 14px 18px;">Percentage</th>
                                <th style="padding: 14px 18px;">Milestone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payRows as $rIdx => $r)
                                <tr style="border-bottom: 1px solid #f0ebe4; background: {{ $rIdx % 2 === 0 ? '#fff' : '#fdfcfb' }};">
                                    <td style="padding: 14px 18px; font-weight: 600; color: #222;">{{ $r['installment'] ?? '' }}</td>
                                    <td style="padding: 14px 18px; font-weight: 700; color: #1a4731;">{{ $r['percentage'] ?? '' }}</td>
                                    <td style="padding: 14px 18px; color: #555;">{{ $r['milestone'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @php
                    $dlText = page_section('payment_plan', 'download_text', 'DOWNLOAD PAYMENT PLAN', $page->slug);
                    $dlUrl = page_section('payment_plan', 'download_url', '#', $page->slug);
                @endphp
                <div style="text-align: center; margin-top: 35px;">
                    <a href="{{ $dlUrl }}" style="display: inline-block; padding: 14px 34px; background: #1a4731; color: #fff; font-weight: 700; font-size: 14px; text-decoration: none; border-radius: 4px; letter-spacing: 0.5px; transition: background 0.2s ease;">{{ $dlText }}</a>
                </div>
            </div>
        </section>
    @elseif($sec->section_key === 'master_plan')
        <section id="master" style="padding: 60px 0; background: #faf8f5;">
            <div class="container">
                <div style="text-align: center; margin-bottom: 25px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a;">{!! page_section('master_plan', 'title', 'Master Plan', $page->slug) !!}</h2>
                </div>
                <div style="max-width: 1100px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; padding: 15px;">
                    <div style="width: 100%; aspect-ratio: 16 / 9; max-height: 580px; border-radius: 6px; overflow: hidden; background: #fbfaf8; position: relative;">
                        <img src="{{ page_section('master_plan', 'image', '/images/hudayriyat-golf-estates/master-plan.png', $page->slug) }}" alt="{!! page_section('master_plan', 'title', 'Master Plan', $page->slug) !!}" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; border-radius: 6px;">
                    </div>
                </div>
            </div>
        </section>
    @elseif($sec->section_key === 'location' || $sec->section_key === 'overview_location')
        <section class="GolfLocation-module__HavC9G__locationSection" id="location">
            <div class="container">
                <div style="text-align: center; margin-bottom: 40px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 12px;">{!! page_section('location', 'title', 'Location & Attractions', $page->slug) !!}</h2>
                    <p style="font-size: 15px; color: #666; max-width: 800px; margin: 0 auto; line-height: 1.6;">{{ page_section('location', 'subtitle', '', $page->slug) }}</p>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; align-items: start;">
                    <div style="position: relative; border-radius: 10px; overflow: hidden; min-height: 380px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <img src="{{ page_section('location', 'image', '/images/20231014_191447.webp', $page->slug) }}" alt="{!! page_section('location', 'title', 'Location', $page->slug) !!}" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @php
                            $locCategories = page_section('location', 'categories', [], $page->slug);
                        @endphp
                        @foreach($locCategories as $cIdx => $cat)
                            <div style="border: 1px solid #e0d7cb; border-radius: 8px; overflow: hidden; background: #fff;">
                                <button type="button" onclick="const p = this.nextElementSibling; p.style.display = (p.style.display === 'none' ? 'block' : 'none');" style="width: 100%; padding: 14px 18px; background: {{ $cIdx === 0 ? '#1a4731' : '#f7f4f0' }}; color: {{ $cIdx === 0 ? '#fff' : '#333' }}; font-weight: 700; font-size: 15px; border: none; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                                    <span>{{ $cat['name'] ?? '' }}</span>
                                    <span style="font-size: 18px;">▾</span>
                                </button>
                                <div style="display: {{ $cIdx === 0 ? 'block' : 'none' }}; padding: 12px 18px;">
                                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                                        @foreach($cat['items'] ?? [] as $cItm)
                                            <li style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 6px; font-size: 14px;">
                                                <span style="font-weight: 600; color: #222;">{{ $cItm['name'] ?? '' }}</span>
                                                <span style="color: #1a4731; font-weight: 700; font-size: 13px;">{{ $cItm['time'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @elseif($sec->section_key === 'landmarks')
        <section class="GolfLandmarks-module__N9ZsyW__landmarksSection"><div class="container"><div class="GolfLandmarks-module__N9ZsyW__header"><h2 class="GolfLandmarks-module__N9ZsyW__title">Nearby Landmarks</h2></div><div class="GolfLandmarks-module__N9ZsyW__landmarksGrid"><div class="GolfLandmarks-module__N9ZsyW__card"><div class="GolfLandmarks-module__N9ZsyW__imgWrapper"><img alt="Ferrari World Abu Dhabi" class="GolfLandmarks-module__N9ZsyW__cardImg" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw" src="/images/golf-estates/landmark-ferrari.jpg"/></div><div class="GolfLandmarks-module__N9ZsyW__cardContent"><h3 class="GolfLandmarks-module__N9ZsyW__landmarkTitle">Ferrari World Abu Dhabi</h3><p class="GolfLandmarks-module__N9ZsyW__landmarkTime">42 Mins</p></div></div><div class="GolfLandmarks-module__N9ZsyW__card"><div class="GolfLandmarks-module__N9ZsyW__imgWrapper"><img alt="Zayed International Airport" class="GolfLandmarks-module__N9ZsyW__cardImg" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw" src="/images/golf-estates/landmark-airport.jpg"/></div><div class="GolfLandmarks-module__N9ZsyW__cardContent"><h3 class="GolfLandmarks-module__N9ZsyW__landmarkTitle">Zayed International Airport</h3><p class="GolfLandmarks-module__N9ZsyW__landmarkTime">25 Mins</p></div></div><div class="GolfLandmarks-module__N9ZsyW__card"><div class="GolfLandmarks-module__N9ZsyW__imgWrapper"><img alt="Louvre Abu Dhabi" class="GolfLandmarks-module__N9ZsyW__cardImg" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw" src="/images/golf-estates/landmark-louvre.jpg"/></div><div class="GolfLandmarks-module__N9ZsyW__cardContent"><h3 class="GolfLandmarks-module__N9ZsyW__landmarkTitle">Louvre Abu Dhabi</h3><p class="GolfLandmarks-module__N9ZsyW__landmarkTime">34 Mins</p></div></div></div></div></section>
    @elseif($sec->section_key === 'faq')
        @php
            $pageSlug = $page->slug;
            $dbFaqs = page_section('faq', 'items', null, $pageSlug);
            if (!is_array($dbFaqs) || empty($dbFaqs)) {
                $dbFaqs = [
                    ['q' => 'What is ' . $page->title . '?', 'a' => $page->title . ' is a premier benchmark for luxury waterfront living, offering contemporary architectural elegance with a tranquil coastal sanctuary.'],
                    ['q' => 'Who is developing ' . $page->title . '?', 'a' => $page->title . ' is developed by renowned development partners committed to delivering world-class residential communities.'],
                    ['q' => 'What types of properties are available in ' . $page->title . '?', 'a' => 'The project offers an inspired choice of luxury villas, waterfront plots, and contemporary island residences.'],
                    ['q' => 'Is ' . $page->title . ' a freehold development?', 'a' => 'Yes, ' . $page->title . ' offers freehold ownership opportunities for all eligible domestic and international investors.'],
                    ['q' => 'What is the payment schedule for ' . $page->title . '?', 'a' => 'Flexible, milestone-linked payment plans are offered to suit investors and homeowners alike.'],
                ];
            }
        @endphp
        <section id="faq" class="GolfFaq-module__4nJd7q__faqSection" style="padding: 65px 0; background: #ffffff;">
            <div class="container" style="max-width: 920px; margin: 0 auto; padding: 0 20px;">
                <div style="text-align: center; margin-bottom: 35px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a;">{{ page_section('faq', 'heading', page_section('faq', 'title', 'Frequently Asked Questions', $pageSlug), $pageSlug) }}</h2>
                    @if($faqSub = page_section('faq', 'subtitle', '', $pageSlug))
                        <p style="font-size: 15px; color: #666; margin-top: 8px;">{{ $faqSub }}</p>
                    @endif
                </div>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @foreach($dbFaqs as $fIdx => $fItem)
                        <div style="border: 1px solid #e0d7cb; border-radius: 8px; overflow: hidden; background: #fff;">
                            <button type="button" onclick="const a = this.nextElementSibling; const s = this.querySelector('.faqArr'); const isOpen = a.style.display !== 'none'; a.style.display = isOpen ? 'none' : 'block'; s.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';" style="width: 100%; padding: 16px 20px; background: {{ $fIdx === 0 ? '#1a4731' : '#fcfaf8' }}; color: {{ $fIdx === 0 ? '#fff' : '#222' }}; font-weight: 700; font-size: 15px; border: none; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: background 0.2s ease;">
                                <span>{{ $fItem['q'] ?? $fItem['question'] ?? '' }}</span>
                                <span class="faqArr" style="font-size: 16px; transition: transform 0.2s ease; transform: {{ $fIdx === 0 ? 'rotate(180deg)' : 'rotate(0deg)' }};">▾</span>
                            </button>
                            <div style="display: {{ $fIdx === 0 ? 'block' : 'none' }}; padding: 16px 20px; background: #fff; font-size: 14.5px; line-height: 1.7; color: #444; border-top: 1px solid #f0ebe4;">
                                {!! $fItem['a'] ?? $fItem['answer'] ?? '' !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif($sec->section_key === 'contact')
        @include('partials.contact')
    @elseif($sec->section_key === 'communities' && !$communitiesRendered && empty($GLOBALS['communitiesRenderedGlobal']))
        @php $communitiesRendered = true; @endphp
        @include('partials.page-communities')
    @endif
@endforeach

@if(!$orderedSections->contains('section_key', 'content') && !$articleRendered && $page->hasSection('content'))
    @include('partials.article', ['slug' => $page->slug, 'page' => $page])
@endif

@if(!$orderedSections->contains('section_key', 'contact'))
    @include('partials.contact')
@endif

@include('partials.footer')<button type="button" class="ScrollToTop-module__bPaVnG__scrollTopBtn " aria-label="Scroll to top of page"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up" aria-hidden="true"><path d="m5 12 7-7 7 7"></path><path d="M12 19V5"></path></svg></button></main>

    <!-- Community Client JavaScript -->
    <script src="{{ asset('js/communities/community-interactions.js') }}?v={{ time() }}"></script>
</body>
</html>
