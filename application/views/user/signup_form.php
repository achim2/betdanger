<?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>
<div id="sign-up" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration</h5>
                <span class="ti-close" data-dismiss="modal"></span>

            </div>
            <div class="modal-body">
                <form id="signup">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" placeholder="Password again">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="newsletter" name="newsletter">
                            <label class="custom-control-label" for="newsletter">I want to get newsletters.</label>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <input type="submit" class="btn btn-dark" value="Submit">
                        <div class="data-modal-btns">
                            <a href="#" data-modal-close="#sign-up" data-modal-open="#login">login</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <p class="">By signing up, you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //ajax sign up modal
        general_ajax_call('form#signup', '/user/signup');
    });
</script>