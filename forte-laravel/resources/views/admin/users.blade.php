@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark text-white shadow-lg border-0">
                <div class="card-header pb-0 bg-dark border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            {{-- Icon User --}}
                            <i class="bi bi-person-fill me-2 text-white" style="font-size: 1.2rem;"></i>
                            <h5 class="mb-0 text-white" style="font-weight: 500;">Manage Users</h5>
                        </div>

                        <div class="d-flex gap-2 align-items-center">
                            {{-- Tombol Tambah User --}}
                            <button class="btn btn-success btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#modalCreateUser">
                                <i class="bi bi-plus me-2 text-white"></i>Tambah User
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2 mt-4">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" style="border-collapse: collapse;">
                            <thead>
                                <tr class="border-0">
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white ps-4">Nama</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Email</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Role</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Joined At
                                    </th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-white text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="border-0">
                                @foreach ($users as $user)
                                    <tr
                                        style="background-color: {{ $loop->iteration % 2 == 0 ? '#1a1a1a' : '#14451a' }}; border: none;">
                                        <td class="text-sm py-3 text-white ps-4">{{ $user->username }}</td>
                                        <td class="text-center text-sm text-white">{{ $user->email }}</td>
                                        <td class="text-center text-sm text-white">
                                            <span class="badge bg-secondary text-xxs">
                                                {{ strtoupper($user->getRoleNames()->first() ?? 'user') }}
                                            </span>
                                        </td>
                                        <td class="text-center text-sm text-white">{{ $user->created_at->format('d M Y') }}
                                        </td>
                                        <td class="text-center">
                                            {{-- Button Edit --}}
                                            <button class="btn btn-link text-info text-gradient px-3 mb-0"
                                                data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $user->id }}">
                                                <i class="bi bi-pencil-fill text-white"></i>
                                            </button>

                                            {{-- Button Delete --}}
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                    <i class="bi bi-trash-fill text-white"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Include Modal Edit per User --}}
                                    @include('admin.partials.modal-edit')
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4 pb-3">
                        {{ $users->links() }} {{-- Laravel Pagination --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Modal Create --}}
    @include('admin.partials.modal-create')

@endsection
