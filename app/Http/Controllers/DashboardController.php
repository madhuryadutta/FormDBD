<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormEntry;

class DashboardController extends Controller
{
    public function index()
    {
        // Example: Get total form submissions
        $totalSubmissions = FormEntry::count();

        // Example: Get submissions per day for the last 7 days
        $submissionsPerDay = FormEntry::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard', compact('totalSubmissions', 'submissionsPerDay'));
    }
}
