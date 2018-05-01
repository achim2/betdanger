<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 bg-white pt-3">

            <h3 class="text-dark">Set new password!</h3>

            <form id="new_pass">
                <div class="form-group">
                    <input type="password" class="form-control" name="new_pass" placeholder="Add new password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="new_pass_re" placeholder="Add new password again">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        general_ajax_call('form#new_pass', '/user/new_pass_process/<?php echo $this->id; ?>');
    });
</script>