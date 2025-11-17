<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Inertia;

class AboutController extends Controller
{
    /**
     * Show the view for the About page
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request):View {
        return Inertia::render('About', []);
    }
}
