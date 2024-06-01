<x-user.layout :title='$title'>
    <section class="flex max-mdl:flex-col-reverse items-center w-full bg-black">
        <p class=" text-2xl ml-2 px-5 uppercase mdl:w-3/6 max-mdl:my-28">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        </p>
            <img class="object-cover mdl:w-7/12" src="images/image1.png" alt="">
    </section>
    <section class="flex max-mdl:flex-col items-center w-full">
            <img class="object-cover mdl:w-7/12 h-[25rem]" src="images/image2.png" alt="">
        <p class="text-2xl ml-2 px-5 mdl:w-3/6 max-mdl:my-28 uppercase text-black">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        </p>
    </section>
    <section class="flex max-mdl:flex-col-reverse items-center bg-black">
        <p class="text-2xl ml-2 px-5 uppercase mdl:w-3/6 max-mdl:my-28">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
        </p>
            <img class="object-cover mdl:w-7/12 " src="images/image3.png" alt="">
    </section>

    <section class=" text-black font-Mohave">
        <div class="flex justify-between items-center mx-auto max-w-7xl py-10 px-4 sm:px-6 lg:px-8">
            <h2 class="font-bold text-xl">
                KATEGORI JASA KAMI
            </h2>
            <a href="paket" class="border border-black py-2 px-4 hover:text-white hover:bg-black">LEBIH LENGKAP</a>
           
        </div>
    </section>
    <section class="grid mds:grid-cols-2 mdm:grid-cols-4 item-center">
        <div class="overflow-hidden w-full relative">
            <span class="gradient-ornament">
                <p class="info-title">GRADUATION</p>
                <img class="img-style" src="images/image4.png" alt="">
            </span>
        </div>
        <div class="overflow-hidden w-full relative">
            <span class="gradient-ornament">
                <p class="info-title">PREWEDDING</p>
                <img class="img-style" src="images/image5.png" alt="">
            </span>
        </div>
        <div class="overflow-hidden w-full relative">
            <span class="gradient-ornament">
                <p class="info-title">WEDDING</p>
                <img class="img-style" src="images/image6.png" alt="">
            </span>
        </div>
        <div class="overflow-hidden w-full relative">
            <span class="gradient-ornament">
                <p class="info-title">FAMILY</p>
                <img class="img-style" src="images/image7.png" alt="">
            </span>
        </div>        
    </section>
</x-user.layout>
