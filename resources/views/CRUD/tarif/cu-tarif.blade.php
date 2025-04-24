{{-- From Create dan Update Tarif --}}

<x-layout></x-layout>

<section class="bg-white py-8 antialiased dark:bg-gray-900 h-screen md:py-16 flex justify-center">
    <div class="p-4 bg-white rounded-lg shadow border border-gray-600 dark:bg-gray-800 sm:p-5 max-w-3xl h-fit w-full">
        {{-- Header --}}
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $tarif->exists ? 'Edit Tarif' : 'Tambah Tarif' }}</h1>
        </div>

        <form action="{{ $tarif->exists ? route('tarif.update', $tarif->JenisPelanggan) : route('tarif.store') }}" method="POST">
            @csrf
            @if ($tarif->exists)
                @method('PUT')
            @endif

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- Jenis Pelanggan --}}
                <div>
                    <label 
                        for="JenisPelanggan" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Jenis Pelanggan
                    </label>
                    <input 
                        type="text" 
                        id="JenisPelanggan" 
                        name="JenisPelanggan" 
                        value="{{ old('JenisPelanggan', $tarif->JenisPelanggan) }}" {{ $tarif->exists ? 'readonly' : '' }} 
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    >
                </div>
                {{-- Biaya Beban --}}
                <div>
                    <label 
                        for="BiayaBeban" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Biaya Beban
                    </label>
                    <input 
                        type="number" 
                        step="0.01" 
                        id="BiayaBeban" 
                        name="BiayaBeban" 
                        value="{{ old('BiayaBeban', $tarif->BiayaBeban) }}" 
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    >
                </div>
                {{-- Tarif per KWH --}}
                <div>
                    <label 
                        for="TarifKWH" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Tarif KWH
                    </label>
                    <input 
                        type="number" 
                        step="0.01" 
                        id="TarifKWH" 
                        name="TarifKWH" 
                        value="{{ old('TarifKWH', $tarif->TarifKWH) }}" 
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    >
                </div>
            </div>

            {{-- Button --}}
            <div class=" flex justify-between ">
                {{-- Batal --}}
                <a 
                    href="{{ route('tarif.index') }}" 
                    class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    >Kembali
                </a>
                {{-- Konfirmasi --}}
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                    {{ $tarif->exists ? 'Update' : 'Simpan' }} Data Pelanggan</button>
            </div>
        </form>
    </div>
</section>