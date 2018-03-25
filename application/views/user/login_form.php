<?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>

<div id="login" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <span class="ti-close" data-dismiss="modal"></span>
            </div>
            <div class="modal-body">
                <form id="login">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email" value="ahimjuhasz@gmail.com">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group clearfix">
                        <input type="submit" class="btn btn-dark float-left" value="Submit">
                        <div class="data-modal-btns text-right">
                            <a data-modal-close="#login" data-modal-open="#lost-pass">lost your pass?</a><br/>
                            <a data-modal-close="#login" data-modal-open="#sign-up">not registered?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //ajax contact email send
        general_ajax_call('form#login', '/user/login');
    });
</script>