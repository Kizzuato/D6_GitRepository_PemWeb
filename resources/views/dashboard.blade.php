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
              <h4 class="mb-0">6.61112</h4>
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
              <h4 class="mb-0">-8.90211</h4>
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
              <h4 class="mb-0">80 kWh</h4>
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
              <h4 class="mb-0">0.12</h4>
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
              <h4 class="mb-0">-0.03</h4>
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
              <h4 class="mb-0">0.93</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection