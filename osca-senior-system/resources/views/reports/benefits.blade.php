@extends('layouts.app')
@section('content')<div class="pagehead"><h1>Benefits Distribution Report</h1><button onclick="window.print()" class="btn">Print</button></div>
<div class="panel"><table><tr><th>Date</th><th>Senior</th><th>Benefit</th><th>Amount</th><th>Status</th></tr>@foreach($benefits as $b)<tr><td>{{ $b->distribution_date->format('M d, Y') }}</td><td>{{ $b->senior?->full_name }}</td><td>{{ $b->benefit_type }}</td><td>₱{{ number_format($b->amount,2) }}</td><td>{{ $b->status }}</td></tr>@endforeach</table></div>@endsection
