<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-IMO — Panduan Sholat Sesuai Tuntunan Sunnah</title>
    <meta name="description" content="SIM-IMO: Panduan gerakan & bacaan sholat lengkap berdasarkan Himpunan Putusan Tarjih (HPT) Muhammadiyah, untuk dewasa maupun anak-anak.">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-arabic { font-family: 'Amiri', serif; }

        .islamic-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(16,185,129,0.18) 1px, transparent 0);
            background-size: 22px 22px;
        }
        .fade-up { animation: fadeUp .7s ease both; }
        @keyframes fadeUp { from { opacity:0; transform: translateY(16px);} to {opacity:1; transform:translateY(0);} }
    </style>
</head>
<body class="bg-gradient-to-b from-emerald-50 via-white to-white text-gray-800">

    @include('partials.navbar', ['active' => 'beranda'])

    <!-- HERO -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 islamic-pattern opacity-70"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-200/40 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-200/40 rounded-full blur-3xl"></div>

        <div class="relative max-w-5xl mx-auto px-4 pt-14 pb-16 md:pt-20 md:pb-24 text-center fade-up">
            <span class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 text-xs font-bold px-4 py-1.5 rounded-full mb-6">
                ✦ Rujukan Himpunan Putusan Tarjih Muhammadiyah
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-emerald-900 leading-tight mb-5">
                Belajar Sholat,<br class="hidden md:block">
                <span class="bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent">Mudah &amp; Menyenangkan</span>
            </h1>
            <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                SIM-IMO menuntun setiap gerakan dan bacaan sholat secara lengkap — dilengkapi foto, video, dan audio —
                sesuai tuntunan Sunnah, untuk seluruh anggota keluarga.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/sholat/dewasa" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-7 py-3.5 rounded-2xl shadow-lg shadow-emerald-200 transition">
                    👨‍💼 Mulai Mode Dewasa
                </a>
                <a href="/sholat/anak" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-amber-400 hover:bg-amber-500 text-white font-bold px-7 py-3.5 rounded-2xl shadow-lg shadow-amber-200 transition">
                    🧒 Mulai Mode Anak
                </a>
            </div>
        </div>
    </section>

    <!-- AYAT / DALIL -->
    <section class="max-w-5xl mx-auto px-4 pb-16">
        <div class="grid md:grid-cols-2 gap-5">
            <div class="bg-white border border-emerald-100 rounded-3xl p-7 md:p-8 shadow-sm">
                <p class="text-right font-arabic text-2xl md:text-3xl leading-loose text-emerald-900 mb-4" dir="rtl">
                    إِنَّ الصَّلَاةَ تَنْهَىٰ عَنِ الْفَحْشَاءِ وَالْمُنكَرِ
                </p>
                <p class="text-sm text-gray-500 mb-3">
                    "Sesungguhnya sholat itu mencegah dari perbuatan keji dan mungkar."
                </p>
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">QS. Al-'Ankabut: 45</p>
            </div>

            <div class="bg-white border border-emerald-100 rounded-3xl p-7 md:p-8 shadow-sm">
                <p class="text-right font-arabic text-2xl md:text-3xl leading-loose text-emerald-900 mb-4" dir="rtl">
                    الصَّلَاةُ عِمَادُ الدِّينِ
                </p>
                <p class="text-sm text-gray-500 mb-3">
                    Sholat disebut sebagai tiang agama — pondasi utama yang menopang keimanan seorang muslim.
                </p>
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Diriwayatkan dari Ibnu 'Umar</p>
            </div>
        </div>
    </section>

    <!-- KEUTAMAAN / MANFAAT -->
    <section class="bg-emerald-800 text-white">
        <div class="max-w-5xl mx-auto px-4 py-14">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold mb-2">Keutamaan Menjaga Sholat</h2>
                <p class="text-emerald-200 text-sm md:text-base">Ibadah pertama yang akan dihisab di akhirat kelak</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-emerald-700/50 border border-emerald-600/50 rounded-2xl p-5 text-center">
                    <div class="text-3xl mb-3">🕋</div>
                    <h3 class="font-bold text-sm mb-1">Menghubungkan Diri dengan Allah</h3>
                    <p class="text-xs text-emerald-200 leading-relaxed">Sarana munajat dan komunikasi langsung seorang hamba dengan Sang Pencipta.</p>
                </div>
                <div class="bg-emerald-700/50 border border-emerald-600/50 rounded-2xl p-5 text-center">
                    <div class="text-3xl mb-3">🧭</div>
                    <h3 class="font-bold text-sm mb-1">Penuntun Akhlak</h3>
                    <p class="text-xs text-emerald-200 leading-relaxed">Mencegah dari perbuatan keji dan mungkar, membentuk pribadi yang disiplin.</p>
                </div>
                <div class="bg-emerald-700/50 border border-emerald-600/50 rounded-2xl p-5 text-center">
                    <div class="text-3xl mb-3">🕰️</div>
                    <h3 class="font-bold text-sm mb-1">Melatih Kedisiplinan</h3>
                    <p class="text-xs text-emerald-200 leading-relaxed">Lima waktu yang terjadwal melatih ketepatan waktu dan konsistensi.</p>
                </div>
                <div class="bg-emerald-700/50 border border-emerald-600/50 rounded-2xl p-5 text-center">
                    <div class="text-3xl mb-3">❤️</div>
                    <h3 class="font-bold text-sm mb-1">Ketenangan Jiwa</h3>
                    <p class="text-xs text-emerald-200 leading-relaxed">Menjadi sumber ketenangan hati di tengah kesibukan dunia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR APLIKASI -->
    <section class="max-w-5xl mx-auto px-4 py-16">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">Fitur Panduan SIM-IMO</h2>
            <p class="text-gray-500 text-sm md:text-base">Dirancang agar mudah dipelajari, langkah demi langkah</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl mb-4">📖</div>
                <h3 class="font-bold text-gray-900 mb-1.5">13 Gerakan Lengkap</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Dari niat &amp; takbiratul ihram hingga salam, disusun berurutan sesuai HPT.</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-4">🎧</div>
                <h3 class="font-bold text-gray-900 mb-1.5">Audio Bacaan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Dengarkan pelafalan bacaan sholat agar lebih mudah dihafal dengan benar.</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-xl mb-4">🎥</div>
                <h3 class="font-bold text-gray-900 mb-1.5">Foto &amp; Video Gerakan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Peragaan visual setiap posisi agar praktik gerakan lebih akurat.</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl mb-4">🕋</div>
                <h3 class="font-bold text-gray-900 mb-1.5">Teks Arab, Latin &amp; Terjemahan</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Setiap bacaan disertai transliterasi dan arti agar mudah dipahami maknanya.</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl mb-4">👨‍👩‍👧</div>
                <h3 class="font-bold text-gray-900 mb-1.5">Dua Mode Belajar</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Tampilan khusus dewasa yang ringkas dan mode anak yang ceria &amp; ramah.</p>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-11 h-11 rounded-xl bg-lime-100 text-lime-700 flex items-center justify-center text-xl mb-4">✅</div>
                <h3 class="font-bold text-gray-900 mb-1.5">Rujukan Terpercaya</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Disusun berdasarkan Himpunan Putusan Tarjih (HPT) Muhammadiyah.</p>
            </div>
        </div>
    </section>

    <!-- PILIH MODE -->
    <section class="max-w-5xl mx-auto px-4 pb-20">
        <div class="grid md:grid-cols-2 gap-6">
            <a href="/sholat/dewasa" class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-600 text-white p-8 shadow-lg hover:shadow-xl transition">
                <div class="absolute -right-6 -bottom-6 text-[110px] opacity-15 group-hover:opacity-25 transition">👨‍💼</div>
                <span class="inline-block text-xs font-bold bg-white/20 px-3 py-1 rounded-full mb-4">Mode Dewasa</span>
                <h3 class="text-2xl font-extrabold mb-2">Panduan Lengkap &amp; Ringkas</h3>
                <p class="text-emerald-50 text-sm mb-6 max-w-xs">Tampilan fokus untuk remaja dan dewasa dengan detail dalil pada setiap bacaan.</p>
                <span class="inline-flex items-center gap-1.5 text-sm font-bold">Buka Panduan Dewasa →</span>
            </a>

            <a href="/sholat/anak" class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-400 to-orange-400 text-white p-8 shadow-lg hover:shadow-xl transition">
                <div class="absolute -right-6 -bottom-6 text-[110px] opacity-15 group-hover:opacity-25 transition">🧒</div>
                <span class="inline-block text-xs font-bold bg-white/20 px-3 py-1 rounded-full mb-4">Mode Anak-Anak</span>
                <h3 class="text-2xl font-extrabold mb-2">Belajar Sholat Jadi Seru!</h3>
                <p class="text-amber-50 text-sm mb-6 max-w-xs">Tampilan ceria dengan bahasa sederhana yang mudah dipahami anak-anak.</p>
                <span class="inline-flex items-center gap-1.5 text-sm font-bold">Buka Panduan Anak →</span>
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 text-center py-8 text-xs">
        <p class="mb-1">🕌 SIM-IMO — Sistem Informasi Muslim: Ilmu &amp; Tuntunan Sholat</p>
        <p>&copy; {{ date('Y') }} SIM-IMO Project. Terverifikasi sesuai Sunnah &amp; HPT.</p>
    </footer>

</body>
</html>
