@extends('layouts.app')

@section('title', 'KYC Verification Requests - Admin')
@section('page_title', 'KYC Verifications')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Identity &amp; KYC Verification Queue</h1>
            <p class="text-xs text-[var(--text-secondary)] mt-0.5">Review national IDs, passports, and verify matrimonial candidates.</p>
        </div>
    </div>

    <div class="card-ledger overflow-hidden">
        <table class="w-full text-left text-xs text-[var(--text-secondary)]">
            <thead class="bg-[var(--bg-subtle)] text-[var(--text-primary)] uppercase font-bold text-[10px] border-b border-[var(--border-default)]">
                <tr>
                    <th class="p-4">Candidate</th>
                    <th class="p-4">Document Type</th>
                    <th class="p-4">Submitted</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border-subtle)]">
                @forelse($verifications as $v)
                    <tr class="hover:bg-[var(--bg-subtle)]/50 transition">
                        <td class="p-4">
                            <strong class="text-[var(--text-primary)] block font-bold text-sm">{{ $v->user->name }}</strong>
                            <span class="text-[var(--text-muted)]">{{ $v->user->email }}</span>
                        </td>
                        <td class="p-4 capitalize font-semibold text-[var(--text-primary)]">
                            {{ str_replace('_', ' ', $v->document_type) }}
                            <div class="mt-1 flex gap-2 text-[10px] normal-case">
                                <a href="{{ route('admin.verifications.documents', [$v->id, 'document']) }}" class="text-[var(--accent-primary)] hover:underline">Download ID</a>
                                @if($v->selfie_path)
                                    <a href="{{ route('admin.verifications.documents', [$v->id, 'selfie']) }}" class="text-[var(--accent-primary)] hover:underline">Download selfie</a>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 text-[var(--text-muted)]">
                            {{ $v->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-[4px] font-bold text-[10px] {{ $v->status === 'approved' ? 'bg-[var(--bg-subtle)] text-[var(--color-success)] border border-[var(--color-success)]' : ($v->status === 'rejected' ? 'bg-[var(--bg-subtle)] text-[var(--color-danger)] border border-[var(--color-danger)]' : 'bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20') }}">
                                {{ ucfirst($v->status) }}
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-2">
                            @if($v->status === 'pending')
                                <form action="{{ route('admin.verifications.approve', $v->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn-primary text-xs px-3 py-1.5 font-bold cursor-pointer">
                                        &check; Approve &amp; Badge
                                    </button>
                                </form>
                                <button type="button" onclick="openRejectModal({{ $v->id }})" class="btn-secondary text-xs px-3 py-1.5 font-bold text-[var(--color-danger)] border-[var(--border-default)] cursor-pointer">
                                    Reject
                                </button>
                            @else
                                <span class="text-[var(--text-muted)] text-xs">Reviewed by {{ $v->reviewer?->name ?? 'Admin' }}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-[var(--text-muted)]">No verification requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[var(--border-default)]">
            {{ $verifications->links() }}
        </div>
    </div>

</div>

<!-- Reject Modal -->
<div id="rejectVerificationModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="card-ledger max-w-md w-full p-6 shadow-2xl">
        <h3 class="text-lg font-bold text-[var(--text-primary)] mb-2 font-heading">Reject Verification Request</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Rejection Reason</label>
                <textarea name="rejection_reason" required rows="3" class="input-field text-xs" placeholder="e.g. Image was blurry or mismatched name on legal ID..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="button" onclick="document.getElementById('rejectVerificationModal').classList.add('hidden')" class="btn-secondary text-xs px-4 py-2">Cancel</button>
                <button type="submit" class="btn-secondary text-xs px-4 py-2 font-bold text-[var(--color-danger)] border-[var(--border-default)]">Confirm Rejection</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectModal(id) {
        const form = document.getElementById('rejectForm');
        form.action = '/admin/verifications/' + id + '/reject';
        document.getElementById('rejectVerificationModal').classList.remove('hidden');
    }
</script>
@endsection
