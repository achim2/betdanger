<?php $logged_in = $this->session->userdata('logged_in'); ?>
<?php var_dump($this->session->userdata()); ?>

<div id="delete-comment-modal"
     class="modal fade"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Content</h5>
                <span class="icon icon-close" data-dismiss="modal"></span>
            </div>
            <div class="modal-body">
                <p class="modal-message"> Do you really want to delete this comment? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete">Törlés</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
            </div>
        </div>
    </div>
</div>

<div class="title-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                <h2 class="text-white"><?php echo $this->content->title; ?></h2>
                <div class="my-2 text-center">
                    <?php if (is_array($this->content->tag_names) && !empty($this->content->tag_names)): ?>
                        <?php foreach ($this->content->tag_names as $name): ?>
                            <a class="tag-name text-white" href="<?php echo base_url("/tag/$name") ?>">#<?php echo $name; ?> </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <article class="p-3 bg-white">
                <div class="d-flex flex-column flex-lg-row justify-content-between">
                    <span>created at: <?php echo $this->mylib->custom_dateTime($this->content->created_at); ?></span>
                    <span>written: <?php echo $this->content->username; ?></span>
                </div>
                <div class="mb-2">category: <?php echo ucfirst($this->content->category_name); ?></div>
                <img class="img-fluid mb-3"
                     src="/assets/images/uploaded/<?php echo $this->content->image_name; ?>"
                     alt="<?php echo $this->content->image_name; ?>"
                >
                <p class="mx-2"><?php echo $this->content->body; ?></p>
            </article>

            <section class="my-2 p-3 bg-white list-comments">
                <h4 class="section-name">Comments</h4>
            </section>

            <section class="mt-2 p-3 bg-white">
                <h4 class="section-name">Write comment</h4>
                <?php if (($logged_in != null) && ($logged_in != '')) : ?>

                    <form id="add_comment">
                        <div class="form-group">
                            <label for="comment" hidden></label>
                            <textarea id="add_comment_textarea" class="form-control" name="comment" rows="1"></textarea>
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

        //add comment
        var addComment = $('#add_comment');
        addComment.submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "/content/add_comment_process/<?php echo $this->content->id; ?>",
                data: $(this).serialize(),
                type: 'post',
                dataType: "json",
                success: function (data, status, xhr) {

                    if (data.success === true) {
                        console.log(data);
                        output.empty();
                        $("#add_comment_textarea").val("");
                        get_comments();

                    } else {
                        alert(data.message.comment);
                    }
                },
                error: function (status) {
                }
            })
        });

        //get comments
        function get_comments() {
            $.ajax({
                url: "/content/get_comments/<?php echo $this->content->id; ?>",
                type: 'post',
                dataType: "json",
                success: function (data, status, xhr) {
                    output.empty();

                    if (data.comment.length !== 0) {
                        output.append(data.comment);
                        // console.log(data.comment);

                        $("#add_comment_textarea").val("");

                    } else {
                        output.append(
                            "<div class='comment empty'>" +
                            "<span>There is no comment yet. Be the first!</span>" +
                            "</div>");
                    }
                },
                error: function (status) {
                }
            });
        }

        get_comments();

        //edit comment

        //change comment status
        $(document).on("click", '.js-comment-status', function () {
            var comDOM = $(this).parents('div.comment');
            var comID = comDOM.attr('id');
            var status = '';

            if ($(this).hasClass('js-disable-comment')) {
                status = 'disable';

            } else if ($(this).hasClass('js-enable-comment')) {
                status = 'enable';

            } else {
                console.log('false');
            }

            $.ajax({
                url: "/content/change_commit_status/" + comID + "/" + status,
                success: function (data) {
                    get_comments();
                },
                error: function () {
                    console.log('error');
                }
            })
        });

        //delete comment
        $(document).on("click", ".js-delete-comment", function () {
            var comDOM = $(this).parents('div.comment');
            var comID = comDOM.attr('id');
            console.log(comDOM);
            console.log(comID);

            var myModal = $('#delete-comment-modal');
            myModal.modal({backdrop: 'static', keyboard: true})
                .one('click', '#delete', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: "/content/del_comment/" + comID,
                        success: function (data, status) {
                            comDOM.slideUp('fast');
                            myModal.modal('hide');
                        },
                        error: function () {
                        }
                    })
                })
        })

    });
</script>


