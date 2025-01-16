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

        <div class="w-full p-6 space-y-8">
            <form action="" method="post" class="p-4 md:w-[50%] w-full bg-white shadow rounded-lg">
                <!-- Topic -->
                <div class="mb-4">
                    <label for="topic" class="block text-sm font-medium text-gray-700">Topic</label>
                    <input type="text" id="topic" name="topic" value="{{ $meeting->topic }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter the topic">
                </div>
            
                <!-- Teacher -->
                <div class="mb-4">
                    <label for="teacher" class="block text-sm font-medium text-gray-700">Teacher</label>
                    <input type="text" id="teacher" name="teacher" value="{{ $meeting->teacher }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter the teacher's name">
                </div>
            
                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled selected>Select status</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            
                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Submit
                    </button>
                </div>
            </form>
            
            <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
               
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-custom-blue">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $stud)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $stud->student->full_name }}</td>
                                <td class="px-6 py-4">
                                    <button class="text-blue-500 hover:underline showPrompt"
                                        data-student-id="{{ $stud->id }}"
                                        data-excV={{ $stud->excurVendor->id }}>Buat Absen</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="space-y-4">
                <h1 class="text-lg font-semibold">Absensi</h1>
                <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-custom-blue">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presences as $presence)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $presence->studentExcurVendor->student->full_name }}</td>
                                    <td class="px-6 py-4">{{ $presence->status->status_name }}</td>
                                    <td class="px-6 py-4">{{ $presence->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </x-layout_homepage>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const urlPath = window.location.pathname;
            const meetingId = urlPath.split('/').pop();

            document.querySelectorAll('.showPrompt').forEach(button => {
                button.addEventListener('click', function() {
                    const studentId = this.getAttribute('data-student-id');
                    const excvId = this.getAttribute('data-excV');

                    Swal.fire({
                        title: 'Buat Absen',
                        html: `
                    <form id="absenForm" action="{{ route('createPresence') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="date" name="status_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Hadir</option>
                                <option value="2">Terlambat</option>
                                <option value="3">Izin</option>
                                <option value="4">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <input type="text" id="description" name="keterangan" placeholder="Masukkan keterangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <input type="hidden" value="${meetingId}" name="meeting_id">
                        <input type="hidden" value="${studentId}" name="student_excur_vendor_id">
                        <input type="hidden" value="${excvId}" name="excur_vendor_id">
                    </form>
                `,
                        showCancelButton: true,
                        confirmButtonText: 'Simpan',
                        preConfirm: () => {
                            const date = document.getElementById('date').value;
                            const description = document.getElementById('description').value;
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
                            document.getElementById('absenForm').submit();
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
