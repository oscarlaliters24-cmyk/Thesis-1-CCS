<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $title ?? 'OSCA System' }}</title><link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="sidebar">
    <div class="brand">OSCA<br><small>Senior Citizen System</small></div>
    <nav>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('seniors.index') }}">Senior Citizens</a>
        <a href="{{ route('benefits.index') }}">Benefits</a>
        <a href="{{ route('qr.index') }}">QR Verification</a>
        <a href="{{ route('reports.index') }}">Reports</a>
    </nav>
    <div class="userbox">
        <strong>{{ auth()->user()->name }}</strong><br>
        <span class="rolebadge">{{ strtoupper(auth()->user()->role) }}</span>
        <form method="POST" action="{{ route('logout') }}" style="margin-top:10px">@csrf<button style="background:#475569">Logout</button></form>
    </div>
</div>
<main class="main">
<header><strong>{{ $title ?? 'Dashboard' }}</strong><span>{{ now()->format('F d, Y') }}</span></header>
@if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alert error"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
@yield('content')
</main>
</body></html>
