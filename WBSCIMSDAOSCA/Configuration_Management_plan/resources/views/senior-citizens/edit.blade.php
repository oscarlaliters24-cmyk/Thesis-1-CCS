@extends('layouts.app')
@section('title','Edit Record')
@section('content')<h2 class="mb-3">Edit Senior Citizen</h2><div class="card"><div class="card-body"><form method="POST" action="{{ route('senior-citizens.update',$seniorCitizen) }}">@method('PUT')@csrf
<div class="row g-3">
<div class="col-md-3"><label class="form-label">OSCA ID *</label><input name="osca_id" value="{{ old('osca_id',$seniorCitizen->osca_id ?? '') }}" class="form-control" required></div>
<div class="col-md-3"><label class="form-label">First Name *</label><input name="first_name" value="{{ old('first_name',$seniorCitizen->first_name ?? '') }}" class="form-control" required></div>
<div class="col-md-3"><label class="form-label">Middle Name</label><input name="middle_name" value="{{ old('middle_name',$seniorCitizen->middle_name ?? '') }}" class="form-control"></div>
<div class="col-md-3"><label class="form-label">Last Name *</label><input name="last_name" value="{{ old('last_name',$seniorCitizen->last_name ?? '') }}" class="form-control" required></div>
<div class="col-md-2"><label class="form-label">Suffix</label><input name="suffix" value="{{ old('suffix',$seniorCitizen->suffix ?? '') }}" class="form-control"></div>
<div class="col-md-3"><label class="form-label">Birth Date *</label><input type="date" name="birth_date" value="{{ old('birth_date',isset($seniorCitizen)?$seniorCitizen->birth_date?->format('Y-m-d'):'') }}" class="form-control" required></div>
<div class="col-md-3"><label class="form-label">Sex *</label><select name="sex" class="form-select" required>@foreach(['Male','Female','Other'] as $v)<option {{ old('sex',$seniorCitizen->sex ?? '')==$v?'selected':'' }}>{{ $v }}</option>@endforeach</select></div>
<div class="col-md-4"><label class="form-label">Civil Status *</label><select name="civil_status" class="form-select" required>@foreach(['Single','Married','Widowed','Separated','Divorced'] as $v)<option {{ old('civil_status',$seniorCitizen->civil_status ?? '')==$v?'selected':'' }}>{{ $v }}</option>@endforeach</select></div>
<div class="col-md-4"><label class="form-label">Barangay *</label><input name="barangay" value="{{ old('barangay',$seniorCitizen->barangay ?? '') }}" class="form-control" required></div>
<div class="col-md-8"><label class="form-label">Address *</label><input name="address" value="{{ old('address',$seniorCitizen->address ?? '') }}" class="form-control" required></div>
<div class="col-md-4"><label class="form-label">Contact Number</label><input name="contact_number" value="{{ old('contact_number',$seniorCitizen->contact_number ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email',$seniorCitizen->email ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">PhilHealth Number</label><input name="philhealth_number" value="{{ old('philhealth_number',$seniorCitizen->philhealth_number ?? '') }}" class="form-control"></div>
<div class="col-md-4"><label class="form-label">Pension Type</label><input name="pension_type" value="{{ old('pension_type',$seniorCitizen->pension_type ?? '') }}" class="form-control"></div>
<div class="col-md-4 pt-4"><div class="form-check"><input type="hidden" name="pension_enrolled" value="0"><input class="form-check-input" type="checkbox" name="pension_enrolled" value="1" {{ old('pension_enrolled',$seniorCitizen->pension_enrolled ?? false)?'checked':'' }}><label class="form-check-label">Pension enrolled</label></div></div>
</div>
<button class="btn btn-primary mt-4">{{ isset($seniorCitizen)?'Update':'Register' }}</button>
<a href="{{ route('senior-citizens.index') }}" class="btn btn-secondary mt-4">Cancel</a>
</form></div></div>@endsection