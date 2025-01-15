<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Tambah Ekskul</title>

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
        {{-- <x-slot:layoutTitle>Tambah Ekskul</x-slot:layoutTitle>
        <x-slot:name>Test</x-slot:name>
        <x-slot:email>A</x-slot:email> --}}

        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <div
            class="m-auto w-full xl:w-[60%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-lg p-8 relative z-10">
            <form class="space-y-6" method="POST" action="{{ route('addExcur') }}">
                {{-- post is weird --}}
                @csrf
                <h1 class="text-3xl
                font-bold text-center text-[#343372] mb-6">Tambah Ekskul
                </h1>
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="jenjang" class="block text-sm font-semibold text-gray-700">Divisi</label>
                    <select name="division" id="jenjang" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih Jenjang</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                    </select>
                </div>
                <div>
                    <label for="jenjang" class="block text-sm font-semibold text-gray-700">Level</label>
                    <select name="level" id="jenjang" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Level</option>
                        <option value="inti">Inti</option>
                        <option value="reguler">Reguler</option>
                    </select>
                </div>
                

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Vendor</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($all as $vendor)
                            <div class="flex items-center">
                                <input type="checkbox" name="vendor_id[]" value="{{ $vendor->id }}"
                                    class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="e" class="ml-2 text-gray-700">{{ $vendor->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-[#343372] px-4 py-2 text-white font-semibold shadow-md hover:bg-[#343372] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Daftar</button>
                </div>
            </form>
        </div>
    </x-layout_homepage>

</body>

</html>
