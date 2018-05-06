<?php $uri = $this->uri->segment(3); ?>

<div id="delete-content-modal"
     class="modal fade"
     data-category="<?php echo ($uri == 'categories') ? 'category' : $uri; ?>"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Content</h5>
                <span class="ti-close" data-dismiss="modal"></span>
            </div>
            <div class="modal-body">
                <p class="modal-message">
                    Do you really want to delete
                    <b id="modal-msg-name">
                    </b>
                    from
                    <?php echo ($uri == 'categories') ? 'category' : $uri; ?>
                    ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete">Törlés</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mx-auto">
            <section class="cms-table">

                <h2 class="section-name">(CMS) <?php echo ($uri == 'categories') ? 'Category' : ucfirst($uri); ?></h2>

                <!-- SETTINGS -->
                <?php if ($uri == 'settings') : ?>
                    <?php $settings = $this->settings; ?>
                    <?php if (is_array($settings) && $settings != null): ?>
                        <div class="table-wrapper pt-2">
                            <table class="table table-hover table-dark admin-settings">
                                <thead>
                                <tr class="bg-danger text-dark">
                                    <th class="text-uppercase">Name</th>
                                    <th class="text-uppercase text-center">Option</th>
                                </tr>
                                </thead>

                                <?php foreach ($settings as $item) : ?>

                                    <tbody>
                                    <tr class="text-white">
                                        <?php //Name ?>
                                        <td><?php echo $item->name; ?></td>

                                        <?php //Option toggle?>
                                        <td class="td-option text-center">
                                            <form class="option-toggle" id="<?php echo $item->id; ?>">
                                                <input type="checkbox" name="toggle-<?php echo $item->id; ?>" id="toggle-<?php echo $item->id; ?>" <?php echo ($item->option == 1) ? 'checked' : ''; ?>>
                                                <label for="toggle-<?php echo $item->id; ?>"><?php echo ($item->option == 1) ? 'On' : 'Off'; ?></label>
                                            </form>
                                        </td>

                                    </tr>
                                    </tbody>

                                <?php endforeach; ?>

                            </table>
                        </div>
                    <?php endif; ?>

                    <!-- CATEGORIES -->
                <?php elseif ($uri == 'categories') : ?>
                    <div class="d-flex align-items-center">
                        <a class="btn btn-success mr-3" href="<?php echo base_url("/admin/add_category"); ?>">Add category</a>
                    </div>

                    <?php if ($this->categories != null) : ?>
                        <div class="table-wrapper pt-2">
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr class="bg-danger text-dark">
                                    <th class="text-uppercase">ID</th>
                                    <th class="text-uppercase">Category name</th>
                                    <th class="text-uppercase text-center">Edit</th>
                                    <th class="text-uppercase text-center">Delete</th>
                                </tr>
                                </thead>
                                <?php foreach ($this->categories as $category) : ?>
                                    <tbody>
                                    <tr class="text-white" id="<?php echo $category->id; ?>">
                                        <td><?php echo $category->id; ?></td>
                                        <td><?php echo $category->name; ?></td>
                                        <?php if ($category->id != 1) : ?>
                                            <td class="text-center">
                                                <a class="text-center text-success"
                                                   href="<?php echo base_url("/admin/edit_category/$category->id"); ?>"
                                                >
                                                    <span class="icon icon-pencil"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a class="text-center text-danger delete_content_trigger"
                                                   id="<?php echo $category->id; ?>"
                                                   name="<?php echo $category->name; ?>"
                                                >
                                                    <span class="icon icon-close"></span>
                                                </a>
                                            </td>
                                        <?php else: ?>
                                            <td class="text-center"><a>-</a></td>
                                            <td class="text-center"><a>-</a></td>
                                        <?php endif; ?>
                                    </tr>
                                    </tbody>

                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php else : ?>
                        <p>Sry, there is no category yet!</p>
                    <?php endif; ?>

                    <!-- CONTENT -->
                <?php elseif ($uri == 'content') : ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <a class="btn btn-success" href="<?php echo base_url("/admin/add_content"); ?>">Add content</a>
                        <form style="width: 50%">
                            <div class="form-group m-0 ml-5">
                                <input type="text" class="form-control" name="search_content_on_admin" id="lolasd" placeholder="Find your content ...">
                            </div>
                        </form>
                    </div>

                    <div class="table-wrapper pt-2">
                        <table class="table table-hover table-dark">
                            <thead>
                            <tr class="bg-danger text-dark">
                                <th class="text-uppercase">ID</th>
                                <th class="text-uppercase">Content name</th>
                                <th class="text-uppercase text-center">Status</th>
                                <th class="text-uppercase text-center">category</th>
                                <th class="text-uppercase text-center">Edit</th>
                                <th class="text-uppercase text-center">Delete</th>
                                <th class="text-uppercase text-center">Created at</th>
                            </tr>
                            </thead>

                            <tbody id="searchable-content"></tbody>

                        </table>
                    </div>

                <?php else: ?>
                <?php endif; ?>

            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        //SEARCHABLE CONTENT
        var contentSearchInput = $('[name="search_content_on_admin"]');
        var searchAbleContent = $('#searchable-content');

        contentSearchInput.keyup(function () {
            ajax_search_result();
        });

        function ajax_search_result() {
            var txt = contentSearchInput.val();
            searchAbleContent.empty();

            $.ajax({
                url: '/admin/get_searchable_content',
                data: {search_content_on_admin: txt},
                type: 'post',
                dataType: 'json',
                success: function (data, status, xhr) {

                    if (data.result.length !== 0) {
                        searchAbleContent.append(data.result);

                    } else {
                        searchAbleContent.append('<tr><td colspan="100">No result!</td></tr>');
                    }
                }
            })
        }

        ajax_search_result();
    });
</script>