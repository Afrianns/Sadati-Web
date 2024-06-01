<x-user.layout :title='$title'>
    <section class="bg-black mb-[20rem] relative w-full">
        <span class="bg-black absolute left-0 right-0 bottom-0 top-0 opacity-70"></span>
        <img class="object-cover w-full h-[23rem]" src="images/image1.png" alt="">
        <div class="flex justify-center px-5 max-lgm:flex-col w-full gap-10 absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="w-full lgm:w-2/5">
                <h2 class="font-Mohave text-4xl font-bold uppercase">
                    BOOKING
                </h2>
                <p class="text-gray-300 mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quod eius mollitia aliquam vitae magni?</p>
            </div>
            <div class="bg-white lgm:w-2/5 h-fit px-6 py-7 shadow-md">
                
                @guest
                    <div class="bg-[#fc6f53] w-full h-fit mb-5 p-3">
                        <h3 class="font-bold mb-1">Perhatian</h3>
                        <p class="opacity-90 text-sm">Anda harus <span class="italic font-semibold">login</span> atau <span class="italic font-semibold">register</span> terlebih dahulu agar bisa <span class="italic font-semibold">booking</span>.</p>
                    </div>
                @endguest

                @can("authNoAdmin")
                    <form action="/booking" method="post">
                        @csrf
                @endcan
                    <div class="col-span-6">
                        <label for="event" class="flex items-center gap-2 text-sm font-medium leading-6 text-gray-900">Jenis Acara
                            <div class="relative group w-fit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" style="fill: rgb(39, 38, 38);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                                <p class="hidden group-hover:block py-2 px-3 bottom-6 text-center -left-14 bg-white absolute text-sm font-light shadow-sm w-36">
                                Informasi lengkap bisa dilihat di tab paket
                                </p>
                            </div>
                        </label>
                        <div class="mt-2">
                            <select id="event" name="event" autocomplete="event-name" class="input-styles">
                                <option>pilihan satu</option>
                                <option>pilihan dua</option>
                                <option>pilihan tiga</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-5 grid sm:grid-cols-6">

                        <div class="sm:col-span-3 mr-2">
                            <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Tanggal</label>
                            <div class="mt-2">
                                <input type="date" name="date" id="date" class="input-styles">
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="datetime" class="block text-sm font-medium leading-6 text-gray-900">Waktu</label>
                            <div class="mt-2">
                                <input type="time" name="time" id="time" class="input-styles">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="place" class="block text-sm mb-2 font-medium leading-6 text-gray-900">Tempat</label>
                        <textarea id="message" rows="4" name="place" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan tempat acara..."></textarea>
                    </div>
                    @can('authNoAdmin')
                        <button class="button-styles">BOOK</button>
                        </form>
                        <p class="text-sm text-gray-500 font-light mt-5"> <span class="font-semibold">Catatan</span> : pastikan data yang dimasukan sesuai!</p>
                    @endcan
                    
            </div>
        </div>
    </section>
    
    @if(Auth::user() && $books->count() > 0)
    <section class="max-w-7xl mx-auto text-black my-10 max-lgm:mt-96 px-5">
        <h2 class="font-bold text-2xl my-3">Info Booking</h2>
        <div class="relative shadow-md sm:rounded-lg max-lgm:overflow-x-scroll">
            <table class="text-sm text-left text-gray-500 w-max lgm:w-full table-auto">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Jenis
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal & Waktu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tempat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 align-top">
                                {{ $book->user->name}}
                            </th>
                            <td class="px-6 py-4 align-top">
                                {{ date_format(date_create($book->date), 'd M Y') }} - {{ date_format(date_create($book->time), 'g:i A') }}
                            </td>
                            <td class="px-6 py-4 align-top max-w-[30rem]">
                                {{ $book->place}}
                                Lorem ipsum dolor sit amet.
                            </td>
                            <td class="px-6 py-4 align-top">
                                @if (is_null($book->isConfirmed))
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">menuggu konfirmasi</span>
                                @elseif ($book->isConfirmed)
                                    <span class="bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">terkonfirmasi</span>
                                @else
                                    <span class="bg-red-200 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">ditolak</span>
                                @endif
                            </td>
                            @if (!$book->isConfirmed)
                                <td class="px-6 py-4 text-right align-top" x-data>
                                    <x-confirmation-warning action="booking" id='deleteForm'>
                                        @csrf
                                        @method('delete')
                                        <input hidden name="booking_id" value='{{ $book->id }}' id="">
                                        <button class="text-red-500 font-semibold">Delete</button>
                                    </x-confirmation-warning>
                                </td>
                            @else
                                <td>
                                    <a href="#" class="font-medium text-blue-600  hover:underline"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg></a>    
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif
</x-user.layout>