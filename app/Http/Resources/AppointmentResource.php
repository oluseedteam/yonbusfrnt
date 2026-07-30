<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'appointment_number' => $this->appointment_number,
            'date'               => $this->date?->format('Y-m-d'),
            'time'               => $this->time,
            'duration'           => $this->duration,
            'status'             => $this->status,
            'notes'              => $this->notes,
            'meeting_link'       => $this->meeting_link,
            'client'             => new UserResource($this->whenLoaded('client')),
            'accountant'         => new UserResource($this->whenLoaded('accountant')),
            'service'            => new ServiceResource($this->whenLoaded('service')),
            'created_at'         => $this->created_at?->toIso8601String(),
        ];
    }
}
