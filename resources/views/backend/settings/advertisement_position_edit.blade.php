@extends('layouts.sidebar')

@section('content')
<div class="w-full mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-xl font-semibold mb-6">Edit Advertisement Position</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('advertisement.position.update', $position->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label>Position</label>
            <input type="text" name="position" class="w-full border p-2 rounded"
                value="{{ $position->position }}" required>
        </div>

        <div class="mb-4">
            <label>Duration (e.g., 7 days, 1 month)</label>
            <input type="text" name="duration" class="w-full border p-2 rounded"
                value="{{ $position->duration }}" required>
        </div>

        <div class="mb-4">
            <label>Price</label>
            <input type="text"  name="price" class="w-full border p-2 rounded"
                value="{{ $position->price }}" required>
        </div>

        <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Add Advertisement Position</button>
    </form>
</div>

@endsection
