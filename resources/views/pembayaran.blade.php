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
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
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
                        @foreach ($pembayaran as $data)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-3">{{ $data->id }}</td>
                            <td class="px-4 py-3">{{ $data->TahunTagihan }}</td>
                            <td class="px-4 py-3">{{ $data->BulanTagihan }}</td>
                            <td class="px-4 py-3">{{ $data->NoKontrol }}</td>
                            <td class="px-4 py-3">{{ $pelanggan->NamaPelanggan }}</td>
                            <td class="px-4 py-3">{{ $data->MeterAwal }}</td>
                            <td class="px-4 py-3">{{ $data->MeterAkhir }}</td>
                            <td class="px-4 py-3">{{ $data->BiayaBeban }}</td>
                            <td class="px-4 py-3">{{ $data->MeterAkhir - $data->MeterAwal }}</td>
                            <td class="px-4 py-3">{{ $data->JumlahTagihan }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('pembayaran.bayar', $data->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                {{-- pagination --}}
            </nav>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("NoKontrol");
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
                    li.textContent = `${item.NoKontrol} - ${item.NamaPelanggan}`;
                    li.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer dark:hover:bg-blue-700 dark:text-white";

                    li.addEventListener("click", function () {
                        input.value = item.NoKontrol;
                        dropdown.classList.add("hidden");
                        dropdown.innerHTML = '';

                        // Populate additional fields if needed
                        document.getElementById("nama_pelanggan").value = item.NamaPelanggan;
                        document.getElementById("alamat_pelanggan").value = item.Alamat;
                    });

                    dropdown.appendChild(li);
                });

                dropdown.classList.remove("hidden");
            })
            .catch(error => {
                console.error('Error fetching data:', error);
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