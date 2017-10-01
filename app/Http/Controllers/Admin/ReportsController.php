<?php

namespace Hermes\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Hermes\Http\Controllers\Controller;

use Hermes\Models\Report;
use Hermes\User;

class ReportsController extends Controller
{
    public function index(Request $request) {
        if ($request->user()->category === 'ADMIN') {
            $reports = Report::orderBy('id', 'desc')->get();
            $users = User::where([
                ['category', '=', 'CUSTOMER'], 
                ['status', '=', 'A']
            ])->orderBy('id', 'desc')->get();
            return view('reports.index', [
                'reports' => $reports,
                'users' => $users
            ]);
        } else {
            $reports = Report::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
            return view('reports.index', [
                'reports' => $reports,
            ]);
        }
    }

    public function store(Request $request) {
        $user_id = $request->input('user_id');
        $campaign_id = $request->input('campaign_id');
        $name = $request->input('name');

        $report = new Report();
        $report->user_id = $user_id;
        $report->name = $name;
        $report->campaign_id = $campaign_id;
        $report_file_name = (new \DateTime('now'))->format('YmdHis') . "-" . $campaign_id . "." .$request->file->extension();
        $report->path = $request->file->storeAs('campaigns/reports', $report_file_name);

        if ( $report->save() ) {
            return redirect()->route('reports.index')->with([
                'msg' => 'Relatório cadastrado com sucesso',
                'status' => 'success'
            ]);
        }
    }

    public function destroy($id) {
        $report = Report::findOrFail( $id );
        
        // Se a camapanha acompanhar arquivos
         if( Storage::disk('local')->exists($report->path) ) {
            Storage::disk('local')->delete( $report->path);
            $report->delete();
        }
        
        return redirect()->route('reports.index')->with([
            'msg' => 'Relatório apagado com sucesso!',
            'status' => 'success'
        ]);

    }

    public function download($id) {
        $report = Report::findOrFail( $id );

        return response()->download( storage_path('app/') . $report->path );
    }
}
