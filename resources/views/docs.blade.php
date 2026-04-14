@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-6xl space-y-8" id="owerview">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="max-w-3xl">
                <p class="text-sm font-medium text-slate-500">Documentation</p>
                <h1 class="mt-2 text-4xl font-semibold tracking-tight text-slate-900">
                    TV Guide API Documentation
                </h1>
                <p class="mt-4 text-base leading-7 text-slate-600">
                    Laravel-based TV guide API with web authentication, API key management,
                    request logging, admin tools, and TV schedule business logic.
                </p>
            </div>
            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">TV day starts</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">06:00:00</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Auth model</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">Bearer + User Code</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-medium text-slate-500">Stack</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">Laravel 13</p>
                </div>
            </div>
        </div>
        <section class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">Overview</h2>
                    <div class="mt-4 space-y-4 text-sm leading-7 text-slate-600">
                        <p>
                            This project provides a Laravel-based TV guide API with web authentication,
                            API key management, request logging, admin user management, and TV schedule business logic.
                        </p>
                        <p>
                            TV day starts at <strong class="font-semibold text-slate-900">06:00:00</strong>, not at
                            midnight.
                            API responses also expose <code
                                class="rounded bg-slate-100 px-1.5 py-0.5 text-slate-800">adjusted_ends_at</code>,
                            where the end time is corrected to the next programme start time without modifying the original
                            database value.
                        </p>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">Tech stack</h2>
                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div
                            class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700">
                            PHP 8.x</div>
                        <div
                            class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700">
                            Laravel 13</div>
                        <div
                            class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700">
                            MySQL</div>
                        <div
                            class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700">
                            Laravel Sail / Docker</div>
                        <div
                            class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-700 sm:col-span-2">
                            Blade views for dashboard and documentation
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">Setup</h2>
                    <div class="mt-4 overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>cp .env.example .env
    composer install
    ./vendor/bin/sail up -d
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate:fresh --seed
</code></pre>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">Demo accounts</h2>
                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Admin</h3>
                            <div class="mt-4 space-y-2 text-sm text-slate-700">
                                <p>Email: <code class="rounded bg-white px-2 py-1 text-slate-800">admin@example.com</code>
                                </p>
                                <p>Password: <code class="rounded bg-white px-2 py-1 text-slate-800">password</code></p>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">User</h3>
                            <div class="mt-4 space-y-2 text-sm text-slate-700">
                                <p>Email: <code class="rounded bg-white px-2 py-1 text-slate-800">user@example.com</code>
                                </p>
                                <p>Password: <code class="rounded bg-white px-2 py-1 text-slate-800">password</code></p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-5 text-sm leading-7 text-slate-600">
                        After seeding, the console will print the generated user code and API key for the test user.
                    </p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm" id="auth">
                    <h2 class="text-xl font-semibold text-slate-900">Authentication</h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600">
                        API requests require both:
                    </p>
                    <div class="mt-4 space-y-3">
                        <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                            <code class="text-slate-900">Authorization: Bearer YOUR_API_KEY</code>
                        </div>
                        <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                            <code class="text-slate-900">X-User-Code: 123456</code>
                        </div>
                    </div>
                    <p class="mt-5 text-sm font-medium text-slate-700">Example headers</p>
                    <div class="mt-3 overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>
    Authorization: Bearer tvg_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    X-User-Code: 123456
    Accept: application/json
    Content-Type: application/json
</code></pre>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">How to get an API key</h2>
                    <ol class="mt-4 space-y-3 text-sm leading-7 text-slate-600">
                        <li class="flex gap-3">
                            <span
                                class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white">1</span>
                            <span>Register or log in through the web interface.</span>
                        </li>
                        <li class="flex gap-3">
                            <span
                                class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white">2</span>
                            <span>Open the <strong class="text-slate-900">API Keys</strong> page.</span>
                        </li>
                        <li class="flex gap-3">
                            <span
                                class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white">3</span>
                            <span>Create a new API key.</span>
                        </li>
                        <li class="flex gap-3">
                            <span
                                class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white">4</span>
                            <span>Copy it immediately — plain text is shown only once.</span>
                        </li>
                    </ol>
                </div>
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-amber-900">Business rules</h2>
                    <ul class="mt-4 space-y-3 text-sm leading-7 text-amber-900/90">
                        <li>• TV day starts at <strong>06:00:00</strong>.</li>
                        <li>• Guide records in the same channel must not overlap.</li>
                        <li>• Database stores original <code class="rounded bg-white px-1.5 py-0.5">ends_at</code>.</li>
                        <li>• API response exposes <code class="rounded bg-white px-1.5 py-0.5">adjusted_ends_at</code>
                            based on the next programme start time.</li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Endpoint</p>
                                <h2 class="mt-1 text-xl font-semibold text-slate-900">GET /api/guide/{channel_nr}/{date}
                                </h2>
                                <p class="mt-2 text-sm text-slate-600">Returns the full TV programme for a given channel and
                                    TV day.</p>
                            </div>
                            <span
                                class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">GET</span>
                        </div>
                        <div class="mt-5 space-y-5">
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Example request</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
                                    <pre
                                        class="text-sm leading-6 text-slate-100"><code>GET /api/guide/1/2026-04-14</code></pre>
                                </div>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Response example</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>{
    "data": [
        {
        "id": 1,
        "title": "Panorāma",
        "channel_nr": 1,
        "starts_at": "2026-04-14 20:00:00",
        "ends_at": "2026-04-14 20:36:00",
        "adjusted_ends_at": "2026-04-14 20:37:00"
        }
    ]
    }
</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm" id="end">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Endpoint</p>
                                <h2 class="mt-1 text-xl font-semibold text-slate-900">GET /api/on-air/{channel_nr}</h2>
                                <p class="mt-2 text-sm text-slate-600">Returns the programme currently on air for the given
                                    channel.</p>
                            </div>
                            <span
                                class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">GET</span>
                        </div>
                        <div class="mt-5 space-y-5">
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Example request</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
                                    <pre class="text-sm leading-6 text-slate-100"><code>GET /api/on-air/1</code></pre>
                                </div>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Response example</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>{
    "data": {
        "id": 2,
        "title": "Šodienas jautājums",
        "channel_nr": 1,
        "starts_at": "2026-04-14 20:37:00",
        "ends_at": "2026-04-14 20:56:00",
        "adjusted_ends_at": "2026-04-14 20:56:10"
    }
    }
</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Endpoint</p>
                                <h2 class="mt-1 text-xl font-semibold text-slate-900">GET /api/upcoming/{channel_nr}</h2>
                                <p class="mt-2 text-sm text-slate-600">
                                    Returns the next 10 programme entries, including the one currently on air if applicable.
                                </p>
                            </div>
                            <span
                                class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">GET</span>
                        </div>
                        <div class="mt-5 space-y-5">
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Example request</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
                                    <pre class="text-sm leading-6 text-slate-100"><code>GET /api/upcoming/1</code></pre>
                                </div>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Response example</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>{
    "data": [
        {
        "id": 2,
        "title": "Šodienas jautājums",
        "channel_nr": 1,
        "starts_at": "2026-04-14 20:37:00",
        "ends_at": "2026-04-14 20:56:00",
        "adjusted_ends_at": "2026-04-14 20:56:10"
        },
        {
        "id": 3,
        "title": "Sporta ziņas",
        "channel_nr": 1,
        "starts_at": "2026-04-14 20:56:10",
        "ends_at": "2026-04-14 21:02:00",
        "adjusted_ends_at": "2026-04-14 21:02:00"
        }
    ]
    }
</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Endpoint</p>
                                <h2 class="mt-1 text-xl font-semibold text-slate-900">POST /api/guide</h2>
                                <p class="mt-2 text-sm text-slate-600">Creates a new guide entry.</p>
                            </div>
                            <span
                                class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700">POST</span>
                        </div>
                        <div class="mt-5 space-y-5">
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Example request</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
                                    <pre class="text-sm leading-6 text-slate-100"><code>POST /api/guide</code></pre>
                                </div>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Request body example</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>{
    "title": "Vakara intervija",
    "channel_nr": 1,
    "starts_at": "2026-04-14 21:05:00",
    "ends_at": "2026-04-14 21:35:00"
    }
</code></pre>
                                </div>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-slate-700">Success response example</p>
                                <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>{
"message": "Guide entry created successfully.",
"data": {
    "id": 99,
    "title": "Vakara intervija",
    "channel_nr": 1,
    "starts_at": "2026-04-14 21:05:00",
    "ends_at": "2026-04-14 21:35:00",
    "adjusted_ends_at": "2026-04-14 21:35:00"
}
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm" id="err">
                    <h2 class="text-xl font-semibold text-slate-900">Error responses</h2>
                    <div class="mt-5 space-y-5">
                        <div class="rounded-2xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-900">401 Unauthorized</h3>
                            <p class="mt-2 text-sm text-slate-600">Missing or invalid API token / missing user code.</p>
                            <div class="mt-3 overflow-x-auto rounded-2xl bg-slate-950 p-4">
                                <pre class="text-sm leading-6 text-slate-100"><code>{"message": "Unauthorized."}</code></pre>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-900">403 Forbidden</h3>
                            <p class="mt-2 text-sm text-slate-600">Provided user code does not belong to the owner of the
                                API key.</p>
                            <div class="mt-3 overflow-x-auto rounded-2xl bg-slate-950 p-4">
                                <pre class="text-sm leading-6 text-slate-100"><code>{"message": "Forbidden."}</code></pre>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-900">422 Validation error</h3>
                            <p class="mt-2 text-sm text-slate-600">Invalid payload or overlapping guide entry.</p>
                            <div class="mt-3 overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>{
    "message": "The given data was invalid.",
    "errors": {
        "starts_at": [
        "Programmas ieraksts pārklājas ar esošu ierakstu."
        ]
    }
    }
</code></pre>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-900">429 Too Many Requests</h3>
                            <p class="mt-2 text-sm text-slate-600">Rate limit exceeded for the API key.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 p-5">
                            <h3 class="text-sm font-semibold text-slate-900">500 Server error</h3>
                            <p class="mt-2 text-sm text-slate-600">Generic production error response without exposing stack
                                traces.</p>
                        </div>
                    </div>
                </div>
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Admin panel</h2>
                        <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-600">
                            <li>• view all users</li>
                            <li>• inspect user details</li>
                            <li>• see API keys assigned to a user</li>
                            <li>• see request logs for each user</li>
                            <li>• delete non-admin users</li>
                        </ul>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-slate-900">Request logging</h2>
                        <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-600">
                            <li>• user ID</li>
                            <li>• API key ID</li>
                            <li>• requested user code</li>
                            <li>• HTTP method</li>
                            <li>• path</li>
                            <li>• status code</li>
                            <li>• duration in milliseconds</li>
                            <li>• IP address</li>
                        </ul>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm" id="curl">
                    <h2 class="text-xl font-semibold text-slate-900">Useful curl examples</h2>

                    <div class="mt-5 space-y-5">
                        <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
                            <pre class="text-sm leading-6 text-slate-100">
<code>curl -H "Authorization: Bearer YOUR_TOKEN" \
-H "X-User-Code: 123456" \
-H "Accept: application/json" \
http://localhost/api/on-air/1</code></pre>
                        </div>
                        <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>curl -H "Authorization: Bearer YOUR_TOKEN" \
-H "X-User-Code: 123456" \
-H "Accept: application/json" \
http://localhost/api/guide/1/2026-04-14
</code></pre>
                        </div>
                        <div class="overflow-x-auto rounded-2xl bg-slate-950 p-4">
<pre class="text-sm leading-6 text-slate-100"><code>curl -X POST http://localhost/api/guide \
    -H "Authorization: Bearer YOUR_TOKEN" \
    -H "X-User-Code: 123456" \
    -H "Accept: application/json" \
    -H "Content-Type: application/json" \
    -d '{
        "title": "Vakara intervija",
        "channel_nr": 1,
        "starts_at": "2026-04-14 21:05:00",
        "ends_at": "2026-04-14 21:35:00"
    }'
</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="space-y-6 lg:sticky lg:top-8 lg:self-start">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Quick navigation</h2>
                    <nav class="mt-4 space-y-2 text-sm">
                        <a href="#owerview"
                            class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Overview
                        </a>
                        <a href="#auth"
                            class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Authentication
                        </a>
                        <a href="#end"
                            class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Endpoints
                        </a>
                        <a href="#err"
                            class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Errors
                        </a>
                        <a href="#curl"
                            class="block rounded-lg px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                            Curl examples
                        </a>
                    </nav>
                </div>
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-amber-800">Important</h2>
                    <p class="mt-3 text-sm leading-6 text-amber-900">
                        Plain text API keys are shown only once after creation. Save them immediately.
                    </p>
                </div>
            </aside>
        </section>
    </div>
@endsection