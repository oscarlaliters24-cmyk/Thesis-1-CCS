<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\AuditService;

class SeniorCitizenController extends Controller
{
    public function index(Request $request)
    {
        $query = SeniorCitizen::query();

        if ($request->filled('search')) {
            $term = $request->string('search');
            $query->where(function ($q) use ($term) {
                $q->where('osca_id', 'like', "%{$term}%")
                  ->orWhere('first_name', 'like', "%{$term}%")
                  ->orWhere('last_name', 'like', "%{$term}%")
                  ->orWhere('barangay', 'like', "%{$term}%");
            });
        }

        $seniorCitizens = $query->latest()->paginate(10)->withQueryString();

        return view('senior-citizens.index', compact('seniorCitizens'));
    }

    public function create()
    {
        return view('senior-citizens.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['qr_token'] = (string) Str::uuid();
        $data['is_active'] = true;

        $person = SeniorCitizen::create($data);
        AuditService::log('CREATE', 'Registered senior citizen '.$person->osca_id, $person, $request);

        return redirect()->route('senior-citizens.index')
            ->with('success', 'Senior citizen registered successfully.');
    }

    public function show(SeniorCitizen $seniorCitizen)
    {
        $seniorCitizen->load('benefits');
        return view('senior-citizens.show', compact('seniorCitizen'));
    }

    public function edit(SeniorCitizen $seniorCitizen)
    {
        return view('senior-citizens.edit', compact('seniorCitizen'));
    }

    public function update(Request $request, SeniorCitizen $seniorCitizen)
    {
        $seniorCitizen->update($this->validated($request));
        AuditService::log('UPDATE', 'Updated senior citizen '.$seniorCitizen->osca_id, $seniorCitizen, $request);

        return redirect()->route('senior-citizens.show', $seniorCitizen)
            ->with('success', 'Record updated successfully.');
    }

    public function destroy(SeniorCitizen $seniorCitizen)
    {
        $seniorCitizen->update(['is_active' => false]);
        AuditService::log('DEACTIVATE', 'Deactivated senior citizen '.$seniorCitizen->osca_id, $seniorCitizen);

        return redirect()->route('senior-citizens.index')
            ->with('success', 'Record deactivated.');
    }

    public function qr(SeniorCitizen $seniorCitizen)
    {
        return view('senior-citizens.qr', compact('seniorCitizen'));
    }

    public function verify(string $qrToken)
    {
        $seniorCitizen = SeniorCitizen::where('qr_token', $qrToken)
            ->where('is_active', true)
            ->first();

        return view('senior-citizens.verify', compact('seniorCitizen'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'osca_id' => ['required','string','max:50'],
            'first_name' => ['required','string','max:100'],
            'middle_name' => ['nullable','string','max:100'],
            'last_name' => ['required','string','max:100'],
            'suffix' => ['nullable','string','max:20'],
            'birth_date' => ['required','date','before:today'],
            'sex' => ['required','in:Male,Female,Other'],
            'civil_status' => ['required','in:Single,Married,Widowed,Separated,Divorced'],
            'barangay' => ['required','string','max:150'],
            'address' => ['required','string','max:255'],
            'contact_number' => ['nullable','string','max:30'],
            'email' => ['nullable','email','max:150'],
            'philhealth_number' => ['nullable','string','max:50'],
            'pension_type' => ['nullable','string','max:100'],
            'pension_enrolled' => ['boolean'],
        ]);
    }
}