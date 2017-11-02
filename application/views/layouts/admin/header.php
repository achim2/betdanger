<nav class="admin-nav">

    <a class="admin-brand" href="/admin/users">bD-Admin</a>

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
            <a href="/admin/users">Users</a>
        </li>
        <li>
            <a href="/admin/previews">Previews</a>
        </li>
        <li>
            <a href="/admin/blog_posts">Blog posts</a>
        </li>
        <li>
            <a href="/admin/newsletters">Newsletter</a>
        </li>
        <li>
            <a href="/">back to main page</a>
        </li>
    </ul>
</nav>
