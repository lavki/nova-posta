$('document').ready(function() {
    $('button[id="ajax"]').click(function () {
        var dateInterval = $('#dateInterval').val();

        $.get('/', {dateInterval: dateInterval}, function (data) {
            console.log(data);
        });

        return false;
    });
});