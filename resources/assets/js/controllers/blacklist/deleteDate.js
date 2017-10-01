function deleteDate( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-blacklist-form').attr('action', '/blacklist/'+id);
        $('#delete-blacklist-form').submit();
    }
}