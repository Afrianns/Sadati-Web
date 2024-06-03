<x-user.layout :title='$title'>
    <x-header-page></x-header-page>
    <div class="flex justify-center items-center lg:items-start pt-32 py-20 lg:flex-row flex-col w-full gap-10">
        <div class="w-full lg:w-2/5 text-center lg:text-left px-10">
            <h2 class="font-Mohave text-4xl font-bold uppercase">
                BOOKING
            </h2>
            <p class="text-gray-300 mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum quod eius mollitia aliquam vitae magni?</p>
        </div>
        <div class="bg-white w-4/5 lg:w-2/5 h-fit px-6 py-7 shadow-md">
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
                    <label for="event" class="flex items-center gap-2 text-sm font-medium leading-6 text-gray-900">Jenis Paket
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
    
    
    @if(Auth::user() && $books->count() > 0)
    <section class="max-w-4xl mx-auto text-black my-10 px-3">
        <h2 class="font-bold text-2xl mb-5">Info Booking</h2>
        <div class="relative sm:rounded-lg max-lgm:overflow-x-scroll">
            <table class="text-sm text-left text-gray-500 w-max md:w-full table-auto">
                <thead class="text-xs text-white uppercase bg-secondary py-10">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Jenis
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal & Waktu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                @php
                    function getDateTime($param)
                    {
                        return Carbon\Carbon::parse($param)->settings(['locale' => 'id_ID','timezone' => 'Asia/Jakarta']);
                    }
                @endphp
                @foreach ($books as $book)
                <tbody class="border-[#f0f0f0] border-y-8" x-data='{ expand : false }'>
                    @if ($book->isConfirmed)
                        <tr class="bg-white hover:bg-gray-50 cursor-pointer" x-on:click="expand = !expand">
                    @else
                        <tr class="bg-white hover:bg-gray-50">
                    @endif
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 align-top">
                                {{ $book->user->name}}
                            </td>
                            <td class="px-6 py-4 align-top">
                                {{ getDateTime($book->date . $book->time)->diffForHumans() }}
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
                                    <x-confirmation-warning action="/booking" method="POST" title="Hapus Booking">
                                        @csrf
                                        @method('delete')
                                        <input hidden name="booking_id" value='{{ $book->id }}' id="">
                                        <button class="text-red-500 font-semibold">Delete</button>
                                    </x-confirmation-warning>
                                </td>
                            @else
                                <td>
                                </td>
                            @endif
                        </tr>
                    @if ($book->isConfirmed)
                        <tr class="bg-white border-b-8 border-[#F0F0F0]" x-show="expand" x-cloak>
                            <td colspan="2" class="border-t-2 border-secondary p-4">
                                <span class="font-bold">Tempat Acara</span> <p>{{ $book->place }}</p>
                            </td>
                            <td colspan="2" class="border-t-2 border-secondary p-4">    
                                <span class="font-bold">Tanggal & Waktu Acara</span> <p class="bg-gray-100 w-fit py-1 px-4 my-1">{{ getDateTime($book->date)->isoFormat('D MMMM Y') }} - {{ getDateTime($book->time)->isoFormat('HH:mm') }}</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
                @endforeach
            </table>
        </div>
    </section>
    @endif
</x-user.layout>