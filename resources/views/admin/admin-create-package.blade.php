<x-admin.admin-layout :title="$title">
    <div x-data="createPackage()">
        @foreach ($errors->all() as $error)
            <div class="text-red-600 my-5">
                <ul class="list-styles py-0 my-0">
                    <li>{{ $error }}</li>
                </ul>
            </div>
        @endforeach
        <form action="/admin/packages/create" method="post" class="mb-5">
            @csrf
            <div class="mt-5 grid sm:grid-cols-6">
                <div class="sm:col-span-3 mr-2">
                    <label for="text" class="block text-sm font-medium leading-6 text-gray-900">Tipe</label>
                    <div class="mt-2">
                        <input type="text" name="type" id="type" class="input-styles" placeholder="e.g. Bronze, Gold, Silver" required>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <label for="text" class="block text-sm font-medium leading-6 text-gray-900">Sub-Tipe (Optional)</label>
                    <div class="mt-2">
                        <input type="text" name="sub_type" id="sub_type" class="input-styles">
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <label for="place" class="block text-sm mb-2 font-medium leading-6 text-gray-900">Harga</label>
                <input type="number" id="message" min="0" rows="4" name="price" class="input-styles" placeholder="Masukan harga paket..." required>
            </div>
            <div class="mt-5 space-y-3">
                <label for="desc">Keunggulan Paket</label> 
                <template x-for="(field, index) in fields" :key="index">
                    <div class="flex gap-x-5 items-center">
                        <input type="text" name="desc[]" class="input-styles" x-model="field.value" required></input> 
                        <span x-show="index>=1" x-on:click='removeField(index)' class="clickable-styles bg-red-500 text-white rounded-full px-3">&times;</span>
                    </div>
                </template>
                <p x-on:click="addField()" class="clickable-styles px-5 bg-black text-white">&plus;</p>
            </div>
            <input type="hidden" name="category" value="{{ $category }}">
            <div class="flex justify-between items-center mt-10">
                <a class="clickable border border-black py-2 px-5" href="/admin/packages">Kembali</a>
                <button class="clickable bg-secondary text-white py-2 px-5">Tambah Paket</button>
            </div>
    </form>
</div>
</x-admin.admin-layout>