<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download(Document $document)
    {
        $user = auth()->user();
        if ($document->client_id !== $user->id && !$user->isAdmin() && !$user->isAccountant()) {
            abort(403);
        }

        if (Storage::disk('public')->exists($document->stored_name)) {
            return Storage::disk('public')->download($document->stored_name, $document->original_name);
        } elseif (Storage::exists($document->stored_name)) {
            return Storage::download($document->stored_name, $document->original_name);
        }

        abort(404, 'File not found on server.');
    }
}
