@extends('layouts.app')
@section('title',$seniorCitizen->full_name)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h2>{{ $seniorCitizen->full_name }}</h2><div><a class="btn btn-outline-primary" href="{{ route('senior-citizens.qr',$seniorCitizen) }}">QR Code</a> <a class="btn btn-primary" href="{{ route('senior-citizens.edit',$seniorCitizen) }}">Edit</a></div></div>
<div class="card shadow-sm mb-4"><div class="card-body"><div class="row g-3">
@foreach([['OSCA ID',$seniorCitizen->osca_id],['Birth Date',$seniorCitizen->birth_date?->format('F d, Y')],['Age',$seniorCitizen->age],['Sex',$seniorCitizen->sex],['Civil Status',$seniorCitizen->civil_status],['Barangay',$seniorCitizen->barangay],['Address',$seniorCitizen->address],['Contact',$seniorCitizen->contact_number],['PhilHealth',$seniorCitizen->philhealth_number],['Pension',$seniorCitizen->pension_enrolled?'Yes':'No']] as [$label,$value])
<div class="col-md-4"><small class="text-muted">{{ $label }}</small><div class="fw-semibold">{{ $value ?: '—' }}</div></div>
@endforeach
</div></div></div>
<h4>Benefits</h4><div class="card"><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Type</th><th>Amount</th><th>Status</th><th>Claimed</th></tr></thead><tbody>
@forelse($seniorCitizen->benefits as $b)<tr><td>{{ $b->benefit_type }}</td><td>{{ number_format($b->amount ?? 0,2) }}</td><td>{{ ucfirst($b->status) }}</td><td>{{ $b->claimed_at?->format('Y-m-d H:i') ?? '—' }}</td></tr>@empty<tr><td colspan="4">No benefit records.</td></tr>@endforelse
</tbody></table></div></div>
@endsection