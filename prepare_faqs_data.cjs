const fs = require('fs');
const path = require('path');

// 1. Data mapping for each community
const faqsData = {
  "al-naseem-villas.blade.php": {
    slug: 'al-naseem-villas',
    title: 'Frequently Asked Questions',
    subtitle: 'Everything you need to know about purchasing a luxury villa at Al Naseem, Hudayriyat Island',
    prefix: 'NaseemFaq-module__e0rZta__',
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
    prefix: 'BashayerFaq-module__ZBVFYq__',
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
    prefix: 'VillasFaq-module__EnKzDG__',
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
    prefix: 'GolfFaq-module__6XeT-W__',
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
    prefix: 'ProjectFaq-module__mrHkNq__',
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
    prefix: 'NawayefFaq-module__cDdx-a__',
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
    prefix: 'ParkViewsFaq-module__UU45Uq__',
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
    prefix: 'ProjectFaq-module__mrHkNq__',
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
    prefix: 'ProjectFaq-module__mrHkNq__',
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

console.log('Mapped communities:', Object.keys(faqsData).length);
