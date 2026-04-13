@extends('layouts.app')

@section('content')
    <h1>Admin — Lietotāji</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User code</th>
                <th>Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>API keys</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->user_code }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->api_keys_count }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}">Skatīt</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $users->links() }}
    </div>
@endsection