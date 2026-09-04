@extends('layouts.app')
@section('title','Sign in')
@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-6 py-16">
  <div class="w-full max-w-md rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Welcome back</p>
    <h1 class="mt-2 text-3xl font-semibold tracking-tight">Sign in to Easyhairsolutions</h1>
    <p class="mt-2 text-sm text-stone-500">Manage appointments, purchases, and your beauty profile.</p>
    @if($errors->any()) <div class="mt-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
      @csrf
      <div><label class="text-sm font-medium">Email</label><input name="email" value="{{ old('email') }}" type="email" required class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900"></div>
      <div><label class="text-sm font-medium">Password</label><input name="password" type="password" required class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3 outline-none focus:border-stone-900"></div>
      <label class="flex items-center gap-2 text-sm text-stone-600"><input type="checkbox" name="remember" value="1"> Remember me</label>
      <button class="w-full rounded-2xl bg-stone-900 px-5 py-3 font-medium text-white hover:bg-stone-700">Sign in</button>
    </form>
    <p class="mt-6 text-center text-sm text-stone-500">New here? <a href="{{ route('register') }}" class="font-semibold text-stone-900">Create an account</a></p>
  </div>
</div>
@endsection
