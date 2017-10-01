<?php

namespace Hermes\Http\Controllers\Rest;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Credit;
use Hermes\Models\Campaign;

class RestCreditsController extends Controller
{
    public function update(Request $request, $id ) {
        $user_id = $request->input('user_id');
        $total = $request->input('total');

        $user_credit = Credit::findOrFail($id);
        
        $user_credit->total = $total;

        if ($user_credit->save()) {
            return response()->json([
                'msg' => "Crédito habilitado",
                'total' => $user_credit->total
            ]);
        }
    }

    public function store(Request $request) {
        $user_id = $request->input('user_id');
        $total = $request->input('total');

        $credit = new Credit();
        $credit->user_id = $user_id;
        $credit->total = $total;

        if ( $credit->save() ) {
            return response()->json([
                'msg' => "Crédito habilitado"
            ]);
        }
    }
}
