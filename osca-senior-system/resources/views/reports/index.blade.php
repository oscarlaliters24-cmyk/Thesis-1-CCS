@extends('layouts.app')
@section('content')<h1>Reports</h1><div class="cards">
<a class="card linkcard" href="{{ route('reports.seniors') }}">Senior Citizen Master List</a>
<a class="card linkcard" href="{{ route('reports.benefits') }}">Benefits Distribution Report</a>
</div>@endsection
