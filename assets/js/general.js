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


    // SET DROPDOWN
    //custom dropdown ( DD == dropdown )

    var nav = $('nav');
    var allDDTrigger = $('a[data-set-dropdown]');
    // console.log(allDDTrigger);

    allDDTrigger.on('click', function () {

        var clickedTrigger = $(this);
        // console.log(clickedTrigger);
        var clickedDDName = $(this).attr('data-set-dropdown');
        // console.log(clickedDDName);
        var clickedDD = nav.find(clickedDDName);
        // console.log(clickedDD);

        allDDTrigger.each(function () {
            var allDDName = $(this).attr('data-set-dropdown');
            var allDD = nav.find(allDDName);
            // console.log(allDD);
            allDD.not(clickedDD).removeClass('open');
            allDDTrigger.not(clickedTrigger).removeClass('open');
        });

        if (clickedDD.hasClass('open')) {
            clickedDD.removeClass('open');
            clickedTrigger.removeClass('open');

        } else {
            clickedDD.addClass('open');
            clickedTrigger.addClass('open');
        }

    });


    $(window).on('click', function (event) {

        allDDTrigger.each(function () {

            var allDDName = $(this).attr('data-set-dropdown');
            var allDD = nav.find(allDDName);
            var allDDParent = allDD.parent();
            // console.log(allDDParent);

            if (!$(event.target).closest(allDDParent).length) {
                if (allDDParent.data('clicked', true)) {
                    allDDParent.children().removeClass('open');
                }
            }

            // console.log(allDDParent.children().last().children());

            allDDParent.children().last().children().click(function () {
                allDDParent.children().removeClass('open') ;
            })


        });
    });

    //END DROPDOWN


    //delete confirm at admin
    $('.del_event_trig').on('click', function (e) {

        var delModal = $('#del_event_modal');
        var id = $(this).attr("id");
        var eventTitle = $(this).attr("name");
        var tr = $(this);

        $("b#ev_title").empty().append(eventTitle);

        delModal
            .modal({backdrop: 'static', keyboard: true})
            .one('click', '#delete', function (e) {
                e.preventDefault();
                // window.location.href = DELURL;

                $.ajax({
                    url: '/events/delete_event/' + id,
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


});