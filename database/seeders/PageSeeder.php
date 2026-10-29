<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageSection;

class PageSeeder extends Seeder
{
    /**
     * Seed initial pages and sections.
     */
    public function run(): void
    {
        $pages = array (
  0 => 
  array (
    'title' => 'Home',
    'slug' => '/',
    'body' => NULL,
    'in_navbar' => true,
    'navbar_order' => 1,
    'is_published' => true,
    'meta_title' => 'Hudayriyat Island – Luxury Villas & Waterfront Living in Abu Dhabi',
    'meta_description' => 'Discover Hudayriyat Island, a premier luxury waterfront community in Abu Dhabi offering exclusive villas, mansions, and world-class amenities.',
    'meta_keywords' => 'Hudayriyat Island, Luxury villas Abu Dhabi, Modon Properties, Wadeem Gardens',
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner & Form',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hudayriyat
Island',
          'subtitle' => 'Abu Dhabi’s Most Exclusive Coastal
Lifestyle Destinatio',
          'badge' => 'Freehold for All Nationalities',
          'bg_image' => '/images/hero/slide-1.jpg',
          'form_small' => 'REQUES',
          'form_large' => 'A CALL BAC',
          'submit_button' => 'REQUEST NO',
          'bg_image_alt' => 'Hudayriyat Island Waterfront Sanctuary',
          'image_alt' => 'Hudayriyat Island Waterfront Sanctuary',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'developer' => 'Modon Properties',
          'launch_price' => 'AED 4,300,000*',
          'handover' => 'Q3 2030',
          'property_type' => 'Villas & Apartments',
          'ownership' => 'Freehold',
          'payment_plan' => '5% / 35% / 60%',
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'launch_price',
              'label' => 'Launch Price',
              'value' => 'AED 4,300,000*',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q3 2030',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Villas & Apartments',
            ),
            4 => 
            array (
              'key' => 'ownership',
              'label' => 'Ownership',
              'value' => 'Freehold',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '5% / 35% / 60%',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'section_key' => 'communities',
        'section_name' => 'Featured Projects',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'heading' => 'Projects',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Wadeem Gardens',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 8.7M AED',
              'delivery' => 'Delivery Date: Q2 2031',
              'developer' => 'Modon Properties',
              'paymentPlan' => 'Flexible Payment Plan',
              'href' => '/wadeem-gardens',
              'image' => '/images/communities/wadeem-gardens.png',
            ),
            1 => 
            array (
              'name' => 'Hudayriyat Golf Estates',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 4.3M AED*',
              'delivery' => 'Delivery Date: Q3 2030',
              'developer' => 'Modon Properties',
              'paymentPlan' => '5/35/60 Payment Plan',
              'href' => '/hudayriyat-golf-estates',
              'image' => '/images/communities/golf-estates.jpg',
            ),
            2 => 
            array (
              'name' => 'Bashayer Residences',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 2.4M AED',
              'delivery' => 'Delivery Date: Q1 2030',
              'developer' => 'Modon Properties',
              'paymentPlan' => '10/40/50 Payment Plan',
              'href' => '/bashayer-residences',
              'image' => '/images/communities/bashayer-residences.jpg',
            ),
            3 => 
            array (
              'name' => 'Nawayef East Hills',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 6.6M AED',
              'delivery' => 'Delivery Date: Q1 2028',
              'developer' => 'Modon Properties',
              'paymentPlan' => '10/30/60 Payment Plan',
              'href' => '/nawayef-east-hills',
              'image' => '/images/communities/nawayef-east.jpg',
            ),
            4 => 
            array (
              'name' => 'Bashayer Villas',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 6M AED',
              'delivery' => 'Delivery Date: Q3 2028',
              'developer' => 'Modon Properties',
              'paymentPlan' => '20/30/50 Payment Plan',
              'href' => '/bashayer-villas',
              'image' => '/images/communities/bashayer-villas.jpg',
            ),
            5 => 
            array (
              'name' => 'Al Naseem Villas',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 7.8M AED',
              'delivery' => 'Delivery Date: Q4 2026',
              'developer' => 'Modon Properties',
              'paymentPlan' => '10/30/60 Payment Plan',
              'href' => '/al-naseem-villas',
              'image' => '/images/communities/al-naseem.jpg',
            ),
            6 => 
            array (
              'name' => 'Masyaf Plots',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: Launch Soon',
              'delivery' => 'Delivery Date: Launch Soon',
              'developer' => 'Modon Properties',
              'paymentPlan' => 'Payment Plan: Launch Soon',
              'href' => '/masyaf-plots',
              'image' => '/images/communities/masyaf-plots.jpg',
            ),
            7 => 
            array (
              'name' => 'Nawayef Village',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 4.1M AED',
              'delivery' => 'Delivery Date: Q1 2029',
              'developer' => 'Modon Properties',
              'paymentPlan' => '10/40/50 Payment Plan',
              'href' => '/nawayef-village',
              'image' => '/images/communities/nawayef-village.jpg',
            ),
            8 => 
            array (
              'name' => 'Wadeem Plots',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 3.7M AED',
              'delivery' => 'Delivery Date: Q4 2028',
              'developer' => 'Modon Properties',
              'paymentPlan' => '10/40/50 Payment Plan',
              'href' => '/wadeem-plots',
              'image' => '/images/communities/wadeem-plots.jpg',
            ),
            9 => 
            array (
              'name' => 'Nawayef Park Views',
              'location' => 'Hudayriyat Island, Abu Dhabi',
              'price' => 'Launch Price: 2.1M AED',
              'delivery' => 'Delivery Date: Q1 2028',
              'developer' => 'Modon Properties',
              'paymentPlan' => '10/40/50 Payment Plan',
              'href' => '/nawayef-park-views',
              'image' => '/images/communities/nawayef-park-views.jpg',
            ),
          ),
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<h2>Hudayriyat Island Projects: The Residential Communities</h2>
<p>This is probably the section you\'ve been waiting for. Modon has rolled out its Hudayriyat Island projects in phases, each with its own character, price point, and target buyer. Here\'s a rundown of the main communities, based on details published on the island\'s official project pages.</p>

<h3>Wadeem Gardens</h3>
<p>Wadeem Gardens is one of the newer additions to the Hudayriyat Island community, offering four-, five-, and six-bedroom villas across three gated clusters within the wider Wadeem district. Buyers can choose between two architectural directions, Contemporary Arabic and Modernist. No two clusters feel identical, since the layouts are deliberately varied to avoid a cookie-cutter look. The standout feature is a 2.3-kilometre climate-controlled spine connecting the community to six clubhouses, an office park, healthcare centres, an arena, retail and dining, two international schools, and a waterfront promenade. Wadeem Gardens is designed to house around 35,000 residents, with a 25/75 payment plan (5% on reservation, staged installments through the build, and the balance on handover). It sits roughly 20 minutes from Zayed International Airport and about 15 minutes from Disneyland Abu Dhabi.</p>

<h3>Hudayriyat Golf Estates</h3>
<p>If golf is part of your lifestyle wish list, Hudayriyat Golf Estates is the community built around exactly that. It\'s Modon\'s golf-anchored Hudayriyat Island projects launch, set alongside a 95-hectare, 18-hole championship course with Andalusian-inspired architecture running through the residences.</p>
<p>The collection spans six distinct home types, from 3-bedroom Golf Townhomes through to 6-bedroom Golf Mansions and Fairway Villas, with built-up areas ranging from roughly 204 to over 1,150 square metres. On-site amenities include a country clubhouse, Biotopia Park, a private school, coworking spaces, and multi-sport courts, with handover generally slated for 2030. It\'s a freehold community open to all nationalities, and purchases from AED 2 million may qualify buyers for the UAE\'s 10-year Golden Visa.</p>

<h3>Nawayef East Hills</h3>
<p>Nawayef East Hills sits on the elevated terrain of Hudayriyat Island, offering four- to eight-bedroom villas and mansions with sweeping coastline and skyline views. It\'s one of the more architecturally striking corners of the Hudayriyat Island villas portfolio, with multi-level floor plans (including basements), high-end finishes, and a design language built around openness and natural light. Set for handover in 2026, it\'s a freehold community open to buyers of every nationality, and it\'s marketed as family-friendly, with private gardens and access to wellness and sports facilities for all ages.</p>

<h3>Nawayef Village</h3>
<p>Nawayef Village introduced the island\'s first townhouse product, three- to five-bedroom townhouses and twin villas set between the East and West Hills. It\'s a gated community with a Mediterranean-influenced aesthetic, sleek lines, and floor-to-ceiling windows, aimed squarely at families who want a slightly more compact home without stepping outside the Hudayriyat Island real estate ecosystem. The payment structure is a 50/50 split, with handover currently scheduled for the first quarter of 2029.</p>

<h3>Nawayef Park Views</h3>
<p>And for buyers who\'d prefer an apartment over a villa, Nawayef Park Views brings something new to the table: the island\'s first freehold apartment community, with one- to four-bedroom units between roughly 1,044 and 5,328 square feet, Mediterranean-inspired architecture, and prices starting from around AED 2 million.</p>

<h3>Al Naseem Villas</h3>
<p>Al Naseem Hudayriyat Island is one of the earliest and best-known launches on the island. It\'s a collection of four- to six-bedroom luxury villas in Hudayriyat Island, built across generous plots ranging from roughly 724 to 1,024 square metres, with two distinct architectural facades to choose from: South Californian and Modern Contemporary.</p>
<p>The community sits within a gated, hilltop setting and includes a private country club with a gym, spa, and pool, a community mosque, and landscaped pedestrian and cycling paths threading through the neighbourhood.</p>
<p>What stands out about Al Naseem Hudayriyat Island is the freehold structure. It\'s open to buyers of all nationalities, which has made it a popular entry point for both residents and overseas investors looking at Hudayriyat Island properties for sale.</p>
<p>Design touches like bespoke oak veneer furniture and open-plan interiors give the villas a warm, considered feel rather than the slightly generic look some new-build communities fall into.</p>

<h3>Bashayer: The Island\'s First Waterfront Community</h3>
<p>Bashayer deserves a special mention, mostly because of how quickly it moved. Marketed as the first waterfront community on Hudayriyat Island with views of Al Bateen and Abu Dhabi\'s skyline, the gated neighbourhood, comprising 157 villas and 330 residences across two low-rise buildings reportedly sold out within 24 hours of launch, generating around Dh3 billion in sales.</p>
<p>Amenities include a clubhouse with a rooftop infinity pool, a children\'s playground, multiple sports courts, and a 3.5-kilometre waterfront promenade connecting the community via walkable piers and a linear park.</p>
<p>The homes range from ultra-premium four- and five-bedroom Hudayriyat Island villas to one- to three-bedroom apartments and four-bedroom penthouses.</p>
<p>Whatever you think about how these sellouts get reported, it\'s a fairly strong signal about buyer appetite for Hudayriyat Island real estate, particularly anything positioned directly on the water.</p>

<h3>Bashayer Residences</h3>
<p>Bashayer Residences forms the apartment side of the Bashayer neighbourhood, the island\'s first waterfront community, which famously sold out within 24 hours of launch and generated around Dh3 billion in sales. Residences here range from one- to three-bedroom apartments up to four-bedroom penthouses, set across two low-rise buildings with open layouts and floor-to-ceiling windows framing skyline views. Residents share access to the wider Bashayer amenity package: a clubhouse with a rooftop infinity pool, multiple sports courts, a children\'s playground, and a 3.5-kilometre waterfront promenade lined with walkable piers and a linear park.</p>

<h3>Wadeem Gardens: Build-Your-Own Plots</h3>
<p>Not everyone wants a pre-designed villa, and Modon clearly anticipated that. Wadeem was one of the island\'s earliest plot releases. It was described by the developer as its first residential plots on the island, opposite Al Bateen, and the first new offering of land close to the city\'s most exclusive areas in more than 15 years. The plots allow buyers to construct four- to six-bedroom villas, with enough space to accommodate a swimming pool alongside outdoor dining and entertainment areas, and the release is open to all nationalities.</p>

<h3>Masyaf: Build-Your-Own Plots</h3>
<p>Masyaf follows a similar blank-canvas approach, letting residents design and build bespoke homes surrounded by greenery and waterfront views, with easy access to nearby destinations like the Nawayef Souq and Hudayriyat Beach.</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'investment',
        'section_name' => 'Investment & Financing',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'heading' => 'Investment Potential',
          'location_badge' => 'Hudayriyat Island, Abu Dhabi',
          'description' => 'Hudayriyat Island offers attractive real estate investment opportunities through its premium villa communities, waterfront lifestyle, and developments by Modon Properties. With growing interest in luxury coastal living in Abu Dhabi, the island presents opportunities for investors seeking long-term capital appreciation and potential rental income.',
          'highlights_heading' => 'Key Investment Highlights:',
          'investment_highlights' => 
          array (
            0 => 
            array (
              'text' => 'Premium villa communities with exclusive residential options',
            ),
            1 => 
            array (
              'text' => 'Developed by Modon Properties',
            ),
            2 => 
            array (
              'text' => 'Strong appeal among luxury homebuyers and property investors',
            ),
            3 => 
            array (
              'text' => 'Coastal location with access to beaches and recreational facilities',
            ),
            4 => 
            array (
              'text' => 'Potential for long-term capital appreciation',
            ),
            5 => 
            array (
              'text' => 'Attractive lifestyle destination for families and investors',
            ),
            6 => 
            array (
              'text' => 'Growing residential and leisure destination in Abu Dhabi',
            ),
          ),
          'cta' => 'Contact a Property Investment Consultant',
          'financing_title' => 'Flexible Financing Options',
          'financing_desc' => 'Buying an off-plan property or a ready-to-move-in home? Maximise your buying power with competitive mortgage options tailored to your needs.',
          'financing_highlights' => 
          array (
            0 => 
            array (
              'text' => 'Secure a mortgage during construction to maximize leverage',
            ),
            1 => 
            array (
              'text' => 'Combine developer payment plans with tailored bank financing',
            ),
            2 => 
            array (
              'text' => 'Get pre-approved in as little as 3 days',
            ),
            3 => 
            array (
              'text' => 'Conventional and Sharia-compliant financing available',
            ),
            4 => 
            array (
              'text' => 'No hidden fees or added costs',
            ),
          ),
          'financing_cta' => 'Contact a Mortgage Specialist',
        ),
      ),
      5 => 
      array (
        'section_key' => 'overview_location',
        'section_name' => 'Overview & Location',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'heading' => 'Hudayriyat Island Overview and Location',
          'image' => '/images/hudayriyat-overview.jpg',
          'image_alt' => 'Hudayriyat Island Overview and Luxury Villas',
          'paragraphs' => 'Hudayriyat Island is a growing waterfront destination in Abu Dhabi, offering a mix of residential, leisure, and outdoor experiences. Its location makes it easy to reach Abu Dhabi city and other important areas through well-connected roads and bridges.

The island is close to popular areas such as Al Bateen and Saadiyat Island, while Abu Dhabi city centre is also within easy reach. Residents can enjoy quick access to beaches, parks, restaurants, sports facilities, and other everyday amenities.

Hudayriyat Island is also known for its wide range of outdoor attractions. Hudayriyat Beach, Marsana, cycling tracks, and sports facilities provide plenty of options for families and active lifestyles. Major attractions such as Qasr Al Watan, Emirates Palace, and Abu Dhabi Corniche are also nearby.

With its waterfront setting, recreational facilities, and convenient location, Hudayriyat Island is becoming a popular choice for people looking for a modern lifestyle in Abu Dhabi.',
          'locations' => 
          array (
            0 => 
            array (
              'name' => 'Al Bateen',
              'distance' => '5 minutes by car',
            ),
            1 => 
            array (
              'name' => 'Saadiyat Island',
              'distance' => '15 minutes by car',
            ),
            2 => 
            array (
              'name' => 'Abu Dhabi City Centre',
              'distance' => '10 minutes by car',
            ),
            3 => 
            array (
              'name' => 'Qasr Al Watan & Emirates Palace',
              'distance' => '12 minutes by car',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'heading' => 'Hudayriyat Island Payment Methods',
          'subtitle' => 'We accept all the following payment methods',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'FAQ Section',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'heading' => 'Frequently Asked Questions',
          'subtitle' => 'Find answers to common questions about Hudayriyat Island master development, communities, and real estate investments.',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'What is Hudayriyat Island?',
              'a' => 'It\'s a large-scale waterfront island development off Abu Dhabi\'s coast, run by Modon Properties, combining residential communities with sports, leisure, and entertainment destinations.',
            ),
            1 => 
            array (
              'q' => 'Where is Hudayriyat Island located?',
              'a' => 'It sits just off Al Bateen, connected to the mainland by a dedicated bridge from Sheikh Shakhbout bin Sultan Street, roughly 10–20 minutes from central Abu Dhabi landmarks.',
            ),
            2 => 
            array (
              'q' => 'Who is developing Hudayriyat Island?',
              'a' => 'Modon Properties, one of Abu Dhabi\'s major community developers, is behind the island\'s masterplan and its residential launches, including Al Naseem, Nawayef, and Bashayer.',
            ),
            3 => 
            array (
              'q' => 'Is Hudayriyat Island freehold?',
              'a' => 'Most of the residential communities on the island, including Al Naseem, Nawayef, and Wadeem, are freehold and open to buyers of all nationalities.',
            ),
            4 => 
            array (
              'q' => 'What residential projects are available on Hudayriyat Island?',
              'a' => 'Current and recent launches include Al Naseem, Nawayef (Mansions, Homes, Heights, East Hills, Village, Park Views), Bashayer, Wadeem Plots, Masyaf Plots, Sunset Cliff, Hudayriyat Quays, Hudayriyat Sahl, and Hudayriyat Hills.',
            ),
            5 => 
            array (
              'q' => 'What amenities does Hudayriyat Island offer?',
              'a' => 'The island includes beaches, a velodrome, a surf park, an urban park with a mangrove walk, over 200 kilometres of cycling tracks, adventure parks, dining outlets, and community-level clubs and courts.',
            ),
            6 => 
            array (
              'q' => 'How far is Hudayriyat Island from Abu Dhabi city centre?',
              'a' => 'Roughly 10 minutes to the Corniche and World Trade Centre, 12 minutes to Al Bateen, and 15 minutes to Yas Island.',
            ),
            7 => 
            array (
              'q' => 'Is Hudayriyat Island a good investment?',
              'a' => 'Strong demand signals (such as the rapid Bashayer sellout), government-backed infrastructure, and limited waterfront land supply make it an appealing option, though buyers should still review individual payment plans and handover timelines.',
            ),
            8 => 
            array (
              'q' => 'What villa sizes are available on Hudayriyat Island?',
              'a' => 'Sizes vary widely by community, from roughly 724 sqm villas in Al Naseem to sprawling 29,000+ sq ft mansions in Nawayef Mansions.',
            ),
            9 => 
            array (
              'q' => 'When will Hudayriyat Island projects be completed?',
              'a' => 'Handover dates vary by community. Some, like Al Naseem, are targeting late 2026, while others, such as Nawayef Village, are scheduled for early 2029.',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact Section',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'pretitle' => 'LET\'S CONNECT',
          'heading' => 'Invest in Your Future',
          'subtitle' => 'Discover exceptional residential villas, waterfront mansions, and prime plots across Hudayriyat Island. Connect with our dedicated property advisory team.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
    ),
  ),
  1 => 
  array (
    'title' => 'About Us',
    'slug' => 'about-us',
    'body' => NULL,
    'in_navbar' => true,
    'navbar_order' => 2,
    'is_published' => true,
    'meta_title' => 'About Us – Hudayriyat Island Real Estate',
    'meta_description' => 'Learn more about Hudayriyat Island property opportunities, expert advisory services, and master planning by Modon Properties in Abu Dhabi.',
    'meta_keywords' => 'About Hudayriyat, Modon Properties, Abu Dhabi property advisory',
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'badge' => 'HUDAYRIYAT ISLAND • ABU DHABI',
          'title' => 'About Us',
          'subtitle' => 'Welcome to your trusted source for exploring property opportunities on Hudayriyat Island, Abu Dhabi.',
          'bg_image_alt' => 'About Hudayriyat Island Real Estate Advisory',
          'image_alt' => 'About Hudayriyat Island Real Estate Advisory',
        ),
      ),
      1 => 
      array (
        'section_key' => 'intro',
        'section_name' => 'Introduction & Photo',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'lead' => 'We make property discovery simple by providing clear information, useful market insights, and guidance throughout the buying process.',
          'body' => 'Whether you are looking for a new home or an investment opportunity, we help you explore suitable properties on Hudayriyat Island and understand the key details before making a decision.',
          'image' => '/images/form image.jpg',
          'image_alt' => 'Hudayriyat Island Waterfront Luxury Architecture',
        ),
      ),
      2 => 
      array (
        'section_key' => 'services',
        'section_name' => 'Core Services',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'WHAT WE DO',
          'heading' => 'Our Core Services',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Property Advisory',
              'description' => 'Practical guidance to help you explore residential and investment opportunities based on your requirements.',
              'icon' => 'compass',
            ),
            1 => 
            array (
              'title' => 'Property Listings',
              'description' => 'A selection of residential properties and new developments across Hudayriyat Island and surrounding areas of Abu Dhabi.',
              'icon' => 'building',
            ),
            2 => 
            array (
              'title' => 'Market Insights',
              'description' => 'Clear information about new projects, locations, developments, and market trends to help you make informed property decisions.',
              'icon' => 'trending-up',
            ),
          ),
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<h2>About Hudayriyat Island Real Estate</h2>
<p>Welcome to your trusted source for exploring premier property opportunities on Hudayriyat Island, Abu Dhabi. We connect discerning homeowners, expatriate residents, and global investors with prestigious master-planned developments built by Modon Properties.</p>

<h3>Our Core Services</h3>
<p><strong>Property Advisory:</strong> Practical guidance to help you explore residential and investment opportunities based on your personal budget and lifestyle requirements.</p>
<p><strong>Exclusive Listings:</strong> Full access to premier residential properties, villas, townhouses, and waterfront apartments across Hudayriyat Island.</p>
<p><strong>Market Intelligence:</strong> Transparent, updated information regarding launch dates, construction milestones, payment schedules, and capital appreciation potential.</p>

<h3>Our Mission, Vision & Values</h3>
<p><strong>Our Mission:</strong> To provide accurate property intelligence, honest advisory, and reliable assistance to buyers and investors exploring Abu Dhabi\'s emerging master destinations.</p>
<p><strong>Our Vision:</strong> To become the leading advisory reference for luxury island real estate in the UAE.</p>
<p><strong>Our Values:</strong> Accuracy, transparency, and client-first commitment define everything we do.</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'pillars',
        'section_name' => 'Mission, Vision & Values',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Our Mission',
              'description' => 'To provide reliable property information, honest guidance, and helpful support to buyers and investors exploring opportunities on Hudayriyat Island and across Abu Dhabi.',
              'icon' => 'target',
            ),
            1 => 
            array (
              'title' => 'Our Vision',
              'description' => 'To become a trusted source for property buyers and investors by providing accurate information, clear guidance, and consistent support throughout their property journey.',
              'icon' => 'eye',
            ),
            2 => 
            array (
              'title' => 'Our Values',
              'description' => 'Accuracy, transparency, and responsible advice guide everything we do. We focus on providing clear property information and helping clients understand their options before making important decisions.',
              'icon' => 'shield',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'why_us',
        'section_name' => 'Why Choose Us',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'THE ADVANTAGE',
          'heading' => 'Why Choose Us?',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Local Market Knowledge',
              'description' => 'Useful information about Hudayriyat Island, Abu Dhabi communities, new developments, and property opportunities.',
              'icon' => 'map-pin',
            ),
            1 => 
            array (
              'title' => 'Client-First Approach',
              'description' => 'Clear communication and straightforward guidance without unnecessary pressure.',
              'icon' => 'heart',
            ),
            2 => 
            array (
              'title' => 'Simple Property Search',
              'description' => 'An easier way to explore available properties, compare opportunities, and understand important project details.',
              'icon' => 'search',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'cta',
        'section_name' => 'CTA & Contact Form',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'START YOUR JOURNEY',
          'heading' => 'Looking for Your Dream Property?',
          'body' => 'Explore property opportunities on Hudayriyat Island with clear information and professional guidance. Whether you are looking to buy a home or explore an investment, we are here to assist you throughout the process.',
          'benefits' => 
          array (
            0 => 
            array (
              'text' => 'Free, no-obligation property consultation',
            ),
            1 => 
            array (
              'text' => 'Official brochure & floor plan access',
            ),
            2 => 
            array (
              'text' => 'Transparent payment plan advisory',
            ),
          ),
          'form_title' => 'Get in Touch',
          'form_subtitle' => 'Enter your details and our team will contact you shortly.',
          'submit_button' => 'SUBMIT NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
        ),
      ),
    ),
  ),
  2 => 
  array (
    'title' => 'Contact Us',
    'slug' => 'contact-us',
    'body' => NULL,
    'in_navbar' => true,
    'navbar_order' => 3,
    'is_published' => true,
    'meta_title' => 'Contact Us – Hudayriyat Island Advisory',
    'meta_description' => 'Get in touch with luxury property advisors for Hudayriyat Island villas, plots, and apartments.',
    'meta_keywords' => 'Contact Hudayriyat, WhatsApp advisor, Abu Dhabi real estate inquiry',
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'badge' => 'HUDAYRIYAT ISLAND • ABU DHABI',
          'title' => 'Contact Us',
          'subtitle' => 'Invest in Your Future. Discover your ideal property on Hudayriyat Island.',
          'bg_image_alt' => 'Contact Hudayriyat Island Advisors',
          'image_alt' => 'Contact Hudayriyat Island Advisors',
        ),
      ),
      1 => 
      array (
        'section_key' => 'channels',
        'section_name' => 'Direct Contact Channels',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'title' => 'WhatsApp Us',
              'info' => 'Quick instant response',
              'action' => 'Connect on WhatsApp →',
              'url' => 'https://wa.me/971500000000',
              'icon' => 'whatsapp',
            ),
            1 => 
            array (
              'title' => 'Direct Call',
              'info' => '+971 50 000 0000',
              'action' => 'Call an Advisor →',
              'url' => 'tel:+971500000000',
              'icon' => 'phone',
            ),
            2 => 
            array (
              'title' => 'Email Inquiries',
              'info' => 'info@hudayriyat-island.ae',
              'action' => 'Send an Email →',
              'url' => 'mailto:info@hudayriyat-island.ae',
              'icon' => 'email',
            ),
            3 => 
            array (
              'title' => 'Location',
              'info' => 'Hudayriyat Island, Abu Dhabi, UAE',
              'action' => 'Prime Island Location',
              'url' => '',
              'icon' => 'location',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'section_key' => 'info',
        'section_name' => 'Emerging Properties & Form',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'PREMIER OPPORTUNITY',
          'heading' => 'Discover Emerging Properties on Hudayriyat Island',
          'lead' => 'Hudayriyat Island is emerging as a major destination in Abu Dhabi, offering a growing range of residential and investment opportunities. Explore carefully selected properties and discover the latest projects and developments across the island.',
          'body' => 'Whether you are looking for a new home or an investment opportunity, you can explore available projects, locations, property types, and key details to find an option that suits your requirements.',
          'highlight' => 'Contact us today to learn more about properties and investment opportunities on Hudayriyat Island.',
          'features' => 
          array (
            0 => 
            array (
              'title' => 'Exclusive Island Living',
              'desc' => 'Mansions, villas, townhouses, and waterfront residential plots.',
              'icon' => 'building',
            ),
            1 => 
            array (
              'title' => '100% Freehold Ownership',
              'desc' => 'Open to all nationalities with flexible developer payment plans.',
              'icon' => 'sparkles',
            ),
            2 => 
            array (
              'title' => 'Prompt Advisory',
              'desc' => 'Personalized guidance without pressure or obligation.',
              'icon' => 'clock',
            ),
          ),
          'form_title' => 'Get in Touch',
          'form_subtitle' => 'Enter your details and our team will contact you shortly to help you explore property opportunities on Hudayriyat Island.',
          'submit_button' => 'SUBMIT NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<h2>Get in Touch with Our Property Consultants</h2>
<p>Have questions regarding Hudayriyat Island residential communities, payment schedules, or site visits? Our specialized advisors are available 7 days a week to guide you.</p>

<h3>Direct Contact Channels</h3>
<p><strong>Phone & WhatsApp:</strong> +971 2 000 0000</p>
<p><strong>Inquiry Email:</strong> info@hudayriyat-island.ae</p>
<p><strong>Sales Office:</strong> Hudayriyat Island Visitors Centre, Abu Dhabi, United Arab Emirates</p>

<h3>Schedule a Private Consultation</h3>
<p>Fill out the inquiry form on this page or connect with our sales desk to receive official brochures, floor plans, and VIP priority booking.</p>',
        ),
      ),
    ),
  ),
  3 => 
  array (
    'title' => 'Wadeem Gardens',
    'slug' => 'wadeem-gardens',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 0,
    'is_published' => false,
    'meta_title' => NULL,
    'meta_description' => NULL,
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/wadeem-gardens/hero-1.png',
          'badge' => 'Freehold for All Nationalities',
          'title' => 'Wadeem Gardens at Hudayriyat Island',
          'subtitle' => 'Gated villa clusters with spacious layouts and waterfront living.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Wadeem Gardens Contemporary Arabic villa architecture on Hudayriyat Island',
          'image_alt' => 'Wadeem Gardens Contemporary Arabic villa architecture on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'launch_price',
              'label' => 'Launch Price',
              'value' => 'AED 8,700,000',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q2 2031',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Villas',
            ),
            4 => 
            array (
              'key' => 'bedrooms',
              'label' => 'Bedrooms',
              'value' => '4 to 6 Bedrooms',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '25/75',
            ),
          ),
          'developer' => 'Modon Properties',
          'launch_price' => 'AED 8,700,000',
          'handover' => 'Q2 2031',
          'property_type' => 'Villas',
          'bedrooms' => '4 to 6 Bedrooms',
          'payment_plan' => '25/75',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/wadeem-gardens/amenity-club.png',
          'title' => 'Wadeem Gardens by Modon',
          'video_url' => NULL,
          'video_poster' => '/images/wadeem-gardens/video-poster.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 class="">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Gardens Amenities',
          'subtitle' => 'Wadeem Gardens provides spaces that support everyday convenience, recreation, social connection, and family living. Residents can access essential services, leisure destinations, and community spaces within the wider development, while the waterfront setting and connected community environment support an active and convenient lifestyle.',
          'items' => 
          array (
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Gardens Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/wadeem-gardens/gallery-1.png',
              'category' => 'Exterior',
              'alt' => 'Wadeem Gardens Modernist villa exterior showcasing contemporary architecture on Hudayriyat Island',
            ),
            1 => 
            array (
              'src' => '/images/wadeem-gardens/gallery-2.png',
              'category' => 'Exterior',
              'alt' => 'Wadeem Gardens 6-bedroom villa exterior surrounded by landscaped spaces',
            ),
            2 => 
            array (
              'src' => '/images/wadeem-gardens/gallery-3.png',
              'category' => 'Exterior',
              'alt' => 'Wadeem Gardens exterior featuring Contemporary Arabic villa architecture',
            ),
            3 => 
            array (
              'src' => '/images/wadeem-gardens/gallery-4.png',
              'category' => 'Exterior',
              'alt' => 'Wadeem Gardens villa community exterior highlighting contemporary residential architecture',
            ),
            4 => 
            array (
              'src' => '/images/wadeem-gardens/hero-1.png',
              'category' => 'Exterior',
              'alt' => 'Wadeem Gardens serene coastal villa landscape view',
            ),
            5 => 
            array (
              'src' => '/images/wadeem-gardens/hero-3.png',
              'category' => 'Exterior',
              'alt' => 'Wadeem Gardens luxury residences scenic panoramic view',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Gardens Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
          'heading' => 'Hudayriyat Island Payment Methods',
        ),
      ),
      8 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
          'heading' => 'Frequently Asked Questions',
          'subtitle' => NULL,
        ),
      ),
      9 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/wadeem-gardens/master-plan.png',
          'badge' => 'Click to Enlarge',
        ),
      ),
      10 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 11,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
          'pretitle' => 'LET\'S CONNECT',
          'heading' => 'Invest in Your Future',
          'subtitle' => NULL,
        ),
      ),
      11 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 12,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Gardens Location & Attractions',
          'subtitle' => 'Wadeem Gardens is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  4 => 
  array (
    'title' => 'Hudayriyat Golf Estates',
    'slug' => 'hudayriyat-golf-estates',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 5,
    'is_published' => true,
    'meta_title' => 'Hudayriyat Golf Estates – Championship Golf Living',
    'meta_description' => 'Luxury golf villas and townhouses overlooking the 18-hole championship course.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/golf-estates/hero-1.jpg',
          'badge' => 'Freehold for All Nationalities',
          'title' => 'Hudayriyat Golf Estates',
          'subtitle' => 'Hudayriyat Golf Estates is a premium residential community on Hudayriyat Island, Abu Dhabi by Modon Properties.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Hudayriyat Golf Estates luxury mansion overlooking championship golf course',
          'image_alt' => 'Hudayriyat Golf Estates luxury mansion overlooking championship golf course',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'launch_price',
              'label' => 'Launch Price',
              'value' => 'AED 4,300,000*',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q3 2030',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Villas',
            ),
            4 => 
            array (
              'key' => 'ownership',
              'label' => 'Ownership',
              'value' => 'Freehold',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '5% / 35% / 60%',
            ),
          ),
          'developer' => 'Modon Properties',
          'launch_price' => 'AED 4,300,000*',
          'handover' => 'Q3 2030',
          'property_type' => 'Villas',
          'ownership' => 'Freehold',
          'payment_plan' => '5% / 35% / 60%',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/golf-estates/amenity-golf.png',
          'title' => 'Hudayriyat Golf Estates by Modon',
          'video_url' => NULL,
          'video_poster' => '/images/hudayriyat-golf-estates/video-poster.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hudayriyat Golf Estates Amenities',
          'subtitle' => 'Hudayriyat Golf Estates offers a range of facilities designed for comfortable family living. Residents can enjoy access to golf facilities, landscaped spaces, outdoor areas, leisure attractions, dining options, and other community amenities.',
          'items' => 
          array (
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hudayriyat Golf Estates Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/golf-estates/card-gallery-1.jpg',
              'category' => 'Exterior',
              'alt' => 'Hudayriyat Golf Estates Luxury Villa Exterior',
            ),
            1 => 
            array (
              'src' => '/images/golf-estates/card-gallery-2.jpg',
              'category' => 'Interior',
              'alt' => 'Hudayriyat Golf Estates Spacious Living Room',
            ),
            2 => 
            array (
              'src' => '/images/golf-estates/card-gallery-3.jpg',
              'category' => 'Exterior',
              'alt' => 'Hudayriyat Golf Estates Championship Golf Course View',
            ),
            3 => 
            array (
              'src' => '/images/golf-estates/card-gallery-4.jpg',
              'category' => 'Interior',
              'alt' => 'Hudayriyat Golf Estates Master Bedroom Suite',
            ),
            4 => 
            array (
              'src' => '/images/golf-estates/card-gallery-5.jpg',
              'category' => 'Exterior',
              'alt' => 'Hudayriyat Golf Estates Villa Facade & Private Pool',
            ),
            5 => 
            array (
              'src' => '/images/golf-estates/card-gallery-6.jpg',
              'category' => 'Interior',
              'alt' => 'Hudayriyat Golf Estates Designer Dining Area',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'floor_plans',
        'section_name' => 'Floor Plans',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hudayriyat Golf Estates Floor Plan',
          'subtitle' => 'Hudayriyat Golf Estates offers spacious layouts thoughtfully designed across multiple levels, featuring open-plan living, private balconies, and refined island aesthetics.',
          'download_text' => 'Download Floor Plan',
          'download_url' => '#',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Par 3 Villas',
              'image' => '/images/golf-estates/floor-par-3.jpg',
              'description' => 'Sophisticated 3-bedroom golf villa overlooking the championship greens with private terrace and garden.',
              'bedrooms' => '3',
              'bathrooms' => '4',
              'parking' => '2',
              'area' => '3450',
            ),
            1 => 
            array (
              'title' => 'Fairway Mansions – 5 Bedrooms',
              'image' => '/images/golf-estates/floor-par-3.jpg',
              'description' => 'Expansive luxury mansion with basement lounge, private pool, maid quarters, and panoramic fairway vistas.',
              'bedrooms' => '5',
              'bathrooms' => '7',
              'parking' => '4',
              'area' => '7820',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hudayriyat Golf Estates Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
          'heading' => 'Hudayriyat Island Payment Methods',
        ),
      ),
      9 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
          'heading' => 'Frequently Asked Questions',
          'subtitle' => NULL,
        ),
      ),
      10 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/hudayriyat-golf-estates/master-plan.jpg',
          'badge' => 'Click to Enlarge',
        ),
      ),
      11 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 11,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
          'pretitle' => 'LET\'S CONNECT',
          'heading' => 'Invest in Your Future',
          'subtitle' => NULL,
        ),
      ),
      12 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 12,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hudayriyat Golf Estates Location & Attractions',
          'subtitle' => 'Hudayriyat Golf Estates is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  5 => 
  array (
    'title' => 'Bashayer Residences',
    'slug' => 'bashayer-residences',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 6,
    'is_published' => true,
    'meta_title' => 'Bashayer Residences – Hudayriyat Island',
    'meta_description' => 'Modern luxury residences with coastal views in Abu Dhabi.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/bashayer-residences/hero-slider-1.jpg',
          'badge' => 'Freehold for All Nationalities',
          'title' => 'Bashayer Residences at Hudayriyat Island',
          'subtitle' => 'Waterfront residential development bringing together modern apartments and townhomes in a coastal setting.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Bashayer Residences exterior waterfront view on Hudayriyat Island',
          'image_alt' => 'Bashayer Residences exterior waterfront view on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'price_from',
              'label' => 'Price From',
              'value' => 'AED 2.5 Million',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => '30 April 2030',
            ),
            3 => 
            array (
              'key' => 'property_types',
              'label' => 'Property Types',
              'value' => 'Apartments & Townhomes',
            ),
            4 => 
            array (
              'key' => 'unit_types',
              'label' => 'Unit Types',
              'value' => '1–3 Bed AP, 2–4 Bed TH',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '50/50 (5% Down)',
            ),
          ),
          'developer' => 'Modon Properties',
          'price_from' => 'AED 2.5 Million',
          'handover' => '30 April 2030',
          'property_types' => 'Apartments & Townhomes',
          'unit_types' => '1–3 Bed AP, 2–4 Bed TH',
          'payment_plan' => '50/50 (5% Down)',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/bashayer-residences/amenity-1.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Residences Amenities',
          'subtitle' => 'Residents at Bashayer can enjoy a range of facilities created for relaxation, recreation, and everyday convenience. The community includes a waterfront promenade, private marina and piers, clubhouse, rooftop infinity pool, gym, wellness facilities, sports courts, children&#x27;s play areas, parks, cycling and jogging paths, dining, and retail spaces.',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Exclusive Beach Access',
              'description' => 'Direct access to pristine coastal waters and private promenade.',
            ),
            1 => 
            array (
              'title' => 'Wellness & Sports Hub',
              'description' => 'State-of-the-art gym, running tracks, and athletic courts.',
            ),
            2 => 
            array (
              'title' => 'Community Country Club',
              'description' => 'Private dining, lounge spaces, and family recreation facilities.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Residences Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/bashayer-residences/gallery-1.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Residences Modern Waterfront Architecture',
            ),
            1 => 
            array (
              'src' => '/images/bashayer-residences/gallery-2.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Residences Landscaped Promenade & Facade',
            ),
            2 => 
            array (
              'src' => '/images/bashayer-residences/gallery-3.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Residences Contemporary Living Space',
            ),
            3 => 
            array (
              'src' => '/images/bashayer-residences/gallery-4.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Residences Master Bedroom Suite',
            ),
            4 => 
            array (
              'src' => '/images/bashayer-residences/gallery-5.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Residences Evening Illuminated Skyline',
            ),
            5 => 
            array (
              'src' => '/images/bashayer-residences/gallery-6.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Residences Open Gourmet Kitchen',
            ),
            6 => 
            array (
              'src' => '/images/bashayer-residences/gallery-7.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Residences Private Balcony & Sea View',
            ),
            7 => 
            array (
              'src' => '/images/bashayer-residences/gallery-8.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Residences Luxury Bathroom & Finishes',
            ),
            8 => 
            array (
              'src' => '/images/bashayer-residences/gallery-9.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Residences Resort-Style Swimming Pool',
            ),
            9 => 
            array (
              'src' => '/images/bashayer-residences/gallery-10.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Residences Community Garden Walkways',
            ),
            10 => 
            array (
              'src' => '/images/bashayer-residences/gallery-11.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Residences Sunlit Lounge with Panoramic Windows',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'floor_plans',
        'section_name' => 'Floor Plans',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Residences Floor Plan',
          'subtitle' => 'Bashayer Residences offers spacious layouts thoughtfully designed across multiple levels, featuring open-plan living, private balconies, and refined island aesthetics.',
          'download_text' => 'Download Floor Plan',
          'download_url' => '#',
          'items' => 
          array (
            0 => 
            array (
              'title' => '1 Bedroom Apartment',
              'description' => 'Modern waterfront apartment featuring sunlit open-plan layout, private balcony, and sleek finishes.',
              'image' => '/images/bashayer-residences/floor-1bed.jpg',
              'bedrooms' => '1',
              'bathrooms' => '2',
              'parking' => '1',
              'area' => '1020',
            ),
            1 => 
            array (
              'title' => '2 Bedroom Apartment',
              'description' => 'Generous 2 bedroom residence with coastal views, laundry area, and designer kitchen.',
              'image' => '/images/bashayer-residences/floor-1bed.jpg',
              'bedrooms' => '2',
              'bathrooms' => '3',
              'parking' => '2',
              'area' => '1680',
            ),
            2 => 
            array (
              'title' => '3 Bedroom Penthouse',
              'description' => 'Ultra-luxury penthouse spanning top level with wraparound terrace and Abu Dhabi skyline panorama.',
              'image' => '/images/bashayer-residences/floor-1bed.jpg',
              'bedrooms' => '3',
              'bathrooms' => '4',
              'parking' => '2',
              'area' => '3120',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Residences Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      10 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/bashayer-residences/master-plan.jpg',
        ),
      ),
      11 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      12 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Residences Location & Attractions',
          'subtitle' => 'Bashayer Residences is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  6 => 
  array (
    'title' => 'Bashayer Villas',
    'slug' => 'bashayer-villas',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 7,
    'is_published' => true,
    'meta_title' => 'Bashayer Villas – Hudayriyat Island',
    'meta_description' => 'Exclusive villa collection on Hudayriyat Island.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/bashayer-villas/hero-slider-1.jpg',
          'badge' => 'Freehold for All Nationalities',
          'title' => 'Bashayer Villas',
          'subtitle' => 'Discover Elevated Waterfront Luxury Living on Hudayriyat Island.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Bashayer Villas luxury waterfront architecture on Hudayriyat Island',
          'image_alt' => 'Bashayer Villas luxury waterfront architecture on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'price_from',
              'label' => 'Price From',
              'value' => 'AED 7,200,000',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'March 2029',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Villas',
            ),
            4 => 
            array (
              'key' => 'bedrooms',
              'label' => 'Bedrooms',
              'value' => '4 & 5 Bedroom',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '50/50',
            ),
          ),
          'developer' => 'Modon Properties',
          'price_from' => 'AED 7,200,000',
          'handover' => 'March 2029',
          'property_type' => 'Villas',
          'bedrooms' => '4 & 5 Bedroom',
          'payment_plan' => '50/50',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/bashayer-villas/amenity-1.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Villas Amenities',
          'subtitle' => 'Discover a curated collection of world-class amenities at Bashayer Villas, thoughtfully designed to enrich waterfront living on Hudayriyat Island.',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Exclusive Beach Access',
              'description' => 'Direct access to pristine coastal waters and private promenade.',
            ),
            1 => 
            array (
              'title' => 'Wellness & Sports Hub',
              'description' => 'State-of-the-art gym, running tracks, and athletic courts.',
            ),
            2 => 
            array (
              'title' => 'Community Country Club',
              'description' => 'Private dining, lounge spaces, and family recreation facilities.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Villas Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/bashayer-villas/card-gallery-1.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Villas Open Living Space & Kitchen',
            ),
            1 => 
            array (
              'src' => '/images/bashayer-villas/card-gallery-2.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Villas Luxury Modern Villa Façade',
            ),
            2 => 
            array (
              'src' => '/images/bashayer-villas/card-gallery-3.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Villas Master Suite Bedroom',
            ),
            3 => 
            array (
              'src' => '/images/bashayer-villas/card-gallery-4.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Villas Private Outdoor Garden',
            ),
            4 => 
            array (
              'src' => '/images/bashayer-villas/card-gallery-5.jpg',
              'category' => 'Interior',
              'alt' => 'Bashayer Villas Elegant Dining Area',
            ),
            5 => 
            array (
              'src' => '/images/bashayer-villas/card-gallery-6.jpg',
              'category' => 'Exterior',
              'alt' => 'Bashayer Villas Architectural Evening View',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Villas Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/bashayer-villas/master-plan.jpg',
        ),
      ),
      10 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      11 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Bashayer Villas Location & Attractions',
          'subtitle' => 'Bashayer Villas is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  7 => 
  array (
    'title' => 'Al Naseem Villas',
    'slug' => 'al-naseem-villas',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 8,
    'is_published' => true,
    'meta_title' => 'Al Naseem Villas – Luxury Island Living',
    'meta_description' => 'Premium coastal villas designed for families and high-yield investors.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/al-naseem-villas/hero-slider-1.jpg',
          'badge' => 'Freehold for All Nationalities',
          'title' => 'Al Naseem Villas',
          'subtitle' => 'Spacious Luxury 4 to 6 BR Villas for Modern Living on Hudayriyat Island.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Al Naseem Villas luxury villa architecture on Hudayriyat Island',
          'image_alt' => 'Al Naseem Villas luxury villa architecture on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'launch_price',
              'label' => 'Launch Price',
              'value' => 'AED 7,800,000',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q4 2026',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Luxury Villas',
            ),
            4 => 
            array (
              'key' => 'bedrooms',
              'label' => 'Bedrooms',
              'value' => '4 to 6 Bedrooms',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '10% Down Payment',
            ),
          ),
          'developer' => 'Modon Properties',
          'launch_price' => 'AED 7,800,000',
          'handover' => 'Q4 2026',
          'property_type' => 'Luxury Villas',
          'bedrooms' => '4 to 6 Bedrooms',
          'payment_plan' => '10% Down Payment',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/al-naseem-villas/amenity-1.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Al Naseem Villas Amenities',
          'subtitle' => 'Amenities at Al Naseem Villas are thoughtfully curated to elevate everyday living. Residents enjoy access to a country club with a gym, spa, and pool, a community mosque, and a secure gated entrance. Scenic pedestrian paths and cycling routes wind through the neighborhood. Beyond the community, the vibrant Hudayriyat Island offers attractions like Surf Abu Dhabi, 321 Sports, Marsana, Hudayriyat Marina, and pristine beaches, creating a dynamic lifestyle where wellness, leisure, and nature coexist.',
          'items' => 
          array (
            0 => 
            array (
              'title' => '4 Bedroom Villa',
              'description' => 'Explore the 4-bedroom villa floor plan at Al Naseem Villas, a spacious luxury home in Abu Dhabi featuring elegant interiors and private outdoor space.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Al Naseem Villas Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-1.jpg',
              'category' => 'Exterior',
              'alt' => 'Al Naseem Villas Waterfront Façade',
            ),
            1 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-2.jpg',
              'category' => 'Interior',
              'alt' => 'Al Naseem Villas Expansive Living Area',
            ),
            2 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-3.jpg',
              'category' => 'Exterior',
              'alt' => 'Al Naseem Villas Private Pool & Garden',
            ),
            3 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-4.jpg',
              'category' => 'Interior',
              'alt' => 'Al Naseem Villas Master Bedroom Retreat',
            ),
            4 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-5.jpg',
              'category' => 'Exterior',
              'alt' => 'Al Naseem Villas Modernist Architecture',
            ),
            5 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-6.jpg',
              'category' => 'Interior',
              'alt' => 'Al Naseem Villas Dining Room Design',
            ),
            6 => 
            array (
              'src' => '/images/al-naseem-villas/card-gallery-7.jpg',
              'category' => 'Exterior',
              'alt' => 'Al Naseem Villas Aerial Community View',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'floor_plans',
        'section_name' => 'Floor Plans',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Al Naseem Villas Floor Plan',
          'subtitle' => 'Al Naseem Villas offers spacious layouts thoughtfully designed across multiple levels, featuring open-plan living, private balconies, and refined island aesthetics.',
          'download_text' => 'Download Floor Plan',
          'download_url' => '#',
          'items' => 
          array (
            0 => 
            array (
              'title' => '4 Bedroom Villa',
              'description' => 'Explore the 4-bedroom villa floor plan at Al Naseem Villas, a spacious luxury home featuring elegant interiors and private outdoor space.',
              'image' => '/images/al-naseem-villas/floor-4bed.webp',
              'bedrooms' => '4',
              'bathrooms' => '8',
              'parking' => '4',
              'area' => '8073',
            ),
            1 => 
            array (
              'title' => '5 Bedroom Villa',
              'description' => 'Expansive 5-bedroom villa with family lounges, driver room, landscaped courtyards, and grand double-height foyer.',
              'image' => '/images/al-naseem-villas/floor-5bed.webp',
              'bedrooms' => '5',
              'bathrooms' => '8',
              'parking' => '4',
              'area' => '10010',
            ),
            2 => 
            array (
              'title' => '6 Bedroom Villa',
              'description' => 'Grand hilltop 6-bedroom estate with private swimming pool, basement entertainment room, and rooftop terrace.',
              'image' => '/images/al-naseem-villas/floor-6bed.webp',
              'bedrooms' => '6',
              'bathrooms' => '9',
              'parking' => '4',
              'area' => '10010',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Al Naseem Villas Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      10 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/al-naseem-villas/master-plan.png',
        ),
      ),
      11 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      12 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Al Naseem Villas Location & Attractions',
          'subtitle' => 'Al Naseem Villas is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  8 => 
  array (
    'title' => 'Nawayef East Hills',
    'slug' => 'nawayef-east-hills',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 9,
    'is_published' => true,
    'meta_title' => 'Nawayef East Hills – Elevated Mansions',
    'meta_description' => 'Architecturally striking elevated hillside villas with skyline views.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/nawayef-east-hills/hero-slider-1.jpg',
          'badge' => 'Freehold for All Nationalities',
          'title' => 'Nawayef East Hills at Hudayriyat Island',
          'subtitle' => 'Discover an exclusive collection of 4 to 8-bedroom luxury villas and mansions for sale on Hudayriyat Island.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Nawayef East Hills luxury hilltop mansions on Hudayriyat Island',
          'image_alt' => 'Nawayef East Hills luxury hilltop mansions on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'price_from',
              'label' => 'Price From',
              'value' => 'AED 6.6 Million',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'December 2028',
            ),
            3 => 
            array (
              'key' => 'property_types',
              'label' => 'Property Types',
              'value' => 'Villas & Mansions',
            ),
            4 => 
            array (
              'key' => 'unit_types',
              'label' => 'Unit Types',
              'value' => '4 to 8 Bedrooms',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '40/60 (10% Down)',
            ),
          ),
          'developer' => 'Modon Properties',
          'price_from' => 'AED 6.6 Million',
          'handover' => 'December 2028',
          'property_types' => 'Villas & Mansions',
          'unit_types' => '4 to 8 Bedrooms',
          'payment_plan' => '40/60 (10% Down)',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/nawayef-east-hills/amenity-1.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef East Hills Amenities',
          'subtitle' => 'Residents at Nawayef East Hills can enjoy a range of facilities planned for relaxation, fitness, recreation, and everyday convenience. The community includes a swimming pool, clubhouse, gym, tennis facilities, jogging trails, children&#x27;s play areas, landscaped parkland, and a mosque.',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Exclusive Beach Access',
              'description' => 'Direct access to pristine coastal waters and private promenade.',
            ),
            1 => 
            array (
              'title' => 'Wellness & Sports Hub',
              'description' => 'State-of-the-art gym, running tracks, and athletic courts.',
            ),
            2 => 
            array (
              'title' => 'Community Country Club',
              'description' => 'Private dining, lounge spaces, and family recreation facilities.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef East Hills Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-1.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef East Hills Hilltop Villa View',
            ),
            1 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-2.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef East Hills Elevated Modern Architecture',
            ),
            2 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-3.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef East Hills Luxury Villa Façade',
            ),
            3 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-4.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef East Hills Private Villa & Terrace',
            ),
            4 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-5.jpg',
              'category' => 'Interior',
              'alt' => 'Nawayef East Hills Grand Open Living Room',
            ),
            5 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-6.jpg',
              'category' => 'Interior',
              'alt' => 'Nawayef East Hills Master Bedroom Suite',
            ),
            6 => 
            array (
              'src' => '/images/nawayef-east-hills/card-gallery-7.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef East Hills Architectural Estate',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'floor_plans',
        'section_name' => 'Floor Plans',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef East Hills Floor Plan',
          'subtitle' => 'Nawayef East Hills offers spacious layouts thoughtfully designed across multiple levels, featuring open-plan living, private balconies, and refined island aesthetics.',
          'download_text' => 'Download Floor Plan',
          'download_url' => '#',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Nawayef Mansions – 6 Bedrooms',
              'description' => 'Hillside luxury mansion built across three levels with floor-to-ceiling glass, infinity pool, and coastal panorama.',
              'image' => '/images/nawayef-east-hills/floor-6bed.png',
              'bedrooms' => '6',
              'bathrooms' => '8',
              'parking' => '4',
              'area' => '9450',
            ),
            1 => 
            array (
              'title' => 'Nawayef Hilltop Villa – 5 Bedrooms',
              'description' => 'Elevated architectural villa with private landscaped garden, home cinema, and maid quarters.',
              'image' => '/images/nawayef-east-hills/floor-6bed.png',
              'bedrooms' => '5',
              'bathrooms' => '7',
              'parking' => '3',
              'area' => '7620',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef East Hills Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      10 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/nawayef-east-hills/master-plan.png',
        ),
      ),
      11 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      12 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef East Hills Location & Attractions',
          'subtitle' => 'Nawayef East Hills is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  9 => 
  array (
    'title' => 'Masyaf Plots',
    'slug' => 'masyaf-plots',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 10,
    'is_published' => true,
    'meta_title' => 'Masyaf Plots – Freehold Residential Plots',
    'meta_description' => 'Build your custom mansion on prime waterfront plots.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/masyaf-plots/asset_2.jpg',
          'badge' => 'Freehold For All Nationalities',
          'title' => 'Masyaf by Hudayriyat Developments',
          'subtitle' => 'Modern Infrastructure and Scenic Views at Al Hidayriyyat.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Masyaf Plots by Modon on Hudayriyat Island',
          'image_alt' => 'Masyaf Plots by Modon on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Hudayriyat Development LLC',
            ),
            1 => 
            array (
              'key' => 'price_from',
              'label' => 'Price From',
              'value' => 'Launch Soon',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Launch Soon',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Plots',
            ),
            4 => 
            array (
              'key' => 'community',
              'label' => 'Community',
              'value' => 'Hudayriyat Island',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => 'Launch Soon',
            ),
          ),
          'developer' => 'Hudayriyat Development LLC',
          'price_from' => 'Launch Soon',
          'handover' => 'Launch Soon',
          'property_type' => 'Plots',
          'community' => 'Hudayriyat Island',
          'payment_plan' => 'Launch Soon',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/masyaf-plots/asset_14.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Masyaf Plots Amenities',
          'subtitle' => 'Thoughtfully curated amenities designed to elevate coastal luxury living on Hudayriyat Island.',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'A CALL BACK',
              'description' => 'Hudayriyat Island trusted property advisory serving local and international buyers. We specialize in residential and investment properties, offering clear guidance, market insight, and long term value.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Masyaf Plots Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/masyaf-plots/asset_22.jpg',
              'category' => 'Exterior',
              'alt' => 'Masyaf Plots Waterfront Panorama',
            ),
            1 => 
            array (
              'src' => '/images/masyaf-plots/asset_23.jpg',
              'category' => 'Exterior',
              'alt' => 'Masyaf Plots Coastal Plots View',
            ),
            2 => 
            array (
              'src' => '/images/masyaf-plots/asset_24.jpg',
              'category' => 'Exterior',
              'alt' => 'Masyaf Plots Landscape & Beach Access',
            ),
            3 => 
            array (
              'src' => '/images/masyaf-plots/asset_25.jpg',
              'category' => 'Exterior',
              'alt' => 'Masyaf Plots Natural Island Horizon',
            ),
            4 => 
            array (
              'src' => '/images/masyaf-plots/asset_26.jpg',
              'category' => 'Exterior',
              'alt' => 'Masyaf Plots Sunset Beach Front',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Masyaf Plots Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/masyaf-plots/master-plan.png',
        ),
      ),
      10 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      11 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Masyaf Plots Location & Attractions',
          'subtitle' => 'Masyaf Plots is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  10 => 
  array (
    'title' => 'Nawayef Village',
    'slug' => 'nawayef-village',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 11,
    'is_published' => true,
    'meta_title' => 'Nawayef Village – Mediterranean Townhouses',
    'meta_description' => 'Gated community townhouses and twin villas.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/nawayef-village/asset_4.jpg',
          'badge' => 'Freehold For All Nationalities',
          'title' => 'Nawayef Village by Modon',
          'subtitle' => 'Modern 3 to 5 Bedroom Homes in the Heart of Hudayriyat.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Nawayef Village by Modon on Hudayriyat Island',
          'image_alt' => 'Nawayef Village by Modon on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'price_from',
              'label' => 'Price From',
              'value' => 'AED 4,100,000',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q1 2029',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Townhouses & Villas',
            ),
            4 => 
            array (
              'key' => 'bedrooms',
              'label' => 'Bedrooms',
              'value' => '3 to 5 bedroom',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '50 / 50',
            ),
          ),
          'developer' => 'Modon Properties',
          'price_from' => 'AED 4,100,000',
          'handover' => 'Q1 2029',
          'property_type' => 'Townhouses & Villas',
          'bedrooms' => '3 to 5 bedroom',
          'payment_plan' => '50 / 50',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/nawayef-village/asset_16.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Village Amenities',
          'subtitle' => 'Nawayef Village is a secure gated community that blends modern comfort with natural beauty on Hudayriyat Island. Residents enjoy expansive green spaces, shaded walking trails, and direct access to pristine beaches.',
          'items' => 
          array (
            0 => 
            array (
              'title' => '4 Bedroom Townhouse',
              'description' => 'Discover a spacious 4 bedroom townhouse featuring ensuite bedrooms, a guest suite, maid’s room, study/family area, and 2 parking spaces designed for modern island living.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Village Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/nawayef-village/asset_2.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef Village Townhouse Architecture',
            ),
            1 => 
            array (
              'src' => '/images/nawayef-village/asset_3.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef Village Twin Villas Facade',
            ),
            2 => 
            array (
              'src' => '/images/nawayef-village/asset_5.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef Village Gated Green Environment',
            ),
            3 => 
            array (
              'src' => '/images/nawayef-village/asset_6.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef Village Landscaped Walking Trails',
            ),
            4 => 
            array (
              'src' => '/images/nawayef-village/asset_7.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef Village Island Living',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'floor_plans',
        'section_name' => 'Floor Plans',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Village Floor Plan',
          'subtitle' => 'Nawayef Village offers spacious layouts thoughtfully designed across multiple levels, featuring open-plan living, private balconies, and refined island aesthetics.',
          'download_text' => 'Download Floor Plan',
          'download_url' => '#',
          'items' => 
          array (
            0 => 
            array (
              'title' => '3 Bedroom Townhouse',
              'description' => 'Contemporary Mediterranean townhouse with private terrace, modern open kitchen, and community park access.',
              'image' => '/images/nawayef-village/floor-3bed.jpg',
              'bedrooms' => '3',
              'bathrooms' => '4',
              'parking' => '2',
              'area' => '3250',
            ),
            1 => 
            array (
              'title' => '4 Bedroom Twin Villa',
              'description' => 'Spacious family twin villa with private garden, maid room, and expansive rooftop lounge.',
              'image' => '/images/nawayef-village/floor-4bed.jpg',
              'bedrooms' => '4',
              'bathrooms' => '5',
              'parking' => '2',
              'area' => '4150',
            ),
            2 => 
            array (
              'title' => '5 Bedroom Townhouse',
              'description' => 'End-unit premium townhouse with larger corner plot, private swimming pool area, and elevator.',
              'image' => '/images/nawayef-village/floor-5bed.jpg',
              'bedrooms' => '5',
              'bathrooms' => '6',
              'parking' => '3',
              'area' => '4890',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Village Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      10 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/nawayef-village/master-plan.png',
        ),
      ),
      11 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      12 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Village Location & Attractions',
          'subtitle' => 'Nawayef Village is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  11 => 
  array (
    'title' => 'Wadeem Plots',
    'slug' => 'wadeem-plots',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 12,
    'is_published' => true,
    'meta_title' => 'Wadeem Plots – Prime Residential Land',
    'meta_description' => 'Waterfront plots in the prestigious Wadeem district.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/wadeem-plots/asset_2.jpg',
          'badge' => 'Freehold Ownership For All Nationalities',
          'title' => 'Wadeem Plots by Modon',
          'subtitle' => 'Premium 4 to 6 BR Villa Plots in a Wellness Centric Waterfront Destination.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Wadeem Plots by Modon on Hudayriyat Island',
          'image_alt' => 'Wadeem Plots by Modon on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'launch_price',
              'label' => 'Launch Price',
              'value' => 'AED 3,200,000',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q4 2028',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Villa Plots',
            ),
            4 => 
            array (
              'key' => 'bedrooms',
              'label' => 'Bedrooms',
              'value' => '4 to 6 Bedrooms',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '50 / 50',
            ),
          ),
          'developer' => 'Modon Properties',
          'launch_price' => 'AED 3,200,000',
          'handover' => 'Q4 2028',
          'property_type' => 'Villa Plots',
          'bedrooms' => '4 to 6 Bedrooms',
          'payment_plan' => '50 / 50',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/wadeem-plots/asset_2.jpg',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Plots Amenities',
          'subtitle' => 'Thoughtfully curated amenities designed to elevate coastal luxury living on Hudayriyat Island.',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Card',
              'description' => 'Integrated master plan featuring pristine beaches, leisure zones, and scenic trails.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Plots Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/wadeem-plots/asset_2.jpg',
              'category' => 'Exterior',
              'alt' => 'Wadeem Plots Waterfront Residential Showcase',
            ),
            1 => 
            array (
              'src' => '/images/wadeem-plots/asset_5.jpg',
              'category' => 'Exterior',
              'alt' => 'Wadeem Plots Coastal Island Setting',
            ),
            2 => 
            array (
              'src' => '/images/wadeem-plots/asset_6.jpg',
              'category' => 'Exterior',
              'alt' => 'Wadeem Plots Landscaped Surroundings',
            ),
            3 => 
            array (
              'src' => '/images/wadeem-plots/asset_7.jpg',
              'category' => 'Exterior',
              'alt' => 'Wadeem Plots Coastal Horizon View',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Plots Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/wadeem-plots/master-plan.png',
        ),
      ),
      10 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      11 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Wadeem Plots Location & Attractions',
          'subtitle' => 'Wadeem Plots is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  12 => 
  array (
    'title' => 'Nawayef Park Views',
    'slug' => 'nawayef-park-views',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 13,
    'is_published' => true,
    'meta_title' => 'Nawayef Park Views – Freehold Apartments',
    'meta_description' => 'The island’s first freehold apartment community.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'bg_image' => '/images/nawayef-park-views/asset_2.jpg',
          'badge' => 'Freehold For All Nationalities',
          'title' => 'Nawayef Park Views',
          'subtitle' => 'Parkside Serenity Meets Mediterranean Elegance on Hudayriyat Island.',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Aerial view of Nawayef Park Views on Hudayriyat Island',
          'image_alt' => 'Aerial view of Nawayef Park Views on Hudayriyat Island',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'key' => 'developer',
              'label' => 'Developer',
              'value' => 'Modon Properties',
            ),
            1 => 
            array (
              'key' => 'price_from',
              'label' => 'Price From',
              'value' => 'AED 2,000,000',
            ),
            2 => 
            array (
              'key' => 'handover',
              'label' => 'Handover Date',
              'value' => 'Q1 2028',
            ),
            3 => 
            array (
              'key' => 'property_type',
              'label' => 'Property Type',
              'value' => 'Apartments',
            ),
            4 => 
            array (
              'key' => 'bedrooms',
              'label' => 'Bedrooms',
              'value' => '1 - 4 bedroom',
            ),
            5 => 
            array (
              'key' => 'payment_plan',
              'label' => 'Payment Plan',
              'value' => '60 / 40',
            ),
          ),
          'developer' => 'Modon Properties',
          'price_from' => 'AED 2,000,000',
          'handover' => 'Q1 2028',
          'property_type' => 'Apartments',
          'bedrooms' => '1 - 4 bedroom',
          'payment_plan' => '60 / 40',
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'tag' => 'ABOUT COMMUNITY',
          'heading' => 'Coastal Luxury Living',
          'description' => 'A prestigious residential destination on Hudayriyat Island offering unparalleled coastal grandeur, active outdoor living, and bespoke modern architecture.',
          'image' => '/images/nawayef-park-views/asset_16.png',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Park Views Amenities',
          'subtitle' => 'Ideally located on Hudayriyat Island, Nawayef Park Views offers seamless access to Abu Dhabi’s top landmarks and lifestyle attractions. Just minutes from the beach, Nawayef Souq, and lush parklands, residents also enjoy close proximity to iconic destinations like Emirates Palace and Louvre Abu Dhabi.',
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Project Highlights – Nawayef Park Views',
              'description' => 'Nawayef Park Views offers a refined collection of 1 to 4 bedroom apartments, ranging from approx. 1,044 to 5,328 sq ft. These spacious residences are tailored for modern lifestyles—ideal for individuals, couples, and families alike. Open-plan layouts ensure seamless living and dining experiences, while private balconies or terraces offer uninterrupted views of Hudayriyat’s central park and the Arabian Gulf. Select 2 to 4 bedroom units include dedicated staff quarters and multifunctional rooms, perfect for a home office, guest suite, or wellness studio.',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'gallery',
        'section_name' => 'Project Gallery',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Park Views Gallery',
          'images' => 
          array (
            0 => 
            array (
              'src' => '/images/nawayef-park-views/asset_24.jpg',
              'category' => 'Exterior',
              'alt' => 'Nawayef Park Views Mediterranean-inspired architecture',
            ),
            1 => 
            array (
              'src' => '/images/nawayef-park-views/asset_25.jpg',
              'category' => 'Exterior',
              'alt' => 'Façade detail showcasing natural materials and coastal design',
            ),
            2 => 
            array (
              'src' => '/images/nawayef-park-views/asset_26.jpg',
              'category' => 'Exterior',
              'alt' => 'Community entrance to Nawayef Park Views',
            ),
            3 => 
            array (
              'src' => '/images/nawayef-park-views/asset_27.jpg',
              'category' => 'Exterior',
              'alt' => 'Sunset view over the rooftops and terraces',
            ),
            4 => 
            array (
              'src' => '/images/nawayef-park-views/asset_28.jpg',
              'category' => 'Exterior',
              'alt' => 'Walkways lined with greenery and modern lighting',
            ),
            5 => 
            array (
              'src' => '/images/nawayef-park-views/asset_29.jpg',
              'category' => 'Exterior',
              'alt' => 'Street-level perspective of Nawayef Park Views',
            ),
            6 => 
            array (
              'src' => '/images/nawayef-park-views/asset_30.jpg',
              'category' => 'Exterior',
              'alt' => 'Low-rise residential blocks with traditional-meets-modern design',
            ),
            7 => 
            array (
              'src' => '/images/nawayef-park-views/asset_31.jpg',
              'category' => 'Exterior',
              'alt' => 'Balconies and terraces offering park and canal views',
            ),
            8 => 
            array (
              'src' => '/images/nawayef-park-views/asset_32.jpg',
              'category' => 'Exterior',
              'alt' => 'Architectural harmony of light tones and textures',
            ),
            9 => 
            array (
              'src' => '/images/nawayef-park-views/asset_33.jpg',
              'category' => 'Exterior',
              'alt' => 'Evening exterior lighting and ambient atmosphere',
            ),
            10 => 
            array (
              'src' => '/images/nawayef-park-views/asset_34.jpg',
              'category' => 'Interior',
              'alt' => 'Elegant living room with natural finishes',
            ),
            11 => 
            array (
              'src' => '/images/nawayef-park-views/asset_35.jpg',
              'category' => 'Interior',
              'alt' => 'Modern open-plan kitchen with high-end appliances',
            ),
            12 => 
            array (
              'src' => '/images/nawayef-park-views/asset_36.jpg',
              'category' => 'Interior',
              'alt' => 'Spacious master bedroom with large windows',
            ),
            13 => 
            array (
              'src' => '/images/nawayef-park-views/asset_37.jpg',
              'category' => 'Interior',
              'alt' => 'Stylish dining area with coastal-themed interiors',
            ),
            14 => 
            array (
              'src' => '/images/nawayef-park-views/asset_38.jpg',
              'category' => 'Interior',
              'alt' => 'Luxury bathroom with premium fixtures',
            ),
            15 => 
            array (
              'src' => '/images/nawayef-park-views/asset_39.jpg',
              'category' => 'Interior',
              'alt' => 'Cozy bedroom with natural light and neutral tones',
            ),
            16 => 
            array (
              'src' => '/images/nawayef-park-views/asset_40.jpg',
              'category' => 'Interior',
              'alt' => 'Artisanal interior detailing and high-quality materials',
            ),
            17 => 
            array (
              'src' => '/images/nawayef-park-views/asset_41.jpg',
              'category' => 'Interior',
              'alt' => 'Contemporary interior layout with seamless flow',
            ),
            18 => 
            array (
              'src' => '/images/nawayef-park-views/asset_42.jpg',
              'category' => 'Interior',
              'alt' => 'Sunlit interior spaces designed for comfort',
            ),
            19 => 
            array (
              'src' => '/images/nawayef-park-views/asset_43.jpg',
              'category' => 'Interior',
              'alt' => 'Interior lounge with coastal-inspired color palette',
            ),
          ),
        ),
      ),
      6 => 
      array (
        'section_key' => 'floor_plans',
        'section_name' => 'Floor Plans',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Park Views Floor Plan',
          'subtitle' => 'Nawayef Park Views offers spacious layouts thoughtfully designed across multiple levels, featuring open-plan living, private balconies, and refined island aesthetics.',
          'download_text' => 'Download Floor Plan',
          'download_url' => '#',
          'items' => 
          array (
            0 => 
            array (
              'title' => '1 Bedroom Apartment – Type A',
              'description' => 'Elegant 1 bedroom apartment at Nawayef Park Views, Hudayriyat Island, featuring a spacious living/dining area, modern kitchen, private balcony, and laundry area designed for serene island living.',
              'image' => '/images/nawayef-park-views/asset_48.png',
              'bedrooms' => '1',
              'bathrooms' => '2',
              'parking' => '1',
              'area' => '1090',
            ),
            1 => 
            array (
              'title' => '2 Bedroom Apartment – Type A',
              'description' => 'Spacious 2 bedroom apartment offering open living spaces, master en-suite with walk-in wardrobe, and park vistas.',
              'image' => '/images/nawayef-park-views/asset_49.png',
              'bedrooms' => '2',
              'bathrooms' => '2',
              'parking' => '2',
              'area' => '1752',
            ),
            2 => 
            array (
              'title' => '3 Bedroom Apartment – Type A',
              'description' => 'Expansive 3 bedroom family home with staff quarters, utility room, guest powder room, and oversized outdoor terrace.',
              'image' => '/images/nawayef-park-views/asset_50.png',
              'bedrooms' => '3',
              'bathrooms' => '2',
              'parking' => '2',
              'area' => '2503',
            ),
            3 => 
            array (
              'title' => '4 Bedroom Apartment – Type A',
              'description' => 'Signature 4 bedroom residence with multifunctional study/home office, private foyer, and breathtaking views of Arabian Gulf.',
              'image' => '/images/nawayef-park-views/asset_51.png',
              'bedrooms' => '4',
              'bathrooms' => '3',
              'parking' => '3',
              'area' => '5332',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'payment_plan',
        'section_name' => 'Payment Plan',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Payment Plan',
          'description' => 'Flexible installment plan structured with milestone payments from booking through construction to handover.',
          'plan_tabs' => 
          array (
          ),
          'download_text' => 'DOWNLOAD PAYMENT PLAN',
          'download_url' => '#',
          'rows' => 
          array (
            0 => 
            array (
              'installment' => 'Down Payment',
              'percentage' => '10%',
              'milestone' => 'On Booking',
            ),
            1 => 
            array (
              'installment' => '1st Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            2 => 
            array (
              'installment' => '2nd Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            3 => 
            array (
              'installment' => '3rd Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            4 => 
            array (
              'installment' => '4th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            5 => 
            array (
              'installment' => '5th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            6 => 
            array (
              'installment' => '6th Installment',
              'percentage' => '10%',
              'milestone' => 'Construction Milestone',
            ),
            7 => 
            array (
              'installment' => '7th Installment',
              'percentage' => '5%',
              'milestone' => 'Construction Milestone',
            ),
            8 => 
            array (
              'installment' => 'Final Payment',
              'percentage' => '40%',
              'milestone' => 'On Handover',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'section_key' => 'payment_methods',
        'section_name' => 'Payment Methods',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Park Views Payment Methods',
          'subtitle' => 'We accept all the following payment methods.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Card',
              'icon' => '/images/payments/card.png',
            ),
            1 => 
            array (
              'name' => 'Cheque',
              'icon' => '/images/payments/cheque.png',
            ),
            2 => 
            array (
              'name' => 'Cash',
              'icon' => '/images/payments/cash.png',
            ),
            3 => 
            array (
              'name' => 'Bitcoin',
              'icon' => '/images/payments/bitcoin.png',
            ),
          ),
        ),
      ),
      9 => 
      array (
        'section_key' => 'faq',
        'section_name' => 'Frequently Asked Questions',
        'order' => 8,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Frequently Asked Questions',
          'items' => 
          array (
            0 => 
            array (
              'q' => 'Is this project freehold for foreign buyers?',
              'a' => 'Yes, properties on Hudayriyat Island are 100% freehold for all nationalities.',
            ),
            1 => 
            array (
              'q' => 'What is the estimated completion date?',
              'a' => 'Handover schedules vary by cluster with phased delivery starting from 2026 through 2031.',
            ),
            2 => 
            array (
              'q' => 'Are mortgage and financing options available?',
              'a' => 'Yes, leading UAE banks offer bespoke financing plans for qualified buyers.',
            ),
          ),
        ),
      ),
      10 => 
      array (
        'section_key' => 'master_plan',
        'section_name' => 'Master Plan',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Master Plan',
          'image' => '/images/nawayef-park-views/master-plan.png',
        ),
      ),
      11 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 9,
        'is_active' => true,
        'content' => 
        array (
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'terms_note' => 'By submitting, you agree to our Terms & Privacy Policy.',
          'bg_image' => '/images/form image.jpg',
        ),
      ),
      12 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 10,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Nawayef Park Views Location & Attractions',
          'subtitle' => 'Nawayef Park Views is located on Hudayriyat Island, Abu Dhabi, with restaurants, schools and healthcare facilities accessible from the island. The wider destination also offers waterfront dining, beaches, sports facilities and leisure attractions.',
          'image' => '/images/20231014_191447.webp',
          'categories' => 
          array (
            0 => 
            array (
              'name' => 'Restaurants',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Marmoura Restaurant & Lounge',
                  'time' => 'Approximately 4 mins',
                ),
                1 => 
                array (
                  'name' => 'The Plage Restaurant',
                  'time' => 'Approximately 4 mins',
                ),
                2 => 
                array (
                  'name' => 'Rain Cafe Hudayriat',
                  'time' => 'Approximately 5 mins',
                ),
                3 => 
                array (
                  'name' => 'Souvlaki Nation',
                  'time' => 'Approximately 6 mins',
                ),
                4 => 
                array (
                  'name' => 'Nalu Restaurant & Lounge',
                  'time' => 'Approximately 8 mins',
                ),
              ),
            ),
            1 => 
            array (
              'name' => 'Hospitals & Clinics',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Burjeel Medical Center',
                  'time' => 'Approximately 15 mins',
                ),
                1 => 
                array (
                  'name' => 'Cleveland Clinic Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                2 => 
                array (
                  'name' => 'NMC Royal Hospital',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
            2 => 
            array (
              'name' => 'Schools',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Cranleigh Abu Dhabi',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'The British School Al Khubairat',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'American Community School of Abu Dhabi',
                  'time' => 'Approximately 18 mins',
                ),
              ),
            ),
            3 => 
            array (
              'name' => 'Landmarks',
              'items' => 
              array (
                0 => 
                array (
                  'name' => 'Abu Dhabi International Airport',
                  'time' => 'Approximately 20 mins',
                ),
                1 => 
                array (
                  'name' => 'Downtown Abu Dhabi',
                  'time' => 'Approximately 15 mins',
                ),
                2 => 
                array (
                  'name' => 'Sheikh Zayed Grand Mosque',
                  'time' => 'Approximately 15 mins',
                ),
                3 => 
                array (
                  'name' => 'Louvre Abu Dhabi',
                  'time' => 'Approximately 22 mins',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  13 => 
  array (
    'title' => 'Privacy Policy',
    'slug' => 'privacy-policy',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 14,
    'is_published' => true,
    'meta_title' => 'Privacy Policy – Hudayriyat Island',
    'meta_description' => 'Official privacy policy for Hudayriyat Island portal.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'badge' => 'LEGAL & TRANSPARENCY',
          'title' => 'Privacy Policy',
          'subtitle' => 'Understand how we collect, use, and protect your personal information when you explore Hudayriyat Island properties.',
          'bg_image_alt' => 'Hudayriyat Island Privacy Policy and Transparency',
          'image_alt' => 'Hudayriyat Island Privacy Policy and Transparency',
        ),
      ),
      1 => 
      array (
        'section_key' => 'policy_content',
        'section_name' => 'Policy Content Blocks',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Information Collection',
              'description' => 'We collect information when you interact with our website or contact us regarding properties and real estate opportunities on Hudayriyat Island and in Abu Dhabi.

You may provide information when you submit an enquiry, request property information, or contact our advisory team via phone, email, or WhatsApp.',
            ),
            1 => 
            array (
              'title' => 'How We Use Information',
              'description' => 'We use the information we collect to understand your requirements, provide relevant property details, contact you regarding updates, and facilitate viewings and advisory services.',
            ),
            2 => 
            array (
              'title' => 'Information Sharing & Disclosure',
              'description' => 'We respect your privacy and take reasonable steps to protect your personal information. We do not sell, rent, or trade your personal information to third parties for marketing purposes.',
            ),
            3 => 
            array (
              'title' => 'Data Security & Integrity',
              'description' => 'We use reasonable technical and organizational measures to help protect your personal information from unauthorized access, use, alteration, or disclosure.',
            ),
            4 => 
            array (
              'title' => 'Your Rights & Choices',
              'description' => 'You have the right to request access, correction, or deletion of your personal data held by us, or withdraw consent to receive marketing updates at any time.',
            ),
            5 => 
            array (
              'title' => 'Updates to This Policy',
              'description' => 'We may update this Privacy Policy from time to time to reflect changes in legal, regulatory, or operational requirements. Any revisions will be published on this page.',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<h2>Privacy Policy</h2>
<p>This Privacy Policy outlines how Hudayriyat Island Real Estate collects, uses, protects, and discloses personal information obtained from visitors through our website and digital services.</p>
<h3>Information We Collect</h3>
<p>We may collect personal details such as your full name, email address, phone number, and property preferences when you submit an inquiry form or request a callback.</p>
<h3>How We Use Your Information</h3>
<p>Your details are used strictly to respond to inquiries, provide project brochures and updates, process booking appointments, and enhance website browsing experiences.</p>
<h3>Data Security & Protection</h3>
<p>We employ modern encryption protocols, SSL security certificates, and strict access controls to safeguard your personal data from unauthorized access or disclosure.</p>',
        ),
      ),
    ),
  ),
  14 => 
  array (
    'title' => 'Terms & Conditions',
    'slug' => 'terms-and-conditions',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 15,
    'is_published' => true,
    'meta_title' => 'Terms & Conditions – Hudayriyat Island',
    'meta_description' => 'Official terms and conditions for Hudayriyat Island web portal.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'badge' => 'LEGAL & COMPLIANCE',
          'title' => 'Terms & Conditions',
          'subtitle' => 'Please read our Terms & Conditions carefully to understand the rules, responsibilities, and guidelines for using our website.',
          'bg_image' => '/images/hero/slide-1.jpg',
          'bg_image_alt' => 'Hudayriyat Island Terms and Conditions',
          'image_alt' => 'Hudayriyat Island Terms and Conditions',
        ),
      ),
      1 => 
      array (
        'section_key' => 'terms_content',
        'section_name' => 'Terms Content Blocks',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'title' => 'Agreement to Terms',
              'description' => 'By accessing or using this website, you agree to these Terms & Conditions. If you do not agree with any part of these terms, please stop using the website.',
            ),
            1 => 
            array (
              'title' => 'Website Use',
              'description' => 'This website provides general property information and real estate-related services, including information about properties and projects on Hudayriyat Island and across Abu Dhabi. You must use this website lawfully and responsibly.',
            ),
            2 => 
            array (
              'title' => 'Property Information',
              'description' => 'Property listings, prices, layouts, specifications, payment plans, availability, and handover dates are provided for general reference only. Property information may change without notice and does not constitute a binding offer or contract.',
            ),
            3 => 
            array (
              'title' => 'No Professional Advice',
              'description' => 'The information provided on this website does not constitute legal, financial, tax, investment, or immigration advice. You should conduct your own research and consult qualified professionals.',
            ),
            4 => 
            array (
              'title' => 'No Guarantee of Returns',
              'description' => 'No guarantee is provided regarding future property values, rental income, capital appreciation, or investment returns. Past performance of a property or developer does not guarantee future results.',
            ),
            5 => 
            array (
              'title' => 'User Responsibilities',
              'description' => 'You are responsible for providing accurate and complete information when submitting enquiries through this website. Unauthorized use or misrepresentation is strictly prohibited.',
            ),
            6 => 
            array (
              'title' => 'Intellectual Property',
              'description' => 'All text, logos, graphics, images, and content on this website are owned by their respective owners and protected by copyright and intellectual property laws.',
            ),
            7 => 
            array (
              'title' => 'Third-Party Links',
              'description' => 'This website may contain links to third-party websites. These links are provided for convenience only and we do not endorse or take responsibility for third-party content.',
            ),
            8 => 
            array (
              'title' => 'Limitation of Liability',
              'description' => 'We take reasonable steps to provide accurate information, but make no warranties regarding completeness or timeliness. Users should independently verify details before making a decision.',
            ),
            9 => 
            array (
              'title' => 'Governing Law',
              'description' => 'These Terms & Conditions shall be governed by the applicable laws and regulations of the United Arab Emirates and the Emirate of Abu Dhabi.',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<h2>Terms and Conditions</h2>
<p>Welcome to our website. By accessing and using this website, you agree to comply with and be bound by the following terms and conditions of use.</p>
<h3>Use of Website</h3>
<p>The content of this website is for general information and marketing purposes only. It is subject to change without prior notice.</p>
<h3>Intellectual Property</h3>
<p>All trademarks, logos, visual renderings, layouts, and editorial text reproduced on this website are the property of their respective owners and developers.</p>
<h3>Liability Disclaimer</h3>
<p>While we strive for complete accuracy, project details, floor plans, pricing, and handovers are subject to official developer updates and contractual agreements.</p>',
        ),
      ),
    ),
  ),
  15 => 
  array (
    'title' => 'Disclaimer',
    'slug' => 'disclaimer',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 16,
    'is_published' => true,
    'meta_title' => 'Disclaimer – Hudayriyat Island',
    'meta_description' => 'Legal disclaimer for property information and floor plans.',
    'meta_keywords' => NULL,
    'og_image' => NULL,
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'badge' => 'LEGAL & DISCLOSURE',
          'title' => 'Disclaimer',
          'subtitle' => 'Please read our disclaimer carefully to understand the terms, limitations, and accuracy of property information and details shared on our website.',
          'bg_image_alt' => 'Hudayriyat Island Legal Disclaimer',
          'image_alt' => 'Hudayriyat Island Legal Disclaimer',
        ),
      ),
      1 => 
      array (
        'section_key' => 'disclaimer_content',
        'section_name' => 'Disclaimer Content Blocks',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'title' => 'General Information Only',
              'description' => 'The content on this website, including property descriptions, pricing, payment plans, and market commentary, is provided for general informational purposes only and does not constitute an investment recommendation.',
            ),
            1 => 
            array (
              'title' => 'No Guarantee of Returns, Yield or Appreciation',
              'description' => 'Any rental yield or capital appreciation figure referenced on this Site is an indicative estimate based on market observations and does not constitute a guarantee of future returns.',
            ),
            2 => 
            array (
              'title' => 'Not Financial, Legal, Tax or Immigration Advice',
              'description' => 'Nothing on this website constitutes financial, legal, tax, or immigration advice, including advice relating to UAE residency or Golden Visa eligibility. Independent advice should be sought.',
            ),
            3 => 
            array (
              'title' => 'Developer & Property Information',
              'description' => 'Prices, availability, floor plans, and specifications are derived from developer materials and subject to change without notice. Confirm latest details with authorized specialists.',
            ),
            4 => 
            array (
              'title' => 'Regulatory Status',
              'description' => 'This website is not a government portal and is not affiliated with any UAE government authority. Nothing on this site should be interpreted as official government communication.',
            ),
            5 => 
            array (
              'title' => 'Testimonials',
              'description' => 'Client testimonials reflect individual experiences at the time they were provided and do not guarantee similar results for others.',
            ),
            6 => 
            array (
              'title' => 'Third-Party Links',
              'description' => 'Links to third-party websites are provided for convenience only. We do not endorse and are not responsible for external content or practices.',
            ),
            7 => 
            array (
              'title' => 'Accuracy of Information',
              'description' => 'While reasonable care is taken to maintain accurate information, we make no warranty regarding completeness and accept no liability for any error or omission.',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<h2>Legal Disclaimer</h2>
<p>The information provided on this website is for general informational and marketing purposes only. All images, architectural renderings, floor plans, and dimensions are artistic impressions and subject to variation.</p>
<p>Property pricing, payment plans, and handover timelines are determined by the master developer (Modon Properties) and may change without prior notice.</p>
<p>Prospective purchasers should review official sales and purchase agreements (SPA) and consult authorized representatives before concluding any transactions.</p>',
        ),
      ),
    ),
  ),
  16 => 
  array (
    'title' => 'Hussain',
    'slug' => 'hussain',
    'body' => NULL,
    'in_navbar' => false,
    'navbar_order' => 17,
    'is_published' => true,
    'meta_title' => 'Hussain | Hudayriyat Island Abu Dhabi',
    'meta_description' => 'Explore Hussain on Hudayriyat Island, Abu Dhabi. Discover freehold residences, pricing, master plan, and world-class amenities.',
    'meta_keywords' => 'Hussain, Hudayriyat Island, Abu Dhabi villas, Modon Properties',
    'og_image' => '/images/hero/slide-1.jpg',
    'sections' => 
    array (
      0 => 
      array (
        'section_key' => 'hero',
        'section_name' => 'Hero Banner & Form',
        'order' => 1,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hussain',
          'subtitle' => 'Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination on Hudayriyat Island',
          'badge' => 'Freehold for All Nationalities',
          'bg_image' => '/images/hero/slide-1.jpg',
          'form_small' => 'REQUEST',
          'form_large' => 'A CALL BACK',
          'submit_button' => 'REQUEST NOW',
          'bg_image_alt' => 'Hussain Hero Image',
          'image_alt' => 'Hussain Hero Image',
        ),
      ),
      1 => 
      array (
        'section_key' => 'highlights',
        'section_name' => 'Project Highlights',
        'order' => 2,
        'is_active' => true,
        'content' => 
        array (
          'developer' => 'Modon Properties',
          'launch_price' => 'AED 2,500,000',
          'handover' => 'Q4 2028',
          'property_type' => 'Luxury Villas & Apartments',
          'bedrooms' => '2 to 5 Bedrooms',
          'payment_plan' => '50 / 50',
          'items' => 
          array (
            0 => 
            array (
              'label' => 'Developer',
              'value' => 'Modon Properties',
              'icon' => 'building',
            ),
            1 => 
            array (
              'label' => 'Price From',
              'value' => 'AED 2,500,000',
              'icon' => 'tag',
            ),
            2 => 
            array (
              'label' => 'Handover Date',
              'value' => 'Q4 2028',
              'icon' => 'calendar',
            ),
            3 => 
            array (
              'label' => 'Property Type',
              'value' => 'Luxury Villas & Apartments',
              'icon' => 'home',
            ),
            4 => 
            array (
              'label' => 'Bedrooms',
              'value' => '2 to 5 Bedrooms',
              'icon' => 'bed',
            ),
            5 => 
            array (
              'label' => 'Payment Plan',
              'value' => '50 / 50',
              'icon' => 'credit-card',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'section_key' => 'about',
        'section_name' => 'About Community',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hussain, Hudayriyat Island',
          'description' => '<p><strong>Hussain</strong> is a premier residential development by Modon Properties on Abu Dhabi’s prestigious Hudayriyat Island. Surrounded by pristine coastlines and lush parklands, this community offers a refined island lifestyle that effortlessly blends contemporary sophistication with seaside serenity.</p><p>Featuring open layouts, expansive terraces, and curated modern architecture, each residence is designed to maximize natural light and panoramic views of the Arabian Gulf and Abu Dhabi skyline.</p>',
          'video_poster' => '/images/nawayef-park-views/asset_14.jpg',
          'video_src' => '/images/nawayef-park-views/asset_15.mp4',
        ),
      ),
      3 => 
      array (
        'section_key' => 'content',
        'section_name' => 'Content',
        'order' => 3,
        'is_active' => true,
        'content' => 
        array (
          'html' => '<p class="saimaIntroP">
    Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
</p>
<p class="saimaIntroP">
    Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
</p>
<p class="saimaIntroP">
    The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>
    Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
</p>
<p>
    The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
</p>

<h2 id="saima-mangrove-residences-noc">Saima Mangrove Residences NOC</h2>
<p>
    Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
</p>
<p>
    Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
</p>
<p>
    Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
</p>

<h2 id="saima-mangrove-residences-location">Saima Mangrove Residences Location</h2>
<p>
    The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
</p>
<p>
    DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
</p>
<p>
    It is surrounded by natural mangrove belts, enhancing overall living conditions. As a result, people can enjoy cleaner air and a picturesque waterfront view all year long.
</p>

<h2 id="saima-mangrove-residences-location-map">Saima Mangrove Residences Location Map</h2>
<p>
    <img src="/TOC1.png" alt="Saima Mangrove Residences Location Connectivity Map" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Saima Mangrove Residences Location Map shows the great connectivity of the city of Karachi. The development is linked to various business areas, educational institutions, and healthcare facilities by major roads.
</p>
<p>
    The northwestern route connects residents and the commercial corridors of Korangi via Shaheed-e-Millat Road. The south-eastern road, meanwhile, is an easy way to reach DHA Phase VIII and coastal holiday hot spots.
</p>
<p>
    Its strategic location enhances the project’s appeal for its residential appeal. Moreover, it facilitates long-term value growth by enhancing infrastructure development.
</p>

<h2 id="saima-mangrove-residences-floor-plan">Saima Mangrove Residences Floor Plan</h2>
<p>
    The Saima Mangrove Residences Floor Plan focuses on comfort, functionality, and waterfront living. All layouts make the best use of natural light, fresh air, and the living areas. There are also lots of big terraces and balconies, as well as well-planned interior spaces.
</p>

<h3 id="3-room-apartments-type-c">3-Room Apartments – Type C</h3>
<p>
    <img src="/TOC2.png" alt="3-Room Apartments – Type C Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 3-room apartment includes 2 bedrooms, 2 bathrooms, a kitchen, lounge, lobby, 2 wardrobes, and a terrace. It also includes a 6′-6″ × 4′ S.BAL.
</p>

<h3 id="4-room-apartments-type-b">4-Room Apartments – Type B</h3>
<p>
    <img src="/TOC3.png" alt="4-Room Apartments – Type B Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The 4-room apartment includes 3 bedrooms, 3 bathrooms, a kitchen, lounge, entrance lobby, wardrobes, and a terrace. The lounge measures 11′-6″ × 21′ and the kitchen measures 7′ × 11′.
</p>

<h3 id="5-room-apartment-type-a">5-Room Apartment – Type A</h3>
<p>
    <img src="/TOC4.png" alt="5-Room Apartment – Type A Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A includes 4 bedrooms, 4 bathrooms, 4 W/R, kitchen, lounge, entrance lobby, S-BAL, and terrace. The layout provides spacious bedrooms, a well-planned kitchen, a large lounge, and separate outdoor spaces through the S-BAL and terrace.
</p>

<h3 id="5-room-apartments-type-a-1">5-Room Apartments – Type A-1</h3>
<p>
    <img src="/TOC5.png" alt="5-Room Apartments – Type A-1 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 26′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-2">5-Room Apartments – Type A-2</h3>
<p>
    <img src="/TOC6.png" alt="5-Room Apartments – Type A-2 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and terrace.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h3 id="5-room-apartments-type-a-3">5-Room Apartments – Type A-3</h3>
<p>
    <img src="/TOC7.png" alt="5-Room Apartments – Type A-3 Floor Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-3 includes 3 bedrooms, 3 bathrooms, a drawing room, proom, kitchen, lounge, entrance lobby, wardrobes, S.BAL, and two terraces.<br>
    The drawing room measures 11′ × 13′, while the lounge measures 11′-6″ × 25′. The kitchen measures 11′ × 8′.
</p>

<h2 id="saima-mangrove-residences-master-plan">Saima Mangrove Residences Master Plan</h2>
<p>
    The Saima Mangrove Residences Master Plan establishes a safe, orderly, and family-friendly community. The community was carefully divided into residential, recreational, and service areas. This planning method will provide privacy and good access to essential facilities.
</p>
<p>
    The development features a secure gated entry system with high-level security and regulated entry points. The lower levels of the project provide for dedicated parking areas to minimize traffic flow within residential areas. Residents also have daily conveniences such as selected commercial outlets.
</p>
<p>
    The central podium serves as the social and recreational centre of the community. It provides residents with access to leisure facilities, landscaped areas, and family amenities. Therefore, the master plan encourages convenience, comfort, and a balanced life for all age groups.
</p>

<h2 id="saima-mangrove-residences-payment-plan">Saima Mangrove Residences Payment Plan</h2>
<p>
    The Saima Mangrove Residences Payment Plan is flexible and interest-free, with various categories of apartments available. Purchasers can book their units at a reasonable booking amount and have flexible installment plans. The developer links payments to construction phases, monthly payments, quarterly payments, and possession phases. As a result, buyers will not have to suffer from significant pressure regarding financial management.
</p>

<h3 id="type-a-5-room-apartment">Type A – 5-room Apartment</h3>
<p>
    <img src="/TOC8.png" alt="Type A – 5-room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The overall price of Type A apartments is PKR 22,000,000. The buyers pay PKR 850,000 per booking, allocation, confirmation, and start of work. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly installments of PKR 150,000. Additionally, the buyers are required to pay the construction milestone charges during the construction period. The total loan amount for this category is PKR 7,400,000.
</p>

<h3 id="type-a-1-5-room-apartment">Type A-1 – 5 Room Apartment</h3>
<p>
    <img src="/TOC9.png" alt="Type A-1 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-1 apartments have a total value of PKR 20,000,000. The buyers pay PKR 800,000 on booking, allocation, confirmation, and start of work. Payment terms are 16 quarterly installments of PKR 150,000 and 48 months of PKR 125,000. Payments are made at key stages of construction, through additional milestone payments. The anticipated loan amount is PKR 6,700,000.
</p>

<h3 id="type-a-2-5-room-apartment">Type A-2 – 5 Room Apartment</h3>
<p>
    <img src="/TOC10.png" alt="Type A-2 – 5 Room Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    Type A-2 apartments cost PKR 19,600,000. The buyers pay PKR 750,000 at booking, allocation, confirmation, and the start of work. The developer collects 48 monthly installments of PKR 125,000 and 16 quarterly installments of PKR 150,000. Construction-related payments are required during the development of the project. The expected loan is PKR 6,500,000.
</p>

<h3 id="type-a-3-5-rooms-apartment">Type A-3 – 5 Rooms Apartment</h3>
<p>
    <img src="/TOC11.png" alt="Type A-3 – 5 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The price of Type A-3 apartments is PKR 21,150,000. During booking, allocation, confirmation, and the start of work, the buyers contribute PKR 850,000. The plan consists of 48 monthly payments of PKR 150,000 and 16 quarterly payments of PKR 150,000. Buyers also make milestone payments while construction is ongoing. The expected loan amount is PKR 7,050,000.
</p>

<h3 id="type-b-4-rooms-apartment">Type B – 4 Rooms Apartment</h3>
<p>
    <img src="/TOC12.png" alt="Type B – 4 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total cost of Type B apartments is PKR 14,750,000. Buyers pay PKR 500,000 at each stage. There are 48 instalments of PKR 100,000 and 16 quarterly instalments of PKR 125,000. Construction milestone charges are still in effect throughout the project. The anticipated loan value in this category is PKR 4,950,000.
</p>

<h3 id="type-c-3-rooms-apartment">Type C – 3 Rooms Apartment</h3>
<p>
    <img src="/TOC13.png" alt="Type C – 3 Rooms Apartment Payment Plan" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08);">
</p>
<p>
    The total price of type C apartments is PKR 11,000,000. Buyers pay PKR 400,000, which is paid by the buyer at the time of booking, allocation, confirmation, and at the start of work. There are 48 monthly installments of PKR 75,000 and 16 quarterly installments of PKR 75,000. Buyers also make payments during the construction process, as part of milestone payments. The anticipated loan amount is PKR 3,900,000.
</p>

<h2 id="saima-mangrove-residences-installation-plan">Saima Mangrove Residences Installation Plan</h2>
<p>
    The Saima Mangrove Residences Installation Plan caters to a flexible interest-free installation plan for those who are buying the estate. The developer spreads payments over a term of 36 to 48 months.
</p>
<p>
    Payments are affordable every month during construction. Moreover, quarterly payments facilitate major development milestones. Small milestone payments directly correlate with structural progress.
</p>
<p>
    This is a good way of managing the cash flow of investors. Thus, purchasers can enjoy financial versatility and a good asset at the same time.
</p>

<h2 id="apartments-for-sale-in-saima-mangrove-residences">Apartments for Sale in Saima Mangrove Residences</h2>
<p>
    Apartments for sale in Saima Mangrove Residences offer homes that meet various lifestyle needs and investment objectives.
</p>
<p>
    Professionals and families looking for modern waterfront living will choose 2 or 3-bedroom apartments. Meanwhile, the four-bedroom homes feature top-of-the-line finishes and more spacious layouts.
</p>
<p>
    Luxury penthouses overlooking the creek are also a part of this project. This means that buyers have several choices of homes to pick from according to their choices and financial capacity.
</p>

<h2 id="facilities-and-amenities">Facilities and Amenities</h2>
<p>
    The gated community offers residents a variety of lifestyle amenities. The development features a swimming pool, modern gymnasium, spa, and wellness areas.
</p>
<p>
    In addition, the city has a backup power system and a sophisticated RO water filtration plant. Security personnel keep an eye on the project at all times via CCTV and controlled access points.
</p>
<p>
    There are also landscaped areas, a children’s play area, and a Jamia mosque. Thus, the dwellers are comfortable and secure in a single spot. For any further information, please get in touch with the <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing team.</a>
</p>',
        ),
      ),
      4 => 
      array (
        'section_key' => 'amenities',
        'section_name' => 'Amenities & Facilities',
        'order' => 4,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Hussain Amenities',
          'subtitle' => 'Hussain offers a complete coastal lifestyle with luxury amenities for wellness, recreation, and community living.',
          'items' => 
          array (
            0 => 
            array (
              'name' => 'Gymnasium',
              'icon' => '/images/nawayef-park-views/asset_16.png',
            ),
            1 => 
            array (
              'name' => 'Yoga Zone',
              'icon' => '/images/nawayef-park-views/asset_17.png',
            ),
            2 => 
            array (
              'name' => 'Co-working Area',
              'icon' => '/images/nawayef-park-views/asset_18.png',
            ),
            3 => 
            array (
              'name' => 'Game Room',
              'icon' => '/images/nawayef-park-views/asset_19.png',
            ),
            4 => 
            array (
              'name' => 'Private Beach',
              'icon' => '/images/nawayef-park-views/asset_20.png',
            ),
            5 => 
            array (
              'name' => 'Concierge & Valet',
              'icon' => '/images/nawayef-park-views/asset_21.png',
            ),
            6 => 
            array (
              'name' => 'Swimming Pool',
              'icon' => '/images/nawayef-park-views/asset_22.png',
            ),
            7 => 
            array (
              'name' => 'Club House',
              'icon' => '/images/nawayef-park-views/asset_23.png',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'section_key' => 'contact',
        'section_name' => 'Contact & Booking CTA',
        'order' => 5,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Register Your Interest in Hussain',
          'subtitle' => 'Our property specialists will contact you with VIP floor plans, pricing sheets, and private site visit bookings.',
          'button_text' => 'REGISTER INTEREST',
          'phone' => '+971 2 000 0000',
          'email' => 'info@hudayriyat-island.com',
        ),
      ),
      6 => 
      array (
        'section_key' => 'location',
        'section_name' => 'Location & Connectivity',
        'order' => 6,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Seamless Access, Prime Location',
          'description' => '<p>Conveniently located on Hudayriyat Island with direct access via modern bridges to Abu Dhabi’s key commercial, cultural, and travel hubs.</p>',
          'items' => 
          array (
            0 => 
            array (
              'place' => 'Downtown Abu Dhabi',
              'time' => '20 mins',
            ),
            1 => 
            array (
              'place' => 'Emirates Palace',
              'time' => '23 mins',
            ),
            2 => 
            array (
              'place' => 'Sheikh Zayed Grand Mosque',
              'time' => '23 mins',
            ),
            3 => 
            array (
              'place' => 'Abu Dhabi Global Financial Centre',
              'time' => '30 mins',
            ),
            4 => 
            array (
              'place' => 'Louvre Abu Dhabi',
              'time' => '33 mins',
            ),
            5 => 
            array (
              'place' => 'Zayed International Airport',
              'time' => '34 mins',
            ),
          ),
        ),
      ),
      7 => 
      array (
        'section_key' => 'toc',
        'section_name' => 'Table of Contents (TOC)',
        'order' => 7,
        'is_active' => true,
        'content' => 
        array (
          'title' => 'Editorial Overview & Table of Contents',
          'description' => '<p>Explore comprehensive community insights, construction milestones, regulatory approvals, and architectural details.</p>',
        ),
      ),
    ),
  ),
);

        foreach ($pages as $pData) {
            $sections = $pData['sections'] ?? [];
            unset($pData['sections']);

            $page = Page::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );

            foreach ($sections as $secData) {
                // Payment Methods section has been removed site-wide
                if (($secData['section_key'] ?? null) === 'payment_methods') {
                    continue;
                }
                PageSection::updateOrCreate(
                    [
                        'page_id' => $page->id,
                        'section_key' => $secData['section_key'],
                    ],
                    $secData
                );
            }
        }
    }
}