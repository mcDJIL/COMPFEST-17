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
        'user_id', 'phone', 'meal_plan_id', 'allergies', 'total_price', 'start_date', 'end_date', 'status', 'pause_start', 'pause_end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class, 'meal_plan_id');
    }

    public function mealTypes()
    {
        return $this->belongsToMany(MealType::class, 'subscription_meal_types', 'subscription_id', 'meal_type_id');
    }

    public function deliveryDays()
    {
        return $this->belongsToMany(DeliveryDay::class, 'subscription_delivery_days');
    }
}
