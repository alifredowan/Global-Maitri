@extends('layouts.app')

@section('title', 'Admin Dashboard - Global Maitri')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

    <!-- Top Atmospheric Banner -->
    <div class="card-monograph p-6 sm:p-8 relative overflow-hidden bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-[3px] bg-[var(--saffron-gold)]/10 text-[var(--saffron-gold)] text-xs font-mono uppercase tracking-wider mb-2 border border-[var(--saffron-gold)]/25">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>Trust &amp; Operations Center</span>
                </div>
                <h1 class="font-serif font-bold text-2xl sm:text-3xl text-[var(--text-primary)]">
                    Administrative &amp; Safety Operations
                </h1>
                <p class="text-xs text-[var(--text-secondary)] mt-1 max-w-2xl leading-relaxed">
                    Platform governance, KYC verification queue, reports handling, and immutable audit logs (FR-7.1 - 7.5).
                </p>
            </div>
            <div class="flex items-center gap-2 self-start sm:self-center shrink-0">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-[4px] text-xs font-semibold bg-[var(--color-primary-soft)] text-[var(--color-accent)] border border-[var(--color-border)]">
                    <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)] animate-pulse"></span>
                    System Operational
                </span>
            </div>
        </div>
    </div>

    <!-- Metrics Grid (FR-7.4) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="card-ledger p-5">
            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">Total Users</span>
            <span class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">{{ $metrics['total_users'] }}</span>
            <span class="text-[10px] text-[var(--text-secondary)] block mt-1">{{ $metrics['seekers'] }} Seekers • {{ $metrics['walis'] }} Family Reps (Kalyāṇa-Mittas)</span>
        </div>

        <div class="card-ledger p-5">
            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">KYC Verified</span>
            <span class="text-2xl font-extrabold text-[var(--accent-primary)] font-heading">{{ $metrics['verified_users'] }}</span>
            <span class="text-[10px] text-[var(--text-secondary)] block mt-1">{{ $metrics['pending_verifications'] }} pending review</span>
        </div>

        <div class="card-ledger p-5">
            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">Active Chats</span>
            <span class="text-2xl font-extrabold text-[var(--accent-primary)] font-heading">{{ $metrics['active_conversations'] }}</span>
            <span class="text-[10px] text-[var(--text-secondary)] block mt-1">Chaperoned sessions</span>
        </div>

        <div class="card-ledger p-5">
            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">Active Reports</span>
            <span class="text-2xl font-extrabold text-[var(--color-danger)] font-heading">{{ $metrics['pending_reports'] }}</span>
            <span class="text-[10px] text-[var(--text-secondary)] block mt-1">&lt; 24hr SLA target</span>
        </div>

        <div class="card-ledger p-5">
            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">Paid Members</span>
            <span class="text-2xl font-extrabold text-[var(--color-accent)] font-heading">{{ $metrics['paying_subscribers'] }}</span>
            <span class="text-[10px] text-[var(--text-secondary)] block mt-1">Single Pass Active</span>
        </div>

        <div class="card-ledger p-5">
            <span class="text-[11px] font-bold text-[var(--text-muted)] uppercase tracking-wider block mb-1">Total Revenue</span>
            <span class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">${{ number_format($metrics['total_revenue'], 2) }}</span>
            <span class="text-[10px] text-[var(--text-secondary)] block mt-1">Stripe tokenized</span>
        </div>
    </div>

    <!-- Subscription Packages & Promo Codes Quick Access (Super Admin) -->
    <div class="card-ledger p-6 space-y-4">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-3 border-b border-[var(--border-default)]">
            <div>
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading flex items-center gap-2">
                    <svg class="w-5 h-5 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Subscription Packaging &amp; Promo System</span>
                </h2>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">Manage live subscription tiers, configure daily limits &amp; feature flags, and create promo codes with special VIP user discounts.</p>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('admin.packages.index') }}" class="btn-primary text-xs px-3.5 py-2 flex items-center gap-1.5 font-bold">
                    <span>Setup Packages ({{ $metrics['active_packages'] ?? 0 }} Active)</span>
                </a>
                <a href="{{ route('admin.promo-codes.index') }}" class="btn-secondary text-xs px-3.5 py-2 flex items-center gap-1.5 font-bold">
                    <span>Promo Codes ({{ $metrics['active_promo_codes'] ?? 0 }} Active)</span>
                </a>
                <a href="{{ route('admin.payment-settings') }}" class="btn-secondary text-xs px-3.5 py-2 flex items-center gap-1.5 font-bold">
                    <span>Payment Gateways</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Dynamic Package Setup Box -->
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex flex-col justify-between space-y-3">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[var(--accent-primary)] uppercase tracking-wider">Dynamic Package Generator</span>
                        <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">{{ $metrics['active_packages'] ?? 0 }} Live Tiers</span>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] mt-1.5">
                        Super admin can setup custom packages with 1-time marriage pass pricing, custom daily limits (views, interests), search boost, and custom highlight badges.
                    </p>
                </div>
                <div class="flex items-center gap-2 pt-2 border-t border-[var(--border-subtle)]">
                    <a href="{{ route('admin.packages.index') }}" class="text-xs font-bold text-[var(--accent-primary)] hover:underline flex items-center gap-1">
                        Go to Package Setup Screen &rarr;
                    </a>
                </div>
            </div>

            <!-- Targeted Promo Code Box -->
            <div class="p-4 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex flex-col justify-between space-y-3">
                <div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[var(--accent-primary)] uppercase tracking-wider">Promo Codes &amp; Metta Discounts</span>
                        <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">{{ $metrics['active_promo_codes'] ?? 0 }} Live Codes</span>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] mt-1.5">
                        Generate promo codes for specific packages (e.g. Pro package) and assign extra discounts for designated special users (by email) with instant AJAX checkout validation.
                    </p>
                </div>
                <div class="flex items-center gap-2 pt-2 border-t border-[var(--border-subtle)]">
                    <a href="{{ route('admin.promo-codes.index') }}" class="text-xs font-bold text-[var(--accent-primary)] hover:underline flex items-center gap-1">
                        Go to Promo Code Generator Screen &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Pending KYC Verification Queue (FR-7.1) -->
        <div class="card-ledger p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border-default)]">
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Pending KYC Verifications</h2>
                <a href="{{ route('admin.verifications') }}" class="text-xs text-[var(--accent-primary)] font-bold hover:underline">View All &rarr;</a>
            </div>

            <div class="space-y-3">
                @forelse($recentVerifications as $v)
                    <div class="p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-between gap-3 text-xs">
                        <div>
                            <strong class="text-[var(--text-primary)] block font-bold">{{ $v->user->name }}</strong>
                            <span class="text-[var(--text-secondary)] capitalize">{{ str_replace('_', ' ', $v->document_type) }} • Submitted {{ $v->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('admin.verifications.approve', $v->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary text-[11px] px-3 py-1.5 font-bold cursor-pointer">
                                    Approve
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-[var(--text-muted)] text-center py-6">No pending KYC verifications in the queue.</p>
                @endforelse
            </div>
        </div>

        <!-- Pending User Reports Queue (FR-7.2) -->
        <div class="card-ledger p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border-default)]">
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">User Reports &amp; Moderation Queue</h2>
                <a href="{{ route('admin.reports') }}" class="text-xs text-[var(--color-danger)] font-bold hover:underline">View All &rarr;</a>
            </div>

            <div class="space-y-3">
                @forelse($recentReports as $r)
                    <div class="p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] flex items-center justify-between gap-3 text-xs">
                        <div>
                            <span class="font-bold text-[var(--text-primary)]">{{ $r->reported->name }}</span> reported by <span class="text-[var(--text-secondary)]">{{ $r->reporter->name }}</span>
                            <span class="text-[var(--color-danger)] block font-semibold capitalize">{{ str_replace('_', ' ', $r->reason) }}</span>
                        </div>
                        <a href="{{ route('admin.reports') }}" class="btn-secondary text-[11px] px-3 py-1.5 font-bold">
                            Review
                        </a>
                    </div>
                @empty
                    <p class="text-xs text-[var(--text-muted)] text-center py-6">No user reports pending moderation.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Immutable Audit Log Summary (FR-7.5) -->
    <div class="card-ledger p-6 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-[var(--border-default)]">
            <div>
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Immutable Platform Audit Trail (FR-7.5)</h2>
                <p class="text-xs text-[var(--text-muted)]">Chronological records of all administrative, moderation, and verification decisions.</p>
            </div>
            <a href="{{ route('admin.audit-logs') }}" class="text-xs text-[var(--accent-primary)] font-bold hover:underline">Full Audit Log &rarr;</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-[var(--text-secondary)]">
                <thead class="bg-[var(--bg-subtle)] text-[var(--text-primary)] uppercase font-bold text-[10px]">
                    <tr>
                        <th class="p-3 rounded-l-[4px]">Timestamp</th>
                        <th class="p-3">User / Actor</th>
                        <th class="p-3">Action</th>
                        <th class="p-3">Target</th>
                        <th class="p-3">IP Address</th>
                        <th class="p-3 rounded-r-[4px]">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @foreach($recentAuditLogs as $log)
                        <tr class="hover:bg-[var(--bg-subtle)]/50">
                            <td class="p-3 font-mono text-[var(--text-muted)]">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-3 font-bold text-[var(--text-primary)]">{{ $log->user?->name ?? 'System' }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-[2px] font-mono text-[11px] bg-[var(--bg-subtle)] text-[var(--text-primary)] border border-[var(--border-default)]">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="p-3">{{ $log->target_type }} #{{ $log->target_id ?? '-' }}</td>
                            <td class="p-3 font-mono text-[var(--text-muted)]">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                            <td class="p-3 truncate max-w-xs text-[var(--text-muted)] font-mono text-[10px]">
                                {{ $log->details ? json_encode($log->details) : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
