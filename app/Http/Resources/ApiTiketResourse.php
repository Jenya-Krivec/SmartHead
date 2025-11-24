<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiTiketResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'subject' => $this->subject,
            'text' => $this->text,
            'is_incoming' => $this->is_incoming,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
            'media' => $this->getMedia('files')->map(function ($file) {
                return [
                    'url' => $file->getUrl(),
                    'name' => $file->file_name,
                    'type' => $file->mime_type,
                    'size' => $file->size,
                    'created_at' => Carbon::parse($file->created_at)->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::parse($file->updated_at)->format('Y-m-d H:i:s'),
                ];
            })
        ];
    }
}
