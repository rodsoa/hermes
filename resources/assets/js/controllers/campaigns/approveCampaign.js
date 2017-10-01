function approveCampaign( id ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url = "/api/campaigns/"+id+"/approve";

    $.post(url, function (response) {
        console.log( response.msg );
        location.reload();
    });
}