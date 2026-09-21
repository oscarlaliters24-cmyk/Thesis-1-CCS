@extends('layouts.app')
@section('content')
<div class="pagehead"><h1>{{ $senior->full_name }}</h1>@if(auth()->user()->isAdmin())<a class="btn" href="{{ route('seniors.edit',$senior) }}">Edit</a>@endif</div>
<div class="panel"><div class="profile">
<p><b>Senior ID:</b> {{ $senior->senior_id }}</p><p><b>Age:</b> {{ $senior->age }}</p><p><b>Sex:</b> {{ $senior->sex }}</p><p><b>Barangay:</b> {{ $senior->barangay }}</p><p><b>Address:</b> {{ $senior->address }}</p><p><b>Pension:</b> {{ $senior->pension_status }}</p><p><b>PhilHealth:</b> {{ $senior->philhealth_status }}</p>
</div><h2>QR Code</h2><div id="senior-qr" class="qrbox"></div><p class="muted">Token: <code>{{ $senior->qr_code }}</code></p></div>
<div class="panel"><h2>Benefits</h2><div class="tablewrap"><table><tr><th>Type</th><th>Amount</th><th>Date</th><th>Status</th></tr>@forelse($senior->benefits as $b)<tr><td>{{ $b->benefit_type }}</td><td>₱{{ number_format($b->amount,2) }}</td><td>{{ $b->distribution_date->format('M d, Y') }}</td><td>{{ $b->status }}</td></tr>@empty<tr><td colspan="4">No benefits recorded.</td></tr>@endforelse</table></div></div>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>new QRCode(document.getElementById('senior-qr'), {text:@json($senior->qr_code), width:180, height:180});</script>
@endsection
