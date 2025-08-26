@extends('layouts.auth')

@section('content')
<h2 class="text-2xl font-bold text-center mb-6">Register</h2>

<form id="registerForm" class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input type="text" id="name" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" id="email" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" id="password" class="w-full border rounded p-2 focus:ring focus:ring-blue-200" required>
    </div>
    <div>
        <label class="block text-sm font-medium">Role</label>
        <select id="role" class="w-full border rounded p-2">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
        Register
    </button>
</form>

<p class="text-center text-sm mt-4">
    Already have an account?
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
</p>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let role = document.getElementById('role').value;

    let response = await fetch('/api/register', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ name, email, password, role })
    });

    let data = await response.json();

    if (response.ok) {
        alert("Registration successful! Please log in.");
        window.location.href = '/login';
    } else {
        alert(data.message || "Registration failed");
    }
});
</script>
@endsection
