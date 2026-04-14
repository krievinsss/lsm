@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Drošība</p>
                <h1 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900">
                    API Keys
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Pārvaldi savas API atslēgas. Katru atslēgu vari atsaukt jebkurā brīdī.
                </p>
            </div>
        </div>
        @if($newToken)
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-sm font-semibold text-amber-800">
                            Jaunā API atslēga
                        </h2>
                        <p class="mt-1 text-sm text-amber-700">
                            Saglabā šo atslēgu tagad — vēlāk tā vairs netiks parādīta.
                        </p>
                    </div>
                </div>
                <div class="mt-4 rounded-xl border border-amber-200 bg-white p-4">
                    <code class="block break-all text-sm text-slate-800">
                        {{ $newToken }}
                    </code>
                </div>
            </div>
        @endif
        <div class="grid gap-6 xl:grid-cols-3">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-1">
                <div class="mb-5">
                    <h2 class="text-lg font-semibold text-slate-900">Jauna atslēga</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Izveido jaunu API atslēgu integrācijai.
                    </p>
                </div>
                <form method="POST" action="{{ route('api-keys.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700">
                            Nosaukums
                        </label>
                        <input type="text" name="name" placeholder="piem. Frontend app" required class="mt-1 w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
                    </div>
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
                        Izveidot API atslēgu
                    </button>
                </form>
            </section>
            <section class="rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2">
                <div class="flex flex-col gap-2 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Esošās atslēgas</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Aktīvās un atsauktās API atslēgas.
                        </p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Prefix
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Last used
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    Status
                                </th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($apiKeys as $apiKey)
                                <tr class="transition hover:bg-slate-50">
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
                                    <td class="px-6 py-4 text-right">
                                        @if(!$apiKey->revoked_at)
                                            <form method="POST" action="{{ route('api-keys.destroy', $apiKey) }}" onsubmit="return confirm('Tiešām atsaukt šo API atslēgu?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                                                    Revoke
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">
                                        Nav vēl nevienas API atslēgas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection