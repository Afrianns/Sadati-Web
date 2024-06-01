<x-admin.admin-layout :title="$title">
    <div class=" mb-5 ml-auto w-fit text-gray-500 flex gap-x-2 items-center text-xs">
        <p>Urutkan Jadwal</p>
        <a href="?sort=terdekat">
            <x-admin.admin-navlink :url="request()->get('sort') == 'terdekat' || request()->get('sort') == ''" class="link-btn-sort">
                Terdekat
            </x-admin.admin-navlink>
        </a>
        <a href="?sort=terlama">
            <x-admin.admin-navlink :url="request()->get('sort') == 'terlama'" class="link-btn-sort">
                Terlama
            </x-admin.admin-navlink>
        </a>
    </div>
    <div class="space-y-5">
        @if ($bookings->count() > 0)

        @php
            function getDateTime($param)
            {
                return Carbon\Carbon::parse($param)->settings(['locale' => 'id_ID','timezone' => 'Asia/Jakarta']);
            }
        @endphp

        @foreach ($bookings as $book)
        <section class="bg-white py-5 px-6 border border-gray-300 shadow-sm" x-data="{open: false}">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-xs text-gray-500 bg-gray-200 py-0.5 px-1.5">{{ getDateTime($book->date . $book->time)->diffForHumans() }}</span>
                    <div class="flex gap-2 mt-2">
                        <p class="text-medium font-medium">{{ $book->user->name }}</p>
                        <span class="text-gray-400 font-light">{{ $book->user->email }}</span>
                    </div>
                </div>
                <svg x-on:click="open = !open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-black w-9 p-2 cursor-pointer hover:bg-gray-50"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
            </div>
            <div x-show="open" x-cloak>
                <table class="mt-5 table-auto space-y-5">
                    <tr>
                        <td class="pr-5 text-gray-500 font-light">Tanggal & Waktu</td>
                        <td>{{ getDateTime($book->date)->isoFormat('d MMMM Y') }} - {{ getDateTime($book->time)->isoFormat('HH:mm') }}</td>
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
            </div>
        </section>
        @endforeach
        @else
            <h1 class="text-center font-Mohave text-gray-600">Ooops.. Tidak Ada yang Booking Terkonfirmasi saat ini.</h1>
        @endif
    </div>
</x-admin.admin-layout>