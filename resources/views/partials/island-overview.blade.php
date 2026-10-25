<section class="overviewSection" aria-label="Hudayriyat Island Projects: The Residential Communities">
    <div class="container">
        <div class="blogContainer">
            @php
                $customOverviewHtml = page_section('content', 'html', null, '/') ?: page_section('overview', 'html', null, '/');
            @endphp
            @if(!empty($customOverviewHtml))
                {!! $customOverviewHtml !!}
            @else
                <h2 class="overviewMainTitle">
                    {{ page_section('overview', 'heading', 'Hudayriyat Island Projects: The Residential Communities') }}
                </h2>

                <p class="overviewParagraph">
                    {{ page_section('overview', 'intro', "This is probably the section you've been waiting for. Modon has rolled out its Hudayriyat Island projects in phases, each with its own character, price point, and target buyer. Here's a rundown of the main communities, based on details published on the island's official project pages.") }}
                </p>

            @php
                $overviewItems = page_section('overview', 'items', null);
            @endphp

            @if(is_array($overviewItems) && count($overviewItems) > 0)
                @foreach($overviewItems as $item)
                    @if(!empty($item['title']))
                        <h3 class="overviewSubHeading">{{ $item['title'] }}</h3>
                    @endif
                    @if(!empty($item['description']))
                        @foreach(preg_split("/\r\n\r\n|\n\n/", $item['description']) as $paragraph)
                            @if(trim($paragraph))
                                <p class="overviewParagraph">{{ trim($paragraph) }}</p>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <!-- Fallback if unconfigured -->
                <h3 class="overviewSubHeading">Wadeem Gardens</h3>
                <p class="overviewParagraph">
                    Wadeem Gardens is one of the newer additions to the Hudayriyat Island community, offering four-, five-, and six-bedroom villas across three gated clusters within the wider Wadeem district. Buyers can choose between two architectural directions, Contemporary Arabic and Modernist. No two clusters feel identical, since the layouts are deliberately varied to avoid a cookie-cutter look. The standout feature is a 2.3-kilometre climate-controlled spine connecting the community to six clubhouses, an office park, healthcare centres, an arena, retail and dining, two international schools, and a waterfront promenade. Wadeem Gardens is designed to house around 35,000 residents, with a 25/75 payment plan (5% on reservation, staged installments through the build, and the balance on handover). It sits roughly 20 minutes from Zayed International Airport and about 15 minutes from Disneyland Abu Dhabi.
                </p>

                <h3 class="overviewSubHeading">Hudayriyat Golf Estates</h3>
                <p class="overviewParagraph">
                    If golf is part of your lifestyle wish list, Hudayriyat Golf Estates is the community built around exactly that. It's Modon's golf-anchored Hudayriyat Island projects launch, set alongside a 95-hectare, 18-hole championship course with Andalusian-inspired architecture running through the residences.
                </p>
                <p class="overviewParagraph">
                    The collection spans six distinct home types, from 3-bedroom Golf Townhomes through to 6-bedroom Golf Mansions and Fairway Villas, with built-up areas ranging from roughly 204 to over 1,150 square metres. On-site amenities include a country clubhouse, Biotopia Park, a private school, coworking spaces, and multi-sport courts, with handover generally slated for 2030. It's a freehold community open to all nationalities, and purchases from AED 2 million may qualify buyers for the UAE's 10-year Golden Visa.
                </p>

                <h3 class="overviewSubHeading">Nawayef East Hills</h3>
                <p class="overviewParagraph">
                    Nawayef East Hills sits on the elevated terrain of Hudayriyat Island, offering four- to eight-bedroom villas and mansions with sweeping coastline and skyline views. It's one of the more architecturally striking corners of the Hudayriyat Island villas portfolio, with multi-level floor plans (including basements), high-end finishes, and a design language built around openness and natural light. Set for handover in 2026, it's a freehold community open to buyers of every nationality, and it's marketed as family-friendly, with private gardens and access to wellness and sports facilities for all ages.
                </p>

                <h3 class="overviewSubHeading">Nawayef Village</h3>
                <p class="overviewParagraph">
                    Nawayef Village introduced the island's first townhouse product, three- to five-bedroom townhouses and twin villas set between the East and West Hills. It's a gated community with a Mediterranean-influenced aesthetic, sleek lines, and floor-to-ceiling windows, aimed squarely at families who want a slightly more compact home without stepping outside the Hudayriyat Island real estate ecosystem. The payment structure is a 50/50 split, with handover currently scheduled for the first quarter of 2029.
                </p>

                <h3 class="overviewSubHeading">Nawayef Park Views</h3>
                <p class="overviewParagraph">
                    And for buyers who'd prefer an apartment over a villa, Nawayef Park Views brings something new to the table: the island's first freehold apartment community, with one- to four-bedroom units between roughly 1,044 and 5,328 square feet, Mediterranean-inspired architecture, and prices starting from around AED 2 million.
                </p>

                <h3 class="overviewSubHeading">Al Naseem Villas</h3>
                <p class="overviewParagraph">
                    Al Naseem Hudayriyat Island is one of the earliest and best-known launches on the island. It's a collection of four- to six-bedroom luxury villas in Hudayriyat Island, built across generous plots ranging from roughly 724 to 1,024 square metres, with two distinct architectural facades to choose from: South Californian and Modern Contemporary.
                </p>
                <p class="overviewParagraph">
                    The community sits within a gated, hilltop setting and includes a private country club with a gym, spa, and pool, a community mosque, and landscaped pedestrian and cycling paths threading through the neighbourhood.
                </p>
                <p class="overviewParagraph">
                    What stands out about Al Naseem Hudayriyat Island is the freehold structure. It's open to buyers of all nationalities, which has made it a popular entry point for both residents and overseas investors looking at Hudayriyat Island properties for sale.
                </p>
                <p class="overviewParagraph">
                    Design touches like bespoke oak veneer furniture and open-plan interiors give the villas a warm, considered feel rather than the slightly generic look some new-build communities fall into.
                </p>

                <h3 class="overviewSubHeading">Bashayer: The Island's First Waterfront Community</h3>
                <p class="overviewParagraph">
                    Bashayer deserves a special mention, mostly because of how quickly it moved. Marketed as the first waterfront community on Hudayriyat Island with views of Al Bateen and Abu Dhabi's skyline, the gated neighbourhood, comprising 157 villas and 330 residences across two low-rise buildings reportedly sold out within 24 hours of launch, generating around Dh3 billion in sales.
                </p>
                <p class="overviewParagraph">
                    Amenities include a clubhouse with a rooftop infinity pool, a children's playground, multiple sports courts, and a 3.5-kilometre waterfront promenade connecting the community via walkable piers and a linear park.
                </p>
                <p class="overviewParagraph">
                    The homes range from ultra-premium four- and five-bedroom Hudayriyat Island villas to one- to three-bedroom apartments and four-bedroom penthouses.
                </p>
                <p class="overviewParagraph">
                    Whatever you think about how these sellouts get reported, it's a fairly strong signal about buyer appetite for Hudayriyat Island real estate, particularly anything positioned directly on the water.
                </p>

                <h3 class="overviewSubHeading">Bashayer Residences</h3>
                <p class="overviewParagraph">
                    Bashayer Residences forms the apartment side of the Bashayer neighbourhood, the island's first waterfront community, which famously sold out within 24 hours of launch and generated around Dh3 billion in sales. Residences here range from one- to three-bedroom apartments up to four-bedroom penthouses, set across two low-rise buildings with open layouts and floor-to-ceiling windows framing skyline views. Residents share access to the wider Bashayer amenity package: a clubhouse with a rooftop infinity pool, multiple sports courts, a children's playground, and a 3.5-kilometre waterfront promenade lined with walkable piers and a linear park.
                </p>

                <h3 class="overviewSubHeading">Wadeem Gardens: Build-Your-Own Plots</h3>
                <p class="overviewParagraph">
                    Not everyone wants a pre-designed villa, and Modon clearly anticipated that. Wadeem was one of the island's earliest plot releases. It was described by the developer as its first residential plots on the island, opposite Al Bateen, and the first new offering of land close to the city's most exclusive areas in more than 15 years. The plots allow buyers to construct four- to six-bedroom villas, with enough space to accommodate a swimming pool alongside outdoor dining and entertainment areas, and the release is open to all nationalities.
                </p>

                <h3 class="overviewSubHeading">Masyaf: Build-Your-Own Plots</h3>
                <p class="overviewParagraph">
                    Masyaf follows a similar blank-canvas approach, letting residents design and build bespoke homes surrounded by greenery and waterfront views, with easy access to nearby destinations like the Nawayef Souq and Hudayriyat Beach.
                </p>

                <h3 class="overviewSubHeading">Sunset Cliff Villas</h3>
                <p class="overviewParagraph">
                    Sunset Cliff Villas are an ultra-exclusive enclave of six-bedroom, cliff-edge mansions in the island's Coast District, built by the same team behind Al Naseem and Nawayef, and positioned to take full advantage of unobstructed sunset views over the water.
                </p>

                <h3 class="overviewSubHeading">Hudayriyat Quays</h3>
                <p class="overviewParagraph">
                    Hudayriyat Quays are standalone villas ranging from four to eight bedrooms, with plot sizes between roughly 4,306 and 21,528 square feet, designed around a waterfront theme with expansive balconies and terraces.
                </p>

                <h3 class="overviewSubHeading">Hudayriyat Sahl</h3>
                <p class="overviewParagraph">
                    Hudayriyat Sahl is a large-scale enclave spanning around 86 hectares, made up of roughly 987 villas across plot sizes from about 8,073 to 10,010 square feet, each offering five to six bedrooms. It's pitched as a more laid-back, greenery-focused corner of the island, with an estimated community population approaching 6,000 residents.
                </p>

                <h3 class="overviewSubHeading">Hudayriyat Hills</h3>
                <p class="overviewParagraph">
                    Hudayriyat Hills is a gated community blending modern and traditional design cues, best suited to buyers who want elevated views over the island's coastline and terrain.
                </p>
                <p class="overviewParagraph">
                    Taken together, this is a genuinely wide spread of product types, which is part of why Hudayriyat Island villas for sale attract such a broad mix of buyers, from young families to seasoned investors.
                </p>
            @endif
            @endif
        </div>
    </div>
</section>
