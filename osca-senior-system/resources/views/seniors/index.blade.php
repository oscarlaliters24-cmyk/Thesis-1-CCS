@extends('layouts.app')
@section('content')
<div class="pagehead"><h1>Senior Citizens</h1>@if(auth()->user()->isAdmin())<a class="btn" href="{{ route('seniors.create') }}">+ Register Senior</a>@endif</div>
<form class="search" method="GET"><input name="q" value="{{ $q }}" placeholder="Search ID, name, barangay"><button>Search</button></form>
<div class="panel tablewrap"><table><tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Barangay</th><th>Status</th><th>Action</th></tr>
@forelse($seniors as $s)<tr><td>{{ $s->senior_id }}</td><td>{{ $s->full_name }}</td><td>{{ $s->age }}</td><td>{{ $s->sex }}</td><td>{{ $s->barangay }}</td><td>{{ ucfirst($s->status) }}</td><td><a href="{{ route('seniors.show',$s) }}">View</a></td></tr>
@empty<tr><td colspan="7">No records found.</td></tr>@endforelse</table>{{ $seniors->links() }}</div>
@endsection
