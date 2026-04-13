<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApiKeyRequest;
use App\Models\ApiKey;
use App\Services\ApiKeyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ApiKeyController extends Controller
{
    public function __construct(private readonly ApiKeyService $apiKeyService)
    {
    }

    public function index(): View
    {
        $apiKeys = auth()->user()->apiKeys()->latest()->get();

        return view('api-keys.index', [
            'apiKeys' => $apiKeys,
            'newToken' => session('newToken'),
        ]);
    }

    public function store(StoreApiKeyRequest $request): RedirectResponse
    {
        $result = $this->apiKeyService->create($request->user(), $request->validated('name'));

        return redirect()
            ->route('api-keys.index')
            ->with('newToken', $result['plainTextKey'])
            ->with('status', 'API atslēga izveidota. Saglabā to tagad — vēlāk tā vairs netiks rādīta.');
    }

    public function destroy(ApiKey $apiKey): RedirectResponse
    {
        abort_unless($apiKey->user_id === auth()->id(), 403);

        $this->apiKeyService->revoke($apiKey);

        return redirect()
            ->route('api-keys.index')
            ->with('status', 'API atslēga atsaukta.');
    }
}