@extends('layouts.sidebar')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-xl font-semibold mb-6">Edit Privacy Policy</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('privacy.update') }}" method="POST">
        @csrf

        @php
            $fields = [
                'introduction' => 'Introduction',
                'information' => 'Information',
                'cookies' => 'Cookies',
                'google_analytics' => 'Google Analytics',
                'third_party_links' => 'Third Party Links',
            ];
        @endphp

        @foreach($fields as $field => $label)
            <div class="mb-6">
                <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
                <textarea name="{{ $field }}" id="{{ $field }}" rows="5" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old($field, $privacy->$field ?? '') }}</textarea>

                @error($field)
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        @endforeach

        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update Privacy Policy</button>
    </form>
</div>
@endsection
