<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'monthly_price',
        'yearly_price',
        'yearly_discount',
        'restrictions',
        'max_students',
        'min_students',
        'stripe_monthly_data',
        'stripe_yearly_data',
    ];

    protected $casts = [
        'restrictions' => 'array',
        'stripe_monthly_data' => 'array',
        'stripe_yearly_data' => 'array',
    ];
}
