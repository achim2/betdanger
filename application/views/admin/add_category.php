<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">

            <h2 class="section-name">Add category <?php // echo $this->title; ?></h2>
            <section>


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

            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //ajax add content
        general_ajax_call('form#add_category', '/admin/add_category_process');
    })
</script>
