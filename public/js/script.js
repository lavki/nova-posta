$('document').ready(function() {

    // send as ajax request
    $('button[id="ajax"]').click(function () {
        var dateInterval = $('textarea[id="dateInterval"]').val();

        $.get('/', {dateInterval: dateInterval}, function (data) {
            if(data.length > 0) {
                var result = $.parseJSON(data);
                var info = '';

                if(result.errors) {
                    for(var item in result.errors) {
                        info += "<p>" + result.errors[item] + "</p>";
                    }
                    $('#result').html(info).removeClass('success').addClass('error');
                } else if(result.result) {
                    info += "<p>" + result.result + "</p>";
                    $('#result').html(info).removeClass('error').addClass('success');
                }
            }
        });

        return false;
    });

});