@extends('layouts.app')

@section('content')

{{-- Log Table --}}
<div class="row mt-4">
  <div class="col-12">
    <div class="card bg-dark text-white">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="mb-0 text-white">Tabel Ringkasan Data</h6>

          <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary"
              placeholder="Search...">

            <select class="form-select form-select-sm bg-dark text-white border-secondary">
              <option>28 Dec 22 - 10 Jan 23</option>
              <option>Last 7 Days</option>
              <option>Last 30 Days</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 text-white">
            <thead class="bg-gradient-success">
              <tr>
                <th class="text-uppercase text-xs font-weight-bolder">ID Sensor</th>
                <th class="text-uppercase text-xs font-weight-bolder">Lintang</th>
                <th class="text-uppercase text-xs font-weight-bolder">Bujur</th>
                <th class="text-uppercase text-xs font-weight-bolder">Zona</th>
                <th class="text-uppercase text-xs font-weight-bolder">Suhu (°C)</th>
                <th class="text-uppercase text-xs font-weight-bolder">Kelembaban (%)</th>
              </tr>
            </thead>

            <tbody>
              <tr class="bg-success bg-opacity-50">
                <td>Node_A01</td>
                <td>-7.1203</td>
                <td>110.4210</td>
                <td>Zona A</td>
                <td>29.1</td>
                <td>68</td>
              </tr>

              <tr class="bg-success bg-opacity-25">
                <td>Node_A02</td>
                <td>-7.1208</td>
                <td>110.4223</td>
                <td>Zona B</td>
                <td>31.3</td>
                <td>60</td>
              </tr>

              <tr class="bg-success bg-opacity-50">
                <td>Node_A03</td>
                <td>-7.1212</td>
                <td>110.4236</td>
                <td>Zona C</td>
                <td>27.8</td>
                <td>72</td>
              </tr>

              <tr class="bg-success bg-opacity-25">
                <td>Node_A04</td>
                <td>-7.1217</td>
                <td>110.4228</td>
                <td>Zona D</td>
                <td>26.9</td>
                <td>74</td>
              </tr>

              <tr class="bg-success bg-opacity-50">
                <td>Node_A05</td>
                <td>-7.1222</td>
                <td>110.4259</td>
                <td>Zona E</td>
                <td>30.4</td>
                <td>63</td>
              </tr>
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
          <nav>
            <ul class="pagination pagination-sm">
              <li class="page-item disabled">
                <a class="page-link bg-dark text-white border-secondary">Previous</a>
              </li>
              <li class="page-item active">
                <a class="page-link bg-success border-success">1</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-dark text-white border-secondary">2</a>
              </li>
              <li class="page-item">
                <a class="page-link bg-dark text-white border-secondary">Next</a>
              </li>
            </ul>
          </nav>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection