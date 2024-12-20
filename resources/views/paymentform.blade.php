<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Form Pembayaran</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="w-full  relative">

<x-navbar></x-navbar>

    <main class="ps-8 pe-8 pb-2 -z-1000">
        <img src="images/aset1.png" alt=""
            class="absolute -bottom-10 left-[-90px] sm:left-[-70px] md:left-[-30px] lg:left-[-40px] w-[300px] sm:w-[350px] md:w-[400px] lg:w-[450px] mb-4">
        <img src="images/aset5.png" alt=""
            class="absolute -bottom-4 right-[3px] sm:right-[-10px] md:right-[-20px] lg:right-[0px] w-[260px] sm:w-[300px] md:w-[350px] lg:w-[400px] mb-4">

        <div
            class="m-auto w-full xl:w-[60%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-lg p-8 relative z-10">
            <form class="space-y-6" method="POST" enctype="multipart/form-data">
                <h1 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">Form Pembayaran</h1>
                @csrf
                <div>
                    <label for="payment_reference" class="block text-sm font-semibold text-gray-700">Tanggal Pembayaran</label>
                    <input type="date" name="payment_reference" id="payment_reference" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="amount" class="block text-sm font-semibold text-gray-700">Jumlah Pembayaran</label>
                    <input type="number" name="amount" id="amount" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Ekstrakurikuler</label>
                    <select name="extracurricular" id="extracurricular" class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                        @foreach ($studentExcs as $studentExc)
                            <option value="{{ $studentExc->id }}">{{ $studentExc->excurVendor->extracurricular->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="proof_image" class="block text-sm font-semibold text-gray-700">Bukti Transfer</label>
                    <input type="file" name="proof_image" id="proof_image" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Kirim Pembayaran</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
