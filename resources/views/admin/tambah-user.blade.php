<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Pengguna</h2>
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
  
  <div id="modalUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white w-full max-w-md rounded-2xl p-8 shadow-2xl relative">
            <h3 class="font-bold text-lg mb-6 text-gray-800">Edit Pengguna</h3>
            <form id="formUser" method="POST" class="space-y-4 text-left">
                @csrf @method('PUT')
                
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Nama Lengkap</label>
                    <input type="text" name="name" id="edit_user_name" class="w-full border-gray-200 rounded-xl text-sm" required>
                </div>

                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Email</label>
                    <input type="email" name="email" id="edit_user_email" class="w-full border-gray-200 rounded-xl text-sm" required>
                </div>

                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Role</label>
                    <select name="role_id" id="edit_user_role" class="w-full border-gray-200 rounded-xl text-sm">
                        <option value="1">Admin</option>
                        <option value="2">Petugas</option>
                        <option value="3">Peminjam</option>
                    </select>
                </div>

                <div class="bg-amber-50 p-3 rounded-xl">
                    <label class="text-[10px] font-bold text-amber-600 uppercase">Ganti Password (Opsional)</label>
                    <input type="password" name="password" class="w-full border-amber-200 rounded-xl text-sm mt-1" placeholder="Isi jika ingin ganti">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeUser()" class="flex-1 py-3 text-gray-400 font-bold text-xs border border-gray-100 rounded-xl">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-amber-500 text-white rounded-xl font-bold text-xs shadow-lg shadow-amber-100">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

      <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-6">Tambah Akun Baru</h3>
        <form action="{{ route('admin.users.store') }}" method="POST">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="name" placeholder="Nama Lengkap" class="border-gray-200 rounded-lg text-sm focus:ring-indigo-500" required>
            <input type="email" name="email" placeholder="Alamat Email" class="border-gray-200 rounded-lg text-sm focus:ring-indigo-500" required>
            <input type="password" name="password" placeholder="Password" class="border-gray-200 rounded-lg text-sm focus:ring-indigo-500" required>
            <select name="role_id" class="border-gray-200 rounded-lg text-sm focus:ring-indigo-500">
              @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
              @endforeach
            </select>
          </div>
          <div class="mt-4 flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-xs font-bold transition shadow-sm">
              SIMPAN USER
            </button>
          </div>
        </form>
      </div>

      <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase">Nama</th>
              <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase">Email</th>
              <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase">Role</th>
              <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50/50 transition">
              <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $user->name }}</td>
              <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
              <td class="px-6 py-4 text-center text-sm">
                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-tighter
                  {{ $user->role_id == 1 ? 'bg-purple-50 text-purple-600' : ($user->role_id == 2 ? 'bg-blue-50 text-blue-600' : 'bg-gray-50 text-gray-600') }}">
                  {{ $user->role->nama_role }}
                </span>
              </td>
              <td class="px-6 py-4 text-center">
                @if($user->id !== auth()->id())
                <div class="flex justify-end gap-2">
                  <button onclick="openEditUser({{ $user->id }}, '{{ $user->name }}',
                  '{{ $user->email }}', {{ $user->role_id }})" class="bg-amber-500
                  hover:bg-amber-600 text-white text-xs font-bold py-2 px-4
                  rounded-lg shadow-sm hover:shadow-md transition-all">
                    Edit
                  </button>

                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                    @csrf @method('DELETE')
                    <button class="bg-red-600 hover:bg-red-700
                      text-white text-xs font-bold py-2 px-4
                      rounded-lg shadow-sm hover:shadow-md
                      transition-all"> Hapus </button>
                  </form>
                </div>
                @else
                <span class="text-[10px] text-gray-300 italic">Anda</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>