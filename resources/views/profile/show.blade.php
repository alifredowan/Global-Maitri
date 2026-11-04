@extends('layouts.app')

@section('title', 'My Profile - Global Maitri')

@section('content')
<div class="py-10 bg-slate-50 dark:bg-slate-950 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-950/60 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200 text-xs font-semibold flex items-center gap-2">
                <span>ℹ️</span> {{ session('info') }}
            </div>
        @endif

        @if($user->isMarried() || $user->activeMarriage())
            @php $marriage = $user->activeMarriage(); @endphp
            <div class="bg-gradient-to-r from-rose-950 via-slate-900 to-amber-950 text-white rounded-3xl p-6 border border-amber-600/40 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4 text-center sm:text-left">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400 text-slate-950 flex items-center justify-center text-2xl shadow-md shrink-0">
                        🪷
                    </div>
                    <div>
                        <div class="flex items-center gap-2 justify-center sm:justify-start">
                            <span class="text-xs font-black uppercase tracking-wider text-amber-300">Mangala Vivaha</span>
                            <span class="text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 px-2 py-0.5 rounded-full font-bold">Auspicious Union Completed</span>
                        </div>
                        <h2 class="text-base font-bold font-heading mt-0.5">
                            @if($marriage && $marriage->spouseOf($user))
                                United in Mangala Vivaha with {{ $marriage->spouseOf($user)->name }}
                            @else
                                Sadhu! Marital Status: Married
                            @endif
                        </h2>
                        <p class="text-[11px] text-slate-300">Your profile is shielded from discovery and matrimonial inquiries have concluded with blessings.</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @if($marriage)
                        <a href="{{ route('marriages.certificate', $marriage->id) }}" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs transition border border-white/20 shrink-0">
                            Digital Certificate 📜
                        </a>
                    @endif
                    <a href="{{ route('marriages.celebration') }}" class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs shadow-md transition shrink-0">
                        View Celebration &rarr;
                    </a>
                </div>
            </div>
        @endif

        <!-- Top Overview & Completeness Card (FR-2.4) -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 overflow-hidden shadow-sm">
            <div class="h-36 sm:h-44 bg-gradient-to-r from-rose-950 via-slate-900 to-amber-950 relative">
                <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <a href="{{ route('profile.edit') }}" class="absolute top-4 right-4 bg-white/90 hover:bg-white dark:bg-slate-900/90 dark:hover:bg-slate-900 text-slate-900 dark:text-white font-bold text-xs px-4 py-2 rounded-xl shadow-sm transition flex items-center space-x-1.5 backdrop-blur-xs">
                    <span>✏️</span>
                    <span>Edit Profile</span>
                </a>
            </div>

            <div class="px-6 sm:px-8 pb-6 sm:pb-8 pt-0 relative">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between -mt-16 sm:-mt-20 gap-4 mb-6">
                    <!-- Avatar & Status -->
                    <div class="flex items-end space-x-4">
                        <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl border-4 border-white dark:border-slate-900 shadow-xl bg-slate-800 overflow-hidden relative shrink-0">
                            @if($profile->primaryPhoto)
                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-rose-950 to-slate-900 text-amber-200 font-bold text-3xl">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="pb-1">
                            <div class="flex items-center space-x-2 flex-wrap">
                                <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white">{{ $user->name }}</h1>
                                @if($user->isPro())
                                    <span class="bg-amber-500 text-slate-950 text-[10px] font-black px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs" title="Single Marriage Pass Member">
                                        👑 SINGLE MARRIAGE PASS
                                    </span>
                                @endif
                                @if($user->is_verified)
                                    <span class="bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold px-2.5 py-0.5 rounded-full border border-emerald-300 dark:border-emerald-700 flex items-center space-x-1">
                                        <span>✓</span>
                                        <span>Verified Seeker</span>
                                    </span>
                                @else
                                    <span class="bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 text-[10px] font-bold px-2.5 py-0.5 rounded-full">
                                        Unverified
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 font-medium mt-1">
                                {{ $user->age }} Years • {{ $profile->city ?? 'Location not set' }}, {{ $profile->country ?? '' }} • {{ $user->email }}
                            </p>
                        </div>
                    </div>

                    <!-- Quick Navigation Actions -->
                    <div class="flex flex-wrap items-center gap-2 pb-1">
                        <a href="{{ route('profile.biodata') }}" target="_blank" class="px-3 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 text-xs font-bold transition flex items-center gap-1 border border-slate-200 dark:border-slate-700" title="Printable Dhamma Biodata">
                            <span>🖨️</span> Biodata
                        </a>
                        <a href="{{ route('profile.visitors') }}" class="px-3 py-2 rounded-xl bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 text-rose-800 dark:text-rose-300 text-xs font-bold transition flex items-center gap-1 border border-rose-200/80 dark:border-rose-800/80">
                            <span>👁️</span> Visitors
                        </a>
                        <a href="{{ route('bookmarks.index') }}" class="px-3 py-2 rounded-xl bg-amber-50 dark:bg-amber-950/60 hover:bg-amber-100 dark:hover:bg-amber-900/60 text-amber-800 dark:text-amber-300 text-xs font-bold transition flex items-center gap-1 border border-amber-200/80 dark:border-amber-800/80">
                            <span>⭐</span> Shortlist
                        </a>
                    </div>
                </div>

                <!-- Completeness Bar Card -->
                <div class="bg-primary-50/60 dark:bg-primary-950/30 border border-primary-200/80 dark:border-primary-800/60 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <div class="flex items-center space-x-2">
                        <span class="font-bold text-primary-950 dark:text-primary-200 uppercase tracking-wider">Dhamma Profile Completeness:</span>
                        <span class="font-extrabold text-primary-800 dark:text-primary-300">{{ $profile->completeness_percentage }}%</span>
                    </div>
                    <div class="w-full sm:w-64 bg-slate-200 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-gradient-to-r from-primary-600 to-amber-500 h-full rounded-full transition-all duration-500" style="width: {{ $profile->completeness_percentage }}%"></div>
                    </div>
                    <div class="text-[11px] text-slate-500 dark:text-slate-400">
                        Complete Dhamma profiles receive up to 4.5x higher matching discovery.
                    </div>
                </div>
            </div>
        </div>

        <!-- Buddhist Practice & Lifestyle Overview -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2">
                    <span class="text-xl">🪷</span>
                    <h2 class="text-base font-bold text-slate-900 dark:text-white font-heading">Buddhist Practice & Mindful Lifestyle (Dhamma Biodata)</h2>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-xs text-primary-700 dark:text-primary-400 hover:underline font-bold">Edit Details</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Tradition</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->tradition_label }}</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Lineage / School</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->lineage_school ?? 'General' }}</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Ethnic Community</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->ethnic_community_label }}</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Meditation Practice</span>
                    <span class="font-bold text-primary-700 dark:text-primary-300">{{ $profile->meditation_frequency_label }}</span>
                </div>

                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Five Precepts (Panca Sila)</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->panca_sila_label }}</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Dietary Preference</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->dietary_label }}</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">5th Precept (Alcohol/Intoxicants)</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->alcohol_label }}</span>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800/60 p-3 rounded-2xl">
                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block">Vipassana Retreat Experience</span>
                    <span class="font-bold text-slate-900 dark:text-white">{{ $profile->retreat_experience ? str_replace('_', ' ', ucfirst($profile->retreat_experience)) : 'None reported' }}</span>
                </div>
            </div>

            @if($profile->views_on_raising_children_in_dhamma)
                <div class="pt-3 border-t border-slate-100 dark:border-slate-800">
                    <h3 class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Views on Raising Children in Dhamma</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-800/40 p-3 rounded-xl border border-slate-100 dark:border-slate-800 leading-relaxed italic">
                        &ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;
                    </p>
                </div>
            @endif
        </div>

        <!-- Photos Section with Blurred Privacy (FR-5.1) -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-slate-800">
                <div>
                    <h2 class="text-base font-bold text-slate-900 dark:text-white font-heading">My Profile Photos ({{ $profile->photos->count() }}/6)</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Photos remain shielded or lotus-blurred according to your privacy settings (FR-5.1).</p>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                    Mode: {{ ucfirst(str_replace('_', ' ', $profile->photo_privacy_mode ?? 'blurred_until_accepted')) }}
                </span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($profile->photos as $photo)
                    <div class="relative group rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 aspect-square bg-slate-800">
                        <img src="{{ $photo->displayUrl() }}" alt="Profile photo" class="w-full h-full object-cover">
                        @if($photo->is_primary)
                            <span class="absolute top-2 left-2 bg-primary-700 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-md">Primary</span>
                        @endif
                        <!-- Action overlay -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2 p-2">
                            @if(!$photo->is_primary)
                                <form action="{{ route('profile.photos.primary', $photo->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] bg-white text-slate-900 font-bold px-2 py-1 rounded">Make Primary</button>
                                </form>
                            @endif
                            <form action="{{ route('profile.photos.delete', $photo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[10px] bg-rose-600 text-white font-bold px-2 py-1 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                @if($profile->photos->count() < 6)
                    <!-- Upload Photo Card -->
                    <form action="{{ route('profile.photos.upload') }}" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-slate-300 dark:border-slate-700 rounded-2xl aspect-square flex flex-col items-center justify-center p-3 text-center hover:bg-slate-50 dark:hover:bg-slate-800/60 transition cursor-pointer relative">
                        @csrf
                        <input type="file" name="photo" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="this.form.submit()">
                        <span class="text-2xl text-slate-400 mb-1">+</span>
                        <span class="text-[11px] font-bold text-slate-700 dark:text-slate-300">Upload Photo</span>
                        <span class="text-[9px] text-slate-400 dark:text-slate-500 mt-0.5">Max 5MB</span>
                    </form>
                @endif
            </div>

            @if($profile->photoAccessGrants->where('status', 'active')->isNotEmpty())
                <div class="border-t border-slate-100 dark:border-slate-800 pt-4">
                    <h3 class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2">Candidates granted unblurred photo access</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($profile->photoAccessGrants->where('status', 'active') as $grant)
                            <form action="{{ route('profile.photos.revoke', $grant->granted_to_user_id) }}" method="POST" class="inline-flex items-center gap-2 rounded-full bg-slate-100 dark:bg-slate-800 px-3 py-1.5">
                                @csrf
                                @method('DELETE')
                                <span class="text-[11px] font-semibold text-slate-700 dark:text-slate-300">{{ $grant->grantedToUser?->name ?? 'Candidate' }}</span>
                                <button type="submit" class="text-[10px] font-bold text-rose-600 dark:text-rose-400 hover:underline">Revoke</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- KYC Verification Section (FR-1.4) -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 p-6 shadow-xs">
            <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2">
                    <span class="text-xl">🪪</span>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white font-heading">Government ID & KYC Verification (FR-1.4)</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Earn the trusted "Verified Seeker" badge to foster genuine confidence and peace of mind.</p>
                    </div>
                </div>
                @if($user->is_verified)
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-950/80 text-blue-800 dark:text-blue-300">
                        ✓ Verified Account
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300">
                        Pending Verification
                    </span>
                @endif
            </div>

            @if(!$user->is_verified)
                <form action="{{ route('profile.verification.submit') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    @csrf
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Document Type</label>
                        <select name="document_type" required class="w-full p-2.5 rounded-xl border border-slate-300 dark:border-slate-700 outline-none bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                            <option value="passport">International Passport</option>
                            <option value="national_id">National ID Card / Smart Card</option>
                            <option value="driving_license">Driver's License</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Upload Document (Front)</label>
                        <input type="file" name="document" required accept=".jpg,.jpeg,.png,.pdf"
                               class="w-full p-2 rounded-xl border border-slate-300 dark:border-slate-700 outline-none bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Selfie Verification</label>
                        <input type="file" name="selfie" accept="image/*"
                               class="w-full p-2 rounded-xl border border-slate-300 dark:border-slate-700 outline-none bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                    </div>
                    <div class="sm:col-span-3 flex justify-end">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary-700 hover:bg-primary-800 text-white font-bold text-xs shadow-xs transition">
                            Submit for KYC Verification
                        </button>
                    </div>
                </form>
            @else
                <p class="text-xs text-slate-600 dark:text-slate-300">Your identity documents have been verified by our moderation team. Your profile carries the verified seal.</p>
            @endif
        </div>

        <!-- Account Deactivation & GDPR Right to Erasure (FR-1.6) -->
        <div class="bg-rose-50/60 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 rounded-3xl p-6">
            <h3 class="text-sm font-bold text-rose-900 dark:text-rose-200 font-heading mb-1">Deactivation & GDPR Right to Erasure (FR-1.6)</h3>
            <p class="text-xs text-rose-800/80 dark:text-rose-300/80 mb-4">You may deactivate your account or request complete data deletion at any time under GDPR privacy protections.</p>
            <form action="{{ route('account.deactivate') }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate your profile?');" class="flex flex-col sm:flex-row gap-3">
                @csrf
                <input type="text" name="reason" required placeholder="Reason for deactivation (e.g. Found lifelong companion through Global Maitri, taking a break)"
                       class="flex-1 px-4 py-2 rounded-xl border border-rose-300 dark:border-rose-800 text-xs focus:ring-2 focus:ring-rose-500 outline-none bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition shrink-0 cursor-pointer">
                    Deactivate Account
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
