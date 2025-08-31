@extends('layouts.sidebar')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Hospital List</h2>

    @if (session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Contact</th>
                <th class="border px-4 py-2">Image</th>
                <th class="border px-4 py-2">Locations</th>
                <th class="border px-4 py-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hospitals as $hospital)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $hospital->id }}</td>
                    <td class="border px-4 py-2">{{ $hospital->name }}</td>
                    <td class="border px-4 py-2">{{ $hospital->contact }}</td>
                    <td class="border px-4 py-2">
                        @if ($hospital->image)
                            <img src="{{ asset('storage/' . $hospital->image) }}" alt="Image" class="w-16 h-16 object-cover">
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @foreach ($hospital->locations as $location)
                            <div>{{ $location->name }} ({{ $location->pivot->address }})</div>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">{{ $hospital->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No hospitals found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $hospitals->links() }}
    </div>
</div>
@endsection
