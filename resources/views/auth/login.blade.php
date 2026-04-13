@extends('layouts.guest')

@section('content')
    <h1>Pieteikties</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="E-pasts" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Parole" required>
        <label>
            <input type="checkbox" name="remember" value="1"> Atcerēties mani
        </label>
        <button type="submit">Login</button>
    </form>

    <a href="{{ route('register') }}">Reģistrēties</a>
@endsection