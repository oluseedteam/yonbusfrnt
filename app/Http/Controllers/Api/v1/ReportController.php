<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(protected ReportService $service) {}

    public function dashboard(Request $request): JsonResponse
    {
        return response()->json([
            'summary' => $this->service->dashboardSummary(),
            'chart'   => $this->service->monthlyRevenueChart(),
        ]);
    }

    public function appointments(Request $request): JsonResponse
    {
        $filters = $request->only(['date_from', 'date_to', 'status', 'accountant_id', 'service_id']);
        return response()->json($this->service->appointmentReport($filters));
    }

    public function revenue(Request $request): JsonResponse
    {
        $filters = $request->only(['date_from', 'date_to', 'service_id']);
        return response()->json($this->service->revenueReport($filters));
    }
}
