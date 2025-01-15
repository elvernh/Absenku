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
            class="m-auto w-full xl:w-[60%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-lg p-8 relative z-10">
            <form method="POST" action="{{ route('updateExcur', $extracurricular->id) }}">
                @csrf
                @method('PUT') <!-- Add PUT method here for updating -->
            
                <h1 class="text-3xl font-bold text-center text-[#343372] mb-6">Nama Ekskul</h1>
                
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $extracurricular->name) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            
                <div>
                    <label for="division" class="block text-sm font-semibold text-gray-700">Divisi</label>
                    <select name="division" id="division" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled>Pilih Divisi</option>
                        <option value="SMP" {{ old('division', $extracurricular->division) == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('division', $extracurricular->division) == 'SMA' ? 'selected' : '' }}>SMA</option>
                    </select>
                </div>
            
                <div class="mb-12">
                    <label for="level" class="block text-sm font-semibold text-gray-700">Level</label>
                    <select name="level" id="level" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled>Level</option>
                        <option value="Inti" {{ old('level', $extracurricular->level) == 'Inti' ? 'selected' : '' }}>Inti</option>
                        <option value="Reguler" {{ old('level', $extracurricular->level) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                    </select>
                </div>
            
                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-[#343372] px-4 py-2 text-white font-semibold shadow-md hover:bg-[#343372] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Update
                    </button>
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
