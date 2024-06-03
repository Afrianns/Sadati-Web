<x-admin.admin-layout :title="$title">
    @if ($bookings->count() > 0)
        <div class=" mb-5 ml-auto w-fit text-gray-500 flex gap-x-2 items-center text-xs">
            <a href="?sort=terbaru">
                <x-admin.admin-navlink :url="request()->get('sort') == 'terbaru' || request()->get('sort') == ''" class="link-btn-sort">
                    Terbaru
                </x-admin.admin-navlink>
            </a>
            <a href="?sort=terlama">
                <x-admin.admin-navlink :url="request()->get('sort') == 'terlama'" class="link-btn-sort">
                    Terlama
                </x-admin.admin-navlink>
            </a>
        </div>
    @endif
        <div class="space-y-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($bookings->count() > 0)
            @php
                function getDateTime($param)
                {
                    return Carbon\Carbon::parse($param)->settings(['locale' => 'id_ID','timezone' => 'Asia/Jakarta']);
                }
            @endphp
            @foreach ($bookings as $book)
            <section class="bg-white py-5 px-6 border border-gray-300 shadow-sm" x-data="{toggle: false}">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-xs text-gray-500 bg-gray-200 py-0.5 px-1.5">{{ getDateTime($book->date . $book->time)->diffForHumans() }}</span>
                        <div class="flex gap-2 mt-2">
                            <p class="text-medium font-medium">{{ $book->user->name }}</p>
                            <span class="text-gray-500 font-light">{{ $book->user->email }}</span>
                        </div>
                    </div>
                    <svg x-on:click="toggle = !toggle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-black w-9 p-2 cursor-pointer hover:bg-gray-50"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
                </div>
                <div x-show="toggle" x-cloak>
                    <table class="mt-5 table-auto space-y-5">
                        <tr>
                            <td class="pr-5 text-gray-500 font-light">Tanggal & Waktu</td>
                            <td> {{ getDateTime($book->date)->isoFormat('D MMMM Y') }} - {{ getDateTime($book->time)->isoFormat('HH:mm') }} </td>
                        </tr>
                        <tr>
                            <td class="pr-5 text-gray-500 font-light">Tempat</td>
                            <td>{{ $book->place }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 text-gray-500 font-light">Alamat</td>
                            <td>{{ $book->user->address }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 text-gray-500 font-light">Nomor HP</td>
                            <td>{{ $book->user->phone_number }}</td>
                        </tr>
                    </table>
                    <div class="flex justify-between mt-5">
                        <x-confirmation-warning action="/admin/booking" method="POST" title="Tolak Booking" text="Apa kamu yakin ingin menolak -nya?">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="value" value="0">
                            <input type="hidden" name="booking_id" value="{{ $book->id }}">
                            <button class="text-red-600 py-2 px-4">Tolak</button>
                        </x-confirmation-warning>

                        <x-confirmation-warning action="/admin/booking" method="POST" title="Terima Booking" text="Apa kamu yakin ingin Menerima -nya?">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="value" value="1">
                            <input type="hidden" name="booking_id" value="{{ $book->id }}">
                            <button class="bg-green-500 text-white py-2 px-4">Terima</button>
                        </x-confirmation-warning>
                        
                    </div>
                </div>
            </section>
            @endforeach
            @else
                <h1 class="text-center font-Mohave text-gray-600">Ooops.. Tidak Ada yang Booking saat ini.</h1>
            @endif
            
        </div>
</x-admin.admin-layout>