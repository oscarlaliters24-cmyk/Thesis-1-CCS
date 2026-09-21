@extends('layouts.app')
@section('title','QR Scanner')
@section('content')
<div class="row justify-content-center">
<div class="col-lg-7">
<div class="card shadow-sm">
<div class="card-body">
<h3>QR Code Scanner</h3>
<p class="text-muted">Allow camera access, then point the camera at an OSCA QR code.</p>
<div id="reader" style="width:100%;max-width:520px;margin:auto;"></div>
<div id="scan-result" class="mt-3"></div>
</div></div></div></div>
@endsection
@section('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
const result=document.getElementById('scan-result');
function onScanSuccess(decodedText){
    result.innerHTML='<div class="alert alert-success">QR detected. Opening verification...</div>';
    window.location.href=decodedText;
}
function onScanFailure(){}
new Html5QrcodeScanner("reader",{fps:10,qrbox:{width:250,height:250}},false).render(onScanSuccess,onScanFailure);
</script>
@endsection
