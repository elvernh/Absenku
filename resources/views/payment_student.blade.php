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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4] relative">

    <x-sidebar class="relative">
        <x-slot:type>{{ 'student' }}</x-slot:type>
    </x-sidebar>

    <x-layout_homepage class="relative">
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div class="flex w-full flex-wrap gap-5 mb-10">
           
           
        </div>
            <div class="flex">
                <a href={{ "/student". "/bayar"}} class=" text-white bg-green-600 flex items-center px-6 py-3 rounded-lg text-sm mb-5">
                    Bayar
                </a>
        </div>
       
        <h1 class="text-xl font-semibold mb-4">Riwayat Pembayaran</h1>

        <!-- Table Wrapper -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-100 text-gray-800 uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-center">Kode Pembayaran</th>
                        <th class="px-4 py-3 text-center">Jumlah</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($payments as $payment)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-center">{{ $i }}</td>
                            <td class="px-4 py-3 text-center">{{ $payment->payment_date }}</td>
                            <td class="px-4 py-3 text-center">{{ $payment->id }}</td>
                            <td class="px-4 py-3 text-center">{{ $payment->amount }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="px-2 py-1 rounded-lg text-white text-xs
                                    {{ $payment->status_payment == 'berhasil' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ ucfirst($payment->status_payment) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                {{ $payment->studentExcurVendors->excurVendor->extracurricular->name ?? 'Tidak Diketahui' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if ($payment->status_payment == 'gagal')
                                    <a href={{  "student/bayar/".$payment->id}} class="text-blue-500 hover:underline">Bayar Ulang</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @php
                            $i++;   
                            @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-layout_homepage>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });;
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {
                // Callback di sini
                // Pastikan tidak ada refresh halaman
            });;
        @endif
    </script>
</body>

</html>
