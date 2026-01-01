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
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Zona</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Anomali
                                    </th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Desc</th>
                                </tr>
                            </thead>

                            <tbody class="border-0">
                                {{-- Baris 1: Hijau Tua --}}
                                <tr style="background-color: #14451a; border: none;">
                                    <td class="text-center text-sm py-3 text-white ps-4">Node_A01</td>
                                    <td class="text-center text-sm text-white">-7.1203</td>
                                    <td class="text-center text-sm text-white">110.4210</td>
                                    <td class="text-center text-sm text-white">Zona A</td>
                                    <td class="text-center text-sm text-white">pohon tumbang</td>
                                    <td class="text-center text-sm text-white px-2">terdapat pohon tumbang pada...</td>
                                </tr>

                                {{-- Baris 2: Hitam --}}
                                <tr style="background-color: #1a1a1a; border: none;">
                                    <td class="text-center text-sm py-3 text-white ps-4">Node_A02</td>
                                    <td class="text-center text-sm text-white">-7.1208</td>
                                    <td class="text-center text-sm text-white">110.4223</td>
                                    <td class="text-center text-sm text-white">Zona B</td>
                                    <td class="text-center text-sm text-white">padi rusak</td>
                                    <td class="text-center text-sm text-white px-2">terdapat padi rusak pada.......</td>
                                </tr>

                                {{-- Baris 3: Hijau Tua --}}
                                <tr style="background-color: #14451a; border: none;">
                                    <td class="text-center text-sm py-3 text-white ps-4">Node_A03</td>
                                    <td class="text-center text-sm text-white">-7.1212</td>
                                    <td class="text-center text-sm text-white">110.4236</td>
                                    <td class="text-center text-sm text-white">Zona C</td>
                                    <td class="text-center text-sm text-white">buah berlubang</td>
                                    <td class="text-center text-sm text-white px-2">buah nampak berlubang.....</td>
                                </tr>

                                {{-- Baris 4: Hitam --}}
                                <tr style="background-color: #1a1a1a; border: none;">
                                    <td class="text-center text-sm py-3 text-white ps-4">2025-11-05</td>
                                    <td class="text-center text-sm text-white">-7.1217</td>
                                    <td class="text-center text-sm text-white">110.4228</td>
                                    <td class="text-center text-sm text-white">Zona D</td>
                                    <td class="text-center text-sm text-white">Jagung busuk</td>
                                    <td class="text-center text-sm text-white px-2">jagung nampak membusuk....</td>
                                </tr>

                                {{-- Baris 5: Hijau Tua --}}
                                <tr style="background-color: #14451a; border: none;">
                                    <td class="text-center text-sm py-3 text-white ps-4">2025-11-06</td>
                                    <td class="text-center text-sm text-white">-7.1222</td>
                                    <td class="text-center text-sm text-white">110.4259</td>
                                    <td class="text-center text-sm text-white">Zona E</td>
                                    <td class="text-center text-sm text-white">pohon tumbang</td>
                                    <td class="text-center text-sm text-white px-2">ada penghalang jalan pohon yang tumbang
                                        di.....</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4 pb-3 align-items-center gap-3">
                        <span class="text-xs text-white-50" style="cursor: pointer;">Previous</span>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item active">
                                    <a class="page-link border-1 border-success bg-transparent"
                                        style="border-radius: 8px; color: #4caf50;">1</a>
                                </li>
                                <li class="page-item ms-2"><a class="page-link bg-transparent border-0 text-white">2</a>
                                </li>
                                <li class="page-item ms-2"><a class="page-link bg-transparent border-0 text-white">3</a>
                                </li>
                            </ul>
                        </nav>
                        <span class="text-xs text-white-50" style="cursor: pointer;">Next</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
