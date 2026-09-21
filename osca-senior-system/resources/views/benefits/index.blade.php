@extends('layouts.app')
@section('content')
<div class="pagehead"><h1>Benefits</h1>@if(auth()->user()->isAdmin())<a class="btn" href="{{ route('benefits.create') }}">+ Add Benefit</a>@endif</div>
<div class="panel tablewrap"><table><tr><th>Senior</th><th>Benefit</th><th>Amount</th><th>Date</th><th>Status</th></tr>
@forelse($benefits as $b)<tr><td>{{ $b->senior?->full_name }}</td><td>{{ $b->benefit_type }}</td><td>₱{{ number_format($b->amount,2) }}</td><td>{{ $b->distribution_date->format('M d, Y') }}</td><td>{{ $b->status }}</td></tr>@empty<tr><td colspan="5">No benefit records yet.</td></tr>@endforelse</table>{{ $benefits->links() }}</div>
@endsection
