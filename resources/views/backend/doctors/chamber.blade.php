@extends('layouts.sidebar')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Add New Chamber</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 bg-green-100 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('chambers.store') }}" class="space-y-6">
            @csrf

            <div class="mb-4">
                <label for="location_id" class="block text-sm font-medium text-gray-700 mb-2">Select Location</label>

                <select name="location_id" id="location_id"
                    class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white">
                    <option value="">-- Select Location --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>

                @error('location_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Doctor select --}}
            {{-- Doctor select --}}
            <div class="mb-4">
                <label for="doctor_id" class="block mb-2 font-medium text-gray-700">Select Doctor</label>
                <select id="doctor_id" name="doctor_id"
                    class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white">
                    <option value="">-- Select Doctor --</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>







            {{-- Location Multi Select --}}
            <div class="relative w-full mt-6">
                <label class="block text-gray-700 font-medium mb-2">Select Hospitals</label>

                <div id="hospitalSelectedBox"
                    class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white">
                    <span id="hospitalPlaceholder" class="text-gray-400">Select hospitals...</span>
                </div>

                {{-- Dropdown --}}
                <div id="hospitalDropdown"
                    class="hidden absolute mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                    @foreach ($hospitals as $hospital)
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                            onclick="selectLocation({{ $hospital->id }}, '{{ addslashes(str_replace("'", "\'", $hospital->name)) }}')">
                            {{ $hospital->name }}
                        </div>
                    @endforeach
                </div>

                {{-- Hidden inputs --}}
                <div id="hospitalHiddenInputs"></div>
            </div>

            {{-- Address Fields --}}
            <div id="hospitalAddressFields" class="space-y-4 mt-4"></div>


            <div>
                <label for="visiting_hour" class="block text-sm font-medium text-gray-700">Visiting Hour</label>
                <input type="text" name="visiting_hour" id="visiting_hour" value="{{ old('visiting_hour') }}"
                    placeholder="e.g., Sat-Mon: 4PM - 8PM"
                    class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white" />
                @error('visiting_hour')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white"
                    placeholder="Enter Appointment phone number" />

                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded">
                    Add Chamber
                </button>
            </div>
        </form>
    </div>



    <script>
        const hospitalSelectedBox = document.getElementById("hospitalSelectedBox");
        const hospitalPlaceholder = document.getElementById("hospitalPlaceholder");
        const hospitalDropdown = document.getElementById("hospitalDropdown");
        const hospitalHiddenInputs = document.getElementById("hospitalHiddenInputs");
        const hospitalAddressFields = document.getElementById("hospitalAddressFields");

        let selectedHospitals = [];

        // Toggle dropdown on click
        hospitalSelectedBox.addEventListener("click", () => {
            hospitalDropdown.classList.toggle("hidden");
        });

        // Close dropdown if clicked outside
        document.addEventListener("click", (e) => {
            if (!hospitalSelectedBox.contains(e.target) && !hospitalDropdown.contains(e.target)) {
                hopitalDropdown.classList.add("hidden");
            }
        });

        function selectLocation(id, name) {
            if (selectedHospitals.find(l => l.id === id)) return; // Prevent duplicates
            selectedHospitals.push({
                id,
                name
            });
            renderSelectedHospitals();
            renderHospitalHiddenInputs();
            renderHospitalAddressFields();
        }

        function removeHospital(id) {
            selectedHospitals = selectedHospitals.filter(l => l.id !== id);
            renderSelectedHospitals();
            renderHospitalHiddenInputs();
            renderHospitalAddressFields();
        }

        function renderSelectedHospitals() {
            hospitalSelectedBox.innerHTML = "";
            if (selectedHospitals.length === 0) {
                hospitalSelectedBox.innerHTML =
                    `<span id="hospitalPlaceholder" class="text-gray-400">Select hospitals...</span>`;
                return;
            }
            selectedHospitals.forEach(l => {
                const tag = document.createElement("span");
                tag.className = "bg-green-100 text-green-700 px-2 py-1 rounded-md text-sm flex items-center gap-1";
                tag.innerHTML = `
            ${l.name}
            <button type="button" onclick="removeHospital(${l.id}); event.stopPropagation();">✕</button>
        `;
                hospitalSelectedBox.appendChild(tag);
            });
        }

        function renderHospitalHiddenInputs() {
            hospitalHiddenInputs.innerHTML = "";
            selectedHospitals.forEach(l => {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = "hospitals[]";
                input.value = l.id;
                hospitalHiddenInputs.appendChild(input);
            });
        }

        function renderHospitalAddressFields() {
            hospitalAddressFields.innerHTML = "";
            selectedHospitals.forEach(l => {
                const wrapper = document.createElement("div");
                wrapper.className = "flex flex-col gap-1";

                const label = document.createElement("label");
                label.className = "text-gray-700 font-medium";
                label.innerText = `Address for ${l.name}`;

                const input = document.createElement("input");
                input.type = "text";
                input.name = `addresses[${l.id}]`;
                input.placeholder = "Enter address for this hospital";
                input.className = "border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-400";
                input.required = true; // Required input

                wrapper.appendChild(label);
                wrapper.appendChild(input);
                hospitalAddressFields.appendChild(wrapper);
            });
        }
    </script>
@endsection
