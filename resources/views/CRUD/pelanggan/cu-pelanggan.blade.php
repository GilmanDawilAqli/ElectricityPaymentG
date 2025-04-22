<x-layout></x-layout>

<section class="bg-white py-8 antialiased dark:bg-gray-900 h-screen md:py-16 flex justify-center">
    <div class="p-4 bg-white rounded-lg shadow border border-gray-600 dark:bg-gray-800 sm:p-5 max-w-3xl h-fit w-full">
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ isset($pelanggan) ? 'Edit Data Pelanggan' : 'Tambah Data Pelanggan' }}</h1>
        </div>
        
        <form action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->NoKontrol) : route('pelanggan.store') }}" method="POST">
            @csrf
            @if (isset($pelanggan))
                @method('PUT')
            @endif
            
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- No Kontrol --}}
                <div class="mb-3">
                    <label 
                        for="NoKontrol" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >No Kontrol
                    </label>
                    <input 
                        type="number" 
                        name="NoKontrol" 
                        id="NoKontrol"  required 
                        minlength="12" maxlength="12" pattern="\d{12}" 
                        title="No Kontrol harus 12 digit angka."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $pelanggan->NoKontrol ?? $generatedNoKontrol ?? old('NoKontrol') }}" 
                        {{ isset($pelanggan) ? 'readonly' : 'readonly' }}>
                </div>
                {{-- Nama --}}
                <div class="mb-3">
                    <label for="Nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" name="Nama" id="Nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $pelanggan->Nama ?? old('Nama') }}" required>
                </div>
                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" name="Alamat" id="Alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $pelanggan->Alamat ?? old('Alamat') }}" required>
                </div>
                {{-- No Telepon --}}
                <div class="mb-3">
                    <label 
                        for="Telepon" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Telepon
                    </label>
                    <input 
                        type="text" 
                        name="Telepon" 
                        id="Telepon" 
                        maxlength="15" required
                        title="No Telepon maksimal 15 digit angka."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        value="{{ $pelanggan->Telepon ?? old('Telepon') }}" 
                    >
                </div>
                {{-- Jenis Pelanggan --}}
                <div class="mb-3">
                    <label 
                        for="JenisPelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jenis Pelanggan</label>
                        <select name="JenisPelanggan" id="JenisPelanggan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="" disabled selected>Pilih Jenis Pelanggan</option>
                            @foreach ($tarif as $item)
                                <option value="{{ $item->JenisPelanggan }}" {{ (isset($pelanggan) && $pelanggan->JenisPelanggan == $item->JenisPelanggan) || old('JenisPelanggan') == $item->JenisPelanggan ? 'selected' : '' }}>
                                    {{ $item->JenisPelanggan }}
                                </option>
                            @endforeach
                        </select>
                </div>
            </div>

            <div class="flex items-center justify-between space-x-4">
                <a href="{{ route('pelanggan.index') }}" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Kembali</a>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >{{ isset($pelanggan) ? 'Update' : 'Simpan' }}
                    <svg class=" ml-1 size-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg></button>
            </div>
        </form>
    </div>
</section>

<script>
    document.getElementById('Telepon').addEventListener('input', function (e) {
        let value = e.target.value;

        // Hanya izinkan angka dan tanda +
        value = value.replace(/[^0-9+]/g, '');

        // Pastikan hanya satu tanda + di awal
        if (value.indexOf('+') > 0) {
            value = value.replace(/\+/g, '');
        } else if (value.indexOf('+') === 0) {
            value = '+' + value.slice(1).replace(/\+/g, '');
        }

        e.target.value = value;
    });
</script>