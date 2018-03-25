$(document).ready(function () {

    //Bootstrap modal from another modal
    //make a trigger
    trigger = $('a[data-modal-close]');
    trigger.click(function (e) {
        e.preventDefault();

        //close the current modal
        modalClose = $(this).attr('data-modal-close');
        // console.log(modalClose);

        //open the next modal
        modalOpen = $(this).attr('data-modal-open');
        // console.log(modalOpen);

        $(modalClose + '.modal')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                $(modalOpen + '.modal').modal('show');

            });
    });

    //Dismiss the login message after 5 sec
    $flash_alert = $('p.flash_alert');
    setTimeout(function () {
        $flash_alert.slideUp(1000)
    }, 5000);

    //delete confirm
    $('.del_content_trig').on('click', function (e) {

        var delModal = $('#del_content_modal');
        var id = $(this).attr("id");
        var eventTitle = $(this).attr("name");
        var tr = $(this);

        $("b#content_title").empty().append(eventTitle);

        delModal
            .modal({backdrop: 'static', keyboard: true})
            .one('click', '#delete', function (e) {
                e.preventDefault();
                // window.location.href = DELURL;

                $.ajax({
                    url: '/content/delete_content/' + id,
                    success: function (data) {
                        // console.log("siker");
                        delModal.modal('hide');
                        tr.parent().parent().hide(750);

                    },
                    error: function (data) {
                        // console.log("ERROR");
                        // console.log(data);
                    }


                });
            })
    });

    $('[data-goBack]').on('click', function () {
        console.log('clicked');
        window.history.back();
    })

});