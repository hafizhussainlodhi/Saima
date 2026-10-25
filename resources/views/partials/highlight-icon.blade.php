@php
    $lbl = strtolower(trim($label ?? ''));
    $idx = $index ?? 0;
    $icn = strtolower(trim($icon ?? ''));
@endphp
@if($icn && file_exists(public_path(ltrim($icn, '/'))))
    <img src="{{ asset(ltrim($icn, '/')) }}" alt="{{ $label ?? 'Icon' }}" style="width:28px;height:28px;object-fit:contain;">
@elseif($icn === 'building' || str_contains($lbl, 'developer') || ($idx === 0 && !$icn))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 21h18"/>
        <path d="M5 21V7l8-4v18"/>
        <path d="M19 21V11l-6-4"/>
        <path d="M9 9v.01"/>
        <path d="M9 12v.01"/>
        <path d="M9 15v.01"/>
        <path d="M9 18v.01"/>
    </svg>
@elseif($icn === 'tag' || $icn === 'price' || str_contains($lbl, 'price') || ($idx === 1 && !$icn))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <circle cx="12" cy="13" r="3"/>
        <path d="M12 11v4"/>
    </svg>
@elseif($icn === 'calendar' || $icn === 'date' || str_contains($lbl, 'handover') || str_contains($lbl, 'date') || str_contains($lbl, 'delivery') || ($idx === 2 && !$icn))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
        <line x1="16" x2="16" y1="2" y2="6"/>
        <line x1="8" x2="8" y1="2" y2="6"/>
        <line x1="3" x2="21" y1="10" y2="10"/>
        <path d="m9 16 2 2 4-4"/>
    </svg>
@elseif($icn === 'home' || $icn === 'property_type' || str_contains($lbl, 'type') || str_contains($lbl, 'community') || ($idx === 3 && !$icn))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <rect width="18" height="18" x="3" y="3" rx="2"/>
        <path d="M3 9h18"/>
        <path d="M9 21V9"/>
    </svg>
@elseif($icn === 'shield' || str_contains($lbl, 'ownership') || str_contains($lbl, 'freehold'))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
    </svg>
@elseif($icn === 'bed' || $icn === 'bedroom' || str_contains($lbl, 'bed') || str_contains($lbl, 'unit') || ($idx === 4 && !$icn))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <path d="M2 4v16"/>
        <path d="M2 8h18a2 2 0 0 1 2 2v10"/>
        <path d="M2 17h20"/>
        <path d="M6 8v9"/>
    </svg>
@elseif($icn === 'credit-card' || $icn === 'payment' || str_contains($lbl, 'payment') || str_contains($lbl, 'plan') || ($idx === 5 && !$icn))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <rect width="20" height="14" x="2" y="5" rx="2"/>
        <line x1="2" x2="22" y1="10" y2="10"/>
        <path d="M6 15h2"/>
        <path d="M12 15h6"/>
    </svg>
@elseif($icn === 'map-pin' || str_contains($lbl, 'location'))
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
        <circle cx="12" cy="10" r="3"/>
    </svg>
@elseif($icn === 'star')
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
    </svg>
@else
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 21h18"/>
        <path d="M5 21V7l8-4v18"/>
        <path d="M19 21V11l-6-4"/>
        <path d="M9 9v.01"/>
        <path d="M9 12v.01"/>
        <path d="M9 15v.01"/>
        <path d="M9 18v.01"/>
    </svg>
@endif
