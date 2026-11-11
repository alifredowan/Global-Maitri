@extends('layouts.app')

@section('title', 'Family Representative Linkage — Global Maitri')

@section('content')
<div class="py-8 sm:py-10 bg-[var(--bg-canvas)] min-h-[calc(100vh-160px)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="rounded-[var(--radius-lg)] p-6 sm:p-8 bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-xs space-y-2">
            <p class="text-xs font-semibold uppercase tracking-wider text-[var(--accent-primary)]">Family consultation</p>
            <h1 class="font-heading text-2xl sm:text-3xl font-bold text-[var(--text-primary)]">Link a family representative</h1>
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] leading-relaxed max-w-2xl">
                Involve a parent, elder, trusted relative, or spiritual mentor to guide your marriage search with wisdom, shared values, and family blessings.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Form -->
            <div class="md:col-span-2 card-monograph p-6 space-y-4">
                <div>
                    <h2 class="font-heading text-base font-bold text-[var(--text-primary)]">Representative details</h2>
                    <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                        Your representative must have a registered account on Global Maitri to be linked. Family accounts are completely free.
                    </p>
                </div>

                @if(session('success'))
                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-success)] text-xs text-[var(--color-success)] font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--bg-surface)] border border-[var(--color-danger)] text-xs text-[var(--color-danger)] font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('wali.link.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Representative's full name <span class="text-[var(--color-danger)]">*</span></label>
                        <input type="text" name="wali_name" required value="{{ old('wali_name') }}" placeholder="e.g. Dr. Sarath Wickramasinghe"
                               class="input-field text-xs w-full">
                        @error('wali_name')
                            <p class="text-[var(--color-danger)] text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Relationship to you <span class="text-[var(--color-danger)]">*</span></label>
                            <select name="relationship_type" required class="input-field text-xs w-full">
                                <option value="father" {{ old('relationship_type') === 'father' ? 'selected' : '' }}>Father</option>
                                <option value="mother" {{ old('relationship_type') === 'mother' ? 'selected' : '' }}>Mother</option>
                                <option value="brother" {{ old('relationship_type') === 'brother' ? 'selected' : '' }}>Brother</option>
                                <option value="sister" {{ old('relationship_type') === 'sister' ? 'selected' : '' }}>Sister</option>
                                <option value="uncle" {{ old('relationship_type') === 'uncle' ? 'selected' : '' }}>Uncle</option>
                                <option value="aunt" {{ old('relationship_type') === 'aunt' ? 'selected' : '' }}>Aunt</option>
                                <option value="grandparent" {{ old('relationship_type') === 'grandparent' ? 'selected' : '' }}>Grandparent</option>
                                <option value="other_relative" {{ old('relationship_type') === 'other_relative' ? 'selected' : '' }}>Trusted elder or relative</option>
                                <option value="monk_advisor" {{ old('relationship_type') === 'monk_advisor' ? 'selected' : '' }}>Monk / Sangha advisor</option>
                                <option value="kalyanamitta" {{ old('relationship_type') === 'kalyanamitta' ? 'selected' : '' }}>Kalyāṇa-Mitta (Spiritual mentor)</option>
                                <option value="guardian" {{ old('relationship_type') === 'guardian' ? 'selected' : '' }}>Guardian</option>
                            </select>
                            @error('relationship_type')
                                <p class="text-[var(--color-danger)] text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Involvement level <span class="text-[var(--color-danger)]">*</span></label>
                            <select name="permission_level" required class="input-field text-xs w-full">
                                <option value="approve_required" {{ old('permission_level') === 'approve_required' ? 'selected' : '' }}>Approval required (Representative confirms suitors before chat)</option>
                                <option value="view_only" {{ old('permission_level') === 'view_only' ? 'selected' : '' }}>Observer (Advisor can view conversations and proposals)</option>
                                <option value="full_proxy" {{ old('permission_level') === 'full_proxy' ? 'selected' : '' }}>Full proxy (Representative manages introductions)</option>
                            </select>
                            @error('permission_level')
                                <p class="text-[var(--color-danger)] text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                            Representative's account email <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="email" name="wali_email" required value="{{ old('wali_email') }}" placeholder="rep.account@domain.com"
                               class="input-field text-xs w-full @error('wali_email') border-[var(--color-danger)] @enderror">
                        @error('wali_email')
                            <p class="text-[var(--color-danger)] text-xs mt-1">{{ $message }}</p>
                        @else
                            <p class="text-[11px] text-[var(--text-muted)] mt-1">Must be an existing registered account on Global Maitri.</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-primary text-xs !py-2.5 !px-5">
                            Send linkage request &rarr;
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Explainer -->
            <div class="space-y-4">
                <div class="card-monograph p-5 space-y-3">
                    <h3 class="font-heading font-bold text-sm text-[var(--text-primary)]">Why involve family?</h3>
                    <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                        In traditional Buddhist communities, marriage is a harmonious union between two families. Having parents or trusted mentors review suitors fosters genuine trust and eases communication for both parties.
                    </p>
                    <ul class="text-xs text-[var(--text-muted)] space-y-1.5 list-disc list-inside pt-1">
                        <li>Free forever for representatives</li>
                        <li>Protects from unwanted advances</li>
                        <li>Encourages honest, respectful courtship</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
