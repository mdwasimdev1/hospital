@extends('layouts.sidebar')
@section('content')

    <button onclick="window.history.back()" class="bg-gray-300 text-black px-4 py-2 rounded mb-4">
        ← Go Back
    </button>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

        <form action="{{ isset($specialization) ? route('specializations.update', $specialization->id) : route('specializations.store') }}"
              method="POST">
            @csrf
            @if (isset($specialization))
                @method('PUT')
            @endif

            {{-- Specialization Name --}}
            <div class="mb-4">
                <label for="name" class="block text-left font-medium text-gray-700 mb-1">Specialization Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $specialization->name ?? '') }}"
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="slug" class="block text-left font-medium text-gray-700 mb-1">Specialization Slug</label>
                <input type="text" name="slug" id="slug"
                       value="{{ old('slug', $specialization->slug ?? '') }}"
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('slug')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location Select --}}
            <div class="mb-6">
                <label for="location_id" class="block text-left font-medium text-gray-700 mb-1">Select Location</label>
                <select name="location_id" id="location_id"
                        class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="">-- Select Location --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}"
                            {{ old('location_id', $specialization->location_id ?? '') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="name" class="block text-left font-medium text-gray-700 mb-1">Specialization Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $specialization->title ?? '') }}"
                       class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-left font-medium text-gray-700 mb-1">Specialization Description</label>
                <textarea name="description" id="description" cols="30" rows="5"
                          class="w-full border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description', $specialization->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-center">
                <button type="submit"
                        class="bg-secondary hover:bg-secondary-dark text-white px-6 py-2 rounded transition">
                    {{ isset($specialization) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>
@endsection
