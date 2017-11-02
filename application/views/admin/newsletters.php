<div class="container">
    <div class="row">
        <div class="col-7 mr-auto">
            <div class="newsletter-yes">
                <h2 class="text-secondary">Send newsletter</h2>
                <form id="send_newsletter">
                    <div class="form-group">
                        <textarea class="form-control" name="message" id="" placeholder="Write here..."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4 ml-auto">
            <div class="newsletter-yes">

                <h2 class="text-secondary">All subscribed user</h2>
                <?php
                foreach ($this->users as $each_user) {
                    echo "<p class='text-warning'>" . $each_user->username . " => " . $each_user->email . "</p>";
                }
                ?>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        //ajax sign up modal
        general_ajax_call('form#send_newsletter', '/email/send_newsletter');
    });
</script>