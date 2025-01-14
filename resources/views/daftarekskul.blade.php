<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Ekskul</title>
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
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex w-full bg-slate-300 justify-between p-4">
                <!-- Search Form -->
                <form class="w-[30%]">

                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20" aria-hidden="true">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Cari ekskul..." required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            Cari
                        </button>
                    </div>
                </form>

                <!-- Button Buat Jadwal -->
                <div class="flex items-center">
                    <a href="/school/tambahekskul"
                        class="ms-20 text-white bg-green-600 flex items-center px-4 py-2 rounded-lg text-sm">
                        Tambah Ekskul
                    </a>
                </div>
            </div>

            <!-- Tabel Ekskul -->
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Divisi</th>
                        <th scope="col" class="px-6 py-3">Level</th>


                    </tr>
                </thead>
                <tbody>

                    @foreach ($extracurriculars as $exctracurricular)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $exctracurricular->id }}
                            </th>
                            <td class="px-6 py-4">{{ $exctracurricular->name }}</td>
                            <td class="px-6 py-4">{{ $exctracurricular->division }}</td>
                            <td class="px-6 py-4">{{ $exctracurricular->level }}</td>

                            <td> <x-button>
                                    <x-slot:action>{{ route('deleteExtracurricular', $exctracurricular) }}</x-slot:action>
                                    <x-slot:method>DELETE</x-slot:method>
                                </x-button></td>
                            <td> <x-button>
                                    <x-slot:action>PUT</x-slot:action>
                                    <x-slot:method>PUT</x-slot:method>
                                </x-button></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
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
        Swal.fire('Success', "{{ session('success') }}", 'success');
    @endif

    @if (session('error'))
        Swal.fire('Error', "{{ session('error') }}", 'error');
    @endif
</script>
</body>

</html>
