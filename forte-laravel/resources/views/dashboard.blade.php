@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        <div class="card bg-dark text-white"> {{-- Monitoring Card --}}
            <div class="mx-4 mt-2 d-flex justify-content-between">
            </div>
            <div class="card-body">
                <div class="row g-3">
                    {{-- Front Camera --}}
                    <div class="col-md-6">
                        <h6 class="text-white mb-2">
                            <i class="bi bi-camera text-white fs-5"></i> Live Front Camera
                        </h6>
                        <div class="card bg-secondary p-2 text-center">
                            <img id="frontImg" class="img-fluid rounded d-none">
                            <video id="frontVid" class="w-100 rounded d-none" autoplay muted playsinline></video>
                            <small id="frontStatus" class="text-muted"></small>
                        </div>
                    </div>

                    {{-- Back Camera --}}
                    <div class="col-md-6">
                        <h6 class="text-white mb-2 ">
                            <i class="bi bi-camera text-white fs-5"></i> Live Back Camera
                        </h6>
                        <div class="card bg-secondary p-2 text-center">
                            <img id="backImg" class="img-fluid rounded d-none">
                            <video id="backVid" class="w-100 rounded d-none" autoplay muted playsinline></video>
                            <small id="backStatus" class="text-muted"></small>
                        </div>
                    </div>
                </div>

            </div>
            {{-- sec lapor annomali --}}
            <div class="mb-4">
                <div class="card-body">
                    <div class="fw-bold text-white mb-3">Laporkan Anomali</div>

                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data"
                        id="reportForm">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label text-white">Nama Anomali</label>
                                <input name="title" class="form-control bg-dark text-white" placeholder="Nama Anomali"
                                    required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label text-white">Deskripsi Anomali</label>
                                <textarea name="description" class="form-control bg-dark text-white" rows="3" placeholder="Deskripsi" required></textarea>
                            </div>
                        </div>

                        {{-- Hidden latitude & longitude --}}
                        <input type="hidden" name="latitude" id="reportLat">
                        <input type="hidden" name="longitude" id="reportLon">

                        {{-- Capture Image --}}
                        <div class="mb-3">
                            <label class="form-label text-white">Gambar Snapshot Front Camera</label>
                            <div class="mb-2">
                                <img id="snapshotPreview" class="img-fluid rounded d-none" alt="Snapshot Preview">
                            </div>
                            <input type="hidden" name="image" id="snapshotInput">
                            <button type="button" class="btn btn-info btn-sm" id="captureBtn">
                                <i class="bi bi-camera me-1"></i> Ambil Snapshot
                            </button>
                        </div>

                        <button type="submit" class="btn btn-success float-end">Simpan Laporan</button>
                    </form>
                </div>
            </div>


        </div>
        <div class="card bg-dark text-white">
            <div class="card-header pb-0">
                <h6 class="text-white mb-0">Monitoring Card</h6>
            </div>

            <div class="card-body">
                <div class="row gap-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- Latitude --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                            <i class="ni ni-pin-3 me-2"></i>
                                            <span>Latitude</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="latitudeCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Longitude --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                            <i class="ni ni-pin-3 me-2"></i>
                                            <span>Longitude</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="longitudeCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Daya --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                            <i class="ni ni-bolt me-2"></i>
                                            <span>Daya (kWh)</span>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="dayaCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Accelerometer X --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2">
                                            Accelerometer X
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="accXCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Accelerometer Y --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2">
                                            Accelerometer Y
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="accYCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                                {{-- Accelerometer Z --}}
                                <div class="col-md-4">
                                    <div class="card bg-secondary h-100">
                                        <div class="card-header bg-success text-white py-2">
                                            Accelerometer Z
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="mb-0" id="accZCard">-</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-dark text-white">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <h6 class="text-white mb-2">
                                <i class="bi bi-speedometer text-white fs-5"></i> RPM Diagram
                            </h6>
                            <div class="card bg-secondary ">
                                <div class="card-body text-center">

                                    <div class="d-flex justify-content-center">
                                        <svg width="260" height="140" viewBox="0 0 260 140">
                                            <!-- Background arc -->
                                            <path d="M20,120 A110,110 0 0 1 240,120" stroke="#333" stroke-width="16"
                                                fill="none" />

                                            <!-- Progress arc -->
                                            <path id="rpmArc" d="M20,120 A110,110 0 0 1 240,120" stroke="#28a745"
                                                stroke-width="16" fill="none" stroke-dasharray="345"
                                                stroke-dashoffset="345" stroke-linecap="round" />

                                            <!-- Text -->
                                            <text x="130" y="95" text-anchor="middle" font-size="36" fill="#fff"
                                                id="rpmValue">0</text>

                                            <text x="130" y="120" text-anchor="middle" font-size="12" fill="#aaa">RPM
                                                × 1000/min</text>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-white mb-2">
                                <i class="bi bi-battery text-white fs-5"></i> Battery Status
                            </h6>
                            <div class="card bg-secondary ">
                                <div class="card-body text-center">
                                    <svg width="140" height="140">
                                        <circle cx="70" cy="70" r="60" stroke="#333" stroke-width="12"
                                            fill="none" />

                                        <circle id="batteryArc" cx="70" cy="70" r="60" stroke="#28a745"
                                            stroke-width="12" fill="none" stroke-dasharray="377"
                                            stroke-dashoffset="377" stroke-linecap="round"
                                            transform="rotate(-90 70 70)" />

                                        <text x="70" y="78" text-anchor="middle" font-size="28" fill="#fff"
                                            id="batteryValue">0%</text>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let polling = null;

            const captureBtn = document.getElementById('captureBtn');
            const snapshotInput = document.getElementById('snapshotInput');
            const snapshotPreview = document.getElementById('snapshotPreview');
            const reportLat = document.getElementById('reportLat');
            const reportLon = document.getElementById('reportLon');

            const latitudeCard = document.getElementById('latitudeCard');
            const longitudeCard = document.getElementById('longitudeCard');
            const dayaCard = document.getElementById('dayaCard');
            const accXCard = document.getElementById('accXCard');
            const accYCard = document.getElementById('accYCard');
            const accZCard = document.getElementById('accZCard');

            const frontVid = document.getElementById('frontVid');
            const frontImg = document.getElementById('frontImg');
            const backVid = document.getElementById('backVid');
            const backImg = document.getElementById('backImg');
            const frontStatus = document.getElementById('frontStatus');
            const backStatus = document.getElementById('backStatus');

            function getRandom(min, max, fixed = 2) {
                return (Math.random() * (max - min) + min).toFixed(fixed);
            }

            function updateRandomData() {
                const lat = getRandom(-90, 90);
                const lon = getRandom(-180, 180);
                const daya = getRandom(0, 100, 0);
                const accX = getRandom(-10, 10);
                const accY = getRandom(-10, 10);
                const accZ = getRandom(-10, 10);

                // update card
                latitudeCard.innerText = lat;
                longitudeCard.innerText = lon;
                dayaCard.innerText = daya;
                accXCard.innerText = accX;
                accYCard.innerText = accY;
                accZCard.innerText = accZ;

                // update hidden form input supaya bisa disubmit
                reportLat.value = lat;
                reportLon.value = lon;

                // update RPM & Battery random
                setRPM(Math.floor(getRandom(0, 100, 0)));
                setBattery(Math.floor(getRandom(0, 100, 0)));
            }

            // update setiap detik
            setInterval(updateRandomData, 1000);
            updateRandomData(); // panggil sekali saat load

            // Capture snapshot front camera
            captureBtn.addEventListener('click', () => {
                const canvas = document.createElement('canvas');

                let videoEl = !frontVid.classList.contains('d-none') ? frontVid : null;
                let imgEl = !frontImg.classList.contains('d-none') ? frontImg : null;

                if (videoEl) {
                    canvas.width = videoEl.videoWidth;
                    canvas.height = videoEl.videoHeight;
                    canvas.getContext('2d').drawImage(videoEl, 0, 0);
                } else if (imgEl) {
                    canvas.width = imgEl.naturalWidth;
                    canvas.height = imgEl.naturalHeight;
                    canvas.getContext('2d').drawImage(imgEl, 0, 0);
                } else {
                    alert('Front camera tidak aktif!');
                    return;
                }

                const dataUrl = canvas.toDataURL('image/png');
                snapshotInput.value = dataUrl;
                snapshotPreview.src = dataUrl;
                snapshotPreview.classList.remove('d-none');
            });

            // Fetch data dari backend (jika ada)
            function fetchData() {
                fetch("{{ route('fetch.data') }}")
                    .then(res => res.json())
                    .then(res => {
                        if (res.status === 'offline') {
                            console.warn('Raspi offline, stop polling');
                            stopPolling();
                            showOffline();
                            return;
                        }

                        const data = res.data;

                        document.getElementById('status').className = 'badge bg-success';
                        document.getElementById('status').innerText = 'ONLINE';

                        // update card dengan data backend
                        latitudeCard.innerText = data?.gps?.lat ?? latitudeCard.innerText;
                        longitudeCard.innerText = data?.gps?.lon ?? longitudeCard.innerText;
                        dayaCard.innerText = data?.daya ?? dayaCard.innerText;
                        accXCard.innerText = data?.imu?.acc?.[0] ?? accXCard.innerText;
                        accYCard.innerText = data?.imu?.acc?.[1] ?? accYCard.innerText;
                        accZCard.innerText = data?.imu?.acc?.[2] ?? accZCard.innerText;

                        // update hidden form input
                        reportLat.value = latitudeCard.innerText;
                        reportLon.value = longitudeCard.innerText;
                    })
                    .catch(err => {
                        console.error(err);
                        stopPolling();
                    });
            }

            function startPolling() {
                if (!polling) {
                    polling = setInterval(fetchData, 1000);
                }
            }

            function stopPolling() {
                clearInterval(polling);
                polling = null;
            }

            function showOffline() {
                [latitudeCard, longitudeCard, dayaCard, accXCard, accYCard, accZCard].forEach(el => {
                    el.innerText = '-';
                });
            }

            async function startLaptopCamera(videoEl) {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                videoEl.srcObject = stream;
                videoEl.classList.remove('d-none');
            }

            async function initCamera() {
                const res = await fetch("{{ route('camera.status') }}");
                const cam = await res.json();

                // FRONT CAMERA
                if (cam.front) {
                    frontImg.src = cam.front_url;
                    frontImg.classList.remove('d-none');
                    frontStatus.innerText = "Raspi Camera";
                } else {
                    await startLaptopCamera(frontVid);
                    frontStatus.innerText = "Laptop Camera";
                }

                // BACK CAMERA
                if (cam.back) {
                    backImg.src = cam.back_url;
                    backImg.classList.remove('d-none');
                    backStatus.innerText = "Raspi Camera";
                } else {
                    await startLaptopCamera(backVid);
                    backStatus.innerText = "Laptop Camera";
                }
            }

            function setRPM(value, max = 100) {
                const arc = document.getElementById('rpmArc');
                const text = document.getElementById('rpmValue');

                const circumference = 345;
                const percent = Math.min(value / max, 1);
                const offset = circumference * (1 - percent);

                arc.style.strokeDashoffset = offset;
                text.innerText = value;

                // warna dinamis
                if (percent < 0.6) arc.style.stroke = '#28a745';
                else if (percent < 0.85) arc.style.stroke = '#ffc107';
                else arc.style.stroke = '#dc3545';
            }

            function setBattery(percent) {
                const arc = document.getElementById('batteryArc');
                const text = document.getElementById('batteryValue');

                const circumference = 377;
                const offset = circumference * (1 - percent / 100);

                arc.style.strokeDashoffset = offset;
                text.innerText = percent + '%';

                if (percent > 60) arc.style.stroke = '#28a745';
                else if (percent > 30) arc.style.stroke = '#ffc107';
                else arc.style.stroke = '#dc3545';
            }

            // contoh awal dummy
            setRPM(10);
            setBattery(50);

            initCamera();
            startPolling();
            fetchData();
        </script>
    @endsection
