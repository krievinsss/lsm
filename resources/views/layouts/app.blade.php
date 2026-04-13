<!doctype html>
<html lang="lv">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <nav>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
        <main>
            @if(session('status'))
                <div>{{ session('status') }}</div>
            @endif
            @yield('content')
        </main>
    </body>
</html>