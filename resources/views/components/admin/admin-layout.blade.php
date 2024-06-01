<x-user.header></x-user.header>
<section class="flex h-lvh" x-data="{ open: false, sidebar: false }">
    <span x-show="sidebar" x-on:click="sidebar = false" class="bg-[#0000003d] absolute top-0 left-0 bottom-0 right-0 lgm:hidden"></span>
    <nav class="bg-white py-8 px-5 max-lgm:absolute w-80 border border-gray-300 shadow-sm" :class=" sidebar ? 'h-full' : 'max-lgm:-translate-x-full'">
        <h1 class="brand-title text-center">SADATI</h1>
        <ul>
            <li class="font-semibold mt-4 cursor-pointer">
                <x-admin.admin-navlink class='flex items-center justify-between py-2 px-3 rounded-sm' :url="request()->is('admin/confirm') || request()->is('admin/confirmed')" x-on:click="open = !open">
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill='currentColor' class="w-7"><path d="M3 8v11c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.806 5 19c0-.101.009-.191.024-.273.112-.576.584-.717.988-.727H21V4c0-1.103-.897-2-2-2H6c-1.206 0-3 .799-3 3v3zm3-4h13v12H5V5c0-.806.55-.988 1-1z"></path><path d="M11 14h2v-3h3V9h-3V6h-2v3H8v2h3z"></path></svg>
                        Booking
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill='currentColor' style="transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
                </x-admin.admin-navlink>
                
                <div class="mt-2 text-gray-600 font-light" x-show="open" x-cloak>
                    <x-admin.admin-navlink class="py-2 px-3 rounded-sm" :url="request()->is('admin/confirm')">
                        <a class="text-sm px-9"  href='/admin/confirm'>Butuh Konfirmasi</a>
                    </x-admin.admin-navlink>
                    <x-admin.admin-navlink class="py-2 px-3 rounded-sm" :url="request()->is('admin/confirmed')">
                        <a class="text-sm px-9" href='/admin/confirmed'>Terkonfirmasi</a>
                    </x-admin.admin-navlink>
                </div>
            </li>
            <li class="flex gap-2 items-center font-semibold mt-2 cursor-pointer hover:bg-gray-100 py-2 px-3 rounded-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-black w-7"><path d="M20 2H8c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM8 16V4h12l.002 12H8z"></path><path d="M4 8H2v12c0 1.103.897 2 2 2h12v-2H4V8z"></path><path d="m12 12-1-1-2 3h10l-4-6z"></path></svg>
                Galeri
            </li>
        </ul>
    </nav>
    <main class="px-5 w-full overflow-y-scroll">
        <section class="mx-auto lgm:max-w-4xl">
            <div class="my-9 flex justify-between items-center" x-data="{open: false}">
                <p class="bg-black w-5 h-5 lgm:hidden cursor-pointer" x-on:click='sidebar = !open'></p>
            <h1 class="font-mohave font-semibold">{{ $title }}</h1>
            <div class="relative">
                <div x-on:click="open = !open" class="flex gap-2 items-center cursor-pointer">
                    <h3>Admin</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgb(29, 29, 29);transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
                </div>
                    
                <div class="bg-white px-2 border border-gray-300 absolute -left-6 top-8" x-show="open" x-on:click.outside="open = false" x-cloak>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="block px-4 py-2 text-sm text-gray-700">logout</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="mt-16">
                {{ $slot }}
            </div>
        </section>
    </main>
</section>