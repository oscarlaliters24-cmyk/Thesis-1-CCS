@extends('layouts.app')
@section('content')<h1>Add Benefit</h1><div class="panel"><form method="POST" action="{{ route('benefits.store') }}">@csrf
<label>Senior Citizen<select name="senior_citizen_id">@foreach($seniors as $s)<option value="{{ $s->id }}">{{ $s->full_name }} — {{ $s->senior_id }}</option>@endforeach</select></label>
<label>Benefit Type<input name="benefit_type" required></label><label>Amount<input type="number" step="0.01" name="amount" required></label>
<label>Distribution Date<input type="date" name="distribution_date" value="{{ now()->toDateString() }}" required></label>
<label>Status<select name="status"><option>Pending</option><option>Paid</option><option>Cancelled</option></select></label>
<label>Notes<textarea name="notes"></textarea></label><button class="btn">Save Benefit</button>
</form></div>@endsection
