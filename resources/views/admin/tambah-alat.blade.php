<x-app-layout>
  @if(session('success'))
    <div id="alert" class="fixed top-5 w-full  max-w-7xl mx-auto mb-6">
      <div
        class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
            clip-rule="evenodd"></path>
        </svg>
        {{ session('success') }}
      </div>
    </div>
  @endif

  @if(session('error'))
    <div id="alert-error" class="fixed top-5 w-full max-w-7xl mx-auto mb-6">
      <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        {{ session('error') }}
      </div>
    </div>
  @endif

  <!-- TAMBAH ALAT -->
  <div class="p-6">
    <div class="max-w-7xl mx-auto p-6">
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold mb-6 text-gray-700">Tambah Alat Baru</h3>

        <form action="{{ route('admin.simpan.alat') }}" method="POST">
          @csrf
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Nama Alat</label>
              <input type="text" name="nama_alat"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Kategori</label>
              <select name="kategori_id"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach($kategoris as $k)
                  <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Jumlah (Stok Awal)</label>
              <input type="number" name="jumlah"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="pt-4">
              <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan Alat
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- DAFTAR ALAT -->
    <div class="max-w-7xl mx-auto p-6">
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
                    <span
                      class="bg-gray-100 px-2 py-1 rounded text-[11px] uppercase tracking-tighter">{{ $item->kategori->nama_kategori }}</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                    <span class="{{ $item->jumlah > 0 ? 'text-green-600 font-semibold' : 'text-red-500' }}">
                      {{ $item->jumlah }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    <div class="flex justify-end gap-2">
                      <a href="#"
                        class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold py-2 px-4 rounded-lg shadow-sm hover:shadow-md transition-all">
                        Edit
                      </a>

                      <form action="{{ route('admin.alat.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-4 rounded-lg shadow-sm hover:shadow-md transition-all">
                          Hapus
                        </button>
                      </form>
                    </div>
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