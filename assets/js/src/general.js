$(document).ready(function () {

    //Bootstrap modal from another modal
    //make a trigger
    var trigger = $('a[data-modal-close]');
    trigger.click(function (e) {
        e.preventDefault();

        //close the current modal
        var modalClose = $(this).attr('data-modal-close');
        //open the next modal
        var modalOpen = $(this).attr('data-modal-open');

        $(modalClose + '.modal')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                $(modalOpen + '.modal').modal('show');

            });
    });

    //Dismiss the login message after 5 sec
    var flash_alert = $('p.flash_alert');
    setTimeout(function () {
        flash_alert.slideUp(1000)
    }, 5000);

    var deleteTrigger = '.delete_content_trigger';

    //delete confirm
    $(document).on('click', deleteTrigger, function () {
    // deleteTrigger.on('click', function () {
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
    });

    $('#tags').tagsInput({
        'height': '100px',
        'width': '300px',
        'defaultText': 'add a tag'
    });

    //profile page btn text
    var btnCollapsed = $('.accordion a.collapsed');
    btnCollapsed.on('click', function () {
        btnCollapsed.text('expand');

        if ($(this).hasClass('collapsed')) {
            $(this).text('collapse');
        } else {
            $(this).text('expand');
        }
    });
});