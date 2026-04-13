@extends('layouts.guest')

@section('content')
    <h1>Reģistrācija</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Vārds" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="E-pasts" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Parole" required>
        <input type="password" name="password_confirmation" placeholder="Atkārtot paroli" required>
        <button type="submit">Izveidot kontu</button>
    </form>
@endsection