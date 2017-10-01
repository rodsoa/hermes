<!-- Modal -->
<div class="modal fade" id="number-lists-add-form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de nova lista</h4>
            </div>

            <div class="modal-body">
                <div class="alert alert-warning" role="alert"> 
                    <p>
                        Os arquivos contendo as listas devem seguir um padrão pré-definido de um número por linha.
                        <b>Ex de número:</b> <i>(99) 999999999</i>
                        
                    </p>
                </div>
                
                <hr />

                <form id="number-lists-add-form" action="{{ route('campaigns.number-lists.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                    <div class="form-group">
                        <label for="number-list-name">Nome</label>
                        <input type="text" class="form-control" id="number-list-name" name="name" placeholder="Nome da lista" required>
                    </div>
            
                    <div class="form-group">
                        <label for="number-list-file">Lista de números</label>
                        <input type="file" id="number-list-file" name="number_list" required>
                        <p class="help-block">
                            Tamanho máximo 3mb<br/>
                            Faça upload do arquivo seguindo as orientações.
                        </p>
                    </div>
                    
                    <hr />

                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"
                            onclick="$('#number-lists-add-form').each(function(){this.reset();});">
                            <i class="fa fa-fw fa-arrow-circle-left"></i>Voltar
                        </button>

                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">
                            Cadastrar lista
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>