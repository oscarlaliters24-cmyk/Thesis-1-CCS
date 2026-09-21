<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeniorCitizenController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $seniors = SeniorCitizen::when($q, function ($query) use ($q) {
            $query->where(function ($x) use ($q) {
                $x->where('senior_id','like',"%{$q}%")
                  ->orWhere('first_name','like',"%{$q}%")
                  ->orWhere('last_name','like',"%{$q}%")
                  ->orWhere('barangay','like',"%{$q}%");
            });
        })->latest()->paginate(10)->withQueryString();

        return view('seniors.index', compact('seniors','q'));
    }

    public function create()
    {
        return view('seniors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'=>'required|string|max:100',
            'middle_name'=>'nullable|string|max:100',
            'last_name'=>'required|string|max:100',
            'birth_date'=>'required|date|before_or_equal:-60 years',
            'sex'=>'required|in:Male,Female',
            'address'=>'required|string|max:255',
            'barangay'=>'required|string|max:100',
            'pension_status'=>'required|in:Yes,No',
            'philhealth_status'=>'required|in:Yes,No',
            'status'=>'required|in:active,inactive',
        ]);

        $data['senior_id'] = 'SC-'.now()->format('Y').'-'.strtoupper(Str::random(6));
        $data['qr_code'] = hash('sha256', $data['senior_id'].'|'.Str::random(32));

        SeniorCitizen::create($data);

        return redirect()->route('seniors.index')->with('success','Senior citizen registered.');
    }

    public function show(SeniorCitizen $senior)
    {
        $senior->load('benefits','verificationLogs');
        return view('seniors.show', compact('senior'));
    }

    public function edit(SeniorCitizen $senior)
    {
        return view('seniors.edit', compact('senior'));
    }

    public function update(Request $request, SeniorCitizen $senior)
    {
        $data = $request->validate([
            'first_name'=>'required|string|max:100',
            'middle_name'=>'nullable|string|max:100',
            'last_name'=>'required|string|max:100',
            'birth_date'=>'required|date',
            'sex'=>'required|in:Male,Female',
            'address'=>'required|string|max:255',
            'barangay'=>'required|string|max:100',
            'pension_status'=>'required|in:Yes,No',
            'philhealth_status'=>'required|in:Yes,No',
            'status'=>'required|in:active,inactive',
        ]);

        $senior->update($data);

        return redirect()->route('seniors.show',$senior)->with('success','Record updated.');
    }

    public function destroy(SeniorCitizen $senior)
    {
        $senior->update(['status'=>'inactive']);
        return redirect()->route('seniors.index')->with('success','Record marked inactive.');
    }
}
