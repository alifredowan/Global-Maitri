<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Global Vivaha - Buddhist Matrimonial Platform')</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="alternate icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    <meta name="description" content="@yield('meta_description', 'Global Vivaha is a mindful Buddhist matrimonial platform for serious, marriage-oriented Buddhists across traditions, with verified profiles, family involvement, and mindful matchmaking.')">
    <meta name="robots" content="@yield('robots', 'noindex, nofollow')">
    @hasSection('canonical_url')
        <link rel="canonical" href="{{ config('seo.url').(request()->getPathInfo() === '/' ? '/' : request()->getPathInfo()) }}">
        <meta property="og:url" content="{{ config('seo.url').(request()->getPathInfo() === '/' ? '/' : request()->getPathInfo()) }}">
        @php
            $seoSiteUrl = rtrim((string) config('seo.url'), '/');
            $seoSchema = [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'Organization',
                        '@id' => $seoSiteUrl.'/#organization',
                        'name' => 'Global Vivaha',
                        'url' => $seoSiteUrl.'/',
                        'description' => 'A sacred Buddhist matrimonial platform for serious, marriage-oriented Buddhists across traditions, with verified profiles, family involvement, and mindful matchmaking.',
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => $seoSiteUrl.'/#website',
                        'name' => 'Global Vivaha',
                        'url' => $seoSiteUrl.'/',
                        'publisher' => ['@id' => $seoSiteUrl.'/#organization'],
                    ],
                ],
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($seoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
    <meta property="og:title" content="@yield('title', 'Global Vivaha - Buddhist Matrimonial Platform')">
    <meta property="og:description" content="@yield('meta_description', 'Global Vivaha is a mindful Buddhist matrimonial platform for serious, marriage-oriented Buddhists across traditions, with verified profiles, family involvement, and mindful matchmaking.')">
    <meta property="og:type" content="website">

    <!-- Theme Initialization (Prevent FOUC: Light / Dark Supported) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('vivaha_theme') || localStorage.getItem('maitri_theme') || (localStorage.getItem('theme') === 'dark' ? 'dark' : 'light');
            document.documentElement.classList.remove('dark');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Google Fonts: Marcellus (display) & Source Sans 3 (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Source Sans 3', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 16px; line-height: 1.55; }
        @media (max-width: 640px) { body { font-size: 15px; } }
        :where(h1, h2, h3, h4, .font-heading) { font-family: 'Marcellus', Georgia, serif; font-weight: 700; line-height: 1.2; letter-spacing: -0.01em; }
        .font-serif-accent { font-family: 'Marcellus', Georgia, serif; }
        .photo-blur {
            filter: blur(14px);
            transition: filter 0.3s ease;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full bg-[var(--bg-canvas)] text-[var(--text-primary)] antialiased selection:bg-[var(--color-primary)] selection:text-[var(--color-bg)] transition-colors duration-200"
      x-data="{
          sidebarOpen: (function() {
              try { localStorage.removeItem('sidebar_open'); } catch(e){}
              return localStorage.getItem('sidebar_expanded') === 'true';
          })(),
          mobileSidebarOpen: false,
          commandPaletteOpen: false,
          toggleSidebar() {
              if (window.innerWidth >= 1024) {
                  this.sidebarOpen = !this.sidebarOpen;
                  localStorage.setItem('sidebar_expanded', this.sidebarOpen);
              } else {
                  this.mobileSidebarOpen = !this.mobileSidebarOpen;
              }
          }
      }"
      @keydown.window.ctrl.k.prevent="commandPaletteOpen = true"
      @keydown.window.cmd.k.prevent="commandPaletteOpen = true"
      @open-command-palette.window="commandPaletteOpen = true">

    <!-- Cookie Consent (Restored with Customize Panel, 12-Month Storage, and Admin Compliance) -->
    <x-cookie-consent />

    @auth
        {{-- ========================================================= --}}
        {{-- AUTHENTICATED USER: FULL SIDEBAR LAYOUT (NO TOP TABS)    --}}
        {{-- ========================================================= --}}
        <div class="min-h-full flex">

            <!-- Mobile Off-Canvas Sidebar Backdrop & Drawer -->
            <div x-show="mobileSidebarOpen"
                 x-cloak
                 class="fixed inset-0 z-50 lg:hidden flex"
                 role="dialog"
                 aria-modal="true">
                <div x-show="mobileSidebarOpen"
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="mobileSidebarOpen = false"
                     class="fixed inset-0 bg-slate-950/80 backdrop-blur-xs"></div>

                <div x-show="mobileSidebarOpen"
                     x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     class="relative mr-16 flex-1 w-full max-w-xs bg-slate-900 border-r border-slate-800 text-slate-200 flex flex-col py-6 px-4">
                    
                    <!-- Close Button -->
                    <div class="absolute top-4 right-4">
                        <button type="button"
                                @click="mobileSidebarOpen = false"
                                class="p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Brand in Mobile Drawer (Clicking closes drawer) -->
                    <div @click="mobileSidebarOpen = false" class="flex items-center gap-3 px-2 mb-6 cursor-pointer select-none" title="Close Drawer">
                        <x-application-logo variant="badge" badge-class="w-10 h-10" />
                        <div>
                            <span class="font-heading font-extrabold text-lg text-white tracking-tight flex items-center gap-1">
                                Global<span class="text-[var(--color-accent)]">Vivaha</span>
                            </span>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--color-accent)] block -mt-0.5">
                                {{ Auth::user()->isSuperAdmin() ? 'Super Admin' : (Auth::user()->isModerator() ? 'Staff' : (Auth::user()->isMonkAdvisor() ? 'Monk / Sangha Advisor' : (Auth::user()->isFamilyRep() ? 'Family Representative' : 'Candidate Seeker'))) }}
                            </span>
                        </div>
                    </div>

                    <!-- Role-Based Nav Links -->
                    <nav class="flex-1 space-y-1 overflow-y-auto pr-1">
                        @include('layouts.partials.sidebar-nav')
                    </nav>

                    <!-- Mobile User Profile Indicator -->
                    <div class="pt-4 mt-4 border-t border-slate-800">
                        <div class="flex items-center gap-3 px-2 py-2">
                            <div class="w-9 h-9 rounded-full bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-slate-400 font-medium capitalize">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Collapsible Sidebar -->
            <aside x-show="sidebarOpen"
                   x-cloak
                   x-transition:enter="transition-all ease-in-out duration-300"
                   x-transition:enter-start="opacity-0 -translate-x-full"
                   x-transition:enter-end="opacity-100 translate-x-0"
                   x-transition:leave="transition-all ease-in-out duration-300"
                   x-transition:leave-start="opacity-100 translate-x-0"
                   x-transition:leave-end="opacity-0 -translate-x-full"
                   class="hidden lg:flex lg:flex-col lg:w-64 bg-slate-900 text-slate-300 border-r border-slate-800 shrink-0 sticky top-0 h-screen z-30 transition-all duration-300">
                <!-- Sidebar Header -->
                <div class="p-4 border-b border-slate-800/80 flex items-center justify-between gap-2">
                    <button type="button"
                            @click="toggleSidebar()"
                            class="flex items-center gap-3 group flex-1 min-w-0 text-left cursor-pointer focus:outline-none"
                            title="Open / Close Sidebar (Global Maitri Logo) • Global Vivaha">
                        <x-application-logo variant="badge" badge-class="w-10 h-10 group-hover:scale-105" />
                        <div>
                            <div class="font-heading font-extrabold text-base text-white tracking-tight flex items-center gap-1 group-hover:text-[var(--color-accent)] transition">
                                Global<span class="text-[var(--color-accent)]">Vivaha</span>
                            </div>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <span class="inline-block w-2 h-2 rounded-full bg-[var(--accent-primary)] animate-pulse"></span>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">
                                    @if(Auth::user()->isSuperAdmin())
                                        Super Admin
                                    @elseif(Auth::user()->isModerator())
                                        Staff Admin
                                    @elseif(Auth::user()->isMonkAdvisor())
                                        Monk / Sangha Advisor
                                    @elseif(Auth::user()->isFamilyRep())
                                        Family Representative
                                    @else
                                        Candidate Portal
                                    @endif
                                </span>
                            </div>
                        </div>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    @include('layouts.partials.sidebar-nav')
                </nav>

                <!-- Sidebar Footer User Card -->
                <div class="p-4 border-t border-slate-800/80 bg-slate-950/40">
                    <div class="flex items-center gap-2.5 p-2.5 rounded-[6px] bg-slate-800/50 border border-slate-700/60">
                        <div class="w-8 h-8 rounded-full bg-[var(--accent-primary)] text-white font-bold flex items-center justify-center text-xs shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-400 truncate">{{ Auth::user()->email }}</p>
                            <span class="inline-flex items-center gap-1 text-[9px] font-bold text-[var(--accent-primary)] uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-[var(--accent-primary)]"></span>
                                {{ Auth::user()->isSuperAdmin() ? 'Super Admin' : (Auth::user()->isModerator() ? 'Staff' : (Auth::user()->isMonkAdvisor() ? 'Monk / Sangha Advisor' : (Auth::user()->isWali() ? 'Family Rep (Kalyāṇa-Mitta)' : 'Seeker'))) }}
                            </span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Canvas (Top Header with ZERO TABS + Content) -->
            <div class="flex-1 flex flex-col min-w-0">

                <!-- Clean Top Navigation Header (NO TABS) -->
                <header class="sticky top-0 z-40 h-16 bg-[var(--color-surface)]/95 dark:bg-[var(--color-surface)]/95 backdrop-blur-md border-b border-[var(--color-border)] flex items-center justify-between px-4 sm:px-6 lg:px-8">
                    <!-- Left: Single 3-Dots Button AND Global Maitri Logo (Both trigger open/close) -->
                    <div class="flex items-center gap-3">
                        <!-- 3-Dots Toggle Button (The ONE 3-Dots Button) -->
                        <button type="button"
                                @click="toggleSidebar()"
                                class="p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:text-[var(--color-primary)] dark:hover:text-[var(--color-primary)] hover:bg-[var(--color-primary-soft)] dark:hover:bg-slate-800 transition focus:outline-none cursor-pointer flex items-center justify-center shrink-0"
                                aria-label="Toggle Sidebar Menu"
                                title="Open / Close Sidebar (3 Dots)">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="5" cy="12" r="2.25"/>
                                <circle cx="12" cy="12" r="2.25"/>
                                <circle cx="19" cy="12" r="2.25"/>
                            </svg>
                        </button>

                        <!-- Global Vivaha Brand Logo & Name (Shown when sidebar is collapsed, or on mobile) -->
                        <div @click="toggleSidebar()"
                             x-show="!sidebarOpen || window.innerWidth < 1024"
                             class="flex items-center gap-2.5 cursor-pointer select-none group"
                             title="Open / Close Sidebar (Global Maitri Logo) • Global Vivaha">
                            <x-application-logo variant="badge" badge-class="w-9 h-9 group-hover:scale-105" />
                            <span class="font-heading font-extrabold text-base tracking-tight text-[var(--color-primary)] group-hover:text-[var(--color-primary-hover)] transition">
                                Global<span class="text-[var(--color-accent)]">Vivaha</span>
                            </span>
                        </div>

                        <!-- Desktop Main Navigation Next to Logo (Discover, Interests, Shortlist) -->
                        <nav class="hidden md:flex items-center gap-1 ml-2 lg:ml-4" aria-label="Main Navigation">
                            <a href="{{ route('discovery.index') }}"
                               class="relative px-3 py-1.5 text-xs font-semibold rounded-md transition-colors {{ request()->routeIs('discovery.*') ? 'text-[var(--color-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--color-primary)] hover:bg-[var(--bg-subtle)]' }}">
                                Discover
                                @if(request()->routeIs('discovery.*'))
                                    <span class="absolute bottom-0 left-3 right-3 h-0.5 rounded-full bg-[var(--color-accent)]"></span>
                                @endif
                            </a>
                            <a href="{{ route('interests.index') }}"
                               class="relative px-3 py-1.5 text-xs font-semibold rounded-md transition-colors {{ request()->routeIs('interests.*') ? 'text-[var(--color-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--color-primary)] hover:bg-[var(--bg-subtle)]' }}">
                                Interests
                                @if(request()->routeIs('interests.*'))
                                    <span class="absolute bottom-0 left-3 right-3 h-0.5 rounded-full bg-[var(--color-accent)]"></span>
                                @endif
                            </a>
                            <a href="{{ route('bookmarks.index') }}"
                               class="relative px-3 py-1.5 text-xs font-semibold rounded-md transition-colors {{ request()->routeIs('bookmarks.*') ? 'text-[var(--color-primary)] font-bold' : 'text-[var(--text-secondary)] hover:text-[var(--color-primary)] hover:bg-[var(--bg-subtle)]' }}">
                                Shortlist
                                @if(request()->routeIs('bookmarks.*'))
                                    <span class="absolute bottom-0 left-3 right-3 h-0.5 rounded-full bg-[var(--color-accent)]"></span>
                                @endif
                            </a>
                        </nav>
                    </div>

                    <!-- Center: Quick Command Search Trigger (Standard SaaS Benchmark) -->
                    <div class="hidden md:flex flex-1 max-w-sm mx-4">
                        <button type="button"
                                @click="commandPaletteOpen = true"
                                class="w-full flex items-center justify-between gap-3 px-3.5 py-1.5 rounded-[4px] border border-[var(--border-default)] bg-[var(--bg-subtle)] text-[var(--text-muted)] hover:text-[var(--text-primary)] hover:border-[var(--color-accent)] transition cursor-pointer text-xs group"
                                title="Quick Command Palette & Search (Ctrl + K)">
                            <div class="flex items-center gap-2 min-w-0">
                                <svg class="w-4 h-4 text-[var(--color-primary)] shrink-0 group-hover:scale-105 transition transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span class="font-medium text-[var(--text-secondary)] truncate">Quick search & navigation...</span>
                            </div>
                            <div class="flex items-center gap-1 font-mono text-[10px] bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-muted)] rounded px-1.5 py-0.5 shadow-xs shrink-0">
                                <kbd>Ctrl</kbd>+<kbd>K</kbd>
                            </div>
                        </button>
                    </div>

                    <!-- Right Controls: Standard Header Actions (1. Messages, 2. Notifications, 3. Theme, 4. Avatar/AccountMenu) -->
                    <x-header-actions />
                </header>

                <!-- Mangala Vivaha Milestone Banner if pending -->
                @if(Auth::user()->pendingMarriage())
                    @php $pendingM = Auth::user()->pendingMarriage(); @endphp
                    <div class="bg-gradient-to-r from-amber-500/20 via-rose-500/15 to-amber-500/20 border-b border-amber-300 dark:border-amber-700/60 px-4 py-3 text-slate-900 dark:text-slate-100 text-xs font-semibold">
                        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5">
                                <span class="flex h-6 w-6 items-center justify-center rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </span>
                                <span>
                                    @if(Auth::id() !== $pendingM->initiated_by_user_id)
                                        <strong>Mangala Vivaha Declaration Pending:</strong> {{ $pendingM->initiator->name }} declared your wedding blessing celebration!
                                    @else
                                        <strong>Mangala Vivaha Declaration Submitted:</strong> Waiting for spouse confirmation.
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('marriages.celebration') }}" class="btn-primary text-xs !py-1 !px-3 shrink-0">
                                View Celebration &rarr;
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Flash Alerts -->
                <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    @if(session('success'))
                        <div class="bg-[var(--bg-surface)] border border-[var(--color-success)] text-[var(--text-primary)] px-4 py-3 rounded-[var(--radius-sm)] text-xs font-medium flex items-center justify-between shadow-2xs mb-4">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-[var(--color-success)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="bg-[var(--bg-surface)] border border-[var(--color-warning)] text-[var(--text-primary)] px-4 py-3 rounded-[var(--radius-sm)] text-xs font-medium flex items-center justify-between shadow-2xs mb-4">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-[var(--color-warning)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                <span>{{ session('warning') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="bg-[var(--bg-surface)] border border-[var(--border-default)] text-[var(--text-primary)] px-4 py-3 rounded-[var(--radius-sm)] text-xs font-medium flex items-center justify-between shadow-2xs mb-4">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                <span>{{ session('info') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-[var(--bg-surface)] border border-[var(--color-danger)] text-[var(--text-primary)] p-4 rounded-[var(--radius-sm)] text-xs shadow-2xs mb-4">
                            <p class="font-bold text-[var(--color-danger)] mb-1">Please check the following details:</p>
                            <ul class="list-disc list-inside space-y-0.5 text-[var(--text-secondary)]">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Main Content Area -->
                <main class="flex-1 pb-16">
                    @yield('content')
                </main>

                <!-- Unified Platform Footer -->
                @include('layouts.partials.footer')
            </div>

            <!-- Mobile Bottom Tab Bar (Discover, Interests, Messages, Shortlist, Profile) -->
            <x-mobile-bottom-nav />
        </div>

    @else
        {{-- ========================================================= --}}
        {{-- GUEST VISITOR: CLEAN PUBLIC HEADER & FULL-WIDTH CANVAS    --}}
        {{-- ========================================================= --}}
        <div class="min-h-full flex flex-col">
            <!-- Standard Logged-Out Public Header (64px desktop, 56px mobile) -->
            <header class="sticky top-0 z-40 border-b border-[var(--border-default)] bg-[var(--bg-surface)]/95 backdrop-blur-md shadow-2xs">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-14 sm:h-16">
                        <!-- Brand Logo -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('landing') }}" class="group">
                                <x-application-logo variant="full" badge-class="w-9 h-9" />
                            </a>
                        </div>

                        <!-- Public Controls: How it works, theme toggle, Sign in text link, Create profile button -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <a href="{{ route('how-it-works') }}"
                               class="hidden sm:inline-flex items-center text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] px-2.5 py-1.5 transition {{ request()->routeIs('how-it-works') ? 'text-[var(--accent-primary)] font-bold' : '' }}">
                                How it works
                            </a>

                            <!-- Icon-Only Theme Toggle (44x44px hit area, 22px icon) -->
                            <div class="relative inline-flex"
                                 x-data="{
                                     isDark: document.documentElement.classList.contains('dark'),
                                     toggleTheme() {
                                         this.isDark = !this.isDark;
                                         if (this.isDark) {
                                             document.documentElement.classList.add('dark');
                                             localStorage.setItem('theme', 'dark');
                                             localStorage.setItem('maitri_theme', 'dark');
                                         } else {
                                             document.documentElement.classList.remove('dark');
                                             localStorage.setItem('theme', 'light');
                                             localStorage.setItem('maitri_theme', 'light');
                                         }
                                         window.dispatchEvent(new CustomEvent('maitri-mood-changed', { detail: { mood: this.isDark ? 'dark' : 'light' } }));
                                     }
                                 }">
                                <button type="button"
                                        @click="toggleTheme()"
                                        title="Theme"
                                        aria-label="Toggle light and dark theme"
                                        class="w-11 h-11 flex items-center justify-center rounded-full text-[var(--text-secondary)] hover:text-[var(--text-primary)] hover:bg-[var(--bg-subtle)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[var(--accent-primary)] transition cursor-pointer">
                                    <svg x-show="isDark" x-cloak class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                                    </svg>
                                    <svg x-show="!isDark" class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                                    </svg>
                                </button>
                            </div>

                            <a href="{{ route('login') }}" class="text-xs font-semibold text-[var(--text-secondary)] hover:text-[var(--text-primary)] px-2.5 py-1.5 transition">
                                Sign in
                            </a>
                            <a href="{{ route('register') }}" class="btn-primary text-xs !py-2 !px-4">
                                Create profile
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1">
                @yield('content')
            </main>

            <!-- Unified Platform Footer -->
            @include('layouts.partials.footer')
        </div>
    @endauth

    @auth
        <!-- ========================================================= -->
        <!-- GLOBAL COMMAND PALETTE (CTRL + K / CMD + K)               -->
        <!-- ========================================================= -->
        <div x-show="commandPaletteOpen"
             x-cloak
             x-transition:enter="transition-opacity ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto p-4 sm:p-6 md:p-20 flex items-start justify-center"
             role="dialog"
             aria-modal="true"
             @keydown.escape.window="commandPaletteOpen = false">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"
                 @click="commandPaletteOpen = false"></div>

            <!-- Spotlight Dialog -->
            <div x-show="commandPaletteOpen"
                 x-transition:enter="transition ease-out duration-200 transform"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative w-full max-w-xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden z-10"
                 x-data="{
                     search: '',
                     items: [
                         @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
                             { name: 'Dashboard Overview', cat: 'Admin', icon: '📊', url: '{{ route('admin.dashboard') }}' },
                             { name: 'KYC Queue & Identity Verifications', cat: 'Admin', icon: '🪪', url: '{{ route('admin.verifications') }}' },
                             { name: 'User Safety Reports', cat: 'Admin', icon: '🚩', url: '{{ route('admin.reports') }}' },
                             { name: 'Dynamic Packages & Pricing Tiers', cat: 'Billing', icon: '💳', url: '{{ route('admin.packages.index') }}' },
                             { name: 'Promo Codes & VIP Discounts', cat: 'Billing', icon: '🏷️', url: '{{ route('admin.promo-codes.index') }}' },
                             { name: 'Payment Gateways & PayPal/Stripe Setup', cat: 'Billing', icon: '💰', url: '{{ route('admin.payment-settings') }}' },
                             @if(Auth::user()->isSuperAdmin())
                                 { name: 'Staff Management & Role Permissions', cat: 'Governance', icon: '👥', url: '{{ route('admin.staff') }}' },
                             @endif
                             { name: 'Immutable Audit Logs', cat: 'Governance', icon: '📜', url: '{{ route('admin.audit-logs') }}' },
                             { name: 'Platform Policies & Security Rules', cat: 'Settings', icon: '⚙️', url: '{{ route('admin.settings') }}' },
                         @endif

                         @if(Auth::user()->isSeeker() && !Auth::user()->isWali())
                             { name: 'Find Matches / Matrimonial Discovery', cat: 'Matches', icon: '✨', url: '{{ route('discovery.index') }}' },
                             { name: 'Interests & Requests', cat: 'Matches', icon: '💌', url: '{{ route('interests.index') }}' },
                             { name: 'Shortlisted Biodatas', cat: 'Matches', icon: '⭐', url: '{{ route('bookmarks.index') }}' },
                             { name: 'Chaperoned Messages & Chat', cat: 'Chat', icon: '💬', url: '{{ route('chat.index') }}' },
                             { name: 'My Biodata & Lotus Photos', cat: 'Biodata', icon: '🪷', url: '{{ route('profile.show') }}' },
                             { name: 'Edit Deen & Partner Preferences', cat: 'Biodata', icon: '📝', url: '{{ route('profile.edit') }}' },
                             { name: 'Printable Biodata PDF', cat: 'Biodata', icon: '🖨️', url: '{{ route('profile.biodata') }}' },
                             { name: 'Subscription Plans & Upgrades', cat: 'Billing', icon: '💎', url: '{{ route('subscription.pricing') }}' },
                         @endif

                         @if(Auth::user()->isWali())
                             { name: 'Family Rep Console & Candidate Overview', cat: 'Family Rep', icon: '🤝', url: '{{ route('wali.dashboard') }}' },
                             { name: 'Link Candidate by Matrimonial Code', cat: 'Family Rep', icon: '🔗', url: '{{ route('wali.link') }}' },
                         @endif

                         { name: 'Account Settings & Security', cat: 'Settings', icon: '🔒', url: '{{ route('settings.index') }}' },
                         { name: 'Switch Mood: Daylight (Noor)', cat: 'Mood', icon: '☀️', action: 'light' },
                         { name: 'Switch Theme: Daylight Mode', cat: 'Theme', icon: '☀️', action: 'light' },
                         { name: 'Switch Theme: Serene Dark Mode', cat: 'Theme', icon: '🌙', action: 'dark' },
                     ],
                     get filteredItems() {
                         if (!this.search.trim()) return this.items.slice(0, 8);
                         const q = this.search.toLowerCase();
                         return this.items.filter(i => i.name.toLowerCase().includes(q) || i.cat.toLowerCase().includes(q));
                     },
                     executeItem(item) {
                         if (item.action) {
                             if (window.setMaitriMood) window.setMaitriMood(item.action);
                             commandPaletteOpen = false;
                         } else if (item.url) {
                             window.location.href = item.url;
                         }
                     }
                 }">

                <!-- Search Header -->
                <div class="relative flex items-center p-4 border-b border-slate-100 dark:border-slate-800">
                    <svg class="w-5 h-5 text-[var(--color-primary)] mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text"
                           x-model="search"
                           x-ref="searchInput"
                           x-init="$watch('commandPaletteOpen', value => { if (value) setTimeout(() => $refs.searchInput.focus(), 100); })"
                           placeholder="Type a command or page name (e.g. 'matches', 'interests', 'pricing')..."
                           class="w-full bg-transparent text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none font-medium">
                    <button type="button"
                            @click="commandPaletteOpen = false"
                            class="text-[10px] font-mono font-bold px-2 py-1 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-900 dark:hover:text-white transition cursor-pointer">
                        ESC
                    </button>
                </div>

                <!-- Results List -->
                <div class="max-h-80 overflow-y-auto p-2 space-y-1">
                    <template x-for="item in filteredItems" :key="item.name">
                        <button type="button"
                                @click="executeItem(item)"
                                class="w-full flex items-center justify-between p-2.5 rounded-2xl hover:bg-[var(--color-primary-soft)] dark:hover:bg-slate-800/80 transition text-left group cursor-pointer">
                            <div class="flex items-center gap-3 min-w-0">
                                <span x-text="item.icon" class="text-lg shrink-0"></span>
                                <div class="truncate">
                                    <p class="text-xs font-bold text-slate-800 dark:text-slate-100 group-hover:text-[var(--color-primary)] dark:group-hover:text-[var(--color-primary)] transition truncate" x-text="item.name"></p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 uppercase tracking-wider shrink-0" x-text="item.cat"></span>
                        </button>
                    </template>
                    <div x-show="filteredItems.length === 0" class="py-8 text-center text-xs text-slate-400">
                        No results found for "<span x-text="search" class="font-bold"></span>". Try another search term.
                    </div>
                </div>

                <!-- Footer Hint -->
                <div class="px-4 py-2.5 bg-slate-50 dark:bg-slate-950/50 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Quick Navigation</span>
                    <span class="flex items-center gap-1 font-mono text-[10px]">
                        Use <kbd class="px-1 py-0.5 bg-white dark:bg-slate-800 rounded border border-slate-200 dark:border-slate-700">ESC</kbd> to exit
                    </span>
                </div>
            </div>
        </div>
    @endauth

    <!-- Reverb Real-Time Toast Notification Container -->
    <div id="reverb-toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2.5 max-w-sm w-full pointer-events-none px-4 sm:px-0"></div>

    <!-- Theme & Real-Time Broadcasting Scripts -->
    <script>
        // Global Theme Switching Helper Function
        window.setMaitriMood = window.setNikahMood = function(mood) {
            localStorage.setItem('maitri_theme', mood);
            localStorage.setItem('theme', mood === 'dark' ? 'dark' : 'light');
            document.documentElement.classList.remove('dark');
            if (mood === 'dark') {
                document.documentElement.classList.add('dark');
            }
            window.dispatchEvent(new CustomEvent('maitri-mood-changed', { detail: { mood } }));
        };

        // Play gentle notification sound via Web Audio API
        window.playMaitriNotificationSound = window.playHalalNotificationSound = function() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                const now = ctx.currentTime;
                
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(587.33, now);
                osc.frequency.exponentialRampToValueAtTime(880, now + 0.12);
                
                gain.gain.setValueAtTime(0.12, now);
                gain.gain.exponentialRampToValueAtTime(0.001, now + 0.4);
                
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start(now);
                osc.stop(now + 0.4);
            } catch (e) {
                // Audio autoplay might be restricted by browser policy
            }
        };

        // Show toast notification with strict duplicate guard
        const recentToastSignatures = new Set();
        window.showMaitriNotificationToast = window.showHalalNotificationToast = function(data) {
            const container = document.getElementById('reverb-toast-container');
            if (!container || !data) return;

            // Strict deduplication signature: ID + Title + Message
            const toastKey = (data.id ? String(data.id) : '') + '::' + (data.title || '') + '::' + (data.message || '');
            if (recentToastSignatures.has(toastKey)) {
                return;
            }
            recentToastSignatures.add(toastKey);
            setTimeout(() => recentToastSignatures.delete(toastKey), 4000);

            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto p-4 rounded-[var(--radius-md)] bg-[var(--bg-surface)] border border-[var(--border-default)] shadow-lg flex items-start gap-3 transition-all duration-300 transform translate-y-3 opacity-0';
            
            const iconSvg = `<svg class="w-4 h-4 text-[var(--accent-primary)]" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>`;
            const title = data.title || 'New Notification';
            const message = data.message || '';
            const actionUrl = data.action_url || '';

            toast.innerHTML = `
                <div class="w-8 h-8 rounded-[var(--radius-xs)] bg-[var(--accent-subtle)] text-[var(--accent-primary)] flex items-center justify-center shrink-0">
                    ${iconSvg}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-1.5">
                        <h4 class="font-semibold text-xs text-[var(--text-primary)] truncate">${title}</h4>
                    </div>
                    <p class="text-[11px] text-[var(--text-secondary)] mt-0.5 leading-snug line-clamp-2">${message}</p>
                    ${actionUrl ? `<a href="${actionUrl}" class="inline-block text-[11px] font-semibold text-[var(--accent-primary)] hover:underline mt-1.5">View details &rarr;</a>` : ''}
                </div>
                <button type="button" aria-label="Close" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-sm p-1 leading-none">&times;</button>
            `;

            const closeBtn = toast.querySelector('button');
            closeBtn.onclick = () => {
                toast.classList.add('opacity-0', 'translate-y-3');
                setTimeout(() => toast.remove(), 300);
            };

            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.remove('opacity-0', 'translate-y-3');
            });

            setTimeout(() => {
                if (toast.parentElement) {
                    toast.classList.add('opacity-0', 'translate-y-3');
                    setTimeout(() => toast.remove(), 300);
                }
            }, 8000);
        }

        // Initialize Laravel Reverb Echo Listener
        document.addEventListener('DOMContentLoaded', function() {
            const cookieConsentKey = 'global_maitri_cookie_consent';
            const cookieConsentBanner = document.getElementById('cookie-consent-banner');

            try {
                if (!localStorage.getItem(cookieConsentKey) && cookieConsentBanner) {
                    cookieConsentBanner.classList.remove('hidden');
                }
            } catch (error) {
                if (cookieConsentBanner) {
                    cookieConsentBanner.classList.remove('hidden');
                }
            }

            document.querySelectorAll('[data-cookie-consent]').forEach(function(button) {
                button.addEventListener('click', function() {
                    try {
                        localStorage.setItem(cookieConsentKey, button.dataset.cookieConsent);
                    } catch (error) {
                        // Continue with essential cookies when storage is unavailable.
                    }

                    cookieConsentBanner?.classList.add('hidden');
                });
            });

            @auth
                const currentUserId = {{ Auth::id() }};
                window.processedNotificationIds = new Set();

                window.updateSidebarMessageBadge = function(count) {
                    document.querySelectorAll('.sidebar-unread-messages-badge').forEach(badge => {
                        const num = parseInt(count) || 0;
                        if (num > 0) {
                            badge.textContent = num > 99 ? '99+' : num;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    });
                };

                window.handleReverbNotification = function(notification) {
                    const data = notification.data || notification;
                    const notifId = notification.id || data.id || (data.message_id ? 'msg-' + data.message_id : null);

                    if (notifId && window.processedNotificationIds.has(notifId)) {
                        return;
                    }
                    if (notifId) {
                        window.processedNotificationIds.add(notifId);
                    }

                    playHalalNotificationSound();
                    showHalalNotificationToast({
                        id: notifId,
                        title: data.title || 'New Notification',
                        message: data.message || '',
                        icon: data.icon || '🔔',
                        action_url: data.action_url || ''
                    });

                    // If incoming notification is a chat message, dynamically update sidebar message badge
                    if (data.type === 'chat_message' || data.type === 'wali_chaperoned_message' || data.conversation_id) {
                        document.querySelectorAll('.sidebar-unread-messages-badge').forEach(badge => {
                            let cur = parseInt(badge.textContent) || 0;
                            badge.textContent = (cur + 1) > 99 ? '99+' : (cur + 1);
                            badge.classList.remove('hidden');
                        });
                    }

                    window.dispatchEvent(new CustomEvent('new-notification-received', {
                        detail: {
                            id: notifId || 'notif-' + Date.now(),
                            data: data,
                            read_at: null,
                            created_at: 'Just now'
                        }
                    }));
                };

                let echoSubscribed = false;
                function setupEchoListeners() {
                    if (echoSubscribed || !window.Echo) return;
                    echoSubscribed = true;

                    try {
                        // Subscribe exclusively to the user's private notification channel
                        window.Echo.private('App.Models.User.' + currentUserId)
                            .notification(window.handleReverbNotification);
                    } catch (err) {
                        console.warn('Echo subscription setup error:', err);
                    }
                }

                if (window.Echo) {
                    setupEchoListeners();
                } else {
                    window.addEventListener('echo:ready', setupEchoListeners);
                    let checkCount = 0;
                    const echoTimer = setInterval(() => {
                        checkCount++;
                        if (window.Echo) {
                            clearInterval(echoTimer);
                            setupEchoListeners();
                        } else if (checkCount > 50) {
                            clearInterval(echoTimer);
                        }
                    }, 200);
                }
            @endauth
        });
    </script>
</body>
</html>

