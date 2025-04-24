{{-- Halaman Home --}}

<x-layout></x-layout>
<section class="bg-gray-50 h-screen py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Category</h2>

        </div>
    
        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            {{-- User biasa/Petugas --}}

                {{-- Pembayaran --}}
                <a 
                    href="/pembayaran" 
                    class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-6 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <svg class="me-2 size-6 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2m-1 14H5c-.55 0-1-.45-1-1v-5h16v5c0 .55-.45 1-1 1m1-10H4V7c0-.55.45-1 1-1h14c.55 0 1 .45 1 1z"/></svg>
                    <span class="text-lg font-medium text-gray-900 dark:text-white">Pembayaran Listrik</span>
                </a>
                {{-- Pelanggan --}}
                <a 
                    href="/pelanggan" 
                    class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-6 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <svg class="me-2 size-6 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"/></svg>
                    <span class="text-lg font-medium text-gray-900 dark:text-white">Pelanggan</span>
                </a>
                {{-- Pemakaian --}}
                <a 
                    href="pemakaian" 
                    class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-6 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <svg class="me-2 size-6 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4 2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h5.476c.152-.501.426-.958.798-1.33l1.845-1.846A.5.5 0 0 1 12 12.5v-7a.5.5 0 0 1 1 0v6.444l2.103-2.103c.266-.266.571-.47.897-.609V4a2 2 0 0 0-2-2zm5 7a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 9 9M5 7.5a.5.5 0 0 1 1 0v5a.5.5 0 0 1-1 0zm5.98 7.877l4.83-4.83a1.87 1.87 0 1 1 2.645 2.646l-4.83 4.829a2.2 2.2 0 0 1-1.02.578l-1.498.374a.89.89 0 0 1-1.079-1.078l.375-1.498a2.2 2.2 0 0 1 .578-1.02"/></svg>
                    <span class="text-lg font-medium text-gray-900 dark:text-white">Pemakaian</span>
                </a>
            {{-- Atmin --}}
                @if(Auth::user()->admin)
                    {{-- Petugas --}}
                    <a 
                        href="petugas" 
                        class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-6 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    >
                        <svg class="me-2 size-6 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M28.523 23.813c-.518-.51-6.795-2.938-7.934-3.396c-1.133-.45-1.585-1.697-1.585-1.697s-.51.282-.51-.51c0-.793.51.51 1.02-2.548c0 0 1.415-.397 1.134-3.68h-.34s.85-3.51 0-4.698c-.853-1.188-1.187-1.98-3.06-2.548c-1.87-.567-1.19-.454-2.548-.396c-1.36.057-2.492.793-2.492 1.188c0 0-.85.057-1.188.397c-.34.34-.906 1.924-.906 2.32s.283 3.06.566 3.624l-.337.11c-.283 3.284 1.132 3.682 1.132 3.682c.51 3.058 1.02 1.755 1.02 2.548c0 .792-.51.51-.51.51s-.453 1.246-1.585 1.697c-1.132.453-7.416 2.887-7.927 3.396c-.51.52-.453 2.896-.453 2.896h26.954s.063-2.378-.453-2.897zm-6.335 2.25h-4.562v-1.25h4.562z"/></svg>
                        <span class="text-lg font-medium text-gray-900 dark:text-white">Petugas</span>
                    </a>
                    {{-- Tarif --}}
                    <a 
                        href="tarif" 
                        class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-6 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    >
                        <svg class="me-2 size-6 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-width="2" d="M16 16c0-1.105-3.134-2-7-2s-7 .895-7 2s3.134 2 7 2s7-.895 7-2ZM2 16v4.937C2 22.077 5.134 23 9 23s7-.924 7-2.063V16M9 5c-4.418 0-8 .895-8 2s3.582 2 8 2M1 7v5c0 1.013 3.582 2 8 2M23 4c0-1.105-3.1-2-6.923-2s-6.923.895-6.923 2s3.1 2 6.923 2S23 5.105 23 4Zm-7 12c3.824 0 7-.987 7-2V4M9.154 4v10.166M9 9c0 1.013 3.253 2 7.077 2S23 10.013 23 9"/></svg>
                        <span class="text-lg font-medium text-gray-900 dark:text-white">Tarif</span>
                    </a>
                    {{-- Laporan --}}
                    <a 
                        href="laporan" 
                        class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-6 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                    >
                        <svg class="me-2 stroke-2 size-6 shrink-0 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd" d="M3.5 1.5v13h5.75a.75.75 0 0 1 0 1.5H3a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h6.644a1 1 0 0 1 .72.305l3.355 3.476a1 1 0 0 1 .281.695V6.25a.75.75 0 0 1-1.5 0V6H9.75A1.75 1.75 0 0 1 8 4.25V1.5zm6 .07l2.828 2.93H9.75a.25.25 0 0 1-.25-.25zM13 15a.75.75 0 0 1-.75-.75v-1.5h-1.5a.75.75 0 0 1 0-1.5h1.5v-1.5a.75.75 0 0 1 1.5 0v1.5h1.5a.75.75 0 0 1 0 1.5h-1.5v1.5A.75.75 0 0 1 13 15" clip-rule="evenodd"/></svg> 
                            <span 
                                class="text-lg font-medium text-gray-900 dark:text-white"
                                >Laporan</span
                            >
                    </a>
                @endif
        </div>
    </div>
</section>