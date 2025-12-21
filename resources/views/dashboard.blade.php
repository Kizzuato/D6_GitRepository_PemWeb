@extends('layouts.app')

@section('content')

<div class="row">{{-- Monitoring Card --}}
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
              <h4 class="mb-0" id="latitude">-</h4>
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
              <h4 class="mb-0" id="longitude">-</h4>
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
              <h4 class="mb-0" id="daya">-</h4>
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
              <h4 class="mb-0" id="acc_x">-</h4>
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
              <h4 class="mb-0" id="acc_y">-</h4>
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
              <h4 class="mb-0" id="acc_z">-</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function fetchData() {
    fetch("{{ route('fetch.data') }}")
        .then(response => response.json())
        .then(data => {
            document.getElementById('latitude').innerText = (data && data.gps && data.gps.lat) || '-';
            document.getElementById('longitude').innerText = (data && data.gps && data.gps.lon) || '-';
            document.getElementById('daya').innerText = (data && data.daya) || '-';
            document.getElementById('acc_x').innerText = (data && data.imu && data.imu.acc && data.imu.acc[0] !== undefined ? data.imu.acc[0] : '-');
            document.getElementById('acc_y').innerText = (data && data.imu && data.imu.acc && data.imu.acc[1] !== undefined ? data.imu.acc[1] : '-');
            document.getElementById('acc_z').innerText = (data && data.imu && data.imu.gyro && data.imu.gyro[2] !== undefined ? data.imu.gyro[2] : '-');
        })
        .catch(err => console.error('Error fetching data:', err));
}

// Polling setiap 200ms
setInterval(fetchData, 200);

// Fetch data pertama kali saat halaman load
fetchData();
</script>


@endsection
