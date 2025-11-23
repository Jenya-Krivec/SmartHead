<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\CustomerService;
use Carbon\Carbon;


class ApiController extends Controller
{
    public function store(Request $request, CustomerService $customerService){

        $customer = $customerService::create($request);

        $request->validate([
            'subject' => 'string|max:255|min:2',
            'message' => 'string|min:2',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:2048',
            'token' => 'required|string',
            'isIncoming' => 'required|boolean',
        ]);

        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'subject' => $request->subject,
            'text' => $request->message,
            'is_incoming' => $request->isIncoming
        ]);

        $ticket['token'] = $request->token;

        return new TicketResource($ticket);

    }


}
