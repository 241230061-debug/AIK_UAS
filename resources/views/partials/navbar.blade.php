@php
    $active = $active ?? 'beranda';
@endphp
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-emerald-100 shadow-sm">
    <div class="max-w-5xl mx-auto px-3 py-2.5 md:px-4 md:py-3 flex items-center justify-between gap-2 md:gap-4">
        
        <!-- Bagian Kiri: Logo & Judul -->
        <a href="/" class="flex items-center gap-2 md:gap-2.5 shrink-0 overflow-hidden min-w-0">
            <span class="flex shrink-0 items-center justify-center w-8 h-8 md:w-10 md:h-10 rounded-xl md:rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-500 text-white text-base md:text-lg shadow-md shadow-emerald-200">
                🕌
            </span>
            <span class="leading-tight truncate">
                <span class="block text-sm md:text-base font-extrabold text-emerald-800 tracking-wide truncate">
                    Panduan Sholat
                </span>
                <!-- Nama kelompok disembunyikan di HP agar tidak merusak layout, muncul di tablet/desktop -->
                <span class="hidden md:block text-[10px] text-emerald-500 font-semibold -mt-0.5 truncate">
                    Kelompok : Muhammad Nabil Junaidi, Dharma Ady Khara, Indoko Banderas
                </span>
            </span>
        </a>

        <!-- Bagian Kanan: Menu Navigasi -->
        <div class="bg-emerald-50 border border-emerald-100 p-1 rounded-xl flex items-center gap-1 shrink-0">
            <a href="/"
               class="flex items-center justify-center px-2.5 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-xs md:text-sm font-bold transition
               {{ $active === 'beranda' ? 'bg-white text-emerald-700 shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                <span class="text-base md:text-sm">🏠</span> 
                <span class="hidden sm:inline ml-1.5">Beranda</span>
            </a>
            <a href="/sholat/dewasa"
               class="flex items-center justify-center px-2.5 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-xs md:text-sm font-bold transition
               {{ $active === 'dewasa' ? 'bg-white text-emerald-700 shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                <span class="text-base md:text-sm">👨‍💼</span> 
                <span class="hidden sm:inline ml-1.5">Dewasa</span>
            </a>
            <a href="/sholat/anak"
               class="flex items-center justify-center px-2.5 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-xs md:text-sm font-bold transition
               {{ $active === 'anak' ? 'bg-amber-400 text-white shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                <span class="text-base md:text-sm">🧒</span> 
                <span class="hidden sm:inline ml-1.5">Anak</span>
            </a>
        </div>
        
    </div>
</nav>