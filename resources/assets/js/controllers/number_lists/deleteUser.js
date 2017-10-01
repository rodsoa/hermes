function deleteNumberList( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-number-lists-form').attr('action', '/campaigns/number-lists/'+id);
        $('#delete-number-lists-form').submit();
    }
}