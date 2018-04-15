<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">

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
                    <a class="btn btn-secondary js-go-back">Back</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        general_ajax_call('form#edit_category', '/admin/edit_category_process/<?php echo $this->category->id; ?>');
    })
</script>
