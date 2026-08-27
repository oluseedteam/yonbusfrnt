{{-- Google Website Translation Engine & Cookie Controller --}}
<div id="google_translate_element" style="display: none !important;"></div>

<style>
    /* Clean Seamless Styling - Completely Hide Google Translate Top Bar & Tooltips */
    .goog-te-banner-frame,
    .goog-te-banner-frame.skiptranslate,
    iframe.goog-te-banner-frame,
    iframe.skiptranslate,
    iframe[id^=":"]:not([id*="recaptcha"]),
    iframe[src*="translate.googleapis.com"],
    iframe[src*="translate.google.com"],
    .goog-te-banner,
    .goog-te-gadget,
    .goog-te-gadget-icon,
    .goog-te-gadget-simple,
    .goog-te-menu-value,
    .goog-te-menu-frame,
    .goog-te-balloon-frame,
    .goog-tooltip,
    .goog-tooltip:hover,
    #goog-gt-tt,
    #goog-gt-vt,
    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf,
    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf-ti6hGc,
    .VIpgJd-ZVi9od-OR9G1-bStiqf,
    .VIpgJd-ZVi9od-vH1Gmf,
    .VIpgJd-y6EKec,
    body > .skiptranslate:not(#google_translate_element) {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        width: 0 !important;
        max-height: 0 !important;
        max-width: 0 !important;
        pointer-events: none !important;
        position: absolute !important;
        top: -9999px !important;
        left: -9999px !important;
        z-index: -9999 !important;
    }

    html {
        top: 0px !important;
        position: static !important;
        height: 100% !important;
    }

    body {
        top: 0px !important;
        position: static !important;
        margin-top: 0px !important;
        transform: none !important;
    }

    .goog-text-highlight {
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
    }

    #google_translate_element {
        display: none !important;
        visibility: hidden !important;
    }

    font[style] {
        background: transparent !important;
        box-shadow: none !important;
    }

    .notranslate {
        translate: no;
    }
</style>

<script type="text/javascript">
    // 1. Pre-init: Sync language preference cookie before engine loads
    (function() {
        try {
            var saved = localStorage.getItem('yonbus_lang');
            if (saved === 'fr') {
                var d = window.location.hostname;
                document.cookie = 'googtrans=/en/fr; path=/;';
                document.cookie = 'googtrans=/en/fr; path=/; domain=' + d + ';';
                var parts = d.split('.');
                if (parts.length > 1) {
                    var rootD = '.' + parts.slice(-2).join('.');
                    document.cookie = 'googtrans=/en/fr; path=/; domain=' + rootD + ';';
                }
            }
        } catch(e) {}
    })();

    // 2. Google Translate Element Init Callback
    function googleTranslateElementInit() {
        try {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,fr',
                autoDisplay: false,
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        } catch(e) {
            console.warn('Google Translate initialization:', e);
        }
    }

    // 3. Helper functions for cookie manipulation
    function setYonbusCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        var d = window.location.hostname;
        document.cookie = name + "=" + (value || "") + expires + "; path=/;";
        document.cookie = name + "=" + (value || "") + expires + "; path=/; domain=" + d + ";";
        var parts = d.split('.');
        if (parts.length > 1) {
            var rootD = '.' + parts.slice(-2).join('.');
            document.cookie = name + "=" + (value || "") + expires + "; path=/; domain=" + rootD + ";";
        }
    }

    function deleteYonbusCookie(name) {
        var d = window.location.hostname;
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + d + ';';
        document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.' + d + ';';
        var parts = d.split('.');
        if (parts.length > 1) {
            var rootD = '.' + parts.slice(-2).join('.');
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + rootD + ';';
        }
    }

    // 4. Global Language Switch Function
    window.switchYonbusLanguage = function(targetLang) {
        var current = localStorage.getItem('yonbus_lang') || 'en';
        localStorage.setItem('yonbus_lang', targetLang);

        if (targetLang === 'fr') {
            setYonbusCookie('googtrans', '/en/fr', 365);
        } else {
            setYonbusCookie('googtrans', '/en/en', 365);
            deleteYonbusCookie('googtrans');
        }

        // Update all switcher buttons in the DOM
        updateSwitcherUI(targetLang);

        // Dispatch select event to Google Translate combo box if present
        var combo = document.querySelector('.goog-te-combo');
        if (combo) {
            combo.value = targetLang;
            combo.dispatchEvent(new Event('change'));
        } else {
            window.location.reload();
        }
    };

    function updateSwitcherUI(lang) {
        document.querySelectorAll('.yonbus-lang-btn').forEach(function(btn) {
            var btnLang = btn.getAttribute('data-lang');
            if (btnLang === lang) {
                btn.classList.add('bg-[#0052FF]', 'text-white', 'shadow-sm');
                btn.classList.remove('text-slate-600', 'dark:text-slate-300', 'text-slate-400');
            } else {
                btn.classList.remove('bg-[#0052FF]', 'text-white', 'shadow-sm');
                btn.classList.add('text-slate-600', 'dark:text-slate-300');
            }
        });
    }

    // 5. DOM Ready UI State Synchronizer
    document.addEventListener('DOMContentLoaded', function() {
        var current = localStorage.getItem('yonbus_lang') || (document.cookie.indexOf('/en/fr') !== -1 ? 'fr' : 'en');
        updateSwitcherUI(current);

        // Fallback check after Google Translate script loads
        var attempts = 0;
        var checkCombo = setInterval(function() {
            attempts++;
            var combo = document.querySelector('.goog-te-combo');
            if (combo) {
                clearInterval(checkCombo);
                if (current === 'fr' && combo.value !== 'fr') {
                    combo.value = 'fr';
                    combo.dispatchEvent(new Event('change'));
                }
            }
            if (attempts > 30) clearInterval(checkCombo);
        }, 200);
    });

    // 6. Aggressive Cleanup of Google Translate Top Bar & Body Offset
    function cleanGoogleTranslateBanner() {
        try {
            if (document.body) {
                if (document.body.style.top && document.body.style.top !== '0px') {
                    document.body.style.setProperty('top', '0px', 'important');
                }
                if (document.body.style.position && document.body.style.position !== 'static') {
                    document.body.style.setProperty('position', 'static', 'important');
                }
                if (document.body.style.marginTop && document.body.style.marginTop !== '0px') {
                    document.body.style.setProperty('margin-top', '0px', 'important');
                }
            }
            if (document.documentElement) {
                if (document.documentElement.style.top && document.documentElement.style.top !== '0px') {
                    document.documentElement.style.setProperty('top', '0px', 'important');
                }
            }

            var frames = document.querySelectorAll('iframe.goog-te-banner-frame, iframe.skiptranslate, iframe[src*="translate.google"], .goog-te-banner-frame, .VIpgJd-ZVi9od-OR9G1-bStiqf, .VIpgJd-ZVi9od-aZ2wEe-wOHMyf');
            frames.forEach(function(f) {
                f.style.setProperty('display', 'none', 'important');
                f.style.setProperty('visibility', 'hidden', 'important');
                f.style.setProperty('height', '0px', 'important');
                f.style.setProperty('width', '0px', 'important');
                f.style.setProperty('top', '-9999px', 'important');
                f.style.setProperty('position', 'absolute', 'important');
            });

            var skipDivs = document.querySelectorAll('body > .skiptranslate');
            skipDivs.forEach(function(el) {
                if (el.id !== 'google_translate_element' && !el.querySelector('.goog-te-combo')) {
                    el.style.setProperty('display', 'none', 'important');
                }
            });
        } catch(e) {}
    }

    setInterval(cleanGoogleTranslateBanner, 50);

    if (window.MutationObserver) {
        var observer = new MutationObserver(function() {
            cleanGoogleTranslateBanner();
        });
        document.addEventListener('DOMContentLoaded', function() {
            observer.observe(document.documentElement, {
                attributes: true,
                childList: true,
                subtree: true,
                attributeFilter: ['style', 'class']
            });
        });
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
