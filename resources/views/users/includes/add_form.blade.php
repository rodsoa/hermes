<!-- Modal -->
<div class="modal fade" id="users-add-form-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastro de novo usuário</h4>
            </div>

            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback">
                        <select name="category" class="form-control">
                            <option value="customer">CLIENTE</option>
                            <option value="admin">ADMINISTRADOR</option>
                        </select>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="{{ trans('adminlte::adminlte.full_name') }}" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="{{ trans('adminlte::adminlte.email') }}" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" name="password" class="form-control"
                            placeholder="{{ trans('adminlte::adminlte.password') }}" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="{{ trans('adminlte::adminlte.retype_password') }}" required>
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-fw fa-arrow-circle-left"></i>Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-flat" style="margin-left: 3px;">Cadastrar novo usuário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>