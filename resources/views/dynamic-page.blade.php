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
      [class*="__iconWrapper"], .iconWrapper {
        position: relative !important;
        width: 44px !important;
        height: 44px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
      }
      [class*="__accentCircle"], .accentCircle {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        background: #1a4731 !important;
        opacity: 1 !important;
        z-index: 1 !important;
      }
      [class*="__svgIcon"], .svgIcon {
        position: relative !important;
        z-index: 2 !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
      }
      [class*="__svgIcon"] img, .svgIcon img,
      [class*="__highlightCard"] img, .highlightCard img {
        width: 20px !important;
        height: 20px !important;
        max-width: 20px !important;
        max-height: 20px !important;
        object-fit: contain !important;
        filter: brightness(0) invert(1) !important;
        -webkit-filter: brightness(0) invert(1) !important;
        display: block !important;
        margin: auto !important;
      }
      [class*="__svgIcon"] svg, .svgIcon svg,
      [class*="__highlightCard"] svg, .highlightCard svg {
        width: 20px !important;
        height: 20px !important;
        max-width: 20px !important;
        max-height: 20px !important;
        stroke: #ffffff !important;
        color: #ffffff !important;
        display: block !important;
        margin: auto !important;
      }
      .slideHidden {
        display: none !important;
      }
      .slideActive {
        display: block !important;
      }
      /* Global Hero Section: BOOK NOW Red Background */
      .heroBookBtn,
      .heroBtnRow .heroBookBtn,
      #hero .heroBookBtn,
      section[id="hero"] .heroBookBtn,
      [class*="heroSection"] [class*="brochureBtn"],
      [class*="Hero"] [class*="brochureBtn"],
      [class*="__btnRow"] [class*="brochureBtn"],
      [class*="btnRow"] button {
        background-color: #d9232d !important;
        background: #d9232d !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(217, 35, 45, 0.35) !important;
      }
      .heroBookBtn:hover,
      .heroBtnRow .heroBookBtn:hover,
      #hero .heroBookBtn:hover,
      section[id="hero"] .heroBookBtn:hover,
      [class*="heroSection"] [class*="brochureBtn"]:hover,
      [class*="Hero"] [class*="brochureBtn"]:hover,
      [class*="__btnRow"] [class*="brochureBtn"]:hover,
      [class*="btnRow"] button:hover {
        background-color: #b71a23 !important;
        background: #b71a23 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 18px rgba(217, 35, 45, 0.5) !important;
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
      .GolfHeader-module__ZF_nIG__navItem:hover .GolfHeader-module__ZF_nIG__dropdownMenu,
      .GolfHeader-module__ZF_nIG__navItem:hover [class*="dropdownMenu"],
      [class*="navItem"]:hover > [class*="dropdownMenu"],
      [class*="navItem"]:hover > [class*="DropdownMenu"] {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
        pointer-events: auto !important;
      }
      /* Universal Hero Heading & Subtitle (100% Home Page Parity) */
      .GolfHero-module__9JtUKq__title,
      [class*="Hero-module__"][class*="__title"],
      .heroTitle {
        font-size: clamp(32px, 3.8vw, 46px) !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        line-height: 1.22 !important;
        margin-bottom: 18px !important;
        letter-spacing: -0.015em !important;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.45) !important;
      }
      .GolfHero-module__9JtUKq__subtitle,
      [class*="Hero-module__"][class*="__subtitle"],
      .heroSubtitle {
        font-size: clamp(15px, 1.35vw, 18px) !important;
        font-weight: 400 !important;
        color: rgba(255, 255, 255, 0.92) !important;
        line-height: 1.55 !important;
        margin-bottom: 16px !important;
        text-shadow: 0 1px 6px rgba(0, 0, 0, 0.45) !important;
      }
      @media (max-width: 991px) {
        .GolfHero-module__9JtUKq__title,
        [class*="Hero-module__"][class*="__title"],
        .heroTitle {
          font-size: 36px !important;
          line-height: 1.15 !important;
          margin-bottom: 12px !important;
        }
        .GolfHero-module__9JtUKq__subtitle,
        [class*="Hero-module__"][class*="__subtitle"],
        .heroSubtitle {
          font-size: 16px !important;
          line-height: 1.4 !important;
          margin-bottom: 10px !important;
        }
      }
      @media (max-width: 576px) {
        .GolfHero-module__9JtUKq__title,
        [class*="Hero-module__"][class*="__title"],
        .heroTitle {
          font-size: 30px !important;
          margin-bottom: 8px !important;
        }
        .GolfHero-module__9JtUKq__subtitle,
        [class*="Hero-module__"][class*="__subtitle"],
        .heroSubtitle {
          font-size: 14px !important;
          margin-bottom: 8px !important;
        }
      }
    </style>
</head>
<body>
@php
    $navProjects = get_navbar_projects($page->slug ?? null, $page->id ?? null);
    $navCommercial = get_navbar_commercial($page->slug ?? null, $page->id ?? null);
@endphp
    <main style="min-height:100vh;background-color:#ffffff"><header class="GolfHeader-module__ZF_nIG__header "><div class="container GolfHeader-module__ZF_nIG__headerContainer"><a class="GolfHeader-module__ZF_nIG__logoLink" href="/"><img src="{{ asset('logo_saima.png') }}" alt="Saima Group" class="GolfHeader-module__ZF_nIG__logoImg" style="color:transparent; height: 50px; width: auto; max-height: 54px; object-fit: contain;"/></a><nav class="GolfHeader-module__ZF_nIG__nav"><ul class="GolfHeader-module__ZF_nIG__navList"><li class="GolfHeader-module__ZF_nIG__navItem"><a class="GolfHeader-module__ZF_nIG__navLink" href="/">HOME</a></li>@if($navProjects->isNotEmpty())<li class="GolfHeader-module__ZF_nIG__navItem"><button type="button" class="GolfHeader-module__ZF_nIG__navLink" style="background:none;border:none;cursor:pointer">PROJECTS<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg></button><div class="GolfHeader-module__ZF_nIG__dropdownMenu ">@foreach($navProjects as $proj)<a class="GolfHeader-module__ZF_nIG__dropdownItem" href="{{ $proj->url }}">{{ $proj->title }}</a>@endforeach</div></li>@endif @if($navCommercial->isNotEmpty())<li class="GolfHeader-module__ZF_nIG__navItem"><button type="button" class="GolfHeader-module__ZF_nIG__navLink" style="background:none;border:none;cursor:pointer">COMMERCIAL<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down" aria-hidden="true"><path d="m6 9 6 6 6-6"></path></svg></button><div class="GolfHeader-module__ZF_nIG__dropdownMenu ">@foreach($navCommercial as $proj)<a class="GolfHeader-module__ZF_nIG__dropdownItem" href="{{ $proj->url }}">{{ $proj->title }}</a>@endforeach</div></li>@endif<li class="GolfHeader-module__ZF_nIG__navItem"><a href="#floorplans" class="GolfHeader-module__ZF_nIG__navLink">FLOOR PLAN</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#master" class="GolfHeader-module__ZF_nIG__navLink">MASTER PLAN</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#paymentplan" class="GolfHeader-module__ZF_nIG__navLink">PAYMENT PLAN</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a href="#faq" class="GolfHeader-module__ZF_nIG__navLink">FAQ</a></li><li class="GolfHeader-module__ZF_nIG__navItem"><a class="GolfHeader-module__ZF_nIG__navLink" href="/contact-us">CONTACT US</a></li></ul></nav><button type="button" class="GolfHeader-module__ZF_nIG__mobileToggle" aria-label="Toggle navigation menu"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu" aria-hidden="true"><path d="M4 5h16"></path><path d="M4 12h16"></path><path d="M4 19h16"></path></svg></button></div></header><div class="GolfHeader-module__ZF_nIG__mobileDrawer "><button type="button" class="GolfHeader-module__ZF_nIG__mobileCloseBtn" aria-label="Close menu"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x" aria-hidden="true"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg></button><ul class="GolfHeader-module__ZF_nIG__mobileNavList"><li><a class="GolfHeader-module__ZF_nIG__mobileNavLink" href="/">Home</a></li>@if($navProjects->isNotEmpty())<li><button type="button" class="GolfHeader-module__ZF_nIG__mobileNavLink">Projects<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down" aria-hidden="true" style="transform:none;transition:transform 0.2s"><path d="m6 9 6 6 6-6"></path></svg></button>
<div class="mobileSubList" style="display: none; padding-left: 14px; flex-direction: column; gap: 8px; margin-top: 8px;">
  @foreach($navProjects as $proj)<a href="{{ $proj->url }}" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">{{ $proj->title }}</a>@endforeach
</div></li>@endif @if($navCommercial->isNotEmpty())<li><button type="button" class="GolfHeader-module__ZF_nIG__mobileNavLink">Commercial<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down" aria-hidden="true" style="transform:none;transition:transform 0.2s"><path d="m6 9 6 6 6-6"></path></svg></button>
<div class="mobileSubList" style="display: none; padding-left: 14px; flex-direction: column; gap: 8px; margin-top: 8px;">
  @foreach($navCommercial as $proj)<a href="{{ $proj->url }}" class="mobileSubItem" style="color: rgba(255, 255, 255, 0.85); font-size: 14px; text-decoration: none; padding: 6px 0; display: block;">{{ $proj->title }}</a>@endforeach
</div></li>@endif<li><a href="#floorplans" class="GolfHeader-module__ZF_nIG__mobileNavLink">Floor Plans</a></li><li><a href="#master" class="GolfHeader-module__ZF_nIG__mobileNavLink">Master Plan</a></li><li><a href="#paymentplan" class="GolfHeader-module__ZF_nIG__mobileNavLink">Payment Plan</a></li><li><a href="#faq" class="GolfHeader-module__ZF_nIG__mobileNavLink">FAQ</a></li><li><a class="GolfHeader-module__ZF_nIG__mobileNavLink" href="/contact-us">Contact Us</a></li><li style="margin-top:12px"><button type="button" class="GolfHeader-module__ZF_nIG__listPropBtnMobile">LIST YOUR PROPERTY</button></li></ul></div>
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
            $amSub = page_section('amenities', 'subtitle', '', $page->slug);
            $rawAmItems = page_section('amenities', 'items', [], $page->slug);
            $amItems = array_values(array_filter((array)$rawAmItems, fn($item) => is_array($item) && (!empty(trim($item['name'] ?? '')) || !empty(trim($item['icon'] ?? '')))));
        @endphp
        @if(!empty($amItems))
        <section id="amenities" class="GolfAmenities-module__j5-r4q__amenitiesSection">
            <div class="container">
                <div class="GolfAmenities-module__j5-r4q__header">
                    <h2 class="GolfAmenities-module__j5-r4q__title">{!! $amTitle !!}</h2>
                    @if(!empty($amSub))
                    <p class="GolfAmenities-module__j5-r4q__subtitle">{{ $amSub }}</p>
                    @endif
                </div>
                <div class="GolfAmenities-module__j5-r4q__grid">
                    @foreach($amItems as $amItem)
                        @php
                            $aName = $amItem['name'] ?? '';
                            $aIcon = $amItem['icon'] ?? '';
                            if (!empty($aIcon) || !empty($aName)) {
                                $matchedAm = \App\Models\Amenity::where('is_active', true)
                                    ->where(function($q) use ($aIcon, $aName) {
                                        if (!empty($aIcon)) $q->where('icon', $aIcon);
                                        if (!empty($aName)) $q->orWhereRaw('LOWER(name) = ?', [strtolower(trim($aName))]);
                                    })->first();
                                if ($matchedAm) {
                                    $aName = $matchedAm->name;
                                    if (!empty($matchedAm->icon)) $aIcon = $matchedAm->icon;
                                }
                            }
                        @endphp
                        <div class="GolfAmenities-module__j5-r4q__card">
                            <div class="GolfAmenities-module__j5-r4q__iconBox">
                                <img alt="{{ $aName }}" width="30" height="30" class="GolfAmenities-module__j5-r4q__iconImg" style="color:transparent" src="{{ $aIcon ?: '/images/golf-estates/amenity-golf.png' }}"/>
                            </div>
                            <p class="GolfAmenities-module__j5-r4q__amenityName">{{ $aName }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    @elseif($sec->section_key === 'gallery')
        @include('partials.project-gallery', ['slug' => $page->slug])
    @elseif(($sec->section_key === 'content' || $sec->section_key === 'toc') && !$articleRendered)
        @php $articleRendered = true; @endphp
        @include('partials.article', ['slug' => $page->slug, 'page' => $page])
    @elseif($sec->section_key === 'floor_plans')
        @php
            $fpUnits = page_section('floor_plans', 'units', page_section('floor_plans', 'items', [], $page->slug), $page->slug);
            $fpUnits = array_values(array_filter((array)$fpUnits, fn($u) => is_array($u) && (!empty($u['title']) || !empty($u['name']) || !empty($u['image']))));
        @endphp
        @if(!empty($fpUnits))
        <section id="floorplans" class="GolfFloorPlans-module__Vvrdhq__floorPlansSection">
            <div class="container">
                <div class="GolfFloorPlans-module__Vvrdhq__header">
                    <h2 class="GolfFloorPlans-module__Vvrdhq__title">{!! page_section('floor_plans', 'title', $page->title . ' Floor Plans', $page->slug) !!}</h2>
                    <p class="GolfFloorPlans-module__Vvrdhq__subtitle">Explore the thoughtfully designed layouts created for modern island living.</p>
                </div>
            </div>
        </section>
        @endif
    @elseif($sec->section_key === 'payment_plan')
        @php
            $rawPlanTabs = page_section('payment_plan', 'plan_tabs', [], $page->slug);
            $planTabs = is_array($rawPlanTabs) ? array_values(array_filter($rawPlanTabs, function($t) {
                $cl = strtolower(trim($t));
                return !str_contains($cl, 'without finance') && !str_contains($cl, 'with finance');
            })) : [];
            $rawPayRows = page_section('payment_plan', 'rows', [], $page->slug);
            $payRows = array_values(array_filter((array)$rawPayRows, fn($r) => is_array($r) && (!empty(trim($r['installment'] ?? '')) || !empty(trim($r['percentage'] ?? '')) || !empty(trim($r['milestone'] ?? '')))));
            $payTitle = page_section('payment_plan', 'title', '', $page->slug);
            $payDesc = page_section('payment_plan', 'description', '', $page->slug);
        @endphp
        @if(!empty($payRows) || (!empty($payTitle) && !empty($payDesc)))
        <section id="paymentplan" style="padding: 70px 0; background: #faf8f5;">
            <div class="container">
                <div style="text-align: center; margin-bottom: 35px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 10px;">{!! $payTitle ?: 'Payment Plan' !!}</h2>
                    @if(!empty(trim(strip_tags((string)$payDesc))))
                        <div style="font-size: 15px; color: #666; max-width: 800px; margin: 0 auto; line-height: 1.6;">{!! $payDesc !!}</div>
                    @endif
                </div>
                @if(!empty($planTabs))
                    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 25px; flex-wrap: wrap;">
                        @foreach($planTabs as $tIdx => $tabName)
                            <button type="button" style="padding: 9px 20px; border-radius: 20px; border: 1px solid #1a4731; background: {{ $tIdx === 0 ? '#1a4731' : '#fff' }}; color: {{ $tIdx === 0 ? '#fff' : '#1a4731' }}; font-weight: 600; font-size: 13px; cursor: pointer;">{{ $tabName }}</button>
                        @endforeach
                    </div>
                @endif
                @if(!empty($payRows))
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
                @endif
                @php
                    $dlUrl = page_section('payment_plan', 'download_url', '', $page->slug);
                @endphp
                <div style="text-align: center; margin-top: 35px;">
                    <a href="{{ (!empty($dlUrl) && $dlUrl !== '#') ? $dlUrl : '#contact' }}" onclick="{{ (empty($dlUrl) || $dlUrl === '#') ? 'if(window.openListModal){window.openListModal(); return false;}' : '' }}" style="display: inline-block; padding: 14px 34px; background: #1a4731; color: #fff; font-weight: 700; font-size: 14px; text-decoration: none; border-radius: 4px; letter-spacing: 0.5px; transition: background 0.2s ease; cursor: pointer;">DOWNLOAD PAYMENT PLAN</a>
                </div>
            </div>
        </section>
        @endif
    @elseif($sec->section_key === 'master_plan')
        @php
            $mpImg = page_section('master_plan', 'image', '', $page->slug);
            $mpTitle = page_section('master_plan', 'title', '', $page->slug);
            $hasMasterPlan = !empty($mpImg) && (str_starts_with($mpImg, 'http') || file_exists(public_path(ltrim($mpImg, '/'))));
        @endphp
        @if($hasMasterPlan)
        <section id="master" style="padding: 60px 0; background: #faf8f5;">
            <div class="container">
                <div style="text-align: center; margin-bottom: 25px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a;">{!! $mpTitle ?: 'Master Plan' !!}</h2>
                </div>
                <div style="max-width: 1100px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; padding: 15px;">
                    <div style="width: 100%; aspect-ratio: 16 / 9; max-height: 580px; border-radius: 6px; overflow: hidden; background: #fbfaf8; position: relative;">
                        <img src="{{ $mpImg }}" alt="{!! $mpTitle ?: 'Master Plan' !!}" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; border-radius: 6px;">
                    </div>
                </div>
            </div>
        </section>
        @endif
    @elseif($sec->section_key === 'location' || $sec->section_key === 'overview_location')
        @php
            $locImg = page_section('location', 'image', '', $page->slug);
            $locCategories = page_section('location', 'categories', [], $page->slug);
            $locCategories = array_values(array_filter((array)$locCategories, fn($c) => is_array($c) && !empty($c['name'])));
            $locSub = trim((string)page_section('location', 'subtitle', '', $page->slug));
            $locItems = page_section('location', 'items', [], $page->slug);
            $locItems = array_values(array_filter((array)$locItems, fn($i) => is_array($i) && !empty($i['name'])));
            $hasLocImg = !empty($locImg) && (str_starts_with($locImg, 'http') || file_exists(public_path(ltrim($locImg, '/'))));
            $hasLocationContent = !empty($locCategories) || !empty($locItems) || (!empty($locSub) && $hasLocImg);
        @endphp
        @if($hasLocationContent)
        <section class="GolfLocation-module__HavC9G__locationSection" id="location">
            <div class="container">
                <div style="text-align: center; margin-bottom: 40px;">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 12px;">{!! page_section('location', 'title', 'Location & Attractions', $page->slug) !!}</h2>
                    @if(!empty($locSub))
                    <p style="font-size: 15px; color: #666; max-width: 800px; margin: 0 auto; line-height: 1.6;">{{ $locSub }}</p>
                    @endif
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; align-items: start;">
                    @if($hasLocImg)
                    <div style="position: relative; border-radius: 10px; overflow: hidden; min-height: 380px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <img src="{{ $locImg }}" alt="{!! page_section('location', 'title', 'Location', $page->slug) !!}" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @endif
                    @if(!empty($locCategories))
                    <div style="display: flex; flex-direction: column; gap: 12px;">
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
                    @endif
                </div>
            </div>
        </section>
        @endif
    @elseif($sec->section_key === 'landmarks')
        <section class="GolfLandmarks-module__N9ZsyW__landmarksSection"><div class="container"><div class="GolfLandmarks-module__N9ZsyW__header"><h2 class="GolfLandmarks-module__N9ZsyW__title">Nearby Landmarks</h2></div><div class="GolfLandmarks-module__N9ZsyW__landmarksGrid"><div class="GolfLandmarks-module__N9ZsyW__card"><div class="GolfLandmarks-module__N9ZsyW__imgWrapper"><img alt="Ferrari World Abu Dhabi" class="GolfLandmarks-module__N9ZsyW__cardImg" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw" src="/images/golf-estates/landmark-ferrari.jpg"/></div><div class="GolfLandmarks-module__N9ZsyW__cardContent"><h3 class="GolfLandmarks-module__N9ZsyW__landmarkTitle">Ferrari World Abu Dhabi</h3><p class="GolfLandmarks-module__N9ZsyW__landmarkTime">42 Mins</p></div></div><div class="GolfLandmarks-module__N9ZsyW__card"><div class="GolfLandmarks-module__N9ZsyW__imgWrapper"><img alt="Zayed International Airport" class="GolfLandmarks-module__N9ZsyW__cardImg" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw" src="/images/golf-estates/landmark-airport.jpg"/></div><div class="GolfLandmarks-module__N9ZsyW__cardContent"><h3 class="GolfLandmarks-module__N9ZsyW__landmarkTitle">Zayed International Airport</h3><p class="GolfLandmarks-module__N9ZsyW__landmarkTime">25 Mins</p></div></div><div class="GolfLandmarks-module__N9ZsyW__card"><div class="GolfLandmarks-module__N9ZsyW__imgWrapper"><img alt="Louvre Abu Dhabi" class="GolfLandmarks-module__N9ZsyW__cardImg" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw" src="/images/golf-estates/landmark-louvre.jpg"/></div><div class="GolfLandmarks-module__N9ZsyW__cardContent"><h3 class="GolfLandmarks-module__N9ZsyW__landmarkTitle">Louvre Abu Dhabi</h3><p class="GolfLandmarks-module__N9ZsyW__landmarkTime">34 Mins</p></div></div></div></div></section>
    @elseif($sec->section_key === 'faq')
        @php
            $pageSlug = $page->slug;
            $rawDbFaqs = page_section('faq', 'items', [], $pageSlug);
            $dbFaqs = array_values(array_filter((array)$rawDbFaqs, fn($f) => is_array($f) && (!empty(trim($f['q'] ?? ($f['question'] ?? ''))))));
        @endphp
        @if(!empty($dbFaqs))
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
        @endif
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
    <!-- Universal International Phone Selector (218 Countries Worldwide & Dynamic Validation) -->
    <script src="{{ asset('js/universal-phone-selector.js') }}?v={{ time() }}"></script>
</body>
</html>

