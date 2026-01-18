<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jejak Aktivitas Sistem</h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto px-4">
      <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        <table class="min-w-full divide-y divide-gray-100">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Waktu</th>
              <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">User</th>
              <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Aktivitas</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
            @php $logs = \App\Models\LogAktivitas::latest()->get(); @endphp
            @forelse($logs as $log)
            <tr class="text-sm">
              <td class="px-6 py-4 text-gray-400 whitespace-nowrap">
                {{ $log->created_at->format('d M, H:i') }}
              </td>
              <td class="px-6 py-4">
                <span class="font-semibold text-gray-700">{{ $log->nama_user }}</span>
                <span class="block text-[10px] text-gray-400 uppercase">{{ $log->peran }}</span>
              </td>
              <td class="px-6 py-4 text-gray-600 italic">
                "{{ $log->aksi }}"
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Belum ada aktivitas tercatat.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>