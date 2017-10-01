<?php

namespace Hermes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Hermes\Http\Controllers\Controller;

use Hermes\Models\Blacklist;

class BlacklistController extends Controller
{
    public function index() {
        $dates = Blacklist::orderBy('id', 'desc')->get();
        foreach( $dates as $date ) {
            if ( \DateTime::createFromFormat('Y-m-d', $date->date)->format('Y-m-d') < (new \DateTime('now'))->format('Y-m-d') ) {
                $date->delete();
            }
        }
        $dates = $dates = Blacklist::orderBy('id', 'desc')->paginate(7);
        return view('blacklist.index', ['dates' => $dates]);
    }

    public function store(Request $request) {
        $date = Blacklist::create( $request->all() );

        if ( $date->save() ) {
            return redirect()->route('blacklist.index')->with([
                'msg' => 'Data removida com sucesso!',
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('blacklist.index')->with([
                'msg' => 'Ocorreu algum erro. Repita a operação.',
                'status' => 'error'
            ]);
        }
    }

    public function destroy($id) {
        $date = Blacklist::findOrFail($id);

        if ( $date->delete() ) {
            return redirect()->route('blacklist.index')->with([
                'msg' => 'Data removida com sucesso!',
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('blacklist.index')->with([
                'msg' => 'Valor sem registro na base de dados. Repita a operação.',
                'status' => 'error'
            ]);
        }
    }

    public function destroyAllDates() {
        $dates = Blacklist::all();

        foreach( $dates as $date ) {
            $date->delete();
        }

        return redirect()->route('blacklist.index')->with([
            'msg' => 'Todas as datas foram removida com sucesso!',
            'status' => 'success'
        ]);
    }
}
