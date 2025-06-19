<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
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
        'user_id', 'phone', 'meal_plan_id', 'allergies', 'start_date', 'end_date', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mealPlan()
    {
        return $this->belongsTo(User::class, 'meal_plan_id');
    }

    public function mealTypes()
    {
        return $this->belongsToMany(SubscriptionMealType::class, 'subscription_meal_types');
    }

    public function deliveryDays()
    {
        return $this->belongsToMany(SubscriptionDeliveryDay::class, 'subscription_delivery_days');
    }
}
