<div id="lost-pass" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lost password</h5>
                <span class="ti-close" data-dismiss="modal"></span>

            </div>
            <div class="modal-body">
                <form id="lost_pass">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="ahimjuhasz@gmail.com">
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <input type="submit" class="btn btn-dark" value="Submit">
                        <div class="data-modal-btns">
                            <a href="#" data-modal-close="#lost-pass" data-modal-open="#login">login</a><br>
                            <a href="#" data-modal-close="#lost-pass" data-modal-open="#sign-up">not registered?</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        //ajax contact lost pass
        general_ajax_call('form#lost_pass', '/email/lost_password');
    });
</script>