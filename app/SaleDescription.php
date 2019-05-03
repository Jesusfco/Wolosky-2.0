<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class SaleDescription extends Model
{
    
    protected $table = 'sale_description';
    
    protected $fillable = [
        'sale_id', 'product_id', 'price','quantity'
    ];

    public $timestamps = false;
    protected $primaryKey = ['sale_id', 'product_id'];
    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo('Wolosky\Product')->withDefault(function ($object) {
            $object->name = 'Desconocido';            
        });
    }

    public function sale()
    {
        return $this->belongsTo('Wolosky\Sale');
    }
}
