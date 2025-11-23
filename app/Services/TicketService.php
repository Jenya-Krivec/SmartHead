<?php

namespace App\Services;

use App\Models\Ticket;

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
}
