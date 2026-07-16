@php
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

            <!-- Progress dots -->
            <div class="flex items-center justify-center flex-wrap gap-1.5 mt-6">
                @foreach($daftarGerakan as $loopIndex => $gerakan)
                    <button type="button" data-scroll-target="{{ $loopIndex }}" title="{{ $gerakan->nama }}"
                        class="nav-btn w-6 h-6 rounded-full bg-white border border-emerald-200 text-emerald-600 text-[10px] font-bold flex items-center justify-center hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition">
                        {{ $loopIndex + 1 }}
                    </button>
                @endforeach
            </div>
        </header>
    </div>

    <div class="max-w-3xl mx-auto px-4 py-8">

        <div class="space-y-8">
            @foreach($daftarGerakan as $loopIndex => $gerakan)
                <div id="gerakan-{{ $loopIndex }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 gerakan-card scroll-mt-24">
                    
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-sm">
                                {{ $gerakan->urutan }}
                            </span>
                            <h2 class="text-xl font-bold text-gray-900">{{ $gerakan->nama }}</h2>
                        </div>

                        <!-- Navigasi Beralih Foto / Video -->
                        <div class="bg-gray-100 p-1 rounded-xl flex items-center gap-1">
                            <button type="button" onclick="switchMedia('{{ $loopIndex }}', 'photo')" class="btn-foto-{{ $loopIndex }} px-3 py-1.5 rounded-lg text-xs font-bold bg-white text-emerald-700 shadow-sm transition">
                                📷 Foto
                            </button>
                            <button type="button" onclick="switchMedia('{{ $loopIndex }}', 'video')" class="btn-video-{{ $loopIndex }} px-3 py-1.5 rounded-lg text-xs font-bold text-gray-500 hover:text-gray-900 transition">
                                🎥 Video
                            </button>
                        </div>
                    </div>

                    <!-- Container Media (Foto atau Video) -->
                    <div class="w-full aspect-video bg-white rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center mb-5 relative shadow-inner p-2">
                        <!-- Elemen Foto -->
                        <div id="photo-container-{{ $loopIndex }}" class="w-full h-full flex items-center justify-center">
                            <img src="{{ asset($gerakan->foto) }}" alt="{{ $gerakan->nama }}" class="w-full h-full object-contain">
                        </div>

                        <!-- Elemen Video -->
                        <div id="video-container-{{ $loopIndex }}" class="w-full h-full hidden bg-gray-900 rounded-lg flex items-center justify-center relative">
                            @if($gerakan->video_url)
                                <video id="video-player-{{ $loopIndex }}" class="w-full h-full object-contain" controls preload="none">
                                    <source src="{{ asset($gerakan->video_url) }}" type="video/quicktime">
                                    <source src="{{ asset($gerakan->video_url) }}" type="video/mp4">
                                    Browser kamu tidak mendukung pemutaran video ini.
                                </video>
                            @else
                                <div class="text-center text-gray-400 text-sm">
                                    🎥 Video tutorial belum tersedia
                                </div>
                            @endif
                        </div>
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

    <footer class="bg-gray-900 text-gray-400 text-center py-6 text-xs mt-12">
        &copy; {{ date('Y') }} SIM-IMO Project. Terverifikasi sesuai Sunnah &amp; HPT.
    </footer>

    <script>
        // Fungsi beralih tampilan Foto / Video secara dinamis
        function switchMedia(index, mediaType) {
            const photoContainer = document.getElementById(`photo-container-${index}`);
            const videoContainer = document.getElementById(`video-container-${index}`);
            const videoPlayer = document.getElementById(`video-player-${index}`);
            const btnFoto = document.querySelector(`.btn-foto-${index}`);
            const btnVideo = document.querySelector(`.btn-video-${index}`);

            if (mediaType === 'video') {
                photoContainer.classList.add('hidden');
                videoContainer.classList.remove('hidden');

                // Update styling tombol dengan warna emerald
                btnVideo.classList.add('bg-white', 'text-emerald-700', 'shadow-sm');
                btnVideo.classList.remove('text-gray-500', 'hover:text-gray-900');
                btnFoto.classList.remove('bg-white', 'text-emerald-700', 'shadow-sm');
                btnFoto.classList.add('text-gray-500', 'hover:text-gray-900');

                // Putar otomatis jika elemen video tersedia
                if (videoPlayer) videoPlayer.play().catch(e => console.log('Autoplay ditangguhkan:', e));
            } else {
                photoContainer.classList.remove('hidden');
                videoContainer.classList.add('hidden');

                btnFoto.classList.add('bg-white', 'text-emerald-700', 'shadow-sm');
                btnFoto.classList.remove('text-gray-500', 'hover:text-gray-900');
                btnVideo.classList.remove('bg-white', 'text-emerald-700', 'shadow-sm');
                btnVideo.classList.add('text-gray-500', 'hover:text-gray-900');

                // Hentikan video jika elemen video tersedia
                if (videoPlayer) {
                    videoPlayer.pause();
                    videoPlayer.currentTime = 0;
                }
            }
        }

        function scrollToCard(index) {
            const targetCard = document.getElementById(`gerakan-${index}`);
            if (targetCard) targetCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        document.addEventListener('click', function(event) {
            const button = event.target.closest('[data-scroll-target]');
            if (!button) return;
            scrollToCard(button.getAttribute('data-scroll-target'));
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
    </script>
</body>
</html>