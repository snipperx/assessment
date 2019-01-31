<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationship between users and persons

    public function person() {
            return $this->hasOne(persons::class, 'user_id');

    }

    /**
     * The function to save user's hr / contacts records.
     *
     * @param HRPerson|ContactPerson $person
     * @return HRPerson|ContactPerson saved person
     */

    public function addPerson($person)
    {
        return $this->person()->save($person);
    }
}
