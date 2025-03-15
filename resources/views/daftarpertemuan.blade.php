<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pertemuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex overflow-x-hidden bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>{{ 'vendor' }}</x-slot:type>
    </x-sidebar>

    <!-- Main Layout -->
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-6 mt-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Pertemuan</h2>

            <div class="overflow-x-auto">
                <table
                    class="w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">Ekstrakurikuler</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Divisi</th>
                            <th scope="col" class="px-6 py-3">Level</th>
                            <th scope="col" class="px-6 py-3">Jam</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($meetings as $meeting)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">{{ $meeting->excurVendor->extracurricular->name }}</td>
                                <td class="px-6 py-4 ">
                                    {{ $meeting->meeting_date }}</td>
                                <td class="px-6 py-4">{{ $meeting->excurVendor->extracurricular->division }}</td>
                                <td class="px-6 py-4">{{ $meeting->excurVendor->extracurricular->level }}</td>
                                <td class="px-6 py-4">{{ $meeting->excurVendor->start_time }} -
                                    {{ $meeting->excurVendor->end_time }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-white 
                                        {{ $meeting->status == 'Active' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $meeting->status }}
                                    </span>
                                </td>
                                @if ($meeting->status == 'completed')
                                    <td class="px-6 py-4 text-center">
                                        <a href="buatabsen/{{ $meeting->id }}"
                                            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                            edit absen
                                        </a>
                                    </td>
                                @else
                                    <td class="px-6 py-4 text-center">
                                        <a href="buatabsen/{{ $meeting->id }}"
                                            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                            Buat Absen
                                        </a>
                                    </td>
                                @endif


                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada jadwal untuk hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </x-layout_homepage>

</body>

</html>
