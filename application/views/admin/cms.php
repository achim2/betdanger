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
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr class="bg-danger text-dark">
                                    <th class="text-uppercase">Name</th>
                                    <th class="text-uppercase">Option</th>
                                </tr>
                                </thead>

                                <?php foreach ($settings as $item) : ?>

                                    <tbody>
                                    <tr class="text-white">
                                        <?php //Name ?>
                                        <td class="" style="width: 100%;"><?php echo $item->name; ?></td>

                                        <?php //Option toggle?>
                                        <td class="">
                                            <form class="option-toggle" id="<?php echo $item->id; ?>">
                                                <input type="checkbox" name="toggle-<?php echo $item->id; ?>" id="toggle-<?php echo $item->id; ?>" <?php echo ($item->option == 1) ? 'checked' : ''; ?>>
                                                <label for="toggle-<?php echo $item->id; ?>"><?php echo ($item->option == 1) ? 'On' : 'Off'; ?></label>
                                            </form>
                                        </td>

                                    </tr>
                                    </tbody>

                                <?php endforeach; ?>

                                <script>
                                    $(document).ready(function () {
                                        var optionToggle = $('.option-toggle');

                                        optionToggle.on('change', function (e) {
                                            e.preventDefault();

                                            var optionID = $(this).attr('id');
                                            var label = $("[for='toggle-" + optionID + "']");

                                            $.ajax({
                                                url: '/admin/option_toggle/' + optionID,
                                                data: $(this).serialize(),
                                                type: 'post',
                                                dataType: 'json',
                                                success: function (data) {
                                                    if (data.option === 1) {
                                                        label.text('On');
                                                    }
                                                    else {
                                                        label.text('Off');
                                                    }
                                                }
                                            })
                                        });
                                    })
                                </script>

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
                                    <th class="text-uppercase">Category name</th>
                                    <th class="text-uppercase text-center">Edit</th>
                                    <th class="text-uppercase text-center">Delete</th>
                                </tr>
                                </thead>
                                <?php foreach ($this->categories as $category) : ?>
                                    <tbody>
                                    <tr class="text-white" id="<?php echo $category->id; ?>">
                                        <td class=""><?php echo $category->name; ?></td>
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
                    <div class="d-flex align-items-center">
                        <a class="btn btn-success" href="<?php echo base_url("/admin/add_content"); ?>">Add content</a>
                    </div>

                    <?php if ($this->get_content != null) : ?>

                        <div class="table-wrapper pt-2">
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr class="bg-danger text-dark">
                                    <th class="text-uppercase">Content name</th>
                                    <th class="text-uppercase text-center">Status</th>
                                    <th class="text-uppercase text-center">category</th>
                                    <th class="text-uppercase text-center">Edit</th>
                                    <th class="text-uppercase text-center">Delete</th>
                                    <th class="text-uppercase text-center">Created at</th>
                                </tr>
                                </thead>
                                <?php foreach ($this->get_content as $content) : ?>
                                    <tbody>
                                    <tr class="text-white" id="<?php echo $content->id; ?>">
                                        <td class="ml-auto">
                                            <a
                                                <?php if ($content->status == 'public' && $content->category_name != 'uncategorised'): ?>
                                                    href="<?php echo base_url("/page/$content->slug"); ?>"
                                                <?php endif; ?>
                                                    class="text-white"
                                                    target="_blank"
                                            ><?php echo $content->title; ?></a>
                                        </td>

                                        <td class="">
                                            <form class="status-toggle text-center" id="<?php echo $content->id; ?>">
                                                <input type="checkbox" name="toggle-<?php echo $content->id; ?>" id="toggle-<?php echo $content->id; ?>" <?php echo ($content->status == 'public') ? 'checked' : ''; ?>>
                                                <label for="toggle-<?php echo $content->id; ?>"><?php echo ucfirst($content->status); ?></label>
                                            </form>
                                        </td>

                                        <td class="text-center <?php if ($content->category_name == 'Uncategorised') echo 'text-danger' ?>"><?php echo $content->category_name; ?></td>
                                        <td class="text-center">
                                            <a class="text-center text-success"
                                               href="<?php echo base_url("/admin/edit_content/$content->id"); ?>"
                                            >
                                                <span class="icon icon-pencil"></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-center text-danger delete_content_trigger"
                                               id="<?php echo $content->id; ?>"
                                               name="<?php echo $content->title; ?>"
                                            ><span class="icon icon-close"></span>
                                            </a>
                                        </td>
                                        <td class="text-center"><?php echo $this->mylib->custom_dateTime($content->created_at); ?></td>
                                    </tr>
                                    </tbody>

                                <?php endforeach; ?>

                                <script>
                                    $(document).ready(function () {
                                        var statusToggle = $('.status-toggle');

                                        statusToggle.on('change', function (e) {
                                            e.preventDefault();

                                            var contentID = $(this).attr('id');
                                            console.log(contentID);
                                            var label = $("[for='toggle-" + contentID + "']");

                                            $.ajax({
                                                url: '/admin/status_toggle/' + contentID,
                                                data: $(this).serialize(),
                                                type: 'post',
                                                dataType: 'json',
                                                success: function (data) {
                                                    if (data.option === 'public') {
                                                        label.text('Public');
                                                    }
                                                    else {
                                                        label.text('Not public');
                                                    }
                                                }
                                            })
                                        });
                                    })
                                </script>

                            </table>
                        </div>
                    <?php else: ?>
                        <p>Sry, there is no content yet!</p>
                    <?php endif; ?>

                <?php else: ?>
                <?php endif; ?>

            </section>
        </div>
    </div>
</div>