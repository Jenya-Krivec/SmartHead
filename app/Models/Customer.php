<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'token',
    ];

    protected $appends = ['status'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getStatusAttribute()
    {
        $statuses = $this->tickets->pluck('status');

        if ($statuses->contains('new')) {
            return 'Новый';
        }

        if ($statuses->contains('in progress')) {
            return 'В работе';
        }

        if ($statuses->contains('processed')) {
            return 'Обработан';
        }

        return null;
    }

    public function scopeFilterPhone($query, $phone)
    {
        return $phone ? $query->where('phone', 'LIKE', "%$phone%") : $query;
    }

    public function scopeFilterEmail($query, $email)
    {
        return $email ? $query->where('email', 'LIKE', "%$email%") : $query;
    }

    public function scopeFilterStatus($query, $status)
    {
        if (!$status) {
            return $query;
        }

        $priority = [
            'new' => 1,
            'in progress' => 2,
            'processed' => 3,
        ];

        $wantedPriority = $priority[$status];

        if ($status === 'new') {
            return $query->whereHas('tickets', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }else {
            return $query->whereHas('tickets', function ($q) use ($status) {
                $q->where('status', $status);
            })->whereDoesntHave('tickets', function ($q) use ($priority, $wantedPriority) {
                $higherStatuses = array_filter($priority, fn($p) => $p < $wantedPriority);
                if (!empty($higherStatuses)) {
                    $q->whereIn('status', array_keys($higherStatuses));
                }
            });
        }
    }

    public function scopeFilterDateFrom($query, $date)
    {
        if (!$date) {
            return $query;
        }

        return $query->whereHas('tickets')
        ->whereDoesntHave('tickets', function($q) use ($date) {
            $q->whereDate('created_at', '<', $date);
        });
    }

    public function scopeFilterDateTo($query, $date)
    {
        if (!$date) {
            return $query;
        }

        return $query->whereHas('tickets')
            ->whereHas('tickets', function($q) use ($date) {
                $q->whereDate('created_at', '<=', $date);
            });
    }

}
