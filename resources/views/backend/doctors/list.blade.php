@extends('layouts.sidebar') <!-- jei layout use korcho -->

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between">
            <div class="w-full">
                <h1 class="text-2xl font-bold mb-4">Doctors List</h1>
            </div>
            <div class="w-full flex justify-end">
                <form method="GET" action="{{ route('doctors.list') }}" class="mb-4 flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search..." class="w-full px-4 py-2 border rounded ">
                    <button type="submit"
                        class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">Search</button>
                </form>

            </div>
        </div>

        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border border-gray-300 px-4 py-2">SL</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Specialization</th>
                    <th class="border border-gray-300 px-4 py-2">Hospital</th>
                    <th class="border border-gray-300 px-4 py-2">Designation</th>
                    <th class="border border-gray-300 px-4 py-2">Location</th>
                    <th class="border border-gray-300 px-4 py-2">Photo</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr class="hover:bg-gray-100 border-t">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->specialization->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->hospital->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->designation }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->location->name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($doctor->photo)
                                <img src="{{ asset($doctor->photo) }}" alt="Doctor Photo"
                                    class="h-16 w-16 object-cover rounded-md">
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="flex items-center justify-center  px-4 py-2 space-x-3">
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="bg-primary p-2 rounded text-white"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" onclick="confirmDelete({{ $doctor->id }})"
                                class="bg-least p-2 rounded text-white"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $doctors->links() }} <!-- pagination links -->
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
                    deleteDoctor(id);
                }
            });
        }

        function deleteDoctor(id) {
            fetch(`/doctors/${id}`, {
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
                            'Doctor has been deleted.',
                            'success'
                        ).then(() => {
                            $doctor.reload(); // Or remove the row from the table dynamically
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
