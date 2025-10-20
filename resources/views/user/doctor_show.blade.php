@extends('layouts.navbar')
@section('title', $doctor->meta_title ?? $doctor->name)

@section('meta_description')
    <meta name="description"
        content="{{ $doctor->meta_description ?? 'Consult with Dr. ' . $doctor->name . ', expert in ' . $doctor->specialization->name }}">
@endsection

@section('content')
    {{-- Doctor Info --}}
    <div class="bg-white p-4 rounded shadow text-center mb-5">
        <img src="{{ asset($doctor->photo) }}" class="w-24 h-28 mx-auto object-contain rounded">
        <h2 class="text-xl font-bold mt-2 text-primary">{{ $doctor->name }}</h2>
        <p class="font-semibold">{{ $doctor->degree }}</p>
        <p class="text-secondary">{{ $doctor->specialization->name }}</p>
        <p class="text-sm">{{ $doctor->designation }}</p>
        <p class="font-semibold">{{ $doctor->hospital->name }}</p>
        <p class="text-sm text-secondary mt-1">Rating: {{ number_format($doctor->rating, 1) }}/5</p>
    </div>

    {{-- Chamber Info --}}
    @forelse($doctor->chambers as $chamber)
        @foreach ($chamber->hospitals as $hospital)
            <div class="bg-white py-5 px-4 space-y-3 rounded-lg shadow-md text-center mb-4 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Chamber & Appointment</h3>
                <hr class="border-gray-300">

                {{-- Hospital Info --}}
                <div class="text-gray-700">
                    <p class="font-medium">
                        <strong>Hospital:</strong> <a class="hover:underline" href="{{ route('hospital.details', ['hospitalslug' => $hospital->slug]) }}">{{ $hospital->name ?? 'N/A' }}</a>
                    </p>

                    <p class="text-sm">
                        <strong>Address:</strong> {{ $hospital->pivot->address ?? 'N/A' }}
                    </p>

                    <p class="text-sm mt-1">
                        <strong>Visiting Hours:</strong> {{ $hospital->pivot->visiting_hour ?? 'N/A' }}
                    </p>

                    <p class="text-sm">
                        <strong>Appointment Phone:</strong> {{ $hospital->pivot->phone ?? 'N/A' }}
                    </p>
                </div>

                {{-- Call Button --}}
                @if (!empty($hospital->pivot->phone))
                    <a href="tel:{{ $hospital->pivot->phone }}"
                        class="inline-block bg-primary hover:bg-secondary text-white text-sm px-4 py-2 rounded mt-2 transition">
                        Call Now
                    </a>
                @else
                    <button disabled class="bg-gray-400 text-white text-sm px-4 py-2 rounded mt-2 cursor-not-allowed">
                        Phone Unavailable
                    </button>
                @endif
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
            @php
                $images = json_decode($doctor->preview_images, true) ?? [];
            @endphp

            @foreach ($images as $image)
                <img class="w-72 h-40 object-cover rounded" src="{{ asset($image) }}" alt="Preview">
            @endforeach

        </div>



        <div class="flex justify-center">
            @if (!empty($doctor->video_links))
                @php
                    // Extract video ID from YouTube URL
                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\/]+)/', $doctor->video_links, $match);
                    $videoId = $match[1] ?? null;
                @endphp

                @if ($videoId)
                    <div class="mt-4">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <p>Invalid YouTube link</p>
                @endif
            @endif
        </div>




    </div>
@endsection
