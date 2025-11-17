<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Show the view for the Dashboard page
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request):View {
        $chartData = Record::getRecordsLastXDays(7);

        return Inertia::render('Dashboard', compact('chartData'));
    }
}
