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

<body class="flex overflow-x-hidden bg-gray-100 font-poppins">
    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>school</x-slot:type>
        <x-slot:sidebarColor>{{ 'bg-custom-blue' }}</x-slot:sidebarColor>

    </x-sidebar>

    <!-- Layout Homepage -->
    <x-layout_homepage>
        <x-slot:roleColor>{{ 'bg-custom-blue' }}</x-slot:roleColor>

        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $school->name }}</x-slot:name>
        <x-slot:email>{{ $school->email }}</x-slot:email>

        <!-- Form Container -->
        <div class="m-auto w-full xl:w-3/5 bg-white border border-gray-300 rounded-lg shadow-xl p-10 relative">
            <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">Edit Ekskul</h1>
            <form method="POST" action="{{ route('updateExcur', $extracurricular->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" required
                        value="{{ old('name', $extracurricular->name) }}"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                </div>

                <div class="mb-5">
                    <label for="division" class="block text-sm font-semibold text-gray-700">Divisi</label>
                    <select name="division" id="division" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                        <option value="" disabled selected>Pilih Divisi</option>
                        <option value="SMP" {{ old('division', $extracurricular->division) == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('division', $extracurricular->division) == 'SMA' ? 'selected' : '' }}>SMA</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="level" class="block text-sm font-semibold text-gray-700">Level</label>
                    <select name="level" id="level" required
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                        <option value="" disabled selected>Level</option>
                        <option value="Inti" {{ old('level', $extracurricular->level) == 'Inti' ? 'selected' : '' }}>Inti</option>
                        <option value="Reguler" {{ old('level', $extracurricular->level) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                    </select>
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-3 text-white font-semibold bg-indigo-700 rounded-lg shadow-md hover:bg-indigo-800 transition">Update</button>
                </div>
            </form>
        </div>
    </x-layout_homepage>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error');
        @endif
    </script>
</body>
</html>
