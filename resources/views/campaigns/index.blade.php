@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes - Campanhas')

@section('content_header')
    <h1>Listas de campanhas <small>Listagem geral</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Listas de campanhas</a>
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
                    <h3 class="box-title">Campanhas cadastradas no sistema</h3>
                </div>
                <div class="box-body">
                    @if( Auth::user()->category === 'CUSTOMER') 
                        <button  class="btn btn-primary" data-toggle="modal" data-target="#add-form-modal" style="margin-bottom: 12px;">
                            <i class="fa fa-fw fa-plus"></i> Cadastrar nova campanha
                        </button>
                    @endif
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="box box-solid" style="background-color: #E7E7E7;">
                                <div class="box-body">
                                    <form class="form-inline text-center">
                                        <style>
                                            .checkbox { margin-right: 20px; }
                                        </style>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="filter[W]" @if(in_array('W', $filters)) checked @endif> Aguardando aprovação
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="filter[S]" @if(in_array('S', $filters)) checked @endif> Inciado
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="filter[C]" @if(in_array('C', $filters)) checked @endif> Completo
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="filter[D]" @if(in_array('D', $filters)) checked @endif> Negado
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-default text-right"><i class="fa fa-fw fa-search"></i>Filtrar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <table id="campaigns-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                @if( Auth::user()->category === 'ADMIN')
                                    <th><td>
                                @endif
                                <th>Status</th>
                                <th>Lançamento</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Lista de números</th>
                                <th>Qtd. Números</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                                <tr>
                                    @if( (Auth::user()->category === 'ADMIN') )
                                        <td>
                                            @if( $campaign->status === 'W')
                                                <button type"button" class="btn btn-xs btn-danger" onclick="denieCampaign({{ $campaign->id }})">
                                                    <i class="fa fa-fw fa-ban"></i> negar
                                                </button>
                                                <button type"button" class="btn btn-xs btn-success" onclick="approveCampaign({{ $campaign->id }})">
                                                    <i class="fa fa-fw fa-check"></i> aprovar
                                                </button>
                                            @elseif( $campaign->status === 'S' )
                                                <button type"button" class="btn btn-xs btn-info" onclick="completeCampaign({{ $campaign->id }})">
                                                    <i class="fa fa-fw fa-check-square-o"></i> completar
                                                </button>
                                            @endif
                                        <td>
                                    @endif
                                    <td>
                                        @if( $campaign->status != 'D')
                                            @if( $campaign->status == 'W')
                                                AGUARDANDO APROVAÇÃO
                                            @elseif( $campaign->status == 'S')
                                                INICIADO
                                            @else
                                                COMPLETADO
                                            @endif
                                        @else
                                            NEGADO
                                        @endif
                                    </td>
                                    <td> {{ (\DateTime::createFromFormat('Y-m-d', $campaign->date))->format('m-d-Y') }}</td>
                                    <td>{{ $campaign->name }}</td>
                                    <td>
                                        @if( $campaign->type == 'TXT')
                                            TEXTO
                                        @elseif( $campaign->type == 'ITXT' )
                                            IMAGEM + TEXTO
                                        @elseif( $campaign->type == 'VTXT' )
                                            VÍDEO + TEXTO
                                        @elseif( $campaign->type == 'PDF')
                                            PDF
                                        @elseif( $campaign->type == 'AUDIO')
                                            AUDIO
                                        @endif
                                    </td>
                                    <td>{{ $campaign->campaign_number_list->name }}</td>
                                    <td> {{ $campaign->campaign_number_list->number }} </td>
                                    <td class="text-right">
                                        @if( $campaign->type !== 'TXT')
                                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                <a role="button" type"button" class="btn btn-primary"
                                                    href="{{ route('campaigns.download', ['id' => $campaign->id]) }}">
                                                    <i class="fa fa-fw fa-download"></i> download
                                                </a>
                                            </div>
                                        @endif

                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                            <button type"button" class="btn btn-warning" 
                                            data-toggle="collapse" data-target="#campaign-{{ $campaign->id }}" 
                                            aria-expanded="false" aria-controls="campaign-{{ $campaign->id }}">
                                                <i class="fa fa-fw fa-plus"></i>exibir
                                            </button>
                                        </div>
            
                                        <button type"button" class="btn btn-xs btn-danger" onclick="deleteCampaign({{ $campaign->id }})">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="campaign-{{ $campaign->id }}">                      
                                    <td colspan=10>
                                        <ul class="list-group">                 
                                            @if( ($campaign->type === 'TXT') || ($campaign->type === 'ITXT') || ($campaign->type === 'VTXT') )
                                                <li class="list-group-item">
                                                    <strong>Texto:</strong>
                                                    <p>{{ $campaign->message }}</p>
                                                    <strong>Quantidade de caracteres:</strong>
                                                    <p>{{ $campaign->messageStrlen() }}</p>
                                                </li>
                                                @if( $campaign->type !== 'TXT')
                                                    <li class="list-group-item">
                                                        <strong>Arquivo:</strong>
                                                        <p>{{ $campaign->campaign_file->name }}</p>
                                                        <strong>Extensão:</strong>
                                                        <p>{{ $campaign->campaign_file->extension() }}</p>
                                                        <strong>Tamanho:</strong>
                                                        <p>{{ $campaign->campaign_file->size() }}</p>
                                                    </p>
                                                    </li>
                                                @endif
                                            @else

                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-right">
                        {{ $campaigns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <form id="delete-campaign-form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    @include('campaigns.includes.add_form')
    @include('users.includes.form')
@stop

@section('js')

<script src="{{ asset('js/app.js') }}"></script>
@stop