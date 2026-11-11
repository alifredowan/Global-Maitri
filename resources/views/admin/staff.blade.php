@extends('layouts.app')

@section('title', 'Staff & Access Control - Global Maitri Admin')
@section('page_title', 'Staff & Permissions')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8" x-data="{
    showCreateModal: false,
    showEditModal: false,
    editUser: { id: null, name: '', role: 'moderator', permissions: [] }
}">

    <!-- Top Header & Breadcrumb -->
    <div class="card-ledger p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--accent-primary)] text-xs font-bold uppercase tracking-wider mb-2">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <span>Administrative Governance</span>
            </div>
            <h1 class="text-2xl font-extrabold text-[var(--text-primary)] font-heading">
                Staff &amp; Access Control
            </h1>
            <p class="text-xs text-[var(--text-muted)] mt-1">Create Super Admins, assign Moderators, and configure granular permission access.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" @click="showCreateModal = true"
                    class="btn-primary text-xs flex items-center gap-1.5 cursor-pointer">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>Add New Staff Member</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-[var(--color-success-bg)] border border-[var(--color-success-border)] text-[var(--color-success)] text-xs font-medium flex items-center gap-2 shadow-xs">
            <svg class="w-4 h-4 shrink-0 text-[var(--color-success)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-900 dark:text-rose-200 text-xs font-medium flex items-center gap-2 shadow-xs">
            <svg class="w-4 h-4 shrink-0 text-rose-600 dark:text-rose-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-900 dark:text-rose-200 text-xs space-y-1 shadow-xs">
            <div class="font-bold flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Please fix the following validation issues:</span>
            </div>
            <ul class="list-disc pl-5 text-[11px] space-y-0.5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Staff Table Card -->
    <div class="card-ledger overflow-hidden">
        <div class="p-6 border-b border-[var(--border-subtle)] flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-[var(--text-primary)] font-heading">Staff Directory</h2>
                <p class="text-xs text-[var(--text-muted)]">All registered system administrators and moderators.</p>
            </div>
            <span class="text-xs font-bold text-[var(--text-muted)] bg-[var(--bg-subtle)] px-3 py-1 rounded-full border border-[var(--border-default)]">
                Total: {{ $staffUsers->count() }} staff members
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-[var(--text-secondary)]">
                <thead class="bg-[var(--bg-subtle)] text-[11px] font-bold uppercase tracking-wider text-[var(--text-muted)] border-b border-[var(--border-subtle)]">
                    <tr>
                        <th class="py-3 px-6">Staff Member</th>
                        <th class="py-3 px-6">Role</th>
                        <th class="py-3 px-6">Assigned Permissions</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @foreach($staffUsers as $staff)
                        <tr class="hover:bg-[var(--bg-subtle)]/50 transition">
                            <td class="py-4 px-6">
                                <div class="font-bold text-[var(--text-primary)] text-sm">{{ $staff->name }}</div>
                                <div class="text-[var(--text-muted)] text-[11px]">{{ $staff->email }}</div>
                                @if($staff->phone)
                                    <div class="text-[var(--text-muted)] text-[10px]">{{ $staff->phone }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($staff->isSuperAdmin())
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-[var(--accent-primary)]/15 text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                        <span>Super Admin</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                                        <span>Moderator</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($staff->isSuperAdmin())
                                    <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] border border-[var(--accent-primary)]/20">
                                        Full Platform Access (Unrestricted)
                                    </span>
                                @else
                                    <div class="flex flex-wrap gap-1.5 max-w-md">
                                        @php
                                            $userPerms = $staff->permissions ?? [];
                                        @endphp
                                        @if(empty($userPerms))
                                            <span class="text-[var(--text-muted)] italic text-[11px]">No active permissions assigned</span>
                                        @else
                                            @foreach($userPerms as $perm)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-[var(--bg-subtle)] text-[var(--text-secondary)] border border-[var(--border-default)]">
                                                    {{ $availablePermissions[$perm] ?? $perm }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($staff->is_active)
                                    <span class="inline-flex items-center gap-1 text-[var(--color-success)] font-bold text-[11px]">
                                        <span class="w-2 h-2 rounded-full bg-[var(--color-success)]"></span> Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[var(--text-muted)] font-bold text-[11px]">
                                        <span class="w-2 h-2 rounded-full bg-[var(--border-default)]"></span> Suspended
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                @if(!$staff->isSuperAdmin() || Auth::id() === $staff->id)
                                    <button type="button"
                                            @click="editUser = {
                                                id: {{ $staff->id }},
                                                name: '{{ addslashes($staff->name) }}',
                                                role: '{{ $staff->role }}',
                                                permissions: {{ json_encode($staff->permissions ?? []) }}
                                            }; showEditModal = true;"
                                            class="btn-secondary text-[11px] px-3 py-1.5 cursor-pointer">
                                        Permissions
                                    </button>
                                @endif

                                @if($staff->id !== Auth::id())
                                    <form action="{{ route('admin.staff.toggle-status', $staff->id) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('Are you sure you want to {{ $staff->is_active ? 'deactivate' : 'activate' }} this staff member?');">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-md font-bold text-[11px] transition cursor-pointer {{ $staff->is_active ? 'bg-rose-50 dark:bg-rose-950/60 hover:bg-rose-100 dark:hover:bg-rose-900/60 text-rose-700 dark:text-rose-300 border border-rose-200 dark:border-rose-800' : 'btn-primary' }}">
                                            {{ $staff->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Create Staff Modal -->
<div x-show="showCreateModal" style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div @click.away="showCreateModal = false"
         class="card-ledger max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-6">
        <div class="flex items-center justify-between pb-4 border-b border-[var(--border-subtle)]">
            <div>
                <h3 class="text-lg font-extrabold text-[var(--text-primary)] font-heading">Add New Staff Member</h3>
                <p class="text-xs text-[var(--text-muted)]">Create a new Super Admin or Moderator with specific access privileges.</p>
            </div>
            <button type="button" @click="showCreateModal = false" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-xl font-bold cursor-pointer">✕</button>
        </div>

        <form action="{{ route('admin.staff.store') }}" method="POST" class="space-y-4" x-data="{ createRole: 'moderator' }">
            @csrf

            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Staff Role</label>
                <div class="grid grid-cols-2 gap-3">
                    <label :class="createRole === 'moderator' ? 'border-[var(--accent-primary)] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] ring-1 ring-[var(--accent-primary)]' : 'border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-secondary)]'"
                           class="p-3 rounded-md border text-xs font-bold cursor-pointer flex items-center gap-2 transition">
                        <input type="radio" name="role" value="moderator" x-model="createRole" class="sr-only">
                        <span>Moderator</span>
                    </label>
                    <label :class="createRole === 'super_admin' ? 'border-[var(--accent-primary)] bg-[var(--accent-primary)]/10 text-[var(--accent-primary)] ring-1 ring-[var(--accent-primary)]' : 'border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-secondary)]'"
                           class="p-3 rounded-md border text-xs font-bold cursor-pointer flex items-center gap-2 transition">
                        <input type="radio" name="role" value="super_admin" x-model="createRole" class="sr-only">
                        <span>Super Admin</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Full Name</label>
                <input type="text" name="name" required placeholder="e.g. Ananda Thero"
                       class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Email Address</label>
                    <input type="email" name="email" required placeholder="staff@globalmaitri.com"
                           class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Phone Number</label>
                    <input type="tel" name="phone" placeholder="+1 555 000 9999"
                           class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Password</label>
                <div class="relative" x-data="{ showStaffPass: false }">
                    <input :type="showStaffPass ? 'text' : 'password'" name="password" required minlength="8" placeholder="Minimum 8 characters"
                           class="w-full px-3.5 py-2.5 pr-11 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    <button type="button" @click="showStaffPass = !showStaffPass"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[var(--text-muted)] hover:text-[var(--text-primary)] focus:outline-none cursor-pointer p-1"
                            :title="showStaffPass ? 'Hide password' : 'View password'"
                            tabindex="-1">
                        <svg x-show="!showStaffPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="showStaffPass" style="display: none;" class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Moderator Permissions Checkboxes -->
            <div x-show="createRole === 'moderator'" class="p-4 bg-[var(--bg-subtle)] rounded-xl border border-[var(--border-default)] space-y-3">
                <span class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                    Moderator Permissions (Access Control)
                </span>
                <div class="space-y-2">
                    @foreach($availablePermissions as $key => $label)
                        <label class="flex items-start gap-2.5 text-xs text-[var(--text-secondary)] cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                   {{ in_array($key, ['manage_verifications', 'manage_reports']) ? 'checked' : '' }}
                                   class="mt-0.5 rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <div>
                                <span class="font-bold text-[var(--text-primary)] block">{{ $label }}</span>
                                <span class="text-[10px] text-[var(--text-muted)]">Key: <code>{{ $key }}</code></span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div x-show="createRole === 'super_admin'" style="display: none;"
                 class="p-4 bg-[var(--accent-primary)]/10 rounded-xl border border-[var(--accent-primary)]/20 text-xs text-[var(--text-primary)]">
                <span class="font-bold block mb-1">Full Super Admin Privileges</span>
                Super Admins automatically receive unrestricted access to all settings, user management, policy updates, and platform controls.
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[var(--border-subtle)]">
                <button type="button" @click="showCreateModal = false" class="btn-secondary text-xs">
                    Cancel
                </button>
                <button type="submit" class="btn-primary text-xs">
                    Create Staff Member
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Staff Permissions Modal -->
<div x-show="showEditModal" style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div @click.away="showEditModal = false"
         class="card-ledger max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-6">
        <div class="flex items-center justify-between pb-4 border-b border-[var(--border-subtle)]">
            <div>
                <h3 class="text-lg font-extrabold text-[var(--text-primary)] font-heading">
                    Edit Access for <span x-text="editUser.name" class="text-[var(--accent-primary)]"></span>
                </h3>
                <p class="text-xs text-[var(--text-muted)]">Update role or assigned moderation privileges.</p>
            </div>
            <button type="button" @click="showEditModal = false" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-xl font-bold cursor-pointer">✕</button>
        </div>

        <form :action="'{{ url('/admin/staff') }}/' + editUser.id + '/permissions'" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] uppercase tracking-wider mb-1">Role</label>
                <select name="role" x-model="editUser.role"
                        class="w-full px-3.5 py-2.5 rounded-md border border-[var(--border-default)] bg-[var(--bg-canvas)] text-[var(--text-primary)] text-xs focus:border-[var(--accent-primary)] focus:ring-1 focus:ring-[var(--accent-primary)] outline-none">
                    <option value="moderator">Moderator</option>
                    <option value="super_admin">Super Admin</option>
                </select>
            </div>

            <!-- Moderator Permissions Checkboxes -->
            <div x-show="editUser.role === 'moderator'" class="p-4 bg-[var(--bg-subtle)] rounded-xl border border-[var(--border-default)] space-y-3">
                <span class="block text-xs font-bold text-[var(--text-primary)] uppercase tracking-wider">
                    Moderator Permissions
                </span>
                <div class="space-y-2">
                    @foreach($availablePermissions as $key => $label)
                        <label class="flex items-start gap-2.5 text-xs text-[var(--text-secondary)] cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                   :checked="editUser.permissions && editUser.permissions.includes('{{ $key }}')"
                                   class="mt-0.5 rounded text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                            <div>
                                <span class="font-bold text-[var(--text-primary)] block">{{ $label }}</span>
                                <span class="text-[10px] text-[var(--text-muted)]">Key: <code>{{ $key }}</code></span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div x-show="editUser.role === 'super_admin'" style="display: none;"
                 class="p-4 bg-[var(--accent-primary)]/10 rounded-xl border border-[var(--accent-primary)]/20 text-xs text-[var(--text-primary)]">
                <span class="font-bold block mb-1">Full Super Admin Access</span>
                Super Admins automatically receive unrestricted access to all areas.
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[var(--border-subtle)]">
                <button type="button" @click="showEditModal = false" class="btn-secondary text-xs">
                    Cancel
                </button>
                <button type="submit" class="btn-primary text-xs">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

