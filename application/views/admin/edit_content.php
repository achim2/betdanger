<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-10 mx-auto">-->
<!--            <main>-->
<!---->
<!--                <h2 class="section-name">Edit "--><?php //echo $this->get_content->title; ?><!--"</h2>-->
<!--                --><?php //echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>
<!---->
<!--                <form id="edit_content">-->
<!--                    <div class="form-wrapper">-->
<!--                        <div class="form-group">-->
<!--                            <label for="title" class="text-secondary"><b>Title *</b></label>-->
<!--                            <input type="text" class="form-control" id="title" name="title" value="--><?php //echo $this->get_content->title; ?><!--"/>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="content" class="text-secondary"><b>Content *</b></label>-->
<!--                            <textarea type="text" class="form-control" id="content" name="content" rows="4">--><?php //echo $this->get_content->body; ?><!--</textarea>-->
<!--                        </div>-->
<!--                        <div class="form-group d-flex">-->
<!--                            <div class="mr-5">-->
<!--                                <label for="image_file" class="text-secondary"><b>Current pics</b></label><br>-->
<!--                                <img class="" width="300px" src="/assets/images/uploaded/--><?php //echo $this->get_content->front_img; ?><!--" alt="--><?php //echo $this->get_content->front_img; ?><!--">-->
<!--                            </div>-->
<!--                            <div class="">-->
<!--                                <label for="image_file" class="text-secondary"><b>Add new img, if you want</b></label>-->
<!--                                <input type="file" class="form-control-file" id="image_file" name="image_file"/>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="status" class="text-secondary"><b>Status *</b></label>-->
<!--                            <select name="status" id="status" class="form-control">-->
<!--                                <option value="not public" --><?php //if ($this->get_content != null && $this->get_content->status == 'not public') echo 'selected'; ?><!-->not public</option>-->
<!--                                <option value="public" --><?php //if ($this->get_content != null && $this->get_content->status == 'public') echo 'selected'; ?><!-->public</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group m-0">-->
<!--                        <input type="submit" class="btn btn-success" value="Add">-->
<!--                        <a class="btn btn-secondary" data-goBack>Back</a>-->
<!--                    </div>-->
<!--                </form>-->
<!---->
<!--            </main>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        //ajax edit content-->
<!--        general_ajax_call('form#edit_content', '/content/edit_content_process/--><?php //echo $this->get_content->category . '/' . $this->get_content->slug; ?>//');
//    })
//</script>
