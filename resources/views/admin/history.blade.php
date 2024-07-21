<x-admin.admin-layout :title="$title">
        @php
            $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
        @endphp
        <div class="space-y-5 mb-10">
            @if ($completedBooks->count() > 0)
            @foreach ($completedBooks as $book)
                <section class="bg-white py-5 px-6 border border-gray-300 shadow-sm" x-data="{open: false}">
                    <div class="flex justify-between items-center">
                        <div>
                            @if(!$book->isConfirmed)    
                                <span class="bg-red-200 text-orange-900 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">Ditolak</span>
                            @else
                                <span class="bg-gray-200 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">Ditutup</span>
                                @if($book->payment)
                                    <span class="bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">sudah dibayar</span>
                                @else
                                    <span class="bg-orange-200 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">tidak dibayar</span>
                                @endif
                            @endif
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
                                <td class="pr-5 text-gray-500 font-light">Jenis Paket</td>
                                <td>
                                    <span class="uppercase">{{ $book->package->type }}</span>
                                    @if($book->package->category == 'lain-lain')
                                        -
                                        {{ $book->package->sub_type }}
                                    @else
                                        -
                                        {{ $book->package->category }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="pb-2 pr-5 text-gray-500 font-light">Harga Paket</td>
                                <td class="pb-2"> 
                                    IDR {{ $formatter->formatCurrency($book->package->price, 'IDR') }}
                                    @if($book->isConfirmed)
                                        @if($book->payment)
                                            <span class="bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">sudah dibayar</span>
                                        @else
                                            <span class="bg-orange-200 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">tidak dibayar</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-5 text-gray-500 font-light">Tempat</td>
                                <td>{{ $book->place }}</td>
                            </tr>

                            <tr>
                                <td class="pt-2 pr-5 text-gray-500 font-light">Alamat Pelanggan</td>
                                <td class="pt-2">{{ $book->user->address }}</td>
                            </tr>
                            <tr>
                                <td class="pr-5 text-gray-500 font-light">Nomor HP Pelanggan</td>
                                <td>{{ $book->user->phone_number }}</td>
                            </tr>
                            @if($book->note)
                                <tr>
                                    <td class="pt-5 pr-5 text-gray-500 font-light">Catatan dari Pelanggan</td>
                                    <td class="pt-5">{{ $book->note }}</td>
                                </tr>
                            @endif
                            @if($book->admin_note)
                                <tr>
                                    <td class="pt-5 pr-5 text-gray-500 font-light">Catatan dari Admin</td>
                                    <td class="pt-5">{{ $book->admin_note }}</td>
                                </tr>
                            @endif
                        </table>
                        <x-confirmation-warning action="/booking" method="POST" title="Hapus Booking">
                            @csrf
                            @method('delete')
                            <input hidden name="booking_id" value='{{ $book->id }}' id="">
                            <button class="clickable text-red-500 hover:underline mt-5">Hapus</button>
                        </x-confirmation-warning>
                    </div>
                </section>
            @endforeach
            @else
                <h1 class="text-center font-Mohave text-gray-600">Ooops.. Belum ada riwayat reservasi.</h1>
                @endif
            </div>
</x-admin.admin-layout>