<x-user.layout :title='$title'>
    @php
        $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
    @endphp
    <x-header-page></x-header-page>
    <div class="flex justify-center items-center lg:items-start pt-32 py-20 lg:flex-row flex-col w-full gap-10">
        <div class="w-full lg:w-2/5 text-center lg:text-left px-10">
            <h2 class="font-Mohave text-4xl font-bold uppercase">
                RESERVASI
            </h2>
            <p class="text-gray-300 mt-5">Masukan formulir data tempat, tanggal, waktu, dan tipe paket yang akan dipakai. Jika memiliki pertanyaan atau kebutuhan lain bisa hubungi kami di nomor dibawah.</p>
        </div>
        <div class="bg-white w-4/5 lg:w-2/5 h-fit px-6 py-7 shadow-md">
            @if(Auth::guest())
                <div class="bg-[#fc6f53] w-full h-fit mb-5 p-3">
                    <h3 class="font-bold mb-1">Perhatian</h3>
                    <p class="opacity-90 text-sm">Anda harus <span class="italic font-semibold">login</span> atau <span class="italic font-semibold">register</span> terlebih dahulu agar bisa <span class="italic font-semibold">booking</span>.</p>
                </div>
            @endif
    
            @can("authNoAdmin")
                @if(Auth::user()->email_verified_at)
                    <form action="/booking" method="post">
                    @csrf
                @else
                    <div class="bg-[#fc6f53] w-full h-fit mb-5 p-3">
                        <h3 class="font-bold mb-1">Perhatian</h3>
                        <p class="text-sm">Verifikasi akun anda terlebih dahulu untuk melakukan <span class="italic font-semibold">booking</span>!</p>
                    </div>
                @endif
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
                        <select id="event" name="package" autocomplete="event-name" class="input-styles">
                            @foreach ($packages as $package)
                                <option value="{{$package->id}}"> <b>{{ $package->type }}</b> - 
                                    @if($package->category == 'lain-lain')
                                       {{ $package->sub_type }}
                                    @else
                                        {{ $package->category }}
                                        -
                                    @endif
                                     {{ $formatter->formatCurrency($package->price, 'IDR') }}</option>
                            @endforeach
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
                    <input id="message" rows="4" name="place" class="input-styles" placeholder="Masukan tempat acara...">
                </div>
                <div class="mt-5">
                    <label for="place" class="block text-sm mb-2 font-medium leading-6 text-gray-900">Catatan (Optional)</label>
                    <textarea id="message" rows="4" name="note" class="input-styles" placeholder="Masukan tambahan catatan..."></textarea>
                </div>
                @can('authNoAdmin')
                    @if(Auth::user()->email_verified_at)
                        <button class="button-styles">KIRIM</button>
                        </form>
                        <p class="text-sm text-gray-500 font-light mt-5"> <span class="font-semibold">Catatan</span> : pastikan data yang dimasukan sesuai!</p>
                    @endif
                @endcan
        </div>
    </div>
    <div id="showcase"></div>
    
    @if(Auth::user() && $bookings->count() > 0)
    <section class="max-w-4xl mx-auto text-black my-10 px-3" x-data='payment()'>
        <h2 class="font-bold text-2xl mb-5">Info Booking</h2>
        <div class="relative sm:rounded-lg max-lgm:overflow-x-scroll">
            <table class="text-sm text-left text-gray-500 w-max md:w-full table-auto">
                <thead class="text-xs text-white uppercase bg-secondary py-10">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal & Waktu
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                </thead>
                @php
                    function getDateTime($param)
                    {
                        return Carbon\Carbon::parse($param)->settings(['locale' => 'id_ID','timezone' => 'Asia/Jakarta']);
                    }
                @endphp
                @foreach ($bookings as $book)
                <tbody class="border-[#f0f0f0] border-y-8">
                    <tr class="bg-white hover:bg-gray-50">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 align-top">
                            {{ Auth::user()->name}}
                        </td>
                        <td class="px-6 py-4 align-top">
                            {{ getDateTime($book->date . $book->time)->diffForHumans() }}
                        </td>
                        @if(!$book->isFinished)
                            <td class="px-6 py-4 align-top">
                                @if (is_null($book->isConfirmed))
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">menuggu konfirmasi</span>
                                @elseif ($book->isConfirmed)
                                    <span class="bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">terkonfirmasi</span>
                                @else
                                    <span class="bg-red-200 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top">
                                @if ($book->isConfirmed)
                                    @if(!$book->payment)
                                        <form action="" method="post">
                                            @csrf
                                            <button class="clickable text-purple-500 hover:underline" x-on:click.prevent="snapPayment('{{ $book->token }}','{{ $book->id }}')">
                                                Bayar
                                            </button>
                                        </form>
                                    @else
                                        <span class="bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">terbayar</span>
                                    @endif
                                @endif
                            </td>
                        @else
                            <td class="px-6 py-4 align-top">
                                <p>Booking ditutup</p>
                            </td>
                            <td class="px-6 py-4 align-top"></td>
                        @endif
                        <td class="border-t-2 border-secondary">
                            <p class="clickable text-blue-600 hover:underline cursor-pointer" x-on:click="showDetail({{ $book->id }})">Detail</p>
                        </td>
                        
                    </tr>
                </tbody>
                @endforeach
            </table>
            {{ $bookings->links('pagination::tailwind') }}
        </div>
        <div class="bg-gray-300/50 fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center" x-show="expand"  x-cloak>
            @foreach($bookings as $book)
                <section x-show="{{ $book->id }} == id">
                    <div class="bg-white py-5 px-4 w-fit h-fit rounded-md" x-on:click.outside="showDetail">
                        <h2 class="font-semibold my-3">Detail Booking</h2>
                        <table class="space-y-3">
                            <tr>
                                <td class="pb-2 pr-5 text-gray-500 font-light">Harga</td>
                                <td class="pb-2">{{ $formatter->formatCurrency($book->price, 'IDR') }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2 pr-5 text-gray-500 font-light">Tipe</td>
                                <td class="pb-2">{{ $book->package->category }} - {{ $book->package->type }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2 pr-5 text-gray-500 font-light">Tempat Acara</td>
                                <td class="pb-2">{{ $book->place }}</td>
                            </tr>
                            <tr>
                                <td class="pb-2 pr-5 text-gray-500 font-light">Tanggal dan Waktu</td>
                                <td class="pb-2">{{ getDateTime($book->date)->isoFormat('D MMMM Y') }} - {{ getDateTime($book->time)->isoFormat('HH:mm') }}</td>
                            </tr>
                            @if ($book->isConfirmed)
                                @if($book->admin_note)
                                    <tr>
                                        <td class="pb-2 pr-5 text-gray-500 font-light">Catatan dari Admin</td>
                                        <td class="pb-2">{{ $book->admin_note }}</td>
                                    </tr>
                                @endif
                                @if($book->payment)
                                    <td class="pb-2 pr-5 text-gray-500 font-light inline-block">
                                        <a class="clickable text-green-600 hover:underline" href="/storage/{{ $book->payment->file_name }}">Lihat Nota</a>
                                    </td>

                                    @if ($book->file_name)
                                    <td class="pb-2 pr-5 text-gray-500 font-light inline-block">
                                        <a class="clickable text-green-600 hover:underline" href="/storage/files/{{ $book->file_name }}">Unduh File</a>
                                    </td>
                                    @endif
                                @endif
                            @endif
                            @if($book->isFinished || !$book->isConfirmed)
                                <td>
                                    <x-confirmation-warning action="/booking" method="POST" title="Hapus Booking">
                                        @csrf
                                        @method('delete')
                                        <input hidden name="booking_id" value='{{ $book->id }}' id="">
                                        <button class="clickable text-red-500 hover:underline">Hapus</button>
                                    </x-confirmation-warning>
                                </td>
                            @endif
                        </table>
                    </div>
                </section>
            @endforeach
        </div>
    </section>
    @endif
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_ID') }}"></script>
</x-user.layout>