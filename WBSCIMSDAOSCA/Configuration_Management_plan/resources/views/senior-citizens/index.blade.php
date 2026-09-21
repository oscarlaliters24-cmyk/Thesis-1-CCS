@extends('layouts.app')
@section('title','Senior Citizens')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h2>Senior Citizen Records</h2><a class="btn btn-primary" href="{{ route('senior-citizens.create') }}">+ Register</a></div>
<form class="row g-2 mb-3"><div class="col-md-6"><input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search OSCA ID, name, barangay"></div><div class="col-auto"><button class="btn btn-outline-primary">Search</button></div></form>
<div class="card shadow-sm"><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>OSCA ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Barangay</th><th>Status</th><th></th></tr></thead><tbody>
@forelse($seniorCitizens as $p)<tr><td>{{ $p->osca_id }}</td><td>{{ $p->full_name }}</td><td>{{ $p->age }}</td><td>{{ $p->sex }}</td><td>{{ $p->barangay }}</td><td><span class="badge bg-{{ $p->is_active?'success':'secondary' }}">{{ $p->is_active?'Active':'Inactive' }}</span></td><td><a class="btn btn-sm btn-outline-primary" href="{{ route('senior-citizens.show',$p) }}">View</a></td></tr>@empty<tr><td colspan="7" class="text-center p-4">No records found.</td></tr>@endforelse
</tbody></table></div><div class="p-3">{{ $seniorCitizens->links() }}</div></div>
@endsection