<!-- Modal -->
<div class="modal fade" id="blacklist-add-form-modal" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bloqueio de data</h4>
            </div>

            <div class="modal-body">
                <form id="number-lists-add-form" action="{{ route('blacklist.store') }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="blacklist-date">Data</label>
                        <input type="date" class="form-control" id="blacklist-date" name="date" placeholder="Data" required>
                        <p class="help-block">
                            Escolha uma data para ser bloqueada nas definições de campanha
                        </p>
                    </div>    

                    <hr />

                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"
                            onclick="$('#number-lists-add-form').each(function(){this.reset();});">
                            <i class="fa fa-fw fa-arrow-circle-left"></i>Voltar
                        </button>

                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">
                            Bloquear data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>