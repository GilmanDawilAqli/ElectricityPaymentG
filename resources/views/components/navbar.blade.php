{{-- Navbar --}}

<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <a href="/home" class="shrink-0">
          <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path class=" fill-amber-300" fill="currentColor" d="m11 14.5l-5.925-.75q-.625-.075-.813-.675t.263-1.025l10.225-9.8q.125-.125.3-.187T15.525 2q.5 0 .763.425t.012.875L13 9.5l5.925.75q.625.075.813.675t-.263 1.025L9.25 21.75q-.125.125-.3.188T8.475 22q-.5 0-.763-.425T7.7 20.7z"/></svg>
        </a>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <x-nav-link href="/home" :active="request()->is('home')">Home</x-nav-link>
            <x-nav-link href="/pembayaran" :active="request()->is('pembayaran')">Pembayaran</x-nav-link>
            <x-nav-link href="/pelanggan" :active="request()->is('pelanggan')">Pelanggan</x-nav-link>
            <x-nav-link href="/pemakaian" :active="request()->is('pemakaian')">Pemakaian</x-nav-link>

            @if(Auth::user()->admin)
              <x-nav-link href="/petugas" :active="request()->is('petugas')">Petugas</x-nav-link>
              <x-nav-link href="/tarif" :active="request()->is('tarif')">Tarif</x-nav-link>
              <x-nav-link href="/laporan" :active="request()->is('laporan')">Laporan</x-nav-link>
            @endif
          </div>
        </div>
      </div>
      <div class="hidden md:block text-gray-100">
        @if(Auth::user()->admin)
        Admin
        @else
          Petugas
        @endif
      </div>
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          <form class="relative ml-3" method="POST" action="{{ route('logout') }}">
            @csrf
              <button href="/" type="submit" class="block px-4 py-2 text-sm text-gray-100 hover:cursor-pointer hover:text-red-500" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>