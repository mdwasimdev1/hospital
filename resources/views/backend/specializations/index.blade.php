@extends('layouts.sidebar')
@section('content')
    <div class="w-full flex justify-between items-center gap-10">
        <div class="w-full">
            <h2 class="text-2xl font-bold mb-4">All Specializations</h2>

            <table  class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Location Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specializations as $specialization)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $specialization->id }}</td>
                            <td class="border px-4 py-2">{{ $specialization->name }}</td>
                            <td class="border px-4 py-2">{{ $specialization->location->name ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="w-full">
            @if (session('success'))
                <p style="color:green">{{ session('success') }}</p>
            @endif

            <form action="{{ route('specializations.store') }}" method="POST">
                @csrf

                <div class="w-full flex mb-5">
                    <label for="name" class="w-64 text-lg">Specialization Name:</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border rounded" required>
                    @error('name')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full flex mb-5">
                    <label for="location_id" class="w-64 text-lg">Select Location:</label>
                    <select name="location_id" id="location_id" class="w-full p-2 border rounded" required>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    @error('location_id')
                        <div style="color:red">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                    class="bg-teal-400 text-white px-4 py-2 rounded hover:bg-teal-700 transition">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
