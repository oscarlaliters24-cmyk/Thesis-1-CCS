@extends('layouts.app')
@section('title','Benefits')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h2>Benefits Monitoring</h2><a class="btn btn-primary" href="{{ route('benefits.create') }}">+ Add Benefit</a></div>
<div class="card"><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Senior Citizen</th><th>Benefit</th><th>Amount</th><th>Status</th><th>Claimed</th><th>Action</th></tr></thead><tbody>
@forelse($benefits as $b)<tr><td>{{ $b->seniorCitizen->full_name }}</td><td>{{ $b->benefit_type }}</td><td>₱{{ number_format($b->amount ?? 0,2) }}</td><td>{{ ucfirst($b->status) }}</td><td>{{ $b->claimed_at?->format('Y-m-d') ?? '—' }}</td><td>@if($b->status==='pending')<form method="POST" action="{{ route('benefits.claim',$b) }}">@csrf<button class="btn btn-sm btn-success">Mark Claimed</button></form>@endif</td></tr>@empty<tr><td colspan="6">No benefits found.</td></tr>@endforelse
</tbody></table></div><div class="p-3">{{ $benefits->links() }}</div></div>
@endsection