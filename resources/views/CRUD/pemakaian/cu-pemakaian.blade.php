<x-layout></x-layout>

<section class="bg-white py-8 antialiased dark:bg-gray-900 h-screen md:py-16 flex justify-center">
    <div class="p-4 bg-white rounded-lg shadow border border-gray-600 dark:bg-gray-800 sm:p-5 max-w-3xl h-fit w-full">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ isset($pemakaian) ? 'Edit Data Pemakaian' : 'Tambah Data Pemakaian' }}</h1>
        </div>

        <form action="{{ route('pemakaian.update', ['NoKontrol' => $pemakaian->NoKontrol]) }}" method="POST">
            @csrf
                @method('PUT')

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div class="mb-3">
                    <label for="NoKontrol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Kontrol</label>
                    <input type="text" id="no_kontrol" name="NoKontrol" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required name="NoKontrol" placeholder="Ketik No Kontrol">
                    {{-- <input type="hidden" name="NoKontrol" id="no_kontrol_hidden"> --}}
                </div>
                <div class="mb-3">
                    <label for="nama_pelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="NamaPelanggan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                </div>
                <div class="mb-3">
                    <label 
                        for="Tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tahun</label>
                    <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="Tahun" name="Tahun" 
                        value="{{ $pemakaian->Tahun ?? old('Tahun') }}" {{ isset($pemakaian) ? 'readonly' : '' }} required>
                </div>
                <div class="mb-3">
                    <label 
                        for="Bulan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan</label>
                    <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="Bulan" name="Bulan" 
                        value="{{ $pemakaian->Bulan ?? old('Bulan') }}" {{ isset($pemakaian) ? 'readonly' : '' }} required>
                </div>
                <div class="mb-3">
                    <label 
                        for="MeterAwal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meter Awal</label>
                    <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="MeterAwal" name="MeterAwal"
                        value="{{ old('MeterAwal', $pemakaian->MeterAwal) }}" required>
                </div>
                <div class="mb-3">
                    <label 
                        for="MeterAkhir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Meter Akhir</label>
                    <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="MeterAkhir" name="MeterAkhir"
                        value="{{ old('MeterAkhir', $pemakaian->MeterAkhir) }}" required>
                </div>
                <div class="mb-3">
                    <label 
                        for="biaya_beban" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Beban Pemakai</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="BiayaBebanPemakai" name="BiayaBebanPemakai"
                        value="{{ old('BiayaBebanPemakai', $pemakaian->BiayaBebanPemakai) }}"    id="biaya_beban" name="BiayaBebanPemakai" type="number" step="0.01">
                </div>
                <div class="mb-3">
                    <label 
                        for="BiayaPemakaian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Pemakaian</label>
                    <input type="number" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="BiayaPemakaian" name="BiayaPemakaian"
                        value="{{ old('BiayaPemakaian', $pemakaian->BiayaPemakaian) }}" required>
                </div>
                <div class="mb-3">
                    <label for="JumlahPakai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Pakai</label>
                    <input type="number" id="JumlahPakai" name="JumlahPakai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
                </div>
            </div>
            <div class="flex items-center justify-between space-x-4">
                <a href="{{ route('pemakaian.index') }}" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Kembali</a>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ isset($pemakaian) ? 'Update' : 'Simpan' }}
                    <svg class="ml-1 size-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg>
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

{{--  // Isi Biaya Beban Pemakai --}}


<script>
    $(document).ready(function () {
        $('#no_kontrol').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "{{ route('get.pelanggan') }}", // Endpoint untuk autocomplete
                    data: {
                        term: request.term // Data yang dikirim ke server
                    },
                    success: function (data) {
                        // Kembalikan hanya NoKontrol saja
                        response($.map(data, function (item) {
                            return {
                                label: item.NoKontrol,
                                value: item.NoKontrol
                            };
                        }));
                    }
                });
            },
            select: function (event, ui) {
                $('#no_kontrol').val(ui.item.value); // Isi input dengan NoKontrol yang dipilih
                
                // Ambil detail pelanggan berdasarkan NoKontrol
                $.get("{{ url('/get-detail-pelanggan') }}/" + ui.item.value, function (data) {
                    $('#nama_pelanggan').val(data.Nama); // Isi Nama Pelanggan
                });

                return false;
            }
        });
        $('#MeterAwal, #MeterAkhir').on('input', function () {
            const meterAwal = parseInt($('#MeterAwal').val()) || 0;
            const meterAkhir = parseInt($('#MeterAkhir').val()) || 0;

            if (meterAkhir >= meterAwal) {
                $('#JumlahPakai').val(meterAkhir - meterAwal);
            } else {
                $('#JumlahPakai').val(0);
            }
        });
    });
</script>