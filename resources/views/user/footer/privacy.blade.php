@extends('layouts.navbar')

@section('title')
Privacy Policy - Doctors Profile BD
@endsection

@section('content')

<div class="bg-white shadow py-2 text-center mb-3 rounded-md">
    <h1 class="text-2xl font-bold">Privacy Policy</h1>
</div>
<div class="bg-white shadow py-2 mb-3 rounded-md">
    <label for="" class="text-xl text-start p-5 font-semibold">Introduction</label>
    <hr>
    <p class="text-gray-600 text-justify p-5">{{ $privacy->introduction }}</p>
</div>
<div class="bg-white shadow py-2  mb-3 rounded-md">
    <label for="" class="text-xl text-start p-5 font-semibold">Information</label>
    <hr>
    <p class="text-gray-600 text-justify p-5">{{ $privacy->information }}</p>
</div>
<div class="bg-white shadow py-2 mb-3 rounded-md">
    <label for="" class="text-xl text-start p-5 font-semibold">Cookies</label>
    <hr>
    <p class="text-gray-600 text-justify p-5">{{ $privacy->cookies }}</p>
</div>
<div class="bg-white shadow py-2 mb-3 rounded-md">
    <label for="" class="text-xl text-start p-5 font-semibold">Google Analytics</label>
    <hr>
    <p class="text-gray-600 text-justify p-5">{{ $privacy->google_analytics }}</p>
</div>
<div class="bg-white shadow py-2 mb-3 rounded-md">
    <label for="" class="text-xl text-start p-5 font-semibold">Third Party Links</label>
    <hr>
    <p class="text-gray-600 text-justify p-5">{{ $privacy->third_party_links }}</p>
</div>
<div class="bg-white shadow py-2 mb-3 rounded-md">
    <label for="" class="text-xl text-start p-5 font-semibold">Contact Us</label>
    <hr>
    <p class="text-gray-600 text-justify p-5">If you have any questions about this Privacy Policy, please contact us via <span class="text-primary underline "><a href="">contact form</a></span>.</p>
</div>


@endsection
