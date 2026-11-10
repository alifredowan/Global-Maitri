@extends('layouts.app')

@section('title', 'Account Settings - Global Maitri')
@section('page_title', 'Account Settings')

@section('content')
<div class="py-8 bg-[var(--bg-canvas)] min-h-screen transition-colors">
    <div class="{{ (Auth::user()->isAdmin() || Auth::user()->isModerator()) ? 'px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto' : 'max-w-5xl mx-auto px-4 sm:px-6 lg:px-8' }} space-y-8">

        <!-- Header Banner -->
        <div class="card-ledger p-6 sm:p-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-[4px] bg-[var(--accent-primary)] text-white text-2xl font-bold flex items-center justify-center shadow-xs">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">{{ $user->name }}</h1>
                        <span class="px-2.5 py-0.5 rounded-[4px] text-[10px] font-bold uppercase tracking-wider bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">
                            {{ $user->isSuperAdmin() ? 'Super Admin' : ($user->isModerator() ? 'Moderator' : ($user->isWali() ? 'Family Rep (Kalyāṇa-Mitta)' : 'Candidate')) }}
                        </span>
                    </div>
                    <p class="text-xs text-[var(--text-secondary)] mt-1">Manage your personal credentials, contact details, security password, and privacy preferences.</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                @if($user->isAdmin() || $user->isModerator())
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs px-3.5 py-2 flex items-center gap-1.5 font-bold">
                        <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span>Admin Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('profile.show') }}" class="btn-secondary text-xs px-3.5 py-2 flex items-center gap-1.5 font-bold">
                        <svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>View Biodata</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Account & Personal Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- 1. Personal & Contact Info Form -->
                <div class="card-ledger p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[var(--border-default)]">
                        <div class="w-8 h-8 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Personal & Account Information</h2>
                            <p class="text-[11px] text-[var(--text-secondary)]">Update your account name, email address, and demographic details.</p>
                        </div>
                    </div>

                    <form action="{{ route('settings.profile.update') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                    Full Name <span class="text-[var(--color-danger)]">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       required
                                       class="input-field text-xs">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
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
                                <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                    Phone Number
                                </label>
                                <input type="text"
                                       name="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="+1 555-0199"
                                       class="input-field text-xs">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                    System Role
                                </label>
                                <div class="input-field text-xs bg-[var(--bg-subtle)] text-[var(--text-secondary)] flex items-center justify-between" style="min-height: 44px;">
                                    <span class="capitalize">{{ str_replace('_', ' ', $user->role) }}</span>
                                    <span class="text-[10px] text-[var(--text-muted)]">Fixed</span>
                                </div>
                            </div>
                        </div>

                        @if($user->isSeeker())
                            <div class="pt-4 border-t border-[var(--border-default)] space-y-4">
                                <h3 class="text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">Demographics &amp; Location</h3>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                            Gender
                                        </label>
                                        <select name="gender" class="input-field text-xs">
                                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Groom (Male)</option>
                                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Bride (Female)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
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
                                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
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
                                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                            City
                                        </label>
                                        <input type="text"
                                               name="city"
                                               value="{{ old('city', $profile?->city) }}"
                                               placeholder="e.g. Colombo, Kandy, Bangkok"
                                               class="input-field text-xs">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                            Country
                                        </label>
                                        <input type="text"
                                               name="country"
                                               value="{{ old('country', $profile?->country) }}"
                                               placeholder="e.g. Sri Lanka, Thailand, USA"
                                               class="input-field text-xs">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
                                        About Me / Short Bio
                                    </label>
                                    <textarea name="bio"
                                              rows="3"
                                              placeholder="A brief intro about your practice and goals..."
                                              class="input-field text-xs">{{ old('bio', $profile?->bio) }}</textarea>
                                </div>
                            </div>
                        @endif

                        <div class="pt-2">
                            <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-bold cursor-pointer">
                                Save Account Changes
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 border-t border-[var(--border-default)] pt-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xs font-bold text-[var(--text-primary)]">Revoke API sessions</h3>
                                <p class="mt-1 text-[11px] leading-relaxed text-[var(--text-secondary)]">Sign out API-connected devices and apps if you suspect a token has been exposed.</p>
                            </div>
                            <form action="{{ route('settings.api-sessions.revoke') }}" method="POST" class="shrink-0" onsubmit="return confirm('Revoke all API sessions?')">
                                @csrf
                                <button type="submit" class="btn-secondary text-[11px] px-3 py-2 text-[var(--color-danger)] font-bold cursor-pointer">
                                    Revoke all
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 2. Password & Security Form -->
                <div class="card-ledger p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-[var(--border-default)]">
                        <div class="w-8 h-8 rounded-[4px] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Password & Security</h2>
                            <p class="text-[11px] text-[var(--text-secondary)]">Change your password to keep your account safe and protected.</p>
                        </div>
                    </div>

                    <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
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
                                    <svg x-show="!showCurrent" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showCurrent" style="display: none;" class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
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
                                        <svg x-show="!showNew" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showNew" style="display: none;" class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider mb-1.5">
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
                                        <svg x-show="!showConfirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showConfirm" style="display: none;" class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-bold cursor-pointer">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Preferences & Fast Links -->
            <div class="space-y-6">
                <!-- Account Summary Card -->
                <div class="card-ledger p-6 bg-[#141412] text-[#f4f2ee] border border-[#2d2b27] space-y-4">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#e0b84c]">Account Status</span>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-[#a8a49c]">Status</p>
                            <p class="text-sm font-bold text-[#e0b84c] flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[var(--accent-primary)]"></span> Active &amp; Verified
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-[#a8a49c]">Member Since</p>
                            <p class="text-sm font-bold text-white">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-[#2d2b27] text-[11px] text-[#a8a49c]">
                        Account ID: <span class="font-mono text-white">#GM-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                <div class="card-ledger p-6 border-[var(--border-default)]">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[var(--color-danger)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <h3 class="font-heading text-sm font-bold text-[var(--text-primary)]">Delete account permanently</h3>
                    </div>
                    <p class="mt-3 text-xs leading-5 text-[var(--text-secondary)]">
                        This permanently removes your profile, photos, messages, matches, and verification files. This action cannot be undone.
                    </p>
                    <form action="{{ route('account.delete') }}" method="POST" class="mt-5 space-y-3">
                        @csrf
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Confirm your password" class="input-field text-xs">
                        <textarea name="reason" required maxlength="500" rows="2" placeholder="Why are you leaving? (required)" class="input-field text-xs"></textarea>
                        <label class="flex items-start gap-2 text-[11px] font-semibold leading-4 text-[var(--text-secondary)]">
                            <input type="checkbox" name="confirmation" value="1" required class="mt-0.5 rounded-[2px] border-[var(--border-default)] text-[var(--color-danger)] focus:ring-[var(--color-danger)]">
                            <span>I understand that permanent deletion cannot be reversed.</span>
                        </label>
                        <button type="submit" class="btn-secondary w-full text-xs font-bold text-[var(--color-danger)] border-[var(--border-default)] hover:bg-[var(--bg-subtle)]" onclick="return confirm('Permanently delete your account and personal data? This cannot be undone.')">
                            Permanently delete account
                        </button>
                    </form>
                </div>

                @if($user->isSuperAdmin() || $user->hasPermission('manage_settings'))
                    <!-- Admin Fast Link to Platform Policies -->
                    <div class="card-ledger p-6 space-y-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Global Platform Policies</h3>
                        </div>
                        <p class="text-xs text-[var(--text-secondary)] leading-relaxed">
                            As an Administrator, you can configure platform-wide settings like KYC enforcement, image auto-blurring, and rate limits.
                        </p>
                        <a href="{{ route('admin.settings') }}" class="btn-secondary text-xs px-4 py-2 inline-flex items-center gap-1.5 font-bold">
                            <span>Manage Platform Policies &rarr;</span>
                        </a>
                    </div>
                @endif

                @if($user->isSeeker())
                    <!-- Privacy & Modesty Preferences for Seekers -->
                    <div class="card-ledger p-6 space-y-4">
                        <div class="flex items-center gap-2 pb-3 border-b border-[var(--border-default)]">
                            <svg class="w-5 h-5 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <h3 class="text-sm font-bold text-[var(--text-primary)] font-heading">Privacy & Lotus Modesty Preferences</h3>
                        </div>

                        <form action="{{ route('settings.preferences.update') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="section" value="privacy">

                            <!-- Incognito Browsing -->
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <label for="is_incognito" class="text-xs font-bold text-[var(--text-primary)] block cursor-pointer">
                                        Incognito Profile Browsing
                                    </label>
                                    <span class="text-[11px] text-[var(--text-secondary)] block mt-0.5">
                                        Visit candidate profiles anonymously without appearing in their "Who Viewed You" list.
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
                                    <label for="wali_required" class="text-xs font-bold text-[var(--text-primary)] block cursor-pointer">
                                        Enforce Representative / Kalyāṇa-Mitta Clearance
                                    </label>
                                    <span class="text-[11px] text-[var(--text-secondary)] block mt-0.5">
                                        Proposals and communications must be cleared by your linked Family Representative (Kalyāṇa-Mitta) first.
                                    </span>
                                </div>
                                <input type="checkbox"
                                       id="wali_required"
                                       name="wali_required"
                                       value="1"
                                       {{ $profile?->wali_required ? 'checked' : '' }}
                                       class="mt-1 w-4 h-4 rounded-[2px] border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            </div>

                            <button type="submit" class="btn-primary w-full py-2 text-xs font-bold cursor-pointer">
                                Save Privacy Preferences
                            </button>
                        </form>
                    </div>
                @endif

                <div class="card-ledger p-6">
                    <div class="flex items-center gap-2 border-b border-[var(--border-default)] pb-3">
                        <svg class="w-5 h-5 text-[var(--accent-primary)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <div>
                            <h3 class="font-heading text-sm font-bold text-[var(--text-primary)]">Notification preferences</h3>
                            <p class="mt-0.5 text-[11px] text-[var(--text-secondary)]">Choose which updates reach you through the platform.</p>
                        </div>
                    </div>
                    @php($notificationPreferences = $user->notificationPreferences())
                    <form action="{{ route('settings.preferences.update') }}" method="POST" class="mt-4 space-y-3">
                        @csrf
                        <input type="hidden" name="section" value="notifications">
                        @foreach([
                            'email_notifications' => 'Email notifications',
                            'interest_notifications' => 'Interest requests and responses',
                            'message_notifications' => 'New chaperoned messages',
                            'wali_notifications' => 'Family representative & Kalyāṇa-Mitta updates',
                            'saved_search_notifications' => 'Saved-search matches',
                            'marriage_notifications' => 'Mangala Vivaha milestone updates',
                        ] as $preferenceKey => $preferenceLabel)
                            <label class="flex items-center justify-between gap-3 text-xs font-semibold text-[var(--text-primary)] cursor-pointer">
                                <span>{{ $preferenceLabel }}</span>
                                <input type="checkbox" name="{{ $preferenceKey }}" value="1" {{ $notificationPreferences[$preferenceKey] ? 'checked' : '' }} class="h-4 w-4 rounded-[2px] border-[var(--border-default)] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            </label>
                        @endforeach
                        <button type="submit" class="btn-primary mt-2 w-full py-2 font-bold text-xs cursor-pointer">Save notification preferences</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
