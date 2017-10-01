<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function campaign() {
        return $this->belongsTo("Hermes\Models\Campaign");
    }
}
