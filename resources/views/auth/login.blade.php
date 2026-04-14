@extends('layouts.guest')

@section('content')
    <div>
        <h2 class="text-lg font-semibold text-slate-900">Pieteikties</h2>
        <p class="mt-1 text-sm text-slate-500">
            Ievadi savus piekļuves datus.
        </p>
    </div>
    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-slate-700">
                E-pasts
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm shadow-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">
                Parole
            </label>
            <input type="password" name="password" required class="mt-1 w-full rounded-xl border border-slate-300 px-3 py-2 text-sm shadow-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
        </div>
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
                Atcerēties mani
            </label>
        </div>
        <button type="submit" class="w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800">
            Pieteikties
        </button>
    </form>
    <p class="mt-6 text-center text-sm text-slate-600">
        Nav konta?
        <a href="{{ route('register') }}" class="font-medium text-slate-900 hover:underline">
            Reģistrēties
        </a>
    </p>
@endsection