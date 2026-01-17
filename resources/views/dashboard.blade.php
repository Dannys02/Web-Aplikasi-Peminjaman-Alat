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
    <div class="flex justify-end gap-5 mb-4">
      <a href="{{ route('admin.tambah.alat') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-4 rounded-lg shadow-sm transition-all">
        + Tambah Alat
      </a>
      
      <a href="{{ route('admin.kategori.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-4 rounded-lg shadow-sm transition-all">
        + Tambah Kategori
      </a>
    </div>
    
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100">
          <h3 class="text-sm font-semibold uppercase tracking-wider
          text-gray-700">Daftar Alat Tersedia</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Alat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Stok</th>
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
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- ADMIN SAJA -->
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
                  <form action="{{ route('admin.konfirmasi', $p->id) }}" method="POST">
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

    <!-- ADMIN SAJA ? -->
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-blue-50/30">
          <h3 class="text-sm font-semibold uppercase tracking-wider text-blue-600">Barang Sedang Dipinjam</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Peminjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Manajemen</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @php $sedangDipinjam = \App\Models\Peminjaman::where('status', 'dipinjam')->get(); @endphp
              @forelse($sedangDipinjam as $p)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $p->user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                  @foreach($p->alats as $a) {{ $a->nama_alat }}@if(!$loop->last), @endif @endforeach
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <form action="{{ route('admin.kembalikan', $p->id) }}" method="POST">
                    @csrf
                    <button class="bg-orange-50 hover:bg-orange-100 text-orange-600 border border-orange-200 text-xs font-semibold py-1.5 px-4 rounded-lg transition-all">
                      Selesai & Kembalikan
                    </button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic text-sm">Belum ada alat yang dipinjam</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif

    @if(Auth::user()->role && Auth::user()->role->nama_role == 'peminjam')
    
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
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @forelse($historySaya as $h)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                  @foreach($h->alats as $a)
                  {{ $a->nama_alat }}
                  @endforeach
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  @if($h->status == 'menunggu')
                  <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Menunggu Admin</span>
                  @elseif($h->status == 'dipinjam')
                  <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Sedang Dipakai</span>
                  @else
                  <span class="bg-gray-100 text-gray-500 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Sudah Kembali</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="2" class="px-6 py-8 text-center text-gray-400 text-sm italic">Belum ada aktivitas peminjaman.</td>
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