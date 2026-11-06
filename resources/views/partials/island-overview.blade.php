<!-- Overview & Content Section -->
<style>
.overviewSection .blogContainer ul,
.overviewSection ul:not(.navbar-nav):not(.nav),
.blogContainer ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin: 16px 0 20px 0 !important;
    padding-left: 28px !important;
}
.overviewSection .blogContainer ol,
.overviewSection ol,
.blogContainer ol {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin: 16px 0 20px 0 !important;
    padding-left: 28px !important;
}
.overviewSection .blogContainer li,
.overviewSection li:not(.navbar-nav li),
.blogContainer li {
    list-style: inherit !important;
    display: list-item !important;
    margin-bottom: 8px !important;
    line-height: 1.75 !important;
    color: #2b2b2b !important;
}
.overviewSection .blogContainer ul ul,
.overviewSection ul ul,
.blogContainer ul ul {
    list-style-type: circle !important;
    margin: 8px 0 8px 0 !important;
    padding-left: 24px !important;
}
.overviewSection .blogContainer ul ul ul,
.overviewSection ul ul ul,
.blogContainer ul ul ul {
    list-style-type: square !important;
}
.overviewSection h1,
.overviewSection h2,
.overviewSection h3,
.overviewSection h4,
.blogContainer h1,
.blogContainer h2,
.blogContainer h3,
.blogContainer h4,
.overviewMainTitle,
.overviewSubHeading {
    color: #1a4731 !important;
}
</style>
<section class="overviewSection" aria-label="Saima Projects: The Residential Communities">
    <div class="container">
        <div class="blogContainer">
            @php
                $customOverviewHtml = page_section('content', 'html', null, '/') ?: page_section('overview', 'html', null, '/');
            @endphp
            @if(!empty($customOverviewHtml))
                {!! $customOverviewHtml !!}
            @else
                <h2 class="overviewMainTitle">
                    {{ page_section('overview', 'heading', 'Saima Projects: The Residential Communities') }}
                </h2>

                <p class="overviewParagraph">
                    {{ page_section('overview', 'intro', "This is probably the section you've been waiting for. Saima Group has rolled out its Saima projects in phases, each with its own character, price point, and target buyer. Here's a rundown of the main communities, based on details published on the official project pages.") }}
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
                    Wadeem Gardens is one of the premier additions to the Saima community, offering four-, five-, and six-bedroom villas across three gated clusters within the wider Wadeem district. Buyers can choose between two architectural directions, Contemporary Arabic and Modernist. No two clusters feel identical, since the layouts are deliberately varied to avoid a cookie-cutter look. The standout feature is a 2.3-kilometre climate-controlled spine connecting the community to six clubhouses, an office park, healthcare centres, an arena, retail and dining, two international schools, and a waterfront promenade.
                </p>

                <h3 class="overviewSubHeading">Saima Golf Estates</h3>
                <p class="overviewParagraph">
                    If golf is part of your lifestyle wish list, Saima Golf Estates is the community built around exactly that. It's Saima's golf-anchored projects launch, set alongside an 18-hole championship course with Andalusian-inspired architecture running through the residences.
                </p>
                <p class="overviewParagraph">
                    The collection spans distinct home types, from 3-bedroom Golf Townhomes through to 6-bedroom Golf Mansions and Fairway Villas. On-site amenities include a country clubhouse, parks, private school, coworking spaces, and multi-sport courts.
                </p>

                <h3 class="overviewSubHeading">Nawayef East Hills</h3>
                <p class="overviewParagraph">
                    Nawayef East Hills sits on elevated terrain, offering four- to eight-bedroom villas and mansions with sweeping views. It's one of the more architecturally striking corners of the Saima villas portfolio, with multi-level floor plans, high-end finishes, and a design language built around openness and natural light.
                </p>

                <h3 class="overviewSubHeading">Nawayef Village</h3>
                <p class="overviewParagraph">
                    Nawayef Village introduced luxury townhouses and twin villas. It's a gated community with a Mediterranean-influenced aesthetic, sleek lines, and floor-to-ceiling windows, aimed squarely at families who want a slightly more compact home without stepping outside the Saima real estate ecosystem.
                </p>

                <h3 class="overviewSubHeading">Nawayef Park Views</h3>
                <p class="overviewParagraph">
                    And for buyers who'd prefer an apartment over a villa, Nawayef Park Views brings something new to the table: luxury apartment residences, with one- to four-bedroom units, Mediterranean-inspired architecture, and modern amenities.
                </p>

                <h3 class="overviewSubHeading">Al Naseem Villas</h3>
                <p class="overviewParagraph">
                    Al Naseem Saima is one of the earliest and best-known launches. It's a collection of four- to six-bedroom luxury villas, built across generous plots with distinct architectural facades: Modern Contemporary and Classical.
                </p>
                <p class="overviewParagraph">
                    The community sits within a gated setting and includes a private country club with a gym, spa, and pool, a community mosque, and landscaped pedestrian and cycling paths threading through the neighbourhood.
                </p>
                <p class="overviewParagraph">
                    What stands out about Al Naseem Saima is the clear title and flexible investment structure, which has made it a popular entry point for both residents and overseas investors looking at Saima properties for sale.
                </p>

                <h3 class="overviewSubHeading">Bashayer: Waterfront Community</h3>
                <p class="overviewParagraph">
                    Bashayer deserves a special mention for its prime waterfront location with panoramic views. The gated neighbourhood comprises luxury villas and residences with open layouts and waterfront promenade.
                </p>
                <p class="overviewParagraph">
                    Amenities include a clubhouse with a rooftop pool, children's playground, multiple sports courts, and a scenic promenade connecting the community.
                </p>
                <p class="overviewParagraph">
                    The homes range from ultra-premium four- and five-bedroom Saima villas to one- to three-bedroom apartments and executive penthouses.
                </p>

                <h3 class="overviewSubHeading">Bashayer Residences</h3>
                <p class="overviewParagraph">
                    Bashayer Residences forms the apartment side of the Bashayer neighbourhood. Residences here range from one- to three-bedroom apartments up to four-bedroom penthouses, set across modern buildings with open layouts framing skyline views.
                </p>

                <h3 class="overviewSubHeading">Wadeem Gardens: Build-Your-Own Plots</h3>
                <p class="overviewParagraph">
                    Not everyone wants a pre-designed villa. Wadeem residential plots allow buyers to construct custom four- to six-bedroom villas, with enough space to accommodate a swimming pool alongside outdoor dining and entertainment areas.
                </p>

                <h3 class="overviewSubHeading">Masyaf: Build-Your-Own Plots</h3>
                <p class="overviewParagraph">
                    Masyaf follows a similar blank-canvas approach, letting residents design and build bespoke homes surrounded by greenery and waterfront views.
                </p>

                <h3 class="overviewSubHeading">Sunset Cliff Villas</h3>
                <p class="overviewParagraph">
                    Sunset Cliff Villas are an ultra-exclusive enclave of cliff-edge mansions positioned to take full advantage of unobstructed sunset views over the water.
                </p>

                <h3 class="overviewSubHeading">Saima Quays</h3>
                <p class="overviewParagraph">
                    Saima Quays are standalone villas ranging from four to eight bedrooms, designed around a waterfront theme with expansive balconies and terraces.
                </p>

                <h3 class="overviewSubHeading">Saima Sahl</h3>
                <p class="overviewParagraph">
                    Saima Sahl is a large-scale enclave made up of spacious villas. It's pitched as a more laid-back, greenery-focused corner with extensive parklands.
                </p>

                <h3 class="overviewSubHeading">Saima Hills</h3>
                <p class="overviewParagraph">
                    Saima Hills is a gated community blending modern and traditional design cues, best suited to buyers who want elevated views and tranquil surroundings.
                </p>
                <p class="overviewParagraph">
                    Taken together, this is a wide spread of product types, which is why Saima villas and apartments attract such a broad mix of buyers, from young families to seasoned investors.
                </p>
            @endif
            @endif
        </div>
    </div>
</section>
