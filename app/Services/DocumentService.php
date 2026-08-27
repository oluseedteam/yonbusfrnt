<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentService
{
    const ALLOWED_TYPES = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'image/heic',
        'image/heif',
        'text/csv',
        'text/plain',
    ];

    const MAX_SIZE_MB = 25;


    public function upload(UploadedFile $file, int $clientId, int $uploadedById): Document
    {
        $this->validateFile($file);

        $originalName = $file->getClientOriginalName();
        $extension    = $file->getClientOriginalExtension();
        $mimeType     = $file->getMimeType();
        $size         = $file->getSize();

        // Generate unique storage name to prevent collisions
        $storageName = 'documents/' . $clientId . '/' . Str::uuid() . '.' . $extension;
        $path = Storage::disk('public')->putFileAs('documents/' . $clientId, $file, Str::uuid() . '.' . $extension);

        // Version tracking: count existing versions for same original file name
        $version = Document::where('client_id', $clientId)
            ->where('original_name', $originalName)
            ->max('version') ?? 0;

        return Document::create([
            'client_id'     => $clientId,
            'uploaded_by'   => $uploadedById,
            'original_name' => $originalName,
            'stored_name'   => $path,
            'file_type'     => $mimeType,
            'file_size'     => $size,
            'version'       => $version + 1,
        ]);
    }

    public function download(Document $document): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $diskName = Storage::disk('public')->exists($document->stored_name) ? 'public' : (Storage::disk('local')->exists($document->stored_name) ? 'local' : null);

        if (!$diskName) {
            abort(404, 'Document file not found on storage.');
        }

        return Storage::disk($diskName)->download($document->stored_name, $document->original_name);
    }

    public function view(Document $document): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $diskName = Storage::disk('public')->exists($document->stored_name) ? 'public' : (Storage::disk('local')->exists($document->stored_name) ? 'local' : null);

        if (!$diskName) {
            abort(404, 'Document file not found on storage.');
        }

        $mimeType = $document->file_type ?: Storage::disk($diskName)->mimeType($document->stored_name);
        $headers = [
            'Content-Type'        => $mimeType ?: 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . addslashes($document->original_name) . '"',
            'Cache-Control'       => 'private, max-age=3600',
        ];

        return Storage::disk($diskName)->response($document->stored_name, $document->original_name, $headers);
    }

    public function delete(Document $document): void
    {
        $diskName = Storage::disk('public')->exists($document->stored_name) ? 'public' : (Storage::disk('local')->exists($document->stored_name) ? 'local' : null);
        if ($diskName) {
            Storage::disk($diskName)->delete($document->stored_name);
        }
        $document->delete();
    }


    public function getVersionHistory(int $clientId, string $originalName): \Illuminate\Database\Eloquent\Collection
    {
        return Document::where('client_id', $clientId)
            ->where('original_name', $originalName)
            ->orderBy('version', 'desc')
            ->get();
    }

    protected function validateFile(UploadedFile $file): void
    {
        $maxBytes = self::MAX_SIZE_MB * 1024 * 1024;

        if ($file->getSize() > $maxBytes) {
            throw new \InvalidArgumentException("File exceeds maximum size of " . self::MAX_SIZE_MB . "MB.");
        }

        if (!in_array($file->getMimeType(), self::ALLOWED_TYPES)) {
            throw new \InvalidArgumentException("File type '{$file->getMimeType()}' is not allowed.");
        }
    }
}
