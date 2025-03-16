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

<body class="flex overflow-x-hidden bg-gray-100">

    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>{{ 'vendor' }}</x-slot:type>
        <x-slot:sidebarColor>{{ 'bg-[#1565C0]' }}</x-slot:sidebarColor>

    </x-sidebar>

    <!-- Main Layout -->
    <x-layout_homepage>
        <x-slot:roleColor>{{ 'bg-[#1565C0]' }}</x-slot:roleColor>

        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg h-[90vh] bg-white p-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Siswa</h2>
            <div class="overflow-auto max-h-[70vh] border rounded-lg">
                <table class="w-full text-sm text-left text-gray-600 bg-white border-collapse">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 sticky top-0 z-10">
                        <tr class="border-b">
                            <th scope="col" class="px-6 py-3 text-center w-10">No</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama Ekskul</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama Siswa</th>
                            <th scope="col" class="px-6 py-3 text-center">Divisi</th>
                            <th scope="col" class="px-6 py-3 text-center">Vendor</th>
                            <th scope="col" class="px-6 py-3 text-center w-20">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="border-b hover:bg-gray-100 transition">
                                <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-center">{{ $student->excurVendor->extracurricular->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $student->student->full_name }}</td>
                                <td class="px-6 py-4 text-center">{{ $student->excurVendor->extracurricular->division }}</td>
                                <td class="px-6 py-4 text-center">{{ $student->excurVendor->vendor->name }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="#" class="text-blue-500 hover:underline">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </x-layout_homepage>

</body>

</html>
