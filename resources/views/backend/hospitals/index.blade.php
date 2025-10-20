@extends('layouts.sidebar')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between">
            <div class="w-full">
                <h1 class="text-2xl font-bold mb-4">Hospital List</h1>
            </div>
            <div class="w-full flex justify-end">
                <form method="GET" action="{{ route('hospitals.index') }}" class="mb-4 flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search..." class="w-full px-4 py-2 border rounded ">
                    <button type="submit"
                        class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">Search</button>
                </form>

            </div>
        </div>
        {{-- <div class="flex items-center justify-between">

            <div>
                <h1 class="text-xl font-bold mb-4">Hospital List</h1>
            </div>
            <div>
                @if (session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <ul style="color: red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div> --}}
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border border-gray-300 px-4 py-2">SL</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Contact</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Locations</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($hospitals as $hospital)
                    <tr class="hover:bg-gray-100 border-t">
                        <td class="border px-4 py-1">
                            {{ ($hospitals->currentPage() - 1) * $hospitals->perPage() + $loop->iteration }}</td>
                        <td class="border px-4 py-1">{{ $hospital->name }}</td>
                        <td class="border px-4 py-1">{{ $hospital->contact }}</td>
                        <td class="border px-4 py-1">
                            @if ($hospital->image)
                                <img src="{{ asset($hospital->image) }}" alt="Image"
                                    class="w-10 h-10 object-cover">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="border px-4 py-1">
                            @foreach ($hospital->locations as $location)
                                <div>{{ $location->name }} ({{ $location->pivot->address }})</div>
                            @endforeach
                        </td>
                        <td class="flex items-center justify-center px-4 py-2 space-x-3">
                            <a href="{{ route('hospitals.edit', $hospital->id) }}" class="bg-primary p-1 rounded text-white"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" onclick="confirmDelete({{ $hospital->id }})"
                                class="bg-least p-1 rounded text-white"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No hospitals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $hospitals->links() }}
        </div>
    </div>



    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This Hospital will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteHospital(id);
                }
            });
        }

        function deleteHospital(id) {
            fetch(`/hospitals/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire(
                            'Deleted!',
                            'The Hospital has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload(); // ✅ this will reload the page
                        });

                    } else {
                        Swal.fire(
                            'Error!',
                            'Something went wrong. Please try again.',
                            'error'
                        );
                    }
                });
        }
    </script>


@endsection
