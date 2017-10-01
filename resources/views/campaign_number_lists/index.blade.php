@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes - Lista de Números para camapanhas')

@section('content_header')
    <h1>Listas de Números <small>Listagem geral</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Listas de Números</a>
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
                    <h3 class="box-title">Listas de números cadastrados no sistema</h3>
                </div>
                <div class="box-body">
                    <button  class="btn btn-primary" data-toggle="modal" data-target="#number-lists-add-form-modal">
                        <i class="fa fa-fw fa-plus"></i> Cadastrar nova lista
                    </button>
                    <table id="number-lists-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Qtd. números</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($number_lists as $list)
                                <tr>
                                    <td>{{ $list->name }}</td>
                                    <td> {{ $list->number }} </td>
                                    <td class="text-right">
                                        <a role="button" class="btn btn-xs btn-primary" href="{{ route('campaigns.number-lists.download',['number_list' => $list->id]) }}">
                                            <i class="fa fa-fw fa-download"></i>Download
                                        </a>
                                        <button type"button" class="btn btn-xs btn-danger" onclick="deleteNumberList({{ $list->id }})">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <form id="delete-number-lists-form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    @include('campaign_number_lists.includes.add_form')
    @include('campaign_number_lists.includes.edit_form')
@stop

@section('js')
<script>
  $(function () {
    $('#number-lists-table').DataTable({
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