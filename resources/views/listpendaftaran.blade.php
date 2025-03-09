<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>
        <x-slot:type>{{ 'school' }}</x-slot:type>
    </x-sidebar>
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <h1>List Pendaftaran</h1>
        <div class="overflow-x-auto mb-4">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-custom-blue text-white uppercase">
                        <tr>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-center">Nama</th>
                            <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center"></th>
                            <th class="px-4 py-3 text-center"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendings as $pending)
                            <tr class="border-b odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-center">{{ $pending->student->full_name }}</td>
                                <td class="px-4 py-3 text-center">{{ $pending->excurVendor->extracurricular->name }}
                                </td>
                                <td class="px-4 py-3 text-center capitalize">{{ $pending->status }}</td>
                                <td class="px-4 py-3 text-center">
                                    <a onclick="confirmAction('{{ route('approve', $pending->id) }}')"
                                        class="text-green-600 hover:underline">Approve</a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a onclick="confirmAction('{{ route('reject', $pending->id) }}')"
                                        class="text-red-600 hover:underline">
                                        Reject
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="{{ $pendings->previousPageUrl() }}"
                        class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>

                @foreach ($pendings->getUrlRange(1, $pendings->lastPage()) as $page => $url)
                    <li>
                        <a href="{{ $url }}"
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
                           {{ $page == $pendings->currentPage() ? 'bg-blue-50 text-blue-600' : '' }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li>
                    <a href="{{ $pendings->nextPageUrl() }}" id="testButton"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>
        <!-- Pagination -->
        <div class="overflow-x-auto">

            <h1 class="mt-4 mb-4">Riwayat pendaftaran</h1>
            <table class="w-full text-sm text-left text-gray-600 border  border-gray-200 rounded-lg shadow-md">
                <thead class="bg-yellow-300 text-gray-800 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Nama</th>
                        <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                        <th class="px-4 py-3 text-center">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($historys as $history)
                        <tr class="border-b odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                            <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-center">{{ $history->student->full_name }}</td>
                            <td class="px-4 py-3 text-center">{{ $history->excurVendor->extracurricular->name }}
                            </td>
                            <td class="px-4 py-3 text-center capitalize">{{ $history->status }}</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="{{ $historys->previousPageUrl() }}"
                        class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>

                @foreach ($historys->getUrlRange(1, $historys->lastPage()) as $page => $url)
                    <li>
                        <a href="{{ $url }}"
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
                           {{ $page == $historys->currentPage() ? 'bg-blue-50 text-blue-600' : '' }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li>
                    <a href="{{ $historys->nextPageUrl() }}" id="testButton"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>
        <!-- Pagination -->
    </x-layout_homepage>

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
        document.getElementById('testButton').addEventListener('click', () => {
            Swal.fire({
                title: 'Test SweetAlert',
                text: 'Jika ini muncul, SweetAlert berfungsi dengan baik.',
                icon: 'success'
            });
        });

        function confirmAction(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL reject
                    window.location.href = url;
                }
            });
        }
    </script>
</body>

</html>
