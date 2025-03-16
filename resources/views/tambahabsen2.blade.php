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
        <x-slot:sidebarColor>{{ 'bg-[#1565C0]' }}</x-slot:sidebarColor>

    </x-sidebar>

    <x-layout_homepage>
        <x-slot:roleColor>{{ 'bg-[#1565C0]' }}</x-slot:roleColor>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div class="w-full gap-x-8 gap-y-6 flex flex-wrap">
            <div class="space-y-4 md:w-[45%] w-full">
                <h1 class="text-[26px] font-semibold">Daftar Murid</h1>
                <div class="overflow-x-auto shadow-lg rounded-lg bg-white">

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-custom-blue">
                            <tr>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $stud)
                                <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3">
                                        <img src="{{ url('/profile-image/' . $stud->student->profile_picture) }}"
                                            class="w-14 h-14 object-cover rounded-full border border-gray-300 shadow-sm"
                                            alt="Profile Image">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $stud->student->full_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button
                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 showPrompt"
                                            data-student-id="{{ $stud->id }}"
                                            data-excV="{{ $stud->excurVendor->id }}">
                                            Buat Absen
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


            <div class="space-y-4 md:w-[45%] w-full">
                <h1 class="text-[26px] font-semibold">Absensi</h1>
                <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-custom-blue">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Keterangan</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presences as $presence)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $presence->studentExcurVendor->student->full_name }}</td>
                                    <td class="px-6 py-4">{{ $presence->status->status_name }}</td>
                                    <td class="px-6 py-4">{{ $presence->keterangan }}</td>
                                    <td class="px-6 py-4"><a href="" class="text-blue-700 underline">edit</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form action="{{ route('updateMeeting', ['id' => $meeting->id]) }}" method="POST" class="mt-6 md:w-[35%] w-full">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="status" class="block text-lg font-medium text-gray-700">Status Meeting</label>
                <select id="status" name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled {{ !$meeting->status ? 'selected' : '' }}>Select a status
                    </option>
                    <option value="scheduled" {{ $meeting->status == 'scheduled' ? 'selected' : '' }}>Scheduled
                    </option>
                    <option value="completed" {{ $meeting->status == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                    <option value="cancelled" {{ $meeting->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <input type="hidden" id="topic" name="topic" value="{{ $topic }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <input type="hidden" id="teacher" name="teacher" value="{{ $teacher }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <button type="submit"
                    class="w-full mt-4 px-4 py-2 text-lg font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    Submit
                </button>
            </div>
        </form>

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
                        <input value="-" type="text" id="description" name="keterangan" placeholder="Masukkan keterangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
                            document.getElementById('absenForm').submit();
                        }
                    });
                });
            });
        });

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
    </script>

</body>

</html>
