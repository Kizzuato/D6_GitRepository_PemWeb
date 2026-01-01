<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FORTE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
            overflow-x: hidden;
        }

        /* Navbar Styling */
        .navbar-forte {
            padding: 20px 50px;
        }

        /* Styling logo dengan tinggi 20px sesuai permintaan */
        .navbar-brand img {
            height: 20px;
            width: auto;
        }

        .nav-link {
            color: #ccc !important;
            margin: 0 15px;
            font-size: 0.9rem;
        }

        .btn-daftar-nav {
            background-color: #2d7a32;
            color: white !important;
            border-radius: 20px;
            padding: 5px 20px !important;
            text-decoration: none;
        }

        /* Login Container */
        .login-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            position: relative;
            padding: 0 50px;
        }

        /* Card Styling */
        .login-card {
            background-color: #444444;
            border-radius: 40px;
            padding: 50px;
            width: 100%;
            max-width: 500px;
            box-shadow: 15px 15px 30px rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .login-card label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            display: block;
        }

        /* Input Styling */
        .form-control-forte {
            background-color: #d9d9d9 !important;
            border: none;
            border-radius: 25px;
            padding: 15px 25px;
            height: 60px;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        /* Checkbox Styling */
        .form-check-input {
            background-color: #d9d9d9;
            border: none;
            border-radius: 4px;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #bbb;
        }

        /* Button Styling */
        .btn-login {
            background-color: #2d7a32;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 60px;
            font-size: 1.3rem;
            font-weight: 600;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #3e8e41;
            transform: scale(1.05);
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

        /* Image Area */
        .rover-container {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60%;
            height: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            z-index: 1;
        }

        .rover-placeholder {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-forte">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/img/FORTE.png') }}" alt="FORTE Logo">
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-center">
                    {{-- <li class="nav-item"><a class="nav-link" href="dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="setting">Setting</a></li>
                    <li class="nav-item"><a class="nav-link" href="about">Abouth Rover</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn-daftar-nav" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="login-section">

        <div class="login-card">
            <form>
                <div class="mb-4">
                    <label>Username</label>
                    <input type="text" class="form-control form-control-forte" placeholder="">
                </div>

                <div class="mb-2">
                    <label>Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control form-control-forte" placeholder="">
                        <span class="position-absolute end-0 top-50 translate-middle-y me-4 text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-eye-slash" viewBox="0 0 16 16">
                                <path
                                    d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755l.791.792zM11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                                <path
                                    d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="ingat">
                    <label class="form-check-label" for="ingat">
                        Ingat Username
                    </label>
                </div>

                <button class="btn btn-login">Login</button>

                <p class="signup-text">
                    Belum punya akun <a href="{{ route('register') }}">(Daftar)</a>
                </p>
            </form>
        </div>

        <div class="rover-container">
            <img src="{{ asset('assets/img/2 1.png') }}" class="rover-placeholder" alt="Forte Rover">
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
