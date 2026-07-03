<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-IMO - Tuntunan Sholat HPT</title>
    <!-- Tailwind CSS Play CDN untuk kemudahan pengembangan lokal -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- HEADER IDENTITAS WAJIB (F-08) -->
    <header class="bg-emerald-700 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center gap-2">
            <div>
                <h1 class="text-xl font-bold tracking-wide">🕋 SIM-IMO Sholat</h1>
                <p class="text-xs text-emerald-200">Rujukan: Himpunan Putusan Tarjih Muhammadiyah</p>
            </div>
            <!-- Identitas Kelompok (Statis di setiap halaman utama) -->
            <div class="text-center md:text-right border-t md:border-t-0 border-emerald-600 pt-2 md:pt-0 w-full md:w-auto">
                <p class="text-xs font-semibold text-emerald-100">[Nama Kelompok Anda / Kelompok 03]</p>
                <p class="text-[10px] text-emerald-200">[Nama Prodi] | [Mata Kuliah]</p>
                <p class="text-[10px] text-emerald-200">Dosen: [Nama Dosen Pengampu, M.T.]</p>
            </div>
        </div>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-gray-400 text-center py-4 text-xs mt-12">
        &copy; 2026 SIM-IMO Project. Terverifikasi sesuai Sunnah & HPT.
    </footer>

</body>
</html>