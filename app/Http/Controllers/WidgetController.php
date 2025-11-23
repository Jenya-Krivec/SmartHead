<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;

class WidgetController extends Controller
{
    public function create(): View
    {
        return view('widget.chat');
    }
}
