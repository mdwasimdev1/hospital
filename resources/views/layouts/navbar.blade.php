<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Important for mobile -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <title>@yield('title', 'Default Title')</title>
    @yield('meta_description')
    @vite('resources/css/app.css')
</head>

<body class="bg-blue-50 max-w-3xl mx-auto font-sans mt-10 px-4"> <!-- Added px-4 for mobile padding -->


    @php
        $breadcrumbs = session('breadcrumbs', []);
    @endphp

    @if (count($breadcrumbs) > 1)
        <nav class="text-sm text-gray-600 mb-4">
            @foreach ($breadcrumbs as $index => $item)
                @if ($index !== count($breadcrumbs) - 1)
                    <a href="{{ $item['url'] }}" class="hover:underline text-blue-500">{{ $item['label'] }}</a> ›
                @else
                    <span>{{ $item['label'] }}</span>
                @endif
            @endforeach
        </nav>
    @endif



    <!-- Header -->
    <header class="container mx-auto">
        <!-- Logo Section -->
        <div class="bg-white shadow text-center mb-3 rounded-md p-2">
            <a href="{{ route('user.home') }}"><img src="{{ asset('images/logo-bgremove.jpeg') }}" alt="Logo"
                    class="w-60 h-auto mx-auto max-w-full"></a>
        </div>
        <div class="bg-white shadow text-center mb-3 rounded-md p-2">
            <a href="{{ route('add.doctor.profile') }}" class="inline-block underline text-secondary font-semibold">Join as a Doctor</a>
        </div>

        <!-- Navigation Dropdowns -->
        <div class="bg-primary shadow py-2 text-center rounded-md mb-3">
            <div class="flex flex-row sm:flex-row justify-center"> <!-- Stack on mobile, row on sm+ -->

                <!-- Doctors Dropdown -->
                <div class="w-full sm:w-1/2 relative group">
                    <a href="#" class="text-white font-semibold block py-2">Doctors</a>
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

                <!-- Hospitals Dropdown -->
                <div class="w-full sm:w-1/2 relative group">
                    <a href="#" class="text-white font-semibold block py-2">Hospitals</a>
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

    <!-- Main Content -->
    <main class="py-3">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 py-4">
        <!-- Footer Links -->
        <div class="bg-white shadow py-2 text-center border border-gray-300 rounded-md">
            <!-- Links will wrap on small screens -->
            <ul class="flex flex-wrap justify-center gap-4 text-primary text-xs sm:text-sm">
                <li><a href="{{ route('add.doctor.profile') }}">Add Profile</a></li>
                <li><a href="{{ route('contact.us') }}">Contact</a></li>
                <li><a href="{{ route('doctor.advertisement') }}">Advertisement</a></li>
                <li><a href="#">Payment</a></li>
                <li><a href="{{ route('about.us') }}">About</a></li>
                <li><a href="{{ route('privacy.policy') }}">Privacy</a></li>
                <li><a href="{{ route('disclaimer.statement') }}">Disclaimer</a></li>
            </ul>
        </div>

        <!-- Copyright -->
        <div class="bg-white shadow py-2 text-center border border-gray-300 rounded-md mt-2">
            &copy; {{ date('Y') }} Doctor Profile BD. All rights reserved.
        </div>
    </footer>

</body>

</html>
