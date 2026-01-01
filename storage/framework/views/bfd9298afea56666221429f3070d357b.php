<?php $__env->startSection('content'); ?>
    <div class="row gap-4">
        <div class="card bg-dark text-white"> 
            <div class="mx-4 mt-2 d-flex justify-content-between">
            </div>
            <div class="card-body">
                <div class="row g-3">
                    
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
            
            <div class="mb-4">
                <div class="card-body">
                    <div class="bg-transparent border-0 mb-4">
                        Laporkan Anomali
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            Nama Anomali
                            <input class="form-control bg-dark mt-2 text-white" placeholder="Nama Anomali">
                        </div>
                        <div class="col-md-8">
                            Deskripsi Anomali
                            <textarea class="form-control bg-dark mt-2 text-white" rows="3" placeholder="Deskripsi"></textarea>
                        </div>
                    </div>

                    <button class="btn btn-success float-end">Simpan Data</button>
                </div>
            </div>

        </div>
        <div class="card bg-dark text-white">
            <div class="card-header pb-2 d-flex align-items-center gap-4">
                <h6 class="text-white mb-0">Monitoring Card</h6>
                <span id="status" class="badge bg-warning">OFFLINE</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    
                    <div class="col-md-4 col-6">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                <i class="ni ni-pin-3 me-2"></i>
                                <span>Latitude</span>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="mb-0" id="latitude">-</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                <i class="ni ni-pin-3 me-2"></i>
                                <span>Longitude</span>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="mb-0" id="longitude">-</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success text-white py-2 d-flex align-items-center">
                                <i class="ni ni-bolt me-2"></i>
                                <span>Daya (kWh)</span>
                            </div>
                            <div class="card-body text-center">
                                <h4 class="mb-0" id="daya">-</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success text-white py-2">
                                Accelerometer X
                            </div>
                            <div class="card-body text-center">
                                <h4 class="mb-0" id="acc_x">-</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success text-white py-2">
                                Accelerometer Y
                            </div>
                            <div class="card-body text-center">
                                <h4 class="mb-0" id="acc_y">-</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-6">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success text-white py-2">
                                Accelerometer Z
                            </div>
                            <div class="card-body text-center">
                                <h4 class="mb-0" id="acc_z">-</h4>
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
                                        stroke-width="12" fill="none" stroke-dasharray="377" stroke-dashoffset="377"
                                        stroke-linecap="round" transform="rotate(-90 70 70)" />

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

        function fetchData() {
            fetch("<?php echo e(route('fetch.data')); ?>")
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

                    document.getElementById('latitude').innerText = data?.gps?.lat ?? '-';
                    document.getElementById('longitude').innerText = data?.gps?.lon ?? '-';
                    document.getElementById('daya').innerText = data?.daya ?? '-';

                    document.getElementById('acc_x').innerText = data?.imu?.acc?.[0] ?? '-';
                    document.getElementById('acc_y').innerText = data?.imu?.acc?.[1] ?? '-';
                    document.getElementById('acc_z').innerText = data?.imu?.acc?.[2] ?? '-';
                })
                .catch(err => {
                    console.error(err);
                    stopPolling();
                });
        }

        function startPolling() {
            if (!polling) {
                polling = setInterval(fetchData, 1000); // JANGAN 200ms
            }
        }

        function stopPolling() {
            clearInterval(polling);
            polling = null;
        }

        function showOffline() {
            document.querySelectorAll('h4').forEach(el => {
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
            const res = await fetch("<?php echo e(route('camera.status')); ?>");
            const cam = await res.json();

            // FRONT
            if (cam.front) {
                frontImg.src = cam.front_url;
                frontImg.classList.remove('d-none');
                frontStatus.innerText = "Raspi Camera";
            } else {
                await startLaptopCamera(frontVid);
                frontStatus.innerText = "Laptop Camera";
            }

            // BACK
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

        // contoh dummy
        setRPM(10)
        setBattery(50);

        initCamera();

        // mulai polling
        startPolling();
        fetchData();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kizzuato/Projects/i-will/rover/pemdas/forte-frontend/resources/views/dashboard.blade.php ENDPATH**/ ?>