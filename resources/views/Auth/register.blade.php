<x-user.header></x-user.header>
<div class="grid sm:place-content-center min-h-screen max-sm:content-center w-full">
    <div class="flex justify-between items-center mt-6 mx-2">
        <h2 class="title">REGISTER.</h2>
        <a href="/" class="hover:underline text-sm font-light text-gray-500 block text-right">Beranda.</a>
    </div>
    <section class="bg-white shadow sm:w-[35rem] py-9 px-10 my-5">
        <form action="register" method="post">
            @csrf
            <div class="mt-3">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama Lengap</label>
                <div class="mt-2">
                    <input type="name" name="name" id="name" class="input-styles" value="{{old('name')}}" placeholder="E.g. Alan Santon">
                </div>
            </div>
            @error('name')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" class="input-styles" value="{{old('email')}}" placeholder="E.g. example@mail.com">
                </div>
            </div>
            @error('email')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                <div class="mt-2">
                    <input type="text" name="address" id="address" value="{{old('address')}}" class="input-styles" placeholder="E.g. Nanggulan, Kulon Progo">
                </div>
            </div>
            @error('address')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor HP</label>
                <div class="mt-2">
                    <input type="number" min="0" name="phone_number" value="{{old('phone_number')}}" id="phone_number" class="input-styles" placeholder="E.g. 089653455654">
                </div>
            </div>
            @error('phone_number')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" class="input-styles">
                </div>
            </div>
            @error('password')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Ulangi Password</label>
                <div class="mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input-styles">
                </div>
            </div>
            @error('password_confirmation')
                <p class="text-red-400 italic mt-2 text-sm">{{ $message }}</p>
            @enderror

            <div class="text-center mt-3">
                <button type="submit" class="button-styles mb-5">Register</button>
                <a href="login" class="hover:underline">Login</a>
            </div>
        </form> 
    </section>
</div>