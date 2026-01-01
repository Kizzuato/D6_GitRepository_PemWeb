@extends('layouts.landingNavbar')

@section('title', 'Login - FORTE')

@push('styles')
    <style>
        .login-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            padding: 0 50px;
            position: relative;
        }

        .login-card {
            background-color: #444;
            border-radius: 40px;
            padding: 50px;
            max-width: 500px;
            width: 100%;
            box-shadow: 15px 15px 30px rgba(0, 0, 0, .5);
            z-index: 2;
        }

        .form-control-forte {
            background-color: #d9d9d9 !important;
            border-radius: 25px;
            height: 60px;
            padding: 15px 25px;
            margin-bottom: 30px;
        }

        .btn-login {
            background-color: #2d7a32;
            color: white;
            border-radius: 25px;
            padding: 12px 60px;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .signup-text {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #ccc;
        }

        .signup-text a {
            color: #2d7a32;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    <div class="login-section">

        <div class="login-card">
            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <label>Username</label>
                <input type="text" name="username" class="form-control form-control-forte">

                <label>Password</label>
                <input type="password" name="password" class="form-control form-control-forte">

                <button type="submit" class="btn btn-login">Login</button>

                <p class="signup-text mt-3">
                    Belum punya akun <a href="{{ route('register') }}">(Daftar)</a>
                </p>
            </form>
        </div>

        <div class="rover-container">
            <img src="{{ asset('assets/img/2 1.png') }}" class="img-fluid">
        </div>

    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil 🎉',
                text: "{{ session('success') }}",
                confirmButtonColor: '#2d7a32'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
@endpush
