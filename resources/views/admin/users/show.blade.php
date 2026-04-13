@extends('layouts.app')

@section('content')
    <h1>Admin — Lietotājs: {{ $user->name }}</h1>

    <section>
        <h2>Pamatinformācija</h2>
        <p>ID: {{ $user->id }}</p>
        <p>User code: {{ $user->user_code }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Admin: {{ $user->is_admin ? 'Yes' : 'No' }}</p>
        <p>Created at: {{ $user->created_at }}</p>
    </section>

    <section>
        <h2>API keys</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Prefix</th>
                    <th>Last used</th>
                    <th>Revoked</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->apiKeys as $apiKey)
                    <tr>
                        <td>{{ $apiKey->name }}</td>
                        <td>{{ $apiKey->key_prefix }}</td>
                        <td>{{ $apiKey->last_used_at ?? '—' }}</td>
                        <td>{{ $apiKey->revoked_at ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section>
        <h2>Request logi</h2>

        <table>
            <thead>
                <tr>
                    <th>Method</th>
                    <th>Path</th>
                    <th>Status</th>
                    <th>Requested user code</th>
                    <th>Duration</th>
                    <th>IP</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requestLogs as $log)
                    <tr>
                        <td>{{ $log->method }}</td>
                        <td>{{ $log->path }}</td>
                        <td>{{ $log->status_code }}</td>
                        <td>{{ $log->requested_user_code ?? '—' }}</td>
                        <td>{{ $log->duration_ms }} ms</td>
                        <td>{{ $log->ip_address ?? '—' }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $requestLogs->links() }}
        </div>
    </section>

    @if(!$user->is_admin)
        <section>
            <h2>Bīstamā zona</h2>

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Tiešām dzēst lietotāju?')">
                    Dzēst lietotāju
                </button>
            </form>
        </section>
    @endif
@endsection