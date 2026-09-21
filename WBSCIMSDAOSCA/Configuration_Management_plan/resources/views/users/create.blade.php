@extends('layouts.app')
@section('title','Add User')
@section('content')
<h2>Add User</h2><form method="POST" action="{{ route('users.store') }}" class="card card-body mt-3">
@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Password</label><input name="password" type="password" class="form-control" required minlength="8"></div>
<div class="col-md-6"><label class="form-label">Confirm Password</label><input name="password_confirmation" type="password" class="form-control" required></div>
<div class="col-md-4"><label class="form-label">Role</label><select name="role" class="form-select"><option value="staff">Staff</option><option value="admin">Admin</option></select></div>
</div><button class="btn btn-primary mt-4">Create User</button>
</form>
@endsection
