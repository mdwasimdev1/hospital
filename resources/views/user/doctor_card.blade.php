<div class="bg-white p-4 rounded-lg shadow-md text-center">
    <img src="{{ asset('storage/' . $doctor->photo) }}" class="mx-auto w-36 h-40 rounded-md object-cover mb-4 border border-primary p-2">
    <h3 class="text-lg font-bold text-primary">{{ $doctor->name }}</h3>
    <h3 class="text-lg font-bold ">{{ $doctor->degree }}</h3>
    <p class="text-sm text-secondary font-semibold mt-1">{{ $doctor->specialization->name }}</p>
    <h3 class="text-xs mt-2">{{ $doctor->designation }}</h3>
    <p class="text-base  mt-2">{{ $doctor->hospital->name  }}</p>

    <a href="{{ route('doctors.show', $doctor->id) }}"
        class="inline-block mt-4 px-4 py-2 text-white bg-primary hover:bg-secondary rounded text-sm">See Chambers</a>
</div>
