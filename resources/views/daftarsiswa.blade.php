
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>{{ 'vendor' }}</x-slot:type>
    </x-sidebar>

    <!-- Main Layout -->
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <x-slot:filename>{{ "" }}</x-slot:filename>

        
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-fixed">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-gray-200">
                        <th scope="col" class="px-6 py-3 text-center">Nama Ekskul</th>
                        <th scope="col" class="px-6 py-3 text-center">Nama Siswa</th>
                        <th scope="col" class="px-6 py-3 text-center">Divisi</th>
                        <th scope="col" class="px-6 py-3 text-center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($excurVendors as $excur)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-center font-medium text-gray-900 dark:text-white">
                                {{ $excur->extracurricular->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $excur->student_excur_vendors_count ?? '0' }} <!-- Display number of students -->
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($excur->start_date)->format('l') }} <!-- Display day of the week -->
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($excur->start_time)->format('H:i') }} <!-- Format the time -->
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ \Carbon\Carbon::parse($excur->end_time)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="/" class="text-blue-600 hover:underline">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">
                                Tidak ada jadwal untuk hari ini.
                            </td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
        

    </x-layout_homepage>

    <script></script>
</body>

</html>
