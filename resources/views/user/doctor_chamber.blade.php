@extends('layouts.navbar')
@section('content')
    @foreach ($doctors as $doctor)
        <div class="bg-white p-4 space-y-1 rounded-lg shadow-md text-center mb-3">
            <img src="{{ asset('storage/' . $doctor->photo) }}" class="mx-auto w-24 h-28 rounded-md object-cover mb-4">
            <h3 class="text-lg font-bold text-blue-600">{{ $doctor->name }}</h3>
            <h3 class="text-lg font-bold ">{{ $doctor->degree }}</h3>
            <p class="text-sm text-red-500 font-semibold mt-1">{{ $doctor->specialization->name }}</p>
            <p class="text-base  mt-2">{{ $doctor->hospital->name }}</p>
            @php
                $stars = floor($doctor->rating);
            @endphp
            <div class="flex justify-center mt-1 text-yellow-500">
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < $stars)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
                <span class="ml-2 text-gray-600 text-sm">{{ number_format($doctor->rating, 1) }}/5</span>
            </div>

        </div>
        {{-- Show Chamber Section --}}
        <div class="bg-white py-5 space-y-1 rounded-lg shadow-md text-center mb-3">
            <h3 class="text-lg font-bold">Chamber & Appointment</h3>
            <hr class="border-t border-gray-300">

            @forelse($doctor->chambers as $chamber)
                <div class="mb-4">
                    <p class="text-blue-600 font-semibold">
                        Location: {{ $chamber->location->name ?? 'N/A' }}
                    </p>
                    @foreach ($chamber->hospitals as $hospital)
                        <p>
                            Hospital: {{ $hospital->name ?? 'N/A' }}
                            <br>
                            Address: {{ $hospital->pivot->address ?? 'N/A' }}
                        </p>
                    @endforeach
                    <p class="text-sm font-bold mt-1">Visiting Hours: {{ $chamber->visiting_hour ?? 'N/A' }}</p>
                    <p>Appointment: {{ $chamber->phone ?? 'N/A' }}</p>
                    <button class="bg-blue-600 hover:bg-red-600 text-white text-sm px-4 py-1 rounded mt-1">Call Now</button>
                </div>
            @empty
                <p class="text-gray-500">No chambers found.</p>
            @endforelse
        </div>
        <div class="bg-white py-5 space-y-1 rounded-lg shadow-md text-center mb-3">
            <h3 class="text-lg font-bold">About {{ $doctor->name }}</h3>
            <hr class="border-t border-gray-300">
            <p class="text-gray-600 text-justify p-5">Prof. Col. Dr. Md. Nasir Uddin (Mahmud) is a highly accomplished
                Breast Surgeon and Oncoplastic Breast Surgeon in Dhaka, holding MBBS, FCPS in Surgery, FACS from America,
                and FMAS from India, and is a Gold Medalist in FCPS (Surgery). He has received Post Fellowship Training in
                Surgical Oncology from NICRH and Advanced Training in Breast Surgery from BSOS. Serving as a Professor of
                Surgery & Surgical Oncology at Combined Military Hospital (CMH), Dhaka, Dr. Nasir Uddin specializes in the
                diagnosis and treatment of breast cancer, benign breast lumps, breast infections, gynecomastia, oncoplastic
                breast reconstruction, and other breast-related diseases. He offers consultations at Labaid Specialized
                Hospital, Dhanmondi, located at Room 283, House # 06, Road # 04, Dhanmondi, Dhaka – 1205, with visiting
                hours from 6 pm to 10 pm, except on Fridays.</p>
        </div>
        <div class="bg-white py-5 space-y-1 rounded-lg shadow-md text-center mb-3">
            <div class="flex gap-2 w-full items-center justify-center">
                <img class="w-90" src="{{ asset('storage/' . $doctor->photo) }}" alt="">
                <img class="w-90" src="{{ asset('storage/' . $doctor->photo) }}" alt="">
            </div>
            <div class="flex gap-2 w-full items-center justify-center mt-5">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/bwx2Z69S0YA?si=5QbYG8UCqBkIJXd2"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            </div>
        </div>
    @endforeach
@endsection
