<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12 bg-gray-50 min-h-screen space-y-8 px-4 sm:px-6 lg:px-8">

  @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
    <!-- ADMIN SAJA -->
    <div class="max-w-7xl mx-auto">
      <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-red-50/30">
          <h3 class="text-sm font-semibold uppercase tracking-wider text-red-600">Permintaan Peminjaman</h3>
          <span class="bg-red-100 text-red-700 text-xs font-medium px-2.5 py-0.5 rounded-full">Admin Approval</span>
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
          <span class="bg-blue-100 text-blue-700 text-xs font-medium px-2.5 py-0.5 rounded-full">Active Loans</span>
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

    <!-- SEMUA BISA LIHAT -->
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
                  <form action="{{ route('pinjam.alat', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition-all">
                      Pinjam
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

</x-app-layout>