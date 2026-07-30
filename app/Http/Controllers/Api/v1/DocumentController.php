<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Services\DocumentService;
use App\Models\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $service) {}

    public function index(Request $request): JsonResponse
    {
        $query = Document::query();

        if ($request->user()->hasRole('client')) {
            $query->where('client_id', $request->user()->id);
        }

        $documents = $query->latest()->paginate(15);
        return DocumentResource::collection($documents)->response();
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file'      => 'required|file|max:25600', // max 25MB
            'client_id' => 'nullable|exists:users,id',
        ]);

        $clientId = $request->user()->hasRole('client')
            ? $request->user()->id
            : ($request->input('client_id') ?? $request->user()->id);

        try {
            $doc = $this->service->upload($request->file('file'), $clientId, $request->user()->id);
            return response()->json([
                'message'  => 'Document uploaded successfully',
                'document' => new DocumentResource($doc),
            ], 201);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function destroy(int $id, Request $request): JsonResponse
    {
        $document = Document::findOrFail($id);
        $this->authorize('delete', $document);

        $this->service->delete($document);
        return response()->json(['message' => 'Document deleted']);
    }
}
