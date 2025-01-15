<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Form Pendaftaran</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full  flex flex-col items-center justify-center relative">



    <main class="ps-8 pe-8 pb-10 pt-10 -z-1000 w-full">
        <img src="images/aset1.png" alt=""
            class="absolute -bottom-10 left-[-90px] sm:left-[-70px] md:left-[-30px] lg:left-[-40px] w-[300px] sm:w-[350px] md:w-[400px] lg:w-[450px] mb-4">
        <img src="images/aset5.png" alt=""
            class="absolute -bottom-4 right-[3px] sm:right-[-10px] md:right-[-20px] lg:right-[0px] w-[260px] sm:w-[300px] md:w-[350px] lg:w-[400px] mb-4">

        <div
            class="m-auto w-full xl:w-[50%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-lg p-8 relative z-10">
            <form class="space-y-6" method="POST" action="{{ route('submitActivate') }}">
                @csrf
                <h1 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">Aktifkan Ekskul
                </h1>
                @csrf
                <div>
                    <label for="jenjang" class="block text-sm font-semibold text-gray-700">Ekstrakurikuler</label>
                    <select name="extracurricular_id" id="jenjang" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                        @foreach ($extras as $extra)
                            <option value={{ $extra->id }}>{{ $extra->name }} {{ $extra->division }}
                                {{ $extra->level }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="jenjang" class="block text-sm font-semibold text-gray-700">Ekstrakurikuler</label>
                    <select name="vendor_id" id="jenjang" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih Vendor</option>
                        @foreach ($Vendors as $vendor)
                            <option value={{ $vendor->id }}>{{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="semester" class="block text-sm font-semibold text-gray-700">Semester</label>
                    <select name="semester" id="semester" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih Semester</option>
                        <option value="1">1</option>
                        <option value="2">2</option>

                    </select>
                </div>
                <div>
                    <label for="academic_year" class="block text-sm font-semibold text-gray-700">Academic year</label>
                    <input type="text" name="academic_year" id="academic_year" autocomplete="academic_year" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700">Tanggal Mulai
                    </label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" id="start_date" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700">Tanggal Berakhir
                    </label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" id="end_date" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="start_time" class="block text-sm font-semibold text-gray-700">Waktu Mulai
                    </label>
                    <input type="time" name="start_time" value="{{ old('start_time') }}" id="start_time" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="end_time" class="block text-sm font-semibold text-gray-700">Waktu Berakhir
                    </label>
                    <input type="time" name="end_time" value="{{ old('end_time') }}" id="end_time" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="pic" class="block text-sm font-semibold text-gray-700">PIC
                    </label>
                    <input type="text" name="pic" value="{{ old('pic') }}" id="pic" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="day" class="block text-sm font-semibold text-gray-700">Hari
                    </label>
                    <input type="text" name="day" value="{{ old('day') }}" id="day" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="fee" class="block text-sm font-semibold text-gray-700">Biaya
                    </label>
                    <input type="number" name="fee" value="{{ old('fee') }}" id="fee" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Daftar</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
