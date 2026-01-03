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

                    @php
                        $cards = [
                            ['Voltage', 'voltageCard'],
                            ['Current', 'currentCard'],
                            ['Power', 'powerCard'],
                            ['Energy (Wh)', 'energyWhCard'],
                            ['Energy (kWh)', 'energyKwhCard'],
                            ['Cost (Rp)', 'biayaCard'],
                        ];
                    @endphp

                    @foreach ($cards as [$label, $id])
                        <div class="col-md-4">
                            <div class="card bg-secondary h-100">
                                <div class="card-header bg-success">{{ $label }}</div>
                                <div class="card-body text-center">
                                    <h4 id="{{ $id }}">-</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="mt-3">
                    <div class="card bg-secondary h-100">
                        <div class="card-header bg-warning text-dark">
                            Monthly Estimation
                        </div>
                        <div class="card-body text-center">
                            <h5 id="monthlyKwh">- kWh</h5>
                            <h4 id="monthlyCost">Rp -</h4>
                            <small class="text-muted">Estimasi 30 hari</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= DAILY CHART ================= --}}
            <div class="card bg-dark text-white">
                <div class="card-header">
                    <h6 class="mb-0">Daily Energy Usage (kWh)</h6>
                </div>
                <div class="card-body">
                    <canvas id="energyChart" height="120"></canvas>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            let polling = null;
            const TARIF_PER_KWH = 1444;

            /* ================= REALTIME ================= */
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
                        calculateMonthlyPrediction(e.energy_kwh);
                    });
            }

            function startPolling() {
                if (!polling) polling = setInterval(fetchData, 1000);
            }

            /* ================= RPM ================= */
            function setRPM(value) {
                rpmArc.style.strokeDashoffset = 345 * (1 - value / 100);
                rpmValue.innerText = value;
            }

            /* ================= BATTERY ================= */
            function setBattery(percent) {
                batteryArc.style.strokeDashoffset = 377 * (1 - percent / 100);
                batteryValue.innerText = percent + '%';
            }

            /* ================= STATUS ================= */
            function setStatus(isOnline) {
                deviceStatus.className = 'badge ' + (isOnline ? 'bg-success' : 'bg-danger');
                deviceStatus.innerHTML = `<i class="fas fa-circle me-1"></i> ${isOnline ? 'ONLINE' : 'OFFLINE'}`;
            }

            /* ================= MONTHLY ================= */
            function calculateMonthlyPrediction(todayKwh) {
                const kwh = todayKwh * 30;
                const cost = kwh * TARIF_PER_KWH;
                monthlyKwh.innerText = kwh.toFixed(2) + ' kWh';
                monthlyCost.innerText = 'Rp ' + cost.toLocaleString('id-ID');
            }

            /* ================= DAILY CHART ================= */
            const energyChart = new Chart(energyChartCtx = document.getElementById('energyChart'), {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40,167,69,.15)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: '#ccc'
                            }
                        },
                        y: {
                            ticks: {
                                color: '#ccc'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // fetch('/energy/daily')
            //     .then(res => res.json())
            //     .then(data => {
            //         energyChart.data.labels = data.map(d => d.date);
            //         energyChart.data.datasets[0].data = data.map(d => d.kwh);
            //         energyChart.update();
            //     });

            startPolling();
            fetchData();
        </script>
    @endsection
