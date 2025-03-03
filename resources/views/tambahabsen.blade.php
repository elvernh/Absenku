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

        <div class="w-full pt-16 space-y-8 bg-slate-500 ">
            <form action="{{ route('addMeeting', ['id' => $meeting->id]) }}" method="post"
                class="p-6 md:w-1/2 w-full bg-white shadow-lg rounded-xl mx-auto border border-gray-200">
                @csrf
                @method('POST')
                <!-- Title -->
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Update Meeting</h2>

                <!-- Topic -->
                <div class="mb-4">
                    <label for="topic" class="block text-lg font-medium text-gray-700">Topic</label>
                    <input type="text" id="topic" name="topic" value="{{ $meeting->topic }}"
                        class="mt-2 block w-full px-4 py-2 text-lg rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter the topic">
                </div>

                <div class="mb-4">
                    <label for="teacher" class="block text-lg font-medium text-gray-700">Teacher</label>
                    <input type="text" id="teacher" name="teacher" value="{{ $meeting->teacher }}"
                        class="mt-2 block w-full px-4 py-2 text-lg rounded-lg border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter the teacher's name">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full mt-4 px-4 py-2 text-lg font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        Submit
                    </button>
                </div>
            </form>







    </x-layout_homepage>

    <script></script>

</body>

</html>
