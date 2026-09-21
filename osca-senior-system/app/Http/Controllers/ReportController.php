<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use App\Models\Benefit;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function seniors()
    {
        return view('reports.seniors', [
            'seniors'=>SeniorCitizen::orderBy('barangay')->orderBy('last_name')->get()
        ]);
    }

    public function benefits()
    {
        return view('reports.benefits', [
            'benefits'=>Benefit::with('senior')->latest()->get()
        ]);
    }
}
