<?php

namespace Hermes\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Campaign;

class RestCampaignsController extends Controller
{
    public function approveCampaign( $id ) {
        $campaign = Campaign::findOrFail( $id );
        $campaign->status = 'S';
        if ( $campaign->save() ) {
            return response()->json([
                'msg' => 'Campanha aprovada'
            ]);
        }
    }

    public function denieCampaign( $id ) {
        $campaign = Campaign::findOrFail( $id );
        $campaign->status = 'D';
        if ( $campaign->save() ) {
            return response()->json([
                'msg' => 'Campanha aprovada'
            ]);
        }
    }

    public function completeCampaign( $id ) {
        $campaign = Campaign::findOrFail( $id );
        $campaign->status = 'C';
        if ( $campaign->save() ) {
            return response()->json([
                'msg' => 'Campanha aprovada'
            ]);
        }
    }
}
