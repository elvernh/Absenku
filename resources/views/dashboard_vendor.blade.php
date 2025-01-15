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

</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>

        <x-slot:type>{{ 'vendor' }}</x-slot:type>
    </x-sidebar>

    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <div class="flex flex-wrap gap-5">
            <div
                class="flex  items-center bg-white p-4 xl:w-[23%] md:w-[30%] w-[100%] h-[100px] shadow border-s-[10px] border-custom-blue rounded-md">
                <img src="{{ asset('icons/smile.svg') }}" alt=null class="size-14 mr-4">
                <p class="font-bold">Jumlah Ekskul : <span class="font-normal">{{ $jumlahEkskul }}</span></p>
            </div>
            <div
                class="flex  items-center bg-white p-4 xl:w-[23%] md:w-[30%] w-[100%] h-[100px] shadow border-s-[10px] border-custom-blue rounded-md">
                <img src="{{ asset('icons/students.svg') }}" alt=null class="size-14 mr-4">
                <p class="font-bold">Jumlah Murid : <span class="font-normal">{{ $jumlahEkskul }}</span></p>
            </div>
        </div>
        <div class="mt-10 flex flex-col md:flex-row gap-8">


            <!-- Jadwal Hari Ini Table (50% width on medium screens and above) -->
            <div class="w-full md:w-[60%]">
                <div class="flex p-3 items-center">
                    <h2 class="text-2xl font-bold">Pertemuan Hari Ini</h2>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full border-[1px] border-slate-600">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-custom-blue">
                            <tr>
                                <th scope="col" class="px-6 py-3">Ekstrakurikuler</th>
                                <th scope="col" class="px-6 py-3">Divisi</th>
                                <th scope="col" class="px-6 py-3">Level</th>
                                <th scope="col" class="px-6 py-3">Vendor</th>
                                <th scope="col" class="px-6 py-3">Jam</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($meetingsToday as $meetingToday)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $meetingToday->excurVendor->extracurricular->name}}
                                    </th>
                                    <td class="px-6 py-4">{{ $meetingToday->excurVendor->extracurricular->division}}</td>
                                    <td class="px-6 py-4">{{ $meetingToday->excurVendor->extracurricular->level}}</td>
                                    <td class="px-6 py-4">{{ $meetingToday->excurVendor->vendor->name}}</td>
                                    <td class="px-6 py-4">{{ $meetingToday->excurVendor->start_time}} - {{ $meetingToday->excurVendor->end_time}}</td>
                                    <td class="px-6 py-4">{{ $meetingToday->status}}</td>
                                    <td class="px-6 py-4"><a href="buatabsen/{{ $meetingToday->id }}">buat absen</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">
                                        Tidak ada jadwal untuk hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Calendar Section (50% width on medium screens and above) -->
            <div class="w-full md:w-1/2 bg-white rounded-lg shadow-md mt-8 md:mt-0">
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



    </x-layout_homepage>
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
