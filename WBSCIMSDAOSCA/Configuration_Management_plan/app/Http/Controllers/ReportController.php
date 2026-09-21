<?php

namespace App\Http\Controllers;

use App\Models\SeniorCitizen;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index()
    {
        $total = SeniorCitizen::count();
        $active = SeniorCitizen::where('is_active', true)->count();

        return view('reports.index', compact('total', 'active'));
    }

    public function seniorCitizensCsv(): StreamedResponse
    {
        $filename = 'senior-citizens-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'OSCA ID','First Name','Middle Name','Last Name','Birth Date',
                'Sex','Civil Status','Barangay','Address','Contact Number',
                'PhilHealth Number','Pension Type','Pension Enrolled','Active'
            ]);

            SeniorCitizen::orderBy('last_name')->chunk(500, function ($rows) use ($handle) {
                foreach ($rows as $row) {
                    fputcsv($handle, [
                        $row->osca_id, $row->first_name, $row->middle_name,
                        $row->last_name, optional($row->birth_date)->format('Y-m-d'),
                        $row->sex, $row->civil_status, $row->barangay,
                        $row->address, $row->contact_number, $row->philhealth_number,
                        $row->pension_type, $row->pension_enrolled ? 'Yes' : 'No',
                        $row->is_active ? 'Yes' : 'No',
                    ]);
                }
            });

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}