@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Administrācija</p>
                <h1 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900">
                    Lietotāji
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Pārvaldi sistēmas lietotājus un to piekļuves.
                </p>
            </div>
        </div>
        <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Visi lietotāji</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Kopējais saraksts ar lietotājiem sistēmā.
                    </p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                User code
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Admin
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                API keys
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                Created
                            </th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($users as $user)
                            <tr class="transition hover:bg-slate-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                    {{ $user->id }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <code class="rounded bg-slate-100 px-2 py-1 text-xs text-slate-800">
                                        {{ $user->user_code }}
                                    </code>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_admin)
                                        <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                    {{ $user->api_keys_count }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500">
                                    {{ $user->created_at }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                                        Skatīt
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-sm text-slate-500">
                                    Nav neviena lietotāja.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-500">
                        Lapu navigācija
                    </div>

                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection