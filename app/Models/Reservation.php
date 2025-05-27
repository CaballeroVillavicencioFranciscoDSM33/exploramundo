<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    use HasFactory;

    protected $fillable = [
        'activity_id', 'user_id', 'people', 'total_price', 'reservation_date', 'execution_date'
    ];

    protected $casts = [
        'reservation_date' => 'datetime',
        'execution_date' => 'datetime',
    ];

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}

