@extends('layouts.navbar')

@section('title')
Disclaimer - Doctors Profile BD
@endsection

@section('content')

<div class="bg-white shadow py-2 text-center mb-3 rounded-md">
    <h1 class="text-2xl font-bold">Disclaimer</h1>
</div>
<div class="bg-white shadow py-2 text-center mb-3 rounded-md">
    <p class="text-gray-600 text-justify p-5">{{ $disclaimer->disclaimer }}</p>
</div>


@endsection
