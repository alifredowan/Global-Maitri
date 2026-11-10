@extends('layouts.app')

@section('title', 'Checkout - ' . $planDetails['name'])

@section('content')
<div class="py-12 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-xl mx-auto px-4">
        <div class="card-ledger p-6 sm:p-8"
             x-data="{
                cycle: 'one_time_marriage',
                basePrice: {{ (float) ($planDetails['one_time_price'] ?? $planDetails['monthly_price']) }},
                paymentMethod: '{{ old('payment_method', ($stripeEnabled ?? true) ? 'stripe' : (($paypalEnabled ?? false) ? 'paypal' : (($simulatedEnabled ?? false) ? 'simulated' : ''))) }}',
                promoCode: '{{ old('promo_code', '') }}',
                promoApplied: false,
                promoLoading: false,
                discountPercentage: 0,
                promoMessage: '',
                promoError: '{{ $errors->first('promo_code') }}',
                currentBasePrice() {
                    return this.basePrice;
                },
                currentDiscount() {
                    if (!this.promoApplied) return 0;
                    return (this.currentBasePrice() * this.discountPercentage) / 100;
                },
                currentFinalPrice() {
                    return Math.max(0, this.currentBasePrice() - this.currentDiscount());
                },
                async checkPromo() {
                    if (!this.promoCode.trim()) {
                        this.promoError = 'Please enter a coupon or promo code.';
                        return;
                    }
                    this.promoLoading = true;
                    this.promoError = '';
                    this.promoMessage = '';
                    try {
                        let res = await fetch('{{ route('subscription.validate-promo') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                promo_code: this.promoCode,
                                plan: '{{ $plan }}',
                                billing_cycle: this.cycle
                            })
                        });
                        let data = await res.json();
                        if (res.ok && data.valid) {
                            this.promoApplied = true;
                            this.discountPercentage = data.discount_percentage;
                            this.promoMessage = data.message;
                        } else {
                            this.promoApplied = false;
                            this.promoError = data.message || 'Invalid promo code.';
                        }
                    } catch (e) {
                        this.promoError = 'Network error verifying promo code.';
                    } finally {
                        this.promoLoading = false;
                    }
                }
             }">
            <div class="text-center mb-6">
                <span class="px-3.5 py-1 rounded-[4px] text-xs font-bold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] uppercase tracking-wider inline-flex items-center gap-1.5 border border-[var(--accent-primary)]/20">
                    <x-application-logo class="w-3.5 h-3.5 text-[var(--accent-primary)] shrink-0" />
                    Single Marriage Pass
                </span>
                <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading mt-3">Acquire {{ $planDetails['name'] }}</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-1">One-time payment. Valid until your confirmed Mangala Vivaha milestone.</p>
            </div>

            @if(request()->query('status') === 'cancelled')
                <div class="mb-5 p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--text-secondary)] text-xs flex items-center gap-2">
                    <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Checkout was cancelled. You have not been charged. Choose your payment method below whenever you're ready.</span>
                </div>
            @endif

            @if($errors->any() && !$errors->has('promo_code'))
                <div class="mb-5 p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-danger)] text-[var(--color-danger)] text-xs">
                    @foreach($errors->all() as $err)
                        <p>{{ $err }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('subscription.process') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="plan" value="{{ $plan }}">
                <input type="hidden" name="billing_cycle" value="one_time_marriage">

                <!-- One-Time Single Marriage Guarantee Information Card -->
                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[var(--text-primary)] flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Pass Validity &amp; Term
                        </span>
                        <span class="text-[10px] font-extrabold px-2.5 py-0.5 rounded-[4px] bg-[var(--accent-primary)] text-white uppercase tracking-wider">
                            Active Until Vivaha
                        </span>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        This is a single one-time fee of <strong class="font-bold text-[var(--text-primary)]">${{ number_format($planDetails['monthly_price'], 2) }}</strong>. You will <strong>never be auto-billed</strong> monthly. Your pass remains active until you register and confirm your Mangala Vivaha on Global Maitri.
                    </p>
                </div>

                <!-- Promo Code Box -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">Promotional Discount Code</label>
                    <div class="flex gap-2">
                        <input type="text" name="promo_code" x-model="promoCode" placeholder="e.g. METTA20, MAITRI50"
                               @keydown.enter.prevent="checkPromo()"
                               class="input-field flex-1 uppercase font-mono font-bold text-xs" style="min-height: 44px;">
                        <button type="button" @click="checkPromo()" :disabled="promoLoading"
                                class="btn-secondary text-xs px-4 font-bold disabled:opacity-50 cursor-pointer" style="min-height: 44px;">
                            <span x-show="!promoLoading">Apply</span>
                            <span x-show="promoLoading">Checking...</span>
                        </button>
                    </div>

                    <!-- Live feedback messages -->
                    <div x-show="promoMessage" x-cloak class="mt-2 p-2.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-success)] text-[var(--color-success)] text-xs font-semibold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-text="promoMessage"></span>
                    </div>

                    <div x-show="promoError" x-cloak class="mt-2 p-2.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-danger)] text-[var(--color-danger)] text-xs font-semibold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span x-text="promoError"></span>
                    </div>

                    <span class="text-[10px] text-[var(--text-muted)] block mt-1.5">Special Metta discount codes (e.g. METTA20, MAITRI50) can be entered here.</span>
                </div>

                <!-- Live Order Summary -->
                <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-2 text-xs">
                    <div class="flex items-center justify-between text-[var(--text-secondary)]">
                        <span>One-Time Marriage Pass ({{ $planDetails['name'] }}):</span>
                        <span class="font-bold text-[var(--text-primary)]" :class="promoApplied ? 'line-through text-[var(--text-muted)]' : ''">
                            $<span x-text="currentBasePrice().toFixed(2)"></span>
                        </span>
                    </div>

                    <div x-show="promoApplied" x-cloak class="flex items-center justify-between text-[var(--accent-primary)] font-bold">
                        <span>Metta Promo Discount (<span x-text="discountPercentage"></span>%):</span>
                        <span>-$<span x-text="currentDiscount().toFixed(2)"></span></span>
                    </div>

                    <div class="pt-2 border-t border-[var(--border-default)] flex items-center justify-between text-sm font-extrabold text-[var(--text-primary)]">
                        <span>Total Due Today (1-Time):</span>
                        <span class="text-base text-[var(--accent-primary)] font-bold">$<span x-text="currentFinalPrice().toFixed(2)"></span></span>
                    </div>
                </div>

                <!-- Payment Gateway Selector -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-2">
                        Select Payment Method
                    </label>

                    <input type="hidden" name="payment_method" :value="paymentMethod">

                    <div class="space-y-3">
                        @if($stripeEnabled ?? true)
                            <div @click="paymentMethod = 'stripe'"
                                 :class="paymentMethod === 'stripe'
                                    ? 'border-2 border-[var(--accent-primary)] bg-[var(--accent-primary)]/5 ring-1 ring-[var(--accent-primary)]'
                                    : 'border border-[var(--border-default)] bg-[var(--bg-surface)] hover:border-[var(--border-strong)]'"
                                 class="p-4 rounded-[4px] cursor-pointer transition relative group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-[4px] bg-[var(--accent-primary)] text-white flex items-center justify-center font-bold text-sm shadow-xs">
                                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-bold text-[var(--text-primary)]">Credit / Debit Card</span>
                                                <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">Stripe</span>
                                            </div>
                                            <p class="text-xs text-[var(--text-secondary)] mt-0.5">Visa, Mastercard, Amex, Apple Pay &amp; Google Pay</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition"
                                              :class="paymentMethod === 'stripe' ? 'border-[var(--accent-primary)] bg-[var(--accent-primary)] text-white' : 'border-[var(--border-default)]'">
                                            <span x-show="paymentMethod === 'stripe'" class="w-2 h-2 rounded-full bg-white"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2.5 pt-2.5 border-t border-[var(--border-subtle)] flex items-center justify-between text-[11px] text-[var(--text-muted)]">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        256-bit encrypted checkout
                                    </span>
                                    <span class="font-mono text-[10px]">PCI-DSS Compliant</span>
                                </div>
                            </div>
                        @endif

                        @if($paypalEnabled ?? true)
                            <div @click="paymentMethod = 'paypal'"
                                 :class="paymentMethod === 'paypal'
                                    ? 'border-2 border-[var(--accent-primary)] bg-[var(--accent-primary)]/5 ring-1 ring-[var(--accent-primary)]'
                                    : 'border border-[var(--border-default)] bg-[var(--bg-surface)] hover:border-[var(--border-strong)]'"
                                 class="p-4 rounded-[4px] cursor-pointer transition relative group">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-[4px] bg-[#003087] text-white flex items-center justify-center font-bold text-sm shadow-xs">
                                            <span class="font-sans italic font-extrabold text-lg tracking-tighter">P<span class="text-[#0079C1]">P</span></span>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-bold text-[var(--text-primary)]">PayPal</span>
                                                <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">Buyer Protection</span>
                                            </div>
                                            <p class="text-xs text-[var(--text-secondary)] mt-0.5">Pay via PayPal balance or debit/credit card</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition"
                                              :class="paymentMethod === 'paypal' ? 'border-[var(--accent-primary)] bg-[var(--accent-primary)] text-white' : 'border-[var(--border-default)]'">
                                            <span x-show="paymentMethod === 'paypal'" class="w-2 h-2 rounded-full bg-white"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2.5 pt-2.5 border-t border-[var(--border-subtle)] flex items-center justify-between text-[11px] text-[var(--text-muted)]">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-[var(--text-muted)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        PayPal Official Gateway
                                    </span>
                                    <span class="font-mono text-[10px]">Instant Activation</span>
                                </div>
                            </div>
                        @endif

                        @if($simulatedEnabled ?? true)
                            <div @click="paymentMethod = 'simulated'"
                                 :class="paymentMethod === 'simulated'
                                    ? 'border-2 border-[var(--accent-primary)] bg-[var(--accent-primary)]/5 ring-1 ring-[var(--accent-primary)]'
                                    : 'border border-dashed border-[var(--border-default)] bg-[var(--bg-surface)] hover:border-[var(--border-strong)]'"
                                 class="p-3.5 rounded-[4px] cursor-pointer transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-center text-[var(--accent-primary)]">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-[var(--text-primary)]">Developer / Demo Mode</span>
                                            <p class="text-[11px] text-[var(--text-muted)]">Instantly activate pass without payment gateway</p>
                                        </div>
                                    </div>
                                    <span class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition"
                                          :class="paymentMethod === 'simulated' ? 'border-[var(--accent-primary)] bg-[var(--accent-primary)] text-white' : 'border-[var(--border-default)]'">
                                        <span x-show="paymentMethod === 'simulated'" class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="btn-primary w-full py-3.5 text-sm font-bold flex items-center justify-center gap-2 cursor-pointer"
                        style="min-height: 48px;">
                    <template x-if="paymentMethod === 'stripe'">
                        <span class="flex items-center gap-2">
                            <span>Proceed to Stripe Checkout</span>
                            <span class="text-base" aria-hidden="true">&rarr;</span>
                        </span>
                    </template>
                    <template x-if="paymentMethod === 'paypal'">
                        <span class="flex items-center gap-2">
                            <span>Pay with PayPal</span>
                            <span class="text-base" aria-hidden="true">&rarr;</span>
                        </span>
                    </template>
                    <template x-if="paymentMethod === 'simulated'">
                        <span class="flex items-center gap-2">
                            <span>Activate Marriage Pass (Demo Mode)</span>
                            <span class="text-base" aria-hidden="true">&check;</span>
                        </span>
                    </template>
                </button>

                <!-- Trust and Guarantee Badges -->
                <div class="pt-2 grid grid-cols-2 gap-2 text-center text-[10px] text-[var(--text-secondary)]">
                    <div class="p-2 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span class="font-medium">Instant Activation</span>
                    </div>
                    <div class="p-2 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/>
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                        </svg>
                        <span class="font-medium">Valid Until Mangala Vivaha</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
