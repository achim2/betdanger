<?php $options = $this->options; ?>

<?php $logged_in = $this->session->userdata('logged_in'); ?>
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

                <?php if ($options['tags'] == 1): ?>
                    <div class="my-2 text-center">
                        <?php if (is_array($this->content->tag_names) && !empty($this->content->tag_names)): ?>
                            <?php foreach ($this->content->tag_names as $name): ?>
                                <a class="tag-name" href="<?php echo base_url("/tag/$name") ?>">#<?php echo $name; ?> </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

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

                    <?php if ($options['author'] == 1): ?>
                        <span>written: <?php echo $this->content->author; ?></span>
                    <?php endif; ?>

                </div>
                <div class="mb-2">category: <?php echo ucfirst($this->content->category_name); ?></div>

                <?php if ($options['image'] == 1): ?>
                    <img class="img-fluid mb-3"
                         src="/assets/images/uploaded/<?php echo $this->content->image_name; ?>"
                         alt="<?php echo $this->content->image_name; ?>"
                    >
                <?php endif; ?>

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

        //add comments
        general_ajax_call('form#add_comment', '/comment/add_comment_process/<?php echo $this->content->id; ?>', get_comments);

        //get comments
        function get_comments() {
            $.ajax({
                url: "/comment/get_comments/<?php echo $this->content->id; ?>",
                type: 'post',
                dataType: "json",
                success: function (data, status, xhr) {
                    output.empty();

                    if (data.comment.length !== 0) {
                        output.append(data.comment);
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

        //not ready
        //edit comment
        $(document).on("click", '.js-edit-comment', function () {
            var thisComment = $(this).parents('div.comment');
            var comID = thisComment.attr('id');
            var textP = thisComment.find('.comment__text');
            var form = thisComment.find('.comment__form');

            textP.slideUp();
            form.slideDown();

            var inputSubmit = '.js-submit-comment';

            $(document).on("click", inputSubmit, function (e) {
                e.preventDefault();

                var inputEditComment = form.find("input[name='edit_comment']").val();

                $.ajax({
                    url: "/comment/edit_comment_process/" + comID,
                    data: {'edit_comment': inputEditComment},
                    type: 'post',
                    dataType: "json",
                    cache: true,
                    success: function (data) {
                        if (data.success === true) {
                            // get_comments();
                            window.location.href = "<?php echo base_url('/page/' . $this->content->slug);?>";


                        } else {
                            alert(data.message.edit_comment);
                        }
                    },
                    error: function () {
                    }
                })
            });
        });

        //change comment status
        $(document).on("click", '.js-comment-status', function () {
            var comID = $(this).parents('div.comment').attr('id');
            var status = '';

            if ($(this).hasClass('js-disable-comment')) {
                status = 'disable';

            } else if ($(this).hasClass('js-enable-comment')) {
                status = 'enable';

            } else {
                status = null;
            }

            $.ajax({
                url: "/comment/change_commit_status/" + comID + "/" + status,
                success: function (data) {
                    get_comments();
                },
                error: function () {
                }
            })
        });

        //delete comment
        $(document).on("click", ".js-delete-comment", function () {
            var comDOM = $(this).parents('div.comment');
            var comID = comDOM.attr('id');

            var myModal = $('#delete-comment-modal');
            myModal.modal({backdrop: 'static', keyboard: true})
                .one('click', '#delete', function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: "/comment/del_comment/" + comID,
                        success: function (data, status) {
                            myModal.modal('hide');
                            get_comments();

                        },
                        error: function () {
                        }
                    })
                })
        });

    });
</script>


