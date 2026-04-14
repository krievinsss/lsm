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
    <div class="flex min-h-full flex-col justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto w-full max-w-md">
            <div class="mb-8 text-center">
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                    {{ config('app.name') }}
                </h1>
            </div>

            @if(session('status'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>