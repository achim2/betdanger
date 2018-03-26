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

    var deleteTrigger = $('.delete_content_trigger');

    //delete confirm
    deleteTrigger.on('click', function (e) {

        var deleteModal = $('#delete-content-modal');
        var category = deleteModal.attr("data-category");
        var id = $(this).attr("id");
        var eventName = $(this).attr("name");
        var thisTrigger = $(this);

        $("#modal-msg-name").empty().append(eventName);

        deleteModal
            .modal({backdrop: 'static', keyboard: true})
            .one('click', '#delete', function (e) {
                e.preventDefault();
                // window.location.href = DELURL;

                $.ajax({
                    url: '/admin/delete_' + category + '/' + id,
                    success: function (data) {
                        deleteModal.modal('hide');
                        thisTrigger.parent().parent().hide(750);

                    },
                    error: function (data) {
                        // console.log(data);
                    }

                });
            })
    });

    $('.js-go-back').on('click', function () {
        window.history.back();
    })

});