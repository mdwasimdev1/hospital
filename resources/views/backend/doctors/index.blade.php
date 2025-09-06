@extends('layouts.sidebar')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Add Doctor</h2>
    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Phone</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Dropdowns for foreign keys -->
        <div class="mb-4">
            <label class="block font-medium">Specialization</label>
            <select name="specialization_id" class="w-full border rounded px-3 py-2">
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Hospital</label>
            <select name="hospital_id" class="w-full border rounded px-3 py-2">
                @foreach($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Designation</label>
            <input type="text" name="designation" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Location</label>
            <select name="location_id" class="w-full border rounded px-3 py-2">
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-4">
            <label class="block font-medium">Address</label>
            <select name="address_id" class="w-full border rounded px-3 py-2">
                @foreach($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->address_line }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-4">
            <label class="block font-medium">Chamber Name</label>
            <input type="text" name="chamber_name" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Chamber Address</label>
            <textarea name="chamber_address" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Photo</label>
            <input type="file" name="photo" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
