function editUser( id ) {
    $.getJSON('/api/users/'+id, function (response) {
        $('#users-form-modal .modal-title').html('Editando usuário <b><i>' + response.name + '</i></b>');

        var body = document.querySelector('#users-form-modal .modal-body');
        
        var form = document.createElement('form');
        form.id = "edit-form";
        form.method = "POST";
        form.action = "/users/"+id;

        var input_csrf = document.createElement('input');
        input_csrf.type = "hidden";
        input_csrf.name = "_token";
        input_csrf.value = $('meta[name="csrf-token"]').attr('content');

        var input_put = document.createElement('input');
        input_put.type = "hidden";
        input_put.name = "_method";
        input_put.value = "PUT";
        
        var div_status = document.createElement('div');
        div_status.className = "form-group has-feedback";

        var status = document.createElement('select');
        status.className = "form-control";
        status.name = "status";

        var option_w = document.createElement('option');
        option_w.setAttribute('value', 'W');
        if ( response.status === 'W' ) option_w.setAttribute('selected', true);
        option_w.text = 'Aguardando aprovação';

        var option_a = document.createElement('option');
        option_a.setAttribute('value', 'A');
        if ( response.status === 'A' ) option_a.setAttribute('selected', true);
        option_a.text = 'Aprovado';

        var option_d = document.createElement('option');
        option_d.setAttribute('value', 'D');
        if ( response.status === 'D' ) option_d.setAttribute('selected', true);
        option_d.text = 'Negado';
        
        status.appendChild( option_w );
        status.appendChild( option_a);
        status.appendChild( option_d);

        div_status.appendChild( status );

        var div_category = document.createElement('div');
        div_category.className = "form-group has-feedback";

        var category = document.createElement('select');
        category.className = "form-control";
        category.name = "category";

        var option_admin = document.createElement('option');
        option_admin.setAttribute('value', 'ADMIN');
        if ( response.category == 'ADMIN' ) option_admin.setAttribute('selected', true);
        option_admin.text = 'Administrador';

        var option_customer = document.createElement('option');
        option_customer.setAttribute('value', 'CUSTOMER');
        if ( response.category == 'CUSTOMER' ) option_customer.setAttribute('selected', true);
        option_customer.text = 'Cliente';

        category.appendChild( option_admin );
        category.appendChild( option_customer);

        div_category.appendChild( category );
        
        var div_name = document.createElement('div');
        div_name.className = "form-group has-feedback";

        var name = document.createElement('input');
        name.className = "form-control";
        name.setAttribute('name', 'name');
        name.setAttribute('value', response.name);

        var span_name = document.createElement('span');
        span_name.className = "glyphicon glyphicon-user form-control-feedback";

        div_name.appendChild( name );
        div_name.appendChild( span_name );

        var div_email = document.createElement('div');
        div_email.className = "form-group has-feedback";

        var email = document.createElement('input');
        email.className = "form-control";
        email.setAttribute('name', 'email');
        email.setAttribute('type', 'email');
        email.setAttribute('value', response.email);

        var span_email = document.createElement('span');
        span_email.className = "glyphicon glyphicon-envelope form-control-feedback";

        div_email.appendChild( email );
        div_email.appendChild( span_email );

        var div_password = document.createElement('div');
        div_password.className = "form-group has-feedback";

        var password = document.createElement('input');
        password.className = "form-control";
        password.setAttribute('name', 'password');
        password.setAttribute('type', 'password');
        password.setAttribute('placeholder', 'Senha');

        var span_password = document.createElement('span');
        span_password.className = "glyphicon glyphicon-lock form-control-feedback";

        div_password.appendChild( password );
        div_password.appendChild( span_password );

        var div_password_confirmation = document.createElement('div');
        div_password_confirmation.className = "form-group has-feedback";

        var password_confirmation = document.createElement('input');
        password_confirmation.className = "form-control";
        password_confirmation.setAttribute('name', 'password_confirmation');
        password_confirmation.setAttribute('type', 'password');
        password_confirmation.setAttribute('placeholder', 'Repita a senha');
        
        var span_password_confirmation = document.createElement('span');
        span_password_confirmation.className = "glyphicon glyphicon-log-in form-control-feedback";

        div_password_confirmation.appendChild( password_confirmation );
        div_password_confirmation.appendChild( span_password_confirmation );

        /*var button_submit = document.createElement('button');
        button_submit.setAttribute('type', 'submit');
        button_submit.className = "btn btn-warning";
        button_submit.textContent = "Atualizar usuário";*/

        form.appendChild( input_csrf );
        form.appendChild( input_put );
        form.appendChild( div_status );
        form.appendChild( div_category );
        form.appendChild( div_name );   
        form.appendChild( div_email );
        form.appendChild( div_password );
        form.appendChild( div_password_confirmation );
        //form.appendChild( button_submit );

        body.appendChild( form );

        var old = $('#edit-form').html();
        old += "<div class='text-right'><button type='button' class='btn btn-danger btn-flat' data-dismiss='modal'><i class='fa fa-fw fa-arrow-circle-left'></i>Cancelar</button>"
        old += "<button type='submit' class='btn btn-warning btn-flat' style='margin-left: 6px;'>Editar usuário</button></div>";
        $('#edit-form').html( old );

        console.log(body);

        $('#users-form-modal .modal-footer').html(' ');
        $('#users-form-modal').modal('show');
        console.log( response );
    });

    // Limpeza ao final
    $('#users-form-modal .modal-title').html(' ');
    $('#users-form-modal .modal-body').html(' ');
    $('#users-form-modal .modal-footer').html(' ');
}
