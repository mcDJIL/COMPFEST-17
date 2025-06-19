<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
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
        'user_id', 'review', 'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
