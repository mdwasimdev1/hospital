@extends('layouts.sidebar') <!-- jei layout use korcho -->

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Doctors List</h1>

    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Phone</th>
                <th class="border border-gray-300 px-4 py-2">Specialization</th>
                <th class="border border-gray-300 px-4 py-2">Hospital</th>
                <th class="border border-gray-300 px-4 py-2">Designation</th>
                <th class="border border-gray-300 px-4 py-2">Location</th>
                <th class="border border-gray-300 px-4 py-2">Address</th>
                <th class="border border-gray-300 px-4 py-2">Chamber Name</th>
                <th class="border border-gray-300 px-4 py-2">Chamber Address</th>
                <th class="border border-gray-300 px-4 py-2">Photo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->email }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->phone }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->specialization->name ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->hospital->name ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->designation }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->location->name ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->address->full_address ?? 'N/A' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->chamber_name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $doctor->chamber_address }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if ($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor Photo" class="h-16 w-16 object-cover rounded-full">
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $doctors->links() }} <!-- pagination links -->
    </div>
</div>
@endsection
