@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <section>
        <h2>Lietotāja informācija</h2>
        <p>User code: <strong>{{ auth()->user()->user_code }}</strong></p>
        <p>Role: <strong>{{ auth()->user()->is_admin ? 'Admin' : 'User' }}</strong></p>

        @if(auth()->user()->is_admin)
            <p>
                <a href="{{ route('admin.users.index') }}">Atvērt admin paneli</a>
            </p>
        @endif
    </section>

    <section>
        <h2>API Keys</h2>
        <p>Kopā: {{ $apiKeysCount }}</p>
        <a href="{{ route('api-keys.index') }}">Pārvaldīt API atslēgas</a>
    </section>

    <section>
        <h2>Telemetry</h2>
        <p>Requests today: {{ $requestsToday }}</p>

        <ul>
            @foreach($statusCounts as $status => $count)
                <li>{{ $status }}: {{ $count }}</li>
            @endforeach
        </ul>
    </section>

    <section>
        <h2>Quick start</h2>
        <pre>X-User-Code: {{ auth()->user()->user_code }}</pre>
        <pre>Authorization: Bearer YOUR_API_KEY</pre>
        <pre>GET /api/guide/1/2024-01-01</pre>
    </section>

    <section>
        <h2>Recent API requests</h2>

        <table>
            <thead>
                <tr>
                    <th>Method</th>
                    <th>Path</th>
                    <th>Status</th>
                    <th>User code</th>
                    <th>Duration</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRequests as $request)
                    <tr>
                        <td>{{ $request->method }}</td>
                        <td>{{ $request->path }}</td>
                        <td>{{ $request->status_code }}</td>
                        <td>{{ $request->requested_user_code ?? '—' }}</td>
                        <td>{{ $request->duration_ms }} ms</td>
                        <td>{{ $request->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection