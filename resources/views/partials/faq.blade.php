@php
$faqs = [
    [
        'q' => "What is Hudayriyat Island?",
        'a' => "It's a large-scale waterfront island development off Abu Dhabi's coast, run by Modon Properties, combining residential communities with sports, leisure, and entertainment destinations.",
    ],
    [
        'q' => "Where is Hudayriyat Island located?",
        'a' => "It sits just off Al Bateen, connected to the mainland by a dedicated bridge from Sheikh Shakhbout bin Sultan Street, roughly 10–20 minutes from central Abu Dhabi landmarks.",
    ],
    [
        'q' => "Who is developing Hudayriyat Island?",
        'a' => "Modon Properties, one of Abu Dhabi's major community developers, is behind the island's masterplan and its residential launches, including Al Naseem, Nawayef, and Bashayer.",
    ],
    [
        'q' => "Is Hudayriyat Island freehold?",
        'a' => "Most of the residential communities on the island, including Al Naseem, Nawayef, and Wadeem, are freehold and open to buyers of all nationalities.",
    ],
    [
        'q' => "What residential projects are available on Hudayriyat Island?",
        'a' => "Current and recent launches include Al Naseem, Nawayef (Mansions, Homes, Heights, East Hills, Village, Park Views), Bashayer, Wadeem Plots, Masyaf Plots, Sunset Cliff, Hudayriyat Quays, Hudayriyat Sahl, and Hudayriyat Hills.",
    ],
    [
        'q' => "What amenities does Hudayriyat Island offer?",
        'a' => "The island includes beaches, a velodrome, a surf park, an urban park with a mangrove walk, over 200 kilometres of cycling tracks, adventure parks, dining outlets, and community-level clubs and courts.",
    ],
    [
        'q' => "How far is Hudayriyat Island from Abu Dhabi city centre?",
        'a' => "Roughly 10 minutes to the Corniche and World Trade Centre, 12 minutes to Al Bateen, and 15 minutes to Yas Island.",
    ],
    [
        'q' => "Is Hudayriyat Island a good investment?",
        'a' => "Strong demand signals (such as the rapid Bashayer sellout), government-backed infrastructure, and limited waterfront land supply make it an appealing option, though buyers should still review individual payment plans and handover timelines.",
    ],
    [
        'q' => "What villa sizes are available on Hudayriyat Island?",
        'a' => "Sizes vary widely by community, from roughly 724 sqm villas in Al Naseem to sprawling 29,000+ sq ft mansions in Nawayef Mansions.",
    ],
    [
        'q' => "When will Hudayriyat Island projects be completed?",
        'a' => "Handover dates vary by community. Some, like Al Naseem, are targeting late 2026, while others, such as Nawayef Village, are scheduled for early 2029.",
    ],
];

$pageSlug = isset($page) && $page instanceof \App\Models\Page ? $page->slug : null;
$dbFaqs = page_section('faq', 'items', null, $pageSlug);
if (!is_array($dbFaqs) || empty($dbFaqs)) {
    $dbFaqs = $faqs;
}
@endphp

<section id="faq" aria-label="Frequently Asked Questions about Hudayriyat Island" class="faqSection">
    <div class="container">
        <div class="section-header">
            <h2>{{ page_section('faq', 'heading', page_section('faq', 'title', 'Frequently Asked Questions', $pageSlug), $pageSlug) }}</h2>
            @php
                $faqSub = page_section('faq', 'subtitle', page_section('faq', 'description', '', $pageSlug), $pageSlug);
            @endphp
            @if(!empty(trim((string)$faqSub)))
                <p>{{ $faqSub }}</p>
            @endif
        </div>

        <div class="faqContainer">
            <div class="faqList">
                @foreach($dbFaqs as $index => $faq)
                    <div class="faqItem {{ $index === 0 ? 'faqItemOpen' : '' }}" id="faqItem-{{ $index }}">
                        <button type="button" class="faqQuestion" onclick="toggleFaq({{ $index }})" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                            <span>{{ $faq['q'] ?? $faq['question'] ?? '' }}</span>
                            <span class="faqIcon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </span>
                        </button>
                        <div class="faqAnswer {{ $index === 0 ? 'faqAnswerOpen' : '' }}" id="faqAnswer-{{ $index }}">
                            <p class="faqAnswerText">{!! $faq['a'] ?? $faq['answer'] ?? '' !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    function toggleFaq(index) {
        const item = document.getElementById('faqItem-' + index);
        const answer = document.getElementById('faqAnswer-' + index);
        const btn = item.querySelector('.faqQuestion');
        const isOpen = item.classList.contains('faqItemOpen');

        if (isOpen) {
            item.classList.remove('faqItemOpen');
            answer.classList.remove('faqAnswerOpen');
            btn?.setAttribute('aria-expanded', 'false');
        } else {
            item.classList.add('faqItemOpen');
            answer.classList.add('faqAnswerOpen');
            btn?.setAttribute('aria-expanded', 'true');
        }
    }
</script>