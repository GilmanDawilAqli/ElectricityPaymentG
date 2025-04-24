{{-- Form Create dan Update Petugas --}}

<x-layout></x-layout>

<section class="bg-white py-8 antialiased dark:bg-gray-900 h-screen md:py-16 flex justify-center">
    <div class="p-4 bg-white rounded-lg shadow border border-gray-600 dark:bg-gray-800 sm:p-5 max-w-3xl h-fit w-full">
        {{-- Header --}}
        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ isset($petuga) ? 'Edit Petugas' : 'Tambah Petugas' }}</h1>
        </div>

        <form action="{{ isset($petuga) ? route('petugas.update', $petuga->id) : route('petugas.store') }}" method="POST">
            @csrf
            @if (isset($petuga))
                @method('PUT')
            @endif

            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                {{-- Nama --}}
                <div>
                    <label 
                        for="name" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Nama
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $petuga->name ?? '') }}" 
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    >
                </div>
                {{-- Email --}}
                <div>
                    <label 
                        for="email" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $petuga->email ?? '') }}" 
                        required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    >
                </div>
                {{-- Role --}}
                <div>
                    <label 
                        for="admin" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Role
                    </label>
                    <select 
                        name="admin" 
                        id="admin" 
                        disabled 
                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed"
                    >
                        <option value="0" selected>Petugas</option>
                    </select>
                </div>
                {{-- Password --}}
                <div>
                    <label 
                        for="password" 
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Password {{ isset($petuga) ? '(Opsional)' : '' }}
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        {{ isset($petuga) ? '' : 'required' }}
                    >
                </div>
                {{-- Konfirmasi Password --}}
                <div>
                    <label 
                        for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                        {{ isset($petuga) ? '' : 'required' }}
                    >
                </div>
            </div>
            {{-- Button --}}
            <div class="flex items-center justify-between space-x-4">
                {{-- Batal --}}
                <a 
                    href="{{ route('petugas.index') }}" 
                    class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    >Kembali
                </a>
                {{-- Konfirmasi --}}
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 border dark:border-gray-400 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ isset($petuga) ? 'Simpan Perubahan' : 'Simpan' }}
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