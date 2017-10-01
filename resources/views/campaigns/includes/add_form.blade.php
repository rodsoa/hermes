<!-- Modal -->
<div class="modal fade" id="add-form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de nova campanha</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert"> 
                    <p>
                        <strong>Aviso:</strong> Antes de criar a campanha verifique todos os dados relevantes para não ocorrer 
                        nenhum erro no processamento ou que a mesma não seja negada pelos administradores. Tenha em mente que após aprovada e iniciado os trabalhos
                        a campanha em questão <i><b>não poderá ser deletada</b></i>.Qualquer divergência, favor contactar o suporte.          
                    </p>
                </div>
                
                <hr />

                <form id="campaign-add-form" action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}       
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="form-group">
                                <label for="campaign-name">Nome</label>
                                <input type="text" class="form-control" id="campaign-name" name="name" placeholder="Nome da campanha" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label for="campaign-type">Tipo de campanha</label>
                                <select class="form-control" id="campaign-type" name="type" required>
                                    <option>SELECIONE UM TIPO</option>
                                    <option value="TXT">TEXTO</option>
                                    <option value="ITXT">IMAGEM E TEXTO</option>
                                    <option value="VTXT">VÍDEO E TEXTO</option>
                                    <option value="PDF">PDF</option>
                                    <option value="AUDIO">AUDIO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label for="campaign-launching-date">Data para lançamento</label>
                                <input type="date" class="form-control" id="campaign-lauching-date" name="date" placeholder="Data de lançamento" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="form-group">
                                <label for="campaign-number-list">Lista de números</label>
                                <div class="input-group">
                                    <select class="form-control" id="campaign-number-list" name="number_list_id" required>
                                        <option>SELECIONE UMA LISTA</option>
                                        @foreach( $number_lists as $list )
                                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a role="button" class="btn btn-default" type="button" href="{{ route('campaigns.number-lists.index') }}"><i class="fa fa-fw fa-plus"></i>Nova</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="type-content">
                    </div>
                    
                    <hr />

                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"
                            onclick="$('#campaign-add-form').each(function(){this.reset();});">
                            <i class="fa fa-fw fa-arrow-circle-left"></i>Voltar
                        </button>

                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">
                            Cadastrar campanha
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>