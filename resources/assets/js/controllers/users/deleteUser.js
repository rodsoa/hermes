function deleteUser( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-users-form').attr('action', '/users/'+id);
        $('#delete-users-form').submit();
    }
}