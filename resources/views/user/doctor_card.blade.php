<div class="bg-white p-4 rounded-lg shadow-md text-center">
    <img src="{{ asset('storage/' . $doctor->photo) }}" class="mx-auto w-24 h-28 rounded-md object-cover mb-4">
    <h3 class="text-lg font-bold text-blue-600">{{ $doctor->name }}</h3>
    <h3 class="text-lg font-bold ">{{ $doctor->degree }}</h3>
    <p class="text-sm text-red-500 font-semibold mt-1">{{ $doctor->specialization->name }}</p>
    <h3 class="text-xs mt-2">{{ $doctor->designation }}</h3>
    <p class="text-base  mt-2">{{ $doctor->hospital->name  }}</p>

    <a href="{{ $doctor->chamber_url }}"
        class="inline-block mt-4 px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded text-sm">See Chambers</a>
</div>
