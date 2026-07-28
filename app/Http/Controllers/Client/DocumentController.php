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
        if ($document->user_id !== auth()->id() && !auth()->user()->isAdmin() && !auth()->user()->isAccountant()) {
            abort(403);
        }
        return Storage::download($document->path, $document->original_name);
    }
}
