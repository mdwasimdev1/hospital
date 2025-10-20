@extends('layouts.navbar')

@section('title')
About Us - Doctors Profile BD
@endsection

@section('content')

<div class="bg-white shadow py-2 text-center mb-3 rounded-md">
    <h1 class="text-2xl font-bold">About Us</h1>
</div>
<div class="bg-white shadow py-2  mb-3 rounded-md">

 <div class="flex justify-center">
    <img class="border w-40" src="{{ asset('public/' . $aboutUs->image) }}" width="150" class="mb-2">
 </div>

    <p class="text-gray-600 text-center p-5">{{ $aboutUs->description }}</p>
</div>
@if (!empty($aboutUs->why_create_website))
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <label class="text-xl text-start p-5 font-semibold">কেনো এই ওয়েবসাইটটি তৈরি করেছি</label>
        <hr>
        <p class="text-gray-600 text-center p-5">{{ $aboutUs->why_create_website }}</p>
    </div>
@endif

@if (!empty($aboutUs->comment))
    <div class="bg-white shadow py-2 mb-3 rounded-md">
        <p class="text-gray-600 text-center p-5">{{ $aboutUs->comment }}</p>
    </div>
@endif



@endsection
