@extends('layouts.app')
@section('title','QR Verification')
@section('content')
<div class="row justify-content-center"><div class="col-md-7">
<div class="card shadow-sm">
<div class="card-body">
@if($seniorCitizen)
<div class="alert alert-success">QR verification successful.</div>
<h3>{{ $seniorCitizen->full_name }}</h3>
<table class="table">
<tr><th>OSCA ID</th><td>{{ $seniorCitizen->osca_id }}</td></tr>
<tr><th>Age</th><td>{{ $seniorCitizen->age }}</td></tr>
<tr><th>Barangay</th><td>{{ $seniorCitizen->barangay }}</td></tr>
<tr><th>Status</th><td>Active</td></tr>
</table>
@else
<div class="alert alert-danger">Invalid or inactive QR code.</div>
@endif
</div></div></div></div>
@endsection