@extends('layouts.app')

@section('content')
    {{-- Log Table --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card p-3 map-card">
                    <h6 class="text-white mb-3">Mini map</h6>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
