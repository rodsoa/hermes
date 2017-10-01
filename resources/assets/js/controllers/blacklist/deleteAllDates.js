function deleteAllDates( ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-blacklist-form').attr('action', '/blacklist/remove-all-dates');
        $('#delete-blacklist-form').submit();
    }
}