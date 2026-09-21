@extends('layouts.app')
@section('title','Analytics')
@section('content')
<h2 class="mb-4">Web Analytics Dashboard</h2>
<div class="row g-4">
<div class="col-md-6"><div class="card"><div class="card-header">By Sex</div><div class="card-body"><canvas id="sexChart"></canvas></div></div></div>
<div class="col-md-6"><div class="card"><div class="card-header">Pension Enrollment</div><div class="card-body"><canvas id="pensionChart"></canvas></div></div></div>
<div class="col-12"><div class="card"><div class="card-header">Senior Citizens by Barangay</div><div class="card-body"><canvas id="barangayChart"></canvas></div></div></div>
<div class="col-12"><div class="card"><div class="card-header">Benefit Records by Type</div><div class="card-body"><canvas id="benefitChart"></canvas></div></div></div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const sexLabels=@json($bySex->keys()); const sexData=@json($bySex->values());
new Chart(document.getElementById('sexChart'),{type:'doughnut',data:{labels:sexLabels,datasets:[{data:sexData}]}});
const pensionLabels=['Not Enrolled','Enrolled']; const pensionData=[@json($byPension[0]??0),@json($byPension[1]??0)];
new Chart(document.getElementById('pensionChart'),{type:'pie',data:{labels:pensionLabels,datasets:[{data:pensionData}]}});
new Chart(document.getElementById('barangayChart'),{type:'bar',data:{labels:@json($byBarangay->pluck('barangay')),datasets:[{label:'Registered',data:@json($byBarangay->pluck('total'))}]}});
new Chart(document.getElementById('benefitChart'),{type:'bar',data:{labels:@json($benefits->pluck('benefit_type')),datasets:[{label:'Records',data:@json($benefits->pluck('total'))}]}});
</script>
@endsection