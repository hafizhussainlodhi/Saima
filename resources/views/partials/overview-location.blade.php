@php
$dbImage = page_section('overview_location', 'image', '/images/Saima-overview.jpg');
if ($dbImage && !str_starts_with($dbImage, 'http') && !str_starts_with($dbImage, '/')) {
    $dbImage = asset($dbImage);
}

$dbParagraphs = page_section('overview_location', 'paragraphs', "Saima is a premier real estate development portfolio in Pakistan, offering a mix of residential, commercial, leisure, and modern living experiences. Its prime locations make it easy to reach major city centers and business districts through well-connected roads and highways.\n\nThe communities are close to popular commercial hubs and transit networks, while key city landmarks are within easy reach. Residents enjoy quick access to parks, educational institutions, healthcare centers, dining outlets, and everyday amenities.\n\nSaima developments are also renowned for their high-quality construction and modern facilities. Gated security, recreational areas, fitness clubs, and landscaped surroundings provide peace of mind for families and investors.\n\nWith strategic locations, flexible installment plans, and reputable engineering, Saima projects remain the top choice for modern living and high capital appreciation.");
@endphp

<section id="overview-location" aria-label="Saima Overview and Location" class="locOverviewSection">
    <div class="container">
        <div class="locContentGrid">
            <!-- Left Column: Title and Paragraphs -->
            <div class="locLeftCol">
                <h2 class="locMainTitle">
                    {{ page_section('overview_location', 'heading', 'Saima Overview and Location') }}
                </h2>

                <div class="locParagraphs">
                    @if(preg_match('/<[a-z][\s\S]*>/i', (string)$dbParagraphs))
                        {!! $dbParagraphs !!}
                    @else
                        @foreach(preg_split("/\r\n\r\n|\n\n/", (string)$dbParagraphs) as $para)
                            @if(trim($para))
                                <p>{{ trim($para) }}</p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Right Column: Full Picture (No Zoom, No Crop) -->
            <div class="locRightCol">
                <div class="locImageCard">
                    <img src="{{ $dbImage }}" alt="{{ page_section('overview_location', 'image_alt', 'Saima Overview and Luxury Living') }}" width="800" height="535" class="locOverviewImage">
                </div>
            </div>
        </div>
    </div>
</section>
