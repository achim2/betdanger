<?php $logged_in = $this->session->userdata('logged_in'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article class="p-3 bg-white">
                <h4 class=""><?php echo $this->content->title; ?></h4>
                <div class="mb-2">
                    <?php if (is_array($this->content->tag_names) && !empty($this->content->tag_names)): ?>
                        <?php foreach ($this->content->tag_names as $name): ?>
                            <a class="tag-name" href="<?php echo base_url("/tag/$name") ?>">#<?php echo $name; ?> </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="d-flex flex-column flex-lg-row justify-content-between">
                    <span><?php echo $this->mylib->custom_dateTime($this->content->created_at); ?></span>
                    <span>written: <?php echo $this->content->username; ?></span>
                </div>
                <div class="mb-2">category: <?php echo ucfirst($this->content->category_name); ?></div>
                <img class="img-fluid mb-3"
                     src="/assets/images/uploaded/<?php echo $this->content->image_name; ?>"
                     alt="<?php echo $this->content->image_name; ?>"
                >
                <p class="mx-2"><?php echo $this->content->body; ?></p>
            </article>

<!--            --><?php //if () : ?>
                <section class="my-2 p-3 bg-white">
                    <h4 class="section-name">Comments</h4>
                </section>
<!--            --><?php //endif ?>

            <section class="mt-2 p-3 bg-white">
                <h4 class="section-name">Write comment</h4>
                <?php if (($logged_in != null) && ($logged_in != '')) : ?>

                    <form id="add_comment">
                        <div class="form-group">
                            <label for="comment" hidden></label>
                            <textarea id="comment" class="form-control" name="comment" rows="1"></textarea>
                        </div>
                        <div class="form-group m-0">
                            <input type="submit" class="btn btn-dark" value="Add">
                        </div>
                    </form>

                <?php else : ?>
                    <p>To write comment, log in</p>
                <?php endif; ?>
            </section>

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


