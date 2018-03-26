<?php $uri = $this->uri->segment(2); ?>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">

            <?php if ($uri == 'add_category') : ?>
                <h2 class="section-name">Add category</h2>
                <form id="add_category">
                    <div class="form-wrapper">
                        <div class="form-group">
                            <label for="name" class="text-secondary"><b>Name *</b></label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"
                            />
                        </div>
                    </div>
                    <div class="form-group m-0">
                        <input type="submit" class="btn btn-success" value="Add">
                        <a class="btn btn-secondary" data-goBack>Back</a>
                    </div>
                </form>

                <script>
                    $(document).ready(function () {
                        general_ajax_call('form#add_category', '/admin/add_category_process');
                    })
                </script>


            <?php elseif ($uri == 'edit_category') : ?>
                <h2 class="section-name">Edit category: <?php echo ucfirst($this->category->name); ?></h2>

                <form id="edit_category">
                    <div class="form-wrapper">
                        <div class="form-group">
                            <label for="name" class="text-secondary"><b>Name *</b></label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   value="<?php if (isset($this->category->name)) echo $this->category->name; ?>"
                            />
                        </div>
                    </div>
                    <div class="form-group m-0">
                        <input type="submit" class="btn btn-success" value="Add">
                        <a class="btn btn-secondary" data-goBack>Back</a>
                    </div>
                </form>

                <script>
                    $(document).ready(function () {
                        general_ajax_call('form#edit_category', '/admin/edit_category_process/<?php echo $this->category->id; ?>');
                    })
                </script>

            <?php endif; ?>

        </div>
    </div>
</div>
