
<nav x-data="{ open: false }" >
@if(Auth::user() && !Auth::user()->email_verified_at)
    <div class="bg-orange-400 py-2 px-8 text-center flex justify-center">
        <p>Cek Email kamu untuk melakukan verifikasi! atau 
            <form action="/email/verification-notification" method="post">
                @csrf
                <button class="px-2 underline">kirim ulang link verifikasi</button>
            </form>
        </p>
    </div>
@endif
<div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-10">
    <div class="flex h-20 items-center justify-between">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <h1 class="brand-title">
                    SADATI
                </h1> 
            </div>
            <div class="hidden lgm:block">
            <div class="ml-10 flex items-baseline space-x-4">
                <x-navlink href='/' :url="request()->is('/')">Beranda</x-navlink>
                <x-navlink href='booking' :url="request()->is('booking')">Booking</x-navlink>
                <x-navlink href='packages' :url="request()->is('packages')">Harga & Paket</x-navlink>
                <x-navlink href='about-us' :url="request()->is('about-us')">Tentang Kami</x-navlink>
            </div>
            </div>
        </div>
        @if(Auth::user())
            <div class="hidden lgm:block">
                <div class="ml-4 flex items-center lgm:ml-6">
                    <!-- Profile dropdown -->
                    <div x-on:click="open =! open" class="relative ml-3">
                        <div>
                        <button type="button" class="relative flex max-w-xs items-center rounded-full text-sm" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <p class="text-base font-medium leading-none text-black">{{ Auth::user()->name }}</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgb(29, 29, 29);transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
                        </button>
                        </div>
                        <div x-show='open' @click.outside="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white p-2 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-cloak>
                            @can('authNoAdmin')
                                @if(Auth::user()->email_verified_at)
                                    <a href="user/{{ Auth::user()->id }}" class="navlink-btn text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-1"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ><path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"></path><path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"></path></svg> Edit Profil</a>
                                @endif
                            @endcan
                            <form action="logout" method="POST">
                                @csrf
                                <button class="w-full navlink-btn hover:bg-red-100 text-red-500 fill-red-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path><path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path></svg> Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="gap-5 items-center hidden lgm:flex">
                <a href="register" class="text-sm hover:underline">REGISTER</a>
                <a href="login" class="text-sm bg-black border border-black text-white px-7 py-1 hover:bg-[#F0F0F0] hover:text-black">LOGIN</a>
            </div>
        @endif
        <div @click="open =! open" class="-mr-2 flex lgm:hidden">
            <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-200 p-2 text-gray-400 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
                <span class="bg-black w-5 h-5"></span>
            </button>
        </div>
    </div>
</div>

<div :class="{ 'block' : open, ' hidden' : !open}" class="lgm:hidden" id="mobile-menu">
    <div class="px-2 pb-3 pt-2 sm:px-3">
        <x-navlink href='/' :url="request()->is('/')">Home</x-navlink>
        <x-navlink href='booking' :url="request()->is('booking')">Booking</x-navlink>
        <x-navlink href='packages' :url="request()->is('packages')">Harga & Paket</x-navlink>
        <x-navlink href='about-us' :url="request()->is('about-us')">Tentang Kami</x-navlink>
    </div>
    @if (Auth::user())
    <div class="p-3">
        <h3 class="border-y border-gray-300 font-semibold py-2 text-center text-black">{{ Auth::user()->name }}</h3>
        <div class="pt-5 text-center">
            <a href="#" class="navlink-user">Profil</a>
            <form action="logout" method="POST" class="inline-block">
                @csrf
                <button class="navlink-user text-red-500">logout</button>
            </form>
        </div>
    </div>
    @else
        <div class="flex gap-5 items-center max-lgm:border-t p-6 justify-center">
            <a href="register" class="text-sm hover:underline">REGISTER</a>
            <a href="login" class="text-sm bg-black border border-black text-white px-4 py-1 hover:bg-[#F0F0F0] hover:text-black">LOGIN</a>
        </div>
    @endif
</div>
</nav>