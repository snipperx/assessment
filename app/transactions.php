<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    public $table = 'transactions';

    protected $fillable = ['user_id','transaction_details','amount','date'];
}
