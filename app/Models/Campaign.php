<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function user() {
        return $this->belongsTo('Hermes\User');
    }
    // Campaign number lists
    public function campaign_number_list() {
        return $this->belongsTo('Hermes\Models\CampaignNumberList');
    }
    
    // Campaign images
    public function campaign_file() {
        return $this->hasOne('Hermes\Models\CampaignFile');
    }

    // Report
    public function report() {
        return $this->hasOne("Hermes\Models\Report");
    }

    public function messageStrlen() {
        return strlen($this->message);
    }
}
