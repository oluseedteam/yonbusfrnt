<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'original_name' => $this->original_name,
            'file_type'     => $this->file_type,
            'file_size'     => $this->file_size,
            'file_size_human' => $this->file_size_human,
            'version'       => $this->version,
            'client_id'     => $this->client_id,
            'uploaded_by'   => $this->uploaded_by,
            'view_url'      => $this->view_url,
            'download_url'  => $this->download_url,
            'created_at'    => $this->created_at?->toIso8601String(),
        ];
    }
}

