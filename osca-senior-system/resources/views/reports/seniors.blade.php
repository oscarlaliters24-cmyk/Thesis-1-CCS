@extends('layouts.app')
@section('content')<div class="pagehead"><h1>Senior Citizen Master List</h1><button onclick="window.print()" class="btn">Print</button></div>
<div class="panel"><table><tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Barangay</th><th>Pension</th><th>PhilHealth</th></tr>@foreach($seniors as $s)<tr><td>{{ $s->senior_id }}</td><td>{{ $s->full_name }}</td><td>{{ $s->age }}</td><td>{{ $s->sex }}</td><td>{{ $s->barangay }}</td><td>{{ $s->pension_status }}</td><td>{{ $s->philhealth_status }}</td></tr>@endforeach</table></div>@endsection
