@extends('layouts.app')
@section('title','Reports')
@section('content')
<h2>Reports</h2>
<div class="row g-3 mt-2">
<div class="col-md-4"><div class="card"><div class="card-body"><small class="text-muted">Total records</small><h2>{{ $total }}</h2></div></div></div>
<div class="col-md-4"><div class="card"><div class="card-body"><small class="text-muted">Active records</small><h2>{{ $active }}</h2></div></div></div>
</div>
<div class="card mt-4"><div class="card-body"><h5>Senior Citizen Master List</h5><p class="text-muted">Exports current records as CSV.</p><a class="btn btn-primary" href="{{ route('reports.senior-citizens.csv') }}">Download CSV</a></div></div>
@endsection