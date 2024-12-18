<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    {{-- sidebar --}}
    <x-sidebar></x-sidebar>
    <x-layout_homepage>
        <x-slot name="layoutTitle">
            Edit {{ $type }}
        </x-slot>
        <div class="mt-12 flex flex-col px-8 py-8 bg-white rounded-lg">
            <h1 class="font-medium text-lg mb-8">User Profile</h1>
            <form>
                <div class="mb-8">
                    <label for="fullname" class="form-label block text-gray-700 mb-2">Full name</label>
                    <div class="mb-4 relative">
                        <img src="{{ asset('icons/profile.svg') }}" alt="profile_icon"
                            class="absolute size-6 top-2 left-3">
                        <input type="text"
                            class="form-control w-full py-2 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            id="fullname" name="fullname" value="" required>
                    </div>
                    <label for="email" class="form-label block text-gray-700 mb-2">Email</label>
                    <div class="mb-4 relative">
                        <img src="{{ asset('icons/at-sign.svg') }}" alt="email_icon"
                            class="absolute size-6 top-2 left-3">
                        <input type="text"
                            class="form-control w-full py-2 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            id="email" name="email" value="" required>
                    </div>
                    <label for="password" class="form-label block text-gray-700 mb-2">Password</label>
                    <div class="mb-4 relative">
                        <img src="{{ asset('icons/lock.svg') }}" alt="password_icon"
                            class="absolute size-6 top-2 left-3">
                        <input type="password"
                            class="form-control w-full py-2 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            id="password" name="password" value="" required>
                    </div>
                </div>
        
                <!-- Button aligned to the right -->
                <div class="flex justify-end">
                    <button class="bg-custom-blue text-white px-6 py-2 rounded-md" type="submit">Submit</button>
                </div>
            </form>
        </div>
        
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
</body>

</html>
