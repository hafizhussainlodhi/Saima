@php
    $fData = footer_data();
@endphp
<footer class="footer Footer-module__S6Hkya__footer">
    <div class="container">
        <!-- Main Columns Grid -->
        <div class="footerGrid Footer-module__S6Hkya__footerGrid">
            <!-- Col 1: Brand Logo & Description -->
            <div class="brandCol Footer-module__S6Hkya__brandCol">
                <a href="/" class="logoLink Footer-module__S6Hkya__logoLink" style="text-decoration: none;">
                    <span class="footerBrandText" style="font-size: 38px; font-weight: 800; color: #ffffff; letter-spacing: 0.5px; line-height: 1.1; display: inline-block; font-family: 'Playfair Display', Georgia, serif;">{{ $fData->brand_title ?: 'Saima' }}</span>
                </a>
                <p class="brandDescription Footer-module__S6Hkya__brandDescription">
                    {{ $fData->brand_description ?: 'Hudayriyat Island trusted property advisory serving local and international buyers. We specialize in residential and investment properties, offering clear guidance, market insight, and long term value.' }}
                </p>

                @if($fData->newsletter_enabled)
                    <div style="margin-top: 18px;">
                        <h5 style="color: #ffffff; font-size: 13.5px; margin: 0 0 6px 0; font-weight: 700;">{{ $fData->newsletter_title ?: 'Subscribe to Our Newsletter' }}</h5>
                        @if($fData->newsletter_subtitle)
                            <p style="color: #9ca3af; font-size: 12px; margin: 0 0 10px 0; line-height: 1.4;">{{ $fData->newsletter_subtitle }}</p>
                        @endif
                        <form onsubmit="event.preventDefault(); alert('Thank you for subscribing!');" style="display: flex; gap: 6px; max-width: 300px;">
                            <input type="email" placeholder="Your email" required style="padding: 8px 12px; font-size: 13px; border-radius: 4px; border: 1px solid #374151; background: #1f2937; color: #ffffff; flex: 1;">
                            <button type="submit" style="background: #1a4731; color: #ffffff; border: none; padding: 8px 14px; border-radius: 4px; font-weight: 600; font-size: 13px; cursor: pointer;">Join</button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Dynamic Columns (Managed via CMS with Drag & Drop) -->
            @foreach($fData->columns ?? \App\Models\FooterSection::defaultColumns() as $cIdx => $fCol)
                <div class="{{ $loop->last ? 'contactCol' : 'linksCol' }}">
                    <h4 class="colTitle Footer-module__S6Hkya__colTitle">{{ $fCol['header'] ?? '' }}</h4>
                    <ul class="{{ $loop->last ? 'contactList Footer-module__S6Hkya__contactList' : 'linksList Footer-module__S6Hkya__linksList' }}">
                        @foreach($fCol['links'] ?? [] as $fLnk)
                            <li>
                                <a href="{{ $fLnk['url'] ?? '/' }}" class="{{ $loop->parent->last ? 'contactLink Footer-module__S6Hkya__contactLink' : 'linkItem Footer-module__S6Hkya__linkItem' }}">
                                    @if($loop->parent->last)
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="contactIcon Footer-module__S6Hkya__contactIcon">
                                            <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                        </svg>
                                    @endif
                                    <span>{{ $fLnk['label'] ?? '' }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <!-- Bottom Bar: Disclaimer & Copyright -->
        <div class="bottomBar Footer-module__S6Hkya__bottomBar">
            <p class="disclaimerText Footer-module__S6Hkya__disclaimerText">
                {{ $fData->disclaimer_text ?: 'Disclaimer: Its not official website. We inform that all property information provided on this website is for general guidance only and does not constitute a formal offer. Prices, availability, and property details may change at any time without prior notice. Images are for illustrative purposes and may not reflect actual properties. For the most accurate and up-to-date information, please contact us directly through the details provided on the website.' }}
            </p>
            <p class="copyrightText Footer-module__S6Hkya__copyrightText">
                {{ $fData->copyright_text ?: '© ' . date('Y') . ' hudayriyat-island.ae All Rights Reserved.' }}
            </p>
        </div>
    </div>
</footer>