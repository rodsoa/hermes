@extends('adminlte::page')

@section('title', 'Start Comunicação - Sistema Hermes')

@section('content_header')
    <h1>Usuários <small>Listagem geral</small></h1>

    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-fw fa-home"></i>
                Início
            </a>
        </li>
        <li>
            <a class="active" href="#">Usuários</a>
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
                    <h3 class="box-title">Usuários cadastrados no sistema</h3>
                </div>
                <div class="box-body">
                    <button  class="btn btn-primary" data-toggle="modal" data-target="#users-add-form-modal">
                        <i class="fa fa-fw fa-plus"></i> Cadastrar usuário
                    </button>
                    <table id="users-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Categoria</th>
                                <th>Créditos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        @if( $user->status != 'W' )
                                            @if( $user->status == 'A' )
                                                <span style="color: #71BA51">Aprovado</span>
                                            @else
                                                <span style="color: #CF000F">Negado</span>
                                            @endif
                                        @else
                                            <span style="color: #E75926">aguardando aprovação...</span>                                           
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->category === 'ADMIN')
                                            <i>Administrador</i>
                                        @else
                                            <i>Cliente</i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( isset($user->credit) )
                                            <strong>{{ $user->credit->total }}</strong>
                                        @else
                                            <strong>Não habilitado</strong>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if( isset($user->credit) )
                                            <button type="button" class="btn btn-xs btn-success" onclick="editUserCredits({{ $user->id }}, {{ $user->credit->id }}, {{ $user->credit->total }})">
                                                <i class="fa fa-fw fa-money"></i> créditos
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-xs btn-success" onclick="enableUserCredits({{ $user->id }})">
                                                <i class="fa fa-fw fa-money"></i> habilitar créditos
                                            </button>
                                        @endif

                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                            <button type"button" class="btn btn-warning btn-default" onclick="editUser({{ $user->id }})">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </button>
                                        </div>
            
                                        <button type"button" class="btn btn-xs btn-danger" onclick="deleteUser({{ $user->id }})">
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
    
    <form id="delete-users-form" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

    @include('users.includes.add_form')
    @include('users.includes.form')
@stop

@section('js')
<script>
  $(function () {
    $('#users-table').DataTable({
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