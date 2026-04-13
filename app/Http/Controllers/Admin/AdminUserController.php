<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->withCount('apiKeys')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->load([
            'apiKeys' => fn ($query) => $query->latest(),
        ]);

        $requestLogs = $user->apiRequestLogs()
            ->latest()
            ->paginate(50);

        return view('admin.users.show', compact('user', 'requestLogs'));
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->isAdmin(), 422, 'Admin lietotāju dzēst nedrīkst.');

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Lietotājs izdzēsts.');
    }
}