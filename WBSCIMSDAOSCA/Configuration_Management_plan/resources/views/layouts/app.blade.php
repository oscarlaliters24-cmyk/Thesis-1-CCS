<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ config('app.name') }} - @yield('title','Dashboard')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="d-flex min-vh-100">
@auth
<aside class="sidebar bg-dark text-white p-3 d-none d-lg-block">
<a class="navbar-brand text-white fw-bold d-block mb-4" href="{{ route('dashboard') }}">OSCA IMS</a>
<div class="small text-uppercase text-secondary mb-2">Main</div>
<nav class="nav flex-column gap-1">
<a class="nav-link text-white rounded {{ request()->routeIs('dashboard')?'active-link':'' }}" href="{{ route('dashboard') }}">Dashboard</a>
<a class="nav-link text-white rounded" href="{{ route('senior-citizens.index') }}">Senior Citizens</a>
<a class="nav-link text-white rounded" href="{{ route('senior-citizens.scanner') }}">QR Scanner</a>
<a class="nav-link text-white rounded" href="{{ route('benefits.index') }}">Benefits</a>
<a class="nav-link text-white rounded" href="{{ route('analytics.index') }}">Analytics</a>
<a class="nav-link text-white rounded" href="{{ route('reports.index') }}">Reports</a>
@if(auth()->user()->role==='admin')
<div class="small text-uppercase text-secondary mt-3 mb-2">Administration</div>
<a class="nav-link text-white rounded" href="{{ route('users.index') }}">User Management</a>
<a class="nav-link text-white rounded" href="{{ route('audit-logs.index') }}">Audit Logs</a>
@endif
</nav>
</aside>
@endauth
<div class="flex-grow-1">
<nav class="navbar navbar-light bg-white border-bottom px-3">
<div class="container-fluid">
<span class="fw-semibold">@yield('title','Dashboard')</span>
@auth
<div class="d-flex align-items-center gap-3"><span class="text-muted d-none d-md-inline">{{ auth()->user()->name }} · {{ ucfirst(auth()->user()->role) }}</span>
<form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-sm btn-outline-danger">Logout</button></form></div>
@endauth
</div>
</nav>
<main class="container-fluid p-4">
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
@yield('content')
</main>
</div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body></html>
