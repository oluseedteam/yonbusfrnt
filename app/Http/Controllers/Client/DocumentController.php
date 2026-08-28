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

    /**
     * Handle direct HTTP POST document upload from client portal.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file'              => 'required|file|max:20480',
            'type'              => 'required|string',
            'assigned_admin_id' => 'nullable',
            'notes'             => 'nullable|string|max:500',
        ], [
            'file.required' => 'Please select a document or image file to upload.',
            'file.file'     => 'The uploaded item must be a valid file.',
            'file.max'      => 'The file size must not exceed 20MB.',
        ]);

        $file         = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension    = $file->getClientOriginalExtension() ?: 'bin';
        $storedName   = $file->storeAs('documents/' . auth()->id(), \Illuminate\Support\Str::uuid() . '.' . $extension, 'public');

        $assignedId = !empty($request->assigned_admin_id) ? (int)$request->assigned_admin_id : auth()->user()->assigned_admin_id;

        $doc = Document::create([
            'client_id'         => auth()->id(),
            'uploaded_by'       => auth()->id(),
            'assigned_admin_id' => $assignedId ?: null,
            'type'              => $request->type,
            'notes'             => $request->notes,
            'original_name'     => $originalName,
            'stored_name'       => $storedName,
            'file_type'         => $file->getMimeType() ?: 'application/octet-stream',
            'file_size'         => $file->getSize() ?: 0,
            'version'           => 1,
        ]);

        // If client selected an assigned admin, also update client profile if not set
        if ($assignedId && !auth()->user()->assigned_admin_id) {
            auth()->user()->update(['assigned_admin_id' => $assignedId]);
        }

        // Notify assigned admin if present
        if ($assignedId) {
            $assignedAdmin = \App\Models\User::find($assignedId);
            if ($assignedAdmin) {
                try {
                    $assignedAdmin->notify(new \App\Notifications\DocumentUploadedNotification($doc));
                } catch (\Throwable $e) {
                    // Ignore mail exceptions on local environments
                }
            }
        }

        $assignedName = $doc->assignedAdmin ? "to {$doc->assignedAdmin->name}" : "to Central YONBUS Practice";
        \App\Models\ActivityLog::log('document.uploaded', "Uploaded document: {$doc->original_name} {$assignedName}", $doc);

        return redirect()->route('client.documents')
            ->with('message', "✅ Document \"{$doc->original_name}\" uploaded successfully and delivered {$assignedName}!");
    }
}

