@extends('layouts.app')

@section('title', 'Compliance & Cookie Settings - Admin - Global Maitri')
@section('page_title', 'Compliance & Cookie Consent')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-8">

    <!-- Header -->
    <div class="card-monograph p-6 sm:p-8 bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-[3px] bg-[var(--saffron-gold)]/10 text-[var(--saffron-gold)] text-xs font-mono uppercase tracking-wider mb-2 border border-[var(--saffron-gold)]/25">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
            </svg>
            <span>Regulatory &amp; Legal Compliance</span>
        </div>
        <h1 class="font-heading font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">
            Cookie Consent &amp; Privacy Compliance
        </h1>
        <p class="text-xs sm:text-sm text-[var(--text-secondary)] mt-1 max-w-2xl leading-relaxed">
            Manage GDPR, ePrivacy, and DPDP cookie consent banner copy, consent storage rules, and policy destinations.
        </p>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-medium flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <div class="card-monograph p-6 sm:p-8 space-y-6">
        <form action="{{ route('admin.compliance.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Banner Heading -->
            <div>
                <label for="cookie_banner_heading" class="block text-xs font-bold text-[var(--text-primary)] mb-1">
                    Banner Heading
                </label>
                <input type="text"
                       name="cookie_banner_heading"
                       id="cookie_banner_heading"
                       value="{{ old('cookie_banner_heading', $cookieBannerHeading) }}"
                       required
                       class="w-full px-3.5 py-2 text-xs rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none">
                <p class="text-[11px] text-[var(--text-muted)] mt-1">
                    Displayed prominently at the top of the compact bottom banner.
                </p>
            </div>

            <!-- Banner Body Text -->
            <div>
                <label for="cookie_banner_text" class="block text-xs font-bold text-[var(--text-primary)] mb-1">
                    Banner Body Text
                </label>
                <textarea name="cookie_banner_text"
                          id="cookie_banner_text"
                          rows="3"
                          required
                          class="w-full px-3.5 py-2 text-xs rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none">{{ old('cookie_banner_text', $cookieBannerText) }}</textarea>
                <p class="text-[11px] text-[var(--text-muted)] mt-1">
                    Concise, honest explanation in a calm, respectful tone.
                </p>
            </div>

            <!-- Cookie Policy URL -->
            <div>
                <label for="cookie_policy_url" class="block text-xs font-bold text-[var(--text-primary)] mb-1">
                    Cookie Policy URL
                </label>
                <input type="text"
                       name="cookie_policy_url"
                       id="cookie_policy_url"
                       value="{{ old('cookie_policy_url', $cookiePolicyUrl) }}"
                       required
                       class="w-full px-3.5 py-2 text-xs rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none">
            </div>

            <!-- Privacy Policy URL -->
            <div>
                <label for="privacy_policy_url" class="block text-xs font-bold text-[var(--text-primary)] mb-1">
                    Privacy Policy URL
                </label>
                <input type="text"
                       name="privacy_policy_url"
                       id="privacy_policy_url"
                       value="{{ old('privacy_policy_url', $privacyPolicyUrl) }}"
                       required
                       class="w-full px-3.5 py-2 text-xs rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] focus:border-[var(--accent-primary)] focus:outline-none">
            </div>

            <!-- Categories Overview -->
            <div class="pt-4 border-t border-[var(--border-subtle)] space-y-4">
                <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                    Consent Categories &amp; Defaults
                </h3>
                
                <div class="space-y-3">
                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-[var(--text-primary)]">Strictly Necessary / Essential</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--color-success)]/10 text-[var(--color-success)] border border-[var(--color-success)]/20">Locked On</span>
                            </div>
                            <p class="text-[11px] text-[var(--text-muted)] mt-1">
                                Authentication session, CSRF security tokens, and interface theme preference. Always active.
                            </p>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-[var(--text-primary)]">Performance &amp; Analytics</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--bg-surface)] text-[var(--text-secondary)] border border-[var(--border-default)]">Off by Default</span>
                            </div>
                            <p class="text-[11px] text-[var(--text-muted)] mt-1">
                                Anonymized error logging and aggregate traffic telemetry. Blocked until explicit visitor opt-in.
                            </p>
                        </div>
                    </div>

                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-[var(--text-primary)]">Marketing &amp; Targeting</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[var(--bg-surface)] text-[var(--text-secondary)] border border-[var(--border-default)]">Off by Default</span>
                            </div>
                            <p class="text-[11px] text-[var(--text-muted)] mt-1">
                                Campaign attribution and referral partner verification. Blocked until explicit visitor opt-in.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[var(--border-subtle)] flex items-center justify-end">
                <button type="submit" class="btn-primary text-xs !py-2.5 !px-6 cursor-pointer">
                    Save Compliance Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

