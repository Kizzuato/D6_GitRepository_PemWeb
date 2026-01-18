<?php

namespace App\Services;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

/**
 * ReportService: Menangani semua business logic terkait Report
 */
class ReportService
{
    /**
     * Get reports untuk user
     */
    public function getUserReports(int $userId): Collection
    {
        return Report::where('user_id', $userId)
            ->latest()
            ->get();
    }

    /**
     * Get semua reports (untuk admin)
     */
    public function getAllReports(): Collection
    {
        return Report::latest()->get();
    }

    /**
     * Create report baru
     */
    public function createReport(int $userId, array $data): Report
    {
        $imagePath = null;

        if (isset($data['image']) && !empty($data['image'])) {
            $imagePath = $this->storeImage($data['image']);
        }

        return Report::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_path' => $imagePath,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'user_id' => $userId,
            'status' => 'pending',
        ]);
    }

    /**
     * Approve report
     */
    public function approveReport(Report $report): Report
    {
        $report->update(['status' => 'approved']);
        return $report;
    }

    /**
     * Reject report
     */
    public function rejectReport(Report $report): Report
    {
        $report->update(['status' => 'rejected']);
        return $report;
    }

    /**
     * Store image dari base64
     */
    private function storeImage(string $imageData): string
    {
        $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinary = base64_decode($imageData);

        $filename = 'reports/' . uniqid() . '.png';
        Storage::disk('public')->put($filename, $imageBinary);

        return $filename;
    }
}
