<x-user.header></x-user.header>
<section class="flex h-lvh" x-data="{ open: false}">
    <span class="bg-[#0000003d] absolute top-0 left-0 bottom-0 right-0 hidden lgm:hidden backlayer"></span>
    <nav class="bg-white py-8 px-5 max-lgm:absolute w-80 border border-gray-300 shadow-sm h-full hidden md:block navbar">
        <h1 class="brand-title text-center">SADATI</h1>
        <ul>
            <li class="font-semibold mt-4 cursor-pointer">
                <x-admin.admin-navlink class='flex items-center justify-between py-2 px-3 rounded-sm' :url="request()->is('admin/confirm') || request()->is('admin/confirmed') || request()->is('admin/history')" x-on:click="open = !open">
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24" fill="currentColor"><path d="M6.012 18H21V4c0-1.103-.897-2-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.806 5 19s.55-.988 1.012-1zM8 9h3V6h2v3h3v2h-3v3h-2v-3H8V9z"></path></svg>
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
                    <x-admin.admin-navlink class="py-2 px-3 rounded-sm" :url="request()->is('admin/history')">
                        <a class="text-sm px-9" href='/admin/history'>Riwayat</a>
                    </x-admin.admin-navlink>
                </div>
            </li>
            <li class="font-semibold mt-4 cursor-pointer">
                <x-admin.admin-navlink class='flex items-center justify-between py-2 px-3 rounded-sm' :url="request()->is('admin/packages') || request()->is('admin/packages/create')">
                    <a class="flex gap-2 items-center" href='/admin/packages'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7" viewBox="0 0 24 24" fill='currentColor'><path d="M21.993 7.95a.96.96 0 0 0-.029-.214c-.007-.025-.021-.049-.03-.074-.021-.057-.04-.113-.07-.165-.016-.027-.038-.049-.057-.075-.032-.045-.063-.091-.102-.13-.023-.022-.053-.04-.078-.061-.039-.032-.075-.067-.12-.094-.004-.003-.009-.003-.014-.006l-.008-.006-8.979-4.99a1.002 1.002 0 0 0-.97-.001l-9.021 4.99c-.003.003-.006.007-.011.01l-.01.004c-.035.02-.061.049-.094.073-.036.027-.074.051-.106.082-.03.031-.053.067-.079.102-.027.035-.057.066-.079.104-.026.043-.04.092-.059.139-.014.033-.032.064-.041.1a.975.975 0 0 0-.029.21c-.001.017-.007.032-.007.05V16c0 .363.197.698.515.874l8.978 4.987.001.001.002.001.02.011c.043.024.09.037.135.054.032.013.063.03.097.039a1.013 1.013 0 0 0 .506 0c.033-.009.064-.026.097-.039.045-.017.092-.029.135-.054l.02-.011.002-.001.001-.001 8.978-4.987c.316-.176.513-.511.513-.874V7.998c0-.017-.006-.031-.007-.048zm-10.021 3.922L5.058 8.005 7.82 6.477l6.834 3.905-2.682 1.49zm.048-7.719L18.941 8l-2.244 1.247-6.83-3.903 2.153-1.191zM13 19.301l.002-5.679L16 11.944V15l2-1v-3.175l2-1.119v5.705l-7 3.89z"></path></svg>
                        Paket & Harga
                    </a>
                </x-admin.admin-navlink>
            </li>
        </ul>
    </nav>
    <main class="px-5 w-full overflow-y-scroll">
        <section class="mx-auto lgm:max-w-4xl">
            <div class="my-9 flex justify-between items-center" x-data="{open: false}">
                <p class="bg-black w-5 h-5 lgm:hidden cursor-pointer btn-nav"></p>
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
    <script>
        const backlayer = document.querySelector('.backlayer');
        const sidebar = document.querySelector('.navbar');
        const btn = document.querySelector('.btn-nav');

        btn.addEventListener('click', () => doToggle())
        backlayer.addEventListener("click", () => doToggle())
        
        function doToggle(){
            sidebar.classList.toggle('hidden');
            backlayer.classList.toggle('hidden');
        }
    </script>
</section>