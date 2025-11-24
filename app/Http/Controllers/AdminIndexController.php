<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    public function create(Request $request, CustomerService $customerService): View
    {
        $customers = $customerService->getCustomers($request);

        return view('admin.index', ['customers' => $customers]);
    }
}
