<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile View</title>
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

        <!-- Profil Container -->
        <div class="py-[60px]">

            <div class="w-full max-w-4xl mx-auto  bg-white rounded-lg shadow-lg p-8 border-[1px] border-gray-500">
                <!-- Gambar Profil -->
                <div class="flex items-center justify-center">
                    <img src="{{ url('/profile-image/' . $student->profile_picture) }}"
                        class="size-[300px] rounded-full object-cover shadow-lg" alt="Profile Picture">
                </div>

                <!-- Informasi Profil -->
                <div class="text-center mt-6">
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $student->full_name }}</h2>
                    <p class="text-gray-500 text-xl">{{ $student->email }}</p>
                </div>

                <!-- Detail Profil -->
                <div class="mt-8 grid grid-cols-2 gap-6 text-lg text-gray-600 ">
                    <div>
                        <h3 class="font-bold text-gray-700">Grade:</h3>
                        <p>{{ $student->grade }}</p>
                    </div>
                    <div>
                        <h3 class=" text-gray-700 font-bold">Class:</h3>
                        <p>{{ $student->from_class }}</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-700">Educational Level:</h3>
                        <p>{{ $student->educational_level }}</p>
                    </div>
                </div>

                <div class="p-1 rounded-lg bg-yellow-200 mt-4 w-full md:w-[20%] text-center text-lg ">
                    <a href={{ 'editprofile/' . $student->id }}>edit</a>
                </div>
            </div>
        </div>

    </x-layout_homepage>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });
        @endif
    </script>
</body>

</html>
