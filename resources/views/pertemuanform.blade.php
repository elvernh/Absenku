<!DOCTYPE html>
<html class="h-full lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Buat pertemuan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <main class=" w-full h-[100vh] p-2 ps-5 pe-5 flex items-center justify-center">
        <!-- Form Container -->
        <div
            class="relative z-10 lg:w-[50%] w-full m-auto bg-[#f6f6f686] border border-gray-300 rounded-lg shadow-lg p-6 sm:p-8 lg:p-10">
            <form class="space-y-6" method="POST"  action="{{ route('createMeeting') }}">
                <h1 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">Pertemuan</h1>
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Ekstrakurikuler</label>
                    <select name="excur_vendor_id" id="extracurricular" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 hover:shadow-md hover:ring-2 hover:ring-indigo-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-150">
                        <option  selected>Pilih Ekstrakurikuler</option>
                        @foreach ($excurVendors as $excurVendor)
                            <option value={{ $excurVendor->id }}>
                                {{ $excurVendor->extracurricular->name }}
                                {{ $excurVendor->extracurricular->division }}
                                {{ $excurVendor->extracurricular->level }}
                                - {{ $excurVendor->vendor->name }}

                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="meeting_date" class="block text-sm font-semibold text-gray-700">Tanggal
                    </label>
                    <input type="date" name="meeting_date" value="{{ old('meeting_date') }}" id="meeting_date" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="topic" class="block text-sm font-semibold text-gray-700">Topic</label>
                    <input type="text" 
                           name="topic" 
                           id="topic" 
                           value="{{ old('topic', '-') }}" 
                           required 
                           class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-150">
                        Buat Pertemuan
                    </button>
                </div>
            </form>

        </div>
        <img src="{{ asset('images/aset1.png') }}" alt="dd"
            class="absolute left-[-90px] -z-[100] sm:left-[-70px] md:left-[-20px] lg:left-[-40px] w-[300px] sm:w-[350px] md:w-[400px] lg:w-[450px] -bottom-5">
        <img src="{{ asset('images/aset5.png') }}" alt="dd"
            class="absolute  right-[3px] -z-[100] sm:right-[-10px] md:right-[-20px] lg:right-[0px] w-[260px] sm:w-[300px] md:w-[350px] lg:w-[400px] -bottom-0">

    </main>

</body>

</html>
