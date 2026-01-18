<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  @if(session('success'))
  <div id="alert" class="fixed top-5 w-full  max-w-7xl mx-auto mb-6">
    <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center">
      <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
      {{ session('success') }}
    </div>
  </div>
  @endif

  @if(session('error'))
  <div id="alert-error" class="fixed top-5 w-full max-w-7xl mx-auto mb-6">
    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm flex items-center">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      {{ session('error') }}
    </div>
  </div>
  @endif

  <div class="py-12 bg-gray-50 min-h-screen space-y-8 px-4 sm:px-6 lg:px-8">
    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
    <div class="mb-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
          <h2 class="text-xl font-semibold text-gray-800 leading-tight">Ringkasan Statistik</h2>
          <p class="text-sm text-gray-500">
            Pantau performa sistem Anda secara real-time.
          </p>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('admin.tambah.alat') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            + Alat
          </a>
          <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            + Kategori
          </a>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-500 uppercase">
                Total User
              </p>
              <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</h3>
            </div>
            <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-500 uppercase">
                Total Alat
              </p>
              <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Alat::count() }}</h3>
            </div>
            <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-500 uppercase">
                Kategori
              </p>
              <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Kategori::count() }}</h3>
            </div>
            <div class="p-3 bg-amber-50 rounded-lg text-amber-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
          </div>
        </div>

        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-500 uppercase">
                Aktivitas Hari Ini
              </p>
              <h3 class="text-2xl font-bold text-gray-900">{{
              \App\Models\LogAktivitas::whereDate('created_at', today())->count()
              }}</h3>
            </div>
            <div class="p-3 bg-purple-50 rounded-lg text-purple-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
          </div>
        </div>

      </div>
    </div>
    @endif


    @if(Auth::user()->role && Auth::user()->role->nama_role == 'petugas')
    <!-- PERMINTAAN PEMINJAMAN -->
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-red-50/30">
          <h3 class="text-sm font-semibold uppercase tracking-wider text-red-600">Permintaan Peminjaman</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Daftar Alat</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @php $permintaan = \App\Models\Peminjaman::where('status', 'menunggu')->get(); @endphp
              @forelse($permintaan as $p)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $p->user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                  @foreach($p->alats as $a)
                  <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1">{{ $a->nama_alat }} ({{ $a->pivot->jumlah }})</span>
                  @endforeach
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <form action="{{ route('petugas.konfirmasi', $p->id) }}" method="POST">
                    @csrf
                    <button class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold py-1.5 px-4 rounded-lg shadow-sm transition-all">
                      Setujui
                    </button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic text-sm">Tidak ada permintaan masuk saat ini</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- MEMANTAU PENGEMBALIAN -->
    <div class="max-w-7xl mx-auto">
      <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
          <h3 class="text-sm font-bold text-green-600 uppercase tracking-tight">Verifikasi Pengembalian</h3>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase">Peminjam</th>
                <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase">Alat</th>
                <th class="px-6 py-3 text-center text-[10px] font-bold text-gray-400 uppercase">Opsi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @php
              $pantauKembali = \App\Models\Peminjaman::where('status', 'menunggu_kembali')->get();
              @endphp

              @forelse($pantauKembali as $p)
              <tr class="text-sm">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $p->user->name }}</td>
                <td class="px-6 py-4 text-gray-500">
                  @foreach($p->alats as $a) {{ $a->nama_alat }} @endforeach
                </td>
                <td class="px-6 py-4">
                  <div class="flex justify-center gap-4">
                    <form action="{{ route('petugas.konfirmasi_kembali', $p->id) }}" method="POST">
                      @csrf
                      <input type="hidden" name="aksi" value="konfirmasi">
                      <button type="submit" title="Terima Pengembalian" class="group flex items-center justify-center w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-sm border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                      </button>
                    </form>

                    <form action="{{ route('petugas.konfirmasi_kembali', $p->id) }}" method="POST">
                      @csrf
                      <input type="hidden" name="aksi" value="batal">
                      <button type="submit" title="Batalkan/Tolak" class="group flex items-center justify-center w-9 h-9 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm border border-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-xs italic">
                  Tidak ada antrean pengembalian.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif

    @if(Auth::user()->role && Auth::user()->role->nama_role == 'peminjam')
    <!-- DAFTAR ALAT -->
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100">
          <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-700">Katalog Alat Tersedia</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Alat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Stok</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @foreach($semuaAlat as $item)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_alat }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <span class="bg-gray-100 px-2 py-1 rounded text-[11px] uppercase tracking-tighter">{{ $item->kategori->nama_kategori }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                  <span class="{{ $item->jumlah > 0 ? 'text-green-600 font-semibold' : 'text-red-500' }}">
                    {{ $item->jumlah }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                  @if ($item->jumlah > 0)
                  <form action="{{ route('pinjam.alat', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition-all">
                      Pinjam
                    </button>
                  </form>
                  @else
                  <button disabled class="bg-gray-300 text-gray-500 cursor-not-allowed py-2 px-6 rounded-lg text-xs font-bold">
                    Habis
                  </button>
                  @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- SEDANG DI PINJAM & STATUS -->
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-emerald-50/20">
          <h3 class="text-sm font-semibold uppercase tracking-wider text-emerald-700">Status Pinjaman Saya</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @forelse($historySaya as $h)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                  @foreach($h->alats as $a)
                  {{ $a->nama_alat }}{{ !$loop->last ? ',' : '' }}
                  @endforeach
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  @if($h->status == 'menunggu')
                  <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Menunggu Persetujuan</span>
                  @elseif($h->status == 'dipinjam')
                  <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Sedang Dipakai</span>
                  @elseif($h->status == 'menunggu_kembali')
                  <span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Menunggu Konfirmasi Kembali</span>
                  @else
                  <span class="bg-gray-100 text-gray-500 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Sudah Kembali</span>
                  @endif
                </td>
                <td class="px-6 py-4 text-center">
                  @if($h->status == 'dipinjam')
                  <form action="{{ route('user.kembalikan', $h->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-50 text-blue-600 border border-blue-200 text-xs font-semibold py-1.5 px-4 rounded-lg hover:bg-blue-100 transition-colors">
                      Kembalikan
                    </button>
                  </form>
                  @else
                  <span class="text-xs text-gray-400">-</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-6 py-8 text-center text-gray-400 text-sm italic">Belum ada aktivitas peminjaman.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif

  </div>

</x-app-layout>