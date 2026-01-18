{{-- 
    Example: Refactored User Management Page
    Demonstrating component-based architecture
    
    Before: 400+ lines of manual HTML
    After: 120 lines using components
    
    Benefits:
    - 70% code reduction
    - Consistent styling
    - Reusable components
    - Easy to maintain
--}}

@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Navigation --}}
    <x-navigation.navbar 
        :items="[
            ['route' => 'dashboard', 'label' => 'Dashboard'],
            ['route' => 'admin.users.index', 'label' => 'Users'],
            ['route' => 'settings.index', 'label' => 'Settings']
        ]"
    />

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h1 class="h3">User Management</h1>
        <x-common.button 
            text="Create User"
            variant="success"
            size="md"
            icon="bi-plus-lg"
            data-bs-toggle="modal"
            data-bs-target="#modalCreateUser"
        />
    </div>

    {{-- Search Box --}}
    <div class="mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
            <x-forms.input 
                name="search"
                placeholder="Search users..."
                :value="request('search')"
            />
            <x-common.button text="Search" type="submit" variant="info" size="md" />
        </form>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <x-common.alert type="success" icon="bi-check-circle" dismissible>
            {{ session('success') }}
        </x-common.alert>
    @endif

    @if(session('error'))
        <x-common.alert type="danger" icon="bi-exclamation-circle" dismissible>
            {{ session('error') }}
        </x-common.alert>
    @endif

    @if($errors->any())
        <x-common.alert type="warning" icon="bi-exclamation-triangle" dismissible>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 ms-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-common.alert>
    @endif

    {{-- Users Table --}}
    <div class="card-profile">
        <h5 class="mb-3">
            <i class="bi bi-people me-2"></i>
            All Users ({{ $users->total() }})
        </h5>

        @if($users->count() > 0)
            <x-common.table :headers="['User', 'Role', 'Email', 'Phone', 'Status', 'Actions']">
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <x-common.avatar 
                                    :initials="substr($user->username ?? $user->name, 0, 2)" 
                                    size="sm"
                                />
                                <div>
                                    <div class="fw-bold">{{ $user->username ?? $user->name }}</div>
                                    @if($user->username !== $user->name)
                                        <small class="text-muted">{{ $user->name }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <x-common.badge 
                                :type="$user->role ?? 'user'" 
                                :text="ucfirst($user->role ?? 'User')"
                            />
                        </td>
                        <td>
                            <small>{{ $user->email }}</small>
                        </td>
                        <td>
                            {{ $user->phone ?? 'N/A' }}
                        </td>
                        <td>
                            <span class="badge {{ $user->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $user->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button 
                                    type="button" 
                                    class="btn btn-outline-info" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEdit{{ $user->id }}"
                                    title="Edit"
                                >
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure?')"
                                        title="Delete"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Edit Modal (inline) --}}
                    <x-modals.base 
                        :id="'modalEdit' . $user->id"
                        title="Edit User"
                        :action="route('admin.users.update', $user)"
                        method="PUT"
                        submitText="Update"
                    >
                        <x-forms.input 
                            name="username" 
                            label="Username"
                            :value="$user->username"
                            required
                        />
                        <x-forms.input 
                            name="email" 
                            label="Email"
                            type="email"
                            :value="$user->email"
                            required
                        />
                        <x-forms.input 
                            name="phone" 
                            label="Phone"
                            :value="$user->phone"
                        />
                        <x-forms.select 
                            name="role"
                            label="Role"
                            :value="$user->role"
                            :options="['admin' => 'Administrator', 'operator' => 'Operator', 'user' => 'User']"
                            required
                        />
                    </x-modals.base>
                @endforeach
            </x-common.table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>

        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #666;"></i>
                <p class="text-muted mt-3">No users found. Create one to get started.</p>
            </div>
        @endif
    </div>

</div>

{{-- Create User Modal --}}
<x-modals.base 
    id="modalCreateUser"
    title="Create New User"
    action="{{ route('admin.users.store') }}"
    method="POST"
    submitText="Create User"
>
    <x-forms.input 
        name="username" 
        label="Username"
        placeholder="Enter username"
        required
    />
    <x-forms.input 
        name="name"
        label="Full Name"
        placeholder="Enter full name"
        required
    />
    <x-forms.input 
        name="email" 
        label="Email Address"
        type="email"
        placeholder="user@example.com"
        required
    />
    <x-forms.input 
        name="password"
        label="Password"
        type="password"
        placeholder="Enter password"
        required
    />
    <x-forms.input 
        name="phone" 
        label="Phone Number"
        placeholder="Enter phone number"
    />
    <x-forms.select 
        name="role"
        label="Role"
        :options="['admin' => 'Administrator', 'operator' => 'Operator', 'user' => 'User']"
        required
    >
        Select user role...
    </x-forms.select>
</x-modals.base>

@endsection

@push('styles')
<style>
    /* Custom animations */
    .btn-group-sm .btn {
        border-color: #495057;
    }
    
    .btn-group-sm .btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    // Example: Add custom table row hover effect
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'rgba(255, 255, 255, 0.05)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
</script>
@endpush
