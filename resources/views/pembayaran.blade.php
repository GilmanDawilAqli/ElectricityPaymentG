<x-layout></x-layout>
<section class="bg-gray-50 dark:bg-gray-900 p-3 h-max sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="NoKontrol" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" autocomplete="off" id="NoKontrol" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari No Kontrol">
                            <ul id="dropdown-results" class="absolute bg-white border border-gray-300 rounded-lg shadow-lg hidden"></ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                        <tr>
                            <th scope="col" class="px-4 py-3">Tahun</th>
                            <th scope="col" class="px-4 py-3">Bulan</th>
                            <th scope="col" class="px-4 py-3">No Kontrol</th>
                            <th scope="col" class="px-4 py-3">Nama Pelanggan</th>
                            <th scope="col" class="px-4 py-3">Meter Awal</th>
                            <th scope="col" class="px-4 py-3">Meter Akhir</th>
                            <th scope="col" class="px-4 py-3">Biaya Beban</th>
                            <th scope="col" class="px-4 py-3">Total Pemakaian</th>
                            <th scope="col" class="px-4 py-3">Jumlah Tagihan</th>
                            <th scope="col" class="px-4 py-3">Aksi
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemakaian as $item)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-3">{{ $item->Tahun }}</td>
                            <td class="px-4 py-3">{{ $item->nama_bulan }}</td>
                            <td class="px-4 py-3">{{ $item->NoKontrol }}</td>
                            <td class="px-4 py-3">{{ $item->pelanggan->Nama ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->MeterAwal }}</td>
                            <td class="px-4 py-3">{{ $item->MeterAkhir }}</td>
                            <td class="px-4 py-3">{{ $item->BiayaBebanPemakai }}</td>
                            <td class="px-4 py-3">{{ $item->BiayaPemakaian }}</td>
                            <td class="px-4 py-3">{{ $item->JumlahPakai }}</td>
                            <td class="px-4 py-3">
                                <button type="submit" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-green-500 dark:hover:text-green-400 rounded-2xl">
                                    <a href="{{ route('pembayaran.showFormBayar', $item->id) }}">Bayar</a>
                                </button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data pemakaian yang belum lunas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <nav class="md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                {{ $pemakaian->links() }}
            </nav>
        </div>
    </div>
</section>
