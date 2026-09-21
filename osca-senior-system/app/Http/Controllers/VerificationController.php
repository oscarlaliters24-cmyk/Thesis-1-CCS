<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use App\Models\VerificationLog;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        $logs = VerificationLog::with('senior')->latest()->take(20)->get();
        return view('qr.index', compact('logs'));
    }

    public function verify(Request $request)
    {
        $request->validate(['qr_code'=>'required|string']);

        $senior = SeniorCitizen::where('qr_code',$request->qr_code)->where('status','active')->first();

        VerificationLog::create([
            'senior_citizen_id'=>$senior?->id,
            'verified_by'=>auth()->id(),
            'verification_date'=>now(),
            'status'=>$senior ? 'Verified' : 'Failed',
        ]);

        if (!$senior) {
            return back()->with('error','QR code not found or inactive.');
        }

        return back()->with('verified',$senior);
    }
}
