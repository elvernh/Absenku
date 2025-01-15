<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detil Pertemuan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">

    {{-- Sidebar --}}
    <x-sidebar>
        <x-slot:type>{{ 'vendor' }}</x-slot:type>
    </x-sidebar>

    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div class="w-full p-6">
            <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-custom-blue">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                            <th scope="col" class="px-6 py-3">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $stud)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $stud->student->full_name }}</td>
                                <td class="px-6 py-4 ">
                                    <!-- Add any action buttons if needed -->
                                    <button class="text-blue-500 hover:underline showPrompt"
                                        data-student-id="{{ $stud->id }}"
                                        data-excV={{ $stud->excurVendor->id }}>buat
                                        absen</button>
                                </td>
                                <td class="px-6 py-4">{{ $stud->presence}}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </x-layout_homepage>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlPath = window.location.pathname;
            const meetingId = urlPath.split('/').pop();

            document.querySelectorAll('.showPrompt').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil studentId dari atribut data-student-id
                    const studentId = this.getAttribute('data-student-id');
                    const excvId = this.getAttribute('data-excV');

                    Swal.fire({
                        title: 'Buat Absen',
                        html: `
                    <form id="absenForm" action = "{{ route('createPresence') }}" method ="post">
                        @csrf
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <select id="date" name="status_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Status</option>
                                <option value="1">Hadir</option>
                                <option value="2">Terlambat</option>
                                <option value="3">Izin</option>
                                <option value="4">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <input type="text" id="description" name="keterangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="mb-4">
                            <label for="meetingId" class="block text-sm font-medium text-gray-700">Meeting ID</label>
                            <input type="number" value="${meetingId}" id="meetingId" name="meeting_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="studentId" class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="number" value="${studentId}" id="studentId" name="student_excur_vendor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="studentId" class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="number" value="${excvId}" id="studentId" name="excur_vendor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
                        </div>
                    </form>
                `,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        preConfirm: () => {
                            const date = document.getElementById('date').value;
                            const description = document.getElementById('description')
                                .value;
                            if (!date || !description) {
                                Swal.showValidationMessage('Harap isi semua field!');
                            }
                            return {
                                date,
                                description
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('absenForm')
                        .submit(); // Mengirimkan form
                        }
                    });
                });
            });
        });
    </script>


</body>

</html>
