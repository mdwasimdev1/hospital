@extends('layouts.sidebar')
@section('content')

    <div class="w-full container mx-auto p-4 flex flex-col lg:flex-row items-center justify-between gap-10">
        <div class="w-1/2">
            <h1 class="text-xl font-bold mb-4">All Locations</h1>

            <table class="min-w-full bg-white rounded shadow">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="py-2 px-4">ID</th>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $location->id }}</td>
                            <td class="py-2 px-4">{{ $location->name }}</td>
                            <td class="py-2 px-4">{{ $location->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 px-4 text-center text-gray-500">No locations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $locations->links() }}

            </div>
        </div>

        <div class="w-1/2">
            @if (session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <ul style="color: red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <label for="name" class="text-xl text-gray-700 font-bold mb-2">Location Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="form-control border p-2">
                <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </form>
        </div>
    </div>


@endsection
