{{-- Halaman Laporan --}}

<x-layout></x-layout>

<section class="bg-gray-50 dark:bg-gray-900 p-3 h-max sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            {{-- Filter & Generate PDF --}}
            <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    {{-- Search NoKontrol Filter --}}
                    <div class="flex items-center relative w-full">
                        <label for="NoKontrol" class="sr-only">Search</label>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="nokontrol" 
                            id="search" 
                            value="{{ request('nokontrol') }}"
                            placeholder="Cari No Kontrol"
                            autocomplete="off"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        >
                    </div>
                </div>
            
                <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    {{-- Filter Status Lunas/BelumLunas --}}
                    <select name="status" class="items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value=""> Status </option>
                        <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum Lunas" {{ request('status') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                    </select>
                    {{-- Filter Bulan --}}
                    <select name="bulan" class="items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="">Bulan</option>
                        @foreach([
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ] as $num => $bln)
                            <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>{{ $bln }}</option>
                        @endforeach
                    </select>
                    {{-- Filter Tahun --}}
                    <select name="tahun" class="items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="">Tahun</option>
                        @for($y = 2015; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    {{-- Button Filter --}}
                    <button type="submit" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none border dark:border-gray-600 dark:focus:ring-blue-800">
                        Filter
                    </button>
                    {{-- Button Download/Generate PDF --}}
                    <a href="{{ route('laporan.generate', request()->only(['status', 'tahun', 'bulan', 'nokontrol'])) }}"
                        class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none border dark:border-gray-600 dark:focus:ring-blue-800">
                         Download PDF
                     </a>
                </div>
            </form>

            {{-- Tabel data laporan --}}
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
                                <a href="{{ route('laporan.generateSatu', $item->id) }}" 
                                   class="flex w-full items-center py-1.5 px-2 hover:bg-gray-100 dark:hover:bg-gray-600 text-blue-500 dark:hover:text-blue-400 rounded-2xl">
                                    generate
                                </a>
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
            <nav class="md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                {{ $pemakaian->links() }}
            </nav>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("search");
        const dropdown = document.getElementById("dropdown-results");
    
        input.addEventListener("input", function () {
            const query = this.value.trim();
    
            if (query.length < 2) {
                dropdown.classList.add("hidden");
                dropdown.innerHTML = '';
                return;
            }
    
            fetch(`/search-nokontrol-pemakaian?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    dropdown.innerHTML = '';
                    if (data.length === 0) {
                        dropdown.classList.add("hidden");
                        return;
                    }
    
                    data.forEach(item => {
                        const li = document.createElement("li");
                        li.textContent = item;
                        li.className = "px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-700 cursor-pointer";
                        li.addEventListener("click", () => {
                            input.value = item;
                            dropdown.classList.add("hidden");
                            dropdown.innerHTML = '';
                            input.closest("form").submit(); // auto-submit form
                        });
                        dropdown.appendChild(li);
                    });
    
                    dropdown.classList.remove("hidden");
                })
                .catch(err => {
                    console.error("Dropdown search error:", err);
                    dropdown.classList.add("hidden");
                    dropdown.innerHTML = '';
                });
        });
    
        document.addEventListener("click", function (e) {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    });
</script>