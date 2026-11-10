@extends('layouts.app')

@section('title', 'Register - Global Maitri')

@section('content')
<div class="py-10 bg-[var(--bg-canvas)] min-h-screen" x-data="{ role: '{{ old('role', 'seeker') }}' }">
    <div class="max-w-xl mx-auto px-4 sm:px-6">
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-xs p-6 sm:p-8 space-y-6">
            
            <!-- Header -->
            <div class="text-center space-y-2">
                <x-application-logo variant="badge" badge-class="w-12 h-12 mx-auto" />
                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--text-primary)] font-heading">
                    <span x-show="role === 'seeker'">Create Candidate Profile</span>
                    <span x-show="role === 'wali'" style="display: none;">Register as Family Representative &amp; Kalyāṇa-Mitta</span>
                </h1>
                <p class="text-xs text-[var(--text-secondary)] max-w-md mx-auto">
                    <span x-show="role === 'seeker'">Begin your journey towards a lifelong union rooted in loving-kindness (Metta) and mutual respect.</span>
                    <span x-show="role === 'wali'" style="display: none;">Guide and support your family member or ward with mindful Buddhist Kalyāṇa-Mitta mentorship.</span>
                </p>
            </div>

            <!-- Role Selection Options -->
            <div class="space-y-2">
                <label class="block text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)]">I am registering as:</label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" @click="role = 'seeker'"
                            :class="role === 'seeker' ? 'border-[var(--accent-primary)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] ring-1 ring-[var(--accent-primary)]' : 'border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] hover:border-[var(--border-strong)]'"
                            class="p-3.5 rounded-[var(--radius-sm)] border text-left transition flex flex-col justify-between cursor-pointer">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 rounded-full" :class="role === 'seeker' ? 'bg-[var(--accent-primary)]' : 'bg-[var(--border-default)]'"></span>
                            <span class="font-bold text-xs text-[var(--text-primary)] font-heading">Candidate / Seeker</span>
                        </div>
                        <p class="text-[10px] text-[var(--text-muted)]">Seeking a lifelong partner for myself (Groom or Bride).</p>
                    </button>

                    <button type="button" @click="role = 'wali'"
                            :class="role === 'wali' ? 'border-[var(--accent-primary)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] ring-1 ring-[var(--accent-primary)]' : 'border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--text-secondary)] hover:border-[var(--border-strong)]'"
                            class="p-3.5 rounded-[var(--radius-sm)] border text-left transition flex flex-col justify-between cursor-pointer">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 rounded-full" :class="role === 'wali' ? 'bg-[var(--accent-primary)]' : 'bg-[var(--border-default)]'"></span>
                            <span class="font-bold text-xs text-[var(--text-primary)] font-heading">Family Rep / Kalyāṇa-Mitta</span>
                        </div>
                        <p class="text-[10px] text-[var(--text-muted)]">Parent, elder, relative, or spiritual mentor (Kalyāṇa-Mitta) guiding a candidate.</p>
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-danger-bg)] border border-[var(--color-danger-border)] text-[var(--color-danger)] text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Hidden Input for Selected Role -->
                <input type="hidden" name="role" :value="role">

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                        <span x-show="role === 'seeker'">Full Legal Name</span>
                        <span x-show="role === 'wali'" style="display: none;">Representative / Kalyāṇa-Mitta Legal Name</span>
                        <span class="text-[var(--color-danger)]">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="input-field text-xs w-full"
                           :placeholder="role === 'seeker' ? 'e.g. Ananda Wickramasinghe' : 'e.g. Dr. Sarath Wickramasinghe'">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Email Address <span class="text-[var(--color-danger)]">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="input-field text-xs w-full"
                               placeholder="your.email@domain.com">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Phone Number</label>
                        <div class="flex gap-2"
                             x-data="{
                                open: false,
                                search: '',
                                selected: '{{ old('phone_country', '') }}',
                                countries: @js($countries),
                                get filtered() {
                                    const q = this.search.trim().toLowerCase();
                                    return Object.entries(this.countries).filter(([code, c]) => {
                                        return !q || c.name.toLowerCase().includes(q) || c.dial_code.includes(q) || code.toLowerCase().includes(q);
                                    });
                                },
                                get selectedCountry() {
                                    return this.selected ? this.countries[this.selected] : null;
                                },
                                choose(code) {
                                    this.selected = code;
                                    this.open = false;
                                    this.search = '';
                                }
                             }"
                             @click.outside="open = false">
                            <div class="relative w-24 shrink-0">
                                <input type="hidden" name="phone_country" :value="selected">
                                <button type="button" @click="open = !open"
                                        class="input-field text-xs w-full flex items-center justify-between gap-1 !py-1">
                                    <span x-text="selectedCountry ? ('+' + selectedCountry.dial_code) : 'Code'" class="truncate"></span>
                                    <svg class="w-3.5 h-3.5 text-[var(--text-muted)] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-cloak
                                     class="absolute z-30 mt-1 w-60 max-h-72 overflow-hidden rounded-[var(--radius-sm)] border border-[var(--border-default)] bg-[var(--bg-surface)] shadow-lg flex flex-col">
                                    <div class="p-2 border-b border-[var(--border-subtle)]">
                                        <input type="text" x-model="search" x-ref="countrySearch" @click.stop
                                               placeholder="Search country..."
                                               class="input-field text-xs w-full !h-8 !py-1">
                                    </div>
                                    <div class="overflow-y-auto">
                                        <template x-for="[code, c] in filtered" :key="code">
                                            <button type="button" @click="choose(code)"
                                                    class="w-full text-left px-3 py-1.5 text-xs text-[var(--text-secondary)] hover:bg-[var(--bg-subtle)] flex items-center justify-between gap-2">
                                                <span class="truncate" x-text="c.name"></span>
                                                <span class="text-[var(--text-muted)] shrink-0" x-text="'+' + c.dial_code"></span>
                                            </button>
                                        </template>
                                        <p x-show="filtered.length === 0" class="px-3 py-2 text-xs text-[var(--text-muted)]">No country found.</p>
                                    </div>
                                </div>
                            </div>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="input-field text-xs flex-1 min-w-0"
                                   placeholder="77 123 4567">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Gender <span class="text-[var(--color-danger)]">*</span></label>
                        <select name="gender" required class="input-field text-xs w-full">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male (Groom / Suitor)</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female (Bride / Suitor)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">
                            Date of Birth (18+ Enforced) <span class="text-[var(--color-danger)]">*</span>
                        </label>
                        <input type="text" name="dob" value="{{ old('dob') }}" required
                               inputmode="numeric" placeholder="dd/mm/yyyy" maxlength="10"
                               pattern="\d{2}/\d{2}/\d{4}"
                               x-data
                               x-on:input="$el.value = $el.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d)/, '$1/$2').replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3').slice(0, 10)"
                               class="input-field text-xs w-full">
                        <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Format: dd/mm/yyyy.</span>
                    </div>
                </div>

                <!-- Seeker-specific Field: Marital Status -->
                <div x-show="role === 'seeker'">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Marital Status (Monogamy Enforced) <span class="text-[var(--color-danger)]">*</span></label>
                    <select name="marital_status" :required="role === 'seeker'" class="input-field text-xs w-full">
                        <option value="">Select Marital Status</option>
                        <option value="never_married" {{ old('marital_status', 'never_married') === 'never_married' ? 'selected' : '' }}>Single / Never Married</option>
                        <option value="divorced" {{ old('marital_status') === 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ old('marital_status') === 'widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="annulled" {{ old('marital_status') === 'annulled' ? 'selected' : '' }}>Annulled</option>
                    </select>
                    <span class="text-[10px] text-[var(--text-muted)] block mt-0.5">Currently married individuals are excluded. Divorced and widowed candidates are welcomed.</span>
                </div>

                <!-- Family Representative-specific Field: Relationship -->
                <div x-show="role === 'wali'" style="display: none;">
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Relationship to Candidate / Seeker</label>
                    <select name="relationship_type" class="input-field text-xs w-full">
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
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Password <span class="text-[var(--color-danger)]">*</span></label>
                        <div class="relative" x-data="{ showPass: false }">
                            <input :type="showPass ? 'text' : 'password'" name="password" required
                                   class="input-field text-xs w-full pr-10"
                                   placeholder="••••••••">
                            <button type="button" @click="showPass = !showPass"
                                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                    :title="showPass ? 'Hide password' : 'View password'"
                                    tabindex="-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Confirm Password <span class="text-[var(--color-danger)]">*</span></label>
                        <div class="relative" x-data="{ showConfirm: false }">
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                                   class="input-field text-xs w-full pr-10"
                                   placeholder="••••••••">
                            <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                    :title="showConfirm ? 'Hide password' : 'View password'"
                                    tabindex="-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                @if($turnstileEnabled)
                    <div class="flex justify-center pt-2">
                        <div class="cf-turnstile" data-sitekey="{{ $turnstileSiteKey }}"></div>
                    </div>
                @endif

                <div class="pt-1">
                    <label class="flex items-start gap-2.5 text-xs text-[var(--text-secondary)] cursor-pointer select-none">
                        <input type="checkbox" name="terms" required class="mt-0.5 rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                        <span>
                            I affirm that I am using this platform strictly for Buddhist matrimony (Mangala Vivaha), zero dowry demands, and accept the <a href="{{ route('terms') }}" class="text-[var(--accent-primary)] underline font-medium">Terms of Service</a> and <a href="{{ route('privacy') }}" class="text-[var(--accent-primary)] underline font-medium">Privacy Policy</a>.
                        </span>
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full text-xs sm:text-sm !py-3 mt-3">
                    <span x-show="role === 'seeker'">Create Candidate Profile</span>
                    <span x-show="role === 'wali'" style="display: none;">Create Family Representative &amp; Kalyāṇa-Mitta Account</span>
                </button>
            </form>

            <div class="text-center pt-3 text-xs text-[var(--text-muted)] border-t border-[var(--border-subtle)]">
                Already registered? <a href="{{ route('login') }}" class="font-bold text-[var(--accent-primary)] hover:underline">Sign in here</a>
            </div>
        </div>
    </div>
</div>

@if($turnstileEnabled)
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
@endsection
