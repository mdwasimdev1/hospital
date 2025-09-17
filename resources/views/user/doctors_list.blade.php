@extends('layouts.navbar')

@section('title')
   Specialist Doctors in {{ $location->name }} for {{ $specialization->name }}
@endsection

@section('meta_description')
    <meta name="description" content="Find doctors in {{ $location->name }} who specialize in {{ $specialization->name }}. Browse profiles, check availability, and book appointments.">
@endsection

@section('content')
    <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
        <h2 class="text-xl font-bold">
            Doctors in {{ $location->name }} for {{ $specialization->name }}
        </h2>
    </div>



    @if ($doctors->count())
        <div class="grid grid-cols-1 space-y-3">
            @foreach ($doctors as $doctor)
                @include('user.doctor_card', ['doctor' => $doctor])
            @endforeach
        </div>
    @else
        <p class="text-center mb-5 text-red-600">No doctors found.</p>
    @endif


@endsection
