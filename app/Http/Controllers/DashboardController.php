<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Returns the main page of the website.
     *
     * @return View
     */
    public function create():View
    {
        return view('index');
    }
}
