@extends('layouts.app')
@section('title','User Management')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h2>User Management</h2><a class="btn btn-primary" href="{{ route('users.create') }}">+ Add User</a></div>
<div class="card"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th><th></th></tr></thead><tbody>
@foreach($users as $u)<tr><td>{{ $u->name }}</td><td>{{ $u->email }}</td><td><span class="badge bg-{{ $u->role==='admin'?'danger':'secondary' }}">{{ ucfirst($u->role) }}</span></td><td>{{ $u->created_at->format('Y-m-d') }}</td><td>@if($u->id!==auth()->id())<form method="POST" action="{{ route('users.destroy',$u) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this user?')">Delete</button></form>@endif</td></tr>@endforeach
</tbody></table></div><div class="p-3">{{ $users->links() }}</div></div>
@endsection
