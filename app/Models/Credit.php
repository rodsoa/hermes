<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public function user() {
        return $this->belongsTo('Hermes\User');
    }
}
