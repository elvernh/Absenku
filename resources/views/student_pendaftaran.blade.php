<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ekskul</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-gray-100">
    <x-sidebar>
        <x-slot:type>student</x-slot:type>
        <x-slot:sidebarColor>bg-blue-500</x-slot:sidebarColor>
    </x-sidebar>
    
    <x-layout_homepage>
        <x-slot:roleColor>bg-blue-500</x-slot:roleColor>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <x-slot:filename>{{ $filename }}</x-slot:filename>

        <h1 class="text-2xl font-bold mb-4">Daftar Ekskul Tersedia</h1>
        
        <div class="overflow-x-auto mb-6">
            <form action="{{ route('submitDaftar') }}" method="post">
                @csrf
                <table class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-lg">
                    <thead class="bg-blue-500 text-white uppercase">
                        <tr>
                            <th class="px-4 py-3 text-center"></th>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                            <th class="px-4 py-3 text-center">Divisi</th>
                            <th class="px-4 py-3 text-center">Level</th>
                            <th class="px-4 py-3 text-center">Jam</th>
                            <th class="px-4 py-3 text-center">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($excurVendors as $index => $excurVendor)
                            <tr class="border-b odd:bg-white even:bg-gray-50 hover:bg-gray-200">
                                <td class="px-4 py-3 text-center">
                                    <input type="checkbox" name="excurVendor[]" value="{{ $excurVendor->id }}" id="vendor-{{ $excurVendor->id }}">
                                </td>
                                <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-center">{{ $excurVendor->extracurricular->name }}</td>
                                <td class="px-4 py-3 text-center">{{ $excurVendor->extracurricular->division }}</td>
                                <td class="px-4 py-3 text-center">{{ $excurVendor->extracurricular->level }}</td>
                                <td class="px-4 py-3 text-center">{{ $excurVendor->start_time }} - {{ $excurVendor->end_time }}</td>
                                <td class="px-4 py-3 text-center font-semibold">Rp.{{ number_format($excurVendor->fee, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="bg-green-600 mt-4 px-6 py-2 rounded-lg text-white hover:bg-green-700 transition" type="submit">Submit</button>
            </form>
        </div>
        
        <h1 class="text-xl font-bold mb-4">Riwayat Pendaftaran</h1>
        <table class="w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-lg">
            <thead class="bg-blue-500 text-white uppercase">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                    <th class="px-4 py-3 text-center">Divisi</th>
                    <th class="px-4 py-3 text-center">Level</th>
                    <th class="px-4 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historys as $index => $history)
                    <tr class="border-b odd:bg-white even:bg-gray-50 hover:bg-gray-200">
                        <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-center">{{ $history->excurVendor->extracurricular->name }}</td>
                        <td class="px-4 py-3 text-center">{{ $history->excurVendor->extracurricular->division }}</td>
                        <td class="px-4 py-3 text-center">{{ $history->excurVendor->extracurricular->level }}</td>
                        <td class="px-4 py-3 text-center font-semibold">{{ $history->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $historys->links() }}
        </div>
    </x-layout_homepage>

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
