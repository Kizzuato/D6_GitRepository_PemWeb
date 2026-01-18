# Migration Guide: Converting to Component-Based Blade

## Contoh Refactoring: Dari Manual HTML ke Components

### File yang Akan Direfactor
- `lp-setting-profile.blade.php`
- `lp-setting-controller.blade.php`
- `admin/users.blade.php`
- `operator/users.blade.php`
- Dan file blade lainnya

---

## Step-by-Step: Refactoring lp-setting-profile.blade.php

### Bagian 1: Navbar (Baris 280-315)

#### BEFORE (Manual HTML):
```blade
<nav class="navbar navbar-expand-lg navbar-forte navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/img/FORTE.png') }}" alt="FORTE Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="setting">Setting</a></li>
                <li class="nav-item"><a class="nav-link" href="about">About Rover</a></li>
            </ul>
        </div>

        <div class="d-none d-lg-flex align-items-center ms-3">
            <div class="profile-pill">
                <div class="avatar-circle-nav">
                    {{ Auth::check() ? substr(Auth::user()->name, 0, 2) : 'AH' }}
                </div>
                <div class="ms-2 me-3">
                    <div class="user-name" style="font-size:0.9rem;">
                        {{ Auth::check() ? Auth::user()->name : 'Akhsan Hakiki' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
```

#### AFTER (Using Component):
```blade
<x-navigation.navbar 
    :items="[
        ['route' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'settings.index', 'label' => 'Setting'],
        ['route' => 'about', 'label' => 'About Rover']
    ]"
/>
```

**Keuntungan**:
- ✅ Lebih rapi dan mudah dibaca
- ✅ Konsistensi di semua halaman
- ✅ Active state otomatis
- ✅ Mudah di-maintain
- ✅ Kurangi duplikasi code

---

### Bagian 2: Profile Card Section (Baris 315-365)

#### BEFORE (Manual HTML):
```blade
<div class="card-profile text-center">
    <div class="profile-avatar-lg">
        {{ Auth::check() ? substr(Auth::user()->name, 0, 2) : 'AH' }}
    </div>

    <h4 class="mb-1">{{ Auth::check() ? Auth::user()->name : 'Akhsan Hakiki' }}</h4>
    <span class="user-role-badge">Super Admin</span>

    <div class="text-start mt-3">
        <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value">{{ Auth::check() ? Auth::user()->email : 'akhsan@forte.com' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Phone</span>
            <span class="detail-value">{{ Auth::check() ? Auth::user()->phone ?? '+62 812 3456 7890' : '+62 812 3456 7890' }}</span>
        </div>
        ...
    </div>
</div>
```

#### AFTER (Using Component):
```blade
<x-cards.profile 
    :title="Auth::user()->name"
    :badge="ucfirst(Auth::user()->role)"
>
    <x-cards.detail-row label="Email" :value="Auth::user()->email" />
    <x-cards.detail-row label="Phone" :value="Auth::user()->phone ?? '+62 812 3456 7890'" />
    <x-cards.detail-row label="Location" :value="Auth::user()->location ?? 'Bandung, ID'" />
    <x-cards.detail-row label="Member Since" value="Jan 2024" />
</x-cards.profile>
```

---

### Bagian 3: Edit Profile Form (Dari Modal)

#### BEFORE (Manual Modal):
```blade
<div class="modal fade" id="modalEditProfile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label text-secondary small">Name</label>
                        <input type="text" name="name" id="name" 
                               class="form-control form-control-dark"
                               value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-secondary small">Email</label>
                        <input type="email" name="email" id="email" 
                               class="form-control form-control-dark"
                               value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label text-secondary small">Phone</label>
                        <input type="tel" name="phone" id="phone" 
                               class="form-control form-control-dark"
                               value="{{ old('phone', Auth::user()->phone) }}">
                        @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
```

#### AFTER (Using Component):
```blade
<x-modals.base 
    id="modalEditProfile"
    title="Edit Profile"
    action="{{ route('profile.update') }}"
    method="PUT"
    submitText="Update"
>
    <x-forms.input name="name" label="Name" :value="Auth::user()->name" required />
    <x-forms.input name="email" label="Email" type="email" :value="Auth::user()->email" required />
    <x-forms.input name="phone" label="Phone" type="tel" :value="Auth::user()->phone" />
</x-modals.base>
```

**Code Reduction**: 45 baris → 8 baris! (-82%)

---

## Checklist Refactoring

### Phase 1: Navigation & Layout (Prioritas Tinggi)
- [ ] Update `lp-setting-profile.blade.php` → Ganti navbar dengan component
- [ ] Update `lp-setting-controller.blade.php` → Ganti navbar dengan component
- [ ] Update `layouts/app.blade.php` → Ganti navbar jika ada
- [ ] Update `layouts/sidebar.blade.php` → Refactor sidebar ke component

### Phase 2: Forms (Prioritas Tinggi)
- [ ] Update `admin/partials/modal-create.blade.php` → Gunakan form components
- [ ] Update `admin/partials/modal-edit.blade.php` → Gunakan form components
- [ ] Update `operator/partials/modal-create.blade.php` → Gunakan form components
- [ ] Update `operator/partials/modal-edit.blade.php` → Gunakan form components
- [ ] Update `admin/users.blade.php` → Gunakan component untuk modal
- [ ] Update `operator/users.blade.php` → Gunakan component untuk modal

### Phase 3: Display Components (Prioritas Menengah)
- [ ] Update `admin/users.blade.php` → Gunakan `<x-common.user-row>` untuk table
- [ ] Update `operator/users.blade.php` → Gunakan `<x-common.user-row>` untuk table
- [ ] Update profile cards → Gunakan `<x-cards.profile>` di seluruh file

### Phase 4: Common Elements (Prioritas Standar)
- [ ] Update buttons → Gunakan `<x-common.button>` component
- [ ] Update badges → Gunakan `<x-common.badge>` component
- [ ] Update alerts → Gunakan `<x-common.alert>` component
- [ ] Update avatars → Gunakan `<x-common.avatar>` component

---

## Refactoring Command Reference

### Untuk Form Input:
```blade
<!-- BEFORE -->
<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control form-control-dark" required>
</div>

<!-- AFTER -->
<x-forms.input name="name" label="Name" required />
```

### Untuk Select Field:
```blade
<!-- BEFORE -->
<div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select name="role" class="form-select bg-dark">
        <option value="">Choose...</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
</div>

<!-- AFTER -->
<x-forms.select 
    name="role" 
    label="Role"
    :options="['admin' => 'Admin', 'user' => 'User']"
/>
```

### Untuk Buttons:
```blade
<!-- BEFORE -->
<a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-pencil"></i> Edit
</a>

<!-- AFTER -->
<x-common.button 
    text="Edit"
    variant="primary"
    size="sm"
    icon="bi-pencil"
    href="{{ route('profile.edit') }}"
/>
```

### Untuk Badge:
```blade
<!-- BEFORE -->
<span class="badge bg-danger">{{ $user->role }}</span>

<!-- AFTER -->
<x-common.badge :type="$user->role" :text="ucfirst($user->role)" />
```

---

## Alat Bantu Refactoring

### Find & Replace Patterns

1. **Navbar Manual** → `<x-navigation.navbar />`
   - Find: `<nav class="navbar navbar-expand-lg navbar-forte`
   - Replace with navbar component

2. **Form Input** → `<x-forms.input />`
   - Find: `<div class="mb-3">.*?<input.*?class="form-control form-control-dark"`
   - Pattern: `<x-forms.input name="..." />`

3. **Buttons** → `<x-common.button />`
   - Find: `<button.*?class="btn btn-`
   - Replace with button component

---

## Testing Components

Setelah refactoring, pastikan:

1. ✅ Navbar muncul dengan benar
2. ✅ Active state pada nav items bekerja
3. ✅ Form validation berfungsi
4. ✅ Modal membuka dan menutup
5. ✅ Styling konsisten (dark theme)
6. ✅ Responsive pada mobile
7. ✅ Error messages tampil dengan benar

---

## Tips & Tricks

### 1. Preserve Slot Content
```blade
<!-- Gunakan slot untuk konten dinamis -->
<x-modals.base id="modalConfirm">
    Apakah Anda yakin ingin menghapus item ini?
</x-modals.base>
```

### 2. Dynamic Attributes
```blade
<!-- Gunakan array spread untuk dynamic attributes -->
<x-forms.input 
    name="email" 
    type="email"
    @if($required) required @endif
/>
```

### 3. Conditional Classes
```blade
<!-- Gunakan conditional class binding -->
<x-common.button 
    text="Submit"
    :class="$isLoading ? 'disabled' : ''"
/>
```

### 4. Component Composition
```blade
<!-- Compose components untuk struktur kompleks -->
<x-cards.profile :title="$user->name">
    <x-forms.input name="email" :value="$user->email" />
    <x-common.button text="Save" type="submit" />
</x-cards.profile>
```

---

## Performance Impact

- **Compiled Cache**: Laravel akan cache component output
- **Bundle Size**: Tidak ada impact negatif, lebih modular
- **Load Time**: Sama atau lebih cepat (less code duplication)
- **Maintenance**: Lebih mudah dan cepat untuk update styling global

---

## Next Steps

1. Start dengan Phase 1 (Navigation components)
2. Test di browser setiap completion
3. Update routing jika ada perubahan route names
4. Lanjut ke Phase 2 (Form components)
5. Dokumentasi update jika ada perubahan component props
