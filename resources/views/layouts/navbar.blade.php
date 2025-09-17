<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>@yield('title', 'Default Title')</title>
    @yield('meta_description')
    @vite('resources/css/app.css')
</head>

<body class="bg-blue-50 max-w-3xl mx-auto font-sans mt-10">

    <!-- Header -->
    <header class="container mx-auto">
        <div class=" bg-white shadow text-center mb-3 rounded-md">
            <img src="{{ asset('images/logo-bgremove.jpeg') }}" alt="Logo" class="w-60 h-auto mx-auto">
        </div>

        <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
            <a href="#" class="text-primary font-semibold underline">Search Doctors</a>
        </div>

        <div class="bg-primary shadow py-2 text-center rounded-md mb-3">
            <div class="flex justify-center">
                <!-- Doctors dropdown -->
                <div class="w-1/2 relative group">
                    <a href="#" class="text-white font-semibold">Doctors</a>
                    <div
                        class="absolute left-0 w-full bg-primary rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                        <ul class="py-2">
                            @foreach ($locations as $location)
                                <li>
                                    <a href="{{ route('doctors.by.location', ['locationName' => $location->slug]) }}"
                                        class="block px-4 py-2 text-white border-b bg-primary">
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
                        class="absolute left-0 w-full bg-primary rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 z-50">
                        <ul class="py-2">
                            @foreach ($locations as $location)
                                <li>
                                    <a href="{{ route('hospitals.by.location', ['locationName' => $location->slug]) }}"
                                        class="block px-4 py-2 text-white border-b bg-primary">
                                        {{ $location->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- Content -->
    <main class="py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500  py-4">
        <div
            class="bg-white shadow py-2 text-center border border-gray-300 rounded-md flex justify-center gap-5 text-primary ">
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
