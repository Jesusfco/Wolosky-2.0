<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class MonthlyPrices extends Model
{
    protected $table = 'monthly_prices';
    protected $fillable = [
        'hours',
        'cost'
    ];
}
