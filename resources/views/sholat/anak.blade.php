@php
    $anak = config('sholat_anak') ?? [];
    $dewasa = config('sholat_dewasa') ?? [];

    $daftarGerakan = collect($anak)->map(function($item, $index) use ($dewasa) {
        $nama = $item['nama'] ?? ($dewasa[$index]['nama'] ?? '');
        $fotoPath = $item['foto'] ?? '';

        if (str_contains(strtolower($nama), 'tasyahud') || str_contains(strtolower($nama), 'tahiyat')) {
            $fotoPath = 'images/anak/dudukduasujud.jpeg';
        }

        return (object)[
            'urutan' => $item['urutan'] ?? ($index + 1),
            'nama' => $nama,
            'audio_url' => $item['audio_url'] ?? null,
            'video_url' => $item['video_url'] ?? null,
            'foto' => $fotoPath,
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
    <title>Yuk Belajar Sholat Anak - HPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri&family=Fredoka:wght@400;500;600;700&display=swap');
        .font-arabic { font-family: 'Amiri', serif; }
        .font-kids { font-family: 'Fredoka', sans-serif; }
        .stars-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(245,158,11,0.25) 1.5px, transparent 0);
            background-size: 26px 26px;
        }
        /* Mobile drawer transition */
        #mobileSidebarDrawer { transition: transform .3s ease; }
        #mobileSidebarOverlay { transition: opacity .3s ease; }
    </style>
</head>
<body class="bg-amber-50/50 font-kids text-gray-800">

    @include('partials.navbar', ['active' => 'anak'])

    <div class="relative border-b border-amber-100 bg-gradient-to-b from-amber-100/60 to-transparent overflow-hidden">
        <div class="absolute inset-0 stars-pattern opacity-70"></div>
        <header class="relative max-w-3xl mx-auto px-4 pt-10 pb-8 text-center">
            <span class="inline-flex items-center gap-1.5 bg-amber-400 text-white text-[11px] font-bold px-3 py-1 rounded-full mb-3 shadow-sm">
                🧒 Mode Anak-Anak
            </span>
            <h1 class="text-3xl lg:text-4xl font-bold text-amber-600 mb-2 tracking-wide">✨ Yuk, Belajar Sholat Bersama! ✨</h1>
            <p class="text-gray-600 text-lg">Panduan tata cara sholat HPT yang mudah dipahami anak pintar</p>
        </header>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8 lg:flex lg:items-start lg:gap-8">

        {{-- ======================= SIDEBAR (DESKTOP) ======================= --}}
        <aside class="hidden lg:block lg:w-72 lg:flex-shrink-0 lg:sticky lg:top-6 lg:self-start">
            <div class="bg-white rounded-3xl border border-amber-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-amber-100">
                    <h3 class="font-bold text-gray-900 leading-tight">Panduan Sholat</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $daftarGerakan->count() }} Rukun Sholat</p>
                </div>
                <nav class="max-h-[65vh] overflow-y-auto py-1">
                    @foreach($daftarGerakan as $loopIndex => $gerakan)
                        <button type="button"
                            data-scroll-target="{{ $loopIndex }}"
                            data-sidebar-item
                            class="sidebar-item w-full flex items-center gap-3 px-5 py-2.5 text-left text-sm border-l-4 border-transparent hover:bg-amber-50 transition {{ $loopIndex === 0 ? 'is-active bg-amber-50 border-amber-400 text-amber-700 font-semibold' : 'text-gray-600' }}">
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
                <div class="mb-8 rounded-3xl bg-white border border-amber-100 shadow-sm p-4 sm:p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600">🎬</span>
                        <h3 class="text-lg font-bold text-amber-700">Video Gerakan Sholat</h3>
                    </div>

                    @if(str_contains($videoGerakan->video_url, 'youtube.com') || str_contains($videoGerakan->video_url, 'youtu.be'))
                        @php
                            parse_str(parse_url($videoGerakan->video_url, PHP_URL_QUERY), $url_vars);
                            $youtube_id = $url_vars['v'] ?? '';
                            if(empty($youtube_id)) {
                                $path = explode('/', parse_url($videoGerakan->video_url, PHP_URL_PATH));
                                $youtube_id = end($path);
                            }
                        @endphp
                        <div class="w-full aspect-video bg-gray-900 rounded-xl overflow-hidden shadow-inner">
                            <iframe class="w-full h-full object-cover"
                                    src="https://www.youtube.com/embed/{{ $youtube_id }}"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    @else
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
                    <div id="gerakan-{{ $loopIndex }}" data-gerakan-section class="bg-white rounded-3xl shadow-sm border border-amber-100 p-6 gerakan-card scroll-mt-24">

                        <div class="flex items-center gap-4 mb-4">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 font-bold text-sm">
                                {{ $gerakan->urutan }}
                            </span>
                            <h2 class="text-xl font-bold text-gray-900">{{ $gerakan->nama }}</h2>
                        </div>

                        <div class="w-full aspect-video bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center mb-5 relative shadow-inner">
                            <img src="{{ asset($gerakan->foto) }}" alt="{{ $gerakan->nama }}" class="w-full h-full object-contain">
                        </div>

                        <audio class="gerakan-audio" src="{{ $gerakan->audio_url ? asset($gerakan->audio_url) : '#' }}" preload="none"></audio>

                        @if($gerakan->audio_url)
                            <button class="audio-btn w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 mb-6 shadow-sm" onclick="toggleAudio(this)">
                                <span>▶ Putar Audio Bacaan</span>
                            </button>
                        @endif

                        <div class="text-emerald-900 text-base font-medium leading-relaxed mb-6 bg-amber-50/40 p-4 rounded-lg border-l-4 border-amber-400">
                            <p>{{ $gerakan->deskripsi }}</p>
                        </div>

                        @if(count($gerakan->bacaan) > 0)
                            <div class="space-y-6">
                                @foreach($gerakan->bacaan as $index => $bacaan)
                                    <div class="border-t border-gray-100 pt-4">
                                        @if($bacaan->teks_arab)
                                        <div class="text-right font-arabic text-2xl lg:text-3xl leading-loose text-gray-900 mb-3" dir="rtl">
                                            {{ $bacaan->teks_arab }}
                                        </div>
                                        @endif

                                        @if($bacaan->teks_latin)
                                        <div class="italic text-amber-700 text-sm mb-2 font-semibold tracking-wide">
                                            "{{ $bacaan->teks_latin }}"
                                        </div>
                                        @endif

                                        <div class="text-gray-600 text-sm mb-2">
                                            <span class="font-bold text-xs text-gray-400 block uppercase tracking-wider mb-0.5">Artinya:</span>
                                            <div class="text-base text-gray-800 font-medium bg-amber-50 p-2.5 rounded-lg border border-amber-200/60 shadow-sm">
                                                <p>{{ $bacaan->terjemahan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="flex justify-between items-center gap-4 mt-8 pt-4 border-t border-gray-100">
                            @if(!$loop->first)
                                <button type="button" data-scroll-target="{{ $loopIndex - 1 }}" class="nav-btn flex items-center gap-1.5 text-sm font-semibold text-gray-600 hover:text-amber-600 transition bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-xl">
                                    ← Sebelumnya
                                </button>
                            @else
                                <div></div>
                            @endif

                            @if(!$loop->last)
                                <button type="button" data-scroll-target="{{ $loopIndex + 1 }}" class="nav-btn flex items-center gap-1.5 text-sm font-semibold text-white bg-amber-500 hover:bg-amber-600 transition px-5 py-2.5 rounded-xl shadow-sm">
                                    Selanjutnya →
                                </button>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="/" class="inline-flex items-center gap-1.5 text-sm font-bold text-amber-600 hover:text-amber-800 bg-amber-100 hover:bg-amber-200 px-5 py-2.5 rounded-xl transition">
                    🏠 Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    {{-- ======================= TOMBOL EXTEND / FAB (MOBILE) ======================= --}}
    <button id="openSidebarMobile" type="button"
        class="lg:hidden fixed bottom-5 right-5 z-40 flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold pl-4 pr-5 py-3 rounded-full shadow-lg shadow-amber-500/30 transition active:scale-95">
        <span class="text-lg leading-none">☰</span>
        <span class="text-sm">Daftar Gerakan</span>
    </button>

    {{-- Overlay backdrop --}}
    <div id="mobileSidebarOverlay" class="lg:hidden fixed inset-0 bg-black/40 z-50 opacity-0 pointer-events-none"></div>

    {{-- Drawer sidebar (mobile) --}}
    <div id="mobileSidebarDrawer"
        class="lg:hidden fixed top-0 right-0 h-full w-[80%] max-w-xs bg-white z-50 shadow-2xl flex flex-col"
        style="transform: translateX(100%);">
        <div class="flex items-center justify-between px-5 py-4 border-b border-amber-100 flex-shrink-0">
            <div>
                <h3 class="font-bold text-gray-900 leading-tight">Panduan Sholat</h3>
                <p class="text-xs text-gray-400 mt-0.5">{{ $daftarGerakan->count() }} Rukun Sholat</p>
            </div>
            <button id="closeSidebarMobile" type="button" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-amber-50 text-gray-500 text-lg">✕</button>
        </div>
        <nav class="flex-1 overflow-y-auto py-1">
            @foreach($daftarGerakan as $loopIndex => $gerakan)
                <button type="button"
                    data-scroll-target="{{ $loopIndex }}"
                    data-sidebar-item
                    data-close-mobile
                    class="sidebar-item w-full flex items-center gap-3 px-5 py-3 text-left text-sm border-l-4 border-transparent hover:bg-amber-50 transition {{ $loopIndex === 0 ? 'is-active bg-amber-50 border-amber-400 text-amber-700 font-semibold' : 'text-gray-600' }}">
                    <span class="text-xs font-bold text-gray-400 w-5 flex-shrink-0">{{ str_pad($loopIndex + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="flex-1 truncate">{{ $gerakan->nama }}</span>
                </button>
            @endforeach
        </nav>
    </div>

    <footer class="bg-amber-900 text-amber-200 text-center py-6 text-xs mt-12">
        &copy; {{ date('Y') }} SIM-IMO Project. Terverifikasi sesuai Sunnah &amp; HPT. ✨
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
                button.classList.add('bg-amber-500', 'hover:bg-amber-600');
                button.querySelector('span').innerText = "▶ Putar Audio Bacaan";
            } else {
                allAudios.forEach(audio => { if (audio !== currentAudio) { audio.pause(); audio.currentTime = 0; } });
                allButtons.forEach(btn => {
                    btn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                    btn.classList.add('bg-amber-500', 'hover:bg-amber-600');
                    btn.querySelector('span').innerText = "▶ Putar Audio Bacaan";
                });

                currentAudio.play().catch(e => console.log(e));
                button.classList.remove('bg-amber-500', 'hover:bg-amber-600');
                button.classList.add('bg-rose-600', 'hover:bg-rose-700');
                button.querySelector('span').innerText = "⏸ Jeda Audio Bacaan";
            }
            currentAudio.onended = () => {
                button.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                button.classList.add('bg-amber-500', 'hover:bg-amber-600');
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
                item.classList.toggle('bg-amber-50', isTarget);
                item.classList.toggle('border-amber-400', isTarget);
                item.classList.toggle('text-amber-700', isTarget);
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