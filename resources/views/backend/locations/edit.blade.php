@extends('layouts.sidebar')
@section('content')
    <button onclick="window.history.back()" class="bg-gray-300 text-black px-4 py-2 rounded">
        ← Go Back
    </button>
    <div class="max-w-3xl mx-auto text-center p-6 ">

        <form action="{{ isset($location) ? route('locations.update', $location->id) : route('locations.store') }}"
            method="POST">
            @csrf
            @if (isset($location))
                @method('PUT')
            @endif

            {{-- <label for="name" class="block font-medium">Location Name</label> --}}
            <input type="text" name="name" value="{{ old('name', $location->name ?? '') }}"
                class=" border rounded px-4 py-2">

            <button type="submit" class="bg-secondary text-white px-4 py-2 rounded">
                {{ isset($location) ? 'Update' : 'Create' }}
            </button>
        </form>

    </div>
@endsection
