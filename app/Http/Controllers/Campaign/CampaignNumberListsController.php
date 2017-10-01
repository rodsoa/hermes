<?php

namespace Hermes\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Hermes\Http\Controllers\Controller;

use Hermes\User;
use Hermes\Models\CampaignNumberList;

class CampaignNumberListsController extends Controller
{
    public function index(Request $request) {
        $number_lists = CampaignNumberList::orderBy('id', 'desc')->get();

        if( $request->user()->category === 'CUSTOMER' ) {
            $number_lists = CampaignNumberList::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
        }
        
        return view('campaign_number_lists.index',[ 'number_lists' => $number_lists]);
    }

    /**
     * TODO: Implementar validações de dados!
     * TODO: Verificar lista e remover números duplicados
     * TODO: Obter quantidade de números contidos na lista
     */
    public function store(Request $request) {
        // return $request->all();
        if ( $request->hasFile('number_list') ) {
            
            $name = $request->input('name');
            $user = User::findOrFail( $request->input('user_id') );

            $list = new CampaignNumberList();
            $list->name = $name;
            $list->user_id = $user->id;

            $number_list_file_id = (new \DateTime('now'))->format('YmdHis') . "-" . $user->id . "." .$request->number_list->extension();
            $list->path = $request->number_list->storeAs('campaigns/number_lists', $number_list_file_id);

            // obtendo total de numeros
            $file_path = storage_path("app/") . $list->path;
            $file = file($file_path);
            $list->number = count( $file );
            
            if ( $list->save() ) {
                return redirect()->route('campaigns.number-lists.index')->with([
                    'msg' => "Lista $list->name adicionada com sucesso",
                    'status' => 'success'
                ]);
            } else {
                return redirect()->route('campaigns.number-lists.index')->with([
                    'msg' => "Ocorreu algum erro. Tente novamente",
                    'status' => 'error'
                ]);
            }
        }

    }

    public function destroy( $id ) {
        $list = CampaignNumberList::findOrFail($id);

        if ( count( $list->campaigns ) ) {
            redirect()->route('campaigns.number-lists.index')->with([
                'msg' => "Lista utilizada em campanhas. Não poderá ser deletada",
                'status' => 'error'
            ]);
        } else {
            // Deletando arquivo correspondente
            if ( Storage::disk('local')->exists( $list->path ) )
                Storage::disk('local')->delete( $list->path );

            // Deletando registros no banco de dados    
            $list->delete();

            return redirect()->route('campaigns.number-lists.index')->with([
                'msg' => "Lista deletada com sucesso",
                'status' => 'success'
            ]);
        }
    }

    
    public function download( $id ) {
        $list = CampaignNumberList::findOrFail($id);
        return response()->download(storage_path('app/') . $list->path);
    }
}
