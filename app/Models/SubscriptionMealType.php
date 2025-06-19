<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubscriptionMealType extends Model
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
        'subscription_id', 'meal_type_id'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function mealType()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }
}
