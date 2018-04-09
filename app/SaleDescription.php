<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class SaleDescription extends Model
{
    protected $table = 'sale_description';
    protected $fillable = [
        'sale_id', 'product_id','product_name', 'price','quantity','subtotal'
    ];

    public $timestamps = false;
}
