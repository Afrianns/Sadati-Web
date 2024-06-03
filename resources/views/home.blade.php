<x-user.layout :title='$title'>
    <div class="mx-5 xl:mx-10 mb-20 space-y-7 lg:space-y-10">
        <section class="flex max-md:flex-col-reverse items-center w-full md:h-[28rem] bg-black border-x-4 border-secondary">
            <div class="ml-2 px-5 md:w-5/12 max-md:py-16 space-y-7 lg:space-y-7">
                <h3 class="font-bold text-2xl lg:text-4xl uppercase font-Mohave">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                </h3>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint magnam dolorum rerum delectus aperiam, similique, facilis, quis nesciunt consequatur inventore labore eos.</p>
                <x-btn-link href='login'>
                    Mulai Sekarang
                </x-btn-link>
            </div>
            <img class="bg-red-50 md:w-7/12 h-full object-cover" src="images/image1.png" alt="">
        </section>
        <section class="flex max-md:flex-col-reverse items-center w-full md:h-[28rem] gap-x-5 lg:gap-x-10">
            <div class="md:w-5/12 max-md:py-16 mr-5 space-y-7 text-black">
                <h3 class="text-2xl lg:text-4xl uppercase font-bold font-Mohave text-secondary">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                </h3>
                <p class="text-gray-500">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, quos quod? Expedita aut, laborum sequi, ducimus natus quasi vitae quae dignissimos distinctio nulla est.</p>
                <x-btn-link href="booking">
                    Booking Sekarang
                </x-btn-link>

            </div>
            <img class="object-cover md:w-7/12 h-full" src="images/image2.png" alt="">
        </section>
        <section class="flex max-md:flex-col items-center gap-x-5 lg:gap-x-10 md:h-[28rem]">
            <img class="object-cover md:w-7/12 h-full" src="images/image3.png" alt="">
            <div class="md:w-5/12 p-7 max-md:py-16 bg-black space-y-7 h-full my-auto place-content-center">
                <h3 class="text-2xl lg:text-4xl font-bold uppercase font-Mohave">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                </h3>
                <p class="text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit fugit eos sint odio eveniet consectetur perferendis quod officiis reprehenderit rem.</p>
                <x-btn-link href="#">
                    Kunjungi Galeri
                </x-btn-link>
            </div>
        </section>

        <section class="text-black font-Mohave">
            <div class="flex justify-between items-center mx-auto max-w-7xl sm:px-6 lg:px-8 max-lgm:my-7">
                <h2 class="font-bold text-xl">
                    KATEGORI JASA KAMI
                </h2>
                <x-btn-link href="packages">
                    Lebih Lengkap
                </x-btn-link>
            </div>
        </section>
        <section class="grid item-center max-lg:gap-5 gap-x-5 mx-auto max-lg:max-w-2xl grid-cols-2 lg:grid-cols-4">
            <div class="overflow-hidden w-full relative group">
                <div class="gradient-ornament">
                    <div class="info-wrapper">
                        <h3 class="info-title">GRADUATION</h3>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, magnam?</p>
                    </div>
                    <img class="img-style" src="images/image4.png" alt="">
                </div>
            </div>
            <div class="overflow-hidden w-full relative group">
                <div class="gradient-ornament">
                    <div class="info-wrapper">
                        <h3 class="info-title">PREWEDDING</h3>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, magnam?</p>
                    </div>
                    <img class="img-style" src="images/image5.png" alt="">
                </div>
            </div>
            <div class="overflow-hidden w-full relative group">
                <div class="gradient-ornament">
                    <div class="info-wrapper">
                        <h3 class="info-title">WEDDING</h3>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, magnam?</p>
                    </div>
                    <img class="img-style" src="images/image6.png" alt="">
                </div>
            </div>
            <div class="overflow-hidden w-full relative group">
                <div class="gradient-ornament">
                    <div class="info-wrapper">
                        <h3 class="info-title">FAMILY</h3>
                        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, magnam?</p>
                    </div>
                    <img class="img-style" src="images/image7.png" alt="">
                </div>
            </div>        
        </section>
    </div>
</x-user.layout>
