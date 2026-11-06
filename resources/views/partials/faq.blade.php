@php
$faqs = [
    [
        'q' => "What is Saima?",
        'a' => "It's a premier residential and commercial real estate development portfolio by Saima Group, combining luxury living communities with modern amenities, prime locations, and high-yield investment destinations.",
    ],
    [
        'q' => "Where are Saima projects located?",
        'a' => "Saima projects are located across prime urban and coastal destinations in Pakistan, offering direct connectivity to major business districts, highways, and landmarks.",
    ],
    [
        'q' => "Who is developing Saima projects?",
        'a' => "Saima Group, one of Pakistan's most trusted and experienced real estate developers with decades of excellence in delivering quality residential and commercial projects.",
    ],
    [
        'q' => "Are Saima properties freehold / clear title?",
        'a' => "Yes, all Saima developments come with clear documentation, approved NOCs, and secure ownership for buyers and investors.",
    ],
    [
        'q' => "What residential projects are available by Saima?",
        'a' => "Current and recent launches include luxury apartments, modern townhouses, waterfront residences, and bespoke housing schemes with flexible payment plans.",
    ],
    [
        'q' => "What amenities does Saima offer?",
        'a' => "Saima communities feature 24/7 security, gated entrances, modern fitness centres, swimming pools, landscaped parks, high-speed elevators, and dedicated parking facilities.",
    ],
    [
        'q' => "Is investing in Saima a good investment?",
        'a' => "Yes. With Saima Group's decades-long proven track record, prime locations, and high rental yield potential, Saima properties represent an exceptional investment opportunity.",
    ],
    [
        'q' => "What property sizes are available in Saima projects?",
        'a' => "Sizes range from 2, 3, 4, and 5-room luxury apartments to executive penthouses and spacious independent residential plots and villas.",
    ],
    [
        'q' => "What are the payment plans for Saima projects?",
        'a' => "Saima offers flexible, easy, construction-linked installment plans spanning 36 to 48 months with reasonable booking and monthly payment options.",
    ],
    [
        'q' => "When will Saima projects be completed?",
        'a' => "Completion and handover timelines vary by project, with phased construction milestones and timely deliveries as per developer schedule.",
    ],
];

$pageSlug = isset($page) && $page instanceof \App\Models\Page ? $page->slug : null;
$rawFaqs = page_section('faq', 'items', null, $pageSlug);
$dbFaqs = [];

if (is_array($rawFaqs)) {
    foreach ($rawFaqs as $f) {
        $q = trim((string)($f['question'] ?? ($f['q'] ?? '')));
        $a = trim((string)($f['answer'] ?? ($f['a'] ?? '')));
        if ($q !== '' || $a !== '') {
            $dbFaqs[] = ['q' => $q, 'a' => $a];
        }
    }
} elseif ($rawFaqs === null) {
    $dbFaqs = $faqs;
}
@endphp

@if(!empty($dbFaqs))
<section id="faq" aria-label="Frequently Asked Questions about Saima" class="faqSection">
    <div class="container">
        <div class="section-header">
            <h2>{{ page_section('faq', 'heading', page_section('faq', 'title', 'Frequently Asked Questions', $pageSlug), $pageSlug) }}</h2>
            @php
                $faqSub = page_section('faq', 'subtitle', page_section('faq', 'description', '', $pageSlug), $pageSlug);
            @endphp
            @if(!empty(trim((string)$faqSub)))
                {!! str_contains($faqSub, '<p') ? $faqSub : '<p>' . e($faqSub) . '</p>' !!}
            @endif
        </div>

        <div class="faqContainer">
            <div class="faqList">
                @foreach($dbFaqs as $index => $faq)
                    <div class="faqItem {{ $index === 0 ? 'faqItemOpen' : '' }}" id="faqItem-{{ $index }}">
                        <button type="button" class="faqQuestion" onclick="toggleFaq({{ $index }}, event)" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
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
@endif

<script>
    function toggleFaq(index, e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        const item = document.getElementById('faqItem-' + index);
        const answer = document.getElementById('faqAnswer-' + index);
        if (!item || !answer) return;
        const btn = item.querySelector('.faqQuestion');
        const isOpen = item.classList.contains('faqItemOpen');

        // Clear any conflicting inline display styles
        answer.style.removeProperty('display');

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