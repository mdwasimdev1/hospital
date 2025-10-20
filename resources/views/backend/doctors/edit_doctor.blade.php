@extends('layouts.sidebar')

@section('content')
    <button onclick="window.history.back()" class="bg-gray-300 text-black px-2 py-1 rounded">
        ← Go Back
    </button>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl text-center font-bold mb-4">Edit Doctor</h2>

        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2"
                    value="{{ old('name', $doctor->name) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Slug</label>
                <input type="text" name="slug" class="w-full border rounded px-3 py-2"
                    value="{{ old('slug', $doctor->slug) }}" required>
            </div>





            <div class="mb-4">
                <label class="block font-medium">Select Hospital</label>
                <select name="hospital_id" class="w-full border rounded px-3 py-2">
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" {{ $doctor->hospital_id == $hospital->id ? 'selected' : '' }}>
                            {{ $hospital->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Hopital Name</label>
                <input type="text" name="hospital_name" class="w-full border rounded px-3 py-2"
                    value="{{ old('hospital_name', $doctor->hospital_name) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Select Location</label>
                <select name="location_id" class="w-full border rounded px-3 py-2">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ $doctor->location_id == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Select Specialization</label>
                <select name="specialization_id" class="w-full border rounded px-3 py-2">
                    @foreach ($specializations as $specialization)
                        <option value="{{ $specialization->id }}"
                            {{ $doctor->specialization_id == $specialization->id ? 'selected' : '' }}>
                            {{ $specialization->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">speciality</label>
                <input type="text" name="speciality" class="w-full border rounded px-3 py-2"
                    value="{{ old('speciality', $doctor->speciality) }}" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Designation</label>
                <input type="text" name="designation" class="w-full border rounded px-3 py-2"
                    value="{{ old('designation', $doctor->designation) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Degree</label>
                <input type="text" name="degree" class="w-full border rounded px-3 py-2"
                    value="{{ old('degree', $doctor->degree) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Photo</label>
                @if ($doctor->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Doctor Photo"
                            class="w-24 h-24 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="photo" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">About Doctor</label>
                <textarea name="about" class="w-full border rounded px-3 py-2">{{ old('about', $doctor->about) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Meta Title</label>
                <input type="text" name="meta_title" class="w-full border rounded px-3 py-2"
                    value="{{ old('meta_title', $doctor->meta_title) }}">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Meta Description</label>
                <textarea name="meta_description" class="w-full border rounded px-3 py-2">{{ old('meta_description', $doctor->meta_description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Preview Images</label>
                @if ($doctor->preview_images)
                    <div class="flex gap-2 flex-wrap mb-2">
                        @foreach (json_decode($doctor->preview_images, true) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Preview Image"
                                class="w-20 h-20 object-cover rounded">
                        @endforeach
                    </div>
                @endif
                <input type="file" name="preview_images[]" class="w-full border rounded px-3 py-2" multiple>
            </div>

            <div class="mb-4">
                <label class="block font-medium">YouTube Video Link</label>
                <input type="url" name="video_links"
                       value="{{ old('video_links', $doctor->video_links ?? '') }}"
                       placeholder="Enter YouTube link (e.g. https://www.youtube.com/watch?v=xxxxxx)"
                       class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block font-medium">Position</label>
                <input type="text" name="position" class="w-full border rounded px-3 py-2"
                    value="{{ old('position', $doctor->position) }}">
            </div>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Update</button>
        </form>
    </div>
@endsection
