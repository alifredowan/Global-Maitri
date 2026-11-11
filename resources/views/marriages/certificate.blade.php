<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangala Vivaha Certificate — {{ $marriage->groom->name }} & {{ $marriage->bride->name }} | Global Maitri</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400;1,600&family=DM+Sans:wght@400;500;600&family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Great+Vibes&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-heading { font-family: 'Fraunces', Georgia, serif; }
        .font-script { font-family: 'Great Vibes', cursive; }

        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .certificate-container { border: 6px double var(--color-accent) !important; box-shadow: none !important; margin: 0 auto !important; width: 100% !important; max-width: 100% !important; padding: 28px !important; }
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
            <button onclick="window.print()" class="btn-primary inline-flex items-center gap-2 text-xs py-2 px-5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Print / Save as PDF</span>
            </button>
        </div>
    </div>

    <!-- Printable Certificate Container -->
    <div class="certificate-container w-full max-w-4xl bg-white rounded-[4px] border-8 border-double border-[var(--saffron-gold)]/60 p-10 sm:p-14 shadow-lg space-y-8 text-center relative overflow-hidden">

        <!-- Certificate Header -->
        <div class="space-y-2 relative">
            <div class="w-16 h-16 mx-auto rounded-full bg-white border border-[var(--saffron-gold)]/50 flex items-center justify-center p-2.5 shadow-xs text-[var(--saffron-gold)]">
                <svg class="w-9 h-9" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M32 10 C32 10, 24 24, 24 38 C24 46, 28 52, 32 54 C36 52, 40 46, 40 38 C40 24, 32 10, 32 10 Z" fill="currentColor" fill-opacity="0.15" />
                    <path d="M32 20 C24 24, 15 32, 16 42 C17 48, 23 52, 30 53" />
                    <path d="M32 20 C40 24, 49 32, 48 42 C47 48, 41 52, 34 53" />
                </svg>
            </div>

            <p class="font-mono text-[11px] uppercase tracking-[0.25em] text-[var(--saffron-gold)] font-semibold pt-1">
                Global Maitri Buddhist Matrimony
            </p>

            <h1 class="font-heading text-2xl sm:text-4xl font-bold text-[var(--color-text)] tracking-wide uppercase pt-1">
                Mangala Vivaha Blessing Certificate
            </h1>

            <div class="w-24 h-px bg-[var(--saffron-gold)] mx-auto mt-2"></div>
        </div>

        <!-- Pali Mangala Blessing Verse -->
        <div class="max-w-2xl mx-auto space-y-1 relative">
            <p class="font-cormorant text-sm sm:text-base text-[var(--saffron-gold)] font-semibold italic">
                &ldquo;Asevanā ca bālānaṁ, paṇḍitānañca sevanā, pūjā ca pūjanīyānaṁ — etaṁ maṅgalamuttamaṁ&rdquo;
            </p>
            <p class="text-[11px] text-[var(--text-secondary)] italic">
                Not consorting with the unwise, associating with the wise, honoring those worthy of honor — this is the supreme blessing.
            </p>
        </div>

        <!-- Certification Body -->
        <div class="space-y-6 relative max-w-2xl mx-auto py-2">
            <p class="text-xs text-[var(--text-secondary)] uppercase tracking-widest font-mono">
                This certifies the auspicious union and lifelong partnership of
            </p>

            <!-- Couple Names in Elegant Display -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 py-2">
                <div class="text-center">
                    <span class="font-cormorant text-2xl sm:text-3xl font-bold text-[var(--color-text)] block">
                        {{ $marriage->groom->name }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider text-[var(--saffron-gold)] font-mono font-medium">Groom</span>
                </div>

                <div class="font-script text-3xl sm:text-4xl text-[var(--lotus-pink)]">
                    &amp;
                </div>

                <div class="text-center">
                    <span class="font-cormorant text-2xl sm:text-3xl font-bold text-[var(--color-text)] block">
                        {{ $marriage->bride->name }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider text-[var(--saffron-gold)] font-mono font-medium">Bride</span>
                </div>
            </div>

            <p class="text-xs sm:text-sm text-[var(--color-text)] leading-relaxed max-w-xl mx-auto">
                Solemnized on
                <strong>{{ $marriage->marriage_date ? $marriage->marriage_date->format('jS \of F, Y') : ($marriage->confirmed_at ? $marriage->confirmed_at->format('jS \of F, Y') : now()->format('jS \of F, Y')) }}</strong>
                in the spirit of loving-kindness (<em>Metta</em>), mutual reverence, mindful balance, and harmonious companionship.
            </p>

            <!-- Metta Wish Box -->
            <div class="p-3.5 rounded-[3px] bg-[var(--bg-canvas)] border border-[var(--saffron-gold)]/30 text-[var(--saffron-gold)] font-cormorant text-base max-w-lg mx-auto font-medium">
                &ldquo;Sabbe satta bhavantu sukhitatta &bull; May you be happy and well &bull; Sadhu Sadhu Sadhu&rdquo;
            </div>
        </div>

        <!-- Signatures & Seal Section -->
        <div class="grid grid-cols-3 gap-6 pt-6 border-t border-[var(--color-border)] max-w-2xl mx-auto text-center relative">
            <div>
                <div class="h-10 border-b border-[var(--color-text)]/30 flex items-end justify-center pb-1">
                    <span class="font-script text-xl text-[var(--color-text)]">{{ $marriage->groom->name }}</span>
                </div>
                <span class="text-[10px] uppercase font-mono text-[var(--text-muted)] tracking-wider block mt-1">Groom Signature</span>
            </div>

            <div class="flex flex-col items-center justify-center">
                <div class="w-14 h-14 rounded-full border-2 border-[var(--saffron-gold)] flex items-center justify-center text-[var(--saffron-gold)] font-mono text-[8px] font-bold uppercase text-center shadow-xs">
                    OFFICIAL<br>MAITRI<br>SEAL
                </div>
                <span class="text-[9px] uppercase font-mono font-medium text-[var(--saffron-gold)] tracking-widest mt-1">Verified Union</span>
            </div>

            <div>
                <div class="h-10 border-b border-[var(--color-text)]/30 flex items-end justify-center pb-1">
                    <span class="font-script text-xl text-[var(--color-text)]">{{ $marriage->bride->name }}</span>
                </div>
                <span class="text-[10px] uppercase font-mono text-[var(--text-muted)] tracking-wider block mt-1">Bride Signature</span>
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

