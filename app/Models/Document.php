<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'original_name', 'type',
        'path', 'mime_type', 'size', 'version', 'notes'
    ];

    const TYPES = [
        'tax_form'            => 'Tax Form',
        'bank_statement'      => 'Bank Statement',
        'receipt'             => 'Receipt',
        'payroll_report'      => 'Payroll Report',
        'financial_statement' => 'Financial Statement',
        'other'               => 'Other',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024) return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    public function getFileIconAttribute(): string
    {
        $mime = $this->mime_type ?? '';
        if (str_contains($mime, 'pdf')) return 'document-text';
        if (str_contains($mime, 'image')) return 'photograph';
        if (str_contains($mime, 'sheet') || str_contains($mime, 'excel') || str_contains($mime, 'csv')) return 'table';
        return 'document';
    }
}
