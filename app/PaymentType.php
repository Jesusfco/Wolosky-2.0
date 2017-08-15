<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model {

    protected $fillable = [
        'description',
        'days'
    ];

}
