<x-admin.admin-layout :title="$title">
    <div class="flex justify-between items-center">
        <a href="/admin/packages/create/{{ request()->get('category') }}" class="clickable bg-white py-1 px-5 border border-gray-300">Tambah</a>
        <div class="w-fit text-gray-500 text-xs">
            <p>Pilih Kategori</p>
            <div class=" mb-5 mt-2 w-fit flex gap-x-2 items-center">
                <a href="?category=prewedding">
                    <x-admin.admin-navlink :url="request()->get('category') == 'prewedding' || request()->get('category') == ''" class="link-btn-filter">
                        Prewedding
                    </x-admin.admin-navlink>
                </a>
                <a href="?category=wedding">
                    <x-admin.admin-navlink :url="request()->get('category') == 'wedding'" class="link-btn-filter">
                        Wedding
                    </x-admin.admin-navlink>
                </a>
                <a href="?category=lain-lain">
                    <x-admin.admin-navlink :url="request()->get('category') == 'lain-lain'" class="link-btn-filter">
                        Lain-lain
                    </x-admin.admin-navlink>
                </a>
            </div>
        </div>
        
    </div>

    @foreach ($errors->all() as $error)
    <div class="text-red-600 my-5">
        <p>Ada Error. Silahkan cek & coba lagi!</p>
        <ul class="list-styles">
            <li>{{ $error }}</li>
        </ul>
    </div>
    @endforeach
    @foreach ($packages as $package)
    @if($package->category == $category)
    <div class="border border-gray-300 rounded-md mb-5 bg-gray-50 shadow-sm">
        <div class="w-fit ml-auto">
            <x-confirmation-warning action="/admin/package/delete" method="POST" title="Hapus Paket" text="Apa kamu yakin ingin menghapus paket -nya?">
                   @csrf
               @method("delete")
               <input type="hidden" name="package_id" value="{{ $package->id }}">
               <button class="text-red-500 py-1 px-4 hover:underline">Hapus</button>
           </x-confirmation-warning>
       </div>
        <div class="bg-white w-full py-5 mb-5 px-5 border-t border-b border-gray-300" x-data="packages({{ $package->description }})">
            <form action="/admin/packages/edit" method="post">
                @csrf
                <input type="hidden" value="{{ $package->id }}" name="package-id">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-bold font-Mohave text-secondary text-2xl uppercase">{{ $package->type }}</h2>
                        
                        <input type="text" x-show="edit" x-cloak class="input-styles" name="price-edit" value="{{ $package->price }}"></input> 
                        <span class="text-gray-500" x-show="!edit">IDR {{ $package->price }}</span>
                    </div>

                    <svg x-on:click="open = !open, edit = false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-black w-9 p-2 cursor-pointer hover:bg-gray-50"><path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path></svg>
                </div>
                <div x-cloak x-show="open">
                    <ul class="list-styles my-5">
                        <template x-for="(field, index) in fields" :key="index">
                            <li>
                                <p x-show="!edit" x-text="field"></p>
                                <div class="flex gap-x-5 items-center" x-show="edit">
                                    <input type="text" name="desc-edit[]" class="input-styles" x-model="field"></input> 
                                    <span x-on:click='removeField(index)' class="clickable-styles bg-red-500 text-white rounded-full px-3">&times;</span>
                                </div>
                            </li>
                        </template>
                    </ul>

                    <p x-on:click="edit = !edit" class="clickable-styles bg-slate-100 px-5">
                        Edit
                    </p>
                    <div x-show="edit" class="flex justify-between mt-10">
                        <div>
                            <p x-on:click="edit = !edit, clearField({{ $package->description }})" class="clickable-styles bg-slate-100 px-5">Kembali</p>
                            <p x-on:click="addField()" class="clickable-styles px-5 bg-black text-white">&plus;</p>
                        </div>
                        <button class="clickable-styles px-5 bg-[#fc6f53] text-white">
                            Perbarui
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
    @endif
@endforeach
</x-admin.admin-layout>