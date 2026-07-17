@php
    $active = $active ?? 'beranda';
@endphp
<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-emerald-100 shadow-sm">
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

        <button id="navbar-toggle" type="button" class="inline-flex items-center justify-center rounded-2xl border border-emerald-100 bg-emerald-50 p-2 text-emerald-700 transition hover:bg-emerald-100 md:hidden" aria-controls="navbar-menu" aria-expanded="false" aria-label="Buka menu navigasi">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16"></path>
            </svg>
        </button>

        <div id="navbar-menu" class="hidden w-full md:flex md:w-auto md:items-center md:justify-end">
            <div class="flex flex-col gap-2 rounded-3xl border border-emerald-100 bg-emerald-50 p-3 shadow-sm md:flex-row md:items-center md:bg-transparent md:border-0 md:p-0 md:shadow-none">
                <a href="/" class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm font-bold transition md:px-3 md:py-2
                    {{ $active === 'beranda' ? 'bg-white text-emerald-700 shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                    🏠 <span>Beranda</span>
                </a>
                <a href="/sholat/dewasa" class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm font-bold transition md:px-3 md:py-2
                    {{ $active === 'dewasa' ? 'bg-white text-emerald-700 shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                    👨‍💼 <span>Dewasa</span>
                </a>
                <a href="/sholat/anak" class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm font-bold transition md:px-3 md:py-2
                    {{ $active === 'anak' ? 'bg-amber-400 text-white shadow-sm' : 'text-emerald-500 hover:text-emerald-800' }}">
                    🧒 <span>Anak</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toggle = document.getElementById('navbar-toggle');
            var menu = document.getElementById('navbar-menu');

            if (!toggle || !menu) {
                return;
            }

            toggle.addEventListener('click', function () {
                var isHidden = menu.classList.contains('hidden');
                menu.classList.toggle('hidden');
                toggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            });

            menu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 768) {
                        menu.classList.add('hidden');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        });
    </script>
</nav>
