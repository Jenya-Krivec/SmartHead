<?php

namespace App\Services;

use App\Models\Ticket;

class FileService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function upload($request, $ticket): Ticket
    {
        if ($request->hasFile('file')) {
            $ticket->addMedia($request->file('file'))->toMediaCollection('files');
            $ticket['file'] = $ticket->getFirstMedia('files')->file_name;
        }

        return $ticket;
    }
}
