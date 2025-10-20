@extends('layouts.navbar')
@section('title')
    Doctor Profile BD - Specialist Doctors List in Bangladesh
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="relative mb-4">
            @if ($specializations->count())
                <div class="w-full  rounded-md  z-50">
                    <ul class="py-2">
                        @foreach ($specializations as $specialization)
                            <li>
                                @if ($specialization->location && $specialization->location->slug)
                                    <a href="{{ route('doctors.by.location.specialization', [
                                        'slug' => $specialization->slug]) }}"
                                        class="block px-4 py-2 mb-3 text-primary text-center bg-white border border-gray-300 rounded-md">{{ $specialization->name }}
                                        in {{ $specialization->location->name }}</a>
                                @else
                                    <span class="text-muted">{{ $specialization->name }} (Location N/A)</span>
                                @endif


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
                                <a href="{{ route('hospital.details', ['hospitalslug' => $hospital->slug]) }}"
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


        <div class="mb-3">
            @if ($doctors->count())
                <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
                    <h2 class="text-xl font-bold">
                        Newly Listed Doctors on Our Website
                    </h2>
                </div>
                <div class="grid grid-cols-1 space-y-3 mb-5">
                    @foreach ($doctors as $doctor)
                        @include('user.doctor_card', ['doctor' => $doctor])
                    @endforeach
                </div>
                <div class="bg-white shadow text-center rounded-md p-2">
                    <h2 class="text-xl font-semibold py-2">About Doctors Profile BD</h2>
                    <hr>
                    <p class="text-justify p-2">{{ $aboutUs->home_description }}</p>
                </div>
            @endif
        </div>


    </div>
@endsection
