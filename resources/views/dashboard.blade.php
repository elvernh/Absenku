<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4] relative">
    <x-sidebar class="relative">
        <x-slot:type>{{ 'school' }}</x-slot:type>
    </x-sidebar>
    <x-layout_homepage class="relative">
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <div>

            <div class="flex w-full flex-wrap  gap-5">
                <x-box>
                    <x-slot:text>Jumlah Extrakulikuler</x-slot:text>
                    <x-slot:value>{{ $excurCount }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Murid</x-slot:text>
                    <x-slot:value>{{ $studentCount }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Vendor</x-slot:text>
                    <x-slot:value>{{ $vendorCount }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Ekstrakulikuler Aktif</x-slot:text>
                    <x-slot:value>{{ $excurVendorCount }}</x-slot:value>
                </x-box>

            </div>
            <div class="mt-10 w-full  flex flex-wrap justify-between  mb-10">
                <!-- Table Section -->
                <div class="w-full xl:w-1/2">
                    <div class="flex items-center mb-4">
                        <div class="flex w-full justify-between">
                            <h2 class="text-2xl font-bold">Pertemuan Hari Ini</h2>
                            <div class="p-2 bg-green-600 rounded-lg">
                                <a href="create/meeting" class="text-white">Buat pertemuan</a>
                            </div>
                        </div>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px] border-slate-600">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Ekstrakurikuler</th>
                                    <th scope="col" class="px-6 py-3">Divisi</th>
                                    <th scope="col" class="px-6 py-3">Level</th>
                                    <th scope="col" class="px-6 py-3">Vendor</th>
                                    <th scope="col" class="px-6 py-3">Jam</th>

                                    <th scope="col" class="px-6 py-3">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($meetingsToday)
                                    @foreach ($meetingsToday as $meetingToday)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $meetingToday->excurVendor->extracurricular->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $meetingToday->excurVendor->extracurricular->division }}</td>
                                            <td class="px-6 py-4">
                                                {{ $meetingToday->excurVendor->extracurricular->level }}</td>
                                                <td class="px-6 py-4">
                                                    {{ $meetingToday->excurVendor->vendor->name }}</td>
                                            <td class="px-6 py-4">{{ $meetingToday->excurVendor->start_time }} -
                                                {{ $meetingToday->excurVendor->end_time }}</td>
                                            <td class="px-6 py-4">{{ $meetingToday->status }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            Tidak ada pertemuan hari ini.
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Calendar Section (50% width on medium screens and above) -->
            <div class="w-full md:w-[40%] bg-white rounded-lg shadow-md mt-8 md:mt-0">
                <div class="bg-custom-blue text-white rounded-t-lg flex items-center justify-between">
                    <!-- Previous Month Button -->
                    <button id="prev-month" class="px-4 py-2 text-lg font-medium">
                        &lt; Prev
                    </button>

                    <!-- Month and Year Display -->
                    <h2 id="month-year-display" class="text-2xl font-medium p-4">
                        {{ \Carbon\Carbon::now()->format('F Y') }}</h2>

                    <!-- Next Month Button -->
                    <button id="next-month" class="px-4 py-2 text-lg font-medium">
                        Next &gt;
                    </button>
                </div>

                <div class="grid grid-cols-7 gap-2 px-4 pt-4 pb-6">
                    <!-- Weekdays -->
                    <div class="text-center font-bold">Sun</div>
                    <div class="text-center font-bold">Mon</div>
                    <div class="text-center font-bold">Tue</div>
                    <div class="text-center font-bold">Wed</div>
                    <div class="text-center font-bold">Thu</div>
                    <div class="text-center font-bold">Fri</div>
                    <div class="text-center font-bold">Sat</div>
                </div>

                <!-- Calendar Days -->
                <div id="calendar-days" class="grid grid-cols-7 gap-2 px-4 pt-4 pb-6">
                    <!-- Dynamic calendar days will be inserted here by JavaScript -->
                </div>
            </div>


            </div>

            <div class="w-full xl:w-[70%]">
                <div class="flex items-center mb-4">
                    <h2 class="text-2xl font-bold">Daftar Vendor</h2>
                    <div class="ms-20 text-white bg-green-600 flex ps-4 pt-2 pb-2 pe-4 rounded-lg">
                        <a href="/school/addvendor" class="text-sm">Tambah Vendor</a>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px] border-slate-600">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">id</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Alamat</th>
                                <th scope="col" class="px-6 py-3">Nomor Telepon</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">Jumlah Ekskul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $vendor)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $vendor->id }}</td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $vendor->name }}
                                    </th>
                                    <td class="px-6 py-4">{{ $vendor->address }}</td>
                                    <td class="px-6 py-4">{{ $vendor->phone }}</td>
                                    <td class="px-6 py-4">{{ $vendor->email }}</td>
                                    <td class="px-6 py-4">{{ $vendor->description }}</td>
                                    <td class="px-6 py-4">{{ count($vendor->excurVendors) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <img src="images/aset1.png" alt=""
                class="absolute left-[-90px] sm:left-[-70px] md:left-[-30px] lg:left-[-40px] w-[300px] sm:w-[350px] md:w-[400px] lg:w-[450px] mb-4">
            <img src="images/aset5.png" alt=""
                class="absolute  right-[3px] sm:right-[-10px] md:right-[-20px] lg:right-[0px] w-[260px] sm:w-[300px] md:w-[350px] lg:w-[400px] mb-4">

    </x-layout_homepage>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('pieChart');
            if (!canvas) {
                console.error('Canvas element with id "pieChart" not found.');
                return;
            }

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {

                    labels: ['Completed', 'Remaining', 'Test'],
                    datasets: [{
                        data: [25, 25, 50],
                        backgroundColor: ['#4CAF50', '#E0E0E0', '#1E1E1E'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Ensure it resizes proportionally
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                },
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success').then(() => {

            });;;
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {

            });;;
        @endif
    </script>
    <script>
        // Initialize current month and year
        let currentMonth = {{ \Carbon\Carbon::now()->month }};
        let currentYear = {{ \Carbon\Carbon::now()->year }};

        // Update calendar display
        function updateCalendar() {
            // Update the month and year display
            const monthYearDisplay = document.getElementById('month-year-display');
            monthYearDisplay.innerText = new Date(currentYear, currentMonth - 1).toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });

            // Clear the current days
            const calendarDays = document.getElementById('calendar-days');
            calendarDays.innerHTML = '';

            // Get the first day of the month (0 = Sunday, 6 = Saturday)
            const firstDayOfMonth = new Date(currentYear, currentMonth - 1, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();

            // Add empty divs for days before the first day
            for (let i = 0; i < firstDayOfMonth; i++) {
                const emptyDiv = document.createElement('div');
                calendarDays.appendChild(emptyDiv);
            }

            // Add the days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dateDiv = document.createElement('div');
                const date = new Date(currentYear, currentMonth - 1, day);
                const isToday = new Date().toDateString() === date.toDateString(); // Check if today is the current day

                // Highlight today
                if (isToday) {
                    dateDiv.classList.add('bg-custom-blue', 'text-white', 'font-medium', 'rounded-sm');
                } else {
                    dateDiv.classList.add('hover:bg-custom-blue', 'hover:text-white', 'cursor-pointer', 'hover:rounded-sm');
                }
                dateDiv.classList.add('text-center', 'py-2');
                dateDiv.innerText = day;
                calendarDays.appendChild(dateDiv);
            }
        }

        // Previous month button click handler
        document.getElementById('prev-month').addEventListener('click', () => {
            if (currentMonth === 1) {
                currentMonth = 12;
                currentYear--;
            } else {
                currentMonth--;
            }
            updateCalendar();
        });

        // Next month button click handler
        document.getElementById('next-month').addEventListener('click', () => {
            if (currentMonth === 12) {
                currentMonth = 1;
                currentYear++;
            } else {
                currentMonth++;
            }
            updateCalendar();
        });

        // Initialize the calendar
        updateCalendar();
    </script>

</body>

</html>
