@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Dashboard</h2><span class="text-muted">{{ now()->format('F d, Y') }}</span></div>
<div class="row g-3 mb-4">
@foreach([['Total Registered',$stats['total'],'primary'],['Active Records',$stats['active'],'success'],['Pension Enrolled',$stats['pensioners'],'warning'],['Benefits Claimed',$stats['benefits'],'info']] as [$label,$value,$color])
<div class="col-md-3"><div class="card border-0 shadow-sm"><div class="card-body"><div class="text-muted">{{ $label }}</div><div class="display-6 fw-bold text-{{ $color }}">{{ $value }}</div></div></div></div>
@endforeach
</div>
<div class="card shadow-sm"><div class="card-header fw-bold">Senior Citizens by Barangay</div><div class="card-body">
<table class="table table-hover"><thead><tr><th>Barangay</th><th>Total</th></tr></thead><tbody>
@forelse($barangayCounts as $row)<tr><td>{{ $row->barangay }}</td><td>{{ $row->total }}</td></tr>@empty<tr><td colspan="2">No data.</td></tr>@endforelse
</tbody></table></div></div>
@endsection