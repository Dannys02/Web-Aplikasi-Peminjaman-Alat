<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPAT - Sistem Peminjaman Alat</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased bg-[#f8fafc] text-[#1e293b]">

    <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 11v10l8 4" /></svg>
            </div>
            <span class="text-xl font-bold tracking-tight">SIPAT.</span>
        </div>

        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-indigo-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-600 transition">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">Daftar Akun</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 py-20 flex flex-col items-center text-center">
        <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-600 px-4 py-2 rounded-full text-xs font-bold mb-8 uppercase tracking-widest">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            Sistem Inventaris Digital
        </div>

        <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
            Pinjam Alat Praktik <br> 
            <span class="text-indigo-600">Lebih Cepat & Teratur.</span>
        </h1>
        
        <p class="text-gray-500 text-lg md:text-xl max-w-2xl mb-10 leading-relaxed">
            Pantau stok alat sekolah secara real-time, ajukan peminjaman dalam hitungan detik, dan kelola inventaris dengan sistem verifikasi petugas yang aman.
        </p>

        <div class="flex flex-col md:flex-row gap-4">
            <a href="{{ route('login') }}" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-bold text-lg shadow-2xl hover:bg-slate-800 transition transform hover:-translate-y-1">
                Mulai Pinjam Sekarang
            </a>
            <a href="#features" class="bg-white border border-gray-200 text-gray-600 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition">
                Pelajari Fitur
            </a>
        </div>

        <div id="features" class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-32 w-full text-left">
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 font-bold text-xl">01</div>
                <h4 class="font-bold text-xl mb-3 text-slate-800">Cek Stok Real-time</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Pastikan alat tersedia sebelum kamu datang ke laboratorium. Data stok selalu update otomatis.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 font-bold text-xl">02</div>
                <h4 class="font-bold text-xl mb-3 text-slate-800">Verifikasi Petugas</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Peminjaman aman dengan sistem konfirmasi dua arah antara siswa dan petugas laboratorium.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-6 font-bold text-xl">03</div>
                <h4 class="font-bold text-xl mb-3 text-slate-800">Riwayat Terintegrasi</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Pantau status peminjaman dan batas waktu pengembalian lewat dashboard pribadi kamu.</p>
            </div>
        </div>
    </main>

    <footer class="py-12 text-center text-gray-400 text-sm">
        &copy; 2026 SIPAT App. Dibuat untuk projek jurusan.
    </footer>

</body>
</html>
