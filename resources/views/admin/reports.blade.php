@extends('layouts.app')

@section('title', 'User Reports Moderation - Admin')
@section('page_title', 'Safety & Reports')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

    <div>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            <span>Platform Conduct & Safety</span>
        </div>
        <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">User Reports & Moderation Queue</h1>
        <p class="text-xs text-[var(--text-muted)] mt-0.5">Investigate reported conduct violations, modesty breaches, and apply account restrictions.</p>
    </div>

    <div class="card-ledger overflow-hidden">
        <table class="w-full text-left text-xs text-[var(--text-secondary)]">
            <thead class="bg-[var(--bg-subtle)] text-[var(--text-muted)] uppercase font-bold text-[10px] tracking-wider border-b border-[var(--border-subtle)]">
                <tr>
                    <th class="p-4">Reported Candidate</th>
                    <th class="p-4">Reporter</th>
                    <th class="p-4">Reason / Violation</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Moderation Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border-subtle)]">
                @forelse($reports as $r)
                    <tr class="hover:bg-[var(--bg-subtle)]/50 transition">
                        <td class="p-4">
                            <strong class="text-[var(--text-primary)] block font-bold text-sm">{{ $r->reported->name }}</strong>
                            <span class="text-[var(--text-muted)]">Account status: {{ $r->reported->is_active ? 'Active' : 'Suspended' }}</span>
                        </td>
                        <td class="p-4">
                            <span class="font-semibold text-[var(--text-primary)]">{{ $r->reporter->name }}</span>
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-rose-700 dark:text-rose-400 block capitalize">{{ str_replace('_', ' ', $r->reason) }}</span>
                            <span class="text-[var(--text-muted)] line-clamp-1 italic">{{ $r->details ?? 'No additional note' }}</span>
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full font-bold text-[10px] {{ $r->status === 'actioned' ? 'bg-[var(--color-success-bg)] text-[var(--color-success)] border border-[var(--color-success-border)]' : ($r->status === 'dismissed' ? 'bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]' : 'bg-rose-100 dark:bg-rose-950/70 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800/60') }}">
                                {{ ucfirst($r->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            @if($r->status === 'pending')
                                <div class="inline-flex gap-1.5">
                                    <form action="{{ route('admin.reports.action', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="warn">
                                        <button type="submit" class="px-2.5 py-1 rounded-md bg-amber-100 dark:bg-amber-950/70 text-amber-900 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60 font-bold hover:bg-amber-200 dark:hover:bg-amber-900/60 text-[11px] transition cursor-pointer">
                                            Warn
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reports.action', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="suspend">
                                        <button type="submit" class="px-2.5 py-1 rounded-md bg-rose-600 text-white font-bold hover:bg-rose-700 text-[11px] transition cursor-pointer">
                                            Suspend
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reports.action', $r->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="action" value="dismiss">
                                        <button type="submit" class="btn-secondary text-[11px] px-2 py-1">
                                            Dismiss
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-[var(--text-muted)] text-[11px]">Action: {{ $r->action_taken }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-[var(--text-muted)]">No reported content in the queue.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[var(--border-subtle)]">
            {{ $reports->links() }}
        </div>
    </div>

</div>
@endsection

