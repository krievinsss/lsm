@extends('layouts.app')

@section('content')
    <h1>API Keys</h1>

    @if($newToken)
        <div>
            <strong>Jaunā API atslēga:</strong>
            <code>{{ $newToken }}</code>
            <p>Saglabā tagad. Vēlāk tā vairs netiks parādīta.</p>
        </div>
    @endif

    <form method="POST" action="{{ route('api-keys.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Atslēgas nosaukums" required>
        <button type="submit">Izveidot API atslēgu</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Prefix</th>
                <th>Last used</th>
                <th>Revoked</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($apiKeys as $apiKey)
                <tr>
                    <td>{{ $apiKey->name }}</td>
                    <td>{{ $apiKey->key_prefix }}</td>
                    <td>{{ $apiKey->last_used_at ?? '—' }}</td>
                    <td>{{ $apiKey->revoked_at ?? '—' }}</td>
                    <td>
                        @if(!$apiKey->revoked_at)
                            <form method="POST" action="{{ route('api-keys.destroy', $apiKey) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Revoke</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection