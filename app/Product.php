<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'qty'
    ];

    //Many Relationship with Category
    public function categories(){
        return $this->belongsToMany('App\Category', 'category_product', 'product_id', 'category_id');
    }

    //Currency format
    public function presentPrice(){
        return 'CA$ '.number_format($this->price / 100, 2);
    }

    public function oldPrice(){
        return 'CA$ '.number_format($this->oldPrice / 100, 2);
    }

    public function scopeMightAlsoLike($query){
        return $query->inRandomOrder()->take(9);
    }

    // public function checkouts(){
    //     return $this->belongsToMany('App\checkout', 'checkout_product', );
    // }

    // public function checkoutproduct(){
    //     return $this->belongsToMany('App\checkout_product', 'product_id');
    // }

    public function checkouts()
    {
        return $this->belongsToMany('App\checkout');
    }

    public function images()
    {
        return $this->hasMany('App\Images');
    }
   
}
