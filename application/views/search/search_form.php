<!-- search form -->
<div id="search_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="search">
                    <p class="s-info">find your event, buy a ticket, have fun</p>
                    <div class="form-wrapper">
                        <form class="search-form form-inline">
                            <input class="form-control mr-sm-2" type="text" name="search" id="execute_search" placeholder="Type & Enter">
                            <button type="submit" class="d-none"></button>
                        </form>
                        <div class="search-output"></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var output = $('.search-output');

        $('#execute_search').keyup(function () {
            var txt = $(this).val();
            console.log('(' + txt + ')');

            output.hide().empty();

            if (txt.length < 3) {
                output.empty().hide();

            } else {

                $.ajax({
                    url: '/search/execute_search',
                    data: {search: txt},
                    type: 'post',
                    dataType: 'json',
                    success: function (data, status, xhr) {
//                    console.log('SUCCESS');
//                    console.log(data);
//                    console.log(data.url);
                        $.each(data.result, function (i, value) {
                            console.log(value);
                            output.show().append('<a href="' + data.url + value.slug + '" class="searched-item">' + value.title + '</a>');
                        });

                    },
                    error: function (data, status, xhr) {
                        console.log('ERROR');
//                        console.log(data);
//                        console.log(status);
//                        console.log(xhr);
                    }
                })
            }
        })
    });
</script>