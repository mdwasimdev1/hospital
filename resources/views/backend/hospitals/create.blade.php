@extends('layouts.sidebar')

@section('content')
    <button onclick="window.history.back()" class="bg-gray-300 text-black px-2 py-1 rounded">
        ← Go Back
    </button>
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow relative"> {{-- relative for dropdown positioning --}}
        <h2 class="text-2xl font-bold mb-4">Add Hospital</h2>

        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('hospitals.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Hospital Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name') }}"
                    required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Hospital Slug</label>
                <input type="text" name="slug" class="w-full border px-3 py-2 rounded" value="{{ old('slug') }}"
                    required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Hospital Title</label>
                <input type="text" name="title" class="w-full border px-3 py-2 rounded" value="{{ old('title') }}"
                    required>
            </div>


            <div class="mb-4">
                <label class="block mb-1 font-semibold">Contact</label>
                <input type="text" name="contact" class="w-full border px-3 py-2 rounded" value="{{ old('contact') }}"
                    required>
            </div>

            {{-- Location Multi Select --}}
            <div class="relative w-full mt-6">
                <label class="block text-gray-700 font-medium mb-2">Select Location(s)</label>

                <div id="locationSelectedBox"
                    class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white">
                    <span id="locationPlaceholder" class="text-gray-400">Select locations...</span>
                </div>

                {{-- Dropdown --}}
                <div id="locationDropdown"
                    class="hidden absolute mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                    @foreach ($locations as $location)
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                            onclick="selectLocation({{ $location->id }}, '{{ addslashes(str_replace("'", "\'", $location->name)) }}')">
                            {{ $location->name }}
                        </div>
                    @endforeach
                </div>

                {{-- Hidden inputs --}}
                <div id="locationHiddenInputs"></div>
            </div>

            {{-- Address Fields --}}
            <div id="locationAddressFields" class="space-y-4 mt-4"></div>

            <div class="mb-4">
                <label for="meta_title" class="block text-sm font-medium">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="w-full border px-3 py-2 rounded"
                    value="{{ old('meta_title', $hospital->meta_title ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="meta_description" class="block text-sm font-medium">Meta Description</label>
                <textarea name="meta_description" id="meta_description" class="w-full border px-3 py-2 rounded" rows="4">{{ old('meta_description', $hospital->meta_description ?? '') }}</textarea>
            </div>


            <div class="mb-4 mt-6">
                <label class="block mb-1 font-semibold">Image</label>
                <input type="file" name="image" accept="image/*" class="w-full border px-3 py-2 rounded">
            </div>

            <button type="submit"
                class="bg-teal-400 text-white px-4 py-2 rounded hover:bg-teal-700 transition">Submit</button>
        </form>
    </div>

    <script>
        const locationSelectedBox = document.getElementById("locationSelectedBox");
        const locationPlaceholder = document.getElementById("locationPlaceholder");
        const locationDropdown = document.getElementById("locationDropdown");
        const locationHiddenInputs = document.getElementById("locationHiddenInputs");
        const locationAddressFields = document.getElementById("locationAddressFields");

        let selectedLocations = [];

        // Toggle dropdown on click
        locationSelectedBox.addEventListener("click", () => {
            locationDropdown.classList.toggle("hidden");
        });

        // Close dropdown if clicked outside
        document.addEventListener("click", (e) => {
            if (!locationSelectedBox.contains(e.target) && !locationDropdown.contains(e.target)) {
                locationDropdown.classList.add("hidden");
            }
        });

        function selectLocation(id, name) {
            if (selectedLocations.find(l => l.id === id)) return; // Prevent duplicates
            selectedLocations.push({
                id,
                name
            });
            renderSelectedLocations();
            renderLocationHiddenInputs();
            renderLocationAddressFields();
        }

        function removeLocation(id) {
            selectedLocations = selectedLocations.filter(l => l.id !== id);
            renderSelectedLocations();
            renderLocationHiddenInputs();
            renderLocationAddressFields();
        }

        function renderSelectedLocations() {
            locationSelectedBox.innerHTML = "";
            if (selectedLocations.length === 0) {
                locationSelectedBox.innerHTML =
                    `<span id="locationPlaceholder" class="text-gray-400">Select locations...</span>`;
                return;
            }
            selectedLocations.forEach(l => {
                const tag = document.createElement("span");
                tag.className = "bg-green-100 text-green-700 px-2 py-1 rounded-md text-sm flex items-center gap-1";
                tag.innerHTML = `
                ${l.name}
                <button type="button" onclick="removeLocation(${l.id}); event.stopPropagation();">✕</button>
            `;
                locationSelectedBox.appendChild(tag);
            });
        }

        function renderLocationHiddenInputs() {
            locationHiddenInputs.innerHTML = "";
            selectedLocations.forEach(l => {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "locations[]";
                input.value = l.id;
                locationHiddenInputs.appendChild(input);
            });
        }

        function renderLocationAddressFields() {
            locationAddressFields.innerHTML = "";
            selectedLocations.forEach(l => {
                const wrapper = document.createElement("div");
                wrapper.className = "flex flex-col gap-1";

                const label = document.createElement("label");
                label.className = "text-gray-700 font-medium";
                label.innerText = `Address for ${l.name}`;

                const input = document.createElement("input");
                input.type = "text";
                input.name = `addresses[${l.id}]`;
                input.placeholder = "Enter address for this location";
                input.className = "border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400";
                input.required = true; // Required input

                wrapper.appendChild(label);
                wrapper.appendChild(input);
                locationAddressFields.appendChild(wrapper);
            });
        }
    </script>
@endsection
