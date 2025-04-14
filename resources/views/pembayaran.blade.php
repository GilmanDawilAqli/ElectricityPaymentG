<x-layout></x-layout>
<section class="bg-white py-8 antialiased dark:bg-gray-900 h-screen md:py-16">

    <form class="max-w-md mx-auto">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 " placeholder="Masukkan Nomor Kontrol" required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mx-auto max-w-5xl">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Payment</h2>
  
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
          <form action="#" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">
            <div class="mb-6 grid grid-cols-2 gap-4">
              <div class="col-span-2 sm:col-span-1">
                <label for="full_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nmama Pelanggan</label>
                <input type="text" id="full_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="Bonnie Green" required />
              </div>
  
              <div class="col-span-2 sm:col-span-1">
                <label for="card-number-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Alamat Pelanggan</label>
                <input type="text" id="card-number-input" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pe-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500  dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" placeholder="xxxx-xxxx-xxxx-xxxx" pattern="^4[0-9]{12}(?:[0-9]{3})?$" required />
              </div>
            </div>
  
            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4  focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proses</button>
          </form>
  
          <div class="mt-6 grow sm:mt-8 lg:mt-0">
            <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
              <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">No Kontrol</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">65900</dd>
                </dl>
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Nama</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">Tes</dd>
                </dl>
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tarif/Daya</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">1</dd>
                </dl>
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Bulan/Tahun</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">Nov2025</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Meteran Awal</dt>
                  <dd class="text-base font-medium text-green-500">kwh</dd>
                </dl>
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Meteran Akhir</dt>
                  <dd class="text-base font-medium text-green-500">kwh</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah Pakai</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">99</dd>
                </dl>
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah Biaya Beban Pemakai</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">99</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Pemakaian</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                </dl>
              </div>
  
              <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-gray-900 dark:text-white">$7,191.00</dd>
              </dl>
            </div>

            <button class="flex mt-2 w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4  focus:ring-blue-300 dark:bg-blue dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cetak</button>
  
          </div>
        </div>
      </div>
    </div>
</section>
