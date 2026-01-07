<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - FORTE</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* --- Global Styles --- */
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

        /* --- Navbar Styling --- */
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

        /* Background Lines Pattern */
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
            transition: transform 0.3s ease;
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
            text-transform: uppercase;
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

        /* Detail List Styling */
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

        /* --- Modal Custom Style (Dark Theme) --- */
        .modal-content-dark {
            background-color: #2c2c2c;
            color: white;
            border: 1px solid #444;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
        }

        .modal-header {
            border-bottom: 1px solid #444;
        }

        .modal-footer {
            border-top: 1px solid #444;
        }

        .form-control-dark {
            background-color: #1a1a1a;
            border: 1px solid #444;
            color: white;
            padding: 10px 15px;
        }

        .form-control-dark:focus {
            background-color: #222;
            border-color: #2d7a32;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(45, 122, 50, 0.25);
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
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
            transition: color 0.5s;
        }

        .score-label {
            font-size: 0.8rem;
            color: #aaa;
            text-transform: uppercase;
            font-weight: 600;
        }

        .points-card {
            background: linear-gradient(135deg, #2c2c2c 0%, #202020 100%);
        }

        .points-highlight {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4caf50;
            transition: all 0.5s;
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
                    <div class="avatar-circle-nav">
                        {{-- Menampilkan inisial 2 huruf dari Auth User jika ada, default AH --}}
                        {{ Auth::check() ? substr(Auth::user()->name, 0, 2) : 'AH' }}
                    </div>
                    <div class="ms-2 me-3">
                        <div class="user-name" style="font-size:0.9rem;">
                            {{ Auth::check() ? Auth::user()->name : 'Akhsan Hakiki' }}
                        </div>
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
                    {{-- Avatar Besar --}}
                    <div class="profile-avatar-lg">
                        {{ Auth::check() ? substr(Auth::user()->name, 0, 2) : 'AH' }}
                    </div>

                    <h4 class="mb-1">{{ Auth::check() ? Auth::user()->name : 'Akhsan Hakiki' }}</h4>
                    <span class="user-role-badge">Super Admin</span>

                    <div class="text-start mt-3">
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            {{-- Gunakan data dummy jika user belum login/backend belum siap --}}
                            <span
                                class="detail-value">{{ Auth::check() ? Auth::user()->email : 'akhsan@forte.com' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone</span>
                            <span
                                class="detail-value">{{ Auth::check() ? Auth::user()->phone ?? '+62 812 3456 7890' : '+62 812 3456 7890' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Location</span>
                            <span
                                class="detail-value">{{ Auth::check() ? Auth::user()->location ?? 'Bandung, ID' : 'Bandung, ID' }}</span>
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

                    {{-- Tombol untuk Membuka Modal Edit --}}
                    <button class="btn-edit-profile" data-bs-toggle="modal" data-bs-target="#editProfileModal">
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
                            <h5 class="mb-4 d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-shield-check me-2 text-success"></i> Credit Score</span>
                                <span class="badge bg-dark border border-secondary text-secondary"
                                    style="font-size: 0.6rem;">LIVE</span>
                            </h5>

                            <div class="chart-container">
                                <canvas id="creditScoreChart"></canvas>
                                <div class="credit-score-overlay">
                                    <div class="score-val" id="scoreValue">850</div>
                                    <div class="score-label" id="scoreLabel">Excellent</div>
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
                                <div class="points-highlight" id="totalPoints">
                                    12,450
                                </div>
                            </div>

                            <div style="height: 180px; width: 100%;">
                                <canvas id="pointsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Activity Table --}}
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

    {{-- MODAL EDIT PROFILE --}}
    {{-- Ini adalah Modal Pop-up yang muncul ketika tombol Edit ditekan --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                {{-- Form action dikosongkan/di-comment karena hanya frontend --}}
                <form action="#" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label text-secondary small">Full Name</label>
                            <input type="text" class="form-control form-control-dark"
                                value="{{ Auth::check() ? Auth::user()->name : 'Akhsan Hakiki' }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small">Email Address</label>
                            <input type="email" class="form-control form-control-dark"
                                value="{{ Auth::check() ? Auth::user()->email : 'akhsan@forte.com' }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small">Phone Number</label>
                                <input type="text" class="form-control form-control-dark"
                                    value="+62 812 3456 7890">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small">Location</label>
                                <input type="text" class="form-control form-control-dark" value="Bandung, ID">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- 1. Randomizer Utility ---
        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // --- 2. Credit Score Chart Logic ---
        const ctxScore = document.getElementById('creditScoreChart').getContext('2d');
        const scoreValEl = document.getElementById('scoreValue');
        const scoreLabelEl = document.getElementById('scoreLabel');
        const maxScore = 1000;

        let gradientGreen = ctxScore.createLinearGradient(0, 0, 200, 0);
        gradientGreen.addColorStop(0, '#2d7a32');
        gradientGreen.addColorStop(1, '#4caf50');

        let gradientWarn = ctxScore.createLinearGradient(0, 0, 200, 0);
        gradientWarn.addColorStop(0, '#dc3545');
        gradientWarn.addColorStop(1, '#ffc107');

        const creditScoreChart = new Chart(ctxScore, {
            type: 'doughnut',
            data: {
                labels: ['Score', 'Remaining'],
                datasets: [{
                    data: [850, 150],
                    backgroundColor: [gradientGreen, '#444'],
                    borderWidth: 0,
                    borderRadius: 20,
                    cutout: '85%',
                    circumference: 180,
                    rotation: 270,
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
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });

        function updateCreditScoreRandom() {
            const newScore = getRandomInt(300, 1000);
            const remaining = maxScore - newScore;

            let labelText = "Excellent";
            let color = gradientGreen;
            let textColor = "#4caf50";

            if (newScore < 500) {
                labelText = "Poor";
                color = gradientWarn;
                textColor = "#dc3545";
            } else if (newScore < 700) {
                labelText = "Good";
                color = gradientGreen;
                textColor = "#ffc107";
            }

            creditScoreChart.data.datasets[0].data = [newScore, remaining];
            creditScoreChart.data.datasets[0].backgroundColor[0] = color;
            creditScoreChart.update();

            scoreValEl.innerText = newScore;
            scoreValEl.style.color = textColor;
            scoreLabelEl.innerText = labelText;
            scoreLabelEl.style.color = textColor;
        }

        // --- 3. Points Chart Logic ---
        const ctxPoints = document.getElementById('pointsChart').getContext('2d');
        const totalPointsEl = document.getElementById('totalPoints');

        let gradientFill = ctxPoints.createLinearGradient(0, 0, 0, 400);
        gradientFill.addColorStop(0, 'rgba(76, 175, 80, 0.3)');
        gradientFill.addColorStop(1, 'rgba(76, 175, 80, 0.0)');

        const pointsChart = new Chart(ctxPoints, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Points',
                    data: [120, 190, 150, 250, 220, 300, 350],
                    borderColor: '#4caf50',
                    backgroundColor: gradientFill,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4caf50',
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#888'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        function updatePointsRandom() {
            const newData = [];
            for (let i = 0; i < 7; i++) {
                newData.push(getRandomInt(50, 400));
            }
            const sum = newData.reduce((a, b) => a + b, 0);
            const totalDummy = 10000 + (sum * 5);

            pointsChart.data.datasets[0].data = newData;
            pointsChart.update();

            totalPointsEl.innerText = totalDummy.toLocaleString('en-US');
        }

        // --- Interval Update (Simulasi Realtime) ---
        setInterval(() => {
            updateCreditScoreRandom();
            updatePointsRandom();
        }, 3000);
    </script>
</body>

</html>
