<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Sholat HPT Muhammadiyah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
        .font-arabic { font-family: 'Amiri', serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <div class="max-w-3xl mx-auto px-4 py-8">
        <header class="text-center mb-12">
            <h1 class="text-3xl font-bold text-emerald-700 mb-2">Tuntunan Sholat Sesuai HPT</h1>
            <p class="text-gray-600">Panduan gerakan dan bacaan sholat lengkap berdasarkan Himpunan Putusan Tarjih</p>
        </header>

        <div class="space-y-8">
            @foreach($daftarGerakan as $gerakan)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 transition hover:shadow-md gerakan-card">
                    
                    <div class="flex items-center gap-4 mb-4">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold text-sm">
                            {{ $gerakan->urutan }}
                        </span>
                        <h2 class="text-xl font-bold text-gray-900">{{ $gerakan->nama }}</h2>
                    </div>

                    <div class="w-full h-56 bg-gray-100 rounded-xl overflow-hidden border border-gray-200 flex items-center justify-center mb-4">
                        <img src="{{ $gerakan->foto_url ?? 'https://via.placeholder.com/600x400?text=Foto+' . urlencode($gerakan->nama) }}" 
                             alt="Visualisasi {{ $gerakan->nama }}" 
                             class="w-full h-full object-cover">
                    </div>

                    <audio class="gerakan-audio" src="{{ $gerakan->audio_url ?? asset('audio/gerakan-' . $gerakan->urutan . '.mp3') }}" preload="none"></audio>
                    
                    <button class="audio-btn w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 flex items-center justify-center gap-2 mb-6 shadow-sm active:scale-[0.99]" 
                            onclick="toggleAudio(this)">
                        <span>▶ Putar Audio Bacaan</span>
                    </button>

                    <p class="text-gray-600 text-sm leading-relaxed mb-6 bg-slate-50 p-3 rounded-lg border-l-4 border-emerald-500">
                        {{ $gerakan->deskripsi }}
                    </p>

                    @if($gerakan->bacaan->count() > 0)
                        <div class="space-y-6">
                            @foreach($gerakan->bacaan as $index => $bacaan)
                                <div class="border-t border-gray-100 pt-4">
                                    @if($gerakan->bacaan->count() > 1)
                                        <span class="inline-block text-xs font-semibold bg-gray-100 text-gray-600 px-2 py-1 rounded mb-3">
                                            Pilihan Bacaan {{ $index + 1 }}
                                        </span>
                                    @endif

                                    <div class="text-right font-arabic text-2xl lg:text-3xl leading-loose text-gray-900 mb-3" dir="rtl">
                                        {{ $bacaan->teks_arab }}
                                    </div>

                                    <div class="italic text-emerald-700 text-sm mb-2 font-semibold">
                                        "{{ $bacaan->teks_latin }}"
                                    </div>

                                    <div class="text-gray-600 text-sm mb-2">
                                        <span class="font-bold text-xs text-gray-400 block uppercase tracking-wider">Artinya:</span>
                                        {{ $bacaan->terjemahan }}
                                    </div>

                                    <div class="text-xs text-gray-400 text-right mt-1">
                                        Sumber: {{ $bacaan->sumber }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic">Tidak ada bacaan khusus untuk gerakan ini.</p>
                    @endif

                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleAudio(button) {
            // Menemukan kartu pembungkus tempat tombol ini diklik
            const currentCard = button.closest('.gerakan-card');
            const currentAudio = currentCard.querySelector('.gerakan-audio');
            
            // Mengambil seluruh elemen audio dan tombol di halaman web
            const allAudios = document.querySelectorAll('.gerakan-audio');
            const allButtons = document.querySelectorAll('.audio-btn');

            // Fungsi pembantu mengubah tampilan tombol ke mode PLAY (Hijau)
            function setPlayStyle(btn) {
                btn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                btn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                btn.querySelector('span').innerText = "▶ Putar Audio Bacaan";
            }

            // Fungsi pembantu mengubah tampilan tombol ke mode PAUSE (Merah)
            function setPauseStyle(btn) {
                btn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                btn.classList.add('bg-rose-600', 'hover:bg-rose-700');
                btn.querySelector('span').innerText = "⏸ Jeda Audio Bacaan";
            }

            // LOGIKA 1: JIKA AUDIO SEKARANG SEDANG BERPUTAR -> MAKA JEDA (PAUSE)
            if (!currentAudio.paused) {
                currentAudio.pause();
                setPlayStyle(button);
            } 
            // LOGIKA 2: JIKA AUDIO SEKARANG SEDANG BERHENTI -> MAKA PUTAR (PLAY)
            else {
                // Matikan audio lain terlebih dahulu agar tidak bertubrukan
                allAudios.forEach((audio) => {
                    if (audio !== currentAudio) {
                        audio.pause();
                        audio.currentTime = 0; // Reset durasi ke awal
                    }
                });

                // Reset semua desain tombol lain ke warna hijau kembali
                allButtons.forEach((btn) => {
                    if (btn !== button) {
                        setPlayStyle(btn);
                    }
                });

                // Jalankan audio milik kartu ini
                currentAudio.play().catch(error => {
                    console.log("Pemutaran audio terhambat sistem keamanan browser:", error);
                });
                setPauseStyle(button);
            }

            // LOGIKA 3: KETIKA AUDIO SELESAI DENGAN SENDIRINYA -> RESET TOMBOL
            currentAudio.onended = function() {
                setPlayStyle(button);
            };
        }
    </script>
</body>
</html>