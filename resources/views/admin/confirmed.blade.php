<x-admin.admin-layout :title="$title">
    @php
        $formatter = new NumberFormatter('id_ID',  NumberFormatter::CURRENCY);
    @endphp
    @if ($bookings->count() > 0 || $total->count() > 0)
    <div class="flex mb-5 justify-between">
        @php
            $sort = request()->get('sort') ?: "terdekat";
            $type = request()->get('Ptype') ?: "paid";
        @endphp
        <section class="w-fit text-gray-500 text-xs">
            <p>Status Pembayaran</p>
            <div class="flex gap-x-2 items-center mt-2">
                <a href="?sort={{ $sort }}&Ptype=paid">
                    <x-admin.admin-navlink :url="request()->get('Ptype') == 'paid' || request()->get('Ptype') == ''" class="link-btn-filter">
                        Terbayar
                    </x-admin.admin-navlink>
                </a>
                <a href="?sort={{ $sort }}&Ptype=unpaid">
                    <x-admin.admin-navlink :url="request()->get('Ptype') == 'unpaid'" class="link-btn-filter">
                        Belum Terbayar
                    </x-admin.admin-navlink>
                </a>
            </div>
        </section>
        <section class="w-fit text-gray-500 text-xs">
            <p>Urutkan Jadwal</p>
            <div class="flex gap-x-2 items-center mt-2">
                <a href="?sort=terdekat&Ptype={{ $type }}">
                    <x-admin.admin-navlink :url="request()->get('sort') == 'terdekat' || request()->get('sort') == ''" class="link-btn-filter">
                        Terdekat
                    </x-admin.admin-navlink>
                </a>
                <a href="?sort=terlama&Ptype={{ $type }}">
                    <x-admin.admin-navlink :url="request()->get('sort') == 'terlama'" class="link-btn-filter">
                        Terlama
                    </x-admin.admin-navlink>
                </a>
            </div>
        </section>
    </div>
    @endif
    <div class="space-y-5 mb-10">
        @if ($bookings->count() > 0)

        @php
            function getDateTime($param)
            {
                return Carbon\Carbon::parse($param)->settings(['locale' => 'id_ID','timezone' => 'Asia/Jakarta']);
            }
        @endphp

        @foreach ($bookings as $book)
            {{-- <div x-show="isPay == 1"> --}}
                {{-- <div x-if="check({{ $book->payment }})"> --}}
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
                                <td class="pb-3 pr-5 text-gray-500 font-light">Harga Paket</td>
                                <td class="pb-3"> {{ $formatter->formatCurrency($book->price, 'IDR') }} 
                                    @if($book->payment)
                                        <span class="bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">terbayar</span>
                                    @else
                                        <span class="bg-orange-200 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded w-full">belum bayar</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="pr-5 text-gray-500 font-light">Tanggal & Waktu</td>
                                <td>{{ getDateTime($book->date)->isoFormat('DD MMMM Y') }} - {{ getDateTime($book->time)->isoFormat('HH:mm') }}</td>
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
                                    <td class="pt-2 pr-5 text-gray-500 font-light">Catatan pelanggan</td>
                                    <td>{{ $book->note }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td class="pt-7 pr-5 text-gray-500 font-light">Diajukan pada</td>
                                <td class="pt-7 flex items-center gap-2">{{ getDateTime($book->created_at)->format("j F Y") }} <span class="text-xs text-gray-500 bg-gray-200 py-0.5 px-1.5">{{ getDateTime($book->created_at)->diffForHumans(now()) }}</span> </td>
                            </tr>
                            @if ($book->file_name)
                            <tr>
                                <td class="pt-7 pr-5 text-gray-500 font-light">
                                    Nama file
                                </td>
                                <td class="pt-7">
                                    <div class="flex py-1 px-2 items-center border border-gray-200 gap-x-2">
                                        <span>
                                            {{ $book->file_name }} 
                                        </span>
                                        <x-confirmation-warning action="/admin/file/delete" method="POST" title="Hapus File" text="Apa kamu yakin ingin menghapus -nya?">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="booking_id" value="{{ $book->id }}">
                                            <button class="text-red-500 hover:underline">hapus</button>
                                        </x-confirmation-warning>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </table>
                        @if ($book->payment)
                            @if (!$book->file_name)
                                <div class="mt-10 flex flex-col content-center flex-wrap">
                                    <form action="/admin/files" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="user_id" value="{{ $book->user_id }}" required>
                                        <input type="hidden" name="booking_id" value="{{ $book->id }}" required>
                                        <input type="file" name="file" class="block w-full text-sm text-slate-500 border border-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" required>
                                        <button type="submit" class="w-full text-white bg-green-500 border border-white mt-3 py-1 px-2">upload</button>
                                    </form>
                                </div>
                            @endif
                        @endif
                        <x-confirmation-warning action="/admin/history" method="POST" title="Tutup Booking" text="Apa kamu yakin ingin Menutup -nya?">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="booking_id" value="{{ $book->id }}">
                            <input type="hidden" name="admin_note" value="">
                            <button class="text-red-500 mt-7 hover:underline">Tutup</button>
                        </x-confirmation-warning>
                    </div>
                </section>
        @endforeach
        @else
            <h1 class="text-center font-Mohave text-gray-600 py-10">Ooops.. Tidak Ada yang Booking Terkonfirmasi disini.</h1>
        @endif
    </div>
</x-admin.admin-layout>