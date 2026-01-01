@extends('layouts.landingNavbar')

@section('title', 'Register - FORTE')

@push('styles')
<style>
    .register-section {
        min-height: 85vh;
        display: flex;
        align-items: center;
        padding: 0 50px;
        position: relative;
    }

    .register-card {
        background-color: #444;
        border-radius: 40px;
        padding: 40px 50px;
        max-width: 500px;
        width: 100%;
        box-shadow: 15px 15px 30px rgba(0,0,0,.5);
        z-index: 2;
    }

    .form-control {
        border-radius: 25px;
        height: 50px;
        padding: 10px 25px;
    }

    .btn-register {
        background-color: #2d7a32;
        color: white;
        border-radius: 25px;
        padding: 10px 60px;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .rover-container {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 60%;
        pointer-events: none;
    }
</style>
@endpush

@section('content')
<div class="register-section">

    <div class="register-card">
        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <label>Username</label>
            <input type="text" name="username" class="form-control mb-3" required>

            <label>Email</label>
            <input type="email" name="email" class="form-control mb-3" required>

            <label>Password</label>
            <input type="password" name="password" class="form-control mb-3" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control mb-4" required>

            <button type="submit" class="btn btn-register">Daftar</button>

            <p class="mt-3">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-success">Login</a>
            </p>
        </form>
    </div>

    <div class="rover-container">
        <img src="{{ asset('assets/img/2 1.png') }}" class="img-fluid">
    </div>

</div>
@endsection

