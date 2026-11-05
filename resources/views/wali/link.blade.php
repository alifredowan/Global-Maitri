@extends('layouts.app')

@section('title', 'Family Representative Settings - Global Maitri')

@section('content')
<div class="py-10 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="card-ledger p-6 flex items-center justify-between">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-[var(--accent-primary)] mb-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>Family &amp; Elder Guidance</span>
                </div>
                <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">Family Representative Linkage</h1>
                <p class="text-xs text-[var(--text-secondary)] mt-1">Involve a parent, elder, trusted relative, or monk advisor to guide your marriage search with wisdom and blessings (FR-4.3).</p>
            </div>
            <div class="h-10 w-10 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                    <circle cx="12" cy="12" r="9"/>
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                </svg>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Form -->
            <div class="md:col-span-2 card-ledger p-6">
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading mb-1">Link a Family Representative</h2>
                <p class="text-xs text-[var(--text-secondary)] mb-4">
                    Your representative must have a registered account on Global Maitri to be linked.
                </p>

                @if(session('success'))
                    <div class="mb-4 p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-success)] text-xs text-[var(--color-success)]">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-3.5 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--color-danger)] text-xs text-[var(--color-danger)]">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('wali.link.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">Representative's Full Name</label>
                        <input type="text" name="wali_name" required value="{{ old('wali_name') }}" placeholder="e.g. Dr. Sarath Wickramasinghe"
                               class="input-field text-xs">
                        @error('wali_name')
                            <p class="text-[var(--color-danger)] text-xs mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">Relationship to You</label>
                            <select name="relationship_type" required class="input-field text-xs">
                                <option value="father" {{ old('relationship_type') === 'father' ? 'selected' : '' }}>Father</option>
                                <option value="mother" {{ old('relationship_type') === 'mother' ? 'selected' : '' }}>Mother</option>
                                <option value="brother" {{ old('relationship_type') === 'brother' ? 'selected' : '' }}>Brother</option>
                                <option value="sister" {{ old('relationship_type') === 'sister' ? 'selected' : '' }}>Sister</option>
                                <option value="uncle" {{ old('relationship_type') === 'uncle' ? 'selected' : '' }}>Uncle</option>
                                <option value="aunt" {{ old('relationship_type') === 'aunt' ? 'selected' : '' }}>Aunt</option>
                                <option value="grandparent" {{ old('relationship_type') === 'grandparent' ? 'selected' : '' }}>Grandparent</option>
                                <option value="other_relative" {{ old('relationship_type') === 'other_relative' ? 'selected' : '' }}>Trusted Elder / Relative</option>
                                <option value="monk_advisor" {{ old('relationship_type') === 'monk_advisor' ? 'selected' : '' }}>Monk / Sangha Advisor</option>
                            </select>
                            @error('relationship_type')
                                <p class="text-[var(--color-danger)] text-xs mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">Permission Level (FR-6.2)</label>
                            <select name="permission_level" required class="input-field text-xs">
                                <option value="approve_required" {{ old('permission_level') === 'approve_required' ? 'selected' : '' }}>Approval Required (Chat locked until Representative confirms)</option>
                                <option value="view_only" {{ old('permission_level') === 'view_only' ? 'selected' : '' }}>View-Only (Observer in chats &amp; proposal reviews)</option>
                                <option value="full_proxy" {{ old('permission_level') === 'full_proxy' ? 'selected' : '' }}>Full Proxy (Manages profile communications)</option>
                            </select>
                            @error('permission_level')
                                <p class="text-[var(--color-danger)] text-xs mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                Representative's Account Email <span class="text-[var(--color-danger)]">*</span>
                            </label>
                            <input type="email" name="wali_email" required value="{{ old('wali_email') }}" placeholder="rep.account@domain.com"
                                   class="input-field text-xs @error('wali_email') border-[var(--color-danger)] @enderror">
                            @error('wali_email')
                                <p class="text-[var(--color-danger)] text-xs mt-1 font-semibold">{{ $message }}</p>
                            @else
                                <p class="text-[11px] text-[var(--text-muted)] mt-1">Must be an existing registered account on Global Maitri.</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">Representative's Phone</label>
                            <input type="tel" name="wali_phone" value="{{ old('wali_phone') }}" placeholder="+94 77 123 4567"
                                   class="input-field text-xs">
                            @error('wali_phone')
                                <p class="text-[var(--color-danger)] text-xs mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full py-3 text-xs font-bold mt-3 cursor-pointer">
                        Save Family Representative Link
                    </button>
                </form>
            </div>

            <!-- Right Info / Current Links -->
            <div class="space-y-6">
                <div class="card-ledger p-5 text-xs text-[var(--text-secondary)] leading-relaxed bg-[var(--bg-subtle)]">
                    <h3 class="font-bold text-sm text-[var(--text-primary)] mb-2 font-heading">Why Involve a Family Representative?</h3>
                    <p class="mb-2">In Buddhist family life, parents and respected elders offer guidance, moral support, and blessings throughout significant life transitions.</p>
                    <p>When "Approval Required" is chosen, candidate proposals are reviewed by your linked representative first to ensure serious, respectful intentions before direct chats start.</p>
                </div>

                <div class="card-ledger p-5">
                    <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-3">Linked Representatives</h3>
                    @forelse($existingLinks as $link)
                        <div class="p-3 rounded-[4px] bg-[var(--bg-subtle)] border border-[var(--border-default)] mb-2 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-[var(--text-primary)]">{{ $link->wali_name ?? ($link->wali?->name ?? 'Representative') }}</span>
                                <span class="px-2 py-0.5 rounded-[4px] text-[10px] font-bold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">{{ $link->status }}</span>
                            </div>
                            <p class="text-[var(--text-secondary)] mt-1 capitalize">{{ str_replace('_', ' ', $link->relationship_type) }} • {{ str_replace('_', ' ', $link->permission_level) }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-[var(--text-muted)]">No family representative currently linked.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
