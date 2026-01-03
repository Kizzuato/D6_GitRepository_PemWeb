@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        {{-- ================= ENERGY MONITORING ================= --}}
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h6 class="mb-0">Energy Monitoring (MQTT)</h6>
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

            {{-- ================= RPM & BATTERY ================= --}}
            <div class="card-body">
                <div class="row g-3">

                    {{-- RPM --}}
                    <div class="col-md-8">
                        <h6><i class="bi bi-speedometer"></i> RPM Diagram</h6>
                        <div class="card bg-secondary text-center">
                            <svg width="260" height="140" viewBox="0 0 260 140">
                                <path d="M20,120 A110,110 0 0 1 240,120" stroke="#333" stroke-width="16" fill="none" />
                                <path id="rpmArc" d="M20,120 A110,110 0 0 1 240,120" stroke="#28a745" stroke-width="16"
                                    fill="none" stroke-dasharray="345" stroke-dashoffset="345" stroke-linecap="round" />
                                <text x="130" y="95" text-anchor="middle" font-size="36" fill="#fff"
                                    id="rpmValue">0</text>
                                <text x="130" y="120" text-anchor="middle" font-size="12" fill="#aaa">RPM × 1000</text>
                            </svg>
                        </div>
                    </div>

                    {{-- Battery --}}
                    <div class="col-md-4">
                        <h6><i class="bi bi-battery"></i> Battery</h6>
                        <div class="card bg-secondary text-center">
                            <svg width="140" height="140">
                                <circle cx="70" cy="70" r="60" stroke="#333" stroke-width="12"
                                    fill="none" />
                                <circle id="batteryArc" cx="70" cy="70" r="60" stroke="#28a745"
                                    stroke-width="12" fill="none" stroke-dasharray="377" stroke-dashoffset="377"
                                    transform="rotate(-90 70 70)" stroke-linecap="round" />
                                <text x="70" y="78" text-anchor="middle" font-size="28" fill="#fff"
                                    id="batteryValue">0%</text>
                            </svg>
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

        startPolling();
        fetchData();
    </script>
@endsection
