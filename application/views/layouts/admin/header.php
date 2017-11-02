<nav class="admin-nav">

    <a class="admin-brand" href="#">bD-Admin</a>

    <ul class="user-info">
        <li>
            <a>Logged in: <?php echo $this->session->userdata('username'); ?></a>
        </li>
        <li>
            <a href="<?php echo base_url('/user/logout'); ?>">Log Out</a>
        </li>
    </ul>

    <ul class="panel-dd">
        <li>
            <a href="/">main page</a>
        </li>
        <li>
            <a>Users</a>
        </li>
        <li>
            <a href="/admin/newsletter">Newsletter</a>
        </li>
    </ul>
</nav>
