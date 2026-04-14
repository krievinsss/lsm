@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Administrācija</p>
                <h1 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900">
                    {{ $user->name }}
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Lietotāja profils un aktivitāte sistēmā.
                </p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                ← Atpakaļ
            </a>
        </div>
        <div class="grid gap-6 xl:grid-cols-3">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-1">
                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-900">Pamatinformācija</h2>
                    <p class="mt-1 text-sm text-slate-500">Konta dati.</p>
                </div>
                <dl class="space-y-4">
                    <div class="flex justify-between border-b border-slate-100 pb-3">
                        <dt class="text-sm text-slate-500">ID</dt>
                        <dd class="text-sm font-medium text-slate-900">{{ $user->id }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-3">
                        <dt class="text-sm text-slate-500">User code</dt>
                        <dd>
                            <code class="rounded bg-slate-100 px-2 py-1 text-xs text-slate-800">
                                {{ $user->user_code }}
                            </code>
                        </dd>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-3">
                        <dt class="text-sm text-slate-500">Email</dt>
                        <dd class="text-sm text-slate-700">{{ $user->email }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 pb-3">
                        <dt class="text-sm text-slate-500">Role</dt>
                        <dd>
                            @if($user->is_admin)
                                <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700">
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    User
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-slate-500">Created</dt>
                        <dd class="text-sm text-slate-500">{{ $user->created_at }}</dd>
                    </div>
                </dl>
            </section>
            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold text-slate-900">API Keys</h2>
                    <p class="mt-1 text-sm text-slate-500">Lietotāja API atslēgas.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Prefix</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Last used</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($user->apiKeys as $apiKey)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                        {{ $apiKey->name }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        <code class="rounded bg-slate-100 px-2 py-1 text-xs">
                                            {{ $apiKey->key_prefix }}
                                        </code>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-600">
                                        {{ $apiKey->last_used_at ?? '—' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($apiKey->revoked_at)
                                            <span class="inline-flex rounded-full bg-rose-100 px-2.5 py-1 text-xs font-medium text-rose-700">
                                                Revoked
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700">
                                                Active
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">
                                        Nav API atslēgu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-5">
                <h2 class="text-lg font-semibold text-slate-900">Request logi</h2>
                <p class="mt-1 text-sm text-slate-500">Pēdējie pieprasījumi no šī lietotāja.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Path</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">User code</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">IP</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Time</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($requestLogs as $log)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm">
                                    <span class="rounded bg-slate-100 px-2 py-1 text-xs font-semibold">
                                        {{ $log->method }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $log->path }}</td>

                                <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $log->status_code }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $log->requested_user_code ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $log->duration_ms }} ms
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $log->ip_address ?? '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $log->created_at }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-sm text-slate-500">
                                    Nav request logu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $requestLogs->links() }}
            </div>
        </section>
        @if(!$user->is_admin)
            <section class="rounded-2xl">
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Tiešām dzēst lietotāju? Šo nevarēs atsaukt.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-rose-700">
                        Dzēst lietotāju
                    </button>
                </form>
            </section>
        @endif
    </div>
@endsection