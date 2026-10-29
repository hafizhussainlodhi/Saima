/**
 * Hudayriyat Community Pages Client Interactions
 * Port 3000 Dicto Parity: Gallery Slider, Tabs, Lightbox, Hero Slider, Accordions, Modals, Forms
 */
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    initStandardGallery();
    initStickyHeader();
    initCommunitiesDropdown();
    initHeroSlider();
    initPaymentPlan();
    initFloorPlans();
    initAccordions();
    initModals();
    initLeadForms();
    initCommunityPhoneSelectors();
  });

  // ========================================================================
  // 1. Standard Project Gallery Carousel & Lightbox (Port 3000 Parity)
  // ========================================================================
  function initStandardGallery() {
    var galleries = document.querySelectorAll('section[id="gallery"], section[class*="gallerySection"]');
    
    galleries.forEach(function(gallery) {
      var carouselContainer = gallery.querySelector('div[class*="carouselContainer"]');
      if (!carouselContainer) return;

      var track = carouselContainer.querySelector('div[class*="track"]');
      if (!track) return;

      var prevBtn = carouselContainer.querySelector('button[aria-label="Previous image"], button[class*="prevBtn"]');
      var nextBtn = carouselContainer.querySelector('button[aria-label="Next image"], button[class*="nextBtn"]');
      var dotsWrapper = gallery.querySelector('div[class*="dotsWrapper"]');
      var tabBtns = gallery.querySelectorAll('button[class*="tabBtn"]');
      
      var allCards = Array.from(track.querySelectorAll('div[class*="card"]'));
      if (allCards.length === 0) return;

      var currentIndex = 0;
      var activeCards = allCards.slice(); // initially all cards

      function updateDimensionsAndPosition() {
        var viewportWidth = carouselContainer.offsetWidth || window.innerWidth;
        var isDesktop = viewportWidth >= 992;
        var gap = isDesktop ? 24 : 16;
        var itemsInCenter = isDesktop ? 2 : 1;

        // Max card width 600px, aspect-ratio 600/400 (height = 400px when width = 600px)
        var cardWidth = isDesktop
          ? Math.min(600, Math.max(300, (viewportWidth - gap - 80) / 2))
          : Math.min(600, viewportWidth - 64);
        var cardHeight = Math.round(cardWidth * (400 / 600));

        var visibleWidth = itemsInCenter * cardWidth + (itemsInCenter - 1) * gap;
        var centerOffset = (viewportWidth - visibleWidth) / 2;
        var slideStep = cardWidth + gap;

        allCards.forEach(function(c) {
          c.style.setProperty('width', cardWidth + 'px', 'important');
          c.style.setProperty('height', cardHeight + 'px', 'important');
          c.style.setProperty('flex-shrink', '0', 'important');
        });

        track.style.setProperty('gap', gap + 'px', 'important');
        track.style.setProperty('display', 'flex', 'important');
        track.style.setProperty('align-items', 'center', 'important');
        track.style.setProperty('transition', 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)', 'important');
        
        var translateX = centerOffset - (currentIndex * slideStep);
        track.style.setProperty('transform', 'translateX(' + translateX + 'px)', 'important');

        updateDots();
      }

      function updateDots() {
        if (!dotsWrapper) return;
        var dots = dotsWrapper.querySelectorAll('button');
        dots.forEach(function(dot, idx) {
          if (idx === currentIndex) {
            dot.classList.add('StandardProjectGallery-module__MeUPXW__dotActive');
            dot.style.setProperty('background-color', '#b37748', 'important');
            dot.style.setProperty('border-color', '#b37748', 'important');
            dot.style.setProperty('transform', 'scale(1.15)', 'important');
          } else {
            dot.classList.remove('StandardProjectGallery-module__MeUPXW__dotActive');
            dot.style.setProperty('background-color', 'transparent', 'important');
            dot.style.setProperty('border-color', '#cbb8a7', 'important');
            dot.style.setProperty('transform', 'scale(1)', 'important');
          }
        });
      }

      var maxIndex = Math.max(0, activeCards.length - 1);

      function handlePrev() {
        currentIndex = (currentIndex <= 0) ? maxIndex : currentIndex - 1;
        updateDimensionsAndPosition();
      }

      function handleNext() {
        currentIndex = (currentIndex >= maxIndex) ? 0 : currentIndex + 1;
        updateDimensionsAndPosition();
      }

      // Next / Prev Button Clicks
      if (prevBtn) {
        prevBtn.onclick = function(e) {
          e.preventDefault();
          e.stopPropagation();
          handlePrev();
        };
      }

      if (nextBtn) {
        nextBtn.onclick = function(e) {
          e.preventDefault();
          e.stopPropagation();
          handleNext();
        };
      }

      // Dots Clicks
      if (dotsWrapper) {
        var dots = dotsWrapper.querySelectorAll('button');
        dots.forEach(function(dot, idx) {
          dot.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            currentIndex = idx;
            updateDimensionsAndPosition();
          };
        });
      }

      // Category Tabs
      tabBtns.forEach(function(tab) {
        tab.onclick = function(e) {
          e.preventDefault();
          tabBtns.forEach(function(t) { 
            t.classList.remove('StandardProjectGallery-module__MeUPXW__tabActive'); 
            t.style.borderBottom = '2px solid transparent';
            t.style.color = '#666666';
          });
          tab.classList.add('StandardProjectGallery-module__MeUPXW__tabActive');
          tab.style.borderBottom = '2px solid #b37748';
          tab.style.color = '#b37748';

          var selectedCat = tab.innerText.trim().toUpperCase();
          if (selectedCat === 'ALL') {
            activeCards = allCards.slice();
            allCards.forEach(function(c) { c.style.display = 'block'; });
          } else {
            activeCards = [];
            allCards.forEach(function(c) {
              var alt = (c.querySelector('img') ? c.querySelector('img').getAttribute('alt') || '' : '').toUpperCase();
              var isMatch = alt.indexOf(selectedCat) !== -1 || selectedCat === 'EXTERIOR' || selectedCat === 'INTERIOR';
              c.style.display = 'block';
              activeCards.push(c);
            });
          }

          maxIndex = Math.max(0, activeCards.length - 1);
          currentIndex = 0;
          updateDimensionsAndPosition();
        };
      });

      // Touch Swipe on Carousel
      var touchStartX = null;
      var touchEndX = null;

      carouselContainer.addEventListener('touchstart', function(e) {
        touchStartX = e.targetTouches[0].clientX;
      }, { passive: true });

      carouselContainer.addEventListener('touchmove', function(e) {
        touchEndX = e.targetTouches[0].clientX;
      }, { passive: true });

      carouselContainer.addEventListener('touchend', function() {
        if (touchStartX === null || touchEndX === null) return;
        var diff = touchStartX - touchEndX;
        if (diff > 45) {
          handleNext();
        } else if (diff < -45) {
          handlePrev();
        }
        touchStartX = null;
        touchEndX = null;
      });

      // Card Click -> Fullscreen Lightbox Modal
      allCards.forEach(function(card, idx) {
        card.style.cursor = 'pointer';
        card.onclick = function(e) {
          e.preventDefault();
          openLightbox(activeCards, idx);
        };
      });

      // Window resize and load listeners
      window.addEventListener('resize', updateDimensionsAndPosition);
      window.addEventListener('load', updateDimensionsAndPosition);

      // Initial position executions
      updateDimensionsAndPosition();
      setTimeout(updateDimensionsAndPosition, 50);
      setTimeout(updateDimensionsAndPosition, 200);
    });
  }

  // ========================================================================
  // Lightbox Modal Implementation (Port 3000 Parity)
  // ========================================================================
  function openLightbox(cards, startIndex) {
    var lightbox = document.getElementById('communityGalleryLightbox');
    if (!lightbox) {
      lightbox = document.createElement('div');
      lightbox.id = 'communityGalleryLightbox';
      lightbox.innerHTML = `
        <div style="position: fixed; inset: 0; background-color: rgba(12, 10, 8, 0.94); backdrop-filter: blur(8px); z-index: 999999; display: flex; align-items: center; justify-content: center; padding: 20px;" class="lbOverlay">
          <button type="button" class="lbClose" style="position: absolute; top: 24px; right: 24px; background: rgba(255, 255, 255, 0.15); border: none; color: #ffffff; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; z-index: 100001;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          </button>
          <button type="button" class="lbPrev" style="position: absolute; top: 50%; left: 24px; transform: translateY(-50%); background: rgba(255, 255, 255, 0.15); border: none; color: #ffffff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; z-index: 100001;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
          </button>
          <div class="lbContent" style="position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; max-width: 90vw; max-height: 88vh;">
            <div style="position: relative; width: min(85vw, 1100px); height: min(75vh, 730px); border-radius: 12px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; background: #000;">
              <img class="lbImg" src="" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
            <p class="lbCaption" style="color: #e5ded5; font-size: 14px; margin-top: 14px; text-align: center; max-width: 700px; line-height: 1.5;"></p>
          </div>
          <button type="button" class="lbNext" style="position: absolute; top: 50%; right: 24px; transform: translateY(-50%); background: rgba(255, 255, 255, 0.15); border: none; color: #ffffff; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; z-index: 100001;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
          </button>
        </div>
      `;
      document.body.appendChild(lightbox);

      // Event handlers
      lightbox.querySelector('.lbClose').addEventListener('click', closeLightbox);
      lightbox.querySelector('.lbOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
      });
      document.addEventListener('keydown', function(e) {
        if (lightbox.style.display !== 'none') {
          if (e.key === 'Escape') closeLightbox();
          if (e.key === 'ArrowLeft') showImage(curr - 1);
          if (e.key === 'ArrowRight') showImage(curr + 1);
        }
      });
    }

    var curr = startIndex;
    var lbImg = lightbox.querySelector('.lbImg');
    var lbCaption = lightbox.querySelector('.lbCaption');
    var lbPrev = lightbox.querySelector('.lbPrev');
    var lbNext = lightbox.querySelector('.lbNext');

    function showImage(idx) {
      if (idx < 0) curr = cards.length - 1;
      else if (idx >= cards.length) curr = 0;
      else curr = idx;

      var img = cards[curr].querySelector('img');
      if (img) {
        lbImg.src = img.src;
        var alt = img.getAttribute('alt') || '';
        lbCaption.innerText = (curr + 1) + ' / ' + cards.length + (alt ? ' — ' + alt : '');
      }
    }

    lbPrev.onclick = function(e) { e.stopPropagation(); showImage(curr - 1); };
    lbNext.onclick = function(e) { e.stopPropagation(); showImage(curr + 1); };

    function closeLightbox() {
      lightbox.style.display = 'none';
      document.body.style.overflow = '';
    }

    showImage(startIndex);
    lightbox.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  // ========================================================================
  // 2. Sticky Header
  // ========================================================================
  function initStickyHeader() {
    var header = document.querySelector('header');
    if (!header) return;

    window.addEventListener('scroll', function() {
      if (window.scrollY > 40) {
        header.classList.add('stickyHeader');
        header.style.backgroundColor = 'rgba(25, 25, 25, 0.95)';
        header.style.backdropFilter = 'blur(10px)';
      } else {
        header.classList.remove('stickyHeader');
        header.style.backgroundColor = '';
        header.style.backdropFilter = '';
      }
    });
  }

  // ========================================================================
  // 3. Communities Dropdown & Mobile Menu
  // ========================================================================
  function initCommunitiesDropdown() {
    // 1. Desktop Nav Projects / Communities Dropdown (Hover & Click)
    var navItems = document.querySelectorAll('li[class*="navItem"], .navItem');
    navItems.forEach(function(item) {
      var dropdown = item.querySelector('div[class*="dropdownMenu"], div[class*="DropdownMenu"], ul[class*="dropdown"], div[class*="dropdown"]');
      var btn = item.querySelector('button');
      if (!dropdown || !btn) return;

      var btnText = (btn.innerText || '').toUpperCase();
      if (btnText.includes('PROJECT') || btnText.includes('COMMUNIT')) {
        function showDropdown() {
          dropdown.classList.add('dropdownOpen');
        }

        function hideDropdown() {
          dropdown.classList.remove('dropdownOpen');
        }

        // Hover for Desktop
        item.addEventListener('mouseenter', showDropdown);
        item.addEventListener('mouseleave', hideDropdown);

        // Click to toggle on touch/click
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          dropdown.classList.toggle('dropdownOpen');
        });
      }
    });

    // Close on click outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('li[class*="navItem"], .navItem')) {
        document.querySelectorAll('div[class*="dropdownMenu"], div[class*="DropdownMenu"], .dropdownMenu').forEach(function(d) {
          d.classList.remove('dropdownOpen');
        });
      }
    });

    // 2. Mobile Navigation Drawer Controls
    var mobileToggle = document.querySelector('button[class*="mobileToggle"], #mobileMenuBtn');
    var mobileDrawer = document.querySelector('aside[class*="mobileDrawer"], div[class*="mobileDrawer"], #mobileDrawer');
    var mobileClose = document.querySelector('button[class*="mobileCloseBtn"], #mobileDrawerClose');
    var mobileOverlay = document.querySelector('div[class*="mobileDrawerOverlay"], #mobileBackdrop');

    if (mobileToggle && mobileDrawer) {
      mobileToggle.addEventListener('click', function(e) {
        e.preventDefault();
        mobileDrawer.classList.add('mobileDrawerOpen');

        // Ensure submenus start completely closed when drawer opens (pehle jesa clean look)
        var allSubmenus = mobileDrawer.querySelectorAll('.mobileSubList, div[class*="mobileSubList"], #mobileProjectsSubmenu');
        allSubmenus.forEach(function(sub) {
          sub.style.setProperty('display', 'none', 'important');
          sub.classList.remove('mobileSubListOpen');
        });
        var allChevrons = mobileDrawer.querySelectorAll('button[class*="mobileNavLink"] svg, #mobileChevronIcon');
        allChevrons.forEach(function(svg) {
          svg.style.transform = 'none';
        });

        if (mobileOverlay) mobileOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
      });
    }

    function closeMobile() {
      if (mobileDrawer) {
        mobileDrawer.classList.remove('mobileDrawerOpen');
      }
      if (mobileOverlay) mobileOverlay.style.display = 'none';
      document.body.style.overflow = '';
    }

    if (mobileClose) mobileClose.addEventListener('click', closeMobile);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobile);

    // Mobile submenu toggle: ONLY opens when user clicks the Projects button / chevron arrow
    var mobileNavBtns = document.querySelectorAll('button[class*="mobileNavLink"], button#mobileProjectsToggle');
    mobileNavBtns.forEach(function(btn) {
      var text = (btn.innerText || btn.textContent || '').trim().toUpperCase();
      if (text.includes('PROJECT')) {
        btn.style.cursor = 'pointer';

        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();

          var parentLi = btn.closest('li') || btn.parentElement;
          var sub = parentLi ? parentLi.querySelector('.mobileSubList, div[class*="mobileSubList"], #mobileProjectsSubmenu') : null;
          var svg = btn.querySelector('svg');

          if (sub) {
            var isCurrentlyOpen = (sub.classList.contains('mobileSubListOpen') || sub.style.display === 'flex');

            if (isCurrentlyOpen) {
              sub.style.setProperty('display', 'none', 'important');
              sub.classList.remove('mobileSubListOpen');
              if (svg) {
                svg.style.transform = 'none';
                svg.style.transition = 'transform 0.25s ease';
              }
            } else {
              sub.style.setProperty('display', 'flex', 'important');
              sub.classList.add('mobileSubListOpen');
              if (svg) {
                svg.style.transform = 'rotate(180deg)';
                svg.style.transition = 'transform 0.25s ease';
              }
            }
          }
        });
      }
    });
  }

  // ========================================================================
  // 4. Hero Slider Carousel
  // ========================================================================
  function initHeroSlider() {
    var heroContainers = document.querySelectorAll('section[class*="Hero"], div[class*="Hero"]');
    heroContainers.forEach(function(hero) {
      var slides = hero.querySelectorAll('div[class*="slide_"], div[class*="Slide_"]');
      if (!slides || slides.length < 2) return;

      var current = 0;
      function showSlide(idx) {
        slides.forEach(function(s, i) {
          s.style.opacity = (i === idx) ? '1' : '0';
          s.style.transition = 'opacity 0.8s ease-in-out';
          s.style.zIndex = (i === idx) ? '1' : '0';
        });
      }

      showSlide(0);

      var timer = setInterval(function() {
        current = (current + 1) % slides.length;
        showSlide(current);
      }, 6000);

      var prevBtn = hero.querySelector('button[aria-label="Previous slide"], button[class*="prevBtn"]');
      var nextBtn = hero.querySelector('button[aria-label="Next slide"], button[class*="nextBtn"]');

      if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
          e.preventDefault();
          clearInterval(timer);
          current = (current === 0) ? slides.length - 1 : current - 1;
          showSlide(current);
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
          e.preventDefault();
          clearInterval(timer);
          current = (current + 1) % slides.length;
          showSlide(current);
        });
      }
    });
  }

  // ========================================================================
  // 5. Payment Plan View Mode & Plan Select Toggle
  // ========================================================================
  function initPaymentPlan() {
    var planSections = document.querySelectorAll('section[id*="paymentplan"], section[class*="PaymentPlan"]');
    planSections.forEach(function(section) {
      var listBtn = section.querySelector('button[aria-label="List view"]');
      var gridBtn = section.querySelector('button[aria-label="Grid view"]');
      var listContainer = section.querySelector('div[class*="listView"], table, div[class*="tableWrapper"]');
      var gridContainer = section.querySelector('div[class*="gridView"], div[class*="cardsGrid"]');

      if (listBtn && gridBtn) {
        listBtn.addEventListener('click', function() {
          listBtn.classList.add('active');
          gridBtn.classList.remove('active');
          if (listContainer) listContainer.style.display = 'block';
          if (gridContainer) gridContainer.style.display = 'none';
        });

        gridBtn.addEventListener('click', function() {
          gridBtn.classList.add('active');
          listBtn.classList.remove('active');
          if (listContainer) listContainer.style.display = 'none';
          if (gridContainer) gridContainer.style.display = 'grid';
        });
      }

      var planTabs = section.querySelectorAll('div[class*="planTabs"] button, div[class*="tabsWrapper"] button');
      planTabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
          planTabs.forEach(function(t) { t.classList.remove('active'); t.style.borderBottom = ''; });
          tab.classList.add('active');
          tab.style.borderBottom = '2px solid #856d52';
        });
      });
    });
  }

  // ========================================================================
  // 6. Floor Plans Bedroom Tabs
  // ========================================================================
  function initFloorPlans() {
    var floorSections = document.querySelectorAll('section[class*="FloorPlans"], div[class*="FloorPlans"]');
    floorSections.forEach(function(sec) {
      var tabs = sec.querySelectorAll('button[class*="bedTab"], div[class*="tabs"] button');
      tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
          tabs.forEach(function(t) { t.classList.remove('active'); t.style.backgroundColor = ''; t.style.color = ''; });
          tab.classList.add('active');
          tab.style.backgroundColor = '#856d52';
          tab.style.color = '#ffffff';
        });
      });
    });
  }

  // ========================================================================
  // 7. Accordions (Location & FAQ)
  // ========================================================================
  function initAccordions() {
    var accordionItems = document.querySelectorAll('div[class*="accordionItem"], div[class*="faqItem"]');
    accordionItems.forEach(function(item) {
      if (item.classList.contains('faqItem') || (item.id && item.id.indexOf('faqItem-') === 0)) {
        return; // Handled directly by toggleFaq
      }
      var header = item.querySelector('button, div[class*="accordionHeader"], div[class*="faqQuestion"], div[class*="header"]');
      var body = item.querySelector('div[class*="accordionBody"], div[class*="faqAnswer"], div[class*="content"]');

      if (header && body) {
        header.style.cursor = 'pointer';
        header.addEventListener('click', function(e) {
          e.preventDefault();
          var isOpen = body.style.display === 'block';
          body.style.display = isOpen ? 'none' : 'block';
          var icon = header.querySelector('svg');
          if (icon) {
            icon.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            icon.style.transition = 'transform 0.3s ease';
          }
        });
      }
    });
  }

  // ========================================================================
  // 8. Modals (Brochure & List Property)
  // ========================================================================
  function initModals() {
    var brochureModal = document.querySelector('div[class*="BrochureModal"], div[id*="brochureModal"]');
    var listModal = document.querySelector('div[class*="ListPropertyModal"], div[id*="listPropertyModal"]');

    var brochureTriggers = document.querySelectorAll('button, a');
    brochureTriggers.forEach(function(btn) {
      var text = (btn.innerText || '').toLowerCase();
      if (text.includes('brochure') || text.includes('call back') || text.includes('register your interest') || text.includes('download')) {
        btn.addEventListener('click', function(e) {
          if (btn.getAttribute('type') === 'submit') return;
          e.preventDefault();
          if (brochureModal) {
            brochureModal.style.display = 'flex';
          }
        });
      }
      if (text.includes('list your property')) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          if (listModal) {
            listModal.style.display = 'flex';
          }
        });
      }
    });

    var closeButtons = document.querySelectorAll('button[class*="close"], button[aria-label="Close"], button[aria-label="Close modal"]');
    closeButtons.forEach(function(btn) {
      btn.addEventListener('click', function() {
        if (brochureModal) brochureModal.style.display = 'none';
        if (listModal) listModal.style.display = 'none';
      });
    });

    [brochureModal, listModal].forEach(function(modal) {
      if (!modal) return;
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      });
    });
  }

  // ========================================================================
  // 9. Lead Form Submissions
  // ========================================================================
  function initLeadForms() {
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalText = submitBtn ? submitBtn.innerText : 'Submit';

        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerText = 'Submitting...';
        }

        var formData = new FormData(form);
        var payload = {
          name: formData.get('name') || form.querySelector('input[name*="name"], input[placeholder*="Name"]')?.value || 'Website Visitor',
          email: formData.get('email') || form.querySelector('input[type="email"]')?.value || '',
          phone: formData.get('phone') || form.querySelector('input[type="tel"]')?.value || '',
          project: document.title.split('|')[0].trim(),
          source: window.location.pathname
        };

        var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch('/api/leads', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken || ''
          },
          body: JSON.stringify(payload)
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
          if (submitBtn) {
            submitBtn.style.backgroundColor = '#2e7d32';
            submitBtn.innerText = 'Request Sent!';
          }
          var successMsg = document.createElement('div');
          successMsg.style.color = '#2e7d32';
          successMsg.style.fontSize = '14px';
          successMsg.style.marginTop = '10px';
          successMsg.innerText = 'Thank you! An advisor will contact you shortly.';
          form.appendChild(successMsg);
          form.reset();
        })
        .catch(function(err) {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerText = originalText;
          }
        });
      });
    });
  }
})();


  
  // ========================================================================
  // 10. Auto-Detect Visitor Country & Phone Flag Sync
  // ========================================================================
  function initCommunityPhoneSelectors() {
    var containers = document.querySelectorAll('.react-international-phone-input-container');
    if (!containers.length) return;

    function applyCountry(countryCode) {
      containers.forEach(function(container) {
        var btn = container.querySelector('.react-international-phone-country-selector-button');
        var img = btn ? btn.querySelector('img.react-international-phone-flag-emoji') : null;
        var input = container.querySelector('input[type="tel"]');
        var dropdown = container.querySelector('.react-international-phone-country-selector-dropdown');
        var matchLi = dropdown ? dropdown.querySelector('li[data-country="' + countryCode.toLowerCase() + '"]') : null;

        if (matchLi && btn && img && input) {
          var matchImg = matchLi.querySelector('img');
          var dialCodeSpan = matchLi.querySelector('.react-international-phone-country-selector-dropdown__list-item-dial-code');
          var dialCode = dialCodeSpan ? dialCodeSpan.innerText.replace(/<!--[\s\S]*?-->/g, '').trim() : '';
          if (matchImg) img.src = matchImg.src;
          btn.setAttribute('data-country', countryCode.toLowerCase());
          btn.title = matchLi.getAttribute('title') || countryCode.toUpperCase();
          if (dialCode) {
            var val = input.value.trim();
            if (!val || /^\+\d+\s*$/.test(val) || val === '+971') {
              input.value = dialCode + ' ';
            }
          }
        }
      });
    }

    // Fast instant timezone detection
    var detected = 'ae';
    try {
      var tz = (Intl.DateTimeFormat().resolvedOptions().timeZone || '').toLowerCase();
      if (tz.includes('karachi') || tz.includes('pakistan')) detected = 'pk';
      else if (tz.includes('dubai') || tz.includes('abu_dhabi')) detected = 'ae';
      else if (tz.includes('riyadh')) detected = 'sa';
      else if (tz.includes('kolkata') || tz.includes('calcutta') || tz.includes('delhi')) detected = 'in';
      else if (tz.includes('london')) detected = 'gb';
      else if (tz.includes('new_york') || tz.includes('chicago') || tz.includes('los_angeles') || tz.includes('america')) detected = 'us';
      else if (tz.includes('qatar') || tz.includes('doha')) detected = 'qa';
      else if (tz.includes('kuwait')) detected = 'kw';
      else if (tz.includes('muscat')) detected = 'om';
      else if (tz.includes('bahrain')) detected = 'bh';
      else if (tz.includes('toronto') || tz.includes('vancouver')) detected = 'ca';
      else if (tz.includes('berlin') || tz.includes('frankfurt')) detected = 'de';
      else if (tz.includes('paris')) detected = 'fr';
      else if (tz.includes('istanbul')) detected = 'tr';
      else if (tz.includes('cairo')) detected = 'eg';
    } catch(e) {}

    try {
      var lang = (navigator.language || '').toLowerCase();
      if (lang.includes('-pk') || lang === 'ur') detected = 'pk';
      else if (lang.includes('-ae') || lang === 'ar-ae') detected = 'ae';
      else if (lang.includes('-sa') || lang === 'ar-sa') detected = 'sa';
      else if (lang.includes('-in') || lang === 'hi') detected = 'in';
      else if (lang.includes('-gb')) detected = 'gb';
      else if (lang.includes('-us')) detected = 'us';
    } catch(e) {}

    applyCountry(detected);

    // Confirm with IP check
    fetch('https://api.country.is')
      .then(function(r) { return r.json(); })
      .then(function(d) {
        if (d && d.country) applyCountry(d.country);
      })
      .catch(function() {
        fetch('https://ipapi.co/json/')
          .then(function(r) { return r.json(); })
          .then(function(d) {
            if (d && d.country_code) applyCountry(d.country_code);
          })
          .catch(function() {});
      });

    // Dropdown toggle & selection on click
    containers.forEach(function(container) {
      var btn = container.querySelector('.react-international-phone-country-selector-button');
      var dropdown = container.querySelector('.react-international-phone-country-selector-dropdown');
      var img = btn ? btn.querySelector('img.react-international-phone-flag-emoji') : null;
      var input = container.querySelector('input[type="tel"]');

      if (btn && dropdown) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          var isOpen = dropdown.style.display === 'block';
          dropdown.style.display = isOpen ? 'none' : 'block';
        });

        dropdown.addEventListener('click', function(e) {
          e.stopPropagation();
          var li = e.target.closest('li[data-country]');
          if (li) {
            var code = li.getAttribute('data-country');
            var matchImg = li.querySelector('img');
            var dialCodeSpan = li.querySelector('.react-international-phone-country-selector-dropdown__list-item-dial-code');
            var dial = dialCodeSpan ? dialCodeSpan.innerText.replace(/<!--[\s\S]*?-->/g, '').trim() : '';

            if (img && matchImg) img.src = matchImg.src;
            btn.setAttribute('data-country', code);
            btn.title = li.getAttribute('title') || code.toUpperCase();
            if (dial && input) {
              var rest = input.value.trim().replace(/^\+\d+\s*/, '');
              input.value = dial + ' ' + rest;
              input.focus();
            }
            dropdown.style.display = 'none';
          }
        });
      }
    });

    document.addEventListener('click', function() {
      document.querySelectorAll('.react-international-phone-country-selector-dropdown').forEach(function(d) {
        d.style.display = 'none';
      });
    });
  }
