<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Ekskul</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $school->name }}</x-slot:name>
        <x-slot:email>{{ $school->email }}</x-slot:email>
        <x-slot:roleColor>{{ 'bg-custom-blue' }}</x-slot:roleColor>

        <!-- Table Container -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex w-full bg-slate-300 justify-between p-4">
                <!-- Search Form -->
                

                <!-- Button Buat Jadwal -->
                <div class="flex items-center">
                    <a href="activate" class=" text-white bg-green-600 flex items-center px-4 py-2 rounded-lg text-sm">
                        Tambah Ekskul Aktif
                    </a>
                </div>
            </div>

            <!-- Tabel Ekskul -->
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Divisi</th>
                        <th scope="col" class="px-6 py-3">Level</th>
                        <th scope="col" class="px-6 py-3">Vendor</th>
                        <th scope="col" class="px-6 py-3">Tahun Ajaran</th>
                        <th scope="col" class="px-6 py-3">Semester</th>
                        <th scope="col" class="px-6 py-3">PIC</th>
                        <th scope="col" class="px-6 py-3">Hari</th>
                        <th scope="col" class="px-6 py-3">Biaya</th>
                        <th scope="col" class="px-6 py-3">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($excurVendors as $excurVendor)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $excurVendor->extracurricular->name }}
                            </th>
                            <td class="px-6 py-4">{{ $excurVendor->extracurricular->division }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->extracurricular->level }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->vendor->name }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->academic_year }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->semester }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->pic }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->day }} ({{ $excurVendor->start_time }} - {{ $excurVendor->end_time }})</td>
                            <td class="px-6 py-4">{{ $excurVendor->fee }}</td>
                            <td class="px-6 py-4">{{ $excurVendor->status }}</td>

                            <td class="px-6 py-4 text-yellow-400"><a href={{ "editekskulaktif/".$excurVendor->id  }}>Edit</a></td>
                            <td class="px-6 py-4 text-blue-500"><a href={{ "absensisiswa/". $excurVendor->id }}>Daftar pertemuan</a></td>
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
              
            });;;
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {
                
            });;;
        @endif
    </script>
</body>

</html>
