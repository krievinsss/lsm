<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuideRequest;
use App\Http\Resources\GuideResource;
use App\Services\GuideService;
use Illuminate\Http\JsonResponse;

class GuideController extends Controller
{
    public function __construct(private readonly GuideService $guideService) {
    }

    public function index(int $channel_nr, string $date): JsonResponse {

        $guides = $this->guideService->getGuideForTvDay($channel_nr, $date);

        return response()->json([
            'data' => GuideResource::collection($guides),
        ]);
    }

    public function onAir(int $channel_nr): JsonResponse {

        $guide = $this->guideService->getOnAir($channel_nr);

        return response()->json([
            'data' => $guide ? new GuideResource($guide) : null,
        ]);
    }

    public function upcoming(int $channel_nr): JsonResponse {

        $guides = $this->guideService->getUpcoming($channel_nr);

        return response()->json([
            'data' => GuideResource::collection($guides),
        ]);
    }

    public function store(StoreGuideRequest $request): JsonResponse {
        
        $guide = $this->guideService->create($request->validated());
        $guide = $this->guideService->adjustGuideEndTime($guide, $guide->channel_nr);

        return response()->json([
            'message' => 'Guide entry created successfully.',
            'data' => new GuideResource($guide),
        ], 201);
    }
}