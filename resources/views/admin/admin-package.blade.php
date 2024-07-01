<x-admin.admin-layout :title="$title">
    <div class=" mb-5 ml-auto w-fit text-gray-500 flex gap-x-2 items-center text-xs">
        <p>Pilih Kategori</p>
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
    <div class="bg-white w-full py-5 mb-5 px-5 border border-gray-300 shadow-sm" x-data="packages({{ $package->description }})">
        <form action="/admin/packages" method="post">
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
            <div x-cloak class="space-y-1 text-gray-700" x-show="open">
                <ul class="list-styles mt-5">
                    <template x-for="(field, index) in fields" :key="index">
                        <li>
                            <p x-show="!edit" x-text="field"></p>
                            <div class="flex gap-x-5 items-center" x-show="edit">
                                <input type="text" name="desc-edit[]" class="input-styles" x-model="field"></input> <span x-on:click='removeField(index)' class="clickable-styles bg-red-500 text-white rounded-full">&times;</span>
                            </div>
                        </li>
                    </template>
                </ul>
            <div>
                <p x-show="!edit" x-on:click="edit = !edit" class="clickable-styles mt-5 inline-block bg-slate-100">
                    Edit
                </p>
                <div x-show="edit" class="flex justify-between mt-5">
                    <div>
                        <span x-on:click="edit = !edit" class="clickable-styles bg-slate-100">Kembali</span>
                        <span x-on:click="addField()" class="clickable-styles mt-10 bg-black text-white">&plus;</span>
                    </div>
                        <button class="clickable-styles bg-[#fc6f53] text-white">
                            Perbarui
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    @endif
@endforeach

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("packages", (param) => ({
            open: false,
            edit: false,
            
            fields: param,
            addField() {
                console.log(this.fields);
                this.fields.push('');
            },
            removeField(index) {
                this.fields.splice(index, 1);
            },
        }));
    });

</script>
</x-admin.admin-layout>