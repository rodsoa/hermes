$('#reports-add-form #report-campaign-user').change(function(event){
    var user_id = $('#reports-add-form #report-campaign-user').val();

    console.log( user_id );

    $.getJSON('/api/users/'+user_id+'/campaigns', function (response) {
        var select = document.querySelector('#reports-add-form #report-campaign');

        response.forEach(function(element) {
            var option = document.createElement('option');
            option.value = element.id;
            option.text = element.name;
            select.appendChild( option );
        }, this);


        console.log( response );
        console.log( response.length )
    });
});