<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Doctor Bangladesh</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-blue-50 max-w-3xl mx-auto font-sans mt-10">

    <!-- Header -->
    <header class="container mx-auto">
        <div class=" bg-white shadow py-4 text-center mb-3 rounded-md">
            <i class="fa-solid fa-plus bg-blue-800 text-white
            rounded-full p-2 font-bold"></i>
            <h1 class="text-xl text-blue-800 font-bold">DOCTOR BANGLADESH</h1>
        </div>

        <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
            <a href="#" class="text-blue-800 underline">Search Doctors</a>
        </div>

        <div class="bg-blue-800 shadow py-2 text-center rounded-md mb-3">
            <div class="flex justify-center">
                <!-- Doctors dropdown -->
                <div class="w-1/2 relative group">
                    <a href="#" class="text-white font-semibold">Doctors</a>
                    <div
                        class="absolute left-0 w-full bg-blue-800 rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                        <ul class="py-2">
                            @foreach ($locations as $location)
                                <li>
                                    <a href="{{ route('doctors.by.location', ['locationName' => $location->slug]) }}"
                                        class="block px-4 py-2 text-white border-b bg-blue-800">
                                        {{ $location->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Hospitals dropdown -->
                <div class="w-1/2 relative group">
                    <a href="#" class="text-white font-semibold">Hospitals</a>
                    <div
                        class="absolute left-0 w-full bg-blue-800 rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                        <ul class="py-2">
                            @foreach ($locations as $location)
                                <li>
                                    <a href="{{ route('hospitals.by.location', ['locationName' => $location->slug]) }}"
                                        class="block px-4 py-2 text-white border-b bg-blue-800">
                                        {{ $location->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
            @php
                $selectedLocation = $locations->firstWhere('id', request()->get('location'));
                $specialization = request()->get('specialization');
                $hospital = request()->get('hospital');
            @endphp

            @if ($selectedLocation)
                @if ($specialization)
                    <a href="#" class="text-black text-xl">
                        Specialist Doctors List in {{ $selectedLocation->name }}
                    </a>
                @elseif ($hospital)
                    <a href="#" class="text-black text-xl">
                        Hospitals List in {{ $selectedLocation->name }}
                    </a>
                @else
                    <a href="#" class="text-black text-xl">
                        Listings in {{ $selectedLocation->name }}
                    </a>
                @endif
            @endif
        </div>

    </header>

    <!-- Content -->
    <main class="py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500  py-4">
        <div
            class="bg-white shadow py-2 text-center border border-gray-300 rounded-md flex justify-center gap-5 text-blue-800 ">
            <a href="#">Add Profile</a>
            <a href="#">Contact</a>
            <a href="#">Advertisement</a>
            <a href="#">Payment</a>
            <a href="#">About</a>
            <a href="#">Privacy</a>
            <a href="#">Disclaimer</a>
        </div>
        <div class="bg-white shadow py-2 text-center  border border-gray-300 rounded-md">
            &copy; {{ date('Y') }} Doctor Bangladesh. All rights reserved.
        </div>
    </footer>

</body>

</html>
