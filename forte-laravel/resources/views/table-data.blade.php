@extends('layouts.app')

@section('title', 'Table Data')

@section('content')
    {{-- Log Table --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-header pb-0 bg-dark border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        {{-- Judul dengan Icon Grafik --}}
                        <div class="d-flex align-items-center">
                            <i class="ni ni-chart-bar-32 me-2 text-white" style="font-size: 1.2rem;"></i>
                            <h5 class="mb-0 text-white" style="font-weight: 500;">Tabel Data Anomali</h5>
                        </div>

                        {{-- Header Tools (Search, Show, Date, Download) --}}
                        <div class="d-flex gap-2 align-items-center">
                            {{-- Search Bar --}}
                            <div class="input-group input-group-sm border-secondary" style="width: 200px;">
                                <span class="input-group-text bg-transparent text-white border-secondary"><i
                                        class="fas fa-search"></i></span>
                                <input type="text" class="form-control bg-transparent text-white border-secondary"
                                    placeholder="Search...">
                            </div>

                            {{-- Show Entries --}}
                            <div class="d-flex align-items-center text-xs text-white gap-2 ms-2">
                                <span>Show</span>
                                <select class="form-select form-select-sm bg-dark text-white border-secondary"
                                    style="width: 65px;">
                                    <option>10</option>
                                </select>
                                <span>entries</span>
                            </div>

                            {{-- Date Filter --}}
                            <select class="form-select form-select-sm bg-dark text-white border-white ms-2"
                                style="border-radius: 8px; width: 180px;">
                                <option>28 Dec 22 - 10 Jan 23</option>
                            </select>

                            {{-- Download Button --}}
                            <button class="btn btn-link text-white mb-0 ps-2">
                                <i class="fas fa-download" style="font-size: 1.1rem;"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2 mt-4">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" style="border-collapse: collapse;">
                            <thead>
                                <tr class="border-0">
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white ps-4 text-center">ID
                                        Sensor</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Lintang
                                    </th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Bujur</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Klasifikasi</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Anomali
                                    </th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Desc</th>
                                </tr>
                            </thead>

                            <tbody class="border-0">
                                @forelse ($reports as $index => $report)
                                    <tr
                                        style="background-color: {{ $index % 2 == 0 ? '#14451a' : '#1a1a1a' }}; border: none;">
                                        <td class="text-center text-sm py-3 text-white ps-4">{{ $report->id }}</td>
                                        <td class="text-center text-sm text-white">{{ $report->latitude }}</td>
                                        <td class="text-center text-sm text-white">{{ $report->longitude }}</td>
                                        <td class="text-center text-sm text-white">
                                            {{-- Misal ambil classification pertama --}}
                                            {{ $report->classifications->first()?->name ?? '-' }}
                                        </td>
                                        <td class="text-center text-sm text-white">{{ $report->title }}</td>
                                        <td class="text-center text-sm text-white px-2">
                                            {{ Str::limit($report->description, 50) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-white py-4">Belum ada laporan tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4 pb-3">
                        {{ $reports->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
