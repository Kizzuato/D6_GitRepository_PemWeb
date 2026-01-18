## Sistem Credit Score - Dokumentasi

### Pengenalan
Sistem credit score adalah fitur terintegrasi yang melacak kredibilitas pengguna berdasarkan aktivitas mereka di platform. Score ini mempengaruhi kemampuan pengguna untuk mengirim laporan dan interaksi lainnya.

### Komponen Utama

#### 1. Model dan Database
- **User Model** - Ditambah kolom `credit_score` (default: 100) dan `credit_history`
- **CreditScoreLog Model** - Mencatat setiap perubahan score
- **Migrations** - `add_credit_score_to_users` dan `create_credit_score_logs_table`

#### 2. Service Layer
**CreditScoreService** menyediakan:
- `updateCreditScore()` - Update score dengan logging
- `addPoints()` - Tambah poin berdasarkan action type
- `getCreditScoreCategory()` - Kategori score (Excellent, Good, Fair, Poor, Critical)
- `getCreditScoreInfo()` - Info lengkap tentang score user
- `getCreditScoreHistory()` - Riwayat perubahan score
- `canSubmitReport()` - Cek apakah user bisa submit report
- `resetCreditScore()` - Reset score (admin only)

#### 3. Controller
**CreditScoreController** menyediakan:
- `show()` - Display halaman credit score
- `getScoreInfo()` - API endpoint untuk score info (JSON)
- `getHistory()` - API endpoint untuk riwayat (JSON)

#### 4. Routes
```
GET  /credit-score                 - Halaman credit score
GET  /api/credit-score/info        - API score info
GET  /api/credit-score/history     - API riwayat score
```

### Score Rules

| Action | Points | Keterangan |
|--------|--------|-----------|
| Report Submitted | +5 | Laporan berhasil disubmit |
| Report Approved | +5 | Laporan disetujui admin |
| Report Rejected | -5 | Laporan ditolak admin |
| Data Verified | +8 | Data terverifikasi |
| High Accuracy | +12 | Akurasi laporan tinggi |
| Late Submission | -5 | Submisi terlambat |
| False Report | -20 | Laporan palsu/tidak akurat |
| Compliance Check | +3 | Lolos compliance check |

### Score Categories

| Kategori | Range | Deskripsi |
|----------|-------|-----------|
| Excellent | 90-100 | Pengguna sangat terpercaya |
| Good | 75-89 | Pengguna terpercaya |
| Fair | 50-74 | Pengguna cukup terpercaya |
| Poor | 25-49 | Pengguna perlu peningkatan |
| Critical | 0-24 | Pengguna berisiko tinggi |

### Penggunaan dalam Kode

#### Inject Service dan Update Score
```php
// Di dalam controller atau service
private CreditScoreService $creditScoreService;

public function __construct(CreditScoreService $creditScoreService)
{
    $this->creditScoreService = $creditScoreService;
}

// Update score
$this->creditScoreService->addPoints(
    $user,
    'report_approved',
    ['report_id' => $report->id]
);
```

#### Get Credit Score Info
```php
$info = $this->creditScoreService->getCreditScoreInfo($user);
// Output:
// [
//     'score' => 95,
//     'category' => 'Excellent',
//     'color' => 'success',
//     'description' => 'Pengguna sangat terpercaya',
//     'percentage' => 95,
//     'last_activity' => CreditScoreLog object
// ]
```

#### Check Permission Pengiriman Laporan
```php
if ($this->creditScoreService->canSubmitReport($user)) {
    // User dapat mengirim laporan
} else {
    // User tidak dapat mengirim laporan (score < 20)
}
```

### Views & Components

#### Halaman Lengkap
- `resources/views/dashboard/credit-score.blade.php` - Halaman detail credit score dengan:
  - Visualisasi score dengan circular progress
  - Kategori dan deskripsi score
  - Informasi status pengiriman laporan
  - Tabel kategori score
  - Tabel poin dan penalti
  - Riwayat perubahan score

#### Widget Component
- `resources/views/components/cards/credit-score.blade.php` - Mini widget untuk dashboard dengan:
  - Score mini chart
  - Category badge
  - Link ke halaman detail

### Setup & Migration

1. Run migration untuk menambah kolom dan tabel:
```bash
php artisan migrate
```

2. Run seeder untuk initialize credit score existing users:
```bash
php artisan db:seed --class=CreditScoreSeeder
```

### Integrasi dengan Report System

Sistem credit score sudah terintegrasi penuh dengan report approval/rejection system:

Saat report diapprove di halaman admin reports:
- User mendapat **+5 poin**
- CreditScoreLog otomatis dibuat dengan metadata report_id

Saat report ditolak di halaman admin reports:
- User dikurangi **-5 poin**
- CreditScoreLog otomatis dibuat dengan metadata report_id

**Implementasi** (di [app/Services/ReportService.php](app/Services/ReportService.php)):
```php
// Approve report
public function approveReport(Report $report): Report
{
    $report->update(['status' => 'approved']);

    // Tambah 5 poin credit score
    $this->creditScoreService->addPoints(
        $report->user,
        'report_approved',
        ['report_id' => $report->id]
    );

    return $report;
}

// Reject report
public function rejectReport(Report $report): Report
{
    $report->update(['status' => 'rejected']);

    // Kurang 5 poin credit score
    $this->creditScoreService->updateCreditScore(
        $report->user,
        -5,
        'Laporan ditolak oleh admin',
        'report_rejected',
        ['report_id' => $report->id]
    );

    return $report;
}
```

### API Response Examples

#### Get Score Info
```json
{
    "success": true,
    "data": {
        "score": 95,
        "category": "Excellent",
        "color": "success",
        "description": "Pengguna sangat terpercaya",
        "percentage": 95,
        "last_activity": {
            "id": 1,
            "user_id": 1,
            "previous_score": 90,
            "new_score": 95,
            "change_amount": 5,
            "reason": "Laporan berhasil disubmit",
            "action_type": "report_submitted",
            "created_at": "2026-01-18T10:00:00Z"
        }
    }
}
```

### File yang Dibuat

1. **Migrations**
   - `2026_01_18_000000_add_credit_score_to_users.php`
   - `2026_01_18_000002_create_credit_score_logs_table.php`

2. **Models**
   - `app/Models/CreditScoreLog.php`
   - Update `app/Models/User.php`

3. **Services**
   - `app/Services/CreditScoreService.php`

4. **Controllers**
   - `app/Http/Controllers/Dashboard/CreditScoreController.php`

5. **Views**
   - `resources/views/dashboard/credit-score.blade.php`
   - `resources/views/components/cards/credit-score.blade.php`

6. **Seeders**
   - `database/seeders/CreditScoreSeeder.php`

7. **Routes** (Updated)
   - `routes/web.php` - Ditambah credit score routes

8. **Providers** (Updated)
   - `app/Providers/RepositoryServiceProvider.php` - Ditambah CreditScoreService registration
