@php
$dbImage = page_section('overview_location', 'image', '/images/hudayriyat-overview.jpg');
if ($dbImage && !str_starts_with($dbImage, 'http') && !str_starts_with($dbImage, '/')) {
    $dbImage = asset($dbImage);
}

$dbParagraphs = page_section('overview_location', 'paragraphs', "Hudayriyat Island is a growing waterfront destination in Abu Dhabi, offering a mix of residential, leisure, and outdoor experiences. Its location makes it easy to reach Abu Dhabi city and other important areas through well-connected roads and bridges.\n\nThe island is close to popular areas such as Al Bateen and Saadiyat Island, while Abu Dhabi city centre is also within easy reach. Residents can enjoy quick access to beaches, parks, restaurants, sports facilities, and other everyday amenities.\n\nHudayriyat Island is also known for its wide range of outdoor attractions. Hudayriyat Beach, Marsana, cycling tracks, and sports facilities provide plenty of options for families and active lifestyles. Major attractions such as Qasr Al Watan, Emirates Palace, and Abu Dhabi Corniche are also nearby.\n\nWith its waterfront setting, recreational facilities, and convenient location, Hudayriyat Island is becoming a popular choice for people looking for a modern lifestyle in Abu Dhabi.");
@endphp

<section id="overview-location" aria-label="Hudayriyat Island Overview and Location" class="locOverviewSection">
    <div class="container">
        <div class="locContentGrid">
            <!-- Left Column: Title and Paragraphs -->
            <div class="locLeftCol">
                <h2 class="locMainTitle">
                    {{ page_section('overview_location', 'heading', 'Hudayriyat Island Overview and Location') }}
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
                    <img src="{{ $dbImage }}" alt="{{ page_section('overview_location', 'image_alt', 'Hudayriyat Island Overview and Luxury Villas') }}" width="800" height="535" class="locOverviewImage">
                </div>
            </div>
        </div>
    </div>
</section>
