<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Carbon\Carbon;

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

    public function scopeFilterDay($query, $period)
    {
        return $period === 'day' ? $query->whereBetween('created_at', [Carbon::now()->subDay(), Carbon::now()]) : $query;
    }

    public function scopeFilterWeek($query, $period)
    {
        return $period === 'week' ? $query->whereBetween('created_at', [Carbon::now()->subDay(7), Carbon::now()]) : $query;
    }

    public function scopeFilterMonth($query, $period)
    {
        return $period === 'month' ? $query->whereBetween('created_at', [Carbon::now()->subDay(30), Carbon::now()]) : $query;
    }

}
