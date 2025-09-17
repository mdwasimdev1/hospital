@extends('layouts.navbar')
{{-- @section('title')
   Specialist Doctors in {{ $location->name ?? 'Unknown Location' }} for {{ $specialization->name ?? 'General' }}
@endsection


@section('meta_description')
    <meta name="description" content="Find doctors in {{ $location->name }} who specialize in {{ $specialization->name }}. Browse profiles, check availability, and book appointments.">
@endsection --}}




@section('content')
    <div class="container mx-auto">

        <div class="relative mb-4">
            @if ($specializations->count())
                <div class="w-full  rounded-md  z-50">
                    <ul class="py-2">
                        @foreach ($specializations as $specialization)
                            <li>
                                <a href="{{ route('doctors.by.location.specialization', ['specializationSlug' => $specialization->slug, 'locationSlug' => $specialization->location->slug]) }}"
                                    class="block px-4 py-2 mb-3 text-primary text-center bg-white border border-gray-300 rounded-md">
                                    {{ $specialization->name }} in {{ $specialization->location->name ?? 'N/A' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="relative mb-4">
            @if ($hospitals->count())
                <div class="w-full  rounded-md  z-50">
                    <ul class="py-2">
                        @foreach ($hospitals as $hospital)
                            <li>
                                <a href="{{ route('hospital.details', ['location' => $hospital->locations->first()->slug, 'hospital' => $hospital->slug]) }}"
                                    class="block px-4 py-2 mb-3 text-primary text-center bg-white border border-gray-300 rounded-md">
                                    {{ $hospital->name }} in @if ($hospital->locations && $hospital->locations->count())
                                        {{ $hospital->locations->first()->name }}
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        @if ($doctors->count())
            <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
                <h2 class="text-xl font-bold">
                   Specialist Doctors list in {{ $location->name }} for {{ $specialization->name }}
                </h2>
            </div>
            <div class="grid grid-cols-1 space-y-3">
                @foreach ($doctors as $doctor)
                    @include('user.doctor_card', ['doctor' => $doctor])
                @endforeach
            </div>
        @endif

    </div>
@endsection
