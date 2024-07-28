<x-user.header></x-user.header>
<div class="grid sm:place-content-center min-h-screen max-sm:content-center w-full">
    <div class="flex justify-between items-center mt-6 mx-2">
        <h2 class="title">Login.</h2>
        <a href="/" class="hover:underline text-sm font-light text-gray-500 block text-right">Beranda.</a>
    </div>
    <section class="bg-white shadow sm:w-96 p-7 my-5">
        <form action="login" method="post">
            @csrf
            <div class="mt-3">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" class="input-styles" :value="old('emil')" placeholder="example@mail.com">
                </div>
            </div>
            @error('email')
                <p class="text-red-400 italic mt-2">{{ $message }}</p>
            @enderror
            <div class="mt-3">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" class="input-styles">
                </div>
            </div>
            @error('password')
                <p class="text-red-400 italic mt-2">{{ $message }}</p>
            @enderror
            <div class="text-center mt-3">
                <button class="button-styles mb-5">Login</button>
                <a href="register" class="hover:underline">Register</a>
            </div>
        </form> 
    </section>
</div>