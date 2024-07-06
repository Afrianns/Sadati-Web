<x-user.layout>
    <x-header-page></x-header-page>
    <h1 class="font-Mohave text-4xl font-bold uppercase py-10 text-center">PAKET PREWEDDING</h1>
    <div class="grid lgm:grid-cols-2 lg:grid-cols-4 gap-5 text-black justify-center mx-5">
        
        @foreach ($packages as $package)
            @if($package->category == "prewedding")  
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    @if($package->sub_type)
                        <p class="text-white font-light text-xs bg-secondary py-1 px-2">{{ $package->sub_type }}</li>
                    @endif
                    <h2 class="font-bold font-Mohave text-secondary text-2xl uppercase">{{ $package->type }}</h2>
                    <span class="text-gray-500">IDR {{ $package->price }}</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">
                        @foreach (json_decode($package->description) as $description)
                        <li>
                            {{ $description }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <div class="mx-10 flex flex-col justify-center items-center my-10">
        <h1 class="font-Mohave text-4xl font-bold uppercase mb-7 text-black">PAKET WEDDING</h1>
        <div class="grid md:grid-cols-2 lgm:grid-cols-3 gap-5 text-black">
            @foreach ($packages as $package)
            @if($package->category == "wedding")  
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                @if($package->sub_type)
                    <p class="text-white font-light text-xs bg-secondary py-1 px-2">{{ $package->sub_type }}</li>
                @endif
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl uppercase">{{ $package->type }}</h2>
                    <span class="text-gray-500">IDR {{ $package->price }}</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">
                        @foreach (json_decode($package->description) as $description)
                        <li>
                            {{ $description }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        @endforeach
        </div>
    </div>
    <div class="mx-10  flex flex-col justify-center items-center my-10">
        <h1 class="font-Mohave text-4xl font-bold uppercase mb-7 text-black">PAKET LAINNYA</h1>
        <div class="grid lgm:grid-cols-3 gap-5 text-black">
            @foreach ($packages as $package)
            @if($package->category == "lain-lain")  
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                @if($package->sub_type)
                    <p class="text-white font-light text-xs bg-secondary py-1 px-2">{{ $package->sub_type }}</li>
                @endif
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl uppercase">{{ $package->type }}</h2>
                    <span class="text-gray-500">IDR {{ $package->price }}</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">
                        @foreach (json_decode($package->description) as $description)
                        <li>
                            {{ $description }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        @endforeach
        </div>
    </div>

</x-user.layout>