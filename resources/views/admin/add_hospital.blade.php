@extends('layouts.sidebar')
@section('content')
    <div class="bg-gray-100 flex items-center justify-center ">

        <div class="w-full max-w-xl bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Assign Roles to Hospitals</h2>

            <form action="{{ route('hospitals.store') }}" method="POST" class="space-y-6" id="hospitalForm">
                @csrf

                <!-- Hospital Multi Select -->
                <div class="relative w-full">
                    <label class="block text-gray-700 font-medium mb-2">Select Hospital(s)</label>

                    <!-- Input Box with Selected Tags -->
                    <div id="selectedBox"
                        class="w-full flex flex-wrap items-center gap-2 border border-gray-300 rounded-lg px-3 py-2 cursor-pointer bg-white">
                        <span id="placeholder" class="text-gray-400">Select hospitals...</span>
                    </div>

                    <!-- Dropdown -->
                    <div id="dropdown"
                        class="hidden absolute mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg z-10 max-h-48 overflow-y-auto">
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                            onclick="selectHospital(1, 'City Hospital')">City Hospital</div>
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                            onclick="selectHospital(2, 'Green Valley Clinic')">Green Valley Clinic</div>
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                            onclick="selectHospital(3, 'Sunrise Medical Center')">Sunrise Medical Center</div>
                        <div class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
                            onclick="selectHospital(4, 'Riverdale Hospital')">Riverdale Hospital</div>
                    </div>

                    <!-- Hidden Inputs -->
                    <div id="hiddenInputs"></div>
                </div>

                <!-- Dynamic Role Fields -->
                <div id="roleFields" class="space-y-4"></div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>

        <script>
            const selectedBox = document.getElementById("selectedBox");
            const placeholder = document.getElementById("placeholder");
            const dropdown = document.getElementById("dropdown");
            const hiddenInputs = document.getElementById("hiddenInputs");
            const roleFields = document.getElementById("roleFields");

            let selectedHospitals = [];

            // Toggle dropdown on click
            selectedBox.addEventListener("click", () => {
                dropdown.classList.toggle("hidden");
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", (e) => {
                if (!selectedBox.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add("hidden");
                }
            });

            function selectHospital(id, name) {
                if (selectedHospitals.find(h => h.id === id)) return; // prevent duplicates
                selectedHospitals.push({
                    id,
                    name
                });
                renderSelected();
                renderHiddenInputs();
                renderRoleFields();
            }

            function removeHospital(id) {
                selectedHospitals = selectedHospitals.filter(h => h.id !== id);
                renderSelected();
                renderHiddenInputs();
                renderRoleFields();
            }

            function renderSelected() {
                selectedBox.innerHTML = "";
                if (selectedHospitals.length === 0) {
                    selectedBox.innerHTML = `<span id="placeholder" class="text-gray-400">Select hospitals...</span>`;
                    return;
                }
                selectedHospitals.forEach(h => {
                    const tag = document.createElement("span");
                    tag.className = "bg-blue-100 text-blue-700 px-2 py-1 rounded-md text-sm flex items-center gap-1";
                    tag.innerHTML = `
                ${h.name}
                <button type="button" onclick="removeHospital(${h.id})">✕</button>
            `;
                    selectedBox.appendChild(tag);
                });
            }

            function renderHiddenInputs() {
                hiddenInputs.innerHTML = "";
                selectedHospitals.forEach(h => {
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "hospitals[]";
                    input.value = h.id;
                    hiddenInputs.appendChild(input);
                });
            }

            function renderRoleFields() {
                roleFields.innerHTML = "";
                selectedHospitals.forEach(h => {
                    const wrapper = document.createElement("div");
                    wrapper.className = "flex flex-col gap-1";

                    const label = document.createElement("label");
                    label.className = "text-gray-700 font-medium";
                    label.innerText = `Role for ${h.name}`;

                    const input = document.createElement("input");
                    input.type = "text";
                    input.name = `roles[${h.id}]`;
                    input.placeholder = "Enter role";
                    input.className = "border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400";

                    wrapper.appendChild(label);
                    wrapper.appendChild(input);
                    roleFields.appendChild(wrapper);
                });
            }
        </script>

    </div>

@endsection
