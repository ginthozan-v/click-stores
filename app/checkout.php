<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    protected $fillable = [
        'firstName', 'lastName', 'companyName', 'phone', 'email',
        'addressLine1', 'addressLine2','city', 'zip', 'orderNotes',
        'subtotal','tax','total','deliverOption',
    ];


    // protected $fillable = ['orderNotes'];

    // public function checkoutproduct(){
    //     return $this->HasMany('App\checkout_product');
    // }

    // public function products(){
    //     return $this->belongsToMany('App\Product');
    // }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'checkout_products', 'checkout_id', 'product_id')->withPivot('qty','price','updated_at');
    }
}
