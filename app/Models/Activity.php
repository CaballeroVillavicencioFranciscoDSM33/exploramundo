<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model {
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'price_per_person', 'popularity', 'image_path'
    ];

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function related() {
        return $this->belongsToMany(Activity::class, 'activity_related', 'activity_id', 'related_activity_id');
    }

    public static function availableRelations($currentId = null)
    {
        return self::where('id', '!=', $currentId)->pluck('title', 'id');
    }
}

