@extends('layouts.app')
@section('title','QR Code')
@section('content')
<div class="text-center">
<h2>{{ $seniorCitizen->full_name }}</h2>
<p class="text-muted">{{ $seniorCitizen->osca_id }}</p>
<div class="card d-inline-block shadow-sm"><div class="card-body">
{!! QrCode::size(280)->generate(route('senior-citizens.verify', $seniorCitizen->qr_token)) !!}
</div></div>
<p class="mt-3">Scan this code to verify the active OSCA record.</p>
</div>
@endsection