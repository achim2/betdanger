<div class="container">
    <div class="row">
        <div class="col-lg-8">
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
        <div class="col-lg-4">
            <div class="newsletter-yes">

                <h2 class="text-secondary">All subscribed user</h2>
                <?php
                foreach ($this->users as $user) {
                    echo "<p class='text-warning'>" . $user->username . " => " . $user->email . "</p>";
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