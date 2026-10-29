@php
    $articleHeading = page_section('content', 'title', $page->title . ' Living & Overview', $page->slug);
    $defaultIntro = '<p><strong>' . e($page->title) . '</strong> is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.</p><p style="margin-top:1rem">' . e($page->title) . ' is located on the shores of Hudayriyat Island and faces protected natural reserves. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.</p>';
    $articleIntro = page_section('content', 'intro', $defaultIntro, $page->slug);
    // If intro was entered as plain text without tags, preserve linebreaks
    if (!str_contains($articleIntro, '<p') && !str_contains($articleIntro, '<div')) {
        $articleIntro = '<p>' . nl2br(e($articleIntro)) . '</p>';
    }

    $articleSummernote = page_section('content', 'html', page_section('content', 'body', $page->body, $page->slug), $page->slug);
    $apptTitle = page_section('content', 'appt_title', 'BOOK AN APPOINTMENT', $page->slug);

    if (!empty(trim($articleSummernote ?? ''))) {
        $readMoreBtnHtml = '<button type="button" id="readMoreToggleBtn" onclick="toggleArticleReadMore()" class="saimaReadMoreBtn" style="display: inline-flex; align-items: center; vertical-align: baseline; margin-left: 8px; cursor: pointer; color: #1a4731; font-weight: 700; text-decoration: underline; text-underline-offset: 4px; background: none; border: none; padding: 0;"><span id="readMoreLabel">Read More</span> <svg id="readMoreArrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 3px; vertical-align: middle;"><polyline points="6 9 12 15 18 9"></polyline></svg></button>';

        $trimmedIntro = rtrim($articleIntro);
        if (str_ends_with($trimmedIntro, '</p>')) {
            $articleIntro = substr($trimmedIntro, 0, -4) . ' ' . $readMoreBtnHtml . '</p>';
        } elseif (str_contains($articleIntro, '</p>')) {
            $lastPPos = strrpos($articleIntro, '</p>');
            $articleIntro = substr_replace($articleIntro, ' ' . $readMoreBtnHtml . '</p>', $lastPPos, 4);
        } else {
            $articleIntro .= ' ' . $readMoreBtnHtml;
        }
    }
@endphp

<section id="article-booking-section" style="padding: 45px 0 20px 0; background: #ffffff;">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">
        <div class="saimaArticleBookingGrid">
            
            <!-- Left Column: Heading + Intro Paragraphs (with inline Read More) + Summernote (if inline) -->
            <div class="saimaArticleContentCol">
                @if(!empty($articleHeading))
                    <h2 class="saimaArticleH2">
                        {!! $articleHeading !!}
                    </h2>
                @endif

                <!-- Intro Paragraphs with inline Read More button right at the end -->
                <div class="saimaArticleIntroText">
                    {!! $articleIntro !!}
                </div>

                <!-- Summernote Rich Content (rendered here only if communities section is not active) -->
                @if(!empty(trim($articleSummernote ?? '')) && ($renderSummernoteInline ?? true))
                    <div id="summernoteExpandContainer" class="saimaSummernoteExpanded" style="display: block; margin-top: 25px;">
                        {!! $articleSummernote !!}
                    </div>
                @endif
            </div>

            <!-- Right Column: Sticky BOOK AN APPOINTMENT Card (Matching User Image) -->
            <aside class="saimaArticleSidebarCol">
                <div class="saimaStickySidebarWrap">
                    <div class="saimaApptCard">
                        <h3 class="saimaApptTitle">{{ $apptTitle ?: 'BOOK AN APPOINTMENT' }}</h3>
                        <form id="saimaArticleApptForm" class="saimaApptForm">
                            <input type="text" name="name" class="saimaInput" placeholder="Name" required>
                            <input type="tel" name="phone" class="saimaInput" placeholder="Phone" required>
                            <input type="email" name="email" class="saimaInput" placeholder="Email" required>
                            <textarea name="comment" class="saimaTextarea" placeholder="Leave a comment here"></textarea>
                            <button type="submit" class="saimaSubmitBtn">SUBMIT</button>
                            <div id="saimaArticleSuccessMsg" class="saimaSuccessMsg" style="display: none;">
                                Thank you! Your appointment request has been submitted successfully.
                            </div>
                        </form>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>

<style>
.saimaArticleBookingGrid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 370px;
    gap: 40px;
    align-items: start;
}

.saimaArticleContentCol {
    min-width: 0;
}

.saimaArticleH2 {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 18px 0;
    line-height: 1.35;
    font-family: inherit;
}

.saimaArticleIntroText {
    font-size: 16px;
    color: #374151;
    line-height: 1.8;
}

.saimaArticleIntroText p {
    margin: 0 0 16px 0;
}

.saimaSummernoteExpanded {
    font-size: 16px;
    color: #374151;
    line-height: 1.8;
    border-top: 1px dashed #e5e7eb;
    padding-top: 18px;
    animation: fadeInSlide 0.3s ease;
}

.saimaSummernoteExpanded p {
    margin: 0 0 16px 0;
}

.saimaSummernoteExpanded img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    margin: 14px 0;
}

.saimaSummernoteExpanded h3, .saimaSummernoteExpanded h4 {
    color: #111827;
    font-weight: 700;
    margin: 24px 0 12px 0;
}

.saimaArticleContentCol ul,
.saimaSummernoteExpanded ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin: 16px 0 20px 0 !important;
    padding-left: 28px !important;
}

.saimaArticleContentCol ol,
.saimaSummernoteExpanded ol {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin: 16px 0 20px 0 !important;
    padding-left: 28px !important;
}

.saimaArticleContentCol li,
.saimaSummernoteExpanded li {
    list-style: inherit !important;
    display: list-item !important;
    margin-bottom: 10px !important;
    font-size: 17px !important;
    line-height: 1.8 !important;
    color: #111111 !important;
}

.saimaArticleContentCol p,
.saimaArticleContentCol li,
.saimaArticleContentCol ul,
.saimaArticleContentCol ol,
.saimaArticleContentCol b,
.saimaArticleContentCol strong,
.saimaArticleContentCol i,
.saimaArticleContentCol em,
.saimaArticleContentCol span,
.saimaSummernoteExpanded p,
.saimaSummernoteExpanded li,
.saimaSummernoteExpanded ul,
.saimaSummernoteExpanded ol,
.saimaSummernoteExpanded b,
.saimaSummernoteExpanded strong,
.saimaSummernoteExpanded i,
.saimaSummernoteExpanded em,
.saimaSummernoteExpanded span {
    color: #111111 !important;
}

.saimaArticleContentCol p,
.saimaSummernoteExpanded p {
    font-size: 17px !important;
    line-height: 1.8 !important;
}

.saimaArticleContentCol h2,
.saimaArticleH2,
.saimaSummernoteExpanded h2 {
    color: #1a4731 !important;
}

.saimaReadMoreBtn {
    background: transparent;
    border: none;
    padding: 0;
    color: #1a4731;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: underline;
    text-underline-offset: 4px;
    transition: color 0.2s ease;
}

.saimaReadMoreBtn:hover {
    color: #5c4731;
}

.saimaArticleSidebarCol {
    min-width: 0;
}

.saimaStickySidebarWrap {
    position: sticky;
    top: 90px;
}

.saimaApptCard {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 26px 22px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
}

.saimaApptTitle {
    font-size: 17px;
    font-weight: 800;
    text-align: center;
    color: #111827;
    margin: 0 0 18px 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.saimaApptForm {
    display: flex;
    flex-direction: column;
    gap: 13px;
}

.saimaInput {
    width: 100%;
    box-sizing: border-box;
    padding: 12px 14px;
    font-size: 15px;
    color: #111827;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    font-family: inherit;
}

.saimaInput:focus {
    border-color: #1a4731;
    box-shadow: 0 0 0 3px rgba(26, 71, 49, 0.15);
}

.saimaTextarea {
    width: 100%;
    box-sizing: border-box;
    padding: 12px 14px;
    font-size: 15px;
    color: #111827;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    outline: none;
    resize: vertical;
    min-height: 100px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    font-family: inherit;
}

.saimaTextarea:focus {
    border-color: #1a4731;
    box-shadow: 0 0 0 3px rgba(26, 71, 49, 0.15);
}

.saimaSubmitBtn {
    width: 100%;
    background: #1a4731;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 14px 20px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.6px;
    cursor: pointer;
    text-transform: uppercase;
    transition: background 0.2s ease;
}

.saimaSubmitBtn:hover {
    background: #6e5840;
}

.saimaSuccessMsg {
    margin-top: 8px;
    padding: 10px 14px;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: 6px;
    color: #065f46;
    font-size: 13.5px;
    text-align: center;
}

@keyframes fadeInSlide {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 900px) {
    .saimaArticleBookingGrid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .saimaStickySidebarWrap {
        position: static;
    }
}
</style>

<script>
function toggleArticleReadMore() {
    const container = document.getElementById('summernoteExpandContainer');
    if (!container) return;

    container.style.display = 'block';

    const yOffset = -70;
    const y = container.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });
}

function scrollBackToIntro() {
    const introSection = document.getElementById('article-booking-section');
    if (introSection) {
        const yOffset = -70;
        const y = introSection.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({ top: y, behavior: 'smooth' });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('saimaArticleApptForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            const successMsg = document.getElementById('saimaArticleSuccessMsg');
            const originalText = btn ? btn.textContent : 'SUBMIT';
            if (btn) {
                btn.textContent = 'Submitting...';
                btn.disabled = true;
            }

            const data = {
                name: form.querySelector('input[name="name"]')?.value || '',
                phone: form.querySelector('input[name="phone"]')?.value || '',
                email: form.querySelector('input[name="email"]')?.value || '',
                comment: form.querySelector('textarea[name="comment"]')?.value || '',
                source: window.location.pathname
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            fetch('/api/leads', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(resData => {
                if (btn) {
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
                if (successMsg) successMsg.style.display = 'block';
                form.reset();
                setTimeout(() => {
                    if (successMsg) successMsg.style.display = 'none';
                }, 6000);
            })
            .catch(err => {
                if (btn) {
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
                if (successMsg) successMsg.style.display = 'block';
                form.reset();
            });
        });
    }
});
</script>
