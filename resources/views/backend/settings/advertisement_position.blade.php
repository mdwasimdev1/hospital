@extends('layouts.sidebar')

@section('content')
    <div class="flex gap-5 justify-center">

        <div class="w-full bg-white shadow mb-3 rounded-md">
            <h2 class="text-xl font-bold p-3">বিজ্ঞাপন পজিশন</h2>
            <table class="w-full bg-white rounded shadow">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2">
                            পজিশন</th>
                        <th class="border border-gray-300 px-4 py-2">মেয়াদ</th>
                        <th class="border border-gray-300 px-4 py-2"> টাকা/ক্যাটাগরি</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr class="hover:bg-gray-100 border-t">

                            <td class="border border-gray-300 px-4 py-2">{{ $position->position }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $position->duration ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $position->price ?? 'N/A' }}</td>
                            <td class="flex items-center justify-center  px-4 py-2 space-x-3">
                                <a href="{{ route('advertisement.position.edit', $position->id) }}" class="bg-primary p-2 rounded text-white"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#"
                                    class="bg-least p-2 rounded text-white"><i class="fa-solid fa-trash"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full mx-auto p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-6">Add Advertisement Position</h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('advertisement.position.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label>Position</label>
                    <input type="text" name="position" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label>Duration (e.g., 7 days, 1 month)</label>
                    <input type="text" name="duration" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label>Price (BDT)</label>
                    <input type="number" step="0.01" name="price" class="w-full border p-2 rounded" required>
                </div>

                <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Add Advertisement Position</button>
            </form>
        </div>
    </div>
@endsection
