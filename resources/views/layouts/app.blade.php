<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Easyhairsolutions — beautifully simple hair appointments and salon essentials.">
    <title>{{ $title ?? 'Easyhairsolutions' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<nav class="sticky top-0 z-40 border-b border-line/80 bg-[#fbfaf7]/90 backdrop-blur-xl">
 <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
  <a href="{{ route('home') }}" class="text-2xl font-semibold tracking-[-.04em] text-deep">Easy<span class="text-gold">HairSolutions</span></a>
  <div class="hidden items-center gap-7 md:flex text-sm font-medium">
   <a href="{{ route('services') }}" class="hover:text-sage">Services</a><a href="{{ route('shop') }}" class="hover:text-sage">Shop</a><a href="{{ route('booking.create') }}" class="hover:text-sage">Book</a>
  </div>
  <div class="flex items-center gap-2">
   <a href="{{ route('cart.index') }}" class="hidden rounded-full px-3 py-2 text-sm md:block">Bag ({{ array_sum(session('cart', [])) }})</a>
   @auth
    <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
   @else
    <a href="{{ route('login') }}" class="hidden px-3 py-2 text-sm md:block">Sign in</a><a href="{{ route('register') }}" class="btn-primary">Get started</a>
   @endauth
   <button data-menu-toggle="mobile-nav" class="rounded-full border border-line p-2 md:hidden" aria-label="Menu">☰</button>
  </div>
 </div>
 <div id="mobile-nav" class="hidden border-t border-line bg-white px-5 py-4 md:hidden"><div class="grid gap-3 text-sm"><a href="{{ route('services') }}">Services</a><a href="{{ route('shop') }}">Shop</a><a href="{{ route('booking.create') }}">Book</a>@auth<a href="{{ route('dashboard') }}">Dashboard</a>@else<a href="{{ route('login') }}">Sign in</a>@endauth</div></div>
</nav>
@if(session('status'))<div class="mx-auto max-w-7xl px-5 pt-5 lg:px-8"><div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</div></div>@endif
<main>@yield('content')</main>
<footer class="mt-20 border-t border-line bg-white"><div class="mx-auto flex max-w-7xl flex-col gap-5 px-5 py-10 text-sm md:flex-row md:items-center md:justify-between lg:px-8"><div><div class="text-lg font-semibold text-deep">our<span class="text-gold">Easyhairsolutions</span></div><p class="mt-1 text-gray-500">Beautiful appointments. Thoughtful care.</p></div><div class="flex gap-5 text-gray-500"><a href="{{ route('services') }}">Services</a><a href="{{ route('shop') }}">Shop</a><a href="{{ route('booking.create') }}">Book</a></div></div></footer>
</body></html>
