function editUserCredits( user_id, id, total ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.getJSON('/api/users/'+user_id, function (response) {
        $('#users-form-modal .modal-title').html('Editando créditos <b><i>' + response.name + '</i></b>');
        $('#users-form-modal.modal .modal-dialog').addClass('modal-sm');

        var body = document.querySelector('#users-form-modal .modal-body');
        
        var div = document.createElement('div');
        div.className = "form-group";

        var label = document.createElement('label')
        label.setAttribute('for', 'total');
        label.textContent = "Total";

        var input = document.createElement('input');
        input.className = "form-control";
        input.type = "number";
        input.name = "total";
        input.id = "total"; 

        div.appendChild( label );
        div.appendChild( input );
        body.appendChild( div );

        $('input[name=total]').attr('value', total);

        var old = $('#users-form-modal .modal-body').html();
        old += "<div class='text-right'><button type='button' class='btn btn-danger btn-flat' data-dismiss='modal'><i class='fa fa-fw fa-arrow-circle-left'></i>Cancelar</button>"
        old += "<button id='edit-credit' type='button' class='btn btn-warning btn-flat' style='margin-left: 6px;'>Editar creditos</button></div>";
        $('#users-form-modal .modal-body').html( old );

        $('#edit-credit').click(function (event) {
            var url = '/api/users/credits/'+id;

            console.log( id );
            console.log( url );
            console.log( 'Editando valores' );
            console.log( $('input[name=total]').val() );
        
            $.post(url, {user_id: user_id, id: id, total: $('input[name=total]').val()}, function (response) {
                console.log(response);
                location.reload();
            })
            .fail( function (error) {
                console.log( error );
            });
        });

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
