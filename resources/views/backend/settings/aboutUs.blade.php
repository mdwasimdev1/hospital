@extends('layouts.sidebar') {{-- Use your layout here --}}

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-xl font-semibold mb-4">Update About Us</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('aboutUs.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            @if($about->image)
                <img class="border w-40" src="{{ asset($about->image) }}" width="150" class="mb-2">
            @endif
            <input type="file" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <label for="home_description" class="block text-sm font-bold text-gray-700 mb-2">Home Description</label>
            <textarea class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" name="home_description" rows="4">{{ old('home_description', $about->home_description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">About Description</label>
            <textarea class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" name="description" rows="4">{{ old('description', $about->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="why_create_website" class="block text-sm font-bold text-gray-700 mb-2">Why Was This Website Created?</label>
            <textarea class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" name="why_create_website" rows="3">{{ old('why_create_website', $about->why_create_website) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="comment" class="block text-sm font-bold text-gray-700 mb-2">Comment</label>
            <textarea class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" name="comment" rows="3">{{ old('comment', $about->comment) }}</textarea>
        </div>



        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update About Us</button>
    </form>
</div>

@endsection
