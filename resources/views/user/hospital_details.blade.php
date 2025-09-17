@extends('layouts.navbar')
@section('title', $hospital->meta_title ?? $hospital->name)
@section('meta_description')
    <meta name="description"
        content="{{ $hospital->meta_description ?? 'Doctors available at ' . $hospital->name . ' in ' . $location->name }}">
@endsection

@section('content')

<div class="bg-white shadow py-2 text-center mb-3 rounded-md">
    <h1 class="text-2xl font-bold">{{ $hospital->name }} {{ $hospital->locations->first()?->pivot?->address }} Doctor List & Contact</h1>
    <p class="text-primary"></p>
</div>


    @if ($hospital->image)
        <img src="{{ asset('storage/' . $hospital->image) }}" alt="{{ $hospital->name }}" class="my-4 w-full h-80">
    @endif

    <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
        <h1 class="text-2xl font-bold">Address & Contact</h1>
        <hr class="border-t border-gray-300">
        <h1 class="text-2xl font-bold">{{ $hospital->name }} in {{ $hospital->locations->first()?->pivot?->address }}</h1>
        <p>Address: {{ $hospital->locations->first()?->pivot?->address }}</p>
        <p>Contact: {{ $hospital->contact }}</p>
        <button class="bg-primary hover:bg-red-600 text-white text-sm px-4 py-1 rounded mt-1">Call Now</button>
    </div>

    <div class="bg-white shadow py-2 text-center mb-3 rounded-md">
        <h1 class="text-2xl font-bold">Doctor List Of {{ $hospital->name }} in {{ $hospital->locations->first()?->pivot?->address }}</h1>
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
