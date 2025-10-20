@extends('layouts.sidebar')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-xl font-semibold mb-4">Edit Disclaimer</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('disclaimer.update') }}" method="POST">
        @csrf

        <label for="disclaimer" class="block text-sm font-medium text-gray-700 mb-2">Disclaimer Text</label>
        <textarea name="disclaimer" id="disclaimer" rows="6" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('disclaimer', $disclaimer->disclaimer ?? '') }}</textarea>

        @error('disclaimer')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update Disclaimer</button>
    </form>
</div>
@endsection
