<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <main>

                <h2 class="section-name">Profile</h2>

                <section class="profile">

                    <div id="accordion" role="tablist">

                        <!-- Username -->
                        <div class="accordion">
                            <div class="accordion-header" role="tab" id="headingEmail">
                                <h5>
                                    <span class="text-secondary">Felhasználónév: </span>
                                </h5>
                                <p><?php echo $this->user->username; ?></p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="accordion">
                            <div class="accordion-header" role="tab" id="headingUsername">
                                <h5>
                                    <span class="text-secondary">Email cím:</span>
                                </h5>
                                <p><?php echo $this->user->email; ?></p>
                            </div>
                        </div>

                        <!-- Newsletter sub change -->
                        <div class="accordion">
                            <div class="accordion-header" role="tab" id="headingNewsletter">
                                <h5>
                                    <span class="text-secondary">Newsletter:</span>
                                    <a class="collapsed btn btn-outline-primary"
                                       data-toggle="collapse"
                                       href="#collapseNewsletter"
                                       aria-expanded="false"
                                       aria-controls="collapseNewsletter"> expand </a>
                                </h5>
                                <p>You can subscribe or unsubscribe from our newsletter.</p>
                            </div>

                            <div id="collapseNewsletter" class="collapse" role="tabpanel" aria-labelledby="headingNewsletter" data-parent="#accordion">
                                <div class="accordion-body">
                                    <a id="newsletter_btn" class="btn btn-outline-info"><?php echo $this->user->newsletter == 'yes' ? 'Unsubscribe' : 'Subscribe'; ?></a>
                                </div>
                            </div>
                        </div>

                        <!-- Change Password -->
                        <div class="accordion">
                            <div class="accordion-header" role="tab" id="headingPass">
                                <h5>
                                    <span class="text-warning">Change password</span>
                                    <a class="collapsed btn btn-outline-primary"
                                       data-toggle="collapse"
                                       href="#collapsePass"
                                       aria-expanded="false"
                                       aria-controls="collapsePass"> expand </a>
                                </h5>
                                <div class="">
                                    <p class="mr-1">Your password is not safe? Change below your password or send a message within our contact form. </p>
                                </div>
                            </div>
                            <div id="collapsePass" class="collapse" role="tabpanel" aria-labelledby="headingPass" data-parent="#accordion">
                                <div class="accordion-body">

                                    <form id="change_pass">
                                        <div class="form-group">
                                            <label for="cur_pass" class="text-warning">Current password</label>
                                            <input type="password" id="cur_pass" class="form-control" name="cur_pass">
                                        </div>
                                        <div class="form-group">
                                            <label for="new_pass" class="text-warning">New password</label>
                                            <input type="password" id="new_pass" class="form-control" name="new_pass">
                                        </div>
                                        <div class="form-group">
                                            <label for="new_pass2" class="text-warning">New password again</label>
                                            <input type="password" id="new_pass2" class="form-control" name="new_pass2">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-outline-warning" value="Change">
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Delete profile -->
                        <div class="accordion">
                            <div class="accordion-header" role="tab" id="headingProfileDel">
                                <h5>
                                    <span class="text-danger">Remove profile</span>
                                    <a class="collapsed btn btn-outline-primary"
                                       data-toggle="collapse"
                                       href="#collapseProfileDel"
                                       aria-expanded="false"
                                       aria-controls="collapseProfileDel">expand </a>
                                </h5>
                                <p>If you don't need your profile anymore, just delete it, but your comments & bounded things will lost.</p>
                            </div>
                            <div id="collapseProfileDel" class="collapse" role="tabpanel" aria-labelledby="headingProfileDel" data-parent="#accordion">
                                <div class="accordion-body">
                                    <form id="delete_profile">
                                        <div class="form-group">
                                            <label for="cur_pass" class="text-danger">Current password</label>
                                            <input type="password" id="cur_pass" class="form-control" name="cur_pass" placeholder="current password">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-outline-danger" value="Remove">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>
            </main>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        //ajax profile change pass
        general_ajax_call('form#change_pass', '/user/update_pass');

        //ajax delete profile
        general_ajax_call('form#delete_profile', '/user/delete_user_from_profile');


        var newsletterBTN = $('#newsletter_btn');

        newsletterBTN.on('click', function () {
            $.ajax({
                url: '/user/newsletter_sub_change',
                success: function (data) {
                    if (newsletterBTN.text() === 'Subscribe') {
                        newsletterBTN.html('Unsubscribe');
                    } else {
                        newsletterBTN.html('Subscribe');
                    }
                },
                error: function (data) {
                }
            })
        });

    });
</script>