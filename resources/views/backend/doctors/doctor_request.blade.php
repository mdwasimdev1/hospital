@extends('layouts.sidebar')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between">
            <div class="w-full">
                <h1 class="text-2xl font-bold mb-4">Doctors Request List</h1>
            </div>
            <div class="w-full flex justify-end">
                <form method="GET" action="{{ route('doctors.request') }}" class="mb-4 flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search..." class="w-full px-4 py-2 border rounded ">
                    <button type="submit"
                        class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">Search</button>
                </form>

            </div>
        </div>

        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-sm text-left">
                    <th class="border border-gray-300 px-4 py-2">SL</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">email</th>
                    <th class="border border-gray-300 px-4 py-2">personal_phone</th>
                    {{-- <th class="border border-gray-300 px-4 py-2">bmdc_number</th> --}}
                    <th class="border border-gray-300 px-4 py-2">degrees</th>
                    {{-- <th class="border border-gray-300 px-4 py-2">fellowships</th> --}}
                    <th class="border border-gray-300 px-4 py-2">specialty</th>
                    <th class="border border-gray-300 px-4 py-2">workplace</th>
                    {{-- <th class="border border-gray-300 px-4 py-2">designation</th>
                    <th class="border border-gray-300 px-4 py-2">chamber_name</th> --}}
                    {{-- <th class="border border-gray-300 px-4 py-2">chamber_address</th>
                    <th class="border border-gray-300 px-4 py-2">visiting_hour</th>
                    <th class="border border-gray-300 px-4 py-2">appointment_number</th> --}}
                    <th class="border border-gray-300 px-4 py-2">bKash_transaction</th>
                    {{-- <th class="border border-gray-300 px-4 py-2">about</th> --}}
                    <th class="border border-gray-300 px-4 py-2">photo</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                    <tr class="hover:bg-gray-100 border-t">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->email ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->personal_phone ?? 'N/A' }}</td>
                        {{-- <td class="border border-gray-300 px-4 py-2">{{ $doctor->bmdc_number ?? 'N/A' }}</td> --}}
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->degrees ?? 'N/A' }}</td>
                        {{-- <td class="border border-gray-300 px-4 py-2">{{ $doctor->fellowships ?? 'N/A' }}</td> --}}
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->specialty ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->workplace ?? 'N/A' }}</td>
                        {{-- <td class="border border-gray-300 px-4 py-2">{{ $doctor->designation ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->chamber_name ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->chamber_address ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->visiting_hour ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->appointment_number ?? 'N/A' }}</td> --}}
                        <td class="border border-gray-300 px-4 py-2">{{ $doctor->bKash_transaction ?? 'N/A' }}</td>
                        {{-- <td class="border border-gray-300 px-4 py-2">{{ $doctor->about ?? 'N/A' }}</td> --}}




                        <td class="border border-gray-300 px-4 py-2 text-center">
                            @if ($doctor->photo)
                                <div class="inline-block relative">
                                    <div class="relative group h-16 w-16">
                                        <img src="{{ asset($doctor->photo) }}"
                                             alt="Doctor Photo"
                                             class="h-16 w-16 object-cover rounded-md cursor-pointer">
                                        <a href="{{ asset($doctor->photo) }}"
                                           download
                                           class="absolute inset-0 flex items-center justify-center bg-black/50 text-white text-sm opacity-0 group-hover:opacity-100 transition duration-300 rounded-md">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            @else
                                N/A
                            @endif
                        </td>


                        <td class="flex items-center justify-center  px-4 py-2 space-x-3">
                            <a href="{{ route('doctors.request.view', $doctor->id) }}" class="bg-primary p-2 rounded text-white"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" onclick="confirmDelete({{ $doctor->id }})"
                                class="bg-least p-2 rounded text-white"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $doctors->links() }}
        </div>
    </div>




    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This Doctor Request will be deleted!",
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
            fetch(`/doctors/request/${id}`, {
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
                            'Doctor Request has been deleted.',
                            'success'
                        ).then(() => {
                            $doctor.reload();
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

