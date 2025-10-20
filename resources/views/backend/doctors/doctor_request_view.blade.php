@extends('layouts.sidebar')

@section('content')
<div class="container mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">Doctor Request Details</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 rounded-lg">
            <tbody class="divide-y divide-gray-200">

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left w-1/3">Name</th>
                    <td class="px-4 py-2">{{ $doctorView->name }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Email</th>
                    <td class="px-4 py-2">{{ $doctorView->email ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Personal Phone</th>
                    <td class="px-4 py-2">{{ $doctorView->personal_phone ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">BMDC Number</th>
                    <td class="px-4 py-2">{{ $doctorView->bmdc_number ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Degrees</th>
                    <td class="px-4 py-2">{{ $doctorView->degrees ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Fellowships</th>
                    <td class="px-4 py-2">{{ $doctorView->fellowships ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Specialty</th>
                    <td class="px-4 py-2">{{ $doctorView->specialty ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Workplace</th>
                    <td class="px-4 py-2">{{ $doctorView->workplace ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Designation</th>
                    <td class="px-4 py-2">{{ $doctorView->designation ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Chamber Name</th>
                    <td class="px-4 py-2">{{ $doctorView->chamber_name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Chamber Address</th>
                    <td class="px-4 py-2">{{ $doctorView->chamber_address ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Visiting Hour</th>
                    <td class="px-4 py-2">{{ $doctorView->visiting_hour ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Appointment Number</th>
                    <td class="px-4 py-2">{{ $doctorView->appointment_number ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">bKash Transaction</th>
                    <td class="px-4 py-2">{{ $doctorView->bKash_transaction ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">About</th>
                    <td class="px-4 py-2">{{ $doctorView->about ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th class="bg-gray-100 px-4 py-2 text-left">Photo</th>
                    <td class="px-4 py-2">
                        @if ($doctorView->photo)
                            <div class="inline-block relative group">
                                <img src="{{ asset($doctorView->photo) }}"
                                     alt="Doctor Photo"
                                     class="h-24 w-24 object-cover rounded-md cursor-pointer border border-gray-300">
                                <a href="{{ asset($doctorView->photo) }}"
                                   download
                                   class="absolute inset-0 flex items-center justify-center bg-black/50 text-white text-sm opacity-0 group-hover:opacity-100 transition duration-300 rounded-md">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            </div>
                        @else
                            <span>No photo available</span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('doctors.request') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Back to List
        </a>
    </div>
</div>
@endsection
