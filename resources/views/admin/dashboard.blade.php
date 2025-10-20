@extends('layouts.sidebar') <!-- যদি তুমি admin layout use করো -->

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- Total Hospitals Card -->
        <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
            <div class="text-center">
                <h2 class="text-gray-500 font-semibold">Total Hospitals</h2>
                <p id="hospitalCount" class="text-3xl font-bold text-primary">0</p>
            </div>
            <div class=" bg-blue-100 rounded-full p-3">
                <i class="fa-solid fa-hospital text-primary"></i>
            </div>
        </div>

        <!-- Total Doctors Card -->
        <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
            <div class="text-center">
                <h2 class="text-gray-500 font-semibold">Total Doctors</h2>
                <p id="doctorCount" class="text-3xl font-bold text-red-600">0</p>
            </div>
            <div class=" bg-red-100 rounded-full p-3">
                <i class="fa-solid fa-user-doctor text-red-600"></i>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
            <div class="text-center">
                <h2 class="text-gray-500 font-semibold">Total Doctors Request</h2>
                <p id="doctorRequestCount" class="text-3xl font-bold text-red-600">0</p>
            </div>
            <div class="text-red-600 bg-red-100 rounded-full p-3">
                <i class="fa-solid fa-hospital-user"></i>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
            <div class="text-center">
                <h2 class="text-gray-500 font-semibold">Total Specialization</h2>
                <p id="SpecialityCount" class="text-3xl font-bold text-green-600">0</p>
            </div>
            <div class=" bg-green-100 rounded-full p-3">
                <i class="fa-solid fa-star-of-life text-secondary"></i>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
            <div class="text-center">
                <h2 class="text-gray-500 font-semibold">Total Chambers</h2>
                <p id="chamberCount" class="text-3xl font-bold text-primary p-3 rounded-full">0</p>
            </div>
            <div class="text-primary bg-blue-100 rounded-full p-3">
                <i class="fa-solid fa-briefcase-medical"></i>
            </div>
        </div>

    </div>
</div>

<!-- Dynamic count animation with JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hospitalCount = {{ $totalHospitals }};
        const doctorCount = {{ $totalDoctors }};
        const doctorRequestCount = {{ $totalDoctorsRequest }};
        const SpecialityCount = {{ $totalSpecializations }};
        const chamberCount = {{ $totalChambers }};

        // Simple counter animation
        function animateCount(id, target) {
            let count = 0;
            let interval = setInterval(() => {
                count += Math.ceil(target / 100);
                if(count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                document.getElementById(id).innerText = count;
            }, 20);
        }

        animateCount('hospitalCount', hospitalCount);
        animateCount('doctorCount', doctorCount);
        animateCount('doctorRequestCount', doctorRequestCount);
        animateCount('SpecialityCount', SpecialityCount);
        animateCount('chamberCount', chamberCount);
    });
</script>
@endsection

