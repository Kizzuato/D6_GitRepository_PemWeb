<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - FORTE</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
            color: white;
            margin: 0;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar Styling (Konsisten) --- */
        .navbar-forte {
            padding: 20px 50px;
            z-index: 100;
        }

        .navbar-brand img {
            height: 20px;
            width: auto;
        }

        .nav-link {
            color: #ccc !important;
            margin: 0 15px;
            font-size: 1rem;
            font-weight: 400;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white !important;
            font-weight: 500;
        }

        .profile-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .avatar-circle-nav {
            width: 35px;
            height: 35px;
            background-color: #2d7a32;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* --- Main Layout --- */
        .profile-container {
            flex: 1;
            padding: 40px 50px;
            position: relative;
        }

        /* Background Lines (Hiasan) */
        .bg-lines {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: repeating-linear-gradient(120deg,
                    transparent,
                    transparent 20px,
                    rgba(45, 122, 50, 0.15) 20px,
                    rgba(45, 122, 50, 0.05) 22px);
            mask-image: radial-gradient(circle at bottom right, black, transparent 80%);
            -webkit-mask-image: radial-gradient(circle at bottom right, black, transparent 80%);
            z-index: 1;
            pointer-events: none;
        }

        /* --- Cards Styling --- */
        .card-profile {
            background-color: #2c2c2c;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            position: relative;
            z-index: 5;
            border: 1px solid #333;
        }

        /* Avatar Besar di Halaman Profile */
        .profile-avatar-lg {
            width: 120px;
            height: 120px;
            background-color: #2d7a32;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3rem;
            font-weight: 600;
            margin: 0 auto 20px auto;
            border: 4px solid #1a1a1a;
            box-shadow: 0 0 20px rgba(45, 122, 50, 0.5);
        }

        .user-role-badge {
            background-color: rgba(45, 122, 50, 0.2);
            color: #4caf50;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 20px;
            border: 1px solid #2d7a32;
        }

        /* Form Details */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #444;
            font-size: 0.95rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #888;
        }

        .detail-value {
            font-weight: 500;
            color: white;
        }

        .btn-edit-profile {
            background-color: #2d7a32;
            color: white;
            width: 100%;
            border: none;
            padding: 10px;
            border-radius: 12px;
            margin-top: 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-edit-profile:hover {
            background-color: #3e8e41;
            box-shadow: 0 5px 15px rgba(45, 122, 50, 0.3);
        }

        /* --- Chart Sections --- */
        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .credit-score-overlay {
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .score-val {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            line-height: 1;
        }

        .score-label {
            font-size: 0.8rem;
            color: #aaa;
            text-transform: uppercase;
        }

        .points-card {
            background: linear-gradient(135deg, #2c2c2c 0%, #202020 100%);
        }

        .points-highlight {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4caf50;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .navbar-forte {
                padding: 15px 20px;
            }

            .profile-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-forte navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/img/FORTE.png') }}" alt="FORTE Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="setting">Setting</a></li>
                    <li class="nav-item"><a class="nav-link" href="about">About Rover</a></li>
                </ul>
            </div>

            <div class="d-none d-lg-flex align-items-center ms-3">
                <div class="profile-pill">
                    <div class="avatar-circle-nav">AH</div>
                    <div class="ms-2 me-3">
                        <div class="user-name" style="font-size:0.9rem;">Akhsan Hakiki</div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="profile-container">
        <div class="bg-lines"></div>

        <div class="row g-4">
            {{-- Kiri: Data Pribadi --}}
            <div class="col-lg-4 col-md-5">
                <div class="card-profile text-center">
                    <div class="profile-avatar-lg">AH</div>
                    <h4 class="mb-1">Akhsan Hakiki</h4>
                    <span class="user-role-badge">Super Admin</span>

                    <div class="text-start mt-3">
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">akhsan@forte.com</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone</span>
                            <span class="detail-value">+62 812 3456 7890</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Location</span>
                            <span class="detail-value">Bandung, ID</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Member Since</span>
                            <span class="detail-value">Jan 2024</span>
                        </div>
                        <div class="detail-row border-0">
                            <span class="detail-label">Status</span>
                            <span class="text-success fw-bold"><i class="bi bi-circle-fill" style="font-size: 8px;"></i>
                                Active</span>
                        </div>
                    </div>

                    <button class="btn-edit-profile">
                        <i class="bi bi-pencil-square me-2"></i> Edit Profile
                    </button>
                </div>
            </div>

            {{-- Kanan: Statistik & Chart --}}
            <div class="col-lg-8 col-md-7">
                <div class="row g-4">
                    {{-- Credit Score Card --}}
                    <div class="col-md-6">
                        <div class="card-profile">
                            <h5 class="mb-4 d-flex align-items-center">
                                <i class="bi bi-shield-check me-2 text-success"></i> Credit Score
                            </h5>

                            <div class="chart-container">
                                <canvas id="creditScoreChart"></canvas>
                                <div class="credit-score-overlay">
                                    <div class="score-val" id="scoreValue">850</div>
                                    <div class="score-label">Excellent</div>
                                </div>
                            </div>
                            <p class="text-center text-muted small mt-2">
                                Skor Anda sangat baik. Pertahankan performa pelaporan Anda.
                            </p>
                        </div>
                    </div>

                    {{-- Points Card --}}
                    <div class="col-md-6">
                        <div class="card-profile points-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="mb-0"><i class="bi bi-gem me-2 text-warning"></i> Total Points</h5>
                                    <small class="text-muted">Accumulated rewards</small>
                                </div>
                                <div class="points-highlight">
                                    12,450
                                </div>
                            </div>

                            <div style="height: 180px; width: 100%;">
                                <canvas id="pointsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Activity Section (Optional filler) --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card-profile">
                            <h5 class="mb-3">Recent Activities</h5>
                            <div class="table-responsive">
                                <table class="table table-dark table-borderless align-middle mb-0">
                                    <thead class="text-secondary text-uppercase text-xs">
                                        <tr>
                                            <th>Activity</th>
                                            <th>Date</th>
                                            <th class="text-end">Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success rounded-circle p-1 me-2"
                                                        style="width:8px; height:8px;"></div>
                                                    Submitted Incident Report
                                                </div>
                                            </td>
                                            <td class="text-muted text-sm">Today, 10:23 AM</td>
                                            <td class="text-end text-success">+50</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success rounded-circle p-1 me-2"
                                                        style="width:8px; height:8px;"></div>
                                                    Daily Login Bonus
                                                </div>
                                            </td>
                                            <td class="text-muted text-sm">Today, 08:00 AM</td>
                                            <td class="text-end text-success">+10</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-secondary rounded-circle p-1 me-2"
                                                        style="width:8px; height:8px;"></div>
                                                    Updated Profile Info
                                                </div>
                                            </td>
                                            <td class="text-muted text-sm">Yesterday</td>
                                            <td class="text-end text-muted">0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- 1. Credit Score Chart (Gauge Style) ---
        const ctxScore = document.getElementById('creditScoreChart').getContext('2d');
        const scoreValue = 850; // Nilai Credit Score
        const maxScore = 1000;

        // Gradient color for score
        let gradientScore = ctxScore.createLinearGradient(0, 0, 200, 0);
        gradientScore.addColorStop(0, '#2d7a32'); // Hijau tua
        gradientScore.addColorStop(1, '#4caf50'); // Hijau terang

        const creditScoreChart = new Chart(ctxScore, {
            type: 'doughnut',
            data: {
                labels: ['Score', 'Remaining'],
                datasets: [{
                    data: [scoreValue, maxScore - scoreValue],
                    backgroundColor: [
                        gradientScore,
                        '#444' // Warna sisa (abu-abu gelap)
                    ],
                    borderWidth: 0,
                    borderRadius: 20, // Rounded ends
                    cutout: '85%', // Ketebalan gauge
                    circumference: 180, // Setengah lingkaran
                    rotation: 270, // Mulai dari kiri (jam 9)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            }
        });

        // --- 2. Points History Chart (Line Chart) ---
        const ctxPoints = document.getElementById('pointsChart').getContext('2d');

        // Gradient fill di bawah garis
        let gradientFill = ctxPoints.createLinearGradient(0, 0, 0, 400);
        gradientFill.addColorStop(0, 'rgba(76, 175, 80, 0.3)');
        gradientFill.addColorStop(1, 'rgba(76, 175, 80, 0.0)');

        const pointsChart = new Chart(ctxPoints, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Points Gained',
                    data: [120, 190, 150, 250, 220, 300, 350],
                    borderColor: '#4caf50',
                    backgroundColor: gradientFill,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4caf50',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // Garis melengkung halus
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#1a1a1a',
                        titleColor: '#fff',
                        bodyColor: '#ccc',
                        borderColor: '#333',
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    },
                    y: {
                        grid: {
                            color: '#333',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: false
                        }, // Sembunyikan angka Y agar bersih
                        border: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
