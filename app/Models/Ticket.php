<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{

    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'customer_id',
        'subject',
        'text',
        'status',
        'is_incoming',
        'response_date',
    ];
    protected $appends = ['file'];
    public function getFileAttribute()
    {
        return $this->getFirstMedia('files')?->file_name;
    }

}
