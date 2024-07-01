<x-user.layout>
    <x-header-page></x-header-page>
    {{-- <div class="max-md:mx-0 mx-10 flex flex-col justify-center items-center mb-10 relative"> --}}
    <h1 class="font-Mohave text-4xl font-bold uppercase py-10 text-center">PAKET PREWEDDING</h1>
    <div class="grid lgm:grid-cols-2 lg:grid-cols-4 gap-5 text-black justify-center mx-5">
        
        @foreach ($packages as $package)
            @if($package->category == "prewedding")  
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
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
        {{--
        <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
            <div class="mb-5 bg-gray-100 py-1 px-2">
                <h2 class="font-bold font-Mohave text-secondary text-2xl">BRONZE</h2>
                <span class="text-gray-500">IDR 2.500.000</span>
            </div>
            <div class="space-y-1 text-gray-700">
                <ul class="list-disc ml-5">
                    <li>1 Photo Location.</li>
                    <li>2 Photographer.</li>
                    <li>Make up + hair do/Hijab.</li>
                    <li>1 Print 40x60 + frame.</li>
                    <li>5 Print 10 RS + Edit.</li>
                    <li>Unlimited Shoot.</li>
                    <li>All files in USB.</li>
                </ul>
            </div>
        </div>
        
         <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
            <div class="mb-5 bg-gray-100 py-1 px-2">
                <h2 class="font-bold font-Mohave text-secondary text-2xl">SILVER</h2>
                <span class="text-gray-500">IDR 3.900.000</span>
            </div>
        <div class="space-y-1 text-gray-700"> 

            <ul class="list-disc ml-5">
                <li>2 Photo Location.</li>
                <li>2 Photographer.</li>
                <li>Make up + hair do/Hijab.</li>
                <li>2 Print 40x60 + frame.</li>
                <li>1 Photo Album 20x30 @ 20 page.</li>
                <li>20 Photo Edit.</li>
                <li>Unlimited Shoot.</li>
                <li>All files in USB.</li>
            </ul>
        </div>
        </div>
        <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
            <div class="mb-5 bg-gray-100 py-1 px-2">

                <h2 class="font-bold font-Mohave text-secondary text-2xl">GOLD</h2>
                <span class="text-gray-500">IDR 4.900.000</span>
            </div>
            <div class="space-y-1 text-gray-700">
            <ul class="list-disc ml-5">
                <li>2 Photo Location 1 Day.</li>
                <li>2 Photographer.</li>
                <li>Make up + hair do/Hijab.</li>
                <li>2 Print 50x75 + frame.</li>
                <li>2 Print 50RS + frame.</li>
                <li>1 Photo Album 20x30 @ 20 page.</li>
                <li>25 Photo Edit.</li>
                <li>Unlimited Shoot.</li>
                <li>All files in USB.</li>
            </ul>
        </div>
        </div>
        <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
            <div class="mb-5 bg-gray-100 py-1 px-2">

                <h2 class="font-bold font-Mohave text-secondary text-2xl">DIAMOND</h2>
                <span class="text-gray-500">IDR 7.000.000</span>
            </div>
        <div class="space-y-1 text-gray-700">
            <ul class="list-disc ml-5">

                <li>2 Day Photo Session.</li>
                <li>2 Photographer + Crew.</li>
                <li>Make up + hair do/Hijab.</li>
                <li>4 Print 50x75 + frame.</li>
                <li>4 Print 10RS + frame.</li>
                <li>5 Print 4 R + frame.</li>
                <li>1 Photo Album 20x30 @ 20 page.</li>
                <li>30 Photo Edit.</li>
                <li>Unlimited Shoot.</li>
                <li>All files in USB.</li>    
            </ul>
        </div>
        </div> --}}
    </div>
        {{-- </div> --}}
    <div class="mx-10 flex flex-col justify-center items-center my-10">
        <h1 class="font-Mohave text-4xl font-bold uppercase mb-7 text-black">PAKET WEDDING</h1>
        <div class="grid md:grid-cols-2 lgm:grid-cols-3 gap-5 text-black">
            {{-- <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl">BRONZE</h2>
                    <span class="text-gray-500">IDR 4.500.000</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">

                        <li>Cadid Photo.</li>
                        <li>2 Photographer.</li>
                        <li>1 Videographer.</li>
                        <li>Video Duration 3-4 Minutes.</li>
                        <li>1 Album magazine 20x30.</li>
                        <li>20 Page + Laminated.</li>
                        <li>Unlimited shoot.</li>
                        <li>All files in USB.</li>
                    </ul>
                </div>
            </div>
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <div class="mb-5 bg-gray-100 py-1 px-2">

                    <h2 class="font-bold font-Mohave text-secondary text-2xl">SILVER</h2>
                    <span class="text-gray-500">IDR 6.500.000</span>
                </div>
                <div class="space-y-1 text-gray-700"> 
                    <ul class="list-disc ml-5">

                        <li>Ceremonial, Candid, Family Photo.</li>
                        <li>Full Lighting on Stage.</li>
                        <li>Magnetic Book 4R (100 - 150 photo).</li>
                        <li>1 Album magazine 20x30 @ 20 page.</li>
                        <li>2 Photographer.</li>
                        <li>1 Frame 40x60 + printed.</li>
                        <li>1 Videographer.</li>
                        <li>1 Version Instagram.</li>
                        <li>Video Duration 3-4 Minutes.</li>
                        <li>Unlimited shoot.</li>
                        <li>All files in USB.</li>
                    </ul>
                </div>
            </div>
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl">GOLD</h2>
                    <span class="text-gray-500">IDR 7.500.000</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">

                        <li>Ceremonial, Candid, Family Photo.</li>
                        <li>Full Lighting on Stage.</li>
                        <li>Magnetic Book 4R (100 - 150 photo).</li>
                        <li>2 Album magazine 20x30 @ 20 page.</li>
                        <li>2 Photographer.</li>
                        <li>2 Frame 40x60 + printed.</li>
                        <li>2 Videographer.</li>
                        <li>1 Version Instagram.</li>
                        <li>Video Duration 3-4 Minutes.</li>
                        <li>Unlimited shoot.</li>
                        <li>All files in USB.</li>
                    </ul>
                </div>
            </div> --}}
            @foreach ($packages as $package)
            @if($package->category == "wedding")  
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
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
            {{-- <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl">VIDEO DOKUMENTASI</h2>
                    <span class="text-gray-500"> Mulai dari IDR 950.000</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">

                        <li>Max.3 hours</li>
                        <li>Video full acara</li>
                        <li>Durasi bisa 45menit -1jam</li>
                        <li>1 videografer</li>
                        <li>Flashdisk all files</li>
                    </ul>
                    <span>Extra hour, @ IDR 100K /hour</span>
                </div>
            </div>
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <p class="text-white font-light text-xs bg-secondary py-1 px-2">wisuda, couple, familly, grup, maternity.</li>
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl">BRONZE</h2>
                    <span class="text-gray-500">IDR 185.000</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">

                        <li>5 foto edit + 3 foto cetak 10 R </li>
                        <li>2 foto cetak 4R</li>
                        <li>1lokasi pemotretan</li>
                        <li>30 menit foto sesi</li>
                    </ul>
                    <span >tambahan all file paket bronze +100k</span>
                </div>
            </div>
            <div class="bg-white w-full py-7 px-5 border-t-4 border-secondary">
                <p class="text-white font-light text-xs bg-secondary py-1 px-2">wisuda, couple, familly, grup, maternity.</li>
                <div class="mb-5 bg-gray-100 py-1 px-2">
                    <h2 class="font-bold font-Mohave text-secondary text-2xl">SILVER</h2>
                    <span class="text-gray-500">IDR 250.000</span>
                </div>
                <div class="space-y-1 text-gray-700">
                    <ul class="list-disc ml-5">
                        <li>5foto edit+5foto cetak 10 R</li>
                        <li>1 cetak+bingkai ukuran 30x45 (12R)</li>
                        <li>1 lokasi pemotretan</li>
                        <li>1 jam foto sesi</li>
                    </ul> 
                </div>
            </div> --}}
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