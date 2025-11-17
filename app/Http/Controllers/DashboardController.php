<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Show the view for the Dashboard page
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request):Response {
        $chartData = Record::getRecordsLastXDays(7);

        return Inertia::render('Dashboard', compact('chartData'));
    }
}
