@extends('layouts.app')

@section('title', 'Family Representative Settings - Global Maitri')

@section('content')
<div class="py-10 bg-slate-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xs flex items-center justify-between">
            <div>
                <div class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-primary-700 dark:text-primary-300 mb-1">
                    <span>🛡️</span>
                    <span>Family & Elder Guidance</span>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">Family Representative Linkage</h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Involve a parent, elder, trusted relative, or monk advisor to guide your marriage search with wisdom and blessings (FR-4.3).</p>
            </div>
            <span class="text-2xl">🪷</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Form -->
            <div class="md:col-span-2 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
                <h2 class="text-base font-bold text-slate-900 dark:text-white font-heading mb-1">Link a Family Representative</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                    Your representative must have a registered account on Global Maitri to be linked.
                </p>

                @if(session('success'))
                    <div class="mb-4 p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs text-emerald-800 dark:text-emerald-300">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-3.5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-xs text-rose-800 dark:text-rose-300">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('wali.link.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Representative's Full Name</label>
                        <input type="text" name="wali_name" required value="{{ old('wali_name') }}" placeholder="e.g. Dr. Sarath Wickramasinghe"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 text-xs focus:ring-2 focus:ring-primary-500 outline-none">
                        @error('wali_name')
                            <p class="text-rose-600 dark:text-rose-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Relationship to You</label>
                            <select name="relationship_type" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-primary-500 outline-none">
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
                                <p class="text-rose-600 dark:text-rose-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Permission Level (FR-6.2)</label>
                            <select name="permission_level" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-primary-500 outline-none">
                                <option value="approve_required" {{ old('permission_level') === 'approve_required' ? 'selected' : '' }}>Approval Required (Chat locked until Representative confirms)</option>
                                <option value="view_only" {{ old('permission_level') === 'view_only' ? 'selected' : '' }}>View-Only (Observer in chats & proposal reviews)</option>
                                <option value="full_proxy" {{ old('permission_level') === 'full_proxy' ? 'selected' : '' }}>Full Proxy (Manages profile communications)</option>
                            </select>
                            @error('permission_level')
                                <p class="text-rose-600 dark:text-rose-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                                Representative's Account Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" name="wali_email" required value="{{ old('wali_email') }}" placeholder="rep.account@domain.com"
                                   class="w-full px-4 py-2.5 rounded-xl border @error('wali_email') border-rose-500 ring-1 ring-rose-500 @else border-slate-300 dark:border-slate-700 @enderror bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 text-xs focus:ring-2 focus:ring-primary-500 outline-none">
                            @error('wali_email')
                                <p class="text-rose-600 dark:text-rose-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                            @else
                                <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-1">Must be an existing registered account on Global Maitri.</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Representative's Phone</label>
                            <input type="tel" name="wali_phone" value="{{ old('wali_phone') }}" placeholder="+94 77 123 4567"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 text-xs focus:ring-2 focus:ring-primary-500 outline-none">
                            @error('wali_phone')
                                <p class="text-rose-600 dark:text-rose-400 text-xs mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-purple-700 hover:bg-purple-800 text-white font-bold text-xs shadow-xs transition mt-2 cursor-pointer">
                        Save Family Representative Link
                    </button>
                </form>
            </div>

            <!-- Right Info / Current Links -->
            <div class="space-y-6">
                <div class="bg-purple-50 dark:bg-purple-950/40 rounded-3xl border border-purple-200 dark:border-purple-900/60 p-5 text-xs text-purple-900 dark:text-purple-300 leading-relaxed">
                    <h3 class="font-bold text-sm text-purple-950 dark:text-purple-200 mb-2 font-heading">Why Involve a Family Representative?</h3>
                    <p class="mb-2">In Buddhist family life, parents and respected elders offer guidance, moral support, and blessings throughout significant life transitions.</p>
                    <p>When "Approval Required" is chosen, candidate proposals are reviewed by your linked representative first to ensure serious, respectful intentions before direct chats start.</p>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-5 shadow-xs">
                    <h3 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-3">Linked Representatives</h3>
                    @forelse($existingLinks as $link)
                        <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-700/60 mb-2 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900 dark:text-white">{{ $link->wali_name ?? ($link->wali?->name ?? 'Representative') }}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-100 dark:bg-purple-950/70 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-800/60">{{ $link->status }}</span>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400 mt-1 capitalize">{{ str_replace('_', ' ', $link->relationship_type) }} • {{ str_replace('_', ' ', $link->permission_level) }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 dark:text-slate-500">No family representative currently linked.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
