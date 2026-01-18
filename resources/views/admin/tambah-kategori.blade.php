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
                  <a href=""
                    class="bg-amber-500 hover:bg-amber-600 text-white text-xs
                    font-bold py-2 px-4 rounded-lg shadow-sm hover:shadow-md
                    transition-all">
                    Edit
                  </a>

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