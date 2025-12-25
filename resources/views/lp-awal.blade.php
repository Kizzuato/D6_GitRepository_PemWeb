<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - FORTE</title>
    {{-- Menggunakan CDN Bootstrap sesuai file lain --}}
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

        /* Navbar Styling (Konsisten dengan file form_login) */
        .navbar-forte {
            padding: 20px 50px;
            z-index: 10;
        }

        .navbar-brand img {
            height: 20px;
            width: auto;
        }

        .nav-link {
            color: #ccc !important;
            margin: 0 15px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: white !important;
        }

        .btn-daftar-nav {
            background-color: #2d7a32;
            color: white !important;
            border-radius: 20px;
            padding: 5px 25px !important;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-daftar-nav:hover {
            background-color: #3e8e41;
            transform: scale(1.05);
        }

        /* Hero / Landing Section */
        .hero-section {
            min-height: 85vh;
            /* Tinggi layar dikurangi navbar */
            display: flex;
            align-items: center;
            position: relative;
            padding: 0 50px;
            overflow: hidden;
        }

        /* Teks Utama */
        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: 400;
            margin-bottom: 30px;
            color: #e0e0e0;
        }

        /* Tombol Mulai Besar */
        .btn-mulai {
            background-color: #2d7a32;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 15px 60px;
            font-size: 1.2rem;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-mulai:hover {
            background-color: #3e8e41;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(45, 122, 50, 0.5);
        }

        /* Area Gambar Rover */
        .rover-container {
            position: relative;
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
        }

        /* Gambar Rover */
        .rover-img {
            max-width: 120%;
            /* Membuat gambar terlihat besar dan menjorok keluar */
            height: auto;
            position: relative;
            z-index: 2;
            transform: translateX(10%);
            /* Geser sedikit ke kanan */
        }

        /* Efek Garis Hijau di Belakang (Opsional/CSS Only) */
        /* Jika Anda punya gambar background garis hijau, masukkan di background-image .hero-section */
        .bg-lines {
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            /* Placeholder gradient untuk efek garis hijau jika tidak ada gambar asli */
            background: repeating-linear-gradient(45deg,
                    transparent,
                    transparent 10px,
                    rgba(45, 122, 50, 0.1) 10px,
                    rgba(45, 122, 50, 0.1) 11px);
            z-index: 1;
            mask-image: linear-gradient(to right, transparent, black);
            -webkit-mask-image: linear-gradient(to right, transparent, black);
        }

        @media (max-width: 768px) {
            .navbar-forte {
                padding: 15px 20px;
            }

            .hero-section {
                padding: 0 20px;
                flex-direction: column;
                justify-content: center;
                text-align: center;
            }

            .rover-img {
                max-width: 100%;
                transform: none;
                margin-top: 50px;
            }

            .hero-text h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-forte">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/FORTE.png') }}" alt="FORTE Logo">
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Connection</a></li>
                    <li class="nav-item"><a class="nav-link" href="setting">Setting</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Abouth Rover</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn-daftar-nav" href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid hero-section">
        <div class="bg-lines"></div>

        <div class="row w-100 align-items-center">

            <div class="col-lg-5 ps-lg-5 hero-text position-relative" style="z-index: 5;">
                <h1>Siap Mulai Perjalanan?</h1>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-mulai">Mulai</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-mulai">Mulai</a>
                    @endauth
                @endif
            </div>

            <div class="col-lg-7 rover-container">
                {{-- Menggunakan gambar yang sama dengan form_login --}}
                <img src="{{ asset('assets/img/2 1.png') }}" class="rover-img" alt="Forte Rover">
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
