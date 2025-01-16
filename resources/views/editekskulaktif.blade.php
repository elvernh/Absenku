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
            <form class="space-y-6" method="POST" action="{{ route('submitEditActive', $excurVendors->id) }}">
                @csrf
                @method('PUT')
                <h1 class="text-3xl font-extrabold text-center text-indigo-700 mb-6">Edit Ekskul Aktif
                </h1>
                <div>
                    <label for="jenjang" class="block text-sm font-semibold text-gray-700">Ekstrakurikuler</label>
                    <select name="extracurricular_id" id="jenjang" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled {{ old('extracurricular_id', $excurVendors->extracurricular_id) === null ? 'selected' : '' }}>Pilih Ekstrakurikuler</option>
                        @foreach ($extras as $extra)
                            <option value="{{ $extra->id }}" {{ old('extracurricular_id', $excurVendors->extracurricular_id) == $extra->id ? 'selected' : '' }}>
                                {{ $extra->name }} {{ $extra->division }} {{ $extra->level }}
                            </option>
                        @endforeach
                    </select>
                </div>
                

                <div>
                    <label for="jenjang" class="block text-sm font-semibold text-gray-700">Vendor</label>
                    <select name="vendor_id" id="jenjang" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled {{ old('vendor_id', $excurVendors->vendor_id) === null ? 'selected' : '' }}>Pilih Vendor</option>
                        @foreach ($Vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ old('vendor_id', $excurVendors->vendor_id) == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="semester" class="block text-sm font-semibold text-gray-700">Semester</label>
                    <select name="semester" id="semester" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled
                            {{ old('semester', $excurVendors->semester) === null ? 'selected' : '' }}>Pilih Semester
                        </option>
                        <option value="1" {{ old('semester', $excurVendors->semester) == 1 ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ old('semester', $excurVendors->semester) == 2 ? 'selected' : '' }}>2
                        </option>

                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled
                            {{ old('status', $excurVendors->status) === null ? 'selected' : '' }}>Rubah status
                        </option>
                        <option value= "Aktif" {{ old('status', $excurVendors->status) }}> Aktif
                        </option>
                        <option value= "Tidak Aktif" {{ old('status', $excurVendors->status)}}> Tidak Aktif
                        </option>

                    </select>
                </div>
                <div>
                    <label for="academic_year" class="block text-sm font-semibold text-gray-700">Academic year</label>
                    <input type="text" name="academic_year" id="academic_year" autocomplete="academic_year" required
                        value="{{ old('academic_year', $excurVendors->academic_year) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-semibold text-gray-700">Tanggal Mulai
                    </label>
                    <input type="date" name="start_date" value="{{ old('start_date', $excurVendors->start_date) }}"
                        id="start_date" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-semibold text-gray-700">Tanggal Berakhir
                    </label>
                    <input type="date" name="end_date" value="{{ old('end_date', $excurVendors->end_date) }}"
                        id="end_date" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="start_time" class="block text-sm font-semibold text-gray-700">Waktu Mulai
                    </label>
                    <input type="time" name="start_time" value="{{ old('start_time', $excurVendors->start_time) }}"
                        id="start_time" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="end_time" class="block text-sm font-semibold text-gray-700">Waktu Berakhir
                    </label>
                    <input type="time" name="end_time" value="{{ old('end_time', $excurVendors->end_time) }}"
                        id="end_time" required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="pic" class="block text-sm font-semibold text-gray-700">PIC
                    </label>
                    <input type="text" name="pic" value="{{ old('pic', $excurVendors->pic) }}" id="pic"
                        required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="day" class="block text-sm font-semibold text-gray-700">Hari
                    </label>
                    <input type="text" name="day" value="{{ old('day', $excurVendors->day) }}" id="day"
                        required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="fee" class="block text-sm font-semibold text-gray-700">Biaya
                    </label>
                    <input type="number" name="fee" value="{{ old('fee', $excurVendors->fee) }}" id="fee"
                        required
                        class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-indigo-600 px-4 py-2 text-white font-semibold shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
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
