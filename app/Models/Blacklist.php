<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    // Table name
    protected $table = "blacklist";

    protected $fillable = ['date'];
    
    // Timestamps off
    public $timestamps = false;
}
