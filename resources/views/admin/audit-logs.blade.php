@extends('layouts.app')

@section('title', 'Platform Audit Logs - Admin')
@section('page_title', 'Audit Logs')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
            <span>Immutable Security Journal</span>
        </div>
        <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Platform Immutable Audit Logs</h1>
        <p class="text-xs text-[var(--text-muted)] mt-0.5">Tamper-evident logs of security events, administrative decisions, and moderation actions.</p>
    </div>

    <div class="card-ledger overflow-hidden">
        <table class="w-full text-left text-xs text-[var(--text-secondary)]">
            <thead class="bg-[var(--bg-subtle)] text-[var(--text-muted)] uppercase font-bold text-[10px] tracking-wider border-b border-[var(--border-subtle)]">
                <tr>
                    <th class="p-4">Timestamp (UTC)</th>
                    <th class="p-4">Actor</th>
                    <th class="p-4">Action Event</th>
                    <th class="p-4">Target Entity</th>
                    <th class="p-4">Client IP</th>
                    <th class="p-4">Metadata Payload</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border-subtle)] font-mono text-[11px]">
                @forelse($logs as $log)
                    <tr class="hover:bg-[var(--bg-subtle)]/50 transition">
                        <td class="p-4 text-[var(--text-muted)] whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="p-4 font-sans font-bold text-[var(--text-primary)]">{{ $log->user?->name ?? 'Guest / System' }}</td>
                        <td class="p-4">
                            <span class="px-2 py-0.5 rounded bg-[var(--bg-subtle)] text-[var(--accent-primary)] border border-[var(--border-default)] font-bold">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="p-4 font-sans text-[var(--text-secondary)]">{{ $log->target_type }} #{{ $log->target_id ?? '-' }}</td>
                        <td class="p-4 text-[var(--text-muted)]">{{ $log->ip_address ?? '127.0.0.1' }}</td>
                        <td class="p-4 max-w-sm truncate text-[var(--text-muted)] font-mono text-[10px]">
                            {{ $log->details ? json_encode($log->details) : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-[var(--text-muted)] font-sans">No audit events logged yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[var(--border-subtle)]">
            {{ $logs->links() }}
        </div>
    </div>

</div>
@endsection
