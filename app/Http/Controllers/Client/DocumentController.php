<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Download document file with attachment Content-Disposition.
     */
    public function download(Document $document)
    {
        $user = auth()->user();
        if ($document->client_id !== $user->id && !$user->isAdmin() && !$user->isAccountant()) {
            abort(403, 'Unauthorized access to download this document.');
        }

        $diskName = Storage::disk('public')->exists($document->stored_name) ? 'public' : (Storage::disk('local')->exists($document->stored_name) ? 'local' : null);

        if ($diskName) {
            return Storage::disk($diskName)->download($document->stored_name, $document->original_name);
        }

        abort(404, 'File not found on server.');
    }

    /**
     * View/preview document file inline (PDFs, Images, Text) in browser.
     */
    public function view(Document $document)
    {
        $user = auth()->user();
        if ($document->client_id !== $user->id && !$user->isAdmin() && !$user->isAccountant()) {
            abort(403, 'Unauthorized access to view this document.');
        }

        $diskName = Storage::disk('public')->exists($document->stored_name) ? 'public' : (Storage::disk('local')->exists($document->stored_name) ? 'local' : null);

        if (!$diskName) {
            abort(404, 'File not found on server.');
        }

        $mimeType = $document->file_type ?: Storage::disk($diskName)->mimeType($document->stored_name);
        $headers = [
            'Content-Type'        => $mimeType ?: 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . addslashes($document->original_name) . '"',
            'Cache-Control'       => 'private, max-age=3600',
        ];

        return Storage::disk($diskName)->response($document->stored_name, $document->original_name, $headers);
    }
}

