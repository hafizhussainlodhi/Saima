<section class="GolfHighlights-module__mmSHGq__highlightsSection"><div class="container"><div class="GolfHighlights-module__mmSHGq__highlightsGrid">
@php
    $commHighlights = page_section('highlights', 'items', array (
  0 => 
  array (
    'label' => 'Developer',
    'value' => 'Modon Properties',
  ),
  1 => 
  array (
    'label' => 'Price',
    'value' => 'AED 4,300,000*',
  ),
  2 => 
  array (
    'label' => 'Handover Date',
    'value' => 'Q3 2030',
  ),
  3 => 
  array (
    'label' => 'Property Type',
    'value' => 'Villas',
  ),
  4 => 
  array (
    'label' => 'Ownership',
    'value' => 'Freehold',
  ),
), $page->slug);
@endphp
@foreach($commHighlights as $hItem)
    <div class="GolfHighlights-module__mmSHGq__highlightCard">
        <div class="GolfHighlights-module__mmSHGq__iconWrapper">
            <span class="GolfHighlights-module__mmSHGq__accentCircle"></span>
            <span class="GolfHighlights-module__mmSHGq__svgIcon">@include('partials.highlight-icon', ['label' => $hItem['label'] ?? '', 'icon' => $hItem['icon'] ?? '', 'index' => $loop->index])</span>
        </div>
        <div class="GolfHighlights-module__mmSHGq__highlightInfo">
            <span class="GolfHighlights-module__mmSHGq__highlightLabel">{{ $hItem['label'] ?? '' }}</span>
            <span class="GolfHighlights-module__mmSHGq__highlightValue">{{ $hItem['value'] ?? '' }}</span>
        </div>
    </div>
@endforeach
</div></div></section>