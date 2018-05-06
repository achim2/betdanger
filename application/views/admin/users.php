<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- USERS -->
            <h2 class="section-name">Users</h2>

            <?php $users = $this->users; ?>
            <?php if ($users != null) : ?>
                <div class="table-wrapper pt-2">
                    <table class="table table-hover table-dark">
                        <thead>
                        <tr class="bg-danger text-dark">
                            <th class="text-uppercase">ID</th>
                            <th class="text-uppercase">Name</th>
                            <th class="text-uppercase">User Type</th>
                            <th class="text-uppercase">Email</th>
                            <th class="text-uppercase text-center">Verify</th>
                        </tr>
                        </thead>
                        <?php foreach ($users as $user) : ?>
                            <?php if ($user->verify == 'verified' || $user->verify == 'tilted') : ?>
                                <tbody>
                                <tr class="text-white">
                                    <?php //user id ?>
                                    <td><?php echo $user->user_id; ?></td>

                                    <?php //username ?>
                                    <td><?php echo $user->username; ?></td>

                                    <?php //user type ?>
                                    <td>
                                        <form>
                                            <select class="custom-select" name="select_type" id="<?php echo $user->user_id; ?>">
                                                <option value="moderator" <?php echo ($user->user_type == 'moderator') ? 'selected' : ''; ?>>Moderator</option>
                                                <option value="administrator" <?php echo ($user->user_type == 'administrator') ? 'selected' : ''; ?>>Administrator</option>
                                                <option value="user" <?php echo ($user->user_type == 'user') ? 'selected' : ''; ?>>User</option>
                                            </select>
                                        </form>
                                    </td>

                                    <?php //email ?>
                                    <td><?php echo $user->email; ?></td>

                                    <?php //verify ?>
                                    <td>
                                        <form class="tilt-toggle text-center" id="<?php echo $user->user_id; ?>">
                                            <input type="checkbox"
                                                   name="toggle-<?php echo $user->user_id; ?>"
                                                   id="toggle-<?php echo $user->user_id; ?>"
                                                <?php echo ($user->verify == 'verified') ? 'checked' : ''; ?>>
                                            <label for="toggle-<?php echo $user->user_id; ?>"><?php echo ($user->verify == 'verified') ? 'Verified' : 'Tilted'; ?></label>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        //CHANGE USER TYPE
        var selectType = $('[name="select_type"]');
        selectType.on('change', function () {
            var userID = $(this).attr('id');

            $.ajax({
                url: '/user/change_user_type/' + userID,
                data: $(this).serialize(),
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.success === false) {
                        alert(data.msg);
                    }
                }
            })

        });
    })
</script>