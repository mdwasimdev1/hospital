<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hospital' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="md:flex">
        <!-- Sidebar (Desktop) -->
        <div id="sidebar"
            class="hidden lg:flex lg:flex-col lg:w-64 lg:h-screen bg-gray-800 text-white transition-all duration-300">
            <div class="p-4 text-2xl font-bold border-b border-gray-700">
                Hospital
            </div>
            <nav class="flex-1 p-4 space-y-2">

                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">Dashboard</a>

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
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">All Hospitals</a>
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">Add Hospital</a>
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
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">All Doctors</a>
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">Add Doctor</a>
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">Doctor Chamber</a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Mobile Navbar -->
        <div class="w-full lg:hidden bg-gray-800 text-white">
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <div class="text-2xl font-bold">Hospital</div>
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
                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-600">Dashboard</a>

                <!-- User Dropdown Mobile -->
                <div>
                    <button class="w-full flex justify-between items-center px-4 py-2 rounded hover:bg-gray-600"
                        onclick="toggleDropdown('mobileUserMenu')">
                        Hospitals
                        <svg class="w-4 h-4 ml-2 transition-transform" id="icon-mobileUserMenu"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="mobileUserMenu" class="hidden ml-6 mt-1 space-y-1 dropdown">
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-600">All Hospital</a>
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-600">Add Hospital</a>
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
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-600">All Doctors</a>
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-600">Add Doctor</a>
                        <a href="#" class="block px-4 py-2 rounded hover:bg-gray-600">Doctors chamber</a>
                    </div>
                </div>


            </div>
        </div>

        <!-- Main Content -->
        <div class="">
            <!-- row -->
            <div class="container mx-auto">
                <div class="w-full p-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    @vite('resources/js/app.js')
</body>

</html>
