<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Peminjaman Alat</h2>
            <button onclick="window.print()" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-black transition">
                🖨️ Cetak Halaman
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Alat</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Tgl Pinjam</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Tgl Kembali</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach($semuaLaporan as $l)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $l->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @foreach($l->alats as $a) {{ $a->nama_alat }} ({{ $a->pivot->jumlah }}) @endforeach
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $l->tanggal_pinjam }}</td>
                            <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $l->tanggal_kembali ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase
                                    {{ $l->status == 'menunggu' ? 'bg-amber-100 text-amber-700' : 
                                       ($l->status == 'dipinjam' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                    {{ $l->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        @media print {
            nav, button, header { display: none !important; }
            .py-12 { padding-top: 0 !important; }
        }
    </style>
</x-app-layout>
