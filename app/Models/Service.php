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
        'online_discount',
        'offline_price',
        'offline_discount',
        'duration_minutes',
        'category',
        'icon',
        'color',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'online_price' => 'decimal:2',
        'online_discount' => 'decimal:2',
        'offline_price' => 'decimal:2',
        'offline_discount' => 'decimal:2',
    ];

    public function originalPriceFor(string $mode): float
    {
        return (float) ($mode === 'online' ? $this->online_price : $this->offline_price);
    }

    public function discountAmountFor(string $mode): float
    {
        $discount = (float) ($mode === 'online' ? $this->online_discount : $this->offline_discount);

        return min($discount, $this->originalPriceFor($mode));
    }

    public function discountedPriceFor(string $mode): float
    {
        return max(0, $this->originalPriceFor($mode) - $this->discountAmountFor($mode));
    }

    public function hasDiscountFor(string $mode): bool
    {
        return $this->discountAmountFor($mode) > 0;
    }

    public function getDiscountedOnlinePriceAttribute(): float
    {
        return $this->discountedPriceFor('online');
    }

    public function getDiscountedOfflinePriceAttribute(): float
    {
        return $this->discountedPriceFor('offline');
    }

    public function getHasOnlineDiscountAttribute(): bool
    {
        return $this->hasDiscountFor('online');
    }

    public function getHasOfflineDiscountAttribute(): bool
    {
        return $this->hasDiscountFor('offline');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
