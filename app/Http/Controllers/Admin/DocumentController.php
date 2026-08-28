<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use App\Notifications\DocumentDeliveredToClientNotification;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Handle direct HTTP POST document upload from admin portal to a client.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'target_client_id' => 'required|exists:users,id',
            'file'             => 'required|file|max:20480',
            'type'             => 'required|string',
            'notes'            => 'nullable|string|max:300',
        ], [
            'target_client_id.required' => 'Please select a recipient client.',
            'target_client_id.exists'   => 'The selected client does not exist.',
            'file.required'             => 'Please select a document or image to upload.',
            'file.file'                 => 'The uploaded item must be a valid file.',
            'file.max'                  => 'The file size must not exceed 20MB.',
        ]);

        $file         = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension    = $file->getClientOriginalExtension() ?: 'bin';
        $storedName   = $file->storeAs('documents/' . $request->target_client_id, Str::uuid() . '.' . $extension, 'public');

        $doc = Document::create([
            'client_id'         => $request->target_client_id,
            'uploaded_by'       => auth()->id(),
            'assigned_admin_id' => auth()->id(),
            'type'              => $request->type,
            'notes'             => $request->notes,
            'original_name'     => $originalName,
            'stored_name'       => $storedName,
            'file_type'         => $file->getMimeType() ?: 'application/octet-stream',
            'file_size'         => $file->getSize() ?: 0,
            'version'           => 1,
        ]);

        $client     = User::find($request->target_client_id);
        $clientName = $client ? $client->name : "ID {$request->target_client_id}";

        if ($client) {
            try {
                $client->notify(new DocumentDeliveredToClientNotification($doc));
            } catch (\Throwable $e) {
                // Ignore notification errors in local/dev
            }
        }

        AuditService::log('document.admin_uploaded', "Admin uploaded file {$doc->original_name} to client {$clientName}", $doc);

        return redirect()->route('admin.documents')
            ->with('message', "✅ Document \"{$doc->original_name}\" uploaded and delivered to {$clientName}'s client portal successfully!");
    }
}
