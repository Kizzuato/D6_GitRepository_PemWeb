@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        <div class="card bg-dark text-white">

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
                            <img id="frontCam" class="img-fluid rounded"
                                src="{{ config('services.raspi.host')
                                    ? 'http://' . config('services.raspi.host') . ':' . config('services.raspi.port') . '/video'
                                    : '' }}"
                                alt="Front Camera" />

                            <small class="text-muted">Live MJPEG Stream</small>

                            <small id="frontStatus" class="text-muted"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="text-white mb-2">
                            <i class="bi bi-camera text-white fs-5"></i> Live Back Camera
                        </h6>

                        <div class="card bg-secondary p-2 text-center">
                            <img id="backCam" class="img-fluid rounded"
                                src="{{ config('services.esp.host')
                                    ? 'http://' . config('services.esp.host') . ':' . config('services.esp.port') . '/stream'
                                    : '' }}"
                                alt="Back Camera" />

                            <small class="text-muted">Live MJPEG Stream</small>

                            <small id="frontStatus" class="text-muted"></small>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ====================== FORM LAPOR ====================== --}}
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
                                <img id="snapshotPreview" class="d-none mt-2" width="100%">

                            </div>
                            <input type="hidden" name="image" id="snapshotInput">
                            <button type="button" id="captureBtn" class="btn btn-danger">
                                📸 Snapshot
                            </button>

                        </div>

                        <button type="submit" class="btn btn-success float-end">Simpan Laporan</button>
                    </form>
                </div>
            </div>


        </div>

        {{-- ===================== MONITORING CARD ===================== --}}
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
            /* ===================== ELEMENT ===================== */
            const captureBtn = document.getElementById('captureBtn');
            const snapshotPreview = document.getElementById('snapshotPreview');
            const snapshotInput = document.getElementById('snapshotInput');

            const latitudeCard = document.getElementById('latitudeCard');
            const longitudeCard = document.getElementById('longitudeCard');
            const dayaCard = document.getElementById('dayaCard');
            const accXCard = document.getElementById('accXCard');
            const accYCard = document.getElementById('accYCard');
            const accZCard = document.getElementById('accZCard');

            const reportLat = document.getElementById('reportLat');
            const reportLon = document.getElementById('reportLon');

            /* ===================== SNAPSHOT ===================== */
            captureBtn.addEventListener('click', () => {
                const snapshotUrl =
                    `http://{{ config('services.raspi.host') }}:{{ config('services.raspi.port') }}/snapshot?ts=${Date.now()}`;

                snapshotPreview.src = snapshotUrl;
                snapshotPreview.classList.remove('d-none');

                // SIMPAN KE FORM
                snapshotInput.value = snapshotUrl;
            });

            // /* ===================== DUMMY DATA ===================== */
            // function rand(min, max, fixed = 2) {
            //     return (Math.random() * (max - min) + min).toFixed(fixed);
            // }

            // function updateDummy() {
            //     const lat = rand(-90, 90);
            //     const lon = rand(-180, 180);

            //     latitudeCard.innerText = lat;
            //     longitudeCard.innerText = lon;
            //     dayaCard.innerText = rand(0, 100, 0);

            //     accXCard.innerText = rand(-10, 10);
            //     accYCard.innerText = rand(-10, 10);
            //     accZCard.innerText = rand(-10, 10);

            //     reportLat.value = lat;
            //     reportLon.value = lon;

            //     setRPM(Math.floor(rand(0, 100, 0)));
            //     setBattery(Math.floor(rand(0, 100, 0)));
            // }

            // setInterval(updateDummy, 1000);
            // updateDummy();

            /* ===================== RPM ===================== */
            function setRPM(value, max = 100) {
                const arc = document.getElementById('rpmArc');
                const text = document.getElementById('rpmValue');
                const circumference = 345;

                const percent = Math.min(value / max, 1);
                arc.style.strokeDashoffset = circumference * (1 - percent);
                text.innerText = value;
            }

            /* ===================== BATTERY ===================== */
            function setBattery(percent) {
                const arc = document.getElementById('batteryArc');
                const text = document.getElementById('batteryValue');
                const circumference = 377;

                arc.style.strokeDashoffset = circumference * (1 - percent / 100);
                text.innerText = percent + '%';
            }

            function fetchMQTTData() {
                fetch("{{ route('mqttfetch.data') }}")
                    .then(res => res.json())
                    .then(data => {

                        /* ========== GPS ========== */
                        if (data.gps && data.gps.lat !== undefined) {
                            latitudeCard.innerText = data.gps.lat.toFixed(6);
                            longitudeCard.innerText = data.gps.lon.toFixed(6);

                            reportLat.value = data.gps.lat;
                            reportLon.value = data.gps.lon;
                        }

                        /* ========== ENERGY ========== */
                        if (data.energy && data.energy.energy_kwh !== undefined) {
                            dayaCard.innerText = data.energy.energy_kwh.toFixed(4) + ' kWh';

                            // RPM simulasi dari power
                            setRPM(Math.min(Math.round(data.energy.power / 2), 100));

                            // Battery simulasi dari voltage
                            setBattery(Math.min(Math.round((data.energy.voltage / 240) * 100), 100));
                        }

                        /* ========== IMU ========== */
                        if (data.imu && data.imu.acc) {
                            accXCard.innerText = data.imu.acc[0];
                            accYCard.innerText = data.imu.acc[1];
                            accZCard.innerText = data.imu.acc[2];
                        }

                    })
                    .catch(err => console.error('MQTT fetch error:', err));
            }

            // polling tiap 1 detik
            setInterval(fetchMQTTData, 1000);
            fetchMQTTData();
        </script>
    @endsection
