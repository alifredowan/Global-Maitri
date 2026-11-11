@extends('layouts.app')

@section('title', 'Account Settings — Global Maitri')
@section('page_title', 'Account Settings')

@section('content')
<div class="py-10 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="{{ (Auth::user()->isAdmin() || Auth::user()->isModerator()) ? 'px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto' : 'max-w-5xl mx-auto px-4 sm:px-6 lg:px-8' }} space-y-8">

        <!-- Header Monograph -->
        <div class="card-monograph p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)] font-serif text-2xl font-semibold flex items-center justify-center shadow-xs">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h1 class="text-xl sm:text-2xl font-serif font-bold text-[var(--text-primary)]">{{ $user->name }}</h1>
                        <span class="px-2.5 py-0.5 rounded-[3px] text-[10px] font-mono uppercase tracking-wider bg-[var(--saffron-gold)]/10 text-[var(--saffron-gold)] border border-[var(--saffron-gold)]/25">
                            {{ $user->isSuperAdmin() ? 'Super Admin' : ($user->isModerator() ? 'Moderator' : ($user->isWali() ? 'Family Representative (Kalyāṇa-Mitta)' : 'Candidate')) }}
                        </span>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] mt-1">Manage your credentials, contact information, password, and privacy preferences with care.</p>
                </div>
            </div>

            <div class="flex items-center gap-2.5 shrink-0">
                @if($user->isAdmin() || $user->isModerator())
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs px-4 py-2 flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-[var(--saffron-gold)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span>Admin Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('profile.show') }}" class="btn-secondary text-xs px-4 py-2 flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-[var(--lotus-pink)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>View Biodata</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Account & Personal Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- 1. Personal & Contact Info Form -->
                <div class="card-monograph p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[var(--border-default)]">
                        <div class="w-8 h-8 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-serif font-bold text-[var(--text-primary)]">Personal & Account Information</h2>
                            <p class="text-[11px] text-[var(--text-secondary)]">Your name, verified email, and core demographic information.</p>
                        </div>
                    </div>

                    <form action="{{ route('settings.profile.update') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                    Full Name <span class="text-[var(--color-danger)]">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required
                                       class="input-field text-xs">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                    Email Address <span class="text-[var(--color-danger)]">*</span>
                                </label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       required
                                       class="input-field text-xs">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                    Phone Number
                                </label>
                                <input type="text"
                                       name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="+1 555-0199"
                                       class="input-field text-xs">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                    Account Role
                                </label>
                                <div class="input-field text-xs bg-[var(--bg-subtle)] text-[var(--text-secondary)] flex items-center justify-between" style="min-height: 44px;">
                                    <span class="capitalize">{{ str_replace('_', ' ', $user->role) }}</span>
                                    <span class="text-[10px] font-mono text-[var(--text-muted)]">Fixed</span>
                                </div>
                            </div>
                        </div>

                        @if($user->isSeeker())
                            <div class="pt-5 border-t border-[var(--border-default)] space-y-4">
                                <span class="text-[11px] font-mono uppercase tracking-wider text-[var(--saffron-gold)] block">Demographics &amp; Location</span>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                            Gender
                                        </label>
                                        <select name="gender" class="input-field text-xs">
                                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Groom (Male)</option>
                                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Bride (Female)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                            Date of Birth (dd/mm/yyyy)
                                        </label>
                                        <input type="text"
                                               name="dob"
                                               value="{{ old('dob', $user->dob ? $user->dob->format('d/m/Y') : '') }}"
                                               inputmode="numeric"
                                               placeholder="dd/mm/yyyy"
                                               maxlength="10"
                                               pattern="\d{2}/\d{2}/\d{4}"
                                               x-data
                                               x-on:input="$el.value = $el.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d)/, '$1/$2').replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3').slice(0, 10)"
                                               class="input-field text-xs">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                            Marital Status
                                        </label>
                                        <select name="marital_status" class="input-field text-xs">
                                            <option value="never_married" {{ old('marital_status', $user->marital_status) === 'never_married' ? 'selected' : '' }}>Never Married</option>
                                            <option value="divorced" {{ old('marital_status', $user->marital_status) === 'divorced' ? 'selected' : '' }}>Divorced</option>
                                            <option value="widowed" {{ old('marital_status', $user->marital_status) === 'widowed' ? 'selected' : '' }}>Widowed</option>
                                            <option value="annulled" {{ old('marital_status', $user->marital_status) === 'annulled' ? 'selected' : '' }}>Annulled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                            City
                                        </label>
                                        <input type="text"
                                               name="city"
                                               value="{{ old('city', $profile?->city) }}"
                                               placeholder="e.g. Chittagong, Dhaka, Colombo, Bangkok"
                                               class="input-field text-xs">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                            Country
                                        </label>
                                        <input type="text"
                                               name="country"
                                               value="{{ old('country', $profile?->country) }}"
                                               placeholder="e.g. Bangladesh, Sri Lanka, Thailand"
                                               class="input-field text-xs">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                        Personal Introduction
                                    </label>
                                    <textarea name="bio"
                                              rows="3"
                                              placeholder="A brief intro about your practice, everyday life, and family outlook..."
                                              class="input-field text-xs">{{ old('bio', $profile?->bio) }}</textarea>
                                </div>
                            </div>
                        @endif

                        <div class="pt-2">
                            <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-medium cursor-pointer">
                                Save Account Changes
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 border-t border-[var(--border-default)] pt-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xs font-serif font-bold text-[var(--text-primary)]">Revoke API Sessions</h3>
                                <p class="mt-0.5 text-[11px] leading-relaxed text-[var(--text-secondary)]">Sign out all connected devices and secondary sessions if you suspect unauthorized access.</p>
                            </div>
                            <form action="{{ route('settings.api-sessions.revoke') }}" method="POST" class="shrink-0" onsubmit="return confirm('Revoke all API sessions?')">
                                @csrf
                                <button type="submit" class="btn-secondary text-[11px] px-3.5 py-2 text-[var(--color-danger)] font-medium cursor-pointer">
                                    Revoke all
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 2. Password & Security Form -->
                <div class="card-monograph p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[var(--border-default)]">
                        <div class="w-8 h-8 rounded-[3px] bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--saffron-gold)] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-serif font-bold text-[var(--text-primary)]">Password &amp; Security</h2>
                            <p class="text-[11px] text-[var(--text-secondary)]">Update your account password regularly to preserve account integrity.</p>
                        </div>
                    </div>

                    <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                Current Password <span class="text-[var(--color-danger)]">*</span>
                            </label>
                            <div class="relative" x-data="{ showCurrent: false }">
                                <input :type="showCurrent ? 'text' : 'password'"
                                       name="current_password"
                                       required
                                       placeholder="Enter your current password"
                                       class="input-field text-xs pr-11">
                                <button type="button" @click="showCurrent = !showCurrent"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                        :title="showCurrent ? 'Hide password' : 'View password'"
                                        tabindex="-1">
                                    <svg x-show="!showCurrent" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showCurrent" style="display: none;" class="w-4 h-4 text-[var(--lotus-pink)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                    New Password <span class="text-[var(--color-danger)]">*</span>
                                </label>
                                <div class="relative" x-data="{ showNew: false }">
                                    <input :type="showNew ? 'text' : 'password'"
                                           name="password"
                                           required
                                           minlength="8"
                                           placeholder="Minimum 8 characters"
                                           class="input-field text-xs pr-11">
                                    <button type="button" @click="showNew = !showNew"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                            :title="showNew ? 'Hide password' : 'View password'"
                                            tabindex="-1">
                                        <svg x-show="!showNew" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showNew" style="display: none;" class="w-4 h-4 text-[var(--lotus-pink)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-[var(--text-primary)] mb-1.5">
                                    Confirm New Password <span class="text-[var(--color-danger)]">*</span>
                                </label>
                                <div class="relative" x-data="{ showConfirm: false }">
                                    <input :type="showConfirm ? 'text' : 'password'"
                                           name="password_confirmation"
                                           required
                                           minlength="8"
                                           placeholder="Repeat new password"
                                           class="input-field text-xs pr-11">
                                    <button type="button" @click="showConfirm = !showConfirm"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                                            :title="showConfirm ? 'Hide password' : 'View password'"
                                            tabindex="-1">
                                        <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showConfirm" style="display: none;" class="w-4 h-4 text-[var(--lotus-pink)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-medium cursor-pointer">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Preferences, Summary, Danger Zone -->
            <div class="space-y-6">
                <!-- Account Summary Monograph -->
                <div class="card-monograph p-6 space-y-4 bg-gradient-to-b from-[var(--bg-card)] to-[var(--bg-subtle)]">
                    <span class="text-[10px] font-mono uppercase tracking-wider text-[var(--saffron-gold)]">Account Overview</span>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] text-[var(--text-muted)]">Membership</p>
                            <p class="text-xs font-serif font-semibold text-[var(--text-primary)] flex items-center gap-1.5 mt-0.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-success)]"></span> Active &amp; Verified
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-[11px] text-[var(--text-muted)]">Member Since</p>
                            <p class="text-xs font-mono font-medium text-[var(--text-primary)] mt-0.5">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-[var(--border-default)] text-[11px] text-[var(--text-secondary)] flex items-center justify-between">
                        <span>Member ID</span>
                        <span class="font-mono text-[var(--text-primary)]">#GM-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                @if($user->isSeeker())
                    <!-- Privacy & Modesty Preferences for Seekers -->
                    <div class="card-monograph p-6 space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-[var(--border-default)]">
                            <svg class="w-4 h-4 text-[var(--lotus-pink)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <h3 class="text-xs font-serif font-bold text-[var(--text-primary)]">Privacy & Lotus Modesty Preferences</h3>
                        </div>

                        <form action="{{ route('settings.preferences.update') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="section" value="privacy">

                            <!-- Incognito Browsing -->
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <label for="is_incognito" class="text-xs font-medium text-[var(--text-primary)] block cursor-pointer">
                                        Incognito Profile Browsing
                                    </label>
                                    <span class="text-[11px] text-[var(--text-secondary)] block mt-0.5 leading-relaxed">
                                        Browse candidate profiles privately without appearing in their &ldquo;Who Viewed You&rdquo; list.
                                    </span>
                                </div>
                                <input type="checkbox"
                                       id="is_incognito"
                                       name="is_incognito"
                                       value="1"
                                       {{ $user->is_incognito ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded-[2px] border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            </div>

                            <!-- Wali Requirement -->
                            <div class="flex items-start justify-between gap-3 pt-3 border-t border-[var(--border-default)]">
                                <div>
                                    <label for="wali_required" class="text-xs font-medium text-[var(--text-primary)] block cursor-pointer">
                                        Family Representative Clearance
                                    </label>
                                    <span class="text-[11px] text-[var(--text-secondary)] block mt-0.5 leading-relaxed">
                                        Proposals and first communications must be approved by your linked family representative first.
                                    </span>
                                </div>
                                <input type="checkbox"
                                       id="wali_required"
                                       name="wali_required"
                                       value="1"
                                       {{ $profile?->wali_required ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded-[2px] border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            </div>

                            <!-- Cookie Preferences Trigger -->
                            <div class="pt-3 border-t border-[var(--border-default)] flex items-center justify-between gap-3">
                                <div>
                                    <span class="text-xs font-medium text-[var(--text-primary)] block">
                                        Cookie Consent &amp; Privacy Choices
                                    </span>
                                    <span class="text-[11px] text-[var(--text-secondary)] block mt-0.5 leading-relaxed">
                                        Review or modify your essential and optional cookie permissions at any time.
                                    </span>
                                </div>
                                <button type="button"
                                        @click="$dispatch('open-cookie-settings')"
                                        class="btn-secondary text-xs !py-1.5 !px-3 shrink-0 cursor-pointer">
                                    Cookie settings
                                </button>
                            </div>

                            <button type="submit" class="btn-primary w-full py-2 text-xs font-medium cursor-pointer">
                                Save Privacy Preferences
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Notification Preferences -->
                <div class="card-monograph p-6">
                    <div class="flex items-center gap-2 border-b border-[var(--border-default)] pb-3">
                        <svg class="w-4 h-4 text-[var(--saffron-gold)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <div>
                            <h3 class="font-serif text-xs font-bold text-[var(--text-primary)]">Notification Preferences</h3>
                            <p class="mt-0.5 text-[11px] text-[var(--text-secondary)]">Choose which updates reach you quietly.</p>
                        </div>
                    </div>
                    @php($notificationPreferences = $user->notificationPreferences())
                    <form action="{{ route('settings.preferences.update') }}" method="POST" class="mt-4 space-y-3">
                        @csrf
                        <input type="hidden" name="section" value="notifications">
                        @foreach([
                            'email_notifications' => 'Email updates',
                            'interest_notifications' => 'Interest proposals & replies',
                            'message_notifications' => 'New mindful chat messages',
                            'wali_notifications' => 'Family representative updates',
                            'saved_search_notifications' => 'Saved-search match alerts',
                            'marriage_notifications' => 'Mangala Vivaha milestone alerts',
                        ] as $preferenceKey => $preferenceLabel)
                            <label class="flex items-center justify-between gap-3 text-xs text-[var(--text-primary)] cursor-pointer">
                                <span>{{ $preferenceLabel }}</span>
                                <input type="checkbox" name="{{ $preferenceKey }}" value="1" {{ $notificationPreferences[$preferenceKey] ? 'checked' : '' }} class="h-4 w-4 rounded-[2px] border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            </label>
                        @endforeach
                        <button type="submit" class="btn-primary mt-2 w-full py-2 font-medium text-xs cursor-pointer">Save Notification Preferences</button>
                    </form>
                </div>

                @if($user->isSuperAdmin() || $user->hasPermission('manage_settings'))
                    <!-- Admin Fast Link to Platform Policies -->
                    <div class="card-monograph p-6 space-y-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[var(--saffron-gold)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h3 class="text-xs font-serif font-bold text-[var(--text-primary)]">Platform Policies</h3>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            Configure platform-wide settings like KYC enforcement, image auto-blurring, and rate limits.
                        </p>
                        <a href="{{ route('admin.settings') }}" class="btn-secondary text-xs px-4 py-2 inline-flex items-center gap-1.5 font-medium">
                            <span>Manage Platform Policies &rarr;</span>
                        </a>
                    </div>
                @endif

                <!-- Danger Zone: Permanent Account Deletion -->
                <div class="card-monograph p-6 border-[var(--color-danger)]/30">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[var(--color-danger)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <h3 class="font-serif text-xs font-bold text-[var(--text-primary)]">Delete Account Permanently</h3>
                    </div>
                    <p class="mt-2 text-xs leading-relaxed text-[var(--text-secondary)]">
                        This permanently removes your profile, photos, conversations, matches, and uploaded verification records. This action cannot be reversed.
                    </p>
                    <form action="{{ route('account.delete') }}" method="POST" class="mt-4 space-y-3">
                        @csrf
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Confirm your password" class="input-field text-xs">
                        <textarea name="reason" required maxlength="500" rows="2" placeholder="Why are you leaving? (required)" class="input-field text-xs"></textarea>
                        <label class="flex items-start gap-2 text-[11px] leading-relaxed text-[var(--text-secondary)]">
                            <input type="checkbox" name="confirmation" value="1" required class="mt-0.5 rounded-[2px] border-[var(--border-default)] text-[var(--color-danger)] focus:ring-[var(--color-danger)]">
                            <span>I understand that permanent deletion cannot be reversed.</span>
                        </label>
                        <button type="submit" class="btn-secondary w-full text-xs font-medium text-[var(--color-danger)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]" onclick="return confirm('Permanently delete your account and personal data? This cannot be undone.')">
                            Permanently Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
