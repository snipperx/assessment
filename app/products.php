<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    public $table = 'products';

    protected $fillable = ['name','description','price','date','product_image','quantity','status'];
}
