<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\SeniorCitizen;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSeniors = SeniorCitizen::count();
        $male = SeniorCitizen::where('sex', 'Male')->count();
        $female = SeniorCitizen::where('sex', 'Female')->count();
        $benefits = Benefit::where('status', 'Paid')->sum('amount');

        $barangays = SeniorCitizen::select('barangay', DB::raw('COUNT(*) as total'))
            ->groupBy('barangay')->orderByDesc('total')->get();

        $benefitStatus = Benefit::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')->get();

        $recentSeniors = SeniorCitizen::latest()->take(10)->get();

        return view('dashboard', compact(
            'totalSeniors','male','female','benefits','barangays','benefitStatus','recentSeniors'
        ));
    }
}
