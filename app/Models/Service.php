<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'price_range',
        'rating',
        'online_price',
        'offline_price',
        'duration_minutes',
        'category',
        'icon',
        'color',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
