<h2 class="text-center mt-5">Profile</h2>
<section class="profile">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="section-wrapper">
                    <div class="blocks d-flex">
                        <h5 class="mr-2">Felhasználónév:</h5>
                        <p><?php echo $this->user->username; ?></p>
                    </div>
                    <div class="blocks d-flex">
                        <h5 class="mr-2">Email cím:</h5>
                        <p><?php echo $this->user->email; ?></p>
                    </div>
                    <div class="blocks">
                        <h5 class="text-warning">Change password</h5>
                        <p class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eros quam, feugiat ut risus sed, scelerisque imperdiet urna.</p>

                        <?php echo validation_errors('<p class="text-center alert alert-dismissable alert-danger">') ?>

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
                            <button type="submit" name="submit" class="btn btn-warning">Change</button>
                        </form>

                    </div>
                    <div class="blocks">
                        <h5 class="text-danger">Remove profile</h5>
                        <p class="mb-2">A profil törlésével a hozzá tartozó események is törlődnek.</p>

                        <form id="delete_profile">
                            <div class="form-group">
                                <label for="cur_pass" class="text-danger">Current password</label>
                                <input type="password" id="cur_pass" class="form-control" name="cur_pass" placeholder="current password">
                            </div>
                            <button type="submit" name="submit" class="btn btn-danger">Remove</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>