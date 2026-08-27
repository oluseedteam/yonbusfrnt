<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'uploaded_by',
        'assigned_admin_id',
        'type',
        'notes',
        'original_name',
        'stored_name',
        'file_type',
        'file_size',
        'version',
    ];

    // ── Relationships ──────────────────────────────────────────────
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function assignedAdmin()
    {
        return $this->belongsTo(User::class, 'assigned_admin_id');
    }

    // ── Accessors ─────────────────────────────────────────────────
    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 2) . ' MB';
        if ($bytes >= 1024)   return round($bytes / 1024, 2) . ' KB';
        return $bytes . ' bytes';
    }

    public function getFileExtensionAttribute(): string
    {
        return strtolower(pathinfo($this->original_name, PATHINFO_EXTENSION));
    }

    public function getIsImageAttribute(): bool
    {
        $ext = $this->file_extension;
        if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp', 'gif', 'svg', 'bmp', 'heic', 'heif'])) {
            return true;
        }
        return str_starts_with($this->file_type ?? '', 'image/');
    }

    public function getFileUrlAttribute(): ?string
    {
        if ($this->stored_name && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->stored_name)) {
            return asset('storage/' . $this->stored_name);
        }
        return null;
    }
}
