@extends('layouts.sidebar')

@section('content')
    <div class="text-center">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}</p>
    </div>
@endsection
