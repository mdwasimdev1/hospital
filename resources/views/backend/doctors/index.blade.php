@extends('layouts.sidebar')

@section('content')
    <button onclick="window.history.back()" class="bg-gray-300 text-black px-2 py-1 rounded">
        ← Go Back
    </button>
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
                <label class="block font-medium">Slug</label>
                <input type="text" name="slug" placeholder="Doctor Slug" class="w-full border rounded px-3 py-2"
                    required>
            </div>
            {{-- <div class="mb-4">
                <label class="block font-medium">Email</label>
                <input type="email" name="email" placeholder="Email" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Phone</label>
                <input type="text" name="phone" placeholder="Phone" class="w-full border rounded px-3 py-2" required>
            </div> --}}

            <div class="mb-4">
                <label class="block font-medium">Select Hospital</label>
                <select name="hospital_id" class="w-full border rounded px-3 py-2">
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Hospital Name</label>
                <input type="text" name="hospital_name" placeholder="Hospital Name"
                    class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Select Location</label>
                <select name="location_id" id="location" class="w-full border rounded px-3 py-2">
                    <option value="">Select Location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-2">Select Specialization</label>
                <select name="specialization_id" id="specialization">
                    {{-- dynamic specialization list --}}
                </select>
            </div>


            <div class="mb-4">
                <label class="block font-medium">Speciality</label>
                <input type="text" name="speciality" placeholder="Speciality" class="w-full border rounded px-3 py-2">

            </div>
            <div class="mb-4">
                <label class="block font-medium">Designation</label>
                <input type="text" name="designation" placeholder="Designation" class="w-full border rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label class="block font-medium">Degree</label>
                <input type="text" name="degree" placeholder="Degree" class="w-full border rounded px-3 py-2" required>
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
                <label class="block font-medium">YouTube Video Link</label>
                <input type="url" name="video_links" value="{{ old('video_links', $doctor->video_links ?? '') }}"
                    placeholder="Enter YouTube link (e.g. https://www.youtube.com/watch?v=xxxxxx)"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Position</label>
                <input type="text" name="position" placeholder="Position" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationSelect = document.getElementById('location');
            const specializationSelect = document.getElementById('specialization');

            // Initialize Tom Select for single selection
            const tomSelect = new TomSelect("#specialization", {
                placeholder: "Select specialization...",
                maxItems: 1, // single select
                create: false,
                persist: false,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                render: {
                    option: function(data, escape) {
                        return `<div class='py-1 px-2'>${escape(data.name)}</div>`;
                    },
                }
            });

            // When location changes, fetch new specializations
            locationSelect.addEventListener('change', function() {
                const locationId = this.value;

                tomSelect.clearOptions(); // Clear old options

                if (locationId) {
                    fetch(`/get-specializations/${locationId}`)
                        .then(res => res.json())
                        .then(data => {
                            tomSelect.addOptions(data);
                        });
                }
            });
        });
        </script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const locationSelect = document.getElementById('location');
            const specializationSelect = document.getElementById('specialization');

            // Initialize Tom Select for specialization
            const tomSelect = new TomSelect("#specialization", {
                plugins: ['remove_button'],
                placeholder: "Select specialization(s)...",
                maxItems: null,
                create: false,
                persist: false,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                render: {
                    option: function(data, escape) {
                        return `<div class='py-1 px-2'>${escape(data.name)}</div>`;
                    },
                }
            });

            // When location changes, fetch new specializations
            locationSelect.addEventListener('change', function() {
                const locationId = this.value;

                tomSelect.clearOptions(); // Clear old options

                if (locationId) {
                    fetch(`/get-specializations/${locationId}`)
                        .then(res => res.json())
                        .then(data => {
                            tomSelect.addOptions(data);
                        });
                }
            });
        });
    </script> --}}
@endsection
