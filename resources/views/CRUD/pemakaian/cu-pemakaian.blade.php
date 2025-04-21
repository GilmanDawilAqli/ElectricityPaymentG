<x-layout></x-layout>


<section class="bg-white py-8 antialiased dark:bg-gray-900 h-screen md:py-16 flex justify-center mb-4">
    <div class="p-4 bg-white rounded-lg shadow border border-gray-600 dark:bg-gray-800 sm:p-5 max-w-3xl h-fit w-full">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 border-gray-600">
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Data Pemakaian</h1>
        </div>

        <form action="{{ route('pemakaian.store') }}" method="POST">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- No Kontrol --}}
                <div>
                    <label 
                        for="NoKontrol" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >No Kontrol
                        </label>
                    <input 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        type="text" 
                        id="NoKontrolSearch" 
                        autocomplete="off"
                    >
                    <ul 
                        id="dropdown-results" 
                        class="absolute z-10 w-fit bg-white border border-gray-300 rounded-md mt-1 hidden max-h-60 overflow-auto shadow-lg dark:bg-gray-800 dark:border-gray-600">
                    </ul>
                </div>
                {{-- Nama --}}
                <div>
                    <label 
                        for="nama_pelanggan" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Nama Pelanggan
                    </label>
                    <input 
                        type="text" 
                        id="nama_pelanggan"
                        name="NamaPelanggan" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    >
                </div>
                {{-- Tahun --}}
                <div>
                    <label 
                        for="Tahun" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Tahun
                    </label>
                    <input 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        type="number"
                        min="1900" 
                        id="Tahun" 
                        name="Tahun" 
                        value="{{ old('Tahun', $tahunSekarang) }}" required>
                </div>
                {{-- Bulan --}}
                <div>
                    <label 
                        for="Bulan">
                        Bulan:</label
                    >
                    <select 
                        name="Bulan" 
                        id="Bulan" required 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($bulanList as $kode => $nama)
                            <option 
                                value="{{ $kode }}" {{ $kode == $bulanSekarang ? 'selected' : '' }}>{{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Meter Awal --}}
                <div>
                    <label 
                        for="MeterAwal" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Meter Awal</label
                    >
                    <input 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        type="number" 
                        id="MeterAwal"
                        name="MeterAwal"
                        value="{{ old('MeterAwal') }}" required readonly
                    >
                </div>
                {{-- Meter Akhir --}}
                <div>
                    <label 
                        for="MeterAkhir" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Meter Akhir</label
                    >
                    <input 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        type="number" 
                        id="MeterAkhir" 
                        name="MeterAkhir"
                        value="{{ old('MeterAkhir') }}" required
                    >
                </div>
                {{-- Biaya Beban Pemakaian --}}
                <div>
                    <label 
                        for="BiayaBebanPemakai" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Biaya Beban Pemakai</label
                    >
                    <input 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        id="BiayaBebanPemakai" 
                        name="BiayaBebanPemakai"
                        value="{{ old('BiayaBebanPemakai') }}" 
                        required readonly
                    >
                </div>
                {{-- Biaya Pemakaian --}}
                <div>
                    <label 
                        for="BiayaPemakaian" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Biaya Pemakaian</label
                    >
                    <input 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('BiayaPemakaian') }}" 
                        id="BiayaPemakaian" 
                        name="BiayaPemakaian"
                        type="number" required readonly
                    >
                </div>
                {{-- Jumlah Pakai --}}
                <div>
                    <label 
                        for="JumlahPakai" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jumlah Pakai</label
                    >
                    <input 
                        type="number" readonly 
                        id="JumlahPakai"
                        name="JumlahPakai"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                </div>
            </div>
            
            {{-- action button --}}
            <div class="flex items-center justify-between space-x-4">
                <a 
                    href="{{ route('pemakaian.index') }}" 
                    class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Kembali</a>
                <button 
                    type="submit" 
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="ml-1 size-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Tambah Data Pemakaian
                </button>
            </div>
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("NoKontrolSearch");
        const dropdown = document.getElementById("dropdown-results");

        input.addEventListener("input", function () {
            const query = this.value;

            if (query.length < 2) {
                dropdown.classList.add("hidden");
                dropdown.innerHTML = '';
                return;
            }

            fetch(`/search-nokontrol?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    dropdown.innerHTML = '';
                    if (data.length === 0) {
                        dropdown.classList.add("hidden");
                        return;
                    }

                    data.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item;
                        li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer dark:hover:bg-blue-700 dark:text-white";
                        li.addEventListener("click", function () {
                            input.value = item;
                            dropdown.classList.add("hidden");
                            dropdown.innerHTML = '';
                        });
                        dropdown.appendChild(li);
                    });

                    dropdown.classList.remove("hidden");
                });
        });

        document.addEventListener("click", function (e) {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    });
</script>