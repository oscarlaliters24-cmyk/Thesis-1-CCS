@extends('layouts.app')
@section('content')<h1>Edit Senior Citizen</h1><div class="panel"><form method="POST" action="{{ route('seniors.update',$senior) }}">@csrf @method('PUT')<div class="formgrid">
<label>First Name<input name="first_name" value="{{ old('first_name',$senior->first_name ?? '') }}" required></label>
<label>Middle Name<input name="middle_name" value="{{ old('middle_name',$senior->middle_name ?? '') }}"></label>
<label>Last Name<input name="last_name" value="{{ old('last_name',$senior->last_name ?? '') }}" required></label>
<label>Birth Date<input type="date" name="birth_date" value="{{ old('birth_date',isset($senior)?$senior->birth_date->format('Y-m-d'):'') }}" required></label>
<label>Sex<select name="sex"><option>Male</option><option>Female</option></select></label>
<label>Barangay<input name="barangay" value="{{ old('barangay',$senior->barangay ?? '') }}" required></label>
<label>Address<input name="address" value="{{ old('address',$senior->address ?? '') }}" required></label>
<label>Pension Status<select name="pension_status"><option>Yes</option><option>No</option></select></label>
<label>PhilHealth Status<select name="philhealth_status"><option>Yes</option><option>No</option></select></label>
<label>Status<select name="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></label>
</div>
<button class="btn">Save Record</button>
</form></div>@endsection
