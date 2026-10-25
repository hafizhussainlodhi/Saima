<section id="contact" aria-label="Contact Us and Request Callback" class="contactSection">
    @php
        $contactBg = page_section('contact', 'bg_image', '/images/form image.jpg');
        if ($contactBg && !str_starts_with($contactBg, 'http') && !str_starts_with($contactBg, '/')) {
            $contactBg = asset($contactBg);
        }
    @endphp
    <!-- Full Background Image -->
    <div class="contactBgImageWrapper">
        <img src="{{ $contactBg }}" alt="Hudayriyat Island Waterfront Destination" class="contactBgImage">
        <div class="contactOverlay"></div>
    </div>

    <div class="container contactContainerContent">
        <div class="contactGrid">
            <!-- Left: Text Info -->
            <div class="contactTextCol">
                <span class="contactPreTitle">{{ page_section('contact', 'pretitle', "LET'S CONNECT") }}</span>
                <h2 class="contactMainTitle">{{ page_section('contact', 'heading', 'Invest in Your Future') }}</h2>
                <p class="contactMainSubtitle">
                    {{ page_section('contact', 'subtitle', 'Discover exceptional residential villas, waterfront mansions, and prime plots across Hudayriyat Island. Connect with our dedicated property advisory team for personalized guidance and private viewings.') }}
                </p>
            </div>

            <!-- Right: Form Card -->
            <div class="contactFormCol">
                <div class="contactFormCard">
                    <p class="contactTitleSmall">{{ page_section('contact', 'form_small', 'REQUEST') }}</p>
                    <div class="contactTitleLarge">{{ page_section('contact', 'form_large', 'A CALL BACK') }}</div>

                    <form id="contactLeadForm" class="contactForm" aria-label="Contact Form">
                        <div class="formGroup">
                            <input type="text" name="name" required placeholder="Full Name" class="inputField">
                        </div>
                        <div class="formGroup">
                            <input type="email" name="email" required placeholder="E-mail" class="inputField">
                        </div>
                        <div class="formGroup">
                            <div class="phoneUnifiedContainer">
                                <div class="countryTriggerWrapper">
                                    <button type="button" class="countryTriggerBtn" id="contactCountryBtn" aria-label="Country selector">
                                        <span class="flagSlot" id="contactFlagSlot">
                                            <svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg">
                                                <rect width="24" height="5.33" fill="#00732f"/>
                                                <rect y="5.33" width="24" height="5.33" fill="#ffffff"/>
                                                <rect y="10.66" width="24" height="5.34" fill="#000000"/>
                                                <rect width="6" height="16" fill="#fe0000"/>
                                            </svg>
                                        </span>
                                        <span class="caretDown"></span>
                                    </button>
                                    <ul class="countryDropdownMenu" id="contactCountryDropdown" style="display: none;"></ul>
                                </div>
                                <input type="tel" name="phone" id="contactPhoneInput" class="phoneInputField" value="+971 " required>
                            </div>
                        </div>
                        <button type="submit" class="submitBtn">{{ page_section('contact', 'submit_button', 'REQUEST NOW') }}</button>
                    </form>

                    <div id="contactSuccessMsg" class="contactSuccessMsg" style="display: none; margin-top: 14px;">
                        ✓ Thank you! Your request has been received. Our advisory team will contact you shortly.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof setupPhoneSelector === 'function') {
            setupPhoneSelector('contactCountryBtn', 'contactCountryDropdown', 'contactFlagSlot', 'contactPhoneInput');
        }
    });

    const contactForm = document.getElementById('contactLeadForm');
    contactForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(contactForm);
        const submitBtn = contactForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'SUBMITTING...';

        try {
            await fetch('/api/leads', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    name: formData.get('name'),
                    email: formData.get('email'),
                    phone: formData.get('phone'),
                    project: 'Hudayriyat Island',
                    developer: 'Modon Properties',
                    activity_description: 'General Contact Section Call Back Request'
                })
            });

            document.getElementById('contactSuccessMsg').style.display = 'block';
            contactForm.reset();
            if (window._activeCountry) {
                document.getElementById('contactPhoneInput').value = window._activeCountry.dial + ' ';
            } else {
                document.getElementById('contactPhoneInput').value = '+971 ';
            }
            setTimeout(() => {
                document.getElementById('contactSuccessMsg').style.display = 'none';
            }, 5000);
        } catch (err) {
            console.error(err);
            document.getElementById('contactSuccessMsg').style.display = 'block';
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'REQUEST NOW';
        }
    });
</script>