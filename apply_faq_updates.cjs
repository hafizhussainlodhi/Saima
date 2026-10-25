const fs = require('fs');
const path = require('path');

const commDir = path.join(__dirname, 'resources', 'views', 'communities');

// 1. Data mapping for each community
const faqsData = {
  "al-naseem-villas.blade.php": {
    slug: 'al-naseem-villas',
    title: 'Frequently Asked Questions',
    subtitle: 'Everything you need to know about purchasing a luxury villa at Al Naseem, Hudayriyat Island',
    type: 'naseem',
    items: [
      {
        q: "Can anyone buy a villa at Al Naseem community?",
        a: "Yes. Al Naseem community offers freehold ownership, available to all nationalities, making it fully accessible to UAE residents and international foreign investors."
      },
      {
        q: "What bedroom options are available?",
        a: "Al Naseem community features spacious 4, 5, and 6-bedroom luxury villas, each offered in two architectural elevations: South Californian and Modern."
      },
      {
        q: "What is the villa area range?",
        a: "Villa sizes at Al Naseem community range from approximately 5,274 sq ft to 6,673 sq ft, with plot sizes spanning from 7,373 sq ft to 10,764 sq ft."
      },
      {
        q: "Where is Al Naseem community located?",
        a: "Al Naseem community is centrally positioned within Hudayriyat Island, Abu Dhabi, offering direct access to cycling tracks, sports hubs, beach clubs, and the upcoming Surf Abu Dhabi."
      },
      {
        q: "Is Al Naseem community a completed project?",
        a: "No, Al Naseem community is an off-plan development with handover scheduled for Q1 2029, offering attractive construction-linked payment plans."
      },
      {
        q: "Can foreigners own property in Abu Dhabi?",
        a: "Yes, Abu Dhabi permits 100% freehold property ownership for all nationalities in designated investment zones, which includes the entirety of Hudayriyat Island."
      }
    ]
  },
  "bashayer-residences.blade.php": {
    slug: 'bashayer-residences',
    title: 'Frequently Asked Questions',
    subtitle: '',
    type: 'bashayer',
    items: [
      {
        q: "What is Bashayer Residences?",
        a: "Bashayer Residences is a residential community by Modon Properties on Hudayriyat Island, Abu Dhabi, offering apartments and townhouses."
      },
      {
        q: "Who is the developer of Bashayer Residences?",
        a: "Bashayer Residences is developed by Modon Properties."
      },
      {
        q: "What types of properties are available at Bashayer Residences?",
        a: "Bashayer Residences offers 1, 2, and 3-bedroom apartments, along with 3-bedroom duplexes and townhouses."
      },
      {
        q: "What is the starting price of Bashayer Residences?",
        a: "The starting price for Bashayer Residences is approximately AED 1.25 million, depending on unit type and layout."
      },
      {
        q: "What is the payment plan for Bashayer Residences?",
        a: "Bashayer Residences offers a flexible 40/60 payment plan, with 10% on booking, 30% during construction, and 60% on handover."
      },
      {
        q: "When is the handover of Bashayer Residences?",
        a: "Handover is scheduled for Q4 2028."
      },
      {
        q: "Where is Bashayer Residences located?",
        a: "Bashayer Residences is located on Hudayriyat Island, Abu Dhabi, within easy reach of beaches, sports facilities, and entertainment attractions."
      },
      {
        q: "Is Bashayer Residences freehold?",
        a: "Yes, Bashayer Residences is a freehold development open to buyers of all nationalities."
      },
      {
        q: "What amenities are available at Bashayer Residences?",
        a: "Amenities include a swimming pool, gymnasium, children's play areas, landscaped gardens, and access to Hudayriyat Island's sports and leisure attractions."
      }
    ]
  },
  "bashayer-villas.blade.php": {
    slug: 'bashayer-villas',
    title: 'Frequently Asked Questions',
    subtitle: '',
    type: 'villas',
    items: [
      {
        q: "Is Bashayer Villas a freehold development in Abu Dhabi?",
        a: "Yes, Bashayer Villas on Hudayriyat Island is a 100% freehold development open to buyers and investors of all nationalities."
      },
      {
        q: "What types of villas are available at Bashayer Villas?",
        a: "Bashayer Villas offers luxury 3, 4, and 5-bedroom villas with contemporary architectural designs, private gardens, and spacious layouts."
      },
      {
        q: "What is the starting price of Bashayer Villas in Abu Dhabi?",
        a: "Starting prices for Bashayer Villas begin from approximately AED 4.5 million, subject to unit selection, size, and location."
      },
      {
        q: "What is the handover date for Bashayer Villas?",
        a: "The handover for Bashayer Villas is scheduled for Q4 2028."
      },
      {
        q: "What amenities are available at Bashayer Villas?",
        a: "Residents enjoy access to a community clubhouse, infinity pool, fitness center, landscaped parklands, jogging trails, and retail centers."
      },
      {
        q: "How is the location and connectivity of Bashayer Villas?",
        a: "Positioned on Hudayriyat Island, Bashayer Villas offers rapid access to Downtown Abu Dhabi (10 mins), Zayed International Airport (25 mins), and Yas Island (30 mins)."
      },
      {
        q: "Is Bashayer Villas suitable for families in Abu Dhabi?",
        a: "Yes, the community is designed specifically for family living with pedestrian-friendly green corridors, premier schools nearby, and top-tier sports facilities."
      },
      {
        q: "What payment plan is offered for Bashayer Villas?",
        a: "A flexible construction-linked payment plan is available, featuring 10% on booking, installments during construction, and the balance upon completion."
      }
    ]
  },
  "hudayriyat-golf-estates.blade.php": {
    slug: 'hudayriyat-golf-estates',
    title: 'Frequently Asked Questions',
    subtitle: 'Find answers to common questions about purchasing a villa in Hudayriyat Golf Estates.',
    type: 'golf',
    items: [
      {
        q: "What is Hudayriyat Golf Estates?",
        a: "Hudayriyat Golf Estates is a villa community by Modon Properties on Hudayriyat Island, Abu Dhabi. The project offers a golf-focused residential lifestyle with modern villas and landscaped surroundings."
      },
      {
        q: "Who is the developer of Hudayriyat Golf Estates?",
        a: "Hudayriyat Golf Estates is developed by Modon Properties."
      },
      {
        q: "What is the starting price of Hudayriyat Golf Estates?",
        a: "The launch price starts from approximately AED 4.3 million, based on the available project information."
      },
      {
        q: "What is the payment plan for Hudayriyat Golf Estates?",
        a: "The available payment plan is 5% / 35% / 60%, based on the current project payment schedule."
      },
      {
        q: "When is the handover of Hudayriyat Golf Estates?",
        a: "The handover is planned for Q3 2030."
      },
      {
        q: "Where is Hudayriyat Golf Estates located?",
        a: "Hudayriyat Golf Estates is located on Hudayriyat Island in Abu Dhabi, close to golf facilities, beaches, waterfront attractions, restaurants, sports facilities, and other leisure destinations."
      },
      {
        q: "Is Hudayriyat Golf Estates freehold?",
        a: "Yes, the project offers freehold ownership for all nationalities."
      }
    ]
  },
  "masyaf-plots.blade.php": {
    slug: 'masyaf-plots',
    title: 'Frequently Asked Questions',
    subtitle: 'Key inquiries and essential information regarding ownership at Masyaf Plots',
    type: 'project',
    items: [
      {
        q: "Can foreigners and expatriates purchase residential plots in Masyaf?",
        a: "Yes, Masyaf Plots on Hudayriyat Island is a designated freehold investment zone, allowing 100% freehold ownership for both UAE nationals and international buyers."
      },
      {
        q: "What type of properties can be built in Masyaf?",
        a: "Purchasers can design and build custom luxury residential villas adhering to Modon's high architectural and master-planning guidelines."
      },
      {
        q: "Where is Masyaf located on Hudayriyat Island?",
        a: "Masyaf is situated in a prime coastal position on Hudayriyat Island, offering direct connectivity to Abu Dhabi city center within 10-15 minutes."
      },
      {
        q: "Are Masyaf residential plots eligible for the UAE Golden Visa?",
        a: "Yes, property and land purchases meeting the UAE real estate investment threshold of AED 2 million qualify the owner and their family for the 10-Year UAE Golden Visa."
      }
    ]
  },
  "nawayef-east-hills.blade.php": {
    slug: 'nawayef-east-hills',
    title: 'Frequently Asked Questions',
    subtitle: '',
    type: 'nawayef',
    items: [
      {
        q: "What is Nawayef East Hills?",
        a: "Nawayef East Hills is an elevated luxury hillside community on Hudayriyat Island, Abu Dhabi, featuring bespoke villas, heights, and mansions."
      },
      {
        q: "Who is the developer of Nawayef East Hills?",
        a: "Nawayef East Hills is developed by Modon Properties."
      },
      {
        q: "What types of properties are available at Nawayef East Hills?",
        a: "Nawayef East Hills offers 4 and 5-bedroom Homes, 5 to 7-bedroom Heights, and 6 to 8-bedroom Mansions."
      },
      {
        q: "What is the starting price of Nawayef East Hills?",
        a: "The starting price for Nawayef East Homes is AED 6.6 million, according to Modon's current project information."
      },
      {
        q: "What is the payment plan for Nawayef East Hills?",
        a: "Nawayef East follows a 40/60 payment plan, with 10% payable on booking, 30% during construction, and the remaining 60% due upon handover."
      },
      {
        q: "When is the handover of Nawayef East Hills?",
        a: "Nawayef East is scheduled for handover in December 2028."
      },
      {
        q: "Where is Nawayef East Hills located?",
        a: "Nawayef East Hills is located on Hudayriyat Island in Abu Dhabi, close to beaches, sports facilities, outdoor attractions, dining destinations, and leisure facilities."
      },
      {
        q: "Is Nawayef East Hills freehold?",
        a: "Yes. Nawayef East is a freehold development and properties can be fully owned by buyers of all nationalities."
      },
      {
        q: "What amenities are available at Nawayef East Hills?",
        a: "The development includes a swimming pool, clubhouse, gym, tennis facilities, jogging trails, children's play areas, landscaped parkland, and a mosque. Residents can also access the wider sports and leisure facilities of Hudayriyat Island."
      },
      {
        q: "What makes Nawayef East Hills different?",
        a: "Nawayef East Hills is positioned on elevated terrain reaching up to 60 metres, giving the community a distinctive hillside setting with views towards the Abu Dhabi skyline and Arabian Gulf. The development also combines different architectural styles with spacious villas, private gardens, terraces, swimming pools, and majlis areas."
      }
    ]
  },
  "nawayef-park-views.blade.php": {
    slug: 'nawayef-park-views',
    title: 'FAQs',
    subtitle: '',
    type: 'parkviews',
    items: [
      {
        q: "Where is Nawayef Park Views located?",
        a: "Nawayef Park Views is situated in the heart of Hudayriyat Island, Abu Dhabi, resting between the scenic Nawayef hills."
      },
      {
        q: "Who is the developer?",
        a: "Developed by Modon Properties, a renowned Abu Dhabi-based developer known for crafting premium, sustainable communities."
      },
      {
        q: "What types of residences are available?",
        a: "The community offers freehold apartments with 1 to 4 bedrooms, featuring private balconies or terraces. Larger units, ranging from 2 to 4 bedrooms, may include staff quarters and dedicated home office space."
      },
      {
        q: "What is the size range of the residences?",
        a: "Residential units span from approximately 1,044 sq ft up to 5,328 sq ft."
      },
      {
        q: "When is the expected completion/ handover?",
        a: "The project is scheduled for completion in Q1 2028."
      },
      {
        q: "What payment plan options are available?",
        a: "A flexible 60/40 payment plan, requiring a 10% booking fee, followed by structured installments during construction, with the final 40% due at handover."
      },
      {
        q: "What amenities are included onsite?",
        a: "Residents enjoy a wellness-focused lifestyle featuring a fully equipped gym, yoga zone, co-working space, barbecue and shaded green areas, clubhouse, children’s splash pool and play area, plus concierge, catering, and laundry services."
      },
      {
        q: "Who can buy and what are the investment benefits?",
        a: "Available as freehold for all nationalities, the apartments are ideal for both residents and investors."
      }
    ]
  },
  "nawayef-village.blade.php": {
    slug: 'nawayef-village',
    title: 'Frequently Asked Questions',
    subtitle: 'Key inquiries and essential information regarding ownership at Nawayef Village',
    type: 'project',
    items: [
      {
        q: "Where is Nawayef Village located?",
        a: "It’s situated on Hudayriyat Island, Abu Dhabi, nestled between the Nawayef West and East Hills, with elevated terrain and panoramic views."
      },
      {
        q: "When is handover scheduled?",
        a: "Residents can expect handover in Q1 2029."
      },
      {
        q: "What is the payment plan structure of Nawayef Village?",
        a: "The flexible payment plan follows a 10/40/50 model, 10% on booking, 40% during construction, and the remaining 50% upon handover in January 2029."
      },
      {
        q: "Who is the developer behind this community?",
        a: "Nawayef Village is developed by Modon Properties, an Abu Dhabi-based firm known for premium large‑scale residential projects."
      },
      {
        q: "What types of homes are available in Nawayef Village?",
        a: "Nawayef Village offers 3 to 5 bedroom townhouses and twin villas, with sizes ranging from approximately 2,669 sq ft to 3,670 sq ft."
      },
      {
        q: "What amenities are provided at Nawayef Village?",
        a: "Residents enjoy gated community security, parks, green spaces, walking and cycling paths, community centres, pools, boutique retail, fine dining, cinema, fitness facilities, schools, medical services, and direct beach access."
      },
      {
        q: "How close is Nawayef Village to key landmarks?",
        a: "Nawayef Village is just 15 minutes to the Sheikh Zayed Grand Mosque and 25 minutes to Zayed International Airport. Saadiyat Island and ADGM are also within easy reach."
      }
    ]
  },
  "wadeem-plots.blade.php": {
    slug: 'wadeem-plots',
    title: 'Frequently Asked Questions',
    subtitle: 'Key inquiries and essential information regarding ownership at Wadeem Plots',
    type: 'project',
    items: [
      {
        q: "What are nearby dining options around Wadeem Plots?",
        a: "Salar Restaurant (approx 10 mins), The Phuket Kitchen (approx 16 mins), Sama AlMoheet Seafood & Grill Restaurant (approx 11 mins), Sunset Life Restaurant and Cafe (approx 19 mins), and Al Shader Restaurant and Grill (approx 14 mins)."
      },
      {
        q: "What shopping destinations are close to Wadeem Plots?",
        a: "Mushrif Mall (approx 10 mins), Abu Dhabi Mall (approx 21 mins), The Galleria Mall (approx 21 mins), and Reem Mall (approx 23 mins)."
      },
      {
        q: "What hotels & resorts are located near Wadeem Plots?",
        a: "Radisson Blu Hotel & Resort (approx 21 mins), Four Seasons Hotel (approx 23 mins), Rosewood Hotel (approx 21 mins), The St. Regis Abu Dhabi (approx 18 mins), and Emirates Palace Mandarin Oriental (approx 16 mins)."
      }
    ]
  }
};

function generatePhpBlock(cfg) {
  let itemsPhp = cfg.items.map(it => {
    let qEsc = it.q.replace(/'/g, "\\'");
    let aEsc = it.a.replace(/'/g, "\\'");
    return `        [\n            'q' => '${qEsc}',\n            'a' => '${aEsc}',\n        ]`;
  }).join(',\n');

  return `@php
    $defaultFaqs = [
${itemsPhp}
    ];

    $dbFaqs = page_section('faq', 'items', null, '${cfg.slug}');
    $activeFaqs = (is_array($dbFaqs) && count($dbFaqs) >= 2) ? $dbFaqs : $defaultFaqs;
@endphp\n`;
}

function generateSectionHtml(cfg) {
  const php = generatePhpBlock(cfg);

  if (cfg.type === 'naseem') {
    return `${php}<section class="NaseemFaq-module__e0rZta__faqSection" id="faq">
    <div class="container">
        <div class="NaseemFaq-module__e0rZta__header">
            <h2 class="NaseemFaq-module__e0rZta__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
            <p class="NaseemFaq-module__e0rZta__subtitle">${cfg.subtitle}</p>
        </div>
        <div class="NaseemFaq-module__e0rZta__faqList">
            @foreach($activeFaqs as $idx => $faq)
                <div class="NaseemFaq-module__e0rZta__faqCard {{ $idx === 0 ? 'NaseemFaq-module__e0rZta__faqOpen' : '' }}">
                    <button type="button" class="NaseemFaq-module__e0rZta__questionBtn" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span class="NaseemFaq-module__e0rZta__questionText">{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <span class="NaseemFaq-module__e0rZta__toggleIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true" style="transition: transform 0.25s ease; {{ $idx === 0 ? 'transform: rotate(45deg);' : '' }}">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="NaseemFaq-module__e0rZta__answerBody" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p class="NaseemFaq-module__e0rZta__answerText">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }

  if (cfg.type === 'bashayer') {
    return `${php}<section class="BashayerFaq-module__ZBVFYq__faqSection" id="faq">
    <div class="container">
        <div class="BashayerFaq-module__ZBVFYq__header">
            <h2 class="BashayerFaq-module__ZBVFYq__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
        </div>
        <div class="BashayerFaq-module__ZBVFYq__faqContainer">
            @foreach($activeFaqs as $idx => $faq)
                <div class="BashayerFaq-module__ZBVFYq__faqItem {{ $idx === 0 ? 'BashayerFaq-module__ZBVFYq__faqItemOpen' : '' }}">
                    <button type="button" class="BashayerFaq-module__ZBVFYq__questionBtn" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <span class="BashayerFaq-module__ZBVFYq__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true" style="transition: transform 0.25s ease; {{ $idx === 0 ? 'transform: rotate(45deg);' : '' }}">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="BashayerFaq-module__ZBVFYq__answerBox" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p class="BashayerFaq-module__ZBVFYq__answer">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }

  if (cfg.type === 'villas') {
    return `${php}<section class="VillasFaq-module__EnKzDG__faqSection" id="faq">
    <div class="container">
        <div class="VillasFaq-module__EnKzDG__header">
            <h2 class="VillasFaq-module__EnKzDG__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
        </div>
        <div class="VillasFaq-module__EnKzDG__faqContainer">
            @foreach($activeFaqs as $idx => $faq)
                <div class="VillasFaq-module__EnKzDG__faqItem {{ $idx === 0 ? 'VillasFaq-module__EnKzDG__faqItemOpen' : '' }}">
                    <button type="button" class="VillasFaq-module__EnKzDG__questionBtn" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <span class="VillasFaq-module__EnKzDG__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true" style="transition: transform 0.25s ease; {{ $idx === 0 ? 'transform: rotate(45deg);' : '' }}">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="VillasFaq-module__EnKzDG__answerBox" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p class="VillasFaq-module__EnKzDG__answer">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }

  if (cfg.type === 'golf') {
    return `${php}<section id="faq" class="GolfFaq-module__6XeT-W__faqSection">
    <div class="container">
        <div class="GolfFaq-module__6XeT-W__header">
            <h2 class="GolfFaq-module__6XeT-W__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
            <p class="GolfFaq-module__6XeT-W__subtitle">${cfg.subtitle}</p>
        </div>
        <div class="GolfFaq-module__6XeT-W__faqList">
            @foreach($activeFaqs as $idx => $faq)
                <div class="GolfFaq-module__6XeT-W__faqCard">
                    <button type="button" class="GolfFaq-module__6XeT-W__faqQuestion {{ $idx === 0 ? 'GolfFaq-module__6XeT-W__questionActive' : '' }}" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down GolfFaq-module__6XeT-W__chevron {{ $idx === 0 ? 'GolfFaq-module__6XeT-W__chevronOpen' : '' }}" aria-hidden="true" style="transition: transform 0.25s ease;">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <div class="GolfFaq-module__6XeT-W__faqAnswer" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p>{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }

  if (cfg.type === 'nawayef') {
    return `${php}<section class="NawayefFaq-module__cDdx-a__faqSection" id="faq">
    <div class="container">
        <div class="NawayefFaq-module__cDdx-a__header">
            <h2 class="NawayefFaq-module__cDdx-a__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
        </div>
        <div class="NawayefFaq-module__cDdx-a__faqContainer">
            @foreach($activeFaqs as $idx => $faq)
                <div class="NawayefFaq-module__cDdx-a__faqItem {{ $idx === 0 ? 'NawayefFaq-module__cDdx-a__faqItemOpen' : '' }}">
                    <button type="button" class="NawayefFaq-module__cDdx-a__questionBtn" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <span class="NawayefFaq-module__cDdx-a__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true" style="transition: transform 0.25s ease; {{ $idx === 0 ? 'transform: rotate(45deg);' : '' }}">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="NawayefFaq-module__cDdx-a__answerBox" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p class="NawayefFaq-module__cDdx-a__answer">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }

  if (cfg.type === 'project') {
    return `${php}<section class="ProjectFaq-module__mrHkNq__faqSection" id="faq">
    <div class="container">
        <div class="ProjectFaq-module__mrHkNq__header">
            <h2 class="ProjectFaq-module__mrHkNq__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
            <p class="ProjectFaq-module__mrHkNq__subtitle">${cfg.subtitle}</p>
        </div>
        <div class="ProjectFaq-module__mrHkNq__faqList">
            @foreach($activeFaqs as $idx => $faq)
                <div class="ProjectFaq-module__mrHkNq__faqCard {{ $idx === 0 ? 'ProjectFaq-module__mrHkNq__faqOpen' : '' }}">
                    <button type="button" class="ProjectFaq-module__mrHkNq__questionBtn" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span class="ProjectFaq-module__mrHkNq__questionText">{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <span class="ProjectFaq-module__mrHkNq__toggleIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true" style="transition: transform 0.25s ease; {{ $idx === 0 ? 'transform: rotate(45deg);' : '' }}">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </span>
                    </button>
                    <div class="ProjectFaq-module__mrHkNq__answerBody" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p class="ProjectFaq-module__mrHkNq__answerText">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }

  if (cfg.type === 'parkviews') {
    return `${php}<section id="faq" class="ParkViewsFaq-module__UU45Uq__faqSection">
    <div class="container">
        <div class="ParkViewsFaq-module__UU45Uq__header">
            <h2 class="ParkViewsFaq-module__UU45Uq__title">{{ page_section('faq', 'title', '${cfg.title}', '${cfg.slug}') }}</h2>
        </div>
        <div class="ParkViewsFaq-module__UU45Uq__faqContainer">
            @foreach($activeFaqs as $idx => $faq)
                <div class="ParkViewsFaq-module__UU45Uq__faqItem {{ $idx === 0 ? 'ParkViewsFaq-module__UU45Uq__faqItemOpen' : '' }}">
                    <button type="button" class="ParkViewsFaq-module__UU45Uq__questionBtn" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <div class="ParkViewsFaq-module__UU45Uq__iconWrapper {{ $idx === 0 ? 'ParkViewsFaq-module__UU45Uq__iconOpen' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus" aria-hidden="true" style="transition: transform 0.25s ease; {{ $idx === 0 ? 'transform: rotate(45deg);' : '' }}">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="ParkViewsFaq-module__UU45Uq__answerBox" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p style="color: #475569; margin: 14px 0 0; font-size: 15px; line-height: 1.75;">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;
  }
}

// 2. Perform replacements in community blade files
for (const [filename, cfg] of Object.entries(faqsData)) {
  const filePath = path.join(commDir, filename);
  let content = fs.readFileSync(filePath, 'utf8');

  const faqIdx = content.indexOf('id="faq"');
  if (faqIdx === -1) {
    console.log(`Skipping ${filename}: no id="faq" found`);
    continue;
  }

  const secStart = content.lastIndexOf('<section', faqIdx);
  const secEnd = content.indexOf('</section>', faqIdx);

  if (secStart === -1 || secEnd === -1) {
    console.log(`Could not find section boundaries for ${filename}`);
    continue;
  }

  const newSecHtml = generateSectionHtml(cfg);
  content = content.substring(0, secStart) + newSecHtml + content.substring(secEnd + 10);
  fs.writeFileSync(filePath, content, 'utf8');
  console.log(`Successfully updated FAQ in ${filename}`);
}

// 3. Update dynamic-page.blade.php
const dynPath = path.join(__dirname, 'resources', 'views', 'dynamic-page.blade.php');
let dynContent = fs.readFileSync(dynPath, 'utf8');
const dynFaqIdx = dynContent.indexOf('id="faq"');
if (dynFaqIdx !== -1) {
  const secStart = dynContent.lastIndexOf('<section', dynFaqIdx);
  const secEnd = dynContent.indexOf('</section>', dynFaqIdx);

  const dynFaqSection = `@php
    $defaultFaqs = [
        [
            'q' => 'What is Hudayriyat Golf Estates?',
            'a' => 'Hudayriyat Golf Estates is a villa community by Modon Properties on Hudayriyat Island, Abu Dhabi. The project offers a golf-focused residential lifestyle with modern villas and landscaped surroundings.',
        ],
        [
            'q' => 'Who is the developer of Hudayriyat Golf Estates?',
            'a' => 'Hudayriyat Golf Estates is developed by Modon Properties.',
        ],
        [
            'q' => 'What is the starting price of Hudayriyat Golf Estates?',
            'a' => 'The launch price starts from approximately AED 4.3 million, based on the available project information.',
        ],
        [
            'q' => 'What is the payment plan for Hudayriyat Golf Estates?',
            'a' => 'The available payment plan is 5% / 35% / 60%, based on the current project payment schedule.',
        ],
        [
            'q' => 'When is the handover of Hudayriyat Golf Estates?',
            'a' => 'The handover is planned for Q3 2030.',
        ],
        [
            'q' => 'Where is Hudayriyat Golf Estates located?',
            'a' => 'Hudayriyat Golf Estates is located on Hudayriyat Island in Abu Dhabi, close to golf facilities, beaches, waterfront attractions, restaurants, sports facilities, and other leisure destinations.',
        ],
        [
            'q' => 'Is Hudayriyat Golf Estates freehold?',
            'a' => 'Yes, the project offers freehold ownership for all nationalities.',
        ]
    ];

    $dbFaqs = page_section('faq', 'items', null, $page->slug);
    $activeFaqs = (is_array($dbFaqs) && count($dbFaqs) >= 2) ? $dbFaqs : $defaultFaqs;
@endphp
<section id="faq" class="GolfFaq-module__6XeT-W__faqSection">
    <div class="container">
        <div class="GolfFaq-module__6XeT-W__header">
            <h2 class="GolfFaq-module__6XeT-W__title">{{ page_section('faq', 'title', 'Frequently Asked Questions', $page->slug) }}</h2>
            <p class="GolfFaq-module__6XeT-W__subtitle">Find answers to common questions about purchasing a villa in Hudayriyat Golf Estates.</p>
        </div>
        <div class="GolfFaq-module__6XeT-W__faqList">
            @foreach($activeFaqs as $idx => $faq)
                <div class="GolfFaq-module__6XeT-W__faqCard">
                    <button type="button" class="GolfFaq-module__6XeT-W__faqQuestion {{ $idx === 0 ? 'GolfFaq-module__6XeT-W__questionActive' : '' }}" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                        <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down GolfFaq-module__6XeT-W__chevron {{ $idx === 0 ? 'GolfFaq-module__6XeT-W__chevronOpen' : '' }}" aria-hidden="true" style="transition: transform 0.25s ease;">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <div class="GolfFaq-module__6XeT-W__faqAnswer" style="{{ $idx === 0 ? 'display: block;' : 'display: none;' }}">
                        <p>{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>`;

  dynContent = dynContent.substring(0, secStart) + dynFaqSection + dynContent.substring(secEnd + 10);
  fs.writeFileSync(dynPath, dynContent, 'utf8');
  console.log('Successfully updated FAQ in dynamic-page.blade.php');
}
