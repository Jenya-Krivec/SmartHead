<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Validation\Rule;

class TicketService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function create($request, $customer): Ticket
    {
        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'subject' => $request->subject,
            'text' => $request->message,
            'is_incoming' => $request->isIncoming
        ]);

        $ticket['token'] = $request->token;
        $ticket['getTickets'] = $request->phone ? 1 : 0;

        return $ticket;
    }

    public static function updateStatus($request)
    {
        $request->validate([
            'status' => ['required', 'string', Rule::in(['new', 'in progress', 'processed'])],
            'id' => ['required', 'numeric']
        ]);

        $tickets = Ticket::where('customer_id', $request->id)->update(['status' => $request->status]);

        return $tickets;
    }

}
