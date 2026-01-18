# 📋 Dokumentasi Refactor Proyek Laravel - Forte Frontend

## 🎯 Ringkasan Perubahan
Proyek ini telah direfactor untuk mengikuti **standar OOP (Object-Oriented Programming)** dan **Clean Code principles** sesuai dengan Laravel best practices.

---

## ✅ Perubahan yang Dilakukan

### 1. **Pemisahan Business Logic (Service Layer)**
   
#### ✨ Sebelum:
- Logic database dan HTTP request dicampur di Controller
- Sulit untuk di-test dan di-reuse

#### 🔧 Sesudah:
- **Dibuat 3 Service baru:**
  - `app/Services/UserService.php` - Menangani operasi User
  - `app/Services/ReportService.php` - Menangani operasi Report
  - `app/Services/RaspiService.php` - Menangani komunikasi dengan hardware

**Manfaat:**
- ✅ Single Responsibility Principle (SRP)
- ✅ Mudah di-test dengan unit tests
- ✅ Mudah di-reuse di multiple controllers
- ✅ Logic terpusat dan teorganisir

---

### 2. **Controller Refactoring**

#### 🔄 Diubah:
- `app/Http/Controllers/UserController.php`
- `app/Http/Controllers/ReportController.php`
- `app/Http/Controllers/DashboardController.php`

#### ✨ Perubahan:
```php
// ❌ SEBELUM: Logic tercampur di controller
public function store(Request $request)
{
    $request->validate([...]);
    
    $user = User::create([...]);
    $user->assignRole($request->role);
    
    return back()->with('success', 'User berhasil ditambahkan');
}

// ✅ SESUDAH: Menggunakan Service + Dependency Injection
public function __construct(UserService $userService)
{
    $this->userService = $userService;
}

public function store(Request $request)
{
    $validated = $request->validate([...]);
    $this->userService->createUser($validated);
    
    return back()->with('success', 'User berhasil ditambahkan');
}
```

**Manfaat:**
- ✅ Controller lebih lean dan fokus pada HTTP handling
- ✅ Dependency Injection untuk loosely coupled code
- ✅ Mudah mock dalam testing

---

### 3. **Model Improvements**

#### 🔄 Diubah:
- `app/Models/User.php`
- `app/Models/Report.php`
- `app/Models/Sensor.php`
- `app/Models/SensorLog.php`
- `app/Models/Classification.php`

#### ✨ Perubahan:

```php
// ✅ Proper Type Hints & Relations
class User extends Authenticatable
{
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class);
    }

    // ✅ Helper methods
    public function isAdmin(): bool
    {
        return $this->hasRole(['admin', 'supervisor']);
    }
}

// ✅ Proper Casts
protected $casts = [
    'latitude' => 'float',
    'longitude' => 'float',
    'anomaly' => 'boolean',
    'created_at' => 'datetime',
];

// ✅ Status helper methods
public function isApproved(): bool
{
    return $this->status === 'approved';
}
```

**Manfaat:**
- ✅ Type hints untuk IDE autocomplete
- ✅ Relationships yang jelas
- ✅ Helper methods untuk status checking
- ✅ Proper casting untuk type safety

---

### 4. **Route Organization**

#### ❌ SEBELUM:
- Routes campur aduk tanpa struktur
- Middleware tidak konsisten
- Route names tidak terstruktur

#### ✅ SESUDAH:
```php
// PUBLIC ROUTES
Route::get('/', ...)->name('home');

// AUTHENTICATION
Route::middleware('guest')->group(function () {
    Route::get('/login', ...)->name('login');
    Route::post('/login', ...)->name('login.process');
});

// AUTHENTICATED USER ROUTES
Route::middleware('auth')->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/fetch-data', ...)->name('fetch.data');
    });

    Route::prefix('power')->group(function () {
        Route::get('/', ...)->name('power');
        Route::prefix('api')->group(function () {
            Route::get('/log-table', ...);
        });
    });
});

// ADMIN ONLY ROUTES
Route::middleware(['auth', 'role:admin|supervisor'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('sensors', SensorController::class);
});
```

**Manfaat:**
- ✅ Routes terstruktur dan mudah dibaca
- ✅ Middleware applied konsisten
- ✅ Route naming convention yang jelas
- ✅ Mudah untuk maintenance

---

### 5. **Repository Pattern Implementation**

#### 📂 File Baru:
- `app/Repositories/AbstractRepository.php` - Base class
- `app/Repositories/UserRepository.php` - User repository
- `app/Repositories/ReportRepository.php` - Report repository

#### ✨ Contoh:
```php
// ✅ Reusable database operations
class UserRepository extends AbstractRepository
{
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function search(string $searchTerm, int $perPage = 15)
    {
        return $this->model
            ->where('username', 'like', "%{$searchTerm}%")
            ->orWhere('email', 'like', "%{$searchTerm}%")
            ->paginate($perPage);
    }
}
```

**Manfaat:**
- ✅ Abstraksi layer database
- ✅ Mudah ganti database provider
- ✅ Reusable query logic
- ✅ Testing menjadi lebih mudah

---

### 6. **Authorization dengan Policies**

#### 📂 File Baru:
- `app/Policies/ReportPolicy.php`

#### ✨ Contoh:
```php
class ReportPolicy
{
    // ✅ Principle of least privilege
    public function create(User $user): Response
    {
        return $user->isAdmin()
            ? Response::deny('Admin tidak dapat membuat report')
            : Response::allow();
    }

    public function approve(User $user, Report $report): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('Hanya admin yang dapat approve');
    }
}

// ✅ Digunakan di controller
public function approve(Report $report)
{
    $this->authorize('approve', $report);
    $this->reportService->approveReport($report);
}
```

**Manfaat:**
- ✅ Centralized authorization logic
- ✅ Consistent permission checking
- ✅ Mudah audit dan maintain
- ✅ Reusable across application

---

### 7. **Form Requests Improvement**

#### 🔄 Diubah:
- `app/Http/Requests/StoreSensorRequest.php`

#### ✨ Perubahan:
```php
// ✅ Proper validation rules
public function rules(): array
{
    return [
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
        'daya' => 'nullable|numeric',
    ];
}

// ✅ Custom error messages
public function messages(): array
{
    return [
        'latitude.required' => 'Latitude wajib diisi',
        'latitude.numeric' => 'Latitude harus berupa angka',
    ];
}

// ✅ Authorization checking
public function authorize(): bool
{
    return $this->user()->isAdmin();
}
```

**Manfaat:**
- ✅ Validation terpusat dan reusable
- ✅ Custom messages untuk UX lebih baik
- ✅ Authorization check di request level

---

### 8. **Helper Classes**

#### 📂 File Baru:
- `app/Helpers/ResponseHelper.php` - JSON response yang konsisten
- `app/Helpers/FormatHelper.php` - Data formatting

#### ✨ Contoh:
```php
// ✅ Konsisten response format
ResponseHelper::success($data, 'Data retrieved', 200);
ResponseHelper::error('Not found', 404);
ResponseHelper::paginated($data);

// ✅ Formatting utility
FormatHelper::formatDate($date, 'd M Y');
FormatHelper::formatPower(5000);  // "5.00 kW"
FormatHelper::formatCoordinate(6.2088, 6);
```

**Manfaat:**
- ✅ Response format konsisten di seluruh API
- ✅ Reusable formatting functions
- ✅ Single source of truth untuk formatting logic

---

### 9. **Traits untuk Code Reusability**

#### 📂 File Baru:
- `app/Traits/LoggableTrait.php` - Logging functionality

#### ✨ Contoh:
```php
class UserService
{
    use LoggableTrait;

    public function createUser(array $data): User
    {
        $user = User::create($data);
        $this->logInfo('User created', ['user_id' => $user->id]);
        return $user;
    }
}
```

**Manfaat:**
- ✅ Reusable traits across classes
- ✅ Consistent logging
- ✅ DRY principle

---

### 10. **Service Provider untuk Dependency Injection**

#### 📂 File Baru:
- `app/Providers/RepositoryServiceProvider.php`

#### ✨ Contoh:
```php
class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->singleton(UserService::class);
    }
}
```

**Manfaat:**
- ✅ Centralized dependency registration
- ✅ Mudah di-mock dalam testing
- ✅ Singleton pattern untuk services

---

### 11. **Events untuk Audit Trail**

#### 📂 File Baru:
- `app/Events/UserActionEvent.php`

#### ✨ Contoh:
```php
class UserActionEvent
{
    public function __construct(
        public User $user,
        public string $action,
        public ?string $description = null,
        public array $data = []
    ) {}
}

// ✅ Usage
UserActionEvent::dispatch(
    $user,
    'report_approved',
    'Report approved by admin',
    ['report_id' => $report->id]
);
```

**Manfaat:**
- ✅ Audit trail untuk compliance
- ✅ Event-driven architecture
- ✅ Loose coupling antar modules

---

### 12. **Exception Handling**

#### 📂 File Baru:
- `app/Exceptions/ResourceNotFoundException.php`

#### ✨ Contoh:
```php
try {
    $user = User::findOrFail($id);
} catch (ModelNotFoundException $e) {
    throw new ResourceNotFoundException('User');
}
```

**Manfaat:**
- ✅ Custom exception handling
- ✅ Consistent error responses
- ✅ Better error tracking

---

## 📊 Struktur Folder Sekarang

```
app/
├── Console/
├── Events/
│   └── UserActionEvent.php          [NEW]
├── Exceptions/
│   └── ResourceNotFoundException.php [NEW]
├── Helpers/
│   ├── ResponseHelper.php            [NEW]
│   └── FormatHelper.php              [NEW]
├── Http/
│   ├── Controllers/
│   │   ├── UserController.php        [REFACTORED]
│   │   ├── ReportController.php      [REFACTORED]
│   │   └── DashboardController.php   [REFACTORED]
│   ├── Middleware/
│   └── Requests/
│       └── StoreSensorRequest.php    [REFACTORED]
├── Models/
│   ├── User.php                      [REFACTORED]
│   ├── Report.php                    [REFACTORED]
│   ├── Sensor.php                    [REFACTORED]
│   └── ... (other models)
├── Policies/
│   └── ReportPolicy.php              [NEW]
├── Providers/
│   ├── AppServiceProvider.php
│   ├── RepositoryServiceProvider.php [NEW]
│   └── ... (other providers)
├── Repositories/
│   ├── AbstractRepository.php        [NEW]
│   ├── UserRepository.php            [NEW]
│   └── ReportRepository.php          [NEW]
├── Services/
│   ├── UserService.php               [NEW]
│   ├── ReportService.php             [NEW]
│   └── RaspiService.php              [NEW]
└── Traits/
    └── LoggableTrait.php             [NEW]

routes/
├── web.php                           [REFACTORED]
└── api.php

```

---

## 🚀 Best Practices yang Diterapkan

### 1. **SOLID Principles**
- ✅ **S** (Single Responsibility): Setiap class punya satu tanggung jawab
- ✅ **O** (Open/Closed): Extensible via inheritance dan composition
- ✅ **L** (Liskov Substitution): Polymorphism dengan contracts
- ✅ **I** (Interface Segregation): Interface yang fokus
- ✅ **D** (Dependency Inversion): Depend on abstractions, not concretions

### 2. **Design Patterns**
- 🔄 **Service Pattern**: Encapsulate business logic
- 📦 **Repository Pattern**: Abstract data access layer
- 🏗️ **Factory Pattern**: Object creation
- 🔍 **Policy Pattern**: Authorization logic
- 📢 **Event Pattern**: Decoupled event handling

### 3. **Clean Code**
- ✅ Descriptive naming
- ✅ DRY (Don't Repeat Yourself)
- ✅ KISS (Keep It Simple Stupid)
- ✅ Small functions/methods
- ✅ Proper documentation/comments

### 4. **Type Safety**
- ✅ Type hints untuk parameters
- ✅ Return type declarations
- ✅ Proper casting di models
- ✅ IDE autocomplete support

### 5. **Testability**
- ✅ Dependency Injection
- ✅ Mockable services
- ✅ Separated concerns
- ✅ Pure functions

---

## 📝 How to Use

### Using Services in Controller
```php
class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {}

    public function store(Request $request)
    {
        $user = $this->userService->createUser($request->validated());
        return back()->with('success', 'User created');
    }
}
```

### Using Repository
```php
class UserService
{
    public function __construct(private UserRepository $repository)
    {}

    public function getUserByEmail(string $email)
    {
        return $this->repository->findByEmail($email);
    }
}
```

### Using Policies
```php
public function approve(Report $report)
{
    $this->authorize('approve', $report);
    // Logic here
}
```

### Using Helpers
```php
ResponseHelper::success($data, 'Success message');
FormatHelper::formatPower(5000);
```

---

## ✨ Next Steps untuk Improvement

1. **Unit Tests**
   - Test untuk semua Services
   - Test untuk Repository methods
   - Test untuk Policies

2. **Integration Tests**
   - Test controller endpoints
   - Test complete workflows

3. **API Documentation**
   - Swagger/OpenAPI documentation
   - Generate API docs automatically

4. **Caching Layer**
   - Implement caching di Repository
   - Cache heavy queries

5. **Queue & Jobs**
   - Move long-running tasks to jobs
   - Async processing untuk report generation

6. **Database Seeding**
   - Create proper seeders
   - Demo data for development

7. **CI/CD**
   - GitHub Actions untuk automated testing
   - Linting dan code quality checks

8. **Database Optimization**
   - Add proper indexes
   - Query optimization

---

## 📖 Reference & Resources

- [Laravel Best Practices](https://laravel.com/docs)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Design Patterns](https://refactoring.guru/design-patterns)
- [Clean Code](https://www.oreilly.com/library/view/clean-code-a/9780136083238/)

---

**Status**: ✅ Refactoring Complete
**Date**: 18 January 2026
**Laravel Version**: 11.x
