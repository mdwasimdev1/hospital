@extends('layouts.sidebar')
@section('content')
    <div class="w-full flex justify-between  gap-10">
        <div class="w-full">
            <div class="flex items-center justify-between">
                <div class="w-full">
                    <h1 class="text-xl font-bold mb-4">All Specializations</h1>
                </div>
                <div class="w-full flex justify-end">
                    <form method="GET" action="{{ route('specializations.index') }}" class="mb-4 flex space-x-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search..." class="w-full px-4 py-2 border rounded ">
                        <button type="submit"
                            class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">Search</button>
                    </form>

                </div>
            </div>


            <table  class="min-w-full bg-white rounded shadow">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Location Name</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specializations as $specialization)
                        <tr class="hover:bg-gray-100 border-t">
                            <td class="border px-4 py-2">
                                {{ ($specializations->currentPage() - 1) * $specializations->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-4 py-2">{{ $specialization->name }}</td>
                            <td class="px-4 py-2">{{ $specialization->location->name ?? 'N/A' }}</td>
                            <td class="flex items-center py-2 px-4 space-x-3">
                                <a href="{{ route('specializations.edit', $specialization->id) }}"
                                    class="bg-primary p-2 rounded text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" onclick="confirmDelete({{ $specialization->id }})"
                                    class="bg-least p-2 rounded text-white"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $specializations->links() }}
            </div>

        </div>
        <div class="w-[80%] bg-gray-100 ">
             <div class="flex items-center justify-between">
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

            </div>
            <div class="w-full p-4  bg-white">
                <h1 class="text-base text-center font-bold mb-4">Add Specialization</h1>
                <form action="{{ route('specializations.store') }}" method="POST">
                    @csrf

                    <div class="w-full  mb-5">
                        <label for="name" class="w-64 text-base">Specialization Name:</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border rounded text-sm" required>
                        @error('name')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full  mb-5">
                        <label for="slug" class="w-64 text-base">Specialization Slug:</label>
                        <input type="text" name="slug" id="slug" class="w-full p-2 border rounded text-sm" required>
                        @error('slug')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full mb-5">
                        <label for="location_id" class="w-64 text-base">Select Location:</label>
                        <select name="location_id" id="location_id" class="w-full p-2 border rounded text-sm" required>
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full  mb-5">
                        <label for="title" class="w-64 text-base">Specialization Title:</label>
                        <input type="text" name="title" id="title" class="w-full p-2 border rounded text-sm">
                        @error('title')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full mb-5">
                        <label for="description" class="w-64 text-base">Specialization Description:</label>
                        <textarea  type="text" name="description" id="description" cols="10" rows="5" class="w-full p-2 border rounded text-sm"></textarea>
                        @error('description')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full  mb-5">
                        <label for="meta_title" class="w-64 text-base">Meta Title:</label>
                        <input type="text" name="meta_title" id="meta_title" class="w-full p-2 border rounded text-sm">
                        @error('meta_title')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full  mb-5">
                        <label for="meta_description" class="w-64 text-base">Meta Description:</label>
                        <input type="text" name="meta_description" id="meta_description" class="w-full p-2 border rounded text-sm" >
                        @error('meta_description')
                            <div style="color:red">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                        class="bg-teal-400 text-white px-4 py-2 rounded hover:bg-teal-700 transition text-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This Specialization will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deletespecialization(id);
                }
            });
        }

        function deletespecialization(id) {
            fetch(`/specializations/${id}`, {
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
                            'The Specialization has been deleted.',
                            'success'
                        ).then(() => {
                            $specialization.reload();
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
