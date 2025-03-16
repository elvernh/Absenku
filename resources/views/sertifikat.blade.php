<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4] relative">

    <x-sidebar class="relative">
        <x-slot:type>{{ 'student' }}</x-slot:type>
        <x-slot:sidebarColor>{{ 'bg-[#42A5F5]' }}</x-slot:sidebarColor>

    </x-sidebar>

    <x-layout_homepage class="relative">
        <x-slot:roleColor>{{ 'bg-[#42A5F5]' }}</x-slot:roleColor>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <x-slot:filename>{{ $filename }}</x-slot:filename>

        <h1 class="text-xl font-semibold mb-4">List Sertifikat</h1>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-800 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Sertifikat</th>
                        <th class="px-4 py-3 text-center">Download Certificate</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($studentExcurVendor as $aa)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-center">{{ $i }}</td>
                            <td class="px-4 py-3 text-center">{{ $aa->url_certificate }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($aa->url_certificate)
                                    <a href="{{ asset('storage/' . $aa->url_certificate) }}" 
                                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" 
                                       download>Download</a>
                                @else
                                    <span class="text-gray-500">No certificate</span>
                                @endif
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </x-layout_homepage>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });;
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });;
        @endif
    </script>
</body>

</html>
