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
            .certificate-container { border: 8px double #d97706 !important; box-shadow: none !important; margin: 0 auto !important; width: 100% !important; max-width: 100% !important; padding: 32px !important; }
            @page { size: A4 landscape; margin: 10mm; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 antialiased min-h-screen py-10 flex flex-col items-center">

    <!-- Action Toolbar (hidden on print) -->
    <div class="no-print w-full max-w-4xl mx-auto mb-6 px-4 flex items-center justify-between">
        <a href="{{ route('marriages.celebration') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white text-slate-700 text-xs font-bold border border-slate-200 shadow-xs hover:bg-slate-50 transition">
            &larr; Return to Celebration
        </a>

        <div class="flex items-center gap-2">
            <span class="text-xs text-slate-500 font-medium">Digital Blessing Certificate</span>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs shadow-md transition cursor-pointer">
                <span>🖨️</span> Print / Save as PDF
            </button>
        </div>
    </div>

    <!-- Printable Certificate Container -->
    <div class="certificate-container w-full max-w-4xl bg-gradient-to-br from-amber-50/40 via-white to-rose-50/30 rounded-3xl border-8 border-double border-amber-600/70 p-10 sm:p-14 shadow-2xl space-y-8 text-center relative overflow-hidden">

        <!-- Subtle Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none select-none">
            <svg class="w-96 h-96 text-amber-900" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C10.5 4.5 9 7.5 9 10c0 2 1.5 3.5 3 4 1.5-.5 3-2 3-4 0-2.5-1.5-5.5-3-8zm-5 7c-1.5 0-3 1.5-3 3.5 0 2 1.5 4 4 4.5.5-1.5 1-3 1-4.5 0-1.5-.5-2.5-2-3.5zm10 0c-1.5 1-2 2-2 3.5 0 1.5.5 3 1 4.5 2.5-.5 4-2.5 4-4.5 0-2-1.5-3.5-3-3.5zm-8 9c-2 0-4 1-5 2.5 1.5.5 3.5 1 5 1 1 0 2-.5 3-1.5-.5-1-1.5-1.8-3-2zm6 0c-1.5.2-2.5 1-3 2 1 1 2 1.5 3 1.5 1.5 0 3.5-.5 5-1-1-1.5-3-2.5-5-2.5z"/>
            </svg>
        </div>

        <!-- Certificate Header -->
        <div class="space-y-2 relative">
            <div class="w-16 h-16 mx-auto rounded-2xl bg-amber-500/10 border-2 border-amber-500/40 flex items-center justify-center text-3xl shadow-xs">
                🪷
            </div>

            <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-amber-800 font-bold pt-2">
                Global Maitri Buddhist Matrimony
            </p>

            <h1 class="font-cinzel text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-wide uppercase pt-1">
                Mangala Vivaha Blessing Certificate
            </h1>

            <div class="w-32 h-0.5 bg-gradient-to-r from-transparent via-amber-500 to-transparent mx-auto mt-2"></div>
        </div>

        <!-- Pali Mangala Blessing Verse -->
        <div class="max-w-2xl mx-auto space-y-1 relative">
            <p class="font-cinzel text-xs sm:text-sm text-amber-900 font-semibold italic">
                &ldquo;Asevanā ca bālānaṁ, paṇḍitānañca sevanā, pūjā ca pūjanīyānaṁ — etaṁ maṅgalamuttamaṁ&rdquo;
            </p>
            <p class="text-[11px] text-slate-500 italic">
                Not consorting with the unwise, associating with the wise, honoring those worthy of honor — this is the supreme blessing.
            </p>
        </div>

        <!-- Certification Body -->
        <div class="space-y-6 relative max-w-2xl mx-auto py-2">
            <p class="text-xs sm:text-sm text-slate-600 uppercase tracking-widest font-semibold">
                This certifies the auspicious union and lifelong partnership of
            </p>

            <!-- Couple Names in Elegant Display -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 py-2">
                <div class="text-center">
                    <span class="font-cinzel text-xl sm:text-2xl font-bold text-slate-900 block">
                        {{ $marriage->groom->name }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider text-amber-800 font-bold">Groom</span>
                </div>

                <div class="font-script text-3xl sm:text-4xl text-amber-600 font-bold">
                    &amp;
                </div>

                <div class="text-center">
                    <span class="font-cinzel text-xl sm:text-2xl font-bold text-slate-900 block">
                        {{ $marriage->bride->name }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider text-amber-800 font-bold">Bride</span>
                </div>
            </div>

            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed max-w-xl mx-auto">
                Solemnized on
                <strong>{{ $marriage->marriage_date ? $marriage->marriage_date->format('jS \of F, Y') : ($marriage->confirmed_at ? $marriage->confirmed_at->format('jS \of F, Y') : now()->format('jS \of F, Y')) }}</strong>
                in the spirit of loving-kindness (<em>Metta</em>), mutual reverence, non-attachment, and harmonious companionship.
            </p>

            <!-- Metta Wish Box -->
            <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-950 font-serif text-sm max-w-lg mx-auto">
                &ldquo;Sabbe satta bhavantu sukhitatta &bull; May you be happy and well &bull; Sadhu Sadhu Sadhu&rdquo;
            </div>
        </div>

        <!-- Signatures & Seal Section -->
        <div class="grid grid-cols-3 gap-6 pt-6 border-t border-amber-600/20 max-w-2xl mx-auto text-center relative">
            <div>
                <div class="h-10 border-b border-slate-400 flex items-end justify-center pb-1">
                    <span class="font-script text-xl text-slate-800">{{ $marriage->groom->name }}</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block mt-1">Groom Signature</span>
            </div>

            <div class="flex flex-col items-center justify-center">
                <div class="w-14 h-14 rounded-full border-2 border-amber-500 flex items-center justify-center text-amber-600 font-cinzel text-[8px] font-black uppercase text-center shadow-xs">
                    OFFICIAL<br>MAITRI<br>SEAL
                </div>
                <span class="text-[9px] uppercase font-bold text-amber-800 tracking-widest mt-1">Verified Union</span>
            </div>

            <div>
                <div class="h-10 border-b border-slate-400 flex items-end justify-center pb-1">
                    <span class="font-script text-xl text-slate-800">{{ $marriage->bride->name }}</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block mt-1">Bride Signature</span>
            </div>
        </div>

        <!-- Certificate Footer -->
        <div class="text-center pt-2 relative">
            <p class="text-[9px] font-mono text-slate-400">
                Certificate ID: GM-{{ strtoupper(substr(md5($marriage->id . '-' . $marriage->created_at), 0, 10)) }} &bull; Global Maitri Buddhist Matrimonial Platform &bull; www.globalmaitri.com
            </p>
        </div>

    </div>

</body>
</html>
