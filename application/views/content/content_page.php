<div class="container">
    <div class="row">
        <div class="col-xl-7 offset-xl-1">
            <main>
                <article>
                    <h4 class="title"><?php echo $this->get_content->title; ?></h4>
                    <p class="info">
                        <span><?php echo $this->title . " | " . $this->get_content->created_at; ?></span>
                        <span>written: <?php echo $this->get_content->username; ?></span>
                    </p>
                    <img class="front-img img-fluid" src="/assets/images/uploaded/<?php echo $this->get_content->front_img; ?>" alt="<?php echo $this->get_content->title; ?>">
                    <p><?php echo $this->get_content->body; ?></p>
                </article>

                <h4 class="section-name">Comments</h4>
                <section class="list-comments">
                </section>

                <h4 class="section-name">Add comment</h4>
                <section class="write-comment">
                    <?php
                    $logged_in = $this->session->userdata('logged_in');

                    if (($logged_in != null) && ($logged_in != '')) {

                        ?>

                        <form id="add_comment">
                            <div class="form-group">
                                <label for="comment" hidden></label>
                                <textarea id="comment" class="form-control" name="comment" rows="1"></textarea>
                            </div>
                            <div class="form-group m-0">
                                <input type="submit" class="btn btn-dark" value="Add">
                            </div>
                        </form>

                        <?php
                    } else {
                        echo "To write comment, log in";
                    }
                    ?>
                </section>

            </main>
        </div>

        <div class="col-xl-3">
            <aside>
                <div class="categories">
                    <h4 class="section-name">daily bets</h4>
                    <ul>
                        <li><a href="#">Maecenas</a></li>
                        <li><a href="#">Pellentesque</a></li>
                    </ul>
                </div>

                <div class="categories">
                    <h4 class="section-name">useful tools</h4>
                    <ul>
                        <li><a href="#">Maecenas</a></li>
                        <li><a href="#">Pellentesque</a></li>
                        <li><a href="#">Donec</a></li>
                        <li><a href="#">Etiam</a></li>
                        <li><a href="#">Integer</a></li>
                        <li><a href="#">Lorem</a></li>
                        <li><a href="#">Proin</a></li>
                    </ul>
                </div>

            </aside>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var output = $('section.list-comments');

        function makeComment(data) {
            $.each(data, function (i, value) {
                output.append("" +
                    "<div class='comment' id=" + value.comment_id + ">" +
                    "<p class='info'>" +
                    "<span>" + value.username + "</span>" +
                    "<span>" +
                    "<span class='mr-2'>" + value.created_at + "</span>" +
//                    "<span class='ti-close del-com'></span>" +
                    "</span>" +
                    "</p>" +
                    "<p>" + value.body + "</p>" +
                    "</div>");
            });
        }

        //add comment
        $('#add_comment').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "/content/add_comment_process/<?php echo $this->get_content->content_id; ?>",
                data: $(this).serialize(),
                type: 'post',
                dataType: "json",
                success: function (data, status, xhr) {
//                    console.log(status);

                    output.empty();

                    makeComment(data.comment);

                    $("[name='comment'").val("");

                },
                error: function (status) {
                    console.log(status)
                }
            })

        });

        //get comments
        $.ajax({
            url: "/content/get_comments/<?php echo $this->get_content->content_id; ?>",
            type: 'post',
            dataType: "json",
            success: function (data, status, xhr) {
//                console.log(status);
//                console.log(data.comment.length);

                output.empty();

                if (data.comment.length !== 0) {

                    makeComment(data.comment);

                    $("[name='comment'").val("");


                } else {
                    output.append(
                        "<div class='comment'>" +
                        "<p>There is no comment yet. Be first!</p>" +
                        "</div>");
                }

            },
            error: function (status) {
                console.log(status)
            }
        });


        //delete comment :D
//        var delCom = $('.del-com');
//
//        delCom.on('click', function () {
//            console.log('clicked');
//            var comDOM = $(this).parents('div.comment');
//            var comID = comDOM.attr('id');
//            console.log(comDOM);
//            console.log(comID);
//
//            $.ajax({
//                url: "/content/del_com_by_user/" + comID,
//                success: function (data, status) {
//                    console.log(status);
//                    comDOM.slideUp('fast');
//
//                },
//                error: function () {
//                    console.log(status);
//                }
//            })
//        })

    })
</script>


