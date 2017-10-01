function showUser( id ) {
    $.getJSON('/api/users/'+id, function (response) {
        $('#users-form-modal .modal-title').html('Exibindo usuário <b><i>' + response.name + '</i></b>');
        
        
        
        $('#users-form-modal').modal('show');
        console.log( response );
    });

    // Limpeza ao final
    $('#users-form-modal .modal-title').html(' ');
    $('#users-form-modal .modal-body').html(' ');
}