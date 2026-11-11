@extends('layouts.app')

@section('title', 'Manage Promo Codes & Special Discounts - Admin')
@section('page_title', 'Promo & Discounts')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8" x-data="{
    code: '',
    targetType: 'all',
    allowedEmails: '',
    generateCode() {
        const prefixes = ['PRO', 'VIP', 'MAITRI', 'METTA', 'SPECIAL', 'DHAMMA'];
        const p = prefixes[Math.floor(Math.random() * prefixes.length)];
        const num = Math.floor(100 + Math.random() * 900);
        this.code = p + num;
    },
    addEmail(email) {
        if (!this.allowedEmails.includes(email)) {
            this.allowedEmails = this.allowedEmails ? this.allowedEmails + ', ' + email : email;
        }
    }
}">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                <span>Financial Promotion System</span>
            </div>
            <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Promo Codes & Special Discounts</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">Generate promo codes, target specific subscription packages (e.g. Pro), and assign extra discounts to special VIP users.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)] text-xs font-semibold flex items-center gap-2 shadow-xs">
            <svg class="w-4 h-4 shrink-0 text-[var(--color-success)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs font-semibold flex items-center gap-2 shadow-xs">
            <svg class="w-4 h-4 shrink-0 text-rose-600 dark:text-rose-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs space-y-1 shadow-xs">
            <div class="font-bold flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Please correct the following errors:</span>
            </div>
            <ul class="list-disc pl-5 text-[11px] space-y-0.5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Generate Promo Code Form -->
        <div class="lg:col-span-1 card-ledger p-6 space-y-6">
            <div>
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Generate New Promo Code</h2>
                <p class="text-xs text-[var(--text-muted)] mt-0.5">Setup coupon codes with package restriction and special user access control.</p>
            </div>

            <form action="{{ route('admin.promo-codes.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider">Promo Code *</label>
                        <button type="button" @click="generateCode()" class="text-[11px] font-bold text-[var(--accent-primary)] hover:underline cursor-pointer flex items-center gap-1">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 8h.01"/><path d="M8 8h.01"/><path d="M8 16h.01"/><path d="M16 16h.01"/><path d="M12 12h.01"/></svg>
                            <span>Random Code</span>
                        </button>
                    </div>
                    <input type="text" name="code" x-model="code" required placeholder="e.g. PRO50, SPECIAL30"
                           class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] placeholder:text-[var(--text-muted)] text-xs font-mono uppercase font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Extra Discount Percentage (%) *</label>
                    <div class="relative">
                        <input type="number" name="discount_percentage" required min="1" max="100" value="30" placeholder="e.g. 30"
                               class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-bold outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <span class="absolute right-3 top-2 text-xs font-bold text-[var(--text-muted)]">% off</span>
                    </div>
                </div>

                <!-- Target Package -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Applicable Package *</label>
                    <select name="plan_slug" class="w-full px-3 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                        <option value="all">All Paid Packages</option>
                        @foreach($packages as $pkg)
                            <option value="{{ $pkg->slug }}">
                                {{ $pkg->name }} (${{ number_format($pkg->monthly_price, 2) }} 1-time pass)
                            </option>
                        @endforeach
                    </select>
                    <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Restrict discount to a specific package (e.g. Pro package) or allow on all.</span>
                </div>

                <!-- User Eligibility / Special Users -->
                <div class="p-3.5 rounded-xl bg-[var(--bg-subtle)] border border-[var(--border-default)] space-y-3">
                    <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">User Eligibility</label>
                    <div class="space-y-2 text-xs">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="target_mode" value="all" x-model="targetType" class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--text-secondary)] font-medium">Public (Any registered user)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="target_mode" value="special" x-model="targetType" class="text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <span class="text-[var(--accent-primary)] font-bold">Special Users Only (VIP Restricted)</span>
                        </label>
                    </div>

                    <div x-show="targetType === 'special'" x-cloak class="space-y-2 pt-2 border-t border-[var(--border-subtle)]">
                        <label class="block text-[11px] font-bold text-[var(--text-secondary)]">Designated Special User Email(s):</label>
                        <textarea name="allowed_emails" x-model="allowedEmails" rows="3" placeholder="user1@example.com, seeker@domain.com"
                                  class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs font-mono outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]"></textarea>
                        <span class="text-[10px] text-[var(--text-muted)] block">Separate multiple emails with commas or newlines. Only these users will be granted this discount.</span>

                        @if(isset($allUsers) && count($allUsers) > 0)
                            <div class="pt-1">
                                <span class="text-[10px] font-bold text-[var(--text-muted)] block mb-1">Click to add registered user:</span>
                                <div class="max-h-24 overflow-y-auto space-y-1">
                                    @foreach($allUsers->take(8) as $usr)
                                        <button type="button" @click="addEmail('{{ $usr->email }}')" class="block w-full text-left px-2 py-1 rounded-md text-[10px] bg-[var(--bg-surface)] hover:bg-[var(--bg-subtle)] text-[var(--text-secondary)] transition truncate border border-[var(--border-subtle)]">
                                            + {{ $usr->name }} ({{ $usr->email }})
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Max Redemptions</label>
                        <input type="number" name="max_uses" required value="100" min="1" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Expiry Date (Opt. dd/mm/yyyy)</label>
                        <input type="text" name="expires_at" inputmode="numeric" placeholder="dd/mm/yyyy" maxlength="10"
                               pattern="\d{2}/\d{2}/\d{4}" x-data
                               x-on:input="$el.value = $el.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d)/, '$1/$2').replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3').slice(0, 10)"
                               class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Internal Note / Description</label>
                    <input type="text" name="description" placeholder="e.g. VIP discount for special matrimonial seekers" class="w-full px-3 py-2 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs outline-none focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)]">
                </div>

                <button type="submit" class="w-full btn-primary text-xs py-3 justify-center">
                    Generate & Save Promo Code
                </button>
            </form>
        </div>

        <!-- Right: Active Promo Codes Table -->
        <div class="lg:col-span-2 space-y-4">
            <div class="card-ledger p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Active & Configured Promo Codes</h2>
                    <span class="text-xs text-[var(--text-muted)] font-bold">{{ count($discountCodes) }} Total Codes</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-[var(--text-secondary)]">
                        <thead>
                            <tr class="border-b border-[var(--border-subtle)] text-[var(--text-muted)] uppercase text-[10px] tracking-wider">
                                <th class="py-3 px-3">Code</th>
                                <th class="py-3 px-3">Discount</th>
                                <th class="py-3 px-3">Package Target</th>
                                <th class="py-3 px-3">Audience</th>
                                <th class="py-3 px-3">Usage</th>
                                <th class="py-3 px-3">Status</th>
                                <th class="py-3 px-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--border-subtle)]">
                            @forelse($discountCodes as $code)
                                <tr class="hover:bg-[var(--bg-subtle)]/50 transition">
                                    <!-- Code -->
                                    <td class="py-3.5 px-3">
                                        <div class="flex items-center gap-1.5 font-mono font-bold text-sm text-[var(--accent-primary)]">
                                            <span>{{ $code->code }}</span>
                                        </div>
                                        @if($code->description)
                                            <span class="text-[10px] text-[var(--text-muted)] block line-clamp-1">{{ $code->description }}</span>
                                        @endif
                                    </td>

                                    <!-- Discount -->
                                    <td class="py-3.5 px-3 font-extrabold text-[var(--text-primary)] text-sm">
                                        {{ $code->discount_percentage }}%
                                    </td>

                                    <!-- Package Target -->
                                    <td class="py-3.5 px-3">
                                        @if($code->plan_slug && $code->plan_slug !== 'all')
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[var(--accent-primary)]/15 text-[var(--accent-primary)]">
                                                {{ $code->plan?->name ?? strtoupper($code->plan_slug) }}
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]">
                                                All Paid Packages
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Audience -->
                                    <td class="py-3.5 px-3">
                                        @if($code->isRestrictedToUsers())
                                            <div class="group relative inline-block">
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[var(--accent-primary)]/20 text-[var(--accent-primary)] cursor-help border border-[var(--accent-primary)]/30">
                                                    Special Users ({{ count($code->getAllowedEmailsList()) }})
                                                </span>
                                                <div class="hidden group-hover:block absolute z-20 left-0 bottom-full mb-1 p-2 bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] text-[10px] rounded-lg shadow-lg max-w-xs whitespace-normal font-mono">
                                                    {{ implode(', ', $code->getAllowedEmailsList()) }}
                                                </div>
                                            </div>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]">
                                                Public (All)
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Usage -->
                                    <td class="py-3.5 px-3 font-medium">
                                        <span>{{ $code->times_used }} / {{ $code->max_uses }}</span>
                                        @if($code->expires_at)
                                            <span class="text-[10px] text-[var(--text-muted)] block">Exp: {{ $code->expires_at->format('d/m/Y') }}</span>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="py-3.5 px-3">
                                        @if(! $code->is_active)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[var(--bg-subtle)] text-[var(--text-muted)]">Inactive</span>
                                        @elseif($code->times_used >= $code->max_uses)
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300">Exhausted</span>
                                        @elseif($code->expires_at && $code->expires_at->isPast())
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300">Expired</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]">Active</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="py-3.5 px-3 text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <form action="{{ route('admin.promo-codes.toggle-status', $code->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 rounded-md text-[10px] font-bold transition cursor-pointer {{ $code->is_active ? 'btn-secondary' : 'btn-primary' }}">
                                                    {{ $code->is_active ? 'Disable' : 'Enable' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.promo-codes.destroy', $code->id) }}" method="POST" onsubmit="return confirm('Delete promo code {{ $code->code }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 rounded-md hover:bg-rose-50 dark:hover:bg-rose-950 text-rose-600 dark:text-rose-400 transition cursor-pointer" title="Delete">
                                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-[var(--text-muted)] text-xs">
                                        No promo codes created yet. Use the form on the left to generate one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Info Box -->
            <div class="card-ledger p-4 bg-[var(--bg-subtle)] text-xs text-[var(--text-secondary)] space-y-1">
                <span class="font-bold flex items-center gap-1.5 text-[var(--text-primary)]">
                    <svg class="w-4 h-4 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="9" y1="18" x2="15" y2="18"/><line x1="10" y1="22" x2="14" y2="22"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>
                    <span>Special User Discounts Guide:</span>
                </span>
                <p class="text-[11px] leading-relaxed text-[var(--text-muted)]">
                    When creating a promo code targeted at <strong>Special Users</strong>, only logged-in seekers whose email addresses match the allowed list can redeem it. If another user attempts to apply the code, or attempts to apply it to a package other than the target package (e.g. Pro), the checkout engine securely blocks the discount and explains why.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection

