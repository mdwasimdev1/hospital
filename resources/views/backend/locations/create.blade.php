@extends('layouts.sidebar')
@section('content')

    <div class="w-full container mx-auto p-4 flex flex-col lg:flex-row items-center justify-between gap-10">
        <div class="w-1/2">
            <div class="flex items-center justify-between">
                <div class="w-full">
                    <h1 class="text-xl font-bold mb-4">All Locations</h1>
                </div>
                <div class="w-full flex justify-end">
                    <form method="GET" action="{{ route('locations.create') }}" class="mb-4 flex space-x-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search..." class="w-full px-4 py-2 border rounded ">
                        <button type="submit"
                            class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">Search</button>
                    </form>

                </div>
            </div>
            {{-- <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold mb-4">All Locations</h1>
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
                        <th class="py-2 px-4">ID</th>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-10 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $location)
                        <tr class="hover:bg-gray-100 border-t">
                            <td class="border py-2 px-4">{{ ($locations->currentPage() - 1) * $locations->perPage() + $loop->iteration }}</td>
                            <td class="py-2 px-4">{{ $location->name }}</td>
                            <td class="py-2 px-4 text-right space-x-3">
                                <a href="{{ route('locations.edit', $location->id) }}"
                                    class="bg-primary p-2 rounded text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" onclick="confirmDelete({{ $location->id }})"
                                    class="bg-least p-2 rounded text-white"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 px-4 text-center text-gray-500">No locations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $locations->links() }}

            </div>
        </div>

        <div class="w-1/2">

            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <label for="name" class="text-xl text-gray-700 font-bold mb-2">Location Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="form-control border p-2">
                <button type="submit"
                    class="bg-secondary hover:bg-primary text-white font-bold py-2 px-4 rounded">Submit</button>
            </form>
        </div>
    </div>


    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This location will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteLocation(id);
                }
            });
        }

        function deleteLocation(id) {
            fetch(`/locations/${id}`, {
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
                            'Location has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload(); // Or remove the row from the table dynamically
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
