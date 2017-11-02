<div class="container">
    <div class="row">
        <div class="col-12">
            <section class="edit_content">
                <h2 class="text-secondary mb-3">Esemény szerkesztése</h2>
                <?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>

                <form id="edit_content">
                    <div class="form-wrapper">
                        <div class="form-group">
                            <label for="title" class="text-secondary"><b>Title *</b></label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $this->get_content->title; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="content" class="text-secondary"><b>Content *</b></label>
                            <textarea type="text" class="form-control" id="content" name="content" rows="4"><?php echo $this->get_content->body; ?></textarea>
                        </div>
                        <div class="form-group d-flex">
                            <div class="mr-5">
                                <label for="image_file" class="text-secondary"><b>Current pics</b></label><br>
                                <img class="" width="300px" src="/assets/images/uploaded/<?php echo $this->get_content->front_img; ?>" alt="<?php echo $this->get_content->front_img; ?>">
                            </div>
                            <div class="">
                                <label for="image_file" class="text-secondary"><b>Add new img, if you want</b></label>
                                <input type="file" class="form-control-file" id="image_file" name="image_file"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="text-secondary"><b>Category *</b></label>
                            <select name="category" id="category" class="form-control">
                                <option value="preview" <?php if ($this->get_content != null && $this->get_content->category == 'preview') echo 'selected'; ?>>preview</option>
                                <option value="blog" <?php if ($this->get_content != null && $this->get_content->category == 'blog') echo 'selected'; ?>>blog post</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="text-secondary"><b>Status *</b></label>
                            <select name="status" id="status" class="form-control">
                                <option value="not public" <?php if ($this->get_content != null && $this->get_content->status == 'not public') echo 'selected'; ?>>not public</option>
                                <option value="public" <?php if ($this->get_content != null && $this->get_content->status == 'public') echo 'selected'; ?>>public</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-success" value="Hozzáadás">
                        <a class="btn btn-secondary" href="/content">Vissza</a>
                    </div>
                </form>

            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //ajax edit content
        general_ajax_call('form#edit_content', '/content/edit_content_process/<?php echo $this->get_content->slug; ?>');
    })
</script>
