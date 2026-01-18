# Blade Component Architecture Guide

Dokumentasi lengkap untuk menggunakan reusable Blade components di FORTE Frontend.

## Struktur Component

```
resources/views/components/
├── navigation/
│   └── navbar.blade.php          # Navbar component
├── forms/
│   ├── input.blade.php           # Input field component
│   ├── select.blade.php          # Select field component
│   └── textarea.blade.php        # Textarea component
├── modals/
│   └── base.blade.php            # Base modal component
├── cards/
│   ├── profile.blade.php         # Profile card component
│   ├── default.blade.php         # Default card component
│   └── detail-row.blade.php      # Detail row component
└── common/
    ├── button.blade.php          # Button component
    ├── badge.blade.php           # Badge component
    ├── alert.blade.php           # Alert component
    ├── avatar.blade.php          # Avatar circle component
    ├── table.blade.php           # Table component
    └── user-row.blade.php        # User table row component
```

## Cara Menggunakan Component

### 1. Navigation - Navbar Component

**File**: `resources/views/components/navigation/navbar.blade.php`

**Penggunaan**:
```blade
<x-navigation.navbar 
    :items="[
        ['route' => 'dashboard', 'label' => 'Dashboard'],
        ['route' => 'settings.index', 'label' => 'Setting'],
        ['route' => 'about', 'label' => 'About Rover']
    ]"
/>
```

**Props**:
- `items` (array): Array of navigation items dengan keys 'route' dan 'label'
- `userInitial` (string): Inisial user untuk avatar
- `userName` (string): Nama user untuk display

**Features**:
- Automatic active state detection via `request()->routeIs()`
- Auth-aware profile display
- Responsive navbar dengan toggle button
- Mobile-friendly collapse behavior

---

### 2. Form Components

#### 2.1 Input Component
```blade
<x-forms.input 
    name="username" 
    label="Username" 
    type="text"
    placeholder="Enter username"
    required
/>
```

**Props**:
- `name` (string): Field name and id
- `label` (string): Label text
- `type` (string): Input type (default: text)
- `value` (string): Default value
- `placeholder` (string): Placeholder text
- `required` (boolean): Is field required

**Features**:
- Automatic error display
- Old value preservation
- Dark theme styling (.form-control-dark)
- Bootstrap validation classes

#### 2.2 Select Component
```blade
<x-forms.select 
    name="role" 
    label="Role"
    :options="['admin' => 'Administrator', 'user' => 'User']"
    required
>
    Choose role...
</x-forms.select>
```

**Props**:
- `name` (string): Field name
- `label` (string): Label text
- `options` (array): Key-value pairs for options
- `value` (string): Selected value
- `required` (boolean): Is field required

#### 2.3 Textarea Component
```blade
<x-forms.textarea 
    name="description" 
    label="Description"
    placeholder="Enter description"
    rows="5"
/>
```

**Props**:
- `name` (string): Field name
- `label` (string): Label text
- `value` (string): Default value
- `placeholder` (string): Placeholder text
- `rows` (integer): Number of rows (default: 4)

---

### 3. Modal Components

**File**: `resources/views/components/modals/base.blade.php`

**Penggunaan**:
```blade
<x-modals.base 
    id="modalCreate" 
    title="Create New User"
    action="{{ route('admin.users.store') }}"
    method="POST"
    submitText="Create"
>
    <x-forms.input name="username" label="Username" required />
    <x-forms.input name="email" label="Email" type="email" required />
    <x-forms.select 
        name="role" 
        label="Role"
        :options="['admin' => 'Admin', 'user' => 'User']"
        required
    />
</x-modals.base>
```

**Props**:
- `id` (string): Modal ID for targeting
- `title` (string): Modal title
- `action` (string): Form action URL
- `method` (string): HTTP method (POST, PUT, DELETE, etc)
- `submitText` (string): Submit button text

**Features**:
- Built-in CSRF protection
- Method spoofing for PUT/DELETE
- Centered modal layout
- Dark theme styling

---

### 4. Card Components

#### 4.1 Profile Card
```blade
<x-cards.profile 
    title="John Doe" 
    badge="Administrator"
>
    <x-cards.detail-row label="Email" value="john@example.com" />
    <x-cards.detail-row label="Phone" value="+62 812 3456 7890" />
    <x-cards.detail-row label="Status" value="Active" />
</x-cards.profile>
```

**Props**:
- `title` (string): Profile name
- `avatar` (string): HTML for avatar
- `badge` (string): Badge text

#### 4.2 Default Card
```blade
<x-cards.default title="System Status" icon="bi-gear">
    <p>All systems operational</p>
</x-cards.default>
```

**Props**:
- `title` (string): Card title
- `icon` (string): Bootstrap icon class
- `class` (string): Additional CSS classes

#### 4.3 Detail Row
```blade
<x-cards.detail-row label="Email" value="user@example.com" />
```

**Props**:
- `label` (string): Field label
- `value` (string): Field value

---

### 5. Common Components

#### 5.1 Button Component
```blade
<x-common.button 
    text="Edit Profile" 
    variant="primary" 
    size="md"
    icon="bi-pencil"
    href="{{ route('profile.edit') }}"
/>
```

**Props**:
- `text` (string): Button text
- `type` (string): HTML button type (button, submit, reset)
- `variant` (string): Bootstrap variant (primary, success, danger, warning, info, secondary)
- `size` (string): Size (sm, md, lg)
- `icon` (string): Bootstrap icon class
- `href` (string): If provided, renders as link instead of button
- `class` (string): Additional CSS classes

#### 5.2 Badge Component
```blade
<x-common.badge type="admin" text="Administrator" />
<x-common.badge type="operator" text="Operator" />
<x-common.badge type="success" text="Active" />
```

**Types**:
- `admin` → Red badge
- `operator` → Info blue badge
- `user` → Gray badge
- `success` → Green badge
- `warning` → Yellow badge
- `danger` → Red badge

#### 5.3 Avatar Component
```blade
<x-common.avatar initials="JD" size="md" />
<x-common.avatar initials="JD" size="sm" />
<x-common.avatar initials="JD" size="lg" />
<x-common.avatar initials="JD" size="nav" />
```

**Sizes**:
- `sm` → Small avatar
- `md` → Medium avatar (default)
- `lg` → Large avatar
- `nav` → Navigation bar size

#### 5.4 Alert Component
```blade
<x-common.alert type="success" icon="bi-check-circle">
    Profile updated successfully!
</x-common.alert>

<x-common.alert type="danger" icon="bi-exclamation-circle" :dismissible="true">
    An error occurred. Please try again.
</x-common.alert>
```

**Types**:
- `success` → Green alert
- `danger` → Red alert
- `warning` → Yellow alert
- `info` → Blue alert (default)

#### 5.5 Table Component
```blade
<x-common.table :headers="['Username', 'Email', 'Role', 'Status', 'Actions']">
    @foreach($users as $user)
        <x-common.user-row :user="$user" />
    @endforeach
</x-common.table>
```

#### 5.6 User Row Component
```blade
<x-common.user-row 
    :user="$user" 
    editRoute="{{ route('admin.users.edit', $user) }}"
    deleteRoute="{{ route('admin.users.destroy', $user) }}"
/>
```

---

## Complete Example: User Management Page

```blade
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    {{-- Header with Navbar --}}
    <x-navigation.navbar 
        :items="[
            ['route' => 'dashboard', 'label' => 'Dashboard'],
            ['route' => 'admin.users.index', 'label' => 'Users'],
        ]"
    />

    {{-- Page Title --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h1>User Management</h1>
        <x-common.button 
            text="Create User"
            variant="success"
            icon="bi-plus-lg"
            @click="$('#modalCreate').modal('show')"
        />
    </div>

    {{-- Alerts --}}
    @if($errors->any())
        <x-common.alert type="danger" icon="bi-exclamation-circle">
            Please fix the errors below
        </x-common.alert>
    @endif

    @if(session('success'))
        <x-common.alert type="success" icon="bi-check-circle" dismissible>
            {{ session('success') }}
        </x-common.alert>
    @endif

    {{-- Users Table --}}
    <x-common.table :headers="['User', 'Role', 'Phone', 'Status', 'Actions']">
        @forelse($users as $user)
            <x-common.user-row :user="$user" />
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No users found</td>
            </tr>
        @endforelse
    </x-common.table>
</div>

{{-- Create User Modal --}}
<x-modals.base 
    id="modalCreate"
    title="Create New User"
    action="{{ route('admin.users.store') }}"
    submitText="Create User"
>
    <x-forms.input name="username" label="Username" required />
    <x-forms.input name="email" label="Email" type="email" required />
    <x-forms.input name="phone" label="Phone Number" />
    <x-forms.select 
        name="role"
        label="Role"
        :options="['admin' => 'Administrator', 'operator' => 'Operator', 'user' => 'User']"
        required
    />
</x-modals.base>

@endsection
```

---

## Best Practices

1. **Konsistensi Naming**: Gunakan `x-component-type.component-name` untuk memanggil components
2. **Props Passing**: Gunakan `:variableName` untuk dynamic props
3. **Slot Content**: Gunakan `{{ $slot }}` untuk nested content
4. **Reusability**: Jangan hardcode values dalam component, gunakan props
5. **Accessibility**: Pastikan semua form fields memiliki label
6. **Dark Theme**: Semua components sudah menggunakan dark theme styling
7. **Validation**: Components otomatis menampilkan error dari Blade validation

---

## Testing Components

Untuk test komponen Blade, gunakan:
```php
$component = Blade::component('components.common.button', [
    'text' => 'Test Button',
    'variant' => 'primary'
]);
```

---

## Migration Guide

### Dari Manual HTML ke Components

**Before**:
```blade
<div class="card-profile">
    <div class="avatar-circle-nav">
        {{ substr(Auth::user()->username, 0, 2) }}
    </div>
    <div class="user-name">{{ Auth::user()->username }}</div>
</div>
```

**After**:
```blade
<x-cards.profile title="{{ Auth::user()->username }}">
    <x-common.avatar :initials="substr(Auth::user()->username, 0, 2)" size="nav" />
</x-cards.profile>
```

---

## Component Status

- ✅ Navigation Components (navbar)
- ✅ Form Components (input, select, textarea)
- ✅ Modal Components (base modal)
- ✅ Card Components (profile, default, detail-row)
- ✅ Common Components (button, badge, alert, avatar, table, user-row)

Total: **14 Reusable Components**
