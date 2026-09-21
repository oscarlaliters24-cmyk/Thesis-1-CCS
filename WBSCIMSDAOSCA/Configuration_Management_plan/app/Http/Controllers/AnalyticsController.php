<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\SeniorCitizen;

class AnalyticsController extends Controller
{
    public function index()
    {
        $bySex = SeniorCitizen::selectRaw('sex, COUNT(*) as total')
            ->groupBy('sex')->pluck('total', 'sex');

        $byBarangay = SeniorCitizen::selectRaw('barangay, COUNT(*) as total')
            ->groupBy('barangay')->orderByDesc('total')->get();

        $byPension = SeniorCitizen::selectRaw('pension_enrolled, COUNT(*) as total')
            ->groupBy('pension_enrolled')->pluck('total', 'pension_enrolled');

        $benefits = Benefit::selectRaw('benefit_type, COUNT(*) as total')
            ->groupBy('benefit_type')->orderByDesc('total')->get();

        return view('analytics.index', compact('bySex','byBarangay','byPension','benefits'));
    }
}