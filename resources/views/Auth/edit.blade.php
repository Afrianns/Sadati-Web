<x-user.header></x-user.header>
<div class="grid place-content-center min-h-screen">
    <div class="flex justify-between items-center mt-6">
        <h2 class="title">Edit Data Diri.</h2>
        <a href="/" class="hover:underline text-sm font-light text-gray-500 block text-right">Beranda.</a>
    </div>
    <section class="bg-white shadow w-[35rem] py-9 px-10 my-5 space-y-10">
        <form action="/personal-data-edit" method="post">
            @method('patch')
            @csrf
            <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
            <div class="mt-3">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama Lengap</label>
                <div class="mt-2">
                    <input type="name" name="name" id="name" class="input-styles" value="{{$user->name}}" placeholder="E.g. Alan Santon">
                </div>
            </div>
            @error('name')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" class="input-styles" value="{{$user->email}}" placeholder="E.g. example@mail.com">
                </div>
            </div>
            @error('email')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                <div class="mt-2">
                    <input type="text" name="address" id="address" value="{{$user->address}}" class="input-styles" placeholder="E.g. Nanggulan, Kulon Progo">
                </div>
            </div>
            @error('address')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor HP</label>
                <div class="mt-2">
                    <input type="number" min="0" name="phone_number" value="{{$user->phone_number}}" id="phone_number" class="input-styles" placeholder="E.g. 089653455654">
                </div>
            </div>
            @error('phone_number')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror

            <div class="text-center mt-3">
                <button type="submit" class="button-styles mb-5">Perbarui</button>
            </div>
        </form> 
    </section>
    <h1 class="title mt-6">Edit Password.</h1>
    <section class="bg-white shadow w-[35rem] py-9 px-10 my-5 space-y-10">
        <form action="/password-edit" method="post">
            @method('patch')
            @csrf
            <div class="mt-3 pb-6 border-b border-gray-200">
                <label for="old_password" class="block text-sm font-medium leading-6 text-gray-900">Password Lama</label>
                <div class="mt-2">
                    <input type="password" name="old_password" id="old_password" class="input-styles">
                </div>
            </div>
            @error('old_password')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror

            <div class="mt-3">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password Baru</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" class="input-styles">
                </div>
            </div>
            @error('password')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi Password</label>
                <div class="mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input-styles">
                </div>
            </div>
            @error('password_confirmation')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror

            <div class="text-center mt-3">
                <button type="submit" class="button-styles mb-5">Perbarui</button>
            </div>
        </form> 
    </section>
</div>