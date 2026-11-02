/**
 * Universal International Phone Selector & Dynamic Validation System
 * Hudayriyat Island - Port Parity
 * Supports 218 countries worldwide (A to Z) with live search,
 * automatic country detection (Timezone + IP), and dynamic phone validation.
 */
(function() {
    'use strict';

    const COUNTRIES = [{"name":"Afghanistan","code":"af","dial":"+93","min":7,"max":12,"placeholder":"+93 •••••••"},{"name":"Albania","code":"al","dial":"+355","min":7,"max":12,"placeholder":"+355 •••••••"},{"name":"Algeria","code":"dz","dial":"+213","min":7,"max":12,"placeholder":"+213 •••••••"},{"name":"Andorra","code":"ad","dial":"+376","min":7,"max":12,"placeholder":"+376 •••••••"},{"name":"Angola","code":"ao","dial":"+244","min":7,"max":12,"placeholder":"+244 •••••••"},{"name":"Antigua and Barbuda","code":"ag","dial":"+1268","min":7,"max":12,"placeholder":"+1268 •••••••"},{"name":"Argentina","code":"ar","dial":"+54","min":10,"max":10,"placeholder":"+54 9 11 1234-5678"},{"name":"Armenia","code":"am","dial":"+374","min":7,"max":12,"placeholder":"+374 •••••••"},{"name":"Aruba","code":"aw","dial":"+297","min":7,"max":12,"placeholder":"+297 •••••••"},{"name":"Australia","code":"au","dial":"+61","min":9,"max":9,"placeholder":"+61 412 345 678"},{"name":"Austria","code":"at","dial":"+43","min":7,"max":12,"placeholder":"+43 •••••••"},{"name":"Azerbaijan","code":"az","dial":"+994","min":7,"max":12,"placeholder":"+994 •••••••"},{"name":"Bahamas","code":"bs","dial":"+1242","min":7,"max":12,"placeholder":"+1242 •••••••"},{"name":"Bahrain","code":"bh","dial":"+973","min":8,"max":8,"placeholder":"+973 3912 3456"},{"name":"Bangladesh","code":"bd","dial":"+880","min":10,"max":10,"placeholder":"+880 1712-345678"},{"name":"Barbados","code":"bb","dial":"+1246","min":7,"max":12,"placeholder":"+1246 •••••••"},{"name":"Belarus","code":"by","dial":"+375","min":7,"max":12,"placeholder":"+375 •••••••"},{"name":"Belgium","code":"be","dial":"+32","min":7,"max":12,"placeholder":"+32 •••••••"},{"name":"Belize","code":"bz","dial":"+501","min":7,"max":12,"placeholder":"+501 •••••••"},{"name":"Benin","code":"bj","dial":"+229","min":7,"max":12,"placeholder":"+229 •••••••"},{"name":"Bhutan","code":"bt","dial":"+975","min":7,"max":12,"placeholder":"+975 •••••••"},{"name":"Bolivia","code":"bo","dial":"+591","min":7,"max":12,"placeholder":"+591 •••••••"},{"name":"Bosnia and Herzegovina","code":"ba","dial":"+387","min":7,"max":12,"placeholder":"+387 •••••••"},{"name":"Botswana","code":"bw","dial":"+267","min":7,"max":12,"placeholder":"+267 •••••••"},{"name":"Brazil","code":"br","dial":"+55","min":10,"max":11,"placeholder":"+55 11 91234-5678"},{"name":"British Indian Ocean Territory","code":"io","dial":"+246","min":7,"max":12,"placeholder":"+246 •••••••"},{"name":"Brunei","code":"bn","dial":"+673","min":7,"max":12,"placeholder":"+673 •••••••"},{"name":"Bulgaria","code":"bg","dial":"+359","min":7,"max":12,"placeholder":"+359 •••••••"},{"name":"Burkina Faso","code":"bf","dial":"+226","min":7,"max":12,"placeholder":"+226 •••••••"},{"name":"Burundi","code":"bi","dial":"+257","min":7,"max":12,"placeholder":"+257 •••••••"},{"name":"Cambodia","code":"kh","dial":"+855","min":7,"max":12,"placeholder":"+855 •••••••"},{"name":"Cameroon","code":"cm","dial":"+237","min":7,"max":12,"placeholder":"+237 •••••••"},{"name":"Canada","code":"ca","dial":"+1","min":10,"max":10,"placeholder":"+1 (555) 000-0000"},{"name":"Cape Verde","code":"cv","dial":"+238","min":7,"max":12,"placeholder":"+238 •••••••"},{"name":"Caribbean Netherlands","code":"bq","dial":"+599","min":7,"max":12,"placeholder":"+599 •••••••"},{"name":"Cayman Islands","code":"ky","dial":"+1","min":7,"max":12,"placeholder":"+1 •••••••"},{"name":"Central African Republic","code":"cf","dial":"+236","min":7,"max":12,"placeholder":"+236 •••••••"},{"name":"Chad","code":"td","dial":"+235","min":7,"max":12,"placeholder":"+235 •••••••"},{"name":"Chile","code":"cl","dial":"+56","min":9,"max":9,"placeholder":"+56 9 1234 5678"},{"name":"China","code":"cn","dial":"+86","min":11,"max":11,"placeholder":"+86 138 0000 0000"},{"name":"Colombia","code":"co","dial":"+57","min":10,"max":10,"placeholder":"+57 300 1234567"},{"name":"Comoros","code":"km","dial":"+269","min":7,"max":12,"placeholder":"+269 •••••••"},{"name":"Congo","code":"cd","dial":"+243","min":7,"max":12,"placeholder":"+243 •••••••"},{"name":"Congo","code":"cg","dial":"+242","min":7,"max":12,"placeholder":"+242 •••••••"},{"name":"Costa Rica","code":"cr","dial":"+506","min":7,"max":12,"placeholder":"+506 •••••••"},{"name":"Côte d'Ivoire","code":"ci","dial":"+225","min":7,"max":12,"placeholder":"+225 •••••••"},{"name":"Croatia","code":"hr","dial":"+385","min":7,"max":12,"placeholder":"+385 •••••••"},{"name":"Cuba","code":"cu","dial":"+53","min":7,"max":12,"placeholder":"+53 •••••••"},{"name":"Curaçao","code":"cw","dial":"+599","min":7,"max":12,"placeholder":"+599 •••••••"},{"name":"Cyprus","code":"cy","dial":"+357","min":7,"max":12,"placeholder":"+357 •••••••"},{"name":"Czech Republic","code":"cz","dial":"+420","min":7,"max":12,"placeholder":"+420 •••••••"},{"name":"Denmark","code":"dk","dial":"+45","min":7,"max":12,"placeholder":"+45 •••••••"},{"name":"Djibouti","code":"dj","dial":"+253","min":7,"max":12,"placeholder":"+253 •••••••"},{"name":"Dominica","code":"dm","dial":"+1767","min":7,"max":12,"placeholder":"+1767 •••••••"},{"name":"Dominican Republic","code":"do","dial":"+1","min":7,"max":12,"placeholder":"+1 •••••••"},{"name":"Ecuador","code":"ec","dial":"+593","min":7,"max":12,"placeholder":"+593 •••••••"},{"name":"Egypt","code":"eg","dial":"+20","min":10,"max":10,"placeholder":"+20 100 123 4567"},{"name":"El Salvador","code":"sv","dial":"+503","min":7,"max":12,"placeholder":"+503 •••••••"},{"name":"Equatorial Guinea","code":"gq","dial":"+240","min":7,"max":12,"placeholder":"+240 •••••••"},{"name":"Eritrea","code":"er","dial":"+291","min":7,"max":12,"placeholder":"+291 •••••••"},{"name":"Estonia","code":"ee","dial":"+372","min":7,"max":12,"placeholder":"+372 •••••••"},{"name":"Ethiopia","code":"et","dial":"+251","min":7,"max":12,"placeholder":"+251 •••••••"},{"name":"Faroe Islands","code":"fo","dial":"+298","min":7,"max":12,"placeholder":"+298 •••••••"},{"name":"Fiji","code":"fj","dial":"+679","min":7,"max":12,"placeholder":"+679 •••••••"},{"name":"Finland","code":"fi","dial":"+358","min":7,"max":12,"placeholder":"+358 •••••••"},{"name":"France","code":"fr","dial":"+33","min":9,"max":9,"placeholder":"+33 6 12 34 56 78"},{"name":"French Guiana","code":"gf","dial":"+594","min":7,"max":12,"placeholder":"+594 •••••••"},{"name":"French Polynesia","code":"pf","dial":"+689","min":7,"max":12,"placeholder":"+689 •••••••"},{"name":"Gabon","code":"ga","dial":"+241","min":7,"max":12,"placeholder":"+241 •••••••"},{"name":"Gambia","code":"gm","dial":"+220","min":7,"max":12,"placeholder":"+220 •••••••"},{"name":"Georgia","code":"ge","dial":"+995","min":7,"max":12,"placeholder":"+995 •••••••"},{"name":"Germany","code":"de","dial":"+49","min":10,"max":11,"placeholder":"+49 151 23456789"},{"name":"Ghana","code":"gh","dial":"+233","min":7,"max":12,"placeholder":"+233 •••••••"},{"name":"Gibraltar","code":"gi","dial":"+350","min":7,"max":12,"placeholder":"+350 •••••••"},{"name":"Greece","code":"gr","dial":"+30","min":7,"max":12,"placeholder":"+30 •••••••"},{"name":"Greenland","code":"gl","dial":"+299","min":7,"max":12,"placeholder":"+299 •••••••"},{"name":"Grenada","code":"gd","dial":"+1473","min":7,"max":12,"placeholder":"+1473 •••••••"},{"name":"Guadeloupe","code":"gp","dial":"+590","min":7,"max":12,"placeholder":"+590 •••••••"},{"name":"Guam","code":"gu","dial":"+1671","min":7,"max":12,"placeholder":"+1671 •••••••"},{"name":"Guatemala","code":"gt","dial":"+502","min":7,"max":12,"placeholder":"+502 •••••••"},{"name":"Guinea","code":"gn","dial":"+224","min":7,"max":12,"placeholder":"+224 •••••••"},{"name":"Guinea-Bissau","code":"gw","dial":"+245","min":7,"max":12,"placeholder":"+245 •••••••"},{"name":"Guyana","code":"gy","dial":"+592","min":7,"max":12,"placeholder":"+592 •••••••"},{"name":"Haiti","code":"ht","dial":"+509","min":7,"max":12,"placeholder":"+509 •••••••"},{"name":"Honduras","code":"hn","dial":"+504","min":7,"max":12,"placeholder":"+504 •••••••"},{"name":"Hong Kong","code":"hk","dial":"+852","min":7,"max":12,"placeholder":"+852 •••••••"},{"name":"Hungary","code":"hu","dial":"+36","min":7,"max":12,"placeholder":"+36 •••••••"},{"name":"Iceland","code":"is","dial":"+354","min":7,"max":12,"placeholder":"+354 •••••••"},{"name":"India","code":"in","dial":"+91","min":10,"max":10,"placeholder":"+91 98765 43210"},{"name":"Indonesia","code":"id","dial":"+62","min":10,"max":12,"placeholder":"+62 812-3456-7890"},{"name":"Iran","code":"ir","dial":"+98","min":7,"max":12,"placeholder":"+98 •••••••"},{"name":"Iraq","code":"iq","dial":"+964","min":7,"max":12,"placeholder":"+964 •••••••"},{"name":"Ireland","code":"ie","dial":"+353","min":7,"max":12,"placeholder":"+353 •••••••"},{"name":"Israel","code":"il","dial":"+972","min":7,"max":12,"placeholder":"+972 •••••••"},{"name":"Italy","code":"it","dial":"+39","min":9,"max":10,"placeholder":"+39 312 345 6789"},{"name":"Jamaica","code":"jm","dial":"+1876","min":7,"max":12,"placeholder":"+1876 •••••••"},{"name":"Japan","code":"jp","dial":"+81","min":10,"max":10,"placeholder":"+81 90 1234 5678"},{"name":"Jordan","code":"jo","dial":"+962","min":7,"max":12,"placeholder":"+962 •••••••"},{"name":"Kazakhstan","code":"kz","dial":"+7","min":7,"max":12,"placeholder":"+7 •••••••"},{"name":"Kenya","code":"ke","dial":"+254","min":9,"max":9,"placeholder":"+254 712 345678"},{"name":"Kiribati","code":"ki","dial":"+686","min":7,"max":12,"placeholder":"+686 •••••••"},{"name":"Kosovo","code":"xk","dial":"+383","min":7,"max":12,"placeholder":"+383 •••••••"},{"name":"Kuwait","code":"kw","dial":"+965","min":8,"max":8,"placeholder":"+965 9123 4567"},{"name":"Kyrgyzstan","code":"kg","dial":"+996","min":7,"max":12,"placeholder":"+996 •••••••"},{"name":"Laos","code":"la","dial":"+856","min":7,"max":12,"placeholder":"+856 •••••••"},{"name":"Latvia","code":"lv","dial":"+371","min":7,"max":12,"placeholder":"+371 •••••••"},{"name":"Lebanon","code":"lb","dial":"+961","min":7,"max":12,"placeholder":"+961 •••••••"},{"name":"Lesotho","code":"ls","dial":"+266","min":7,"max":12,"placeholder":"+266 •••••••"},{"name":"Liberia","code":"lr","dial":"+231","min":7,"max":12,"placeholder":"+231 •••••••"},{"name":"Libya","code":"ly","dial":"+218","min":7,"max":12,"placeholder":"+218 •••••••"},{"name":"Liechtenstein","code":"li","dial":"+423","min":7,"max":12,"placeholder":"+423 •••••••"},{"name":"Lithuania","code":"lt","dial":"+370","min":7,"max":12,"placeholder":"+370 •••••••"},{"name":"Luxembourg","code":"lu","dial":"+352","min":7,"max":12,"placeholder":"+352 •••••••"},{"name":"Macau","code":"mo","dial":"+853","min":7,"max":12,"placeholder":"+853 •••••••"},{"name":"Macedonia","code":"mk","dial":"+389","min":7,"max":12,"placeholder":"+389 •••••••"},{"name":"Madagascar","code":"mg","dial":"+261","min":7,"max":12,"placeholder":"+261 •••••••"},{"name":"Malawi","code":"mw","dial":"+265","min":7,"max":12,"placeholder":"+265 •••••••"},{"name":"Malaysia","code":"my","dial":"+60","min":9,"max":10,"placeholder":"+60 12-345 6789"},{"name":"Maldives","code":"mv","dial":"+960","min":7,"max":12,"placeholder":"+960 •••••••"},{"name":"Mali","code":"ml","dial":"+223","min":7,"max":12,"placeholder":"+223 •••••••"},{"name":"Malta","code":"mt","dial":"+356","min":7,"max":12,"placeholder":"+356 •••••••"},{"name":"Marshall Islands","code":"mh","dial":"+692","min":7,"max":12,"placeholder":"+692 •••••••"},{"name":"Martinique","code":"mq","dial":"+596","min":7,"max":12,"placeholder":"+596 •••••••"},{"name":"Mauritania","code":"mr","dial":"+222","min":7,"max":12,"placeholder":"+222 •••••••"},{"name":"Mauritius","code":"mu","dial":"+230","min":7,"max":12,"placeholder":"+230 •••••••"},{"name":"Mayotte","code":"yt","dial":"+262","min":7,"max":12,"placeholder":"+262 •••••••"},{"name":"Mexico","code":"mx","dial":"+52","min":10,"max":10,"placeholder":"+52 55 1234 5678"},{"name":"Micronesia","code":"fm","dial":"+691","min":7,"max":12,"placeholder":"+691 •••••••"},{"name":"Moldova","code":"md","dial":"+373","min":7,"max":12,"placeholder":"+373 •••••••"},{"name":"Monaco","code":"mc","dial":"+377","min":7,"max":12,"placeholder":"+377 •••••••"},{"name":"Mongolia","code":"mn","dial":"+976","min":7,"max":12,"placeholder":"+976 •••••••"},{"name":"Montenegro","code":"me","dial":"+382","min":7,"max":12,"placeholder":"+382 •••••••"},{"name":"Morocco","code":"ma","dial":"+212","min":7,"max":12,"placeholder":"+212 •••••••"},{"name":"Mozambique","code":"mz","dial":"+258","min":7,"max":12,"placeholder":"+258 •••••••"},{"name":"Myanmar","code":"mm","dial":"+95","min":7,"max":12,"placeholder":"+95 •••••••"},{"name":"Namibia","code":"na","dial":"+264","min":7,"max":12,"placeholder":"+264 •••••••"},{"name":"Nauru","code":"nr","dial":"+674","min":7,"max":12,"placeholder":"+674 •••••••"},{"name":"Nepal","code":"np","dial":"+977","min":7,"max":12,"placeholder":"+977 •••••••"},{"name":"Netherlands","code":"nl","dial":"+31","min":7,"max":12,"placeholder":"+31 •••••••"},{"name":"New Caledonia","code":"nc","dial":"+687","min":7,"max":12,"placeholder":"+687 •••••••"},{"name":"New Zealand","code":"nz","dial":"+64","min":8,"max":10,"placeholder":"+64 21 123 4567"},{"name":"Nicaragua","code":"ni","dial":"+505","min":7,"max":12,"placeholder":"+505 •••••••"},{"name":"Niger","code":"ne","dial":"+227","min":7,"max":12,"placeholder":"+227 •••••••"},{"name":"Nigeria","code":"ng","dial":"+234","min":10,"max":10,"placeholder":"+234 802 123 4567"},{"name":"North Korea","code":"kp","dial":"+850","min":7,"max":12,"placeholder":"+850 •••••••"},{"name":"Norway","code":"no","dial":"+47","min":7,"max":12,"placeholder":"+47 •••••••"},{"name":"Oman","code":"om","dial":"+968","min":8,"max":8,"placeholder":"+968 9123 4567"},{"name":"Pakistan","code":"pk","dial":"+92","min":10,"max":10,"placeholder":"+92 300 1234567"},{"name":"Palau","code":"pw","dial":"+680","min":7,"max":12,"placeholder":"+680 •••••••"},{"name":"Palestine","code":"ps","dial":"+970","min":7,"max":12,"placeholder":"+970 •••••••"},{"name":"Panama","code":"pa","dial":"+507","min":7,"max":12,"placeholder":"+507 •••••••"},{"name":"Papua New Guinea","code":"pg","dial":"+675","min":7,"max":12,"placeholder":"+675 •••••••"},{"name":"Paraguay","code":"py","dial":"+595","min":7,"max":12,"placeholder":"+595 •••••••"},{"name":"Peru","code":"pe","dial":"+51","min":7,"max":12,"placeholder":"+51 •••••••"},{"name":"Philippines","code":"ph","dial":"+63","min":10,"max":10,"placeholder":"+63 917 123 4567"},{"name":"Poland","code":"pl","dial":"+48","min":7,"max":12,"placeholder":"+48 •••••••"},{"name":"Portugal","code":"pt","dial":"+351","min":7,"max":12,"placeholder":"+351 •••••••"},{"name":"Puerto Rico","code":"pr","dial":"+1","min":7,"max":12,"placeholder":"+1 •••••••"},{"name":"Qatar","code":"qa","dial":"+974","min":8,"max":8,"placeholder":"+974 5512 3456"},{"name":"Réunion","code":"re","dial":"+262","min":7,"max":12,"placeholder":"+262 •••••••"},{"name":"Romania","code":"ro","dial":"+40","min":7,"max":12,"placeholder":"+40 •••••••"},{"name":"Russia","code":"ru","dial":"+7","min":10,"max":10,"placeholder":"+7 912 345-67-89"},{"name":"Rwanda","code":"rw","dial":"+250","min":7,"max":12,"placeholder":"+250 •••••••"},{"name":"Saint Kitts and Nevis","code":"kn","dial":"+1869","min":7,"max":12,"placeholder":"+1869 •••••••"},{"name":"Saint Lucia","code":"lc","dial":"+1758","min":7,"max":12,"placeholder":"+1758 •••••••"},{"name":"Saint Pierre & Miquelon","code":"pm","dial":"+508","min":7,"max":12,"placeholder":"+508 •••••••"},{"name":"Saint Vincent and the Grenadines","code":"vc","dial":"+1784","min":7,"max":12,"placeholder":"+1784 •••••••"},{"name":"Samoa","code":"ws","dial":"+685","min":7,"max":12,"placeholder":"+685 •••••••"},{"name":"San Marino","code":"sm","dial":"+378","min":7,"max":12,"placeholder":"+378 •••••••"},{"name":"São Tomé and Príncipe","code":"st","dial":"+239","min":7,"max":12,"placeholder":"+239 •••••••"},{"name":"Saudi Arabia","code":"sa","dial":"+966","min":9,"max":9,"placeholder":"+966 50 123 4567"},{"name":"Senegal","code":"sn","dial":"+221","min":7,"max":12,"placeholder":"+221 •••••••"},{"name":"Serbia","code":"rs","dial":"+381","min":7,"max":12,"placeholder":"+381 •••••••"},{"name":"Seychelles","code":"sc","dial":"+248","min":7,"max":12,"placeholder":"+248 •••••••"},{"name":"Sierra Leone","code":"sl","dial":"+232","min":7,"max":12,"placeholder":"+232 •••••••"},{"name":"Singapore","code":"sg","dial":"+65","min":8,"max":8,"placeholder":"+65 8123 4567"},{"name":"Slovakia","code":"sk","dial":"+421","min":7,"max":12,"placeholder":"+421 •••••••"},{"name":"Slovenia","code":"si","dial":"+386","min":7,"max":12,"placeholder":"+386 •••••••"},{"name":"Solomon Islands","code":"sb","dial":"+677","min":7,"max":12,"placeholder":"+677 •••••••"},{"name":"Somalia","code":"so","dial":"+252","min":7,"max":12,"placeholder":"+252 •••••••"},{"name":"South Africa","code":"za","dial":"+27","min":9,"max":9,"placeholder":"+27 82 123 4567"},{"name":"South Korea","code":"kr","dial":"+82","min":7,"max":12,"placeholder":"+82 •••••••"},{"name":"South Sudan","code":"ss","dial":"+211","min":7,"max":12,"placeholder":"+211 •••••••"},{"name":"Spain","code":"es","dial":"+34","min":9,"max":9,"placeholder":"+34 612 34 56 78"},{"name":"Sri Lanka","code":"lk","dial":"+94","min":9,"max":9,"placeholder":"+94 71 234 5678"},{"name":"Sudan","code":"sd","dial":"+249","min":7,"max":12,"placeholder":"+249 •••••••"},{"name":"Suriname","code":"sr","dial":"+597","min":7,"max":12,"placeholder":"+597 •••••••"},{"name":"Swaziland","code":"sz","dial":"+268","min":7,"max":12,"placeholder":"+268 •••••••"},{"name":"Sweden","code":"se","dial":"+46","min":7,"max":12,"placeholder":"+46 •••••••"},{"name":"Switzerland","code":"ch","dial":"+41","min":7,"max":12,"placeholder":"+41 •••••••"},{"name":"Syria","code":"sy","dial":"+963","min":7,"max":12,"placeholder":"+963 •••••••"},{"name":"Taiwan","code":"tw","dial":"+886","min":7,"max":12,"placeholder":"+886 •••••••"},{"name":"Tajikistan","code":"tj","dial":"+992","min":7,"max":12,"placeholder":"+992 •••••••"},{"name":"Tanzania","code":"tz","dial":"+255","min":7,"max":12,"placeholder":"+255 •••••••"},{"name":"Thailand","code":"th","dial":"+66","min":7,"max":12,"placeholder":"+66 •••••••"},{"name":"Timor-Leste","code":"tl","dial":"+670","min":7,"max":12,"placeholder":"+670 •••••••"},{"name":"Togo","code":"tg","dial":"+228","min":7,"max":12,"placeholder":"+228 •••••••"},{"name":"Tonga","code":"to","dial":"+676","min":7,"max":12,"placeholder":"+676 •••••••"},{"name":"Trinidad and Tobago","code":"tt","dial":"+1868","min":7,"max":12,"placeholder":"+1868 •••••••"},{"name":"Tunisia","code":"tn","dial":"+216","min":7,"max":12,"placeholder":"+216 •••••••"},{"name":"Turkey","code":"tr","dial":"+90","min":10,"max":10,"placeholder":"+90 532 123 4567"},{"name":"Turkmenistan","code":"tm","dial":"+993","min":7,"max":12,"placeholder":"+993 •••••••"},{"name":"Tuvalu","code":"tv","dial":"+688","min":7,"max":12,"placeholder":"+688 •••••••"},{"name":"Uganda","code":"ug","dial":"+256","min":7,"max":12,"placeholder":"+256 •••••••"},{"name":"Ukraine","code":"ua","dial":"+380","min":7,"max":12,"placeholder":"+380 •••••••"},{"name":"United Arab Emirates","code":"ae","dial":"+971","min":9,"max":9,"placeholder":"+971 50 123 4567"},{"name":"United Kingdom","code":"gb","dial":"+44","min":10,"max":10,"placeholder":"+44 7911 123456"},{"name":"United States","code":"us","dial":"+1","min":10,"max":10,"placeholder":"+1 (555) 000-0000"},{"name":"Uruguay","code":"uy","dial":"+598","min":7,"max":12,"placeholder":"+598 •••••••"},{"name":"Uzbekistan","code":"uz","dial":"+998","min":7,"max":12,"placeholder":"+998 •••••••"},{"name":"Vanuatu","code":"vu","dial":"+678","min":7,"max":12,"placeholder":"+678 •••••••"},{"name":"Vatican City","code":"va","dial":"+39","min":7,"max":12,"placeholder":"+39 •••••••"},{"name":"Venezuela","code":"ve","dial":"+58","min":7,"max":12,"placeholder":"+58 •••••••"},{"name":"Vietnam","code":"vn","dial":"+84","min":7,"max":12,"placeholder":"+84 •••••••"},{"name":"Wallis & Futuna","code":"wf","dial":"+681","min":7,"max":12,"placeholder":"+681 •••••••"},{"name":"Yemen","code":"ye","dial":"+967","min":7,"max":12,"placeholder":"+967 •••••••"},{"name":"Zambia","code":"zm","dial":"+260","min":7,"max":12,"placeholder":"+260 •••••••"},{"name":"Zimbabwe","code":"zw","dial":"+263","min":7,"max":12,"placeholder":"+263 •••••••"}];
    window.UNIVERSAL_PHONE_COUNTRIES = COUNTRIES;

    // Fast lookup maps
    const BY_CODE = {};
    const BY_DIAL = {};
    COUNTRIES.forEach(c => {
        BY_CODE[c.code] = c;
        if (!BY_DIAL[c.dial]) BY_DIAL[c.dial] = c;
    });

    function getFlagImg(c, size) {
        size = size || 22;
        const h = Math.round(size * 15 / 22);
        return '<img src="https://flagcdn.com/w40/' + c.code + '.png" srcset="https://flagcdn.com/w80/' + c.code + '.png 2x" width="' + size + '" height="' + h + '" alt="' + c.name + '" class="flagImgUniversal" loading="lazy" style="border-radius:2px;object-fit:cover;display:inline-block;vertical-align:middle;box-shadow:0 1px 2px rgba(0,0,0,0.18);flex-shrink:0;">';
    }

    window.getCountryByCode = function(code) {
        if (!code) return BY_CODE['ae'] || COUNTRIES[0];
        return BY_CODE[code.toLowerCase()] || BY_CODE['ae'] || COUNTRIES[0];
    };

    window._registeredPhoneInstances = window._registeredPhoneInstances || [];
    window._activeCountry = window._activeCountry || null;

    // Detect Country
    function detectInitialCountry() {
        const cached = sessionStorage.getItem('hudayriyat_user_country');
        if (cached && BY_CODE[cached.toLowerCase()]) {
            return cached.toLowerCase();
        }

        let detected = 'ae';
        try {
            const tz = (Intl.DateTimeFormat().resolvedOptions().timeZone || '').toLowerCase();
            if (tz.includes('karachi') || tz.includes('pakistan')) detected = 'pk';
            else if (tz.includes('dubai') || tz.includes('abu_dhabi')) detected = 'ae';
            else if (tz.includes('riyadh')) detected = 'sa';
            else if (tz.includes('kolkata') || tz.includes('calcutta') || tz.includes('delhi')) detected = 'in';
            else if (tz.includes('london')) detected = 'gb';
            else if (tz.includes('new_york') || tz.includes('chicago') || tz.includes('los_angeles') || tz.includes('denver') || tz.includes('phoenix') || tz.includes('america')) detected = 'us';
            else if (tz.includes('toronto') || tz.includes('vancouver') || tz.includes('montreal')) detected = 'ca';
            else if (tz.includes('qatar') || tz.includes('doha')) detected = 'qa';
            else if (tz.includes('kuwait')) detected = 'kw';
            else if (tz.includes('muscat')) detected = 'om';
            else if (tz.includes('bahrain')) detected = 'bh';
            else if (tz.includes('berlin') || tz.includes('frankfurt')) detected = 'de';
            else if (tz.includes('paris')) detected = 'fr';
            else if (tz.includes('rome') || tz.includes('milan')) detected = 'it';
            else if (tz.includes('madrid')) detected = 'es';
            else if (tz.includes('istanbul')) detected = 'tr';
            else if (tz.includes('cairo')) detected = 'eg';
            else if (tz.includes('sydney') || tz.includes('melbourne')) detected = 'au';
            else if (tz.includes('singapore')) detected = 'sg';
            else if (tz.includes('tokyo')) detected = 'jp';
            else if (tz.includes('seoul')) detected = 'kr';
            else if (tz.includes('dhaka')) detected = 'bd';
            else if (tz.includes('colombo')) detected = 'lk';
            else if (tz.includes('kuala_lumpur')) detected = 'my';
            else if (tz.includes('jakarta')) detected = 'id';
            else if (tz.includes('manila')) detected = 'ph';
            else if (tz.includes('johannesburg')) detected = 'za';
            else if (tz.includes('lagos')) detected = 'ng';
            else if (tz.includes('nairobi')) detected = 'ke';
            else if (tz.includes('sao_paulo')) detected = 'br';
            else if (tz.includes('mexico')) detected = 'mx';
        } catch(e) {}
        return detected;
    }

    // IP Geolocation Check (background fetch)
    function checkIpCountryAsync() {
        fetch('https://api.country.is')
            .then(res => res.json())
            .then(data => {
                if (data && data.country && BY_CODE[data.country.toLowerCase()]) {
                    const code = data.country.toLowerCase();
                    sessionStorage.setItem('hudayriyat_user_country', code);
                    window.setUniversalCountry(code);
                }
            })
            .catch(() => {
                fetch('https://ipapi.co/json/')
                    .then(r => r.json())
                    .then(d => {
                        if (d && d.country_code && BY_CODE[d.country_code.toLowerCase()]) {
                            const code = d.country_code.toLowerCase();
                            sessionStorage.setItem('hudayriyat_user_country', code);
                            window.setUniversalCountry(code);
                        }
                    })
                    .catch(() => {});
            });
    }

    window.setUniversalCountry = function(code) {
        const country = window.getCountryByCode(code);
        window._activeCountry = country;
        window._registeredPhoneInstances.forEach(inst => {
            inst.applyCountry(country);
        });
    };

    function createPhoneSelectorInstance(btn, dropdown, flagSlot, input) {
        if (!btn || !dropdown || !flagSlot || !input) return null;
        if (input._phoneInstance) return input._phoneInstance;

        let activeCountry = window._activeCountry || window.getCountryByCode(detectInitialCountry());

        dropdown.className = 'countryDropdownMenu universalCountryDropdown';
        dropdown.innerHTML = [
            '<div class="countrySearchWrapper">',
            '    <input type="text" class="countrySearchInput" placeholder="Search country or code (e.g. +971, UK, Pakistan)..." autocomplete="off">',
            '</div>',
            '<ul class="countryListItems">',
            COUNTRIES.map(c => 
                '<li class="countryDropdownItem" data-code="' + c.code + '" data-dial="' + c.dial + '" data-name="' + c.name.toLowerCase() + '">' +
                '    <span class="countryItemFlag">' + getFlagImg(c, 20) + '</span>' +
                '    <span class="countryItemName">' + c.name + '</span>' +
                '    <span class="countryItemDial">' + c.dial + '</span>' +
                '</li>'
            ).join(''),
            '</ul>'
        ].join('');

        const searchInput = dropdown.querySelector('.countrySearchInput');
        const listItems = dropdown.querySelectorAll('.countryDropdownItem');

        searchInput.addEventListener('input', function(e) {
            e.stopPropagation();
            const q = this.value.trim().toLowerCase();
            listItems.forEach(li => {
                const name = li.getAttribute('data-name') || '';
                const dial = li.getAttribute('data-dial') || '';
                const code = li.getAttribute('data-code') || '';
                if (!q || name.includes(q) || dial.includes(q) || code === q) {
                    li.style.display = 'flex';
                } else {
                    li.style.display = 'none';
                }
            });
        });

        searchInput.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        searchInput.addEventListener('keydown', function(e) {
            e.stopPropagation();
            if (e.key === 'Escape') {
                closeDropdown();
                btn.focus();
            }
        });

        function openDropdown() {
            document.querySelectorAll('.universalCountryDropdown, .countryDropdownMenu').forEach(d => {
                if (d !== dropdown) {
                    d.style.setProperty('display', 'none', 'important');
                    d.style.setProperty('opacity', '0', 'important');
                    d.style.setProperty('visibility', 'hidden', 'important');
                    d.classList.remove('dropdownOpen', 'isOpen');
                    if (d.parentElement) d.parentElement.style.zIndex = '';
                }
            });
            dropdown.style.setProperty('display', 'block', 'important');
            dropdown.style.setProperty('opacity', '1', 'important');
            dropdown.style.setProperty('visibility', 'visible', 'important');
            dropdown.classList.add('dropdownOpen', 'isOpen');
            if (dropdown.parentElement) {
                dropdown.parentElement.style.zIndex = '999999';
            }
            searchInput.value = '';
            listItems.forEach(li => li.style.setProperty('display', 'flex', 'important'));
            setTimeout(() => {
                try { searchInput.focus(); } catch (err) {}
            }, 60);
        }

        function closeDropdown() {
            dropdown.style.setProperty('display', 'none', 'important');
            dropdown.style.setProperty('opacity', '0', 'important');
            dropdown.style.setProperty('visibility', 'hidden', 'important');
            dropdown.classList.remove('dropdownOpen', 'isOpen');
            if (dropdown.parentElement) {
                dropdown.parentElement.style.zIndex = '';
            }
        }

        btn.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = dropdown.classList.contains('dropdownOpen') || dropdown.style.display === 'block';
            if (isOpen && dropdown.style.visibility !== 'hidden' && dropdown.style.opacity !== '0') {
                closeDropdown();
            } else {
                openDropdown();
            }
        };

        dropdown.onclick = function(e) {
            e.stopPropagation();
            const item = e.target.closest('.countryDropdownItem');
            if (item) {
                const code = item.getAttribute('data-code');
                const selected = window.getCountryByCode(code);
                if (selected) {
                    window.setUniversalCountry(selected.code);
                    input.focus();
                }
                closeDropdown();
            }
        };

        function extractNationalNumber(val, dial) {
            if (!val) return '';
            let v = val.trim();
            if (dial && v.startsWith(dial)) {
                v = v.substring(dial.length);
            } else {
                v = v.replace(/^\+\d+\s*/, '');
            }
            return v.replace(/\D/g, '');
        }

        function applyCountry(country) {
            activeCountry = country;
            flagSlot.innerHTML = getFlagImg(country, 22);
            input.setAttribute('data-country-code', country.code);
            input.setAttribute('data-dial-code', country.dial);
            input.setAttribute('placeholder', country.placeholder || (country.dial + ' ••••••••••'));

            const maxLen = country.dial.length + 1 + country.max + 3;
            input.setAttribute('maxlength', maxLen);

            let existingNational = extractNationalNumber(input.value, input.getAttribute('data-dial-code') || country.dial);
            if (existingNational.length > 1 && existingNational.startsWith('0')) {
                existingNational = existingNational.substring(1);
            }
            if (existingNational.length > country.max) {
                existingNational = existingNational.substring(0, country.max);
            }

            if (existingNational) {
                input.value = country.dial + ' ' + existingNational;
            } else {
                input.value = country.dial + ' ';
            }

            validate();
        }

        // Strictly allow only numbers on keydown
        input.addEventListener('keydown', function(e) {
            if ([8, 9, 13, 27, 37, 38, 39, 40, 46, 35, 36].includes(e.keyCode)) return;
            if ((e.ctrlKey || e.metaKey) && ['a', 'c', 'v', 'x', 'z'].includes(e.key.toLowerCase())) return;
            if (e.key === '+' && this.selectionStart === 0 && !this.value.includes('+')) return;

            if (!/^[0-9]$/.test(e.key)) {
                e.preventDefault();
            }
        });

        // Maintain dial prefix & digits only on input
        input.addEventListener('input', function(e) {
            const dial = activeCountry.dial;
            let val = this.value;

            if (!val.startsWith(dial)) {
                let digits = val.replace(/\D/g, '');
                let dialDigits = dial.replace(/\D/g, '');
                if (digits.startsWith(dialDigits)) {
                    digits = digits.substring(dialDigits.length);
                }
                val = dial + ' ' + digits;
            } else {
                let national = val.substring(dial.length).replace(/\D/g, '');
                if (national.length > activeCountry.max) {
                    national = national.substring(0, activeCountry.max);
                }
                val = dial + ' ' + national;
            }

            this.value = val;
            validate();
        });

        // Paste filter
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text') || '';
            const cleanDigits = text.replace(/\D/g, '');
            const dial = activeCountry.dial;
            let currentNational = extractNationalNumber(this.value, dial);
            let combined = (currentNational + cleanDigits).substring(0, activeCountry.max);
            this.value = dial + ' ' + combined;
            validate();
        });

        function validate() {
            const val = input.value.trim();
            const dial = activeCountry.dial;
            const national = extractNationalNumber(val, dial);
            let digits = national;
            if (digits.length > 1 && digits.startsWith('0')) {
                digits = digits.substring(1);
            }

            if (!digits.length) {
                input.setCustomValidity('Please enter a phone number.');
                return false;
            }

            if (digits.length < activeCountry.min || digits.length > activeCountry.max) {
                const req = (activeCountry.min === activeCountry.max) 
                    ? (activeCountry.min + '-digit') 
                    : (activeCountry.min + ' to ' + activeCountry.max + ' digit');
                input.setCustomValidity('Please enter a valid ' + req + ' number for ' + activeCountry.name + ' (' + activeCountry.dial + '). Currently ' + digits.length + ' digits.');
                return false;
            }

            input.setCustomValidity('');
            return true;
        }

        input.addEventListener('change', validate);

        const form = input.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!validate()) {
                    input.reportValidity();
                    input.focus();
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
            }, true);
        }

        const instance = {
            btn, dropdown, flagSlot, input,
            applyCountry: applyCountry,
            validate: validate
        };
        input._phoneInstance = instance;
        window._registeredPhoneInstances.push(instance);

        applyCountry(activeCountry);
        return instance;
    }

    // Global Backward Compatibility setupPhoneSelector
    window.setupPhoneSelector = function(btnId, dropdownId, flagSlotId, inputId) {
        const btn = document.getElementById(btnId);
        const dropdown = document.getElementById(dropdownId);
        const flagSlot = document.getElementById(flagSlotId);
        const input = document.getElementById(inputId);
        return createPhoneSelectorInstance(btn, dropdown, flagSlot, input);
    };

    // Auto-discover and upgrade any phone container on page
    window.initAllPhoneSelectors = function() {
        const pairs = [
            ['contactCountryBtn', 'contactCountryDropdown', 'contactFlagSlot', 'contactPhoneInput'],
            ['heroCountryBtn', 'heroCountryDropdown', 'heroFlagSlot', 'heroPhoneInput'],
            ['modalCountryBtn', 'modalCountryDropdown', 'modalFlagSlot', 'modalPhoneInput'],
            ['aboutCountryBtn', 'aboutCountryDropdown', 'aboutFlagSlot', 'aboutPhoneInput'],
            ['sidebarCountryBtn', 'sidebarCountryDropdown', 'sidebarFlagSlot', 'saimaPhoneInput'],
            ['pageArticleCountryBtn', 'pageArticleCountryDropdown', 'pageArticleFlagSlot', 'pageArticlePhoneInput'],
            ['blogCountryBtn', 'blogCountryDropdown', 'blogFlagSlot', 'blogPhoneInput']
        ];
        pairs.forEach(([bId, dId, fId, iId]) => {
            const b = document.getElementById(bId);
            const d = document.getElementById(dId);
            const f = document.getElementById(fId);
            const i = document.getElementById(iId);
            if (b && d && f && i) createPhoneSelectorInstance(b, d, f, i);
        });

        document.querySelectorAll('.phoneUnifiedContainer').forEach((container, idx) => {
            const btn = container.querySelector('.countryTriggerBtn');
            const dropdown = container.querySelector('.countryDropdownMenu');
            const flagSlot = container.querySelector('.flagSlot');
            const input = container.querySelector('input[type="tel"], input[name="phone"]');
            if (btn && dropdown && flagSlot && input) {
                createPhoneSelectorInstance(btn, dropdown, flagSlot, input);
            }
        });

        document.querySelectorAll('.react-international-phone-input-container').forEach((wrapper, idx) => {
            if (wrapper.dataset.universalUpgraded) return;
            wrapper.dataset.universalUpgraded = 'true';

            const originalInput = wrapper.querySelector('input[type="tel"], input');
            const originalVal = originalInput ? originalInput.value : '+971 ';

            const uid = 'autoPhone_' + idx + '_' + Math.floor(Math.random()*10000);
            const unifiedDiv = document.createElement('div');
            unifiedDiv.className = 'phoneUnifiedContainer';
            unifiedDiv.innerHTML = [
                '<div class="countryTriggerWrapper">',
                '    <button type="button" class="countryTriggerBtn" id="btn_' + uid + '" aria-label="Country selector">',
                '        <span class="flagSlot" id="flag_' + uid + '"></span>',
                '        <span class="caretDown"></span>',
                '    </button>',
                '    <ul class="countryDropdownMenu" id="drop_' + uid + '" style="display: none;"></ul>',
                '</div>',
                '<input type="tel" name="phone" id="in_' + uid + '" class="phoneInputField" value="' + originalVal + '" required>'
            ].join('');

            wrapper.replaceWith(unifiedDiv);
            const btn = document.getElementById('btn_' + uid);
            const dropdown = document.getElementById('drop_' + uid);
            const flagSlot = document.getElementById('flag_' + uid);
            const input = document.getElementById('in_' + uid);
            createPhoneSelectorInstance(btn, dropdown, flagSlot, input);
        });

        document.querySelectorAll('.saimaApptForm input[name="phone"]:not([data-universal-phone]), .saimaSidebarCol input[name="phone"]:not([data-universal-phone])').forEach((input, idx) => {
            if (input.closest('.phoneUnifiedContainer') || input._phoneInstance) return;
            input.setAttribute('data-universal-phone', 'true');
            const uid = 'saimaApptPhone_' + idx;
            const unifiedDiv = document.createElement('div');
            unifiedDiv.className = 'phoneUnifiedContainer';
            unifiedDiv.style.marginBottom = '12px';
            unifiedDiv.innerHTML = [
                '<div class="countryTriggerWrapper">',
                '    <button type="button" class="countryTriggerBtn" id="btn_' + uid + '" aria-label="Country selector">',
                '        <span class="flagSlot" id="flag_' + uid + '"></span>',
                '        <span class="caretDown"></span>',
                '    </button>',
                '    <ul class="countryDropdownMenu" id="drop_' + uid + '" style="display: none;"></ul>',
                '</div>'
            ].join('');

            input.parentNode.insertBefore(unifiedDiv, input);
            input.className = 'phoneInputField';
            input.id = 'in_' + uid;
            unifiedDiv.appendChild(input);

            const btn = document.getElementById('btn_' + uid);
            const dropdown = document.getElementById('drop_' + uid);
            const flagSlot = document.getElementById('flag_' + uid);
            createPhoneSelectorInstance(btn, dropdown, flagSlot, input);
        });
    };

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.countryTriggerWrapper') && !e.target.closest('.universalCountryDropdown')) {
            document.querySelectorAll('.universalCountryDropdown, .countryDropdownMenu').forEach(d => {
                d.style.setProperty('display', 'none', 'important');
                d.style.setProperty('opacity', '0', 'important');
                d.style.setProperty('visibility', 'hidden', 'important');
                d.classList.remove('dropdownOpen', 'isOpen');
                if (d.parentElement) d.parentElement.style.zIndex = '';
            });
        }
    });

    const initialCode = detectInitialCountry();
    window._activeCountry = window.getCountryByCode(initialCode);

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            window.initAllPhoneSelectors();
            checkIpCountryAsync();
        });
    } else {
        window.initAllPhoneSelectors();
        checkIpCountryAsync();
    }
})();
