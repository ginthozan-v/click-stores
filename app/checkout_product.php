<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkout_product extends Model
{
    protected $fillable = [
        'checkout_id', 'product_id','qty','price', 'updated_at', 'created_at'
    ];
}
