<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Tambah Vendor</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4] relative">
    <x-sidebar class="relative">
        <x-slot:type>{{ 'school' }}</x-slot:type>
    </x-sidebar>
    <x-layout_homepage>

        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <div
        class="m-auto w-full xl:w-[60%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-lg p-8 relative z-10">
        <form class="space-y-6" method="post" action="{{ route('add') }}">
            <h1 class="text-3xl font-bold text-center text-[#343372] mb-6">Register Vendor
            </h1>
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" autocomplete="email" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                <input type="number" name="phone" id="phone" autocomplete="phone" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                <input type="text" name="address" id="address" autocomplete="address" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('address')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                <input type="text" name="description" id="description" autocomplete="description" required
                    class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit"
                    class="w-full rounded-lg bg-[#343372] px-4 py-2 text-white font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Daftar</button>
            </div>
        </form>
    </div>
    </x-layout_homepage>
    
</body>

</html>
