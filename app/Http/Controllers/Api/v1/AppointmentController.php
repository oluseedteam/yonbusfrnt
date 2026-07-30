<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Services\AppointmentService;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentService $service,
        protected AppointmentRepository $repository
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['status', 'date_from', 'date_to', 'accountant_id', 'service_id']);

        if ($request->user()->hasRole('client')) {
            $filters['client_id'] = $request->user()->id;
        } elseif ($request->user()->hasRole('accountant')) {
            $filters['accountant_id'] = $request->user()->id;
        }

        $appointments = $this->repository->paginate(15, $filters);
        return AppointmentResource::collection($appointments)->response();
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'accountant_id' => 'required|exists:users,id',
            'service_id'    => 'required|exists:services,id',
            'date'          => 'required|date|after_or_equal:today',
            'time'          => 'required|string',
            'notes'         => 'nullable|string',
        ]);

        $validated['client_id'] = $request->user()->id;

        $result = $this->service->book($validated);

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 422);
        }

        return response()->json([
            'message'     => 'Appointment booked successfully',
            'appointment' => new AppointmentResource($result['appointment']),
        ], 201);
    }

    public function show(int $id, Request $request): JsonResponse
    {
        $appointment = $this->repository->find($id);
        $this->authorize('view', $appointment);

        return response()->json(new AppointmentResource($appointment));
    }

    public function cancel(int $id, Request $request): JsonResponse
    {
        $appointment = $this->repository->find($id);
        $this->authorize('cancel', $appointment);

        $reason = $request->input('reason', 'Cancelled via API');
        $updated = $this->service->cancel($id, $reason);

        return response()->json([
            'message'     => 'Appointment cancelled',
            'appointment' => new AppointmentResource($updated),
        ]);
    }
}
