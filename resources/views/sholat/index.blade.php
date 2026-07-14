@php
    $dewasa = config('sholat_dewasa') ?? [];
    $anak = config('sholat_anak') ?? [];

    $daftarGerakan = collect($dewasa)->map(function($item, $index) use ($anak) {
        $itemAnak = $anak[$index] ?? [
            'foto' => '',
            'deskripsi' => '',
            'bacaan' => []
        ];
        
        return (object)[
            'urutan' => $item['urutan'] ?? ($index + 1),
            'nama' => $item['nama'] ?? '',
            'audio_url_dewasa' => $item['audio_url'] ?? null,
            'audio_url_anak' => $itemAnak['audio_url'] ?? null,
            'foto_dewasa' => $item['foto'] ?? '',
            'foto_anak' => $itemAnak['foto'] ?? '',
            'deskripsi_dewasa' => $item['deskripsi'] ?? '',
            'deskripsi_anak' => $itemAnak['deskripsi'] ?? '',
            'bacaan' => collect($item['bacaan'] ?? [])->map(function($b, $bIdx) use ($itemAnak) {
                return (object)[
                    'teks_arab' => $b['teks_arab'] ?? '',
                    'teks_latin' => $b['teks_latin'] ?? '',
                    'terjemahan_dewasa' => $b['terjemahan'] ?? '',
                    'terjemahan_anak' => $itemAnak['bacaan'][$bIdx]['terjemahan'] ?? '',
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
    <title>Panduan Sholat HPT Muhammadiyah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri&family=Plus+Jakarta+Sans:wght@400;600;700&family=Fredoka:wght@400;600;700&display=swap');
        .font-arabic { font-family: 'Amiri', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-kids { font-family: 'Fredoka', sans-serif; }
        .mode-transition { transition: all 0.5s ease-in-out; }
    </style>
</head>
<body id="mainBody" class="bg-gray-50 font-sans text-gray-800 mode-transition">

    <div class="max-w-3xl mx-auto px-4 py-8">
        
        <div class="flex justify-center mb-8">
            <div class="bg-white border border-gray-200 p-1.5 rounded-2xl shadow-sm flex items-center gap-1">
                <button onclick="setMode('dewasa')" id="btn-dewasa" class="px-4 py-2 rounded-xl text-sm font-bold transition duration-200 bg-emerald-600 text-white shadow-sm">
                    👨‍💼 Mode Dewasa
                </button>
                <button onclick="setMode('anak')" id="btn-anak" class="px-4 py-2 rounded-xl text-sm font-bold transition duration-200 text-gray-500 hover:text-gray-900">
                    🧒 Mode Anak-Anak
                </button>
            </div>
        </div>

        <header class="text-center mb-12">
            <h1 id="mainTitle" class="text-3xl font-bold text-emerald-700 mb-2 mode-transition">Tuntunan Sholat Sesuai HPT</h1>
            <p id="mainSubtitle" class="text-gray-600 mode-transition">Panduan gerakan dan bacaan sholat lengkap berdasarkan Himpunan Putusan Tarjih</p>
        </header>

        <div class="space-y-8">
            @foreach($daftarGerakan as $loopIndex => $gerakan)
                <div id="gerakan-{{ $loopIndex }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition-all duration-300 hover:shadow-md gerakan-card scroll-mt-6">
                    
                    <div class="flex items-center gap-4 mb-4">
                        <span id="badge-{{ $loopIndex }}" class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-sm mode-transition">
                            {{ $gerakan->urutan }}
                        </span>
                        <h2 class="text-xl font-bold text-gray-900">{{ $gerakan->nama }}</h2>
                    </div>

                    <div class="w-full h-72 sm:h-96 md:h-[450px] bg-gray-100 rounded-xl border border-gray-200 flex items-center justify-center mb-5 relative shadow-inner p-2 bg-slate-50">
    
                        <img id="img-dewasa-{{ $loopIndex }}" 
                            src="{{ $gerakan->foto_dewasa ? asset($gerakan->foto_dewasa) : asset('images/dewasa/takbir.png') }}" 
                            alt="Visualisasi Dewasa {{ $gerakan->nama }}" 
                            class="max-h-full max-w-full object-contain rounded-lg transition-all duration-300">

                        <img id="img-anak-{{ $loopIndex }}" 
                            src="{{ $gerakan->foto_anak ? asset($gerakan->foto_anak) : '#' }}" 
                            alt="Ilustrasi Anak {{ $gerakan->nama }}" 
                            class="max-h-full max-w-full object-contain hidden rounded-lg transition-all duration-300">

                    </div>

                    <!-- Menyimpan kedua URL audio di dalam data-attribute -->
                    <audio id="audio-element-{{ $loopIndex }}" class="gerakan-audio" 
                           src="{{ $gerakan->audio_url_dewasa ? asset($gerakan->audio_url_dewasa) : '#' }}" 
                           data-dewasa="{{ $gerakan->audio_url_dewasa ? asset($gerakan->audio_url_dewasa) : '#' }}" 
                           data-anak="{{ $gerakan->audio_url_anak ? asset($gerakan->audio_url_anak) : '#' }}" 
                           preload="none"></audio>
                    
                    @if($gerakan->audio_url_dewasa || $gerakan->audio_url_anak)
                        <button id="audio-btn-{{ $loopIndex }}" class="audio-btn w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 flex items-center justify-center gap-2 mb-6 shadow-sm active:scale-[0.99] {{ !$gerakan->audio_url_dewasa ? 'hidden' : '' }}" onclick="toggleAudio(this)">
                            <span>▶ Putar Audio Bacaan</span>
                        </button>
                    @endif

                    <div class="text-gray-600 text-sm leading-relaxed mb-6 bg-slate-50 p-4 rounded-lg border-l-4 border-emerald-500">
                        <p id="desc-dewasa-{{ $loopIndex }}">{{ $gerakan->deskripsi_dewasa }}</p>
                        <p id="desc-anak-{{ $loopIndex }}" class="hidden text-base text-emerald-900 font-medium">{{ $gerakan->deskripsi_anak }}</p>
                    </div>

                    @if($gerakan->bacaan->count() > 0)
                        <div class="space-y-6">
                            @foreach($gerakan->bacaan as $index => $bacaan)
                                <div class="border-t border-gray-100 pt-4">
                                    <div class="text-right font-arabic text-2xl lg:text-3xl leading-loose text-gray-900 mb-3" dir="rtl">
                                        {{ $bacaan->teks_arab }}
                                    </div>

                                    <div class="italic text-emerald-700 text-sm mb-2 font-semibold tracking-wide">
                                        trim "{{ $bacaan->teks_latin }}"
                                    </div>

                                    <div class="text-gray-600 text-sm mb-2">
                                        <span class="font-bold text-xs text-gray-400 block uppercase tracking-wider mb-0.5">Artinya:</span>
                                        <p id="trans-dewasa-{{ $loopIndex }}-{{ $index }}">{{ $bacaan->terjemahan_dewasa }}</p>
                                        <p id="trans-anak-{{ $loopIndex }}-{{ $index }}" class="hidden text-base text-gray-800 font-medium bg-amber-50 p-2.5 rounded-lg border border-amber-200/60">{{ $bacaan->terjemahan_anak }}</p>
                                    </div>

                                    <div id="source-{{ $loopIndex }}-{{ $index }}" class="text-xs text-gray-400 text-right mt-1">
                                        Sumber: {{ $bacaan->sumber }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex justify-between items-center gap-4 mt-8 pt-4 border-t border-gray-100">
                        @if(!$loop->first)
                            <button type="button" onclick="scrollToCard({{ $loopIndex - 1 }})" class="nav-prev flex items-center gap-1.5 text-sm font-semibold text-gray-600 hover:text-emerald-700 transition bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-xl active:scale-[0.98]">
                                ← Sebelumnya
                            </button>
                        @endif

                        @if(!$loop->last)
                            <button type="button" onclick="scrollToCard({{ $loopIndex + 1 }})" class="nav-next flex items-center gap-1.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 transition px-5 py-2.5 rounded-xl shadow-sm active:scale-[0.98]">
                                Selanjutnya →
                            </button>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>

    <script>
        function setMode(mode) {
            const body = document.getElementById('mainBody');
            const title = document.getElementById('mainTitle');
            const subtitle = document.getElementById('mainSubtitle');
            const btnDewasa = document.getElementById('btn-dewasa');
            const btnAnak = document.getElementById('btn-anak');

            if (mode === 'anak') {
                body.className = "bg-amber-50/50 font-kids text-gray-800 mode-transition";
                title.innerText = "✨ Yuk, Belajar Sholat Bersama! ✨";
                title.className = "text-3xl lg:text-4xl font-bold text-amber-600 mb-2 font-kids tracking-wide";
                subtitle.innerText = "Panduan tata cara sholat HPT yang mudah dipahami anak pintar";

                btnAnak.className = "px-4 py-2 rounded-xl text-sm font-bold transition duration-200 bg-amber-500 text-white shadow-sm font-kids";
                btnDewasa.className = "px-4 py-2 rounded-xl text-sm font-bold transition duration-200 text-gray-500 hover:text-gray-900 font-kids";

                document.querySelectorAll('.gerakan-card').forEach((card, idx) => {
                    card.classList.replace('rounded-2xl', 'rounded-3xl');
                    card.classList.add('border-amber-100');

                    document.getElementById(`badge-${idx}`).className = "flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 font-bold text-sm font-kids";
                    
                    document.getElementById(`img-dewasa-${idx}`).classList.add('hidden');
                    document.getElementById(`img-anak-${idx}`).classList.remove('hidden');
                    document.getElementById(`desc-dewasa-${idx}`).classList.add('hidden');
                    document.getElementById(`desc-anak-${idx}`).classList.remove('hidden');

                    card.querySelectorAll('.nav-next').forEach(b => b.className = b.className.replace(/emerald/g, 'amber'));

                    // Logika Tukar Audio ke Mode Anak
                    const audioEl = document.getElementById(`audio-element-${idx}`);
                    const audioBtn = document.getElementById(`audio-btn-${idx}`);
                    if (audioEl) {
                        audioEl.pause();
                        audioEl.currentTime = 0;
                        const childSrc = audioEl.getAttribute('data-anak');
                        audioEl.src = childSrc;

                        if (audioBtn) {
                            if (childSrc === '#' || !childSrc) {
                                audioBtn.classList.add('hidden');
                            } else {
                                audioBtn.classList.remove('hidden');
                                audioBtn.querySelector('span').innerText = "▶ Putar Audio Bacaan";
                                audioBtn.className = "audio-btn w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 flex items-center justify-center gap-2 mb-6 shadow-sm active:scale-[0.99]";
                            }
                        }
                    }

                    let subIndex = 0;
                    while (document.getElementById(`trans-dewasa-${idx}-${subIndex}`)) {
                        document.getElementById(`trans-dewasa-${idx}-${subIndex}`).classList.add('hidden');
                        document.getElementById(`trans-anak-${idx}-${subIndex}`).classList.remove('hidden');
                        document.getElementById(`source-${idx}-${subIndex}`).classList.add('hidden');
                        subIndex++;
                    }
                });
            } else {
                body.className = "bg-gray-50 font-sans text-gray-800 mode-transition";
                title.innerText = "Tuntunan Sholat Sesuai HPT";
                title.className = "text-3xl font-bold text-emerald-700 mb-2 font-sans";
                subtitle.innerText = "Panduan gerakan dan bacaan sholat lengkap berdasarkan Himpunan Putusan Tarjih";

                btnDewasa.className = "px-4 py-2 rounded-xl text-sm font-bold transition duration-200 bg-emerald-600 text-white shadow-sm font-sans";
                btnAnak.className = "px-4 py-2 rounded-xl text-sm font-bold transition duration-200 text-gray-500 hover:text-gray-900 font-sans";

                document.querySelectorAll('.gerakan-card').forEach((card, idx) => {
                    card.classList.replace('rounded-3xl', 'rounded-2xl');
                    card.classList.remove('border-amber-100');

                    document.getElementById(`badge-${idx}`).className = "flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-sm font-sans";

                    document.getElementById(`img-dewasa-${idx}`).classList.remove('hidden');
                    document.getElementById(`img-anak-${idx}`).classList.add('hidden');
                    document.getElementById(`desc-dewasa-${idx}`).classList.remove('hidden');
                    document.getElementById(`desc-anak-${idx}`).classList.add('hidden');

                    card.querySelectorAll('.nav-next').forEach(b => b.className = b.className.replace(/amber/g, 'emerald'));

                    // Logika Tukar Audio ke Mode Dewasa
                    const audioEl = document.getElementById(`audio-element-${idx}`);
                    const audioBtn = document.getElementById(`audio-btn-${idx}`);
                    if (audioEl) {
                        audioEl.pause();
                        audioEl.currentTime = 0;
                        const dewasaSrc = audioEl.getAttribute('data-dewasa');
                        audioEl.src = dewasaSrc;

                        if (audioBtn) {
                            if (dewasaSrc === '#' || !dewasaSrc) {
                                audioBtn.classList.add('hidden');
                            } else {
                                audioBtn.classList.remove('hidden');
                                audioBtn.querySelector('span').innerText = "▶ Putar Audio Bacaan";
                                audioBtn.className = "audio-btn w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 flex items-center justify-center gap-2 mb-6 shadow-sm active:scale-[0.99]";
                            }
                        }
                    }

                    let subIndex = 0;
                    while (document.getElementById(`trans-dewasa-${idx}-${subIndex}`)) {
                        document.getElementById(`trans-dewasa-${idx}-${subIndex}`).classList.remove('hidden');
                        document.getElementById(`trans-anak-${idx}-${subIndex}`).classList.add('hidden');
                        document.getElementById(`source-${idx}-${subIndex}`).classList.remove('hidden');
                        subIndex++;
                    }
                });
            }
        }

        function scrollToCard(index) {
            const targetCard = document.getElementById(`gerakan-${index}`);
            if (targetCard) {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function toggleAudio(button) {
            const currentCard = button.closest('.gerakan-card');
            const currentAudio = currentCard.querySelector('.gerakan-audio');
            const allAudios = document.querySelectorAll('.gerakan-audio');
            const allButtons = document.querySelectorAll('.audio-btn');
            const isAnak = document.getElementById('mainBody').classList.contains('font-kids');

            const activeColor = isAnak ? 'amber' : 'emerald';

            function setPlayStyle(btn) {
                btn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                btn.classList.add(`bg-${activeColor}-600`, `hover:bg-${activeColor}-700`);
                btn.querySelector('span').innerText = "▶ Putar Audio Bacaan";
            }

            function setPauseStyle(btn) {
                btn.classList.remove(`bg-${activeColor}-600`, `hover:bg-${activeColor}-700`);
                btn.classList.add('bg-rose-600', 'hover:bg-rose-700');
                btn.querySelector('span').innerText = "⏸ Jeda Audio Bacaan";
            }

            if (!currentAudio.paused) {
                currentAudio.pause();
                setPlayStyle(button);
            } else {
                allAudios.forEach((audio) => {
                    if (audio !== currentAudio) {
                        audio.pause();
                        audio.currentTime = 0;
                    }
                });
                allButtons.forEach((btn) => { if (btn !== button) setPlayStyle(btn); });

                currentAudio.play().catch(error => console.log("Audio ditahan browser:", error));
                setPauseStyle(button);
            }

            currentAudio.onended = function() { setPlayStyle(button); };
        }
    </script>
</body>
</html>