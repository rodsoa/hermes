<?php

namespace Hermes\Http\Controllers\Campaign;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Hermes\Http\Controllers\Controller;

use Hermes\Models\Campaign;
use Hermes\Models\CampaignFile;
use Hermes\Models\CampaignNumberList;

class CampaignsController extends Controller
{
    /**
     * TODO: IMPLEMENTAR FILTROS [OK]
     * DataTables aqui não funciona. Habilitar paginação manual.
     */
    public function index(Request $request) {
        // Inicializando variáveis
        $campaigns = [];
        $number_lists = [];
        $filters = [];

        // if houverem valores para filtragem, processa 
        if ( count( $request->all() ) && $request->input('filter')) {
            foreach( $request->input('filter') as $key => $value) {
                $filters[] = $key;
            }

            if ( $request->user()->category == 'ADMIN') {
                $campaigns = Campaign::whereIn('status', $filters)->orderBy('id', 'desc')->paginate(7);
                $number_lists = CampaignNumberList::all();
            } else {
                $campaigns = Campaign::where('user_id', $request->user()->id)->whereIn('status', $filters)->paginate(10);
                $number_lists = CampaignNumberList::where('user_id', $request->user()->id)->get();
            }
        } else {
            if ( $request->user()->category == 'ADMIN') {
                $campaigns = Campaign::orderBy('id', 'desc')->paginate(10);
                $number_lists = CampaignNumberList::all();
            } else {
                $campaigns = Campaign::where('user_id', $request->user()->id)->paginate(10);
                $number_lists = CampaignNumberList::where('user_id', $request->user()->id)->get();
            }
        }
        
        return view('campaigns.index', [
            'campaigns' => $campaigns,
            'number_lists' => $number_lists,
            'filters' => $filters
        ]);
    }

    public function store(Request $request) {
        if( count($request->all()) <= 5 ){
            return redirect()->route('campaigns.list')->with([
                'msg' => 'Falta informações para processar campanha. Por favor, repita a operação',
                'status' => 'error'
            ]);
        }
        
        /**
         * Criar diretorio nomeado para guardar os documentos da campanha
         * Realizar upload dos arquivos (Video, Imagem, PDF, AUDIO) para o diretorio
         * Enviar email para administrador notificando o cadastro da campanha
         * Enviar anexos no email, se possível compactado em zip.
         */
         
        $campaign = new Campaign();
        $campaign->name = $request->input('name');
        $campaign->type = $request->input('type');
        $campaign->campaign_number_list_id = $request->input('number_list_id');
        $campaign->user_id = $request->input('user_id');
        $campaign->date = (new \DateTime( $request->input('date')))->format('Y-m-d');

        if ($request->input('text')) {
            $campaign->message = $request->input('text');
        }
                
        if( $campaign->save() ) {

            switch( $request->input('type') ) {
             
                case 'ITXT':              
                    // criando e salvando imagem
                    $img = new CampaignFile();
                    $img->name = $request->input('file_name');
                    $img->category = "IMAGE"; 
                    $img->campaign_id = $campaign->id;
                    
                    if ($request->hasFile('file') && $request->file('file')->isValid()) {
                        $filename = (new \DateTime('now'))->format('YmdH:i:s') . "-" . $request->user()->id . "." . $request->file->extension();
                        $path = $request->file->storeAs('campaigns/images', $filename, 'local');
                        $img->path = $path;
                        $img->save();
                    }
    
                    break;
                    
                case 'VTXT':                 
                    // criando e salvando video
                    $video = new CampaignFile();
                    $video->name = $request->input('file_name');
                    $video->category = "VIDEO";
                    $video->campaign_id = $campaign->id;
                    
                    if ($request->hasFile('file') && $request->file('file')->isValid()) {
                        $filename = (new \DateTime('now'))->format('YmdH:i:s') . "-" . $request->user()->id . "." . $request->file->extension();
                        $path = $request->file->storeAs('campaigns/videos', $filename, 'local');
                        $video->path = $path;
                        $video->save();
                    }
                    
                    break;
                    
                case 'PDF':              
                    // criando e salvando pdf
                    $pdf = new CampaignFile();
                    $pdf->name = $request->input('file_name');
                    $pdf->category = 'PDF';
                    $pdf->campaign_id = $campaign->id;
                    
                    if ($request->hasFile('file') && $request->file('file')->isValid()) {
                        $filename = (new \DateTime('now'))->format('YmdH:i:s') . "-" . $request->user()->id . "." . $request->file->extension();
                        $path = $request->file->storeAs('campaigns/pdfs', $filename, 'local');
                        $pdf->path = $path;
                        $pdf->save();
                    }
                    break;
                    
                case 'AUDIO':         
                    // criando e salvando audio
                    $audio = new CampaignFile();
                    $audio->name = $request->input('file_name');
                    $audio->category = 'AUDIO';
                    $audio->campaign_id = $campaign->id;
                    
                    if ($request->hasFile('file') && $request->file('file')->isValid()) {
                        $filename = (new \DateTime('now'))->format('YmdH:i:s') . "-" . $request->user()->id . "." . $request->file->extension();
                        $path = $request->file->storeAs('campaigns/audios', $filename, 'local');
                        $audio->path = $path;
                        $audio->save();
                    }
                    
                    break;
            }

            return redirect()->route('campaigns.list')->with([
                'msg' => 'Campanha criada com sucesso! Aguarde processamento da mesma pela administração',
                'status' => 'success'
            ]);
        } else {
            return redirect()->route('campaigns.list')->with([
                'msg' => 'Ocorreu algum erro. Tente novamente.',
                'status' => 'error'
            ]);
        }        
    }

    public function destroy( $id ) {
        $campaign = Campaign::findOrFail($id);

        // Se a camapanha acompanhar arquivos
        if( ($campaign->type !== 'TXT') && 
            (Storage::disk('local')->exists( $campaign->campaign_file->path))
        ) {
            Storage::disk('local')->delete( $campaign->campaign_file->path);
            $campaign->campaign_file->delete();
        }

        $campaign->delete();

        return redirect()->route('campaigns.list')->with([
            'msg' => 'Campanha apagada com sucesso!',
            'status' => 'success'
        ]);
    }

    // Download dos arquivos da campanha
    public function download( $id ) {
        $campaign = Campaign::findOrFail($id);
        if( ($campaign->type !== 'TXT') && (Storage::disk('local')->exists( $campaign->campaign_file->path)) ) {
            return response()->download( storage_path('app/') . $campaign->campaign_file->path);
        }
    }
}
