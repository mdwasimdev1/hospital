<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <title>{{ $title ?? 'Doctors Profile BD' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="md:flex ">
        <!-- Sidebar (Desktop) -->
        <div id="sidebar"
            class="hidden lg:flex lg:flex-col lg:w-64 lg:h-screen bg-gray-800 text-white transition-all duration-300 ">
            <div class=" text-2xl font-bold border-b border-gray-700">
                <img src="{{ asset('images/logo-bgremove.jpeg') }}" alt="">
            </div>
            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>

                <!-- User Dropdown -->
                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700"
                        onclick="toggleDropdown('userMenu')">
                        Hospitals
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-userMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="userMenu" class="hidden ml-6 mt-1 space-y-1 dropdown">
                        <a href="{{ route('hospitals.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">All
                            Hospitals</a>
                        <a href="{{ route('hospitals.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Add
                            Hospital</a>
                    </div>
                </div>

                <!-- Product Dropdown -->
                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700"
                        onclick="toggleDropdown('productMenu')">
                        Doctors
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-productMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="productMenu" class="hidden ml-6 mt-1 space-y-1 dropdown">
                        <a href="{{ route('doctors.list') }}" class="block px-4 py-2 rounded hover:bg-gray-700">All
                            Doctors</a>
                        <a href="{{ route('doctors.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Add
                            Doctor</a>
                        <a href="{{ route('chambers.create') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Add
                            Chamber</a>
                        <a href="{{ route('chambers.list') }}" class="block px-4 py-2 rounded hover:bg-gray-600">Chamber
                            List</a>
                    </div>
                </div>
                <div>
                    <a href="{{ route('doctors.request') }}" class="block px-4 py-2 rounded hover:bg-gray-600">Doctors
                        Request</a>
                </div>
                <div>
                    <a href="{{ route('locations.create') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-600">Locations</a>
                </div>
                <div>
                    <a href="{{ route('specializations.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-600">Specialization</a>
                </div>
                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700"
                        onclick="toggleDropdown('settingsMenu')">
                        Settings
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-settingsMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="settingsMenu" class="hidden ml-2 mt-1 dropdown">
                        <a href="{{ route('payment.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700">payment
                            Condition</a>
                        <a href="{{ route('doctors.list') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Contact</a>
                        <a href="{{ route('aboutUs.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">About</a>
                        <a href="{{ route('doctors.list') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Payment</a>
                        <a href="{{ route('privacy.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Privacy</a>
                        <a href="{{ route('advertisement.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Advertisement</a>
                        <a href="{{ route('advertisement.position') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Ad Position</a>
                        <a href="{{ route('disclaimer.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Disclaimer</a>
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>






        <!-- Mobile Navbar -->
        <div class="w-full lg:hidden bg-gray-800 text-white">
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <div class="text-xl font-bold">
                    <img src="{{ asset('images/logo-bgremove.jpeg') }}" alt="">
                </div>
                <button id="menu-toggle" class="focus:outline-none">
                    <svg id="hamburger" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close" xmlns="http://www.w3.org/2000/svg" class="hidden w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div id="mobile-menu" class="hidden space-y-2 px-4 py-2 bg-gray-700">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-600">Dashboard</a>

                <!-- User Dropdown Mobile -->
                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-600"
                        onclick="toggleDropdown('mobileUserMenu')">
                        Hospitals
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-mobileUserMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobileUserMenu" class="hidden ml-6 mt-1 space-y-1 dropdown">
                        <a href="{{ route('hospitals.index') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-600">All Hospital</a>
                        <a href="{{ route('hospitals.create') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-600">Add Hospital</a>
                    </div>
                </div>

                <!-- Product Dropdown Mobile -->
                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-600"
                        onclick="toggleDropdown('mobileProductMenu')">
                        Doctors
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-mobileProductMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobileProductMenu" class="hidden ml-6 mt-1 space-y-1 dropdown">
                        <a href="{{ route('doctors.list') }}" class="block px-4 py-2 rounded hover:bg-gray-600">All
                            Doctors</a>
                        <a href="{{ route('doctors.create') }}" class="block px-4 py-2 rounded hover:bg-gray-600">Add
                            Doctor</a>
                        <a href="{{ route('chambers.create') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-600">Add chamber</a>
                        <a href="{{ route('chambers.list') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-600">Chamber List</a>
                    </div>
                </div>

                <div>
                    <a href="{{ route('doctors.request') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-600">Doctors Request</a>
                </div>
                <div>
                    <a href="{{ route('locations.create') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-600">Locations</a>
                </div>

                <div>
                    <a href="{{ route('specializations.index') }}"
                        class="block px-4 py-2 rounded hover:bg-gray-600">Specialization</a>
                </div>

                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-700"
                        onclick="toggleDropdown('settingsMenu')">
                        Settings
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-settingsMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="settingsMenu" class="hidden ml-6 mt-1 space-y-1 dropdown">
                        <a href="{{ route('payment.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Payment Condition</a>
                        <a href="{{ route('doctors.list') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Contact</a>
                        <a href="{{ route('aboutUs.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">About</a>
                        <a href="{{ route('doctors.list') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Payment</a>
                        <a href="{{ route('privacy.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Privacy</a>
                        <a href="{{ route('advertisement.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Advertisement</a>
                        <a href="{{ route('advertisement.position') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Advertisement Position</a>
                        <a href="{{ route('disclaimer.edit') }}"
                            class="block px-4 py-2 rounded hover:bg-gray-700">Disclaimer</a>
                    </div>
                </div>

                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full min-h-screen bg-gray-100">
            <div class="w-full px-4 lg:px-8">
                <div class="max-w-7xl mx-auto py-8">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>


    @vite('resources/js/app.js')
</body>

</html>
