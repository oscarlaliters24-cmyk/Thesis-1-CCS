@extends('layouts.app')
@section('content')
<h1>QR Verification</h1>
<div class="grid2">
<section class="panel">
    <h2>Camera QR Scanner</h2>
    <p class="muted">Allow camera access, point the camera at a senior citizen QR code, then verify the decoded token.</p>
    <div id="qr-reader" class="scanner"></div>
    <div id="scan-status" class="scan-status">Scanner is ready.</div>
    <form method="POST" action="{{ route('qr.verify') }}" class="verify" id="qr-form">
        @csrf
        <input name="qr_code" id="qr_code" placeholder="Scanned QR token" required>
        <button class="btn" type="submit">Verify</button>
    </form>
</section>
<section class="panel">
    <h2>Manual Verification</h2>
    <p class="muted">You can also paste a QR token if camera access is unavailable.</p>
    <form method="POST" action="{{ route('qr.verify') }}" class="verify">
        @csrf
        <input name="qr_code" placeholder="Scan/paste QR token" required>
        <button class="btn">Verify</button>
    </form>
    @if(session('verified'))
        <div class="alert success" style="margin-top:18px">Verified: <b>{{ session('verified')->full_name }}</b> — {{ session('verified')->senior_id }}</div>
    @endif
</section>
</div>
<div class="panel"><h2>Verification Logs</h2><div class="tablewrap"><table><tr><th>Date</th><th>Senior</th><th>Status</th></tr>@forelse($logs as $log)<tr><td>{{ $log->verification_date->format('M d, Y H:i') }}</td><td>{{ $log->senior?->full_name ?? 'Unknown QR' }}</td><td>{{ $log->status }}</td></tr>@empty<tr><td colspan="3">No verification logs yet.</td></tr>@endforelse</table></div></div>
<script src="https://unpkg.com/html5-qrcode" defer></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const startScanner = () => {
        if (typeof Html5Qrcode === 'undefined') { setTimeout(startScanner, 300); return; }
        const status = document.getElementById('scan-status');
        const input = document.getElementById('qr_code');
        const scanner = new Html5Qrcode('qr-reader');
        const onScanSuccess = (decodedText) => {
            input.value = decodedText;
            status.textContent = 'QR detected. Click Verify to check the record.';
            status.className = 'scan-status success-text';
            scanner.stop().catch(() => {});
        };
        const onScanFailure = () => {};
        scanner.start({ facingMode: 'environment' }, { fps: 10, qrbox: { width: 250, height: 250 } }, onScanSuccess, onScanFailure)
            .catch(() => { status.textContent = 'Camera could not start. Check browser permission or use manual verification.'; });
    };
    startScanner();
});
</script>
@endsection
