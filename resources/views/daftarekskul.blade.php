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
        <x-slot:sidebarColor>{{ 'bg-custom-blue' }}</x-slot:sidebarColor>

    </x-sidebar>

    <!-- Layout Homepage -->
    <x-layout_homepage>
        <x-slot:roleColor>{{ 'bg-custom-blue' }}</x-slot:roleColor>

        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $school->name }}</x-slot:name>
        <x-slot:email>{{ $school->email }}</x-slot:email>

        <!-- Table Container -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex w-full  justify-between mb-4">
                <!-- Search Form -->

                <form id="sortForm" method="GET" action="{{ url()->current() }}">
                    <input type="hidden" id="sortInput" name="sort"
                        value="{{ $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                </form>

                <!-- Button Buat Jadwal -->
                <div class="flex w-full justify-between">
                    <a href="/school/tambahekskul"
                        class=" text-white bg-green-600 flex items-center px-4 py-2 rounded-lg text-sm">
                        Tambah Ekskul
                    </a>
                    <button id="sortButton"
                        class="text-white text-sm bg-green-600 items-start px-4 py-3 rounded-full {{ $sortDirection === 'desc' ? 'flex flex-col-reverse' : ' flex flex-col' }}" 
                        aria-label="Sort table">
                        <span class="block w-[20px] mb-[2px] h-1 bg-white transform rounded-full"></span>
                        <span class="block w-[15px] mb-[2px] h-1 bg-white transform rounded-full"></span>
                        <span class="block w-[10px] h-1 mb-[2px] bg-white transform rounded-full"></span>
                    </button>
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
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3"></th>



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

                            <td> <button class="text-white bg-red-600 px-4 py-2 rounded-lg text-sm"
                                    onclick="confirmDelete('{{ route('deleteExtracurricular', $exctracurricular) }}')">
                                    Hapus
                                </button></td>
                            <td> <x-button>
                                    <x-slot:action>{{ route('editExcur', $exctracurricular->id) }}</x-slot:action>
                                    <x-slot:method>GET</x-slot:method>
                                    Edit
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

        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL untuk menghapus data
                    window.location.href = url;
                }
            });
        }

        document.getElementById('sortButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior
            this.classList.toggle('flex-col-reverse'); // Toggle the 'reversed' class
            
            // Create or update the 'sort' parameter in the URL
            const url = new URL(window.location.href);
            const currentSort = url.searchParams.get('sort') || 'asc';
            url.searchParams.set('sort', currentSort === 'asc' ? 'desc' : 'asc');

            // Redirect to the new URL
            window.location.href = url.toString();
        });
    </script>
</body>

</html>
