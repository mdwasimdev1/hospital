@extends('layouts.navbar')
@section('title', $hospital->meta_title ?? $hospital->name)
{{-- @section('meta_description')
    <meta name="description"
        content="{{ $hospital->meta_description ?? 'Doctors available at ' . $hospital->name . ' in ' . $location->name }}">
@endsection --}}

@section('content')

    {{-- <div class="bg-white shadow py-2 px-1 text-center mb-3 rounded-md">
    <h1 class="text-base font-bold">{{ $hospital->name }} {{ $hospital->locations->first()?->pivot?->address }} Doctor List & Contact</h1>
    <p class="text-primary"></p>
</div> --}}


    @if ($hospital->image)
        <img src="{{ asset($hospital->image) }}" alt="{{ $hospital->name }}" class="my-4 w-full md:h-80">
    @endif

    <div class="bg-white shadow py-2 px-1 text-center mb-3 rounded-md">
        <h1 class="text-base font-bold">Address & Contact</h1>
        <hr class="border-t border-gray-300">
        <h1 class="text-base font-bold">{{ $hospital->name }}</h1>
        <p><span class="font-semibold">Address:</span> {{ $hospital->locations->first()?->pivot?->address }}</p>
        <p><span class="font-semibold">Contact:</span> {{ $hospital->contact }}</p>
        @if (!empty($hospital->contact))
            <a href="tel:{{ $hospital->contact }}"
                class="inline-block bg-primary hover:bg-secondary text-white text-sm px-4 py-2 rounded mt-2 transition">
                Call Now
            </a>
        @else
            <button disabled class="bg-gray-400 text-white text-sm px-4 py-2 rounded mt-2 cursor-not-allowed">
                Phone Unavailable
            </button>
        @endif
    </div>

    <div class="bg-white shadow py-2 px-1 text-center mb-3 rounded-md">
        <h1 class="text-base font-bold">{{ $hospital->title }}</h1>
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
