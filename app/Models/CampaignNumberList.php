<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignNumberList extends Model
{
    // Owner
    public function user() {
        return $this->belongsTo('Hermes\User');
    }

    // Campaigns
    public function campaign_images() {
        return $this->hasMany('Hermes\Models\Campaign');
    }
}
