<a {{ $attributes }}
  class="home-link w-fit"
>
  {{ $slot }}
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="transform: ;msFilter:;"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg>
</a>

{{-- <a href="#" class="home-link flex justify-center group relative w-fit">
    <span class="absolute z-20 text-white">
        {{ $slot }}
    </span>
    <span class="absolute w-full h-full left-0 top-0 bg-secondary transform scale-x-0 group-hover:scale-x-100 transition-transform group-hover:duration-1000 duration-500 origin-left"></span>
</a> --}}