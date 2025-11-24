<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\CustomerService;
use App\Services\TicketService;

class AdminCustomerController extends Controller
{
    public function create(Request $request, CustomerService $customerService): View
    {
        $customer = $customerService->getCustomer($request);

        return view('admin.customer', ['customer' => $customer]);
    }

    public function updateStatus(Request $request, CustomerService $customerService, TicketService $ticketService): View
    {

        $ticketService->updateStatus($request);

        $customer = $customerService->getCustomer($request);

        return view('admin.customer', ['customer' => $customer]);
    }
}
