<div class="container">
    <div class="row">
        <div class="col-12">
            <section class="add_content">
                <h2 class="text-secondary mb-3">Esemény hozzáadása</h2>
                <?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>
                <form id="add_content">
                    <div class="form-wrapper">

                        <div class="form-group">
                            <label for="title" class="text-secondary"><b>Title *</b></label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="content" class="text-secondary"><b>Content *</b></label>
                            <textarea type="text" class="form-control" id="content" name="content" rows="4"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image_file" class="text-secondary"><b>Front img *</b></label>
                            <input type="file" class="form-control-file" id="image_file" name="image_file"/>
                        </div>

                        <div class="form-group">
                            <label for="category" class="text-secondary"><b>Category *</b></label>
                            <select name="category" id="category" class="form-control">
                                <option value="preview">preview</option>
                                <option value="blog">blog post</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status" class="text-secondary"><b>Status *</b></label>
                            <select name="status" id="status" class="form-control">
                                <option value="not public">not public</option>
                                <option value="public">public</option>
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
        //ajax add content
        general_ajax_call('form#add_content', '/content/add_content_process');
    })
</script>
