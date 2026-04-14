@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Pārskats</p>
                <h1 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900">
                    Dashboard
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Ātrs pārskats par lietotāju, API atslēgām un pēdējiem pieprasījumiem.
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('api-keys.index') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                    Pārvaldīt API Keys
                </a>
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                        Admin panelis
                    </a>
                @endif
            </div>
        </div>
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">User code</p>
                <p class="mt-3 text-2xl font-semibold tracking-tight text-slate-900">
                    {{ auth()->user()->user_code }}
                </p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Loma</p>
                <p class="mt-3 text-2xl font-semibold tracking-tight text-slate-900">
                    {{ auth()->user()->is_admin ? 'Admin' : 'User' }}
                </p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">API Keys</p>
                <p class="mt-3 text-2xl font-semibold tracking-tight text-slate-900">
                    {{ $apiKeysCount }}
                </p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Requests today</p>
                <p class="mt-3 text-2xl font-semibold tracking-tight text-slate-900">
                    {{ $requestsToday }}
                </p>
            </div>
        </div>
        <div class="grid gap-6 xl:grid-cols-3">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-1">
                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-900">Lietotāja informācija</h2>
                    <p class="mt-1 text-sm text-slate-500">Pamata konta informācija.</p>
                </div>
                <dl class="space-y-4">
                    <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-4">
                        <dt class="text-sm text-slate-500">User code</dt>
                        <dd class="text-sm font-medium text-slate-900">{{ auth()->user()->user_code }}</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-4">
                        <dt class="text-sm text-slate-500">Role</dt>
                        <dd>
                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                {{ auth()->user()->is_admin ? 'Admin' : 'User' }}
                            </span>
                        </dd>
                    </div>
                </dl>
                @if(auth()->user()->is_admin)
                    <div class="mt-6">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-700 transition hover:text-slate-900">
                            Atvērt admin paneli →
                        </a>
                    </div>
                @endif
            </section>
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-1">
                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-900">Telemetry</h2>
                    <p class="mt-1 text-sm text-slate-500">Statusu sadalījums par šodienas pieprasījumiem.</p>
                </div>
                <div class="space-y-3">
                    @forelse($statusCounts as $status => $count)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3">
                            <span class="text-sm font-medium text-slate-600">{{ $status }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ $count }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">Nav pieejamu datu.</p>
                    @endforelse
                </div>
            </section>
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-1">
                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-900">Quick start</h2>
                    <p class="mt-1 text-sm text-slate-500">Izmanto šo piemēru, lai ātri sāktu integrāciju.</p>
                </div>
                <div class="space-y-3">
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">Header</p>
                        <code class="block text-sm text-slate-800">X-User-Code: {{ auth()->user()->user_code }}</code>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">Authorization</p>
                        <code class="block text-sm text-slate-800">Authorization: Bearer YOUR_API_KEY</code>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">Example request</p>
                        <code class="block text-sm text-slate-800">GET /api/guide/1/2026-04-13</code>
                    </div>
                </div>
            </section>
        </div>
        <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Recent API requests</h2>
                    <p class="mt-1 text-sm text-slate-500">Pēdējie ienākošie pieprasījumi sistēmā.</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Path</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">User code</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($recentRequests as $request)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                        {{ $request->method }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $request->path }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $request->status_code }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $request->requested_user_code ?? '—' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    {{ $request->duration_ms }} ms
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                    {{ $request->created_at }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">
                                    Nav vēl neviena API pieprasījuma.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection