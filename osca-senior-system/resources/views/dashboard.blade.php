@extends('layouts.app')
@section('content')
<div class="pagehead">
    <div><h1>Senior Citizen Dashboard</h1><p class="muted">Analytics overview for the OSCA Senior Citizen Information Management System.</p></div>
</div>
<div class="cards">
<div class="card"><span>Total Seniors</span><b>{{ $totalSeniors }}</b></div>
<div class="card"><span>Male</span><b>{{ $male }}</b></div>
<div class="card"><span>Female</span><b>{{ $female }}</b></div>
<div class="card"><span>Benefits Paid</span><b>₱{{ number_format($benefits,2) }}</b></div>
</div>
<div class="chartgrid">
<section class="panel"><h2>Senior Citizens by Sex</h2><canvas id="genderChart"></canvas></section>
<section class="panel"><h2>Benefit Status</h2><canvas id="benefitChart"></canvas></section>
</div>
<div class="grid2">
<section class="panel"><h2>Registrations by Barangay</h2>
@forelse($barangays as $b)
<div class="barrow"><span>{{ $b->barangay }}</span><div><i style="width:{{ $totalSeniors ? min(100,($b->total/$totalSeniors)*100) : 0 }}%"></i></div><b>{{ $b->total }}</b></div>
@empty<p>No records yet.</p>@endforelse
</section>
<section class="panel"><h2>Recent Senior Citizens</h2>
<table><tr><th>ID</th><th>Name</th><th>Barangay</th></tr>
@forelse($recentSeniors as $s)<tr><td>{{ $s->senior_id }}</td><td>{{ $s->full_name }}</td><td>{{ $s->barangay }}</td></tr>@empty<tr><td colspan="3">No records yet.</td></tr>@endforelse
</table></section>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const genderData = { labels: ['Male','Female'], datasets: [{ label: 'Senior Citizens', data: [{{ $male }}, {{ $female }}] }] };
const benefitLabels = @json($benefitStatus->pluck('status')->values());
const benefitValues = @json($benefitStatus->pluck('total')->values());
new Chart(document.getElementById('genderChart'), { type:'doughnut', data:genderData, options:{responsive:true, plugins:{legend:{position:'bottom'}}} });
new Chart(document.getElementById('benefitChart'), { type:'bar', data:{labels:benefitLabels,datasets:[{label:'Records',data:benefitValues}]}, options:{responsive:true, scales:{y:{beginAtZero:true, ticks:{precision:0}}}} });
</script>
@endsection
