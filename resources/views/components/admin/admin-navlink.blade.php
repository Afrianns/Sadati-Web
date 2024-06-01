@php
    $class = ($url) ? ' bg-[#fc6f53] text-white' : 'bg-white hover:bg-gray-100';
@endphp

<div {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</div>