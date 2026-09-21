@extends('layouts.app')
@section('title','Audit Logs')
@section('content')
<h2>Audit Logs</h2><div class="card mt-3"><div class="table-responsive"><table class="table table-sm mb-0"><thead><tr><th>Date</th><th>User</th><th>Action</th><th>Description</th><th>IP</th></tr></thead><tbody>
@forelse($logs as $log)<tr><td>{{ $log->created_at->format('Y-m-d H:i') }}</td><td>{{ $log->user?->name ?? 'System' }}</td><td>{{ $log->action }}</td><td>{{ $log->description }}</td><td>{{ $log->ip_address }}</td></tr>@empty<tr><td colspan="5">No audit entries.</td></tr>@endforelse
</tbody></table></div><div class="p-3">{{ $logs->links() }}</div></div>
@endsection
