@extends('layouts.app')

@section('title', 'Register - Global Maitri')

@section('content')
<div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen" x-data="{ role: '{{ old('role', 'seeker') }}' }">
    <div class="max-w-xl mx-auto px-4 sm:px-6">
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm p-8 transition-colors">
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/80 text-primary-800 dark:text-primary-300 flex items-center justify-center text-2xl mx-auto mb-3"
                     x-text="role === 'seeker' ? '🪷' : '🛡️'">
                    🪷
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white font-heading">
                    <span x-show="role === 'seeker'">Create Candidate Profile</span>
                    <span x-show="role === 'wali'" style="display: none;">Register as Family Representative</span>
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    <span x-show="role === 'seeker'">Begin your journey towards a lifelong union rooted in loving-kindness (Metta) and mutual respect.</span>
                    <span x-show="role === 'wali'" style="display: none;">Guide and support your family member or ward in their Buddhist matrimonial search.</span>
                </p>
            </div>

            <!-- Role Selection Tabs -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">I am registering as:</label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" @click="role = 'seeker'"
                            :class="role === 'seeker' ? 'border-primary-600 bg-rose-50/70 dark:bg-rose-950/60 text-primary-900 dark:text-primary-200 ring-2 ring-primary-500' : 'border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700'"
                            class="p-4 rounded-2xl border text-left transition flex flex-col justify-between cursor-pointer">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-lg">🪷</span>
                            <span class="font-bold text-sm font-heading">Candidate / Seeker</span>
                        </div>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">I am seeking a lifelong partner for myself (Groom or Bride).</p>
                    </button>

                    <button type="button" @click="role = 'wali'"
                            :class="role === 'wali' ? 'border-purple-600 bg-purple-50/70 dark:bg-purple-950/60 text-purple-900 dark:text-purple-200 ring-2 ring-purple-500' : 'border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700'"
                            class="p-4 rounded-2xl border text-left transition flex flex-col justify-between cursor-pointer">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-lg">🛡️</span>
                            <span class="font-bold text-sm font-heading">Family Representative</span>
                        </div>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Parent, elder, relative, or monk advisor assisting a seeker.</p>
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 text-xs">
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
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                        <span x-show="role === 'seeker'">Full Legal Name</span>
                        <span x-show="role === 'wali'" style="display: none;">Representative's Full Legal Name</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"
                           :placeholder="role === 'seeker' ? 'e.g. Ananda Wickramasinghe' : 'e.g. Dr. Sarath Wickramasinghe'">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"
                               placeholder="your.email@domain.com">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Phone Number</label>
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
                                        class="w-full h-full px-2 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition flex items-center justify-between gap-1">
                                    <span x-text="selectedCountry ? ('+' + selectedCountry.dial_code) : 'Code'" class="truncate"></span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-cloak
                                     class="absolute z-30 mt-1 w-64 max-h-72 overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-lg flex flex-col">
                                    <div class="p-2 border-b border-slate-100 dark:border-slate-700">
                                        <input type="text" x-model="search" x-ref="countrySearch" @click.stop
                                               placeholder="Search country or code..."
                                               class="w-full px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs focus:ring-2 focus:ring-primary-500 outline-none">
                                    </div>
                                    <div class="overflow-y-auto">
                                        <template x-for="[code, c] in filtered" :key="code">
                                            <button type="button" @click="choose(code)"
                                                    class="w-full text-left px-3 py-2 text-xs text-slate-700 dark:text-slate-200 hover:bg-rose-50 dark:hover:bg-rose-950/60 flex items-center justify-between gap-2">
                                                <span class="truncate" x-text="c.name"></span>
                                                <span class="text-slate-400 shrink-0" x-text="'+' + c.dial_code"></span>
                                            </button>
                                        </template>
                                        <p x-show="filtered.length === 0" class="px-3 py-2 text-xs text-slate-400">No country found.</p>
                                    </div>
                                </div>
                            </div>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="flex-1 min-w-0 px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"
                                   placeholder="e.g. 77 123 4567">
                        </div>
                        <span class="text-[10px] text-slate-400 block mt-0.5">Select country dial code, then enter phone number.</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Gender</label>
                        <select name="gender" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male (Groom / Suitor)</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female (Bride / Suitor)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                            Date of Birth (Legal Age Enforced)
                        </label>
                        <input type="text" name="dob" value="{{ old('dob') }}" required
                               inputmode="numeric" placeholder="dd/mm/yyyy" maxlength="10"
                               pattern="\d{2}/\d{2}/\d{4}"
                               x-data
                               x-on:input="$el.value = $el.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d)/, '$1/$2').replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3').slice(0, 10)"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition">
                        <span class="text-[10px] text-slate-400 block mt-0.5">Format: dd/mm/yyyy. Minimum legal marriage age enforced per country (BD/IN: 21M/18F, LK: 18, TH: 17).</span>
                    </div>
                </div>

                <!-- Seeker-specific Field: Marital Status -->
                <div x-show="role === 'seeker'">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Marital Status (Monogamy Enforced)</label>
                    <select name="marital_status" :required="role === 'seeker'" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition">
                        <option value="">Select Marital Status</option>
                        <option value="never_married" {{ old('marital_status', 'never_married') === 'never_married' ? 'selected' : '' }}>Single / Never Married</option>
                        <option value="divorced" {{ old('marital_status') === 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ old('marital_status') === 'widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="annulled" {{ old('marital_status') === 'annulled' ? 'selected' : '' }}>Annulled</option>
                    </select>
                    <span class="text-[10px] text-slate-400 block mt-1">Currently married individuals are excluded. Divorced and widowed individuals are welcomed with dignity.</span>
                </div>

                <!-- Family Representative-specific Field: Relationship -->
                <div x-show="role === 'wali'" style="display: none;">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Relationship to Candidate / Seeker</label>
                    <select name="relationship_type" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition">
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
                    <span class="text-[10px] text-slate-400 block mt-1">You can easily link your family member's candidate account once logged in.</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Password</label>
                        <div class="relative" x-data="{ showPass: false }">
                            <input :type="showPass ? 'text' : 'password'" name="password" required
                                   class="w-full px-4 py-2.5 pr-11 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"
                                   placeholder="••••••••">
                            <button type="button" @click="showPass = !showPass"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 focus:outline-none cursor-pointer p-1"
                                    :title="showPass ? 'Hide password' : 'View password'"
                                    tabindex="-1">
                                <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPass" style="display: none;" class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Confirm Password</label>
                        <div class="relative" x-data="{ showConfirm: false }">
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                                   class="w-full px-4 py-2.5 pr-11 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition"
                                   placeholder="••••••••">
                            <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 focus:outline-none cursor-pointer p-1"
                                    :title="showConfirm ? 'Hide password' : 'View password'"
                                    tabindex="-1">
                                <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showConfirm" style="display: none;" class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @if($turnstileEnabled)
                    <div class="flex justify-center pt-2">
                        <div class="cf-turnstile" data-sitekey="{{ $turnstileSiteKey }}"></div>
                    </div>
                @endif

                <div class="pt-2">
                    <label class="flex items-start gap-2.5 text-xs text-slate-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" name="terms" required class="mt-0.5 rounded text-primary-600 focus:ring-primary-500 dark:bg-slate-800 dark:border-slate-700">
                        <span>
                            I affirm that I am using this platform strictly for Buddhist matrimony (Mangala Vivaha), I agree to conduct interactions with mindfulness and loving-kindness (Metta), zero dowry demands, and I accept the <a href="{{ route('pages.terms') }}" class="text-primary-700 dark:text-primary-400 underline font-medium">Terms of Service</a> and <a href="{{ route('pages.privacy') }}" class="text-primary-700 dark:text-primary-400 underline font-medium">Privacy Policy</a>.
                        </span>
                    </label>
                </div>

                <button type="submit"
                        :class="role === 'seeker' ? 'bg-primary-700 hover:bg-primary-800 shadow-primary-950/15' : 'bg-purple-700 hover:bg-purple-800 shadow-purple-900/15'"
                        class="w-full py-3.5 rounded-xl text-white font-bold text-sm shadow-md transition mt-4 cursor-pointer">
                    <span x-show="role === 'seeker'">Create Candidate Profile</span>
                    <span x-show="role === 'wali'" style="display: none;">Create Family Representative Account</span>
                </button>
            </form>

            <div class="text-center mt-6 pt-4 text-xs text-slate-500 dark:text-slate-400 border-t border-slate-100 dark:border-slate-800">
                Already registered? <a href="{{ route('login') }}" class="font-bold text-primary-700 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">Sign in here</a>
            </div>
        </div>
    </div>
</div>

@if($turnstileEnabled)
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endif
@endsection
