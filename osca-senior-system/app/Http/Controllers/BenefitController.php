<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\SeniorCitizen;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = Benefit::with('senior')->latest()->paginate(15);
        return view('benefits.index', compact('benefits'));
    }

    public function create()
    {
        $seniors = SeniorCitizen::where('status','active')->orderBy('last_name')->get();
        return view('benefits.create', compact('seniors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'senior_citizen_id'=>'required|exists:senior_citizens,id',
            'benefit_type'=>'required|string|max:100',
            'amount'=>'required|numeric|min:0',
            'distribution_date'=>'required|date',
            'status'=>'required|in:Pending,Paid,Cancelled',
            'notes'=>'nullable|string|max:500',
        ]);

        Benefit::create($data);

        return redirect()->route('benefits.index')->with('success','Benefit record saved.');
    }
}
