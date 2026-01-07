@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        {{-- ================= ENERGY MONITORING ================= --}}
        <div class="card bg-dark text-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Energy Monitoring</h6>

                <span id="device-status" class="badge bg-secondary">
                    <i class="fas fa-circle me-1"></i> Checking...
                </span>
            </div>



            <div class="card-body">
                <div class="row g-3">

                    {{-- Voltage --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Voltage</div>
                            <div class="card-body text-center">
                                <h4 id="voltageCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Current --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Current</div>
                            <div class="card-body text-center">
                                <h4 id="currentCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Power --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Power</div>
                            <div class="card-body text-center">
                                <h4 id="powerCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Energy Wh --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Energy (Wh)</div>
                            <div class="card-body text-center">
                                <h4 id="energyWhCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Energy kWh --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Energy (kWh)</div>
                            <div class="card-body text-center">
                                <h4 id="energyKwhCard">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Cost --}}
                    <div class="col-md-4">
                        <div class="card bg-secondary h-100">
                            <div class="card-header bg-success">Cost (Rp)</div>
                            <div class="card-body text-center">
                                <h4 id="biayaCard">-</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- ================= JAVASCRIPT ================= --}}
    <script>
        let polling = null;

        const voltageCard = document.getElementById('voltageCard');
        const currentCard = document.getElementById('currentCard');
        const powerCard = document.getElementById('powerCard');
        const energyWhCard = document.getElementById('energyWhCard');
        const energyKwhCard = document.getElementById('energyKwhCard');
        const biayaCard = document.getElementById('biayaCard');

        function fetchData() {
            fetch("{{ route('mqttfetch.data') }}")
                .then(res => res.json())
                .then(res => {
                    if (!res.energy) return;
                    const e = res.energy;

                    voltageCard.innerText = e.voltage.toFixed(1) + ' V';
                    currentCard.innerText = e.current.toFixed(2) + ' A';
                    powerCard.innerText = e.power.toFixed(1) + ' W';
                    energyWhCard.innerText = e.energy.toFixed(3) + ' Wh';
                    energyKwhCard.innerText = e.energy_kwh.toFixed(5) + ' kWh';
                    biayaCard.innerText = 'Rp ' + e.biaya_rp;

                    setRPM(Math.min(Math.round(e.power / 2), 100));
                    setBattery(Math.min(Math.round((e.voltage / 240) * 100), 100));
                })
                .catch(() => stopPolling());
        }

        function startPolling() {
            if (!polling) polling = setInterval(fetchData, 1000);
        }

        function stopPolling() {
            clearInterval(polling);
            polling = null;
        }

        function setRPM(value) {
            const arc = document.getElementById('rpmArc');
            const text = document.getElementById('rpmValue');
            arc.style.strokeDashoffset = 345 * (1 - value / 100);
            text.innerText = value;
        }

        function setBattery(percent) {
            const arc = document.getElementById('batteryArc');
            const text = document.getElementById('batteryValue');
            arc.style.strokeDashoffset = 377 * (1 - percent / 100);
            text.innerText = percent + '%';
        }

        const statusBadge = document.getElementById('device-status');

        function setStatus(isOnline) {
            if (isOnline) {
                statusBadge.className = 'badge bg-success';
                statusBadge.innerHTML = '<i class="fas fa-circle me-1"></i> ONLINE';
            } else {
                statusBadge.className = 'badge bg-danger';
                statusBadge.innerHTML = '<i class="fas fa-circle me-1"></i> OFFLINE';
            }
        }

        async function checkStatus() {
            try {
                const res = await fetch("{{ route('mqttfetch.data') }}");
                const data = await res.json();

                // anggap device online kalau data energi ada
                const isOnline = data.energy && Object.keys(data.energy).length > 0;
                setStatus(isOnline);
            } catch (err) {
                setStatus(false);
            }
        }

        // cek pertama
        checkStatus();

        // refresh tiap 5 detik
        setInterval(checkStatus, 5000);

        startPolling();
        fetchData();
    </script>
@endsection
