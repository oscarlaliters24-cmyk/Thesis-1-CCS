<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\SeniorCitizen;
use Illuminate\Http\Request;
use App\Services\AuditService;

class BenefitController extends Controller
{
    public function index(Request $request)
    {
        $benefits = Benefit::with('seniorCitizen')
            ->latest()
            ->paginate(15);

        $seniorCitizens = SeniorCitizen::where('is_active', true)
            ->orderBy('last_name')->get();

        return view('benefits.index', compact('benefits', 'seniorCitizens'));
    }

    public function create()
    {
        $seniorCitizens = SeniorCitizen::where('is_active', true)->orderBy('last_name')->get();
        return view('benefits.create', compact('seniorCitizens'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'senior_citizen_id' => ['required','exists:senior_citizens,id'],
            'benefit_type' => ['required','string','max:150'],
            'amount' => ['nullable','numeric','min:0'],
            'remarks' => ['nullable','string','max:500'],
        ]);

        $data['status'] = 'pending';
        $benefit = Benefit::create($data);
        AuditService::log('CREATE', 'Created benefit record', $benefit, $request);

        return redirect()->route('benefits.index')->with('success', 'Benefit record created.');
    }

    public function edit(Benefit $benefit)
    {
        $seniorCitizens = SeniorCitizen::where('is_active', true)->orderBy('last_name')->get();
        return view('benefits.edit', compact('benefit', 'seniorCitizens'));
    }

    public function update(Request $request, Benefit $benefit)
    {
        $data = $request->validate([
            'senior_citizen_id' => ['required','exists:senior_citizens,id'],
            'benefit_type' => ['required','string','max:150'],
            'amount' => ['nullable','numeric','min:0'],
            'status' => ['required','in:pending,claimed,cancelled'],
            'remarks' => ['nullable','string','max:500'],
        ]);

        $benefit->update($data);
        AuditService::log('UPDATE', 'Updated benefit record', $benefit, $request);
        return redirect()->route('benefits.index')->with('success', 'Benefit updated.');
    }

    public function destroy(Benefit $benefit)
    {
        $benefit->delete();
        return back()->with('success', 'Benefit record deleted.');
    }

    public function claim(Benefit $benefit)
    {
        $benefit->update([
            'status' => 'claimed',
            'claimed_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        AuditService::log('CLAIM', 'Marked benefit as claimed', $benefit);
        return back()->with('success', 'Benefit marked as claimed.');
    }
}