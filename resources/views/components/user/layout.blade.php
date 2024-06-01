<x-user.header></x-user.header>
    <div class="min-h-full">
    <x-user.navbar></x-user.navbar>
    <main class="text-white mx-auto max-w-[1440px]">
        {{ $slot }}
    </main>
    </div>
    <x-user.footer></x-user.footer>
    </body>
</html>
