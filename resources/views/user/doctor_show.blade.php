@extends('layouts.navbar')
@section('title', $doctor->meta_title ?? $doctor->name)

@section('meta_description')
    <meta name="description" content="{{ $doctor->meta_description ?? 'Consult with Dr. '.$doctor->name.', expert in '.$doctor->specialization->name }}">
@endsection

@section('content')
    {{-- Doctor Info --}}
    <div class="bg-white p-4 rounded shadow text-center mb-5">
        <img src="{{ asset('storage/' . $doctor->photo) }}" class="w-24 h-28 mx-auto object-cover rounded">
        <h2 class="text-xl font-bold mt-2 text-primary">{{ $doctor->name }}</h2>
        <p class="font-semibold">{{ $doctor->degree }}</p>
        <p class="text-secondary">{{ $doctor->specialization->name }}</p>
        <p class="text-sm text-gray-600 mt-1">Rating: {{ number_format($doctor->rating, 1) }}/5</p>
    </div>

    {{-- Chamber Info --}}
    @forelse($doctor->chambers as $chamber)
        @foreach ($chamber->hospitals as $hospital)
            <div class="bg-white py-5 space-y-1 rounded-lg shadow-md text-center mb-3">
                <h3 class="text-lg font-bold">Chamber & Appointment</h3>
                <hr class="border-t border-gray-300">


                <div class="mb-4">
                    <p>
                        Hospital: {{ $hospital->name ?? 'N/A' }}
                        <br>
                        Address: {{ $hospital->pivot->address ?? 'N/A' }}
                    </p>

                    <p class="text-sm font-bold mt-1">Visiting Hours: {{ $chamber->visiting_hour ?? 'N/A' }}</p>
                    <p>Appointment: {{ $chamber->phone ?? 'N/A' }}</p>
                    <button class="bg-primary hover:bg-secondary text-white text-sm px-4 py-1 rounded mt-1">Call Now</button>
                </div>
            </div>
        @endforeach
    @empty
        <p class="text-center mb-5 text-red-600">No chambers found.</p>
    @endforelse

    <div class="bg-white py-5 space-y-1 rounded-lg shadow-md text-center mb-3">
        <h3 class="text-lg font-bold">About {{ $doctor->name }}</h3>
        <hr class="border-t border-gray-300">
        <p class="text-gray-600 text-justify p-5">{{ $doctor->about }}</p>
    </div>
    <div class="bg-white py-5 space-y-1 rounded-lg shadow-md text-center mb-3">
        <div class="flex gap-5 w-full items-center justify-center flex-wrap">
            @foreach (json_decode($doctor->preview_images, true) as $image)
                <img class="w-72 h-40 object-cover rounded" src="{{ asset('storage/' . $image) }}" alt="Preview">
            @endforeach
        </div>

        @php
            $videoId = null;
            $videoUrl = $doctor->video_links;

            if (!empty($videoUrl)) {
                $parsedUrl = parse_url($videoUrl);

                if (strpos($videoUrl, 'youtube.com') !== false && isset($parsedUrl['query'])) {
                    parse_str($parsedUrl['query'], $videoParams);
                    $videoId = $videoParams['v'] ?? null;
                } elseif (strpos($videoUrl, 'youtu.be') !== false) {
                    $videoId = ltrim($parsedUrl['path'], '/');
                }
            }
        @endphp

        @if ($videoId)
            <div class="flex gap-2 w-full items-center justify-center mt-5">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>
        @else
            <p class="text-red-500 text-center mt-5">Invalid or unsupported YouTube video link.</p>
        @endif


    </div>
@endsection
