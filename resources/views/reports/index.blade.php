@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes - Relatórios')

@section('content_header')
    <h1>Relatórios <small>Listagem geral</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Relatórios</a>
        </li>
    </ol>
@stop

@section('content')

    @if ( session('msg') !== null )
        @if ( session('status') === 'success')
            <div class="alert alert-success alert-dismissible">
                <button  class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                {{ session('msg') }}
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <button  class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                {{ session('msg') }}
            </div>
        @endif
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de relatórios</h3>
                </div>
                <div class="box-body">
                    @if( Auth::user()->category === 'ADMIN')
                        <button  class="btn btn-primary" data-toggle="modal" data-target="#report-add-form-modal">
                            <i class="fa fa-fw fa-plus"></i> Novo relatório
                        </button>
                    @endif
                    <table id="reports-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Campanha</th>
                                <th>Usuário</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $reports as $report )
                                <tr>
                                    <td>{{ $report->name }}</td>
                                    <td>{{ $report->campaign->name }}</td>
                                    <td>{{ $report->campaign->user->name }}</td>
                                    <td class="text-right">
                                        <a role="button" class="btn btn-xs btn-primary" href="{{ route('report.download', ['id' => $report->id])}}">
                                            <i class="fa fa-fw fa-download"></i>Download
                                        </a>
                                        @if( Auth::user()->category === 'ADMIN')
                                            <button type"button" class="btn btn-xs btn-danger" onclick="deleteReport({{ $report->id }})">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @if( Auth::user()->category === 'ADMIN')
        <form id="delete-report-form" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>

        @include('reports.includes.add_form')
    @endif
@stop

@section('js')
<script>
  $(function () {
    $('#reports-table').DataTable({
      'language': {
        'url': '//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json'
      },

      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="{{ asset('js/app.js') }}"></script>
@stop