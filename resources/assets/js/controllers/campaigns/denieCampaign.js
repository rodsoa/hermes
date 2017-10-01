function approveCampaign( id ) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url = "/api/campaigns/"+id+"/denie";

    $.post(url, function (response) {
        console.log( response.msg );
        location.reload();
    });
}