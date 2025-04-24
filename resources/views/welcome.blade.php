<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Electricity Payment</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <link rel="icon" href="{{ asset('electricity.svg') }}" type="image/svg+xml">
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        {{-- Login Button --}}
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            <ul class="flex gap-3 text-sm leading-normal">
                <li>
                    <a href="/login" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                        Login
                    </a>
                </li>
            </ul>
        </header>
        {{-- Content --}}
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow not-visited:starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <h1 class="mb-1 font-bold text-lg">Selamat datang di website pembayaran listrik kami!!!</h1>
                    <p class="mb-4 text-[#706f6c] dark:text-[#A1A09A]">Silahkan masukkan nomor kontrol untuk melihat pemakaian listrik, jika tidak ada berarti anda belum terdaftar</p>

                    {{-- Search --}}
                    <form action="{{ route('search.pemakaian') }}" method="GET" class="max-w-md mx-auto">   
                        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="search" name="search" autocomplete="off" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500" placeholder="Masukkan Nomor Kontrol" required />
                            <ul id="dropdown-results" class="absolute z-10 w-full text-gray-900 border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 rounded mt-1 hidden"></ul>
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>

    </body>

    {{-- Hasil --}}
    @if(isset($message))
        <p class="text-center text-red-500 mt-4">{{ $message }}</p>
    @endif

    @if(isset($pelanggan))
        <div class="text-center mt-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Pemakaian untuk : {{ $pelanggan->Nama }}</h2>
        </div>
    @endif
    {{-- Tabel Hasil search --}}
    @if(isset($pemakaian) && $pemakaian->count())
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                    <tr>
                        <th class="px-4 py-2">Bulan</th>
                        <th class="px-4 py-2">Tahun</th>
                        <th class="px-4 py-2">Meter Awal</th>
                        <th class="px-4 py-2">Meter Akhir</th>
                        <th class="px-4 py-2">Biaya Pemakaian</th>
                        <th class="px-4 py-2">Jumlah Pakai</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemakaian as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-gray-900 dark:text-gray-300">
                            <td class="px-4 py-2">{{ $item->nama_bulan }}</td>
                            <td class="px-4 py-2">{{ $item->Tahun }}</td>
                            <td class="px-4 py-2">{{ $item->MeterAwal }}</td>
                            <td class="px-4 py-2">{{ $item->MeterAkhir }}</td>
                            <td class="px-4 py-2">{{ number_format($item->BiayaPemakaian, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ number_format($item->JumlahPakai, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <span class="{{ $item->Status == 'Lunas' ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $item->Status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</html>


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
    