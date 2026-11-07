// Voice search proof of concept.
//
// Uses the browser's built-in Web Speech API (SpeechRecognition) to capture
// what the customer says, convert it to text, and drop it straight into the
// existing product search box — then submits the existing search form as
// normal, so no changes were needed to SearchController or the search route.
//
// Not every browser supports this (e.g. Firefox does not). That's expected
// and is covered in cross-browser testing — the mic button is disabled with
// an explanatory title when the API genuinely doesn't exist on the browser.
//
// Cross-browser testing on a real iPhone found the mic button going
// completely unresponsive after use. Two separate causes were found:
//
// 1. A single SpeechRecognition instance was being created once and reused
//    for every click. iOS WebKit tears down the underlying AudioSession
//    fairly aggressively once a recognition session ends, and calling
//    .start() again on that same, now stale instance can silently lock up.
//    Fixed by creating a brand new instance for every attempt.
//
// 2. On Chrome for iOS specifically, microphone access is also gated by a
//    separate, OS-level app permission (Settings > Chrome > Microphone) —
//    distinct from Safari's own in-browser per-website microphone setting.
//    When that app-level permission is off, the browser reliably raises an
//    'error' event with event.error 'not-allowed' (or 'service-not-allowed'),
//    which is caught below and used to point the customer at the right
//    settings screen for whichever iOS browser they're actually using.

export function initVoiceSearch() {
    const micButton = document.getElementById('voice-search-btn');
    const searchInput = document.getElementById('site-search');
    const searchForm = searchInput ? searchInput.closest('form') : null;
    const fallbackMessage = document.getElementById('voice-search-fallback');

    if (!micButton || !searchInput || !searchForm) {
        return;
    }

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (!SpeechRecognition) {
        micButton.disabled = true;
        micButton.title = 'Voice search is not supported in this browser';
        micButton.classList.add('opacity-40', 'cursor-not-allowed');
        return;
    }

    const ua = navigator.userAgent;
    const isIOS = /iPhone|iPad|iPod/.test(ua);

    // iOS browser detection: third-party browsers on iOS are all WebKit
    // under the hood, but each tags its own name onto the user agent string,
    // so the right app name can still be given in the instructions below.
    function iosBrowserName() {
        if (/CriOS/.test(ua)) return 'Chrome';
        if (/FxiOS/.test(ua)) return 'Firefox';
        if (/EdgiOS/.test(ua)) return 'Edge';
        if (/OPiOS/.test(ua)) return 'Opera';
        return null; // Safari (or couldn't tell — fall back to Safari's own instructions)
    }

    function permissionDeniedMessage() {
        if (!isIOS) {
            return "Microphone access is blocked for this site. Check your browser's site settings, allow microphone access for this page, then refresh.";
        }

        const thirdPartyBrowser = iosBrowserName();

        if (thirdPartyBrowser) {
            return `Microphone access is blocked for this site. On your iPhone: open Settings, scroll down and tap ${thirdPartyBrowser}, then turn on Microphone. Come back and refresh this page.`;
        }

        return "Microphone access is blocked for this site. On your iPhone: open Settings, scroll down and tap Safari, tap Microphone under \"Settings for Websites\", then set it to Allow. Come back and refresh this page.";
    }

    let listening = false;

    function hideFallbackMessage() {
        if (fallbackMessage) {
            fallbackMessage.classList.add('hidden');
        }
    }

    function showFallbackMessage(text) {
        if (fallbackMessage) {
            fallbackMessage.textContent = text;
            fallbackMessage.classList.remove('hidden');
        }
    }

    function createRecognition() {
        const recognition = new SpeechRecognition();
        recognition.lang = navigator.language || 'en-US';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        recognition.addEventListener('start', () => {
            hideFallbackMessage();
        });

        recognition.addEventListener('result', (event) => {
            hideFallbackMessage();
            const transcript = event.results[0][0].transcript;
            searchInput.value = transcript;
            searchForm.submit();
        });

        recognition.addEventListener('end', () => {
            listening = false;
            micButton.classList.remove('animate-pulse');
        });

        recognition.addEventListener('error', (event) => {
            listening = false;
            micButton.classList.remove('animate-pulse');
            console.error('Voice search error:', event.error);

            if (event.error === 'not-allowed' || event.error === 'service-not-allowed') {
                showFallbackMessage(permissionDeniedMessage());
            }
        });

        return recognition;
    }

    micButton.addEventListener('click', () => {
        if (listening) {
            return;
        }
        listening = true;
        hideFallbackMessage();
        micButton.classList.add('animate-pulse');

        const recognition = createRecognition();
        recognition.start();
    });
}
