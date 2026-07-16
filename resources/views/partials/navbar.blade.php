@php
    $active = $active ?? 'beranda';
@endphp
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-emerald-100 shadow-sm">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between gap-3">
        <a href="/" class="flex items-center gap-2.5 shrink-0">
            <span class="flex items-center justify-center w-10 h-10 rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-500 text-white text-lg shadow-md shadow-emerald-200">
                🕌
            </span>
            <span class="leading-tight">
                <span class="block text-sm font-extrabold text-emerald-800 tracking-wide">Panduan Sholat</span>
                <span class="block text-[10px] text-emerald-500 font-semibold -mt-0.5">Nama Kelompok : Muhammad Nabil Junaidi, Dharma Ady Khara, Indoko Banderas</span>
            </span>
        </a>

        <div class="bg-emerald-50 border border-emerald-100 p-1 rounded-2xl flex items-center gap-1">
            <a href="/"
               class="px-3 md:px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition
               {{ $active === 'beranda' ? 'bg-white text-emerald-700 shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                🏠 <span class="hidden sm:inline">Beranda</span>
            </a>
            <a href="/sholat/dewasa"
               class="px-3 md:px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition
               {{ $active === 'dewasa' ? 'bg-white text-emerald-700 shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                👨‍💼 <span class="hidden sm:inline">Dewasa</span>
            </a>
            <a href="/sholat/anak"
               class="px-3 md:px-4 py-2 rounded-xl text-xs md:text-sm font-bold transition
               {{ $active === 'anak' ? 'bg-amber-400 text-white shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                🧒 <span class="hidden sm:inline">Anak</span>
            </a>
        </div>
    </div>
</nav>
