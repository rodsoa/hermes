@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes - Blacklist de datas')

@section('content_header')
    <h1>Blacklist de datas <small>Listagem geral</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Blacklist</a>
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
                    <h3 class="box-title">Listas de datas bloqueadas</h3>
                </div>
                <div class="box-body">
                    <button  class="btn btn-danger" onclick="deleteAllDates()">
                        <i class="fa fa-fw fa-trash"></i> Remover tudo
                    </button>
                    <button  class="btn btn-primary" data-toggle="modal" data-target="#blacklist-add-form-modal">
                        <i class="fa fa-fw fa-minus"></i> Bloquear data
                    </button>
                    <table id="blacklist-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $dates as $date )
                                <tr>
                                    <td>{{ (\DateTime::createFromFormat('Y-m-d', $date->date))->format('d-m-Y') }}<td>
                                    <td>
                                        <button type"button" class="btn btn-xs btn-danger" onclick="deleteDate({{ $date->id }})">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right">{{ $dates->links() }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <form id="delete-blacklist-form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

@include('blacklist.includes.add_form')
@stop

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
@stop