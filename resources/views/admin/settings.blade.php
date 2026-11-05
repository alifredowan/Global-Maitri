@extends('layouts.app')

@section('title', 'Platform Policy Parameters - Admin')
@section('page_title', 'Platform Policies')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            <span>System Parameters</span>
        </div>
        <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Platform Policy Parameters</h1>
        <p class="text-xs text-[var(--text-muted)] mt-0.5">Configure global moderation rules, subscription quotas, and promotional discounts without redeploying code.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Platform Policy Parameters Form -->
        <div class="md:col-span-2 card-ledger p-6 space-y-6">
            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Core Platform Policies</h2>
            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                @csrf

                @foreach($settings as $setting)
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1 font-mono">
                            {{ $setting->key }}
                        </label>
                        @if($setting->type === 'boolean')
                            <select name="{{ $setting->key }}" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                                <option value="1" {{ $setting->value == '1' ? 'selected' : '' }}>Enabled (True)</option>
                                <option value="0" {{ $setting->value == '0' ? 'selected' : '' }}>Disabled (False)</option>
                            </select>
                        @else
                            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                                   class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                        @endif
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">{{ $setting->description }}</span>
                    </div>
                @endforeach

                <button type="submit" class="w-full btn-primary text-xs py-3 justify-center mt-4">
                    Save Policy Parameters
                </button>
            </form>
        </div>

        <!-- Quick Links & Promo Codes Section -->
        <div class="space-y-6">
            <!-- Cloudflare Turnstile CAPTCHA -->
            <div class="card-ledger p-6 space-y-4" x-data="{ showSecret: false }">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">CAPTCHA (Cloudflare Turnstile)</h2>
                    @if($captchaSettings['is_configured'])
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $captchaSettings['enabled'] ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]' }}">
                            {{ $captchaSettings['enabled'] ? 'Active' : 'Configured' }}
                        </span>
                    @else
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">Not Configured</span>
                    @endif
                </div>
                <p class="text-xs text-[var(--text-muted)] leading-relaxed">
                    Get your Site Key and Secret Key from the <a href="https://dash.cloudflare.com/?to=/:account/turnstile" target="_blank" rel="noopener" class="text-[var(--accent-primary)] underline font-medium">Cloudflare Turnstile dashboard</a>, then paste them below to protect Registration and Login from bots.
                </p>
                <form action="{{ route('admin.settings.captcha.update') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Site Key</label>
                        <input type="text" name="turnstile_site_key" value="{{ $captchaSettings['site_key'] }}" autocomplete="off"
                               placeholder="0x4AAAAAAA..."
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Secret Key</label>
                        <div class="relative">
                            <input :type="showSecret ? 'text' : 'password'" name="turnstile_secret_key" value="{{ $captchaSettings['secret_key'] }}" autocomplete="off"
                                   placeholder="0x4AAAAAAA..."
                                   class="w-full px-3.5 py-2.5 pr-11 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                            <button type="button" @click="showSecret = !showSecret" tabindex="-1"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] text-[10px] font-bold uppercase cursor-pointer">
                                <span x-show="!showSecret">Show</span>
                                <span x-show="showSecret" style="display:none;">Hide</span>
                            </button>
                        </div>
                    </div>
                    <label class="flex items-center gap-2 text-xs text-[var(--text-secondary)] cursor-pointer">
                        <input type="checkbox" name="turnstile_enabled" value="1" {{ $captchaSettings['enabled'] ? 'checked' : '' }}
                               class="rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span>Enable CAPTCHA on Registration & Login</span>
                    </label>
                    <button type="submit" class="w-full btn-primary text-xs py-2.5 justify-center">
                        Save CAPTCHA Settings
                    </button>
                </form>
            </div>

            <!-- Direct Management Cards -->
            <div class="card-ledger p-6 space-y-3 bg-[var(--bg-subtle)] border-l-4 border-l-[var(--accent-primary)]">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-[var(--accent-primary)]">Payment Infrastructure</span>
                <h3 class="text-base font-bold font-heading text-[var(--text-primary)]">Payment Gateways & Keys</h3>
                <p class="text-xs text-[var(--text-muted)] leading-relaxed">Toggle PayPal & Stripe methods on/off, configure API keys, webhooks, and currencies dynamically.</p>
                <a href="{{ route('admin.payment-settings') }}" class="btn-secondary text-xs flex items-center justify-between mt-2">
                    <span>Configure Gateways</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="card-ledger p-6 space-y-3 bg-[var(--bg-subtle)] border-l-4 border-l-[var(--accent-primary)]">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-[var(--accent-primary)]">Subscription Governance</span>
                <h3 class="text-base font-bold font-heading text-[var(--text-primary)]">Dynamic Packages & Tiers</h3>
                <p class="text-xs text-[var(--text-muted)] leading-relaxed">Customize package pricing, quotas, features, and active status dynamically.</p>
                <a href="{{ route('admin.packages.index') }}" class="btn-secondary text-xs flex items-center justify-between mt-2">
                    <span>Manage Packages</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="card-ledger p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Quick Promo Generator</h2>
                    <a href="{{ route('admin.promo-codes.index') }}" class="text-[11px] font-bold text-[var(--accent-primary)] hover:underline">Full Manager &rarr;</a>
                </div>
                <form action="{{ route('admin.promo-codes.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Coupon Code</label>
                        <input type="text" name="code" required placeholder="e.g. MAITRI30"
                               class="w-full px-3.5 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] placeholder:text-[var(--text-muted)] text-xs uppercase font-mono focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Discount %</label>
                        <input type="number" name="discount_percentage" required min="1" max="100" placeholder="e.g. 30"
                               class="w-full px-3.5 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Max Redemptions</label>
                        <input type="number" name="max_uses" value="100" required
                               class="w-full px-3.5 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    </div>
                    <button type="submit" class="w-full btn-primary text-xs py-2.5 justify-center">
                        Create Promo Code
                    </button>
                </form>
            </div>

            <div class="card-ledger p-6">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">Active Promo Codes</h3>
                    <a href="{{ route('admin.promo-codes.index') }}" class="text-[11px] font-bold text-[var(--accent-primary)] hover:underline">View All &rarr;</a>
                </div>
                <div class="space-y-2">
                    @foreach($discountCodes as $code)
                        <div class="p-2.5 rounded-lg bg-[var(--bg-subtle)] border border-[var(--border-default)] text-xs flex items-center justify-between">
                            <div>
                                <span class="font-mono font-bold text-[var(--accent-primary)]">{{ $code->code }}</span>
                                @if($code->isRestrictedToUsers())
                                    <span class="text-[9px] px-1.5 py-0.5 rounded-full bg-[var(--accent-primary)]/15 text-[var(--accent-primary)] font-bold ml-1">Special</span>
                                @endif
                            </div>
                            <span class="text-[var(--text-muted)] font-semibold">{{ $code->discount_percentage }}% off ({{ $code->times_used }}/{{ $code->max_uses }})</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
