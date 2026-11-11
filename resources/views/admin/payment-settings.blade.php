@extends('layouts.app')

@section('title', 'Payment Gateways & Transaction Setup - Admin')
@section('page_title', 'Payment Gateways')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8"
     x-data="{
        activeTab: 'all',
        showStripeSecret: false,
        showPayPalSecret: false,
        copyText(text, btnId) {
            navigator.clipboard.writeText(text);
            const el = document.getElementById(btnId);
            if (el) {
                const old = el.innerHTML;
                el.innerHTML = '✓ Copied!';
                setTimeout(() => el.innerHTML = old, 2000);
            }
        }
     }">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                <span>Financial Infrastructure & Gateways</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--text-primary)] font-heading">Payment Gateways & Transactions</h1>
            <p class="text-xs sm:text-sm text-[var(--text-muted)] mt-1">
                Activate or deactivate payment methods dynamically, configure live and sandbox API credentials, and manage transaction currencies.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.packages.index') }}" class="btn-secondary text-xs flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                <span>Dynamic Packages &rarr;</span>
            </a>
            <a href="{{ route('admin.promo-codes.index') }}" class="btn-secondary text-xs flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                <span>Promo Codes &rarr;</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)] text-xs font-semibold flex items-center gap-2.5 shadow-xs">
            <svg class="w-4 h-4 shrink-0 text-[var(--color-success)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs font-semibold flex items-center gap-2.5 shadow-xs">
            <svg class="w-4 h-4 shrink-0 text-rose-600 dark:text-rose-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs space-y-1 shadow-xs">
            <div class="font-bold flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Please fix the following validation issues:</span>
            </div>
            <ul class="list-disc pl-5 text-[11px] space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Live Status Quick Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Stripe Summary Card -->
        <div class="card-ledger {{ $stripeSettings['enabled'] ? 'border-[var(--accent-primary)]/40 shadow-sm' : '' }} p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-extrabold flex items-center justify-center text-sm border border-[var(--border-default)]">
                            S
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Stripe Gateway</h3>
                            <span class="text-[10px] text-[var(--text-muted)]">Credit / Debit Card, Apple Pay</span>
                        </div>
                    </div>

                    @if($stripeSettings['enabled'])
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-success)] animate-pulse"></span>
                            ACTIVE
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300">
                            DISABLED
                        </span>
                    @endif
                </div>

                <div class="space-y-1.5 text-xs text-[var(--text-secondary)] py-2 border-y border-[var(--border-subtle)]">
                    <div class="flex items-center justify-between">
                        <span>API Configuration:</span>
                        <span class="font-bold {{ $stripeSettings['is_configured'] ? 'text-[var(--color-success)]' : 'text-amber-600 dark:text-amber-400' }}">
                            {{ $stripeSettings['is_configured'] ? '✓ Configured' : 'Missing Secret Key' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Default Currency:</span>
                        <span class="font-mono font-bold text-[var(--text-primary)] uppercase">{{ $stripeSettings['currency'] }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-2 flex items-center justify-between gap-2">
                <form action="{{ route('admin.payment-settings.test') }}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" value="stripe">
                    <button type="submit"
                            title="Send an API test ping to Stripe servers"
                            class="btn-secondary text-xs px-2.5 py-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        <span>Test API</span>
                    </button>
                </form>
                <form action="{{ route('admin.payment-settings.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" value="stripe">
                    <button type="submit"
                            class="px-3 py-1.5 rounded-md text-xs font-bold transition cursor-pointer {{ $stripeSettings['enabled'] ? 'bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800' : 'btn-primary' }}">
                        {{ $stripeSettings['enabled'] ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- PayPal Summary Card -->
        <div class="card-ledger {{ $paypalSettings['enabled'] ? 'border-[var(--accent-primary)]/40 shadow-sm' : '' }} p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/60 text-[#003087] dark:text-[#0079C1] font-sans font-black italic flex items-center justify-center text-sm border border-sky-200 dark:border-sky-800">
                            PP
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">PayPal Gateway</h3>
                            <span class="text-[10px] text-[var(--text-muted)]">PayPal Express & Wallet</span>
                        </div>
                    </div>

                    @if($paypalSettings['enabled'])
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-sky-100 dark:bg-sky-950 text-sky-800 dark:text-sky-300">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                            ACTIVE
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300">
                            DISABLED
                        </span>
                    @endif
                </div>

                <div class="space-y-1.5 text-xs text-[var(--text-secondary)] py-2 border-y border-[var(--border-subtle)]">
                    <div class="flex items-center justify-between">
                        <span>Environment Mode:</span>
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold uppercase {{ $paypalSettings['mode'] === 'live' ? 'bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]' : 'bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300' }}">
                            {{ $paypalSettings['mode'] }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>API Configuration:</span>
                        <span class="font-bold {{ $paypalSettings['is_configured'] ? 'text-[var(--color-success)]' : 'text-amber-600 dark:text-amber-400' }}">
                            {{ $paypalSettings['is_configured'] ? '✓ Configured' : 'Missing Credentials' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-2 flex items-center justify-between gap-2">
                <form action="{{ route('admin.payment-settings.test') }}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" value="paypal">
                    <button type="submit"
                            title="Send an OAuth token authentication request to PayPal"
                            class="btn-secondary text-xs px-2.5 py-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        <span>Test API</span>
                    </button>
                </form>
                <form action="{{ route('admin.payment-settings.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" value="paypal">
                    <button type="submit"
                            class="px-3 py-1.5 rounded-md text-xs font-bold transition cursor-pointer {{ $paypalSettings['enabled'] ? 'bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800' : 'btn-primary' }}">
                        {{ $paypalSettings['enabled'] ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Simulated / Demo Mode Summary Card -->
        <div class="card-ledger p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-10 h-10 rounded-xl bg-[var(--bg-subtle)] text-[var(--accent-primary)] flex items-center justify-center border border-[var(--border-default)]">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.31L4.69 18.5a2 2 0 0 0 1.74 2.87h15.14a2 2 0 0 0 1.74-2.87L18 9.31V2"/><line x1="8" y1="2" x2="16" y2="2"/><line x1="6.8" y1="15" x2="17.2" y2="15"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Developer / Demo Mode</h3>
                            <span class="text-[10px] text-[var(--text-muted)]">Test pass without live gateways</span>
                        </div>
                    </div>

                    @if($simulatedEnabled)
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[var(--accent-primary)]/15 text-[var(--accent-primary)]">
                            ENABLED
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-[var(--bg-subtle)] text-[var(--text-muted)]">
                            DISABLED
                        </span>
                    @endif
                </div>

                <div class="space-y-1.5 text-xs text-[var(--text-secondary)] py-2 border-y border-[var(--border-subtle)]">
                    <p class="text-[11px] leading-relaxed">
                        Allows users or moderators to instantly activate any package on checkout without connecting to real bank card or PayPal accounts.
                    </p>
                </div>
            </div>

            <div class="mt-4 pt-2 flex items-center justify-between gap-2">
                <span class="text-[11px] text-[var(--text-muted)]">Demo toggle:</span>
                <form action="{{ route('admin.payment-settings.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" value="simulated">
                    <button type="submit"
                            class="px-3 py-1.5 rounded-md text-xs font-bold transition cursor-pointer {{ $simulatedEnabled ? 'btn-secondary' : 'btn-primary' }}">
                        {{ $simulatedEnabled ? 'Disable Demo Mode' : 'Enable Demo Mode' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Configuration Form -->
    <form action="{{ route('admin.payment-settings.update') }}" method="POST" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            <!-- STRIPE CONFIGURATION SECTION -->
            <div class="card-ledger p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-[var(--border-subtle)]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[var(--accent-primary)] text-white font-extrabold flex items-center justify-center text-sm shadow-sm">
                            S
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Stripe Configuration</h2>
                            <p class="text-xs text-[var(--text-muted)]">Card payments via Stripe Elements & Checkout Sessions</p>
                        </div>
                    </div>

                    <!-- Activate/Deactivate Switch -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="stripe_enabled" value="1" class="sr-only peer" {{ $stripeSettings['enabled'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-[var(--border-default)] peer-focus:outline-none rounded-full peer dark:bg-[var(--border-subtle)] peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--accent-primary)]"></div>
                        <span class="ml-2.5 text-xs font-bold text-[var(--text-secondary)]">
                            Active
                        </span>
                    </label>
                </div>

                <!-- Stripe Publishable Key -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        Publishable Key (pk_test_... or pk_live_...) *
                    </label>
                    <input type="text"
                           name="stripe_key"
                           value="{{ old('stripe_key', $stripeSettings['key']) }}"
                           placeholder="pk_test_51..."
                           class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    <span class="text-[10px] text-[var(--text-muted)] block mt-1">Found in your Stripe Developer Dashboard under Developers &gt; API keys.</span>
                </div>

                <!-- Stripe Secret Key -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider">
                            Secret Key (sk_test_... or sk_live_...) *
                        </label>
                        <button type="button" @click="showStripeSecret = !showStripeSecret" class="text-[11px] font-bold text-[var(--accent-primary)] hover:underline cursor-pointer">
                            <span x-text="showStripeSecret ? 'Hide Key' : 'Reveal Key'"></span>
                        </button>
                    </div>
                    <div class="relative">
                        <input :type="showStripeSecret ? 'text' : 'password'"
                               name="stripe_secret"
                               value="{{ old('stripe_secret', $stripeSettings['secret']) }}"
                               placeholder="sk_test_51..."
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <span class="text-[10px] text-[var(--text-muted)] block mt-1">Used to create checkout sessions and authenticate API requests from the server.</span>
                </div>

                <!-- Stripe Webhook Secret -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        Webhook Signing Secret (whsec_...)
                    </label>
                    <input type="text"
                           name="stripe_webhook_secret"
                           value="{{ old('stripe_webhook_secret', $stripeSettings['webhook_secret']) }}"
                           placeholder="whsec_..."
                           class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    <span class="text-[10px] text-[var(--text-muted)] block mt-1">Required to cryptographically verify incoming Stripe webhook notifications.</span>
                </div>

                <!-- Stripe Currency -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        Stripe Settlement Currency *
                    </label>
                    <select name="stripe_currency" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        @foreach(['USD' => 'USD ($) - US Dollar', 'GBP' => 'GBP (£) - British Pound', 'EUR' => 'EUR (€) - Euro', 'CAD' => 'CAD ($) - Canadian Dollar', 'AUD' => 'AUD ($) - Australian Dollar', 'BDT' => 'BDT (Tk) - Bangladeshi Taka', 'AED' => 'AED - UAE Dirham', 'SAR' => 'SAR - Saudi Riyal'] as $code => $label)
                            <option value="{{ $code }}" {{ strtoupper($stripeSettings['currency']) === $code ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Webhook Endpoint Box -->
                <div class="p-3.5 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold text-[var(--text-secondary)]">Stripe Webhook URL:</span>
                        <button type="button"
                                id="btn-copy-stripe"
                                @click="copyText('{{ route('webhook.stripe') }}', 'btn-copy-stripe')"
                                class="btn-secondary text-[10px] px-2 py-0.5">
                            Copy URL
                        </button>
                    </div>
                    <code class="text-[11px] font-mono text-[var(--accent-primary)] break-all select-all block">
                        {{ route('webhook.stripe') }}
                    </code>
                </div>
            </div>

            <!-- PAYPAL CONFIGURATION SECTION -->
            <div class="card-ledger p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-[var(--border-subtle)]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#003087] text-white font-sans font-black italic flex items-center justify-center text-sm shadow-sm">
                            PP
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">PayPal Configuration</h2>
                            <p class="text-xs text-[var(--text-muted)]">PayPal Checkout Orders v2 REST API integration</p>
                        </div>
                    </div>

                    <!-- Activate/Deactivate Switch -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="paypal_enabled" value="1" class="sr-only peer" {{ $paypalSettings['enabled'] ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-[var(--border-default)] peer-focus:outline-none rounded-full peer dark:bg-[var(--border-subtle)] peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--accent-primary)]"></div>
                        <span class="ml-2.5 text-xs font-bold text-[var(--text-secondary)]">
                            Active
                        </span>
                    </label>
                </div>

                <!-- PayPal Mode (Sandbox vs Live) -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        PayPal Environment Mode *
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-2.5 p-3 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] cursor-pointer hover:border-[var(--accent-primary)] transition">
                            <input type="radio" name="paypal_mode" value="sandbox" {{ $paypalSettings['mode'] === 'sandbox' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <div>
                                <span class="text-xs font-bold text-[var(--text-primary)] block">Sandbox Mode</span>
                                <span class="text-[10px] text-[var(--text-muted)]">Testing credentials</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-2.5 p-3 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] cursor-pointer hover:border-[var(--accent-primary)] transition">
                            <input type="radio" name="paypal_mode" value="live" {{ $paypalSettings['mode'] === 'live' ? 'checked' : '' }} class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <div>
                                <span class="text-xs font-bold text-[var(--text-primary)] block">Production (Live)</span>
                                <span class="text-[10px] text-[var(--text-muted)]">Real card/account payments</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- PayPal Client ID -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        Client ID *
                    </label>
                    <input type="text"
                           name="paypal_client_id"
                           value="{{ old('paypal_client_id', $paypalSettings['client_id']) }}"
                           placeholder="AX... or client id"
                           class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    <span class="text-[10px] text-[var(--text-muted)] block mt-1">Obtained from PayPal Developer Portal &gt; My Apps &gt; REST API Apps.</span>
                </div>

                <!-- PayPal Secret Key -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider">
                            Client Secret *
                        </label>
                        <button type="button" @click="showPayPalSecret = !showPayPalSecret" class="text-[11px] font-bold text-[var(--accent-primary)] hover:underline cursor-pointer">
                            <span x-text="showPayPalSecret ? 'Hide Secret' : 'Reveal Secret'"></span>
                        </button>
                    </div>
                    <div class="relative">
                        <input :type="showPayPalSecret ? 'text' : 'password'"
                               name="paypal_client_secret"
                               value="{{ old('paypal_client_secret', $paypalSettings['client_secret']) }}"
                               placeholder="EL..."
                               class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <span class="text-[10px] text-[var(--text-muted)] block mt-1">Kept confidential. Used for server-to-server OAuth token generation.</span>
                </div>

                <!-- PayPal Webhook ID -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        PayPal Webhook ID (Optional)
                    </label>
                    <input type="text"
                           name="paypal_webhook_id"
                           value="{{ old('paypal_webhook_id', $paypalSettings['webhook_id']) }}"
                           placeholder="e.g. 5HY44985..."
                           class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    <span class="text-[10px] text-[var(--text-muted)] block mt-1">Configured in PayPal webhook settings for asynchronous event verification.</span>
                </div>

                <!-- PayPal Currency -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1.5">
                        PayPal Transaction Currency *
                    </label>
                    <select name="paypal_currency" class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        @foreach(['USD' => 'USD ($) - US Dollar', 'GBP' => 'GBP (£) - British Pound', 'EUR' => 'EUR (€) - Euro', 'CAD' => 'CAD ($) - Canadian Dollar', 'AUD' => 'AUD ($) - Australian Dollar'] as $code => $label)
                            <option value="{{ $code }}" {{ strtoupper($paypalSettings['currency']) === $code ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- PayPal Webhook URL Box -->
                <div class="p-3.5 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-1.5">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold text-[var(--text-secondary)]">PayPal Webhook URL:</span>
                        <button type="button"
                                id="btn-copy-paypal"
                                @click="copyText('{{ route('webhook.paypal') }}', 'btn-copy-paypal')"
                                class="btn-secondary text-[10px] px-2 py-0.5">
                            Copy URL
                        </button>
                    </div>
                    <code class="text-[11px] font-mono text-[var(--accent-primary)] break-all select-all block">
                        {{ route('webhook.paypal') }}
                    </code>
                </div>
            </div>

        </div>

        <!-- Testing & Developer Bypass Mode Card -->
        <div class="card-ledger p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[var(--bg-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0 border border-[var(--border-default)]">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2v7.31L4.69 18.5a2 2 0 0 0 1.74 2.87h15.14a2 2 0 0 0 1.74-2.87L18 9.31V2"/><line x1="8" y1="2" x2="16" y2="2"/><line x1="6.8" y1="15" x2="17.2" y2="15"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Simulated Developer / Demo Mode</h3>
                        <p class="text-xs text-[var(--text-muted)] mt-0.5">
                            Display the "Developer / Demo Mode" option on the seeker checkout screen so tests can complete without live credit cards.
                        </p>
                    </div>
                </div>

                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                    <input type="checkbox" name="simulated_payment_enabled" value="1" class="sr-only peer" {{ $simulatedEnabled ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-[var(--border-default)] peer-focus:outline-none rounded-full peer dark:bg-[var(--border-subtle)] peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[var(--accent-primary)]"></div>
                    <span class="ml-2.5 text-xs font-bold text-[var(--text-secondary)]">
                        Allow Demo Payments
                    </span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit"
                    class="btn-primary text-xs px-8 py-3 flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span>Save Payment Gateway Configurations</span>
            </button>
        </div>
    </form>

</div>
@endsection

