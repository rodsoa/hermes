function enableUserCredits( id ) {
    var url = '/api/users/credits';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.post(url, {user_id: id, total: 15}, function (response) {
        console.log(response);
        location.reload();
    });
}