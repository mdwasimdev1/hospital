@extends('layouts.sidebar')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl text-center font-bold mb-4">Add Doctor</h2>
        <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Name</label>
                <input type="text" name="name" placeholder="Doctor Name" class="w-full border rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" placeholder="Email" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Phone</label>
                <input type="text" name="phone" placeholder="Phone" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Select Hospital</label>
                <select name="hospital_id" class="w-full border rounded px-3 py-2">
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Select Location</label>
                <select name="location_id" class="w-full border rounded px-3 py-2">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Select Specialization</label>
                <select name="specialization_id" class="w-full border rounded px-3 py-2">
                    @foreach ($specializations as $specialization)
                        <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Designation</label>
                <input type="text" name="designation" placeholder="Designation" class="w-full border rounded px-3 py-2"
                required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Photo</label>
                <input type="file" name="photo" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block font-medium">About Doctor</label>
                <textarea name="about" placeholder="About Doctor" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Meta Title</label>
                <input type="text" name="meta_title" placeholder="Meta Title" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block font-medium">Meta Description</label>
                <textarea name="meta_description" placeholder="Meta Description" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Preview Images</label>
                <input type="file" name="preview_images[]" class="w-full border rounded px-3 py-2" multiple>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Video Link</label>
                <input type="url" name="video_links[]" placeholder="Video Link" class="w-full border rounded px-3 py-2">
            </div>

            {{-- <input type="url" name="video_links[]" placeholder="Another Video Link"
                class="w-full border rounded px-3 py-2"> --}}

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>










    {{-- <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
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
                    @foreach ($specializations as $specialization)
                        <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Hospital</label>
                <select name="hospital_id" class="w-full border rounded px-3 py-2">
                    @foreach ($hospitals as $hospital)
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
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

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
    </div> --}}
@endsection
