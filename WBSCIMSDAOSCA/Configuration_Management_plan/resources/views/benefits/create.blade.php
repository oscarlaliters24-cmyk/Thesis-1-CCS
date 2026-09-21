@extends('layouts.app')
@section('title','Add Benefit')
@section('content')
<h2>Add Benefit</h2>
<form method="POST" action="{{ route('benefits.store') }}" class="card card-body mt-3">
@csrf
<div class="mb-3"><label class="form-label">Senior Citizen *</label><select name="senior_citizen_id" class="form-select" required><option value="">Select</option>@foreach($seniorCitizens as $p)<option value="{{ $p->id }}">{{ $p->osca_id }} — {{ $p->full_name }}</option>@endforeach</select></div>
<div class="mb-3"><label class="form-label">Benefit Type *</label><input name="benefit_type" class="form-control" required></div>
<div class="mb-3"><label class="form-label">Amount</label><input name="amount" type="number" step="0.01" min="0" class="form-control"></div>
<div class="mb-3"><label class="form-label">Remarks</label><textarea name="remarks" class="form-control"></textarea></div>
<button class="btn btn-primary">Save</button>
</form>
@endsection