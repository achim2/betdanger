<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">

            <section class="profile">
                <h2 class="text-center">Profile</h2>

                <div id="accordion" role="tablist">

                    <!-- Username -->
                    <div class="card">
                        <div class="card-header" role="tab" id="headingEmail">
                            <a data-toggle="collapse" href="" aria-expanded="false" aria-controls="collapseEmail">
                                <h5>
                                    <span class="text-secondary">Felhasználónév: </span>
                                </h5>
                                <p><?php echo $this->user->username; ?></p>
                            </a>
                        </div>

                        <div id="collapseEmail" class="collapse" role="tabpanel" aria-labelledby="headingEmail" data-parent="#accordion">
                            <div class="card-body">
                                Group Item #1 body
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="card">
                        <div class="card-header" role="tab" id="headingUsername">
                            <a class="collapsed" data-toggle="collapse" href="" aria-expanded="false" aria-controls="collapseUsername">
                                <h5>
                                    <span class="text-secondary">Email cím:</span>
                                </h5>
                                <p><?php echo $this->user->email; ?></p>
                            </a>
                        </div>
                        <div id="collapseUsername" class="collapse" role="tabpanel" aria-labelledby="headingUsername" data-parent="#accordion">
                            <div class="card-body">
                                Group Item #2 body
                            </div>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="card">
                        <div class="card-header" role="tab" id="headingPass">
                            <a class="collapsed" data-toggle="collapse" href="#collapsePass" aria-expanded="false" aria-controls="collapsePass">
                                <h5>
                                    <span class="text-warning">Change password</span>
                                    <span class="ti-angle-up"></span>
                                </h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eros quam, feugiat ut risus sed, scelerisque imperdiet urna.</p>
                            </a>
                        </div>
                        <div id="collapsePass" class="collapse" role="tabpanel" aria-labelledby="headingPass" data-parent="#accordion">
                            <div class="card-body">

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
                    <div class="card">
                        <div class="card-header" role="tab" id="headingProfileDel">
                            <a class="collapsed" data-toggle="collapse" href="#collapseProfileDel" aria-expanded="false" aria-controls="collapseProfileDel">
                                <h5>
                                    <span class="text-danger">Remove profile</span>
                                    <span class="ti-angle-up"></span>
                                </h5>
                                <!--                                <p>A profil törlésével a hozzá tartozó események is törlődnek.</p>-->
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eros quam, feugiat ut risus sed, scelerisque imperdiet urna.</p>
                            </a>
                        </div>
                        <div id="collapseProfileDel" class="collapse" role="tabpanel" aria-labelledby="headingProfileDel" data-parent="#accordion">
                            <div class="card-body">
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

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        //ajax profile change pass
        general_ajax_call('form#change_pass', '/user/update_pass');

        //ajax delete profile
        general_ajax_call('form#delete_profile', '/user/delete_user_from_profile');
    });
</script>