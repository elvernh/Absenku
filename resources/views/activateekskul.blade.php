<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Ekskul</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>school</x-slot:type>
    </x-sidebar>

    <!-- Layout Homepage -->
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $school->name }}</x-slot:name>
        <x-slot:email>{{ $school->email }}</x-slot:email>

        <!-- Table Container -->
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
    </x-layout_homepage>

    <!-- Sidebar Toggle Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        const content = document.getElementById('content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-64');
            content.classList.toggle('ml-64');
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire('Success', "{{ session('success') }}", 'success').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });;;
    @endif

    @if (session('error'))
        Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });;;
    @endif
</script>
</body>

</html>
