<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Kategori Alat</h2>
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

  <div id="modalKategori" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
      <div class="bg-white w-full max-w-sm rounded-2xl p-6 shadow-2xl relative">
        <h3 class="font-bold text-lg mb-4">Edit Kategori</h3>
        <form id="formKategori" method="POST">
          @csrf
          @method('PUT')
          <input type="text" name="nama_kategori" id="edit_nama_kategori" class="w-full border-gray-200 rounded-xl mb-4 text-sm" required>
          <div class="flex gap-2">
            <button type="button" onclick="closeKategori()" class="flex-1 py-2 text-gray-400 font-bold text-xs">Batal</button>
            <button type="submit" class="flex-1 py-2 bg-indigo-600 text-white rounded-xl font-bold text-xs">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.kategori.store') }}" method="POST" class="flex gap-4">
          @csrf
          <input type="text" name="nama_kategori" placeholder="Contoh: Alat Elektronik" class="flex-1 border-gray-300 rounded-lg focus:ring-indigo-500" required>
          <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition">Tambah</button>
        </form>
      </div>

      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kategori</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($kategoris as $k)
            <tr>
              <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $k->nama_kategori }}</td>
              <td class="px-6 py-4">
                <div class="flex justify-center items-center gap-2">
                  <button onclick="openEditKategori({{ $k->id }}, '{{
                    $k->nama_kategori }}')"
                    class="bg-amber-500 hover:bg-amber-600 text-white text-xs
                    font-bold py-2 px-4 rounded-lg shadow-sm hover:shadow-md
                    transition-all">
                    Edit
                  </button>

                  <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="bg-red-600 hover:bg-red-700 text-white text-xs
                      font-bold py-2 px-4 rounded-lg shadow-sm hover:shadow-md
                      transition-all">
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
</x-app-layout>