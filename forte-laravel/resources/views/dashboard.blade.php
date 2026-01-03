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
                            <img 
                                src="http://192.168.137.207:5000/video"
                                class="img-fluid rounded"
                                style="max-height:480px;"
                                alt="Front Camera">

                            <small class="text-muted">
                                Source: Raspberry Pi Flask Stream
                            </small>
                        </div>
                    </div>

                    {{-- Back Camera (Optional / Backup) --}}
                    <div class="col-md-6">
                        <h6 class="text-white mb-2">
                            <i class="bi bi-camera text-white fs-5"></i> Live Back Camera
                        </h6>

                        <div class="card bg-secondary p-2 text-center">
                            <img 
                                src="http://192.168.137.207:5000/video"
                                class="img-fluid rounded"
                                style="max-height:480px;"
                                alt="Back Camera">

                            <small class="text-muted">
                                Source: Raspberry Pi Flask Stream
                            </small>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ====================== FORM LAPOR ====================== --}}
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

        {{-- ===================== MONITORING CARD ===================== --}}
        <div class="card bg-dark text-white">
          <div class="card-header pb-0">
            <h6 class="text-white mb-0">Monitoring Card</h6>
          </div>

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
                    <h4 class="mb-0">
                      {{ $sensor->latitude ?? '-' }}
                    </h4>
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
                    <h4 class="mb-0">
                      {{ $sensor->longitude ?? '-' }}
                    </h4>
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
                    <h4 class="mb-0">
                      {{ $sensor->daya ?? '-' }}
                    </h4>
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
                    <h4 class="mb-0">
                      {{ $sensor->accelx ?? '-' }}
                    </h4>
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
                    <h4 class="mb-0">
                      {{ $sensor->accely ?? '-' }}
                    </h4>
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
                    <h4 class="mb-0">
                      {{ $sensor->accelz ?? '-' }}
                    </h4>
                  </div>
                </div>
            </div>

            </div>
        </div>

        {{-- ================= RPM & BATTERY ================= --}}
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

                                        <path d="M20,120 A110,110 0 0 1 240,120"
                                              stroke="#333" stroke-width="16" fill="none" />

                                        <path id="rpmArc"
                                              d="M20,120 A110,110 0 0 1 240,120"
                                              stroke="#28a745"
                                              stroke-width="16"
                                              fill="none"
                                              stroke-dasharray="345"
                                              stroke-dashoffset="345"
                                              stroke-linecap="round" />

                                        <text x="130" y="95" text-anchor="middle" font-size="36" fill="#fff"
                                              id="rpmValue">0</text>

                                        <text x="130" y="120" text-anchor="middle" font-size="12" fill="#aaa">
                                            RPM × 1000/min
                                        </text>

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
                                    <circle cx="70" cy="70" r="60" stroke="#333" stroke-width="12" fill="none" />

                                    <circle id="batteryArc" cx="70" cy="70" r="60"
                                            stroke="#28a745"
                                            stroke-width="12"
                                            fill="none"
                                            stroke-dasharray="377"
                                            stroke-dashoffset="377"
                                            stroke-linecap="round"
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


    {{-- ====================== SCRIPT ====================== --}}
    <script>
        let polling = null;

        function fetchData() {
            fetch("{{ route('fetch.data') }}")
                .then(res => res.json())
                .then(res => {

                    if (res.status === 'offline') {
                        stopPolling();
                        showOffline();
                        return;
                    }

                    const data = res.data;

                    document.getElementById('latitude').innerText = data?.gps?.lat ?? '-';
                    document.getElementById('longitude').innerText = data?.gps?.lon ?? '-';
                    document.getElementById('daya').innerText = data?.daya ?? '-';

                })
                .catch(err => stopPolling());
        }

        function startPolling() {
            if (!polling) polling = setInterval(fetchData, 1000);
        }

        function stopPolling() {
            clearInterval(polling);
            polling = null;
        }

        function showOffline() {
            document.querySelectorAll('h4').forEach(el => el.innerText = '-');
        }

        function setRPM(v,max=100){
            const c=345,p=Math.min(v/max,1),o=c*(1-p);
            rpmArc.style.strokeDashoffset=o;
            rpmValue.innerText=v;
        }

        function setBattery(p){
            const c=377,o=c*(1-p/100);
            batteryArc.style.strokeDashoffset=o;
            batteryValue.innerText=p+"%";
        }

        setRPM(10);
        setBattery(50);
        startPolling();
        fetchData();
    </script>

@endsection
