<x-layout></x-layout>

<section class="bg-gray-50 dark:bg-gray-900 p-3 h-screen sm:p-5">
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
                <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    {{-- Filter Berdasarkan Status --}}
                    <form method="GET" action="{{ route('laporan.index') }}" class="">
                        <div class="form-group">
                            <label 
                                for="status" 
                                class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white rounded-lg md:w-auto focus:outline-none dark:bg-gray-800 dark:text-gray-400"
                                    >Filter Status :
                            </label>
                            <select name="status" id="status" class="items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" onchange="this.form.submit()">
                                <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
                                <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                <option value="Belum Lunas" {{ request('status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            </select>
                        </div>
                    </form>

                    {{-- Tombol Generate Semua Laporan --}}
                    <div>
                        @if(request('status'))
                        <a href="{{ route('laporan.generateAll', ['status' => request('status')]) }}"
                           class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Generate Semua {{ request('status') }}
                        </a>
                        @else
                            <button disabled
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed">
                                Pilih Status untuk Generate Semua
                            </button>
                        @endif                    
                    </div>
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
                            <th scope="col" class="px-4 py-3">Status</th>
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
                                @if ($item->Status == 'Lunas')
                                    <span class="text-green-500 font-semibold">{{ $item->Status }}</span>
                                @else
                                    <span class="text-red-500 font-semibold">{{ $item->Status }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <button type="submit" class="flex w-full items-center py-1.5 px-2 hover:bg-gray-100 dark:hover:bg-gray-600 text-blue-500 dark:hover:text-blue-400 rounded-2xl">
                                    @if($item->Status === 'Lunas')
                                        <a href="{{ route('laporan.generateLunas', $item->id) }}" class="flex w-full items-center py-1 px-1.5 hover:bg-gray-100 dark:hover:bg-gray-600 text-blue-500 dark:hover:text-blue-400 rounded-2xl">
                                            Generate Laporan
                                        </a>
                                    @elseif($item->Status === 'Belum Lunas')
                                        <a href="{{ route('laporan.generateBelumLunas', $item->id) }}" class="flex w-full items-center py-1 px-1.5 hover:bg-gray-100 dark:hover:bg-gray-600 text-blue-500 dark:hover:text-blue-400 rounded-2xl">
                                            Generate Laporan
                                        </a>
                                    @endif
                                </button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data pemakaian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                {{-- pagination --}}
            </nav>
        </div>
    </div>
</section>