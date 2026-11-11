@php
    $bannerHeading = \App\Models\PlatformSetting::get('cookie_banner_heading', 'Your privacy, your choice');
    $bannerText = \App\Models\PlatformSetting::get('cookie_banner_text', 'We use a few cookies to keep you signed in and understand how the site is used. You choose what we can use.');
    $cookiePolicyUrl = \App\Models\PlatformSetting::get('cookie_policy_url', route('cookies'));
    $privacyPolicyUrl = \App\Models\PlatformSetting::get('privacy_policy_url', route('privacy'));
@endphp

<div x-data="{
         bannerVisible: false,
         customizeModal: false,
         storageKey: 'global_maitri_cookie_consent',
         consent: {
             essential: true,
             analytics: false,
             marketing: false,
             timestamp: null
         },
         init() {
             try {
                 const stored = localStorage.getItem(this.storageKey);
                 if (stored) {
                     const parsed = JSON.parse(stored);
                     if (parsed && typeof parsed === 'object') {
                         this.consent = Object.assign(this.consent, parsed);
                         this.bannerVisible = false;
                         return;
                     }
                 }
             } catch(e) {}
             this.bannerVisible = true;
         },
         saveConsent(analytics, marketing) {
             this.consent = {
                 essential: true,
                 analytics: Boolean(analytics),
                 marketing: Boolean(marketing),
                 timestamp: new Date().toISOString()
             };
             try {
                 localStorage.setItem(this.storageKey, JSON.stringify(this.consent));
                 // Persist in 12-month first-party cookie
                 document.cookie = this.storageKey + '=' + encodeURIComponent(JSON.stringify(this.consent)) + ';max-age=31536000;path=/;SameSite=Lax';
             } catch(e) {}
             this.bannerVisible = false;
             this.customizeModal = false;
             window.dispatchEvent(new CustomEvent('cookie-consent-saved', { detail: this.consent }));
         },
         acceptAll() {
             this.saveConsent(true, true);
         },
         rejectNonEssential() {
             this.saveConsent(false, false);
         },
         openCustomize() {
             this.customizeModal = true;
         }
     }"
     @open-cookie-settings.window="customizeModal = true"
     x-cloak>

    <!-- Compact Bottom Banner (Desktop: small bottom-left card max 360px; Mobile: compact sheet) -->
    <div id="cookie-consent-banner"
         x-show="bannerVisible && !customizeModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-3"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-3"
         role="dialog"
         aria-labelledby="cookie-banner-title"
         aria-describedby="cookie-banner-desc"
         class="fixed inset-x-0 bottom-0 z-[100] sm:inset-x-auto sm:bottom-4 sm:left-4 sm:max-w-[360px] p-2.5 sm:p-0">
        <div class="rounded-xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-3 sm:p-3.5 shadow-xl space-y-2.5">
            <div class="flex items-start gap-2.5">
                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-[var(--accent-subtle)] text-[var(--accent-primary)] mt-0.5" aria-hidden="true">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <h2 id="cookie-banner-title" class="!font-sans !text-[13px] font-bold text-[var(--text-primary)] !leading-tight">
                        {{ $bannerHeading }}
                    </h2>
                    <p id="cookie-banner-desc" class="mt-1 !font-sans !text-[11px] leading-relaxed text-[var(--text-secondary)]">
                        {{ $bannerText }}
                        <a href="{{ $cookiePolicyUrl }}" class="font-semibold text-[var(--accent-primary)] hover:underline">Cookie Policy</a>
                        &bull;
                        <a href="{{ $privacyPolicyUrl }}" class="font-semibold text-[var(--accent-primary)] hover:underline">Privacy</a>.
                    </p>
                </div>
            </div>

            <!-- Banner Action Buttons -->
            <div class="flex flex-wrap items-center gap-1.5 pt-0.5">
                <button type="button"
                        data-cookie-consent="accepted"
                        @click="acceptAll()"
                        class="px-2.5 py-1.5 rounded-md bg-[var(--color-primary)] text-white text-[11px] font-semibold hover:bg-[var(--color-primary-hover)] transition cursor-pointer shadow-2xs">
                    Accept all
                </button>
                <button type="button"
                        data-cookie-consent="essential"
                        @click="rejectNonEssential()"
                        class="px-2 py-1.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-surface)] text-[var(--text-primary)] text-[11px] font-semibold hover:bg-[var(--bg-subtle)] transition cursor-pointer">
                    Reject non-essential <span class="text-[9.5px] text-[var(--text-muted)] font-normal">(Essential only)</span>
                </button>
                <button type="button"
                        @click="openCustomize()"
                        class="text-[11px] font-medium text-[var(--text-muted)] hover:text-[var(--text-primary)] hover:underline px-1 py-1 ml-auto cursor-pointer">
                    Customize
                </button>
            </div>
        </div>
    </div>

    <!-- Customize Modal Panel (with focus trap & category toggles) -->
    <div x-show="customizeModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs"
         role="dialog"
         aria-modal="true"
         aria-labelledby="cookie-modal-title"
         @keydown.escape.window="customizeModal = false">

        <div class="w-full max-w-md rounded-2xl border border-[var(--border-default)] bg-[var(--bg-surface)] p-5 shadow-2xl space-y-4"
             @click.outside="customizeModal = false">

            <div class="flex items-center justify-between pb-2.5 border-b border-[var(--border-subtle)]">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-md bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                        </svg>
                    </div>
                    <h3 id="cookie-modal-title" class="!font-sans text-sm font-bold text-[var(--text-primary)]">
                        Cookie Preferences
                    </h3>
                </div>
                <button type="button"
                        @click="customizeModal = false"
                        class="text-[var(--text-muted)] hover:text-[var(--text-primary)] p-1 text-base leading-none cursor-pointer"
                        aria-label="Close modal">
                    &times;
                </button>
            </div>

            <p class="text-[11.5px] text-[var(--text-secondary)] leading-relaxed">
                Choose which cookie categories you permit. You can update these settings at any time from our footer or under account privacy settings.
            </p>

            <div class="space-y-3 divide-y divide-[var(--border-subtle)]">
                <!-- 1. Essential (Locked ON) -->
                <div class="pt-2.5 flex items-start justify-between gap-3">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-1.5">
                            <h4 class="text-xs font-bold text-[var(--text-primary)]">Strictly Necessary Cookies</h4>
                            <span class="px-1.5 py-0.5 rounded text-[9.5px] font-bold bg-[var(--color-success)]/10 text-[var(--color-success)] border border-[var(--color-success)]/20">Always Active</span>
                        </div>
                        <p class="text-[10.5px] text-[var(--text-muted)] mt-0.5 leading-relaxed">
                            Required to authenticate your account, secure submitted forms, and remember your display preference.
                        </p>
                    </div>
                    <div class="shrink-0 mt-0.5">
                        <input type="checkbox" checked disabled class="h-3.5 w-3.5 rounded text-[var(--accent-primary)] opacity-60 cursor-not-allowed">
                    </div>
                </div>

                <!-- 2. Analytics (Off by default) -->
                <div class="pt-2.5 flex items-start justify-between gap-3">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-1.5">
                            <h4 class="text-xs font-bold text-[var(--text-primary)]">Analytics &amp; Performance</h4>
                            <span class="px-1.5 py-0.5 rounded text-[9.5px] font-semibold bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">Optional</span>
                        </div>
                        <p class="text-[10.5px] text-[var(--text-muted)] mt-0.5 leading-relaxed">
                            Aggregated metrics to help us see which pages provide value and improve platform responsiveness.
                        </p>
                    </div>
                    <div class="shrink-0 mt-0.5">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox"
                                   x-model="consent.analytics"
                                   class="sr-only peer">
                            <div class="w-8 h-4 bg-[var(--bg-muted)] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[1px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all peer-checked:bg-[var(--accent-primary)]"></div>
                        </label>
                    </div>
                </div>

                <!-- 3. Marketing (Off by default) -->
                <div class="pt-2.5 flex items-start justify-between gap-3">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-1.5">
                            <h4 class="text-xs font-bold text-[var(--text-primary)]">Marketing &amp; Attribution</h4>
                            <span class="px-1.5 py-0.5 rounded text-[9.5px] font-semibold bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">Optional</span>
                        </div>
                        <p class="text-[10.5px] text-[var(--text-muted)] mt-0.5 leading-relaxed">
                            Attribution parameters to measure partner referrals. We do not sell personal data to external advertisers.
                        </p>
                    </div>
                    <div class="shrink-0 mt-0.5">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox"
                                   x-model="consent.marketing"
                                   class="sr-only peer">
                            <div class="w-8 h-4 bg-[var(--bg-muted)] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[1px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all peer-checked:bg-[var(--accent-primary)]"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-3 border-t border-[var(--border-subtle)]">
                <button type="button"
                        @click="rejectNonEssential()"
                        class="btn-secondary text-[11px] !py-1.5 !px-3">
                    Reject non-essential
                </button>
                <button type="button"
                        @click="saveConsent(consent.analytics, consent.marketing)"
                        class="btn-primary text-[11px] !py-1.5 !px-4">
                    Save choices
                </button>
            </div>
        </div>
    </div>
</div>
