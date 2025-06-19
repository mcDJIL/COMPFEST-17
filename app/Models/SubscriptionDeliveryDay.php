<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubscriptionDeliveryDay extends Model
{
    protected $keyType = 'string';
    
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected $fillable = [
        'subscription_id', 'delivery_day_id'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function deliveryDay()
    {
        return $this->belongsTo(MealType::class, 'delivery_day_id');
    }
}
