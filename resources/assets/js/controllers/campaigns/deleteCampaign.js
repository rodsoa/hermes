function deleteCampaign( id ) {
    if ( confirm('Você tem certeza dessa ação?') ) {
        $('#delete-campaign-form').attr('action', '/campaigns/'+id);
        $('#delete-campaign-form').submit();
    }
}