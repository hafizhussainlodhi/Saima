@php
    $gallerySlug = $slug ?? ($page->slug ?? 'wadeem-gardens');
    $title = $title ?? page_section('gallery', 'title', (isset($page) ? $page->title : 'Project') . ' Gallery', $gallerySlug);
    $items = $items ?? page_section('gallery', 'images', [], $gallerySlug);
    if (empty($items) && isset($page)) {
        $sec = $page->sections()->where('section_key', 'gallery')->first();
        if ($sec && !empty($sec->content['images'])) {
            $items = $sec->content['images'];
        }
    }
    // Extract unique categories
    $categories = [];
    foreach ($items as $itm) {
        $cat = trim($itm['category'] ?? '');
        if ($cat && strtolower($cat) !== 'all') {
            $formatted = ucfirst(strtolower($cat));
            if (!in_array($formatted, $categories)) {
                $categories[] = $formatted;
            }
        }
    }
    $galleryUid = 'gal_' . md5($gallerySlug . '_' . $title);
@endphp

@if(!empty($items))
<section class="StandardProjectGallery-module__MeUPXW__gallerySection" id="gallery" style="position: relative; overflow: hidden; background-color: #ffffff; padding: 70px 0 50px; width: 100%;">
    <div class="StandardProjectGallery-module__MeUPXW__header" style="text-align: center; max-width: 900px; margin: 0 auto 36px; padding: 0 20px;">
        <h2 class="StandardProjectGallery-module__MeUPXW__title" style="color: #1a1a1a; letter-spacing: -0.01em; margin-bottom: 22px; font-size: clamp(1.85rem, 3.2vw, 2.35rem); font-weight: 700;">
            {{ $title }}
        </h2>

        {{-- Category Filter Tabs --}}
        @if(count($categories) > 0)
            <div class="StandardProjectGallery-module__MeUPXW__tabNav" id="{{ $galleryUid }}_tabs" style="display: flex; justify-content: center; align-items: center; gap: 32px; flex-wrap: wrap;">
                <button type="button" 
                        class="StandardProjectGallery-module__MeUPXW__tabBtn StandardProjectGallery-module__MeUPXW__tabActive" 
                        onclick="{{ $galleryUid }}_filter('ALL', this)"
                        style="cursor: pointer; background: none; border: none; border-bottom: 2px solid #b37748; padding: 6px 4px 10px; font-size: 15px; font-weight: 600; color: #b37748; transition: all 0.25s;">
                    ALL
                </button>
                @foreach($categories as $cat)
                    <button type="button" 
                            class="StandardProjectGallery-module__MeUPXW__tabBtn" 
                            onclick="{{ $galleryUid }}_filter('{{ $cat }}', this)"
                            style="cursor: pointer; background: none; border: none; border-bottom: 2px solid transparent; padding: 6px 4px 10px; font-size: 15px; font-weight: 500; color: #666666; transition: all 0.25s;">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Carousel Container with Peek on both sides --}}
    <div class="StandardProjectGallery-module__MeUPXW__carouselContainer" id="{{ $galleryUid }}_container" style="position: relative; width: 100%; overflow: hidden; padding: 10px 0; margin: 0 auto;">
        {{-- Previous Button --}}
        <button type="button" 
                class="StandardProjectGallery-module__MeUPXW__navBtn StandardProjectGallery-module__MeUPXW__prevBtn" 
                onclick="{{ $galleryUid }}_prev()" 
                aria-label="Previous image"
                style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); width: 44px; height: 44px; border-radius: 50%; background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 16px rgba(0,0,0,0.15); color: #222; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; backdrop-filter: blur(4px); transition: all 0.25s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </button>

        {{-- Viewport & Track --}}
        <div class="StandardProjectGallery-module__MeUPXW__viewport" id="{{ $galleryUid }}_viewport" style="width: 100%; display: flex; overflow: visible;">
            <div class="StandardProjectGallery-module__MeUPXW__track" id="{{ $galleryUid }}_track" style="display: flex; align-items: center; transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1); will-change: transform;">
                @foreach($items as $idx => $itm)
                    <div class="StandardProjectGallery-module__MeUPXW__card {{ $galleryUid }}_card" 
                         data-category="{{ strtolower($itm['category'] ?? 'exterior') }}"
                         data-index="{{ $idx }}"
                         data-src="{{ $itm['src'] ?? '' }}"
                         data-alt="{{ $itm['alt'] ?? '' }}"
                         onclick="{{ $galleryUid }}_openLightbox({{ $idx }})"
                         style="position: relative; flex-shrink: 0; border-radius: 18px; overflow: hidden; cursor: pointer; background: #f4ede5; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.35s ease, box-shadow 0.35s ease;">
                        <img src="{{ $itm['src'] ?? '' }}" 
                             alt="{{ $itm['alt'] ?? ($title . ' photo ' . ($idx + 1)) }}" 
                             class="StandardProjectGallery-module__MeUPXW__cardImg"
                             loading="{{ $idx < 3 ? 'eager' : 'lazy' }}"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);"
                             onmouseover="this.style.transform='scale(1.03)'"
                             onmouseout="this.style.transform='none'">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Next Button --}}
        <button type="button" 
                class="StandardProjectGallery-module__MeUPXW__navBtn StandardProjectGallery-module__MeUPXW__nextBtn" 
                onclick="{{ $galleryUid }}_next()" 
                aria-label="Next image"
                style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); width: 44px; height: 44px; border-radius: 50%; background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 16px rgba(0,0,0,0.15); color: #222; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; backdrop-filter: blur(4px); transition: all 0.25s;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </button>
    </div>

    {{-- Pagination Dots --}}
    <div class="StandardProjectGallery-module__MeUPXW__dotsWrapper" id="{{ $galleryUid }}_dots" style="display: flex; justify-content: center; align-items: center; gap: 7px; margin-top: 26px; padding: 0 20px;">
        {{-- Generated by JS --}}
    </div>

    {{-- Lightbox Modal --}}
    <div id="{{ $galleryUid }}_lightbox" class="StandardProjectGallery-module__MeUPXW__lightbox" style="display: none; position: fixed; inset: 0; background-color: rgba(12, 10, 8, 0.95); backdrop-filter: blur(8px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;" onclick="{{ $galleryUid }}_closeLightbox(event)">
        <button type="button" class="StandardProjectGallery-module__MeUPXW__lightboxClose" onclick="{{ $galleryUid }}_closeLightboxDirect()" aria-label="Close" style="position: absolute; top: 24px; right: 24px; background: rgba(255,255,255,0.15); border: none; color: #fff; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000001;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>

        <button type="button" class="StandardProjectGallery-module__MeUPXW__lightboxNav StandardProjectGallery-module__MeUPXW__lightboxPrev" onclick="{{ $galleryUid }}_lightboxPrev(event)" aria-label="Previous" style="position: absolute; left: 24px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.15); border: none; color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000001;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
        </button>

        <div class="StandardProjectGallery-module__MeUPXW__lightboxContent" onclick="event.stopPropagation()" style="position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; max-width: 90vw; max-height: 88vh;">
            <div style="position: relative; width: min(85vw, 1100px); height: min(75vh, 730px); border-radius: 12px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.5); background: #000; display: flex; align-items: center; justify-content: center;">
                <img id="{{ $galleryUid }}_lightboxImg" src="" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
            <p id="{{ $galleryUid }}_lightboxCaption" style="color: #e5ded5; font-size: 14px; margin-top: 14px; text-align: center; max-width: 700px; line-height: 1.5;"></p>
        </div>

        <button type="button" class="StandardProjectGallery-module__MeUPXW__lightboxNav StandardProjectGallery-module__MeUPXW__lightboxNext" onclick="{{ $galleryUid }}_lightboxNext(event)" aria-label="Next" style="position: absolute; right: 24px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.15); border: none; color: #fff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000001;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
        </button>
    </div>
</section>

{{-- Pixel-Perfect Carousel Logic from Port 3000 StandardProjectGallery.tsx --}}
<script>
(function() {
    var uid = "{{ $galleryUid }}";
    var container = document.getElementById(uid + '_container');
    var track = document.getElementById(uid + '_track');
    var dotsContainer = document.getElementById(uid + '_dots');
    var allCards = Array.from(document.querySelectorAll('.' + uid + '_card'));
    var activeCategory = 'ALL';
    var currentIndex = 0;
    var currentFilteredCards = allCards.slice();
    var lightboxIndex = 0;

    function getViewportWidth() {
        return container ? container.offsetWidth : (window.innerWidth || 1200);
    }

    function layoutCarousel() {
        var vpWidth = getViewportWidth();
        var isDesktop = vpWidth >= 992;
        var gap = isDesktop ? 24 : 16;
        var itemsInCenter = isDesktop ? 2 : 1;
        var cardWidth = isDesktop 
            ? Math.min(600, Math.max(300, (vpWidth - gap - 80) / 2))
            : Math.min(600, vpWidth - 64);
        var cardHeight = Math.round(cardWidth * (400 / 600));

        // Apply card dimensions
        allCards.forEach(function(c) {
            c.style.width = cardWidth + 'px';
            c.style.height = cardHeight + 'px';
        });

        track.style.gap = gap + 'px';

        // Calculate translation for centering and side-peeking
        var visibleWidth = itemsInCenter * cardWidth + (itemsInCenter - 1) * gap;
        var centerOffset = (vpWidth - visibleWidth) / 2;
        var slideStep = cardWidth + gap;

        var translateX = centerOffset - (currentIndex * slideStep);
        track.style.transform = 'translateX(' + translateX + 'px)';

        updateDots();
    }

    function updateDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        if (currentFilteredCards.length <= 1) return;

        currentFilteredCards.forEach(function(_, idx) {
            var dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'StandardProjectGallery-module__MeUPXW__dot' + (idx === currentIndex ? ' StandardProjectGallery-module__MeUPXW__dotActive' : '');
            dot.style.width = '8px';
            dot.style.height = '8px';
            dot.style.borderRadius = '50%';
            dot.style.padding = '0';
            dot.style.border = '1.5px solid #b37748';
            dot.style.backgroundColor = (idx === currentIndex) ? '#b37748' : 'transparent';
            dot.style.cursor = 'pointer';
            dot.style.transition = 'all 0.25s ease';
            if (idx === currentIndex) {
                dot.style.transform = 'scale(1.2)';
            }
            dot.onclick = function() {
                currentIndex = idx;
                layoutCarousel();
            };
            dotsContainer.appendChild(dot);
        });
    }

    window[uid + '_prev'] = function() {
        if (currentFilteredCards.length === 0) return;
        currentIndex = (currentIndex <= 0) ? (currentFilteredCards.length - 1) : (currentIndex - 1);
        layoutCarousel();
    };

    window[uid + '_next'] = function() {
        if (currentFilteredCards.length === 0) return;
        currentIndex = (currentIndex >= currentFilteredCards.length - 1) ? 0 : (currentIndex + 1);
        layoutCarousel();
    };

    window[uid + '_filter'] = function(category, btn) {
        activeCategory = category;
        currentIndex = 0;

        // Update tab styles
        var tabButtons = document.querySelectorAll('#' + uid + '_tabs button');
        tabButtons.forEach(function(b) {
            b.classList.remove('StandardProjectGallery-module__MeUPXW__tabActive');
            b.style.color = '#666666';
            b.style.fontWeight = '500';
            b.style.borderBottom = '2px solid transparent';
        });
        if (btn) {
            btn.classList.add('StandardProjectGallery-module__MeUPXW__tabActive');
            btn.style.color = '#b37748';
            btn.style.fontWeight = '600';
            btn.style.borderBottom = '2px solid #b37748';
        }

        currentFilteredCards = [];
        allCards.forEach(function(c) {
            var cat = c.getAttribute('data-category');
            if (category === 'ALL' || cat === category.toLowerCase()) {
                c.style.display = 'block';
                currentFilteredCards.push(c);
            } else {
                c.style.display = 'none';
            }
        });

        layoutCarousel();
    };

    // Lightbox modal logic
    window[uid + '_openLightbox'] = function(originalIdx) {
        // find position in currentFilteredCards
        var targetCard = allCards[originalIdx];
        var fIdx = currentFilteredCards.indexOf(targetCard);
        if (fIdx === -1) fIdx = 0;
        lightboxIndex = fIdx;
        showLightboxSlide();
        var lb = document.getElementById(uid + '_lightbox');
        if (lb) lb.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    };

    function showLightboxSlide() {
        if (currentFilteredCards.length === 0) return;
        var card = currentFilteredCards[lightboxIndex];
        var src = card.getAttribute('data-src');
        var alt = card.getAttribute('data-alt');

        var img = document.getElementById(uid + '_lightboxImg');
        var caption = document.getElementById(uid + '_lightboxCaption');

        if (img) {
            img.src = src;
            img.alt = alt || '';
        }
        if (caption) {
            caption.textContent = (lightboxIndex + 1) + ' / ' + currentFilteredCards.length + (alt ? (' — ' + alt) : '');
        }
    }

    window[uid + '_closeLightbox'] = function(e) {
        if (e && e.target && e.target.id === (uid + '_lightbox')) {
            window[uid + '_closeLightboxDirect']();
        }
    };

    window[uid + '_closeLightboxDirect'] = function() {
        var lb = document.getElementById(uid + '_lightbox');
        if (lb) lb.style.display = 'none';
        document.body.style.overflow = '';
    };

    window[uid + '_lightboxPrev'] = function(e) {
        if (e) e.stopPropagation();
        if (currentFilteredCards.length === 0) return;
        lightboxIndex = (lightboxIndex <= 0) ? (currentFilteredCards.length - 1) : (lightboxIndex - 1);
        showLightboxSlide();
    };

    window[uid + '_lightboxNext'] = function(e) {
        if (e) e.stopPropagation();
        if (currentFilteredCards.length === 0) return;
        lightboxIndex = (lightboxIndex >= currentFilteredCards.length - 1) ? 0 : (lightboxIndex + 1);
        showLightboxSlide();
    };

    // Keyboard navigation (Esc, ArrowLeft, ArrowRight)
    window.addEventListener('keydown', function(e) {
        var lb = document.getElementById(uid + '_lightbox');
        if (!lb || lb.style.display === 'none') return;
        if (e.key === 'Escape') {
            window[uid + '_closeLightboxDirect']();
        } else if (e.key === 'ArrowLeft') {
            window[uid + '_lightboxPrev']();
        } else if (e.key === 'ArrowRight') {
            window[uid + '_lightboxNext']();
        }
    });

    // Touch Swipe handling for mobile
    var touchStartX = null;
    container.addEventListener('touchstart', function(e) {
        touchStartX = e.touches[0].clientX;
    }, { passive: true });

    container.addEventListener('touchend', function(e) {
        if (touchStartX === null) return;
        var touchEndX = e.changedTouches[0].clientX;
        var diff = touchStartX - touchEndX;
        if (diff > 45) {
            window[uid + '_next']();
        } else if (diff < -45) {
            window[uid + '_prev']();
        }
        touchStartX = null;
    }, { passive: true });

    // Initialize layout
    window.addEventListener('resize', layoutCarousel);
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', layoutCarousel);
    } else {
        setTimeout(layoutCarousel, 50);
    }
})();
</script>
@endif
