<x-admin-layout :title="$title">
    <div class="space-y-5">
        @if ($bookings->count() > 0)
        @foreach ($bookings as $book)
        <section class="bg-white py-5 px-6 border border-gray-300 shadow-sm" x-data="{open: false}">
            <div class="flex justify-between">
                <div>
                    <p class="text-medium font-medium">{{ $book->user->name }}</p>
                    <span class="text-gray-500 font-light">{{ $book->user->email }}</span>
                </div>
                <svg x-on:click="open = !open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-black w-9 p-2 cursor-pointer hover:bg-gray-50"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
            </div>
            <div x-show="open">
                <table class="mt-5 table-auto space-y-5">
                    <tr>
                        <td class="pr-5 text-gray-500 font-light">Tanggal & Waktu</td>
                        <td>{{ date_format(date_create($book->date), 'd M Y') }} - {{ date_format(date_create($book->time), 'g:i A') }}</td>
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
</x-admin-layout>