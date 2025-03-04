<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>student</x-slot:type>
    </x-sidebar>

    <!-- Layout Homepage -->
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $student->full_name }}</x-slot:name>
        <x-slot:email>{{ $student->email }}</x-slot:email>
        <x-slot:filename>{{ $filename }}</x-slot:filename>

        <!-- Table Container -->
        <div class="m-auto w-full xl:w-[60%] border-[1px] border-slate-400 bg-[#f4f4f47e] rounded-lg shadow-lg p-8 relative z-10">
            <form method="POST" action="{{ route('updateProfile', $student->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h1 class="text-3xl font-bold text-center text-[#343372] mb-6">Edit Profile</h1>

                <div class="mb-4">
                    <label for="full_name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name" required
                        value="{{ old('full_name', $student->full_name) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                        value="{{ old('email', $student->email) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="grade" class="block text-sm font-semibold text-gray-700">Kelas</label>
                    <input type="text" name="grade" id="grade" required
                        value="{{ old('grade', $student->grade) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="educational_level" class="block text-sm font-semibold text-gray-700">Jenjang</label>
                    <input type="text" name="educational_level" id="educational_level" required
                        value="{{ old('educational_level', $student->educational_level) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="from_class" class="block text-sm font-semibold text-gray-700">Asal Kelas</label>
                    <input type="text" name="from_class" id="from_class" required
                        value="{{ old('from_class', $student->from_class) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-6">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                    <input type="file" name="profile_picture" id="profile_picture"
                        class="block w-full mt-1 text-sm border-gray-600 bg-gray-200 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <button type="submit"
                        class="w-full rounded-lg bg-[#343372] px-4 py-2 text-white font-semibold shadow-md hover:bg-[#2a285a] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Update
                    </button>
                </div>
            </form>
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
            Swal.fire('Success', "{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error');
        @endif
    </script>
</body>

</html>
