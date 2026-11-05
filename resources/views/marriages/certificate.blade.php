<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangala Vivaha Certificate - {{ $marriage->groom->name }} & {{ $marriage->bride->name }} | Global Maitri</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Great+Vibes&family=Outfit:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-cinzel { font-family: 'Cinzel', serif; letter-spacing: 0.08em; }
        .font-script { font-family: 'Great Vibes', cursive; }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .certificate-container { border: 8px double #a67c00 !important; box-shadow: none !important; margin: 0 auto !important; width: 100% !important; max-width: 100% !important; padding: 32px !important; }
            @page { size: A4 landscape; margin: 10mm; }
        }
    </style>
</head>
<body class="bg-[var(--bg-canvas)] text-[var(--text-primary)] antialiased min-h-screen py-10 flex flex-col items-center">

    <!-- Action Toolbar (hidden on print) -->
    <div class="no-print w-full max-w-4xl mx-auto mb-6 px-4 flex items-center justify-between">
        <a href="{{ route('marriages.celebration') }}" class="btn-secondary inline-flex items-center gap-1.5 text-xs py-2 px-4 cursor-pointer">
            &larr; Return to Celebration
        </a>

        <div class="flex items-center gap-3">
            <span class="text-xs text-[var(--text-secondary)] font-medium">Digital Blessing Certificate</span>
            <button onclick="window.print()" class="btn-primary inline-flex items-center gap-2 text-xs py-2.5 px-5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Print / Save as PDF</span>
            </button>
        </div>
    </div>

    <!-- Printable Certificate Container -->
    <div class="certificate-container w-full max-w-4xl bg-white rounded-[4px] border-8 border-double border-[var(--accent-primary)]/80 p-10 sm:p-14 shadow-xl space-y-8 text-center relative overflow-hidden">

        <!-- Subtle Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none select-none">
            <svg class="w-96 h-96 text-[var(--accent-primary)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                <circle cx="12" cy="12" r="9"/>
                <circle cx="12" cy="12" r="3"/>
                <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
            </svg>
        </div>

        <!-- Certificate Header -->
        <div class="space-y-2 relative">
            <div class="w-16 h-16 mx-auto rounded-[4px] bg-[var(--accent-primary)]/10 border-2 border-[var(--accent-primary)]/40 flex items-center justify-center text-[var(--accent-primary)] shadow-xs">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                    <circle cx="12" cy="12" r="9"/>
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 3v6m0 6v6M3 12h6m6 0h6"/>
                </svg>
            </div>

            <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-[var(--accent-primary)] font-bold pt-2">
                Global Maitri Buddhist Matrimony
            </p>

            <h1 class="font-cinzel text-2xl sm:text-4xl font-extrabold text-[var(--text-primary)] tracking-wide uppercase pt-1">
                Mangala Vivaha Blessing Certificate
            </h1>

            <div class="w-32 h-0.5 bg-[var(--accent-primary)] mx-auto mt-2"></div>
        </div>

        <!-- Pali Mangala Blessing Verse -->
        <div class="max-w-2xl mx-auto space-y-1 relative">
            <p class="font-cinzel text-xs sm:text-sm text-[var(--accent-primary)] font-semibold italic">
                &ldquo;Asevanā ca bālānaṁ, paṇḍitānañca sevanā, pūjā ca pūjanīyānaṁ — etaṁ maṅgalamuttamaṁ&rdquo;
            </p>
            <p class="text-[11px] text-[var(--text-secondary)] italic">
                Not consorting with the unwise, associating with the wise, honoring those worthy of honor — this is the supreme blessing.
            </p>
        </div>

        <!-- Certification Body -->
        <div class="space-y-6 relative max-w-2xl mx-auto py-2">
            <p class="text-xs sm:text-sm text-[var(--text-secondary)] uppercase tracking-widest font-semibold">
                This certifies the auspicious union and lifelong partnership of
            </p>

            <!-- Couple Names in Elegant Display -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 py-2">
                <div class="text-center">
                    <span class="font-cinzel text-xl sm:text-2xl font-bold text-[var(--text-primary)] block">
                        {{ $marriage->groom->name }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider text-[var(--accent-primary)] font-bold">Groom</span>
                </div>

                <div class="font-script text-3xl sm:text-4xl text-[var(--accent-primary)] font-bold">
                    &amp;
                </div>

                <div class="text-center">
                    <span class="font-cinzel text-xl sm:text-2xl font-bold text-[var(--text-primary)] block">
                        {{ $marriage->bride->name }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider text-[var(--accent-primary)] font-bold">Bride</span>
                </div>
            </div>

            <p class="text-xs sm:text-sm text-[var(--text-primary)] leading-relaxed max-w-xl mx-auto">
                Solemnized on
                <strong>{{ $marriage->marriage_date ? $marriage->marriage_date->format('jS \of F, Y') : ($marriage->confirmed_at ? $marriage->confirmed_at->format('jS \of F, Y') : now()->format('jS \of F, Y')) }}</strong>
                in the spirit of loving-kindness (<em>Metta</em>), mutual reverence, non-attachment, and harmonious companionship.
            </p>

            <!-- Metta Wish Box -->
            <div class="p-4 rounded-[4px] bg-[var(--accent-primary)]/10 border border-[var(--accent-primary)]/20 text-[var(--accent-primary)] font-serif text-sm max-w-lg mx-auto font-semibold">
                &ldquo;Sabbe satta bhavantu sukhitatta &bull; May you be happy and well &bull; Sadhu Sadhu Sadhu&rdquo;
            </div>
        </div>

        <!-- Signatures & Seal Section -->
        <div class="grid grid-cols-3 gap-6 pt-6 border-t border-[var(--border-default)] max-w-2xl mx-auto text-center relative">
            <div>
                <div class="h-10 border-b border-[var(--border-strong)] flex items-end justify-center pb-1">
                    <span class="font-script text-xl text-[var(--text-primary)]">{{ $marriage->groom->name }}</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block mt-1">Groom Signature</span>
            </div>

            <div class="flex flex-col items-center justify-center">
                <div class="w-14 h-14 rounded-full border-2 border-[var(--accent-primary)] flex items-center justify-center text-[var(--accent-primary)] font-cinzel text-[8px] font-black uppercase text-center shadow-xs">
                    OFFICIAL<br>MAITRI<br>SEAL
                </div>
                <span class="text-[9px] uppercase font-bold text-[var(--accent-primary)] tracking-widest mt-1">Verified Union</span>
            </div>

            <div>
                <div class="h-10 border-b border-[var(--border-strong)] flex items-end justify-center pb-1">
                    <span class="font-script text-xl text-[var(--text-primary)]">{{ $marriage->bride->name }}</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-[var(--text-muted)] tracking-wider block mt-1">Bride Signature</span>
            </div>
        </div>

        <!-- Certificate Footer -->
        <div class="text-center pt-2 relative">
            <p class="text-[9px] font-mono text-[var(--text-muted)]">
                Certificate ID: GM-{{ strtoupper(substr(md5($marriage->id . '-' . $marriage->created_at), 0, 10)) }} &bull; Global Maitri Buddhist Matrimonial Platform &bull; www.globalmaitri.com
            </p>
        </div>

    </div>

</body>
</html>
