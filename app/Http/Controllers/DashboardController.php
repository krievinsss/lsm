<?php

namespace App\Http\Controllers;

use App\Models\ApiRequestLog;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        $apiKeysCount = $user->apiKeys()->count();

        $requestsToday = ApiRequestLog::query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        $statusCounts = ApiRequestLog::query()
            ->selectRaw('status_code, COUNT(*) as aggregate')
            ->where('user_id', $user->id)
            ->groupBy('status_code')
            ->pluck('aggregate', 'status_code');

        $recentRequests = ApiRequestLog::query()
            ->where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'apiKeysCount',
            'requestsToday',
            'statusCounts',
            'recentRequests',
        ));
    }
}