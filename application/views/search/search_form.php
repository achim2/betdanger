<!-- search form -->
<div id="search_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search</h5>
                <span class="icon icon-close" data-dismiss="modal"></span>

            </div>
            <div class="modal-body">
                <section class="search">
                    <div class="form-wrapper">
                        <p>Find your ...</p>
                        <form class="search-form">
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
        output.hide().empty();

        $('#execute_search').keyup(function () {
            var txt = $(this).val();
            console.log('(' + txt + ')');

            output.hide().empty();

            if (txt.length < 1) {
                output.empty().hide();
            } else {

                $.ajax({
                    url: '/search/execute_search',
                    data: {search: txt},
                    type: 'post',
                    dataType: 'json',
                    success: function (data, status, xhr) {
                        console.log(data);

                        if (data.result.length !== 0) {
                            output.show().append('<a ' +
                                'href="' + data.url + 'search_result/' + txt + '" ' +
                                'class="show-results"' +
                                '>Search results: (' + data.result.length + ')</a>');
                        } else {
                            output.show().append('<a class="show-results">Search results: No result! </a>');
                        }

                        $.each(data.result, function (i, value) {
                            // console.log(value);
                            output.show().append('<a href="' + data.url + 'page/' + value.slug + '" class="searched-item">' + value.title + '</a>');
                        });

                    },
                    error: function (data, status, xhr) {
                        // console.log('error');
                    }
                })
            }
        })
    });
</script>