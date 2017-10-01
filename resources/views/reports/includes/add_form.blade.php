<!-- Modal -->
<div class="modal fade" id="report-add-form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de relatório</h4>
            </div>

            <div class="modal-body">
                <form id="reports-add-form" action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="report-campaign-user">Usuário</label>
                        <select class="form-control" id="report-campaign-user" name="user_id" required>
                            <option>SELECIONE UM USUÁRIO</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="report-campaign">Tipo de campanha</label>
                        <select class="form-control" id="report-campaign" name="campaign_id" required>
                            <option>SELECIONE UMA CAMPANHA</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="report-name">Título</label>
                        <input type="text" class="form-control" id="report-name" name="name" placeholder="título do relatório" required>
                    </div>   

                    <div class="form-group">
                        <label for="report-file">Arquivo</label>
                        <input type="file" class="form-control" id="report-file" name="file" placeholder="arquivo" required>
                        <p class="help-block">
                            Tamanho máximo 4mb<br/>
                            Faça upload do arquivo seguindo as orientações.
                        </p>
                    </div> 

                    <hr />

                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"
                            onclick="$('#reports-add-form').each(function(){this.reset();});">
                            <i class="fa fa-fw fa-arrow-circle-left"></i>Voltar
                        </button>

                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">
                            Cadastrar relatório
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>