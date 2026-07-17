@php
    function getYoutubeId($url) {
        if (!$url) return null;
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }
    $dewasa = config('sholat_dewasa') ?? [];
    $daftarGerakan = collect($dewasa)->map(function($item, $index) {
        return (object)[
            'urutan' => $item['urutan'] ?? ($index + 1),
            'nama' => $item['nama'] ?? '',
            'audio_url' => $item['audio_url'] ?? null,
            'video_url' => $item['video_url'] ?? null, // Dipersiapkan untuk data video nanti
            'foto' => $item['foto'] ?? '',
            'deskripsi' => $item['deskripsi'] ?? '',
            'bacaan' => collect($item['bacaan'] ?? [])->map(function($b) {
                return (object)[
                    'teks_arab' => $b['teks_arab'] ?? '',
                    'teks_latin' => $b['teks_latin'] ?? '',
                    'terjemahan' => $b['terjemahan'] ?? '',
                    'sumber' => $b['sumber'] ?? ''
                ];
            })
        ];
    });
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuntunan Sholat Dewasa - HPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        .font-arabic { font-family: 'Amiri', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
        .islamic-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(16,185,129,0.15) 1px, transparent 0);
            background-size: 22px 22px;
        }
        /* Mobile drawer transition */
        #mobileSidebarDrawer { transition: transform .3s ease; }
        #mobileSidebarDrawer.open { transform: translateX(0) !important; }
        #mobileSidebarOverlay { transition: opacity .3s ease; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    @include('partials.navbar', ['active' => 'dewasa'])

    <div class="relative border-b border-emerald-100 bg-gradient-to-b from-emerald-50 to-transparent overflow-hidden">
        <div class="absolute inset-0 islamic-pattern opacity-70"></div>
        <header class="relative max-w-3xl mx-auto px-4 pt-10 pb-8 text-center">
            <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-700 text-[11px] font-bold px-3 py-1 rounded-full mb-3">
                👨‍💼 Mode Dewasa
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-emerald-800 mb-2">Tuntunan Sholat Sesuai HPT</h1>
            <p class="text-gray-600 max-w-xl mx-auto">Panduan gerakan dan bacaan sholat lengkap berdasarkan Himpunan Putusan Tarjih Muhammadiyah</p>
        </header>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8 lg:flex lg:items-start lg:gap-8">

        {{-- ======================= SIDEBAR (DESKTOP) ======================= --}}
        <aside class="hidden lg:block lg:w-72 lg:flex-shrink-0 lg:sticky lg:top-6 lg:self-start">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900 leading-tight">Panduan Sholat</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $daftarGerakan->count() }} Rukun Sholat</p>
                </div>
                <nav class="max-h-[65vh] overflow-y-auto py-1">
                    @foreach($daftarGerakan as $loopIndex => $gerakan)
                        <button type="button"
                            data-scroll-target="{{ $loopIndex }}"
                            data-sidebar-item
                            class="sidebar-item w-full flex items-center gap-3 px-5 py-2.5 text-left text-sm border-l-4 border-transparent hover:bg-emerald-50 transition {{ $loopIndex === 0 ? 'is-active bg-emerald-50 border-emerald-500 text-emerald-700 font-semibold' : 'text-gray-600' }}">
                            <span class="text-xs font-bold text-gray-400 w-5 flex-shrink-0">{{ str_pad($loopIndex + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="flex-1 truncate">{{ $gerakan->nama }}</span>
                        </button>
                    @endforeach
                </nav>
            </div>
        </aside>

        {{-- ======================= KONTEN UTAMA ======================= --}}
        <div class="flex-1 min-w-0 max-w-3xl mx-auto lg:mx-0">

            @php
                $videoGerakan = $daftarGerakan->first(function($gerakan) {
                    return !empty($gerakan->video_url);
                });
            @endphp

            @if($videoGerakan)
                <div class="mb-8 rounded-2xl bg-white border border-emerald-100 shadow-sm p-4 sm:p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700">🎬</span>
                        <h3 class="text-lg font-bold text-emerald-800">Video Gerakan Sholat</h3>
                    </div>

                    @php $ytId = getYoutubeId($videoGerakan->video_url); @endphp
                    @if($ytId)
                        <div class="w-full aspect-video bg-gray-900 rounded-xl overflow-hidden shadow-inner">
                            <iframe
                                class="w-full h-full"
                                src="https://www.youtube-nocookie.com/embed/{{ $ytId }}"
                                title="{{ $videoGerakan->nama }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @elseif($videoGerakan->video_url)
                        <div class="w-full aspect-video bg-gray-900 rounded-xl overflow-hidden shadow-inner">
                            <video class="w-full h-full object-contain" controls preload="none">
                                <source src="{{ asset($videoGerakan->video_url) }}" type="video/mp4">
                                Browser kamu tidak mendukung pemutaran video ini.
                            </video>
                        </div>
                    @endif
                </div>
            @endif

            <div class="space-y-8">
                @foreach($daftarGerakan as $loopIndex => $gerakan)
                    <div id="gerakan-{{ $loopIndex }}" data-gerakan-section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 gerakan-card scroll-mt-24">

                        <div class="flex items-center gap-4 mb-4">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-sm">
                                {{ $gerakan->urutan }}
                            </span>
                            <h2 class="text-xl font-bold text-gray-900">{{ $gerakan->nama }}</h2>
                        </div>

                        <!-- Foto gerakan -->
                        <div class="w-full aspect-video bg-white rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center mb-5 relative shadow-inner p-2">
                            <img src="{{ asset($gerakan->foto) }}" alt="{{ $gerakan->nama }}" class="w-full h-full object-contain">
                        </div>

                        <audio class="gerakan-audio" src="{{ $gerakan->audio_url ? asset($gerakan->audio_url) : '#' }}" preload="none"></audio>

                        @if($gerakan->audio_url)
                            <button class="audio-btn w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 mb-6" onclick="toggleAudio(this)">
                                <span>▶ Putar Audio Bacaan</span>
                            </button>
                        @endif

                        <div class="text-gray-600 text-sm leading-relaxed mb-6 bg-slate-50 p-4 rounded-lg border-l-4 border-emerald-500">
                            <p>{{ $gerakan->deskripsi }}</p>
                        </div>

                        @if(count($gerakan->bacaan) > 0)
                            <div class="space-y-6">
                                @foreach($gerakan->bacaan as $index => $bacaan)
                                    <div class="border-t border-gray-100 pt-4">
                                        <div class="text-right font-arabic text-2xl lg:text-3xl leading-loose text-gray-900 mb-3" dir="rtl">
                                            {{ $bacaan->teks_arab }}
                                        </div>

                                        <div class="italic text-emerald-700 text-sm mb-2 font-semibold tracking-wide">
                                            "{{ $bacaan->teks_latin }}"
                                        </div>

                                        <div class="text-gray-600 text-sm mb-2">
                                            <span class="font-bold text-xs text-gray-400 block uppercase tracking-wider mb-0.5">Artinya:</span>
                                            <p>{{ $bacaan->terjemahan }}</p>
                                        </div>

                                        @if($bacaan->sumber)
                                        <div class="text-xs text-gray-400 text-right mt-1">
                                            Sumber: {{ $bacaan->sumber }}
                                        </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex justify-between items-center gap-4 mt-8 pt-4 border-t border-gray-100">
                            @if(!$loop->first)
                                <button type="button" data-scroll-target="{{ $loopIndex - 1 }}" class="nav-btn flex items-center gap-1.5 text-sm font-semibold text-gray-600 hover:text-emerald-700 transition bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-xl">
                                    ← Sebelumnya
                                </button>
                            @else
                                <div></div>
                            @endif

                            @if(!$loop->last)
                                <button type="button" data-scroll-target="{{ $loopIndex + 1 }}" class="nav-btn flex items-center gap-1.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 transition px-5 py-2.5 rounded-xl">
                                    Selanjutnya →
                                </button>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-700 hover:text-emerald-900 bg-emerald-50 hover:bg-emerald-100 px-5 py-2.5 rounded-xl transition">
                    🏠 Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    {{-- ======================= TOMBOL EXTEND / FAB (MOBILE) ======================= --}}
    <button id="openSidebarMobile" type="button"
        class="lg:hidden fixed bottom-5 right-5 z-40 flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold pl-4 pr-5 py-3 rounded-full shadow-lg shadow-emerald-600/30 transition active:scale-95">
        <span class="text-lg leading-none">☰</span>
        <span class="text-sm">Daftar Gerakan</span>
    </button>

    {{-- Overlay backdrop --}}
    <div id="mobileSidebarOverlay" class="lg:hidden fixed inset-0 bg-black/40 z-50 opacity-0 pointer-events-none"></div>

    {{-- Drawer sidebar (mobile) --}}
    <div id="mobileSidebarDrawer"
        class="lg:hidden fixed top-0 right-0 h-full w-[80%] max-w-xs bg-white z-50 shadow-2xl flex flex-col"
        style="transform: translateX(100%);">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 flex-shrink-0">
            <div>
                <h3 class="font-bold text-gray-900 leading-tight">Panduan Sholat</h3>
                <p class="text-xs text-gray-400 mt-0.5">{{ $daftarGerakan->count() }} Rukun Sholat</p>
            </div>
            <button id="closeSidebarMobile" type="button" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 text-gray-500 text-lg">✕</button>
        </div>
        <nav class="flex-1 overflow-y-auto py-1">
            @foreach($daftarGerakan as $loopIndex => $gerakan)
                <button type="button"
                    data-scroll-target="{{ $loopIndex }}"
                    data-sidebar-item
                    data-close-mobile
                    class="sidebar-item w-full flex items-center gap-3 px-5 py-3 text-left text-sm border-l-4 border-transparent hover:bg-emerald-50 transition {{ $loopIndex === 0 ? 'is-active bg-emerald-50 border-emerald-500 text-emerald-700 font-semibold' : 'text-gray-600' }}">
                    <span class="text-xs font-bold text-gray-400 w-5 flex-shrink-0">{{ str_pad($loopIndex + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="flex-1 truncate">{{ $gerakan->nama }}</span>
                </button>
            @endforeach
        </nav>
    </div>

    <footer class="bg-gray-900 text-gray-400 text-center py-6 text-xs mt-12">
        &copy; {{ date('Y') }} SIM-IMO Project. Terverifikasi sesuai Sunnah &amp; HPT.
    </footer>

    <script>
        function scrollToCard(index) {
            const targetCard = document.getElementById(`gerakan-${index}`);
            if (targetCard) targetCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        document.addEventListener('click', function(event) {
            const button = event.target.closest('[data-scroll-target]');
            if (!button) return;
            scrollToCard(button.getAttribute('data-scroll-target'));
            if (button.hasAttribute('data-close-mobile')) closeMobileSidebar();
        });

        function toggleAudio(button) {
            const currentCard = button.closest('.gerakan-card');
            const currentAudio = currentCard.querySelector('.gerakan-audio');
            const allAudios = document.querySelectorAll('.gerakan-audio');
            const allButtons = document.querySelectorAll('.audio-btn');

            if (!currentAudio.paused) {
                currentAudio.pause();
                button.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                button.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                button.querySelector('span').innerText = "▶ Putar Audio Bacaan";
            } else {
                allAudios.forEach(audio => { if (audio !== currentAudio) { audio.pause(); audio.currentTime = 0; } });
                allButtons.forEach(btn => {
                    btn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                    btn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                    btn.querySelector('span').innerText = "▶ Putar Audio Bacaan";
                });

                currentAudio.play().catch(e => console.log(e));
                button.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                button.classList.add('bg-rose-600', 'hover:bg-rose-700');
                button.querySelector('span').innerText = "⏸ Jeda Audio Bacaan";
            }
            currentAudio.onended = () => {
                button.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                button.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                button.querySelector('span').innerText = "▶ Putar Audio Bacaan";
            };
        }

        // ===== Mobile drawer open/close =====
        const openBtn = document.getElementById('openSidebarMobile');
        const closeBtn = document.getElementById('closeSidebarMobile');
        const drawer = document.getElementById('mobileSidebarDrawer');
        const overlay = document.getElementById('mobileSidebarOverlay');

        function openMobileSidebar() {
            drawer.style.transform = 'translateX(0)';
            overlay.classList.remove('pointer-events-none');
            overlay.classList.add('opacity-100');
            overlay.style.opacity = '1';
            document.body.classList.add('overflow-hidden');
        }

        function closeMobileSidebar() {
            drawer.style.transform = 'translateX(100%)';
            overlay.classList.add('pointer-events-none');
            overlay.style.opacity = '0';
            document.body.classList.remove('overflow-hidden');
        }

        openBtn?.addEventListener('click', openMobileSidebar);
        closeBtn?.addEventListener('click', closeMobileSidebar);
        overlay?.addEventListener('click', closeMobileSidebar);

        // ===== Highlight sidebar item yang sedang aktif saat discroll =====
        const sections = document.querySelectorAll('[data-gerakan-section]');
        const sidebarItems = document.querySelectorAll('[data-sidebar-item]');

        function setActiveSidebar(index) {
            sidebarItems.forEach(item => {
                const isTarget = item.getAttribute('data-scroll-target') === String(index);
                item.classList.toggle('is-active', isTarget);
                item.classList.toggle('bg-emerald-50', isTarget);
                item.classList.toggle('border-emerald-500', isTarget);
                item.classList.toggle('text-emerald-700', isTarget);
                item.classList.toggle('font-semibold', isTarget);
                item.classList.toggle('text-gray-600', !isTarget);
            });
        }

        if ('IntersectionObserver' in window && sections.length) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const idx = entry.target.id.replace('gerakan-', '');
                        setActiveSidebar(idx);
                    }
                });
            }, { rootMargin: '-40% 0px -50% 0px', threshold: 0 });

            sections.forEach(section => observer.observe(section));
        }
    </script>
</body>
</html>