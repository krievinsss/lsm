<!doctype html>
<html lang="lv" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full text-slate-800 antialiased">
    <div class="min-h-full">
        <nav class="border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-tight text-slate-900">
                        {{ config('app.name') }}
                    </a>
                    <div class="hidden items-center gap-2 md:flex">
                        <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Dashboard
                        </a>

                        <a href="{{ route('api-keys.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            API Keys
                        </a>
                        @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('admin.users.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                                Admin
                            </a>
                        @endif
                        <a href="{{ route('docs') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Documentation
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @auth
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-medium text-slate-900">{{ auth()->user()->name ?? auth()->user()->user_code }}</p>
                            <p class="text-xs text-slate-500">
                                {{ auth()->user()->is_admin ? 'Administrators' : 'Lietotājs' }}
                            </p>
                        </div>
                    @endauth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:border-slate-400 hover:bg-slate-50 hover:text-slate-900">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-slate-200 px-4 py-3 md:hidden">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('dashboard') }}" class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700">
                        Dashboard
                    </a>
                    <a href="{{ route('api-keys.index') }}" class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700">
                        API Keys
                    </a>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="{{ route('admin.users.index') }}" class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700">
                            Admin
                        </a>
                    @endif
                </div>
            </div>
        </nav>
        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-4 shadow-sm">
                    <div class="mb-2 text-sm font-semibold text-rose-800">
                        Kaut kas nogāja greizi
                    </div>
                    <ul class="space-y-1 text-sm text-rose-700">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>