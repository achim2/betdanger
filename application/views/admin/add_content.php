<?php $uri = $this->uri->segment(2); ?>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <main>

                <?php if ($uri == 'add_content') : ?>

                    <h2 class="section-name">Add content</h2>
                <?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>
                    <form id="add_content">
                        <div class="form-wrapper">

                            <div class="form-group">
                                <label for="title" class="text-secondary"><b>Title *</b></label>
                                <input type="text"
                                       class="form-control"
                                       id="title"
                                       name="title"
                                       value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"
                                />
                            </div>
                            <div class="form-group">
                                <label for="content" class="text-secondary"><b>Content *</b></label>
                                <textarea type="text"
                                          class="form-control"
                                          id="content"
                                          name="content"
                                          rows="4"
                                ><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image_file" class="text-secondary"><b>Image *</b></label>
                                <input type="file" class="form-control-file" id="image_file" name="image_file"/>
                            </div>

                            <div class="form-group">
                                <label for="tags" class="text-secondary"><b>Tags *</b></label>
                                <input name="tags" id="tags" class="form-control tags" value=""/>
                            </div>

                            <div class="form-group">
                                <label for="category" class="text-secondary"><b>Category *</b></label>
                                <select name="category" id="category" class="form-control">
                                    <?php foreach ($this->categories as $category): ?>
                                        <option <?php if ($category->id == 1) 'selected'; ?>
                                                value="<?php echo $category->id; ?>"
                                        ><?php echo $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status" class="text-secondary"><b>Status *</b></label>
                                <select name="status" id="status" class="form-control">
                                    <option selected value="not public">not public</option>
                                    <option value="public">public</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-0">
                            <input type="submit" class="btn btn-success" value="Add">
                            <a class="btn btn-secondary js-go-back">Back</a>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function () {
                            //ajax add content
                            general_ajax_call('form#add_content', '/admin/add_content_process');
                        })
                    </script>

                <?php elseif ($uri == 'edit_content') : ?>

                    <h2 class="section-name">Edit content: "<?php echo $this->content->title; ?>"</h2>
                <?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>

                    <form id="edit_content">
                        <div class="form-wrapper">
                            <div class="form-group">
                                <label for="title" class="text-secondary"><b>Title *</b></label>
                                <input type="text"
                                       class="form-control"
                                       id="title" name="title"
                                       value="<?php echo $this->content->title; ?>"
                                />
                            </div>
                            <div class="form-group">
                                <label for="content" class="text-secondary"><b>Content *</b></label>
                                <textarea type="text"
                                          class="form-control"
                                          id="content"
                                          name="content"
                                          rows="4"
                                ><?php echo $this->content->body; ?></textarea>
                            </div>
                            <div class="form-group d-flex">
                                <div class="mr-5">
                                    <label for="image_file" class="text-secondary"><b>Current pics</b></label><br>
                                    <img class=""
                                         width="300px"
                                         src="/assets/images/uploaded/<?php echo $this->content->image_name; ?>"
                                         alt="<?php echo $this->content->image_name; ?>"
                                    >
                                </div>
                                <div class="">
                                    <label for="image_file" class="text-secondary"><b>Add new img, if you want</b></label>
                                    <input type="file" class="form-control-file" id="image_file" name="image_file"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tags" class="text-secondary"><b>Tags</b></label>
                                <input name="tags" id="tags" class="form-control tags" value="<?php
                                foreach ($this->get_tags as $tags) :
                                    if ($tags->content_id == $this->content->id) :
                                        echo $tags->name . ',';
                                    endif;
                                endforeach;
                                ?>"/>
                            </div>

                            <div class="form-group">
                                <label for="category" class="text-secondary"><b>Category *</b></label>
                                <select name="category" id="category" class="form-control">
                                    <?php foreach ($this->categories as $category): ?>
                                        <option value="<?php echo $category->id; ?>"
                                            <?php echo ($this->content->category_id == $category->id) ? 'selected' : '' ?>
                                        ><?php echo $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status" class="text-secondary"><b>Status *</b></label>
                                <select name="status" id="status" class="form-control">
                                    <option value="not public" <?php if ($this->content != null && $this->content->status == 'not public') echo 'selected'; ?>>not public</option>
                                    <option value="public" <?php if ($this->content != null && $this->content->status == 'public') echo 'selected'; ?>>public</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-0">
                            <input type="submit" class="btn btn-success" value="Add">
                            <a class="btn btn-secondary js-go-back">Back</a>
                        </div>
                    </form>


                    <script>
                        $(document).ready(function () {
                            //ajax edit content
                            general_ajax_call('form#edit_content', '/admin/edit_content_process/<?php echo $this->content->id; ?>');
                        })
                    </script>

                <?php endif; ?>

            </main>
        </div>
    </div>
</div>

