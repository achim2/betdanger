$(document).ready(function () {

});

//GENERAL FUNCTION FOR AJAX CALLS
function general_ajax_call(form_id, ajaxurl) {

    var form = $(form_id);
    //make clear id for the custom_alert div
    var clear_form_id = form_id.replace("form#", "cl_");

    // var form = $('form#change_pass');
    form.prepend("<div id='" + clear_form_id + "' class='custom_alert alert' style='display: none; margin: 10px 0;'></div>");

    form.submit(function (e) {
        var alert = $('div#' + clear_form_id);
        alert.slideUp(0).removeClass('alert-danger alert-success').empty();
        // $('input').parent().removeClass('has-danger');
        // $('textarea').parent().removeClass('has-danger');

        $.ajax({
            // url: '/user/update_pass',
            url: ajaxurl,
            // data: $(this).serialize(),
            data: new FormData(this),
            method: 'post',
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                function alert_messages() {
                    $.each(data.message, function (index, value) {
                        // console.log(index);
                        form
                            .find(alert)
                            .prepend("<span>" + value + "</span><br/>");
                    });
                }

                //if $jsonData['success'] = true
                if (data.success === true) {

                    //redirect if success message don't need
                    if (data.redirect) {
                        window.location.href = data.redirect;

                    } else {
                        //show success messages if redirect not necessary
                        alert_messages();
                        console.log('data-success');
                        alert.slideDown(500).addClass('alert-success');

                        $(':input', form)
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .removeAttr('checked')
                            .removeAttr('selected');

                        setTimeout(function () {
                            alert.slideUp(500);
                        }, 5000);
                    }

                } else {
                    //error messages
                    alert_messages();
                    console.log('data-error');
                    alert.slideDown(500).addClass('alert-danger');
                }
            }
        });

        e.preventDefault();
    })
}
