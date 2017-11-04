<div id="del_content_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-message">Do you really want to delete <b id="content_title"></b> content?</p>
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
        <div class="col-12">
            <section class="content">
                <h2 class="pb-3"><?php echo $this->title; ?></h2>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
<!--                        <a class="btn btn-success" href="--><?php //echo base_url('/content/add_content/' . $this->category); ?><!--">Esemény hozzáadása</a>-->
                        <a class="btn btn-success" href="<?php echo base_url("/content/$this->category/add_content"); ?>">Esemény hozzáadása</a>
                    </div>
                </div>

                <?php
                if ($this->get_content == null) {

                } else {
                    ?>
                    <div class="table-wrapper pt-3">
                        <table class="table table-inverse">
                            <thead>
                            <tr class="bg-danger">
                                <th class="text-uppercase">Content name</th>
                                <th class="text-uppercase text-center">Status</th>
                                <th class="text-uppercase text-center">Edit</th>
                                <th class="text-uppercase text-center">Delete</th>
                                <th class="text-uppercase text-center">Created at</th>
                            </tr>
                            </thead>
                            <?php
                            foreach ($this->get_content as $content) {
                                ?>
                                <tbody>
                                <tr class="" id="<?php echo $content->content_id; ?>">
                                    <td style="width: 500px;"><?php echo $content->title; ?></td>
                                    <td class="text-center"><?php echo $content->status; ?></td>
                                    <td class="text-center">
<!--                                        <a class="text-center text-success" href="--><?php //echo base_url("/content/edit_content/$content->category/$content->slug"); ?><!--"><span class="ti-pencil"></span></a>-->
                                        <a class="text-center text-success" href="<?php echo base_url("/content/$content->category/edit_content/$content->slug"); ?>"><span class="ti-pencil"></span></a>
                                    </td>
                                    <td class="text-center">
                                        <a class="text-center text-danger del_content_trig"
                                           id="<?php echo $content->content_id; ?>"
                                           name="<?php echo $content->title; ?>"
                                        ><span class="ti-close"></span></a>
                                    </td>
                                    <td class="text-center"><?php echo $content->created_at; ?></td>
                                </tr>
                                </tbody>

                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </section>
        </div>
    </div>
</div>
