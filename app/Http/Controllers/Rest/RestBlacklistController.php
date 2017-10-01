<?php

namespace Hermes\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Blacklist;

class RestBlacklistController extends Controller
{
    public function index() {
        $blist = Blacklist::all();
        $list = [];
        if ( count( $blist ) ) {
            foreach( $blist as $date )
                $list[] = $date->date;
        }
        return $list;
    }
}
