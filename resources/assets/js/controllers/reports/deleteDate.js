function deleteReport( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-report-form').attr('action', '/reports/'+id);
        $('#delete-report-form').submit();
    }
}