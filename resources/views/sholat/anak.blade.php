@php
    $anak = config('sholat_anak') ?? [];
    $dewasa = config('sholat_dewasa') ?? [];

    $daftarGerakan = collect($anak)->map(function($item, $index) use ($dewasa) {
        // Mengambil nama gerakan dari config dewasa berdasarkan index yang sama
        $namaDewasa = $dewasa[$index]['nama'] ?? ($item['nama'] ?? '');

        return (object)[
            'urutan' => $item['urutan'] ?? ($index + 1),
            'nama' => $namaDewasa, // Nama otomatis disamakan dengan mode dewasa
            'audio_url' => $item['audio_url'] ?? null,
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
    <title>Yuk Belajar Sholat Anak - HPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri&family=Fredoka:wght@400;600;700&display=swap');
        .font-arabic { font-family: 'Amiri', serif; }
        .font-kids { font-family: 'Fredoka', sans-serif; }
    </style>
</head>
<body class="bg-amber-50/50 font-kids text-gray-800">

    <div class="max-w-3xl mx-auto px-4 py-8">
        
        <div class="flex justify-center mb-8">
            <div class="bg-white border border-gray-200 p-1.5 rounded-2xl shadow-sm flex items-center gap-1">
                <a href="/sholat/dewasa" class="px-4 py-2 rounded-xl text-sm font-bold text-gray-500 hover:text-gray-900">
                    👨‍💼 Mode Dewasa
                </a>
                <a href="/sholat/anak" class="px-4 py-2 rounded-xl text-sm font-bold bg-amber-500 text-white shadow-sm">
                    🧒 Mode Anak-Anak
                </a>
            </div>
        </div>

        <header class="text-center mb-12">
            <h1 class="text-3xl lg:text-4xl font-bold text-amber-600 mb-2 tracking-wide">✨ Yuk, Belajar Sholat Bersama! ✨</h1>
            <p class="text-gray-600 text-lg">Panduan tata cara sholat HPT yang mudah dipahami anak pintar</p>
        </header>

        <div class="space-y-8">
            @foreach($daftarGerakan as $loopIndex => $gerakan)
                <div id="gerakan-{{ $loopIndex }}" class="bg-white rounded-3xl shadow-sm border border-amber-100 p-6 gerakan-card scroll-mt-6">
                    
                    <div class="flex items-center gap-4 mb-4">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 font-bold text-sm">
                            {{ $gerakan->urutan }}
                        </span>
                        <h2 class="text-xl font-bold text-gray-900">{{ $gerakan->nama }}</h2>
                    </div>

                    <div class="w-full aspect-video bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center mb-5 relative shadow-inner">
                        <img src="{{ asset($gerakan->foto) }}" alt="{{ $gerakan->nama }}" class="w-full h-full object-cover">
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
    </div>

    <script>
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
    </script>
</body>
</html>