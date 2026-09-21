<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\SeniorCitizen;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => SeniorCitizen::count(),
            'active' => SeniorCitizen::where('is_active', true)->count(),
            'pensioners' => SeniorCitizen::where('pension_enrolled', true)->count(),
            'benefits' => Benefit::where('status', 'claimed')->count(),
        ];

        $barangayCounts = SeniorCitizen::query()
            ->selectRaw('barangay, COUNT(*) as total')
            ->groupBy('barangay')
            ->orderByDesc('total')
            ->get();

        return view('dashboard.index', compact('stats', 'barangayCounts'));
    }
}