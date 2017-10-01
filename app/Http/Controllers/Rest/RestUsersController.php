<?php

namespace Hermes\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\User;

class RestUsersController extends Controller
{
    public function teste (Request $request) {
        return $request->user();
    }

    public function show( $id ) {
        $user = User::find( $id );

        if ( $user ) {
            return response()->json( $user );
        } else {
            $msg = "Usuário sem registro na base de dados";
            return response()->json(['msg' => $msg], 404);
        }
        
    }

    public function campaigns($id) {
        $user = User::find( $id );

        if( isset( $user->campaigns ) ) {
            return $user->campaigns;
        } else {
            return [];
        }
    }
}
