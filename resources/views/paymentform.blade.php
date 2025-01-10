<!DOCTYPE html>
<html class="h-full lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

<body>
    <main class=" w-full h-[100vh] p-2 ps-5 pe-5 flex items-center justify-center">
        <!-- Form Container -->
        <div
            class="relative z-10 lg:w-[50%] w-full m-auto bg-[#f6f6f686] border border-gray-300 rounded-lg shadow-lg p-6 sm:p-8 lg:p-10">
            <form class="space-y-6" method="POST" enctype="multipart/form-data" action="{{ route('bayar') }}">
                <h1 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">Form Pembayaran</h1>
                @csrf

                <!-- Tanggal Pembayaran -->
                <div>
                    <label for="payment_date" class="block text-sm font-semibold text-gray-700">Tanggal
                        Pembayaran</label>
                    <input type="date" name="payment_date" value="{{ old('payment_date') }}" id="payment_date" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Jumlah Pembayaran -->
                <div>
                    <label for="amount" class="block text-sm font-semibold text-gray-700">Jumlah Pembayaran</label>
                    <input type="number" name="amount" value="{{ old('amount') }}" id="amount" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Ekstrakurikuler -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Ekstrakurikuler</label>
                    <select name="student_excur_vendor_id" id="extracurricular" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 hover:shadow-md hover:ring-2 hover:ring-indigo-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-150">
                        <option value="" disabled selected>Pilih Ekstrakurikuler</option>
                        @foreach ($studentExcs as $studentExc)
                            <option value="{{ $studentExc->id }}">
                                {{ $studentExc->excurVendor->extracurricular->name }} -
                                {{ $studentExc->bill }}
                                {{ $studentExc->id }}

                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 " for="file_input">Upload Bukti
                        Pembayaran</label>
                    <input type="file" name="transfer_url" id="file_input" required
                        class="block w-full mt-1 text-sm border-gray-600 bg-gray-200 rounded-lg cursor-pointer  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-150">
                        Kirim Pembayaran
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
