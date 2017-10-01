<?php

namespace Hermes;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Campaigns
    public function campaigns() {
        return $this->hasMany('Hermes\Models\Campaign');
    }

    // Credits
    public function credit() {
        return $this->hasOne('Hermes\Models\Credit');
    }
}
