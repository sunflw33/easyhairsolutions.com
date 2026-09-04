@extends('layouts.app')
@section('title','Create account')
@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-6 py-16">
  <div class="w-full max-w-md rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Start your profile</p>
    <h1 class="mt-2 text-3xl font-semibold tracking-tight">Create your Easyhairsolutions account</h1>
    <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5">
      @csrf
      <div><label class="text-sm font-medium">Name</label><input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3"></div>
      <div><label class="text-sm font-medium">Email</label><input name="email" value="{{ old('email') }}" type="email" required class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3"></div>
      <div><label class="text-sm font-medium">Password</label><input name="password" type="password" required class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3"></div>
      <div><label class="text-sm font-medium">Confirm password</label><input name="password_confirmation" type="password" required class="mt-2 w-full rounded-2xl border border-stone-300 px-4 py-3"></div>
      @if($errors->any()) <div class="rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700">{{ $errors->first() }}</div> @endif
      <button class="w-full rounded-2xl bg-stone-900 px-5 py-3 font-medium text-white">Create account</button>
    </form>
  </div>
</div>
@endsection
