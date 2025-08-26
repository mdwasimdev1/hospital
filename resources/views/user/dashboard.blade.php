@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="text-2xl font-bold">User Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }}</p>
</div>
@endsection
