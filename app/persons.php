<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class persons extends Model
{
    public $table = 'persons';

    protected $fillable = ['user_id','title','first_name', 'surname', 'email', 'cell_number','phone_number','city','res_postal_code',
    'id_number','res_address','date_of_birth', 'gender','profile_pic','status','isAdmin'];

    //Relationship hr_person and user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}

