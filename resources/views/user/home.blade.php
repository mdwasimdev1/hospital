@extends('layouts.navbar')
@section('content')
    <div class="container mx-auto">



        <div class="relative mb-4">
            @if ($specializations->count())
                <div class="w-full  rounded-md  z-50">
                    <ul class="py-2">
                        @foreach ($specializations as $specialization)
                            <li>
                                <a href="{{ route('user.dashboard', array_merge(request()->query(), ['specialization' => $specialization->id])) }}"
                                    class="block px-4 py-2 mb-3 text-blue-700 text-center bg-white border border-gray-300 rounded-md">
                                    {{ $specialization->name }} in {{ $specialization->location->name ?? 'N/A' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="relative mb-4">
            @if ($hospitals->count())
                <div class="w-full  rounded-md  z-50">
                    <ul class="py-2">
                        @foreach ($hospitals as $hospital)
                            <li>
                                <a href="{{ route('user.dashboard', array_merge(request()->query(), ['hospital' => $hospital->id])) }}"
                                    class="block px-4 py-2 mb-3 text-blue-700 text-center bg-white border border-gray-300 rounded-md">
                                    {{ $hospital->name }} in @if ($hospital->locations && $hospital->locations->count())
                                     {{ $hospital->locations->first()->name }}
                                @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        @if (!$specializations->count() && !$hospitals->count())
            <div class="grid grid-cols-1 space-y-3">
                @foreach ($doctors as $doctor)
                    @include('user.doctor_card', ['doctor' => $doctor])
                @endforeach
            </div>
        @endif

    </div>
@endsection
