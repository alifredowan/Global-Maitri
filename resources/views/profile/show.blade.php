@extends('layouts.app')

@section('title', 'My Profile - Global Maitri')

@section('content')
<div class="py-6 min-h-screen bg-[var(--bg-canvas)]">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--color-success-subtle)] border border-[var(--color-success)]/30 text-[var(--color-success)] text-xs font-semibold flex items-center gap-2">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="p-3.5 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-primary)]/30 text-[var(--accent-primary)] text-xs font-semibold flex items-center gap-2">
                <span>ℹ</span> {{ session('info') }}
            </div>
        @endif

        @if($user->isMarried() || $user->activeMarriage())
            @php $marriage = $user->activeMarriage(); @endphp
            <div class="card-hero bg-[var(--bg-surface)] border border-[var(--border-default)] p-6 rounded-[var(--radius-xl)] flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4 text-center sm:text-left">
                    <div class="w-12 h-12 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white flex items-center justify-center text-xl shadow-xs shrink-0">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/><path d="M12 3v18M3 12h18"/></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 justify-center sm:justify-start">
                            <span class="text-xs font-bold uppercase tracking-wider text-[var(--accent-primary)]">Mangala Vivaha</span>
                            <span class="badge-status bg-[var(--color-success-subtle)] text-[var(--color-success)] border border-[var(--color-success)]/30 text-[10px]">Auspicious Union Completed</span>
                        </div>
                        <h2 class="text-base font-bold text-[var(--text-primary)] font-heading mt-0.5">
                            @if($marriage && $marriage->spouseOf($user))
                                United in Mangala Vivaha with {{ $marriage->spouseOf($user)->name }}
                            @else
                                Sadhu! Marital Status: Married
                            @endif
                        </h2>
                        <p class="text-xs text-[var(--text-muted)]">Your profile is shielded from discovery and matrimonial inquiries have concluded with blessings.</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    @if($marriage)
                        <a href="{{ route('marriages.certificate', $marriage->id) }}" class="btn-secondary text-xs !py-2 !px-3.5">
                            Digital Certificate 📜
                        </a>
                    @endif
                    <a href="{{ route('marriages.celebration') }}" class="btn-primary text-xs !py-2 !px-4">
                        View Celebration &rarr;
                    </a>
                </div>
            </div>
        @endif

        <!-- Top Overview & Completeness Card (FR-2.4) -->
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] overflow-hidden shadow-xs">
            <div class="h-32 sm:h-36 bg-[var(--bg-subtle)] border-b border-[var(--border-default)] relative p-4 flex items-start justify-end">
                <a href="{{ route('profile.edit') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5 shadow-xs">
                    <svg class="w-3.5 h-3.5 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    <span>Edit Profile</span>
                </a>
            </div>

            <div class="px-6 pb-6 pt-0 relative">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between -mt-14 sm:-mt-16 gap-4 mb-5">
                    <!-- Avatar & Status -->
                    <div class="flex items-end gap-4">
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-[var(--radius-md)] border-4 border-[var(--bg-surface)] shadow-md bg-[var(--neutral-900)] overflow-hidden relative shrink-0">
                            @if($profile->primaryPhoto)
                                <img src="{{ $profile->primaryPhoto->displayUrl() }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-[var(--bg-subtle)] text-[var(--accent-primary)] font-bold text-3xl">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h1 class="font-heading font-extrabold text-xl sm:text-2xl text-[var(--text-primary)]">{{ $user->name }}</h1>
                                @if($user->isPro())
                                    <span class="text-[9px] font-extrabold uppercase px-2 py-0.5 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white shadow-xs" title="Single Marriage Pass Member">
                                        SINGLE MARRIAGE PASS
                                    </span>
                                @endif
                                @if($user->is_verified)
                                    <span class="badge-verified text-xs">
                                        <span>✓</span> Verified Seeker
                                    </span>
                                @else
                                    <span class="badge-status text-[10px] bg-[var(--bg-subtle)] text-[var(--text-muted)] border border-[var(--border-default)]">
                                        Unverified
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-[var(--text-secondary)] font-medium">
                                {{ $user->age }} Years &bull; {{ $profile->city ?? 'Location not set' }}, {{ $profile->country ?? '' }} &bull; {{ $user->email }}
                            </p>
                        </div>
                    </div>

                    <!-- Quick Navigation Actions -->
                    <div class="flex flex-wrap items-center gap-2 pb-1">
                        <a href="{{ route('profile.biodata') }}" target="_blank" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5" title="Printable Dhamma Biodata">
                            <span>Biodata</span>
                        </a>
                        <a href="{{ route('profile.visitors') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5">
                            <span>Visitors</span>
                        </a>
                        <a href="{{ route('bookmarks.index') }}" class="btn-secondary text-xs !py-1.5 !px-3 flex items-center gap-1.5">
                            <span>Shortlist</span>
                        </a>
                    </div>
                </div>

                <!-- Completeness Bar Card -->
                <div class="card-ledger bg-[var(--bg-subtle)] border border-[var(--border-default)] p-3.5 rounded-[var(--radius-sm)] flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-[var(--text-primary)] uppercase tracking-wider text-[11px]">Dhamma Profile Completeness:</span>
                        <span class="font-extrabold text-[var(--accent-primary)]">{{ $profile->completeness_percentage }}%</span>
                    </div>
                    <div class="w-full sm:w-64 bg-[var(--border-default)] rounded-full h-2 overflow-hidden">
                        <div class="bg-[var(--accent-primary)] h-full rounded-full transition-all duration-500" style="width: {{ $profile->completeness_percentage }}%"></div>
                    </div>
                    <div class="text-[11px] text-[var(--text-muted)]">
                        Complete Dhamma profiles receive up to 4.5x higher matching discovery.
                    </div>
                </div>
            </div>
        </div>

        <!-- Buddhist Practice & Lifestyle Overview -->
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                    <h2 class="text-sm font-bold text-[var(--text-primary)] font-heading uppercase tracking-wider">Buddhist Practice &amp; Mindful Lifestyle (Dhamma Biodata)</h2>
                </div>
                <a href="{{ route('profile.edit') }}" class="text-xs text-[var(--accent-primary)] hover:underline font-semibold">Edit Details</a>
            </div>

            <dl class="divide-y divide-[var(--border-subtle)]">
                <div class="def-row">
                    <dt class="def-term">Tradition</dt>
                    <dd class="def-desc">{{ $profile->tradition_label }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">Lineage / School</dt>
                    <dd class="def-desc">{{ $profile->lineage_school ?? 'General' }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">Ethnic Community</dt>
                    <dd class="def-desc">{{ $profile->ethnic_community_label }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">Meditation Practice</dt>
                    <dd class="def-desc font-semibold text-[var(--accent-primary)]">{{ $profile->meditation_frequency_label }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">Five Precepts (Panca Sila)</dt>
                    <dd class="def-desc">{{ $profile->panca_sila_label }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">Dietary Preference</dt>
                    <dd class="def-desc">{{ $profile->dietary_label }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">5th Precept (Alcohol/Intoxicants)</dt>
                    <dd class="def-desc">{{ $profile->alcohol_label }}</dd>
                </div>
                <div class="def-row">
                    <dt class="def-term">Vipassana Retreat Experience</dt>
                    <dd class="def-desc">{{ $profile->retreat_experience ? str_replace('_', ' ', ucfirst($profile->retreat_experience)) : 'None reported' }}</dd>
                </div>
            </dl>

            @if($profile->views_on_raising_children_in_dhamma)
                <div class="pt-3 border-t border-[var(--border-subtle)]">
                    <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1">Views on Raising Children in Dhamma</h3>
                    <p class="text-xs text-[var(--text-secondary)] bg-[var(--bg-subtle)] p-3 rounded-[var(--radius-sm)] border border-[var(--border-subtle)] leading-relaxed italic">
                        &ldquo;{{ $profile->views_on_raising_children_in_dhamma }}&rdquo;
                    </p>
                </div>
            @endif
        </div>

        <!-- Photos Section with Blurred Privacy (FR-5.1) -->
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                <div>
                    <h2 class="text-sm font-bold text-[var(--text-primary)] font-heading uppercase tracking-wider">My Profile Photos ({{ $profile->photos->count() }}/6)</h2>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">Photos remain shielded or lotus-blurred according to your privacy settings (FR-5.1).</p>
                </div>
                <span class="badge-status text-[10px] bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                    Mode: {{ ucfirst(str_replace('_', ' ', $profile->photo_privacy_mode ?? 'blurred_until_accepted')) }}
                </span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-3">
                @foreach($profile->photos as $photo)
                    <div class="relative group rounded-[var(--radius-sm)] overflow-hidden border border-[var(--border-default)] aspect-square bg-[var(--neutral-900)]">
                        <img src="{{ $photo->displayUrl() }}" alt="Profile photo" class="w-full h-full object-cover">
                        @if($photo->is_primary)
                            <span class="absolute top-1.5 left-1.5 bg-[var(--accent-primary)] text-white text-[9px] font-bold px-1.5 py-0.5 rounded-[2px]">Primary</span>
                        @endif
                        <!-- Action overlay -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-1.5 p-2">
                            @if(!$photo->is_primary)
                                <form action="{{ route('profile.photos.primary', $photo->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-secondary !py-1 !px-2 text-[10px]">Make Primary</button>
                                </form>
                            @endif
                            <form action="{{ route('profile.photos.delete', $photo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[10px] bg-[var(--color-danger)] text-white font-bold px-2 py-1 rounded-[2px]">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                @if($profile->photos->count() < 6)
                    <!-- Upload Photo Card -->
                    <form action="{{ route('profile.photos.upload') }}" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-[var(--border-default)] rounded-[var(--radius-sm)] aspect-square flex flex-col items-center justify-center p-3 text-center hover:bg-[var(--bg-subtle)] transition cursor-pointer relative">
                        @csrf
                        <input type="file" name="photo" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="this.form.submit()">
                        <span class="text-xl text-[var(--accent-primary)] mb-1">+</span>
                        <span class="text-[11px] font-bold text-[var(--text-primary)]">Upload Photo</span>
                        <span class="text-[9px] text-[var(--text-muted)] mt-0.5">Max 5MB</span>
                    </form>
                @endif
            </div>

            @if($profile->photoAccessGrants->where('status', 'active')->isNotEmpty())
                <div class="border-t border-[var(--border-subtle)] pt-3">
                    <h3 class="text-xs font-bold text-[var(--text-secondary)] mb-2">Candidates granted unblurred photo access</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($profile->photoAccessGrants->where('status', 'active') as $grant)
                            <form action="{{ route('profile.photos.revoke', $grant->granted_to_user_id) }}" method="POST" class="inline-flex items-center gap-2 rounded-[var(--radius-sm)] bg-[var(--bg-subtle)] border border-[var(--border-default)] px-2.5 py-1">
                                @csrf
                                @method('DELETE')
                                <span class="text-[11px] font-semibold text-[var(--text-primary)]">{{ $grant->grantedToUser?->name ?? 'Candidate' }}</span>
                                <button type="submit" class="text-[10px] font-bold text-[var(--color-danger)] hover:underline">Revoke</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- KYC Verification Section (FR-1.4) -->
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 sm:p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-[var(--border-subtle)]">
                <div>
                    <h2 class="text-sm font-bold text-[var(--text-primary)] font-heading uppercase tracking-wider">Government ID &amp; KYC Verification (FR-1.4)</h2>
                    <p class="text-xs text-[var(--text-muted)] mt-0.5">Earn the trusted "Verified Seeker" badge to foster genuine confidence and peace of mind.</p>
                </div>
                @if($user->is_verified)
                    <span class="badge-verified text-xs">
                        ✓ Verified Account
                    </span>
                @else
                    <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                        Pending Verification
                    </span>
                @endif
            </div>

            @if(!$user->is_verified)
                <form action="{{ route('profile.verification.submit') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    @csrf
                    <div>
                        <label class="block font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1 text-[10px]">Document Type</label>
                        <select name="document_type" required class="input-field text-xs w-full">
                            <option value="passport">International Passport</option>
                            <option value="national_id">National ID Card / Smart Card</option>
                            <option value="driving_license">Driver's License</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1 text-[10px]">Upload Document (Front)</label>
                        <input type="file" name="document" required accept=".jpg,.jpeg,.png,.pdf"
                               class="input-field text-xs w-full !py-1">
                    </div>
                    <div>
                        <label class="block font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1 text-[10px]">Selfie Verification</label>
                        <input type="file" name="selfie" accept="image/*"
                               class="input-field text-xs w-full !py-1">
                    </div>
                    <div class="sm:col-span-3 flex justify-end">
                        <button type="submit" class="btn-primary text-xs !py-2 !px-4">
                            Submit for KYC Verification
                        </button>
                    </div>
                </form>
            @else
                <p class="text-xs text-[var(--text-secondary)]">Your identity documents have been verified by our moderation team. Your profile carries the verified seal.</p>
            @endif
        </div>

        <!-- Account Deactivation & GDPR Right to Erasure (FR-1.6) -->
        <div class="card-ledger bg-[var(--bg-subtle)] border border-[var(--border-default)] p-5 space-y-3">
            <h3 class="text-xs font-bold text-[var(--text-primary)] font-heading uppercase tracking-wider">Deactivation &amp; GDPR Right to Erasure (FR-1.6)</h3>
            <p class="text-xs text-[var(--text-muted)]">You may deactivate your account or request complete data deletion at any time under GDPR privacy protections.</p>
            <form action="{{ route('account.deactivate') }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate your profile?');" class="flex flex-col sm:flex-row gap-3">
                @csrf
                <input type="text" name="reason" required placeholder="Reason for deactivation (e.g. Found lifelong companion through Global Maitri, taking a break)"
                       class="input-field text-xs flex-1">
                <button type="submit" class="btn-secondary text-xs !py-2 !px-4 text-[var(--color-danger)] border-[var(--color-danger)]/40 hover:bg-[var(--color-danger)] hover:text-white shrink-0 cursor-pointer">
                    Deactivate Account
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
