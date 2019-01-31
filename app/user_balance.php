<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_balance extends Model
{
     public $table = 'user_balance';

    protected $fillable = ['user_id','balance','date'];
}
