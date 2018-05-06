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
                            <th class="text-uppercase">Verify</th>
                        </tr>
                        </thead>
                        <?php foreach ($users as $user) : ?>
                            <?php if ($user->verify == 'verified' || $user->verify == 'tilted') : ?>
                                <tbody>
                                <tr class="text-white">
                                    <?php //user id ?>
                                    <td class=""><?php echo $user->user_id; ?></td>

                                    <?php //username ?>
                                    <td class=""><?php echo $user->username; ?></td>

                                    <?php //user type ?>
                                    <?php if ($user->user_type == 'moderator'): ?>
                                        <td class="text-success"><?php echo $user->user_type; ?></td>
                                    <?php elseif ($user->user_type == 'administrator'): ?>
                                        <td class="text-warning"><?php echo $user->user_type; ?></td>
                                    <?php else: ?>
                                        <td><?php echo $user->user_type; ?></td>
                                    <?php endif; ?>

                                    <?php //email ?>
                                    <td class=""><?php echo $user->email; ?></td>

                                    <?php //verify ?>
                                    <td class="">
                                        <form class="tilt-toggle" id="<?php echo $user->user_id; ?>">
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
        var tiltToggle = $('.tilt-toggle');

        tiltToggle.on('change', function (e) {
            e.preventDefault();

            var userID = $(this).attr('id');
            console.log(userID);
            var label = $("[for='toggle-" + userID + "']");

            $.ajax({
                url: '/user/tilt_toggle/' + userID,
                data: $(this).serialize(),
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if (data.option === 'verified') {
                        label.text('Verified');
                    }
                    else {
                        label.text('Tilted');
                    }
                }
            })
        });
    })
</script>