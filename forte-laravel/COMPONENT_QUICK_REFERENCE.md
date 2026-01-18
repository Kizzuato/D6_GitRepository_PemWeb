# Component Quick Reference Guide

Panduan cepat untuk menggunakan Blade components tanpa perlu membuka dokumentasi lengkap.

---

## 🎯 Cheat Sheet

### Navigation
```blade
<x-navigation.navbar 
    :items="[
        ['route' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'settings.index', 'label' => 'Setting']
    ]"
/>
```

### Forms
```blade
<x-forms.input name="username" label="Username" required />
<x-forms.select name="role" label="Role" :options="['admin' => 'Admin']" />
<x-forms.textarea name="bio" label="Biography" rows="5" />
```

### Buttons
```blade
<x-common.button text="Save" variant="success" />
<x-common.button text="Edit" icon="bi-pencil" href="{{ route('edit') }}" />
<x-common.button text="Delete" variant="danger" />
```

### Cards
```blade
<x-cards.profile title="John Doe" badge="Admin">
    <x-cards.detail-row label="Email" value="john@example.com" />
</x-cards.profile>
```

### Modals
```blade
<x-modals.base id="modalCreate" title="Add User" action="{{ route('store') }}">
    <x-forms.input name="name" label="Name" />
</x-modals.base>
```

### Badges & Alerts
```blade
<x-common.badge type="admin" text="Administrator" />
<x-common.alert type="success">Profile updated!</x-common.alert>
```

### Avatars & Tables
```blade
<x-common.avatar initials="JD" size="lg" />
<x-common.table :headers="['Name', 'Email', 'Actions']">
    @foreach($users as $user)
        <x-common.user-row :user="$user" />
    @endforeach
</x-common.table>
```

---

## 📋 Component List

| Component | Location | Usage |
|-----------|----------|-------|
| **navbar** | `<x-navigation.navbar />` | Top navigation bar |
| **input** | `<x-forms.input />` | Text input fields |
| **select** | `<x-forms.select />` | Dropdown selection |
| **textarea** | `<x-forms.textarea />` | Multi-line input |
| **button** | `<x-common.button />` | Interactive buttons |
| **badge** | `<x-common.badge />` | Status/role badges |
| **avatar** | `<x-common.avatar />` | User initials circle |
| **alert** | `<x-common.alert />` | Notification messages |
| **table** | `<x-common.table />` | Data tables |
| **user-row** | `<x-common.user-row />` | Table user row |
| **profile** | `<x-cards.profile />` | User profile card |
| **card** | `<x-cards.default />` | Generic card |
| **detail-row** | `<x-cards.detail-row />` | Key-value display |
| **modal** | `<x-modals.base />` | Modal dialog |

---

## 🎨 Common Props

### Form Components
- `name` (required) - Field name
- `label` - Field label text
- `value` - Default value
- `required` - Is required
- `placeholder` - Placeholder text

### Button Component
- `text` (required) - Button text
- `variant` - primary, success, danger, warning, info
- `size` - sm, md, lg
- `icon` - Bootstrap icon class
- `href` - Link href (renders as `<a>`)
- `type` - button, submit, reset

### Badge Component
- `type` - admin, operator, user, success, warning, danger
- `text` (required) - Badge text

### Alert Component
- `type` - success, danger, warning, info
- `icon` - Bootstrap icon class
- `dismissible` - Can close alert

### Modal Component
- `id` (required) - Modal ID
- `title` (required) - Modal title
- `action` - Form action URL
- `method` - POST, PUT, DELETE, etc
- `submitText` - Submit button text

---

## 📝 Common Patterns

### Create Form in Modal
```blade
<x-modals.base 
    id="modalCreate" 
    title="Create New User"
    action="{{ route('admin.users.store') }}"
    submitText="Create"
>
    <x-forms.input name="username" label="Username" required />
    <x-forms.input name="email" label="Email" type="email" required />
    <x-forms.select name="role" label="Role" :options="['admin' => 'Admin']" />
</x-modals.base>

<!-- Open modal with button -->
<x-common.button 
    text="Create User"
    @click="$('#modalCreate').modal('show')"
/>
```

### User Profile Card
```blade
<x-cards.profile title="{{ $user->name }}" badge="{{ $user->role }}">
    <x-cards.detail-row label="Email" value="{{ $user->email }}" />
    <x-cards.detail-row label="Phone" value="{{ $user->phone }}" />
    <x-cards.detail-row label="Status" value="Active" />
</x-cards.profile>
```

### User Table with Actions
```blade
<x-common.table :headers="['User', 'Role', 'Email', 'Actions']">
    @foreach($users as $user)
        <tr>
            <td><x-common.avatar :initials="substr($user->name, 0, 2)" /> {{ $user->name }}</td>
            <td><x-common.badge :type="$user->role" :text="$user->role" /></td>
            <td>{{ $user->email }}</td>
            <td>
                <x-common.button 
                    text="Edit" 
                    size="sm" 
                    icon="bi-pencil"
                    href="{{ route('admin.users.edit', $user) }}"
                />
            </td>
        </tr>
    @endforeach
</x-common.table>
```

### Form with Validation
```blade
<form action="{{ route('profile.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <x-forms.input 
        name="username" 
        label="Username" 
        :value="$user->username"
        required 
    />
    <!-- Errors automatically shown from $errors bag -->
    
    <x-common.button text="Update" variant="success" type="submit" />
</form>
```

---

## 🔍 Troubleshooting

### Component not found?
```blade
<!-- Make sure component path is correct -->
<x-forms.input />          <!-- ✅ Correct -->
<x-form.input />           <!-- ❌ Wrong (no plural) -->
<x-forms-input />          <!-- ❌ Wrong (use dot) -->
```

### Styling not applied?
- All components use Bootstrap 5 classes
- Dark theme styling is built-in
- Custom classes via `:class` prop

### Form validation not showing?
```blade
<!-- Must pass field name exactly as form name -->
<x-forms.input name="username" />
<!-- Error will show if $errors->has('username') -->
```

### Modal not opening?
```blade
<!-- Need data-bs-toggle for button -->
<button class="btn" data-bs-toggle="modal" data-bs-target="#modalId">
    Open
</button>

<!-- OR use JavaScript -->
<x-common.button text="Open" @click="$('#modalId').modal('show')" />
```

---

## 🚀 Tips & Tricks

### 1. Pass entire object to select options
```blade
@php
    $options = $roles->pluck('name', 'id')->all();
@endphp

<x-forms.select name="role" :options="$options" />
```

### 2. Dynamic button variants
```blade
<x-common.button 
    text="Save"
    :variant="$isNew ? 'success' : 'primary'"
/>
```

### 3. Conditional required field
```blade
<x-forms.input 
    name="phone"
    label="Phone"
    :required="$user->role === 'admin'"
/>
```

### 4. Reuse modal for create and edit
```blade
{{-- Single modal, different actions based on route --}}
<x-modals.base 
    id="modalUser"
    title="{{ $user->id ? 'Edit User' : 'Create User' }}"
    action="{{ $user->id ? route('users.update', $user) : route('users.store') }}"
    method="{{ $user->id ? 'PUT' : 'POST' }}"
>
    <x-forms.input name="name" :value="$user->name" />
</x-modals.base>
```

### 5. Badge with conditional color
```blade
<x-common.badge 
    :type="$user->isActive ? 'success' : 'danger'"
    :text="$user->isActive ? 'Active' : 'Inactive'"
/>
```

---

## 📚 Learn More

- Full Guide: [BLADE_COMPONENTS_GUIDE.md](./BLADE_COMPONENTS_GUIDE.md)
- Migration: [COMPONENT_MIGRATION_GUIDE.md](./COMPONENT_MIGRATION_GUIDE.md)
- Full Docs: [REFACTORING_INDEX.md](./REFACTORING_INDEX.md)

---

## ✨ Component Features

All components include:
- ✅ Dark theme styling
- ✅ Bootstrap 5 integration
- ✅ Form validation display
- ✅ Responsive design
- ✅ Icon support
- ✅ Custom attributes support
- ✅ Old value preservation
- ✅ Error handling

---

**Remember**: Components are reusable! Extract repeated HTML into components for consistency.
