$(document).ready(function () {

    //TILT TOGGLE
    $(document).on("change", '.tilt-toggle', function (e) {
        e.preventDefault();

        var userID = $(this).attr('id');
        var label = $("[for='toggle-" + userID + "']");

        $.ajax({
            url: '/user/tilt_toggle/' + userID,
            data: $(this).serialize(),
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.option === 'verified') {
                    label.text('Verified');
                }
                else {
                    label.text('Tilted');
                }
            }
        })
    });


    //STATUS TOGGLE
    $(document).on("change", '.status-toggle', function (e) {
        e.preventDefault();

        var contentID = $(this).attr('id');
        var label = $("[for='toggle-" + contentID + "']");

        $.ajax({
            url: '/admin/status_toggle/' + contentID,
            data: $(this).serialize(),
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.option === 'public') {
                    label.text('Public');
                }
                else {
                    label.text('Not public');
                }
            }
        })
    });

    //OPTION TOGGLE
    $(document).on("change", '.option-toggle', function (e) {
        e.preventDefault();

        var optionID = $(this).attr('id');
        var label = $("[for='toggle-" + optionID + "']");

        $.ajax({
            url: '/admin/option_toggle/' + optionID,
            data: $(this).serialize(),
            type: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.option === 1) {
                    label.text('On');
                }
                else {
                    label.text('Off');
                }
            }
        })
    });
});