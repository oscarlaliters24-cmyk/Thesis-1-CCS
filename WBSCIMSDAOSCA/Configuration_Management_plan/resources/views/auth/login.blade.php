@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="row justify-content-center mt-5">
<div class="col-md-5">
<div class="card shadow-sm">
<div class="card-body p-4">
<h3 class="mb-1">OSCA Information Management System</h3>
<p class="text-muted">Staff and administrator login</p>
<form method="POST" action="{{ route('login.store') }}">
@csrf
<div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" required></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="remember" id="remember"><label class="form-check-label" for="remember">Remember me</label></div>
<button class="btn btn-primary w-100">Login</button>
</form>
</div></div></div></div>
@endsection