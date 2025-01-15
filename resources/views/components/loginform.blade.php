<div
    class="relative mx-auto xl:max-w-lg lg:max-w-md md:w-[50%] sm:w-[70%] w-[90%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-xl p-8 pb-15 pt-15">

    <h1 class="text-3xl font-bold text-center text-custom-blue mb-6">Login sebagai {{ ucfirst($slot) }}</h1>
    <form class="space-y-6" action={{ 'login/' . $type}} method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <div class="mb-4 relative">
                <img src="{{ asset('icons/at-sign.svg') }}" alt="email_icon" class="absolute size-5 top-3 left-3">
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 pl-11 py-2 focus:ring-2 focus:ring-custom-blue text-sm sm:text-base">

                @error('email')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <div class="mb-4 relative">
                <img src="{{ asset('icons/lock.svg') }}" alt="password_icon" class="absolute size-5 top-3 left-3">
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 pl-11 py-2 focus:ring-2 focus:ring-custom-blue text-sm sm:text-base">
                @error('password')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div>
            <button type="submit"
                class="w-full rounded-lg bg-custom-blue px-4 py-2 text-white font-semibold text-sm sm:text-base hover:bg-custom-blue focus:ring-2 focus:ring-custom-blue">
                Login
            </button>
        </div>
    </form>

    @if ($slot == 'student')
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Tidak memiliki akun?
                <a href="/pendaftaran" class="text-custom-blue hover:underline">Daftar</a>
            </p>
        </div>
    @endif

</div>
