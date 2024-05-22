<x-header></x-header>
    <div class="min-h-full">
    <x-navbar></x-navbar>
    {{-- <x-header>{{ $title }}</x-header> --}}
    <main class="text-white mx-auto max-w-[1440px]">
        {{ $slot }}
    </main>
    </div>
    <x-footer></x-footer>
    </body>
</html>
