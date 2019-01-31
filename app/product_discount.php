<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_discount extends Model
{
    public $table = 'product_discount';

    protected $fillable = ['min_price','max_price','discount'];
}
