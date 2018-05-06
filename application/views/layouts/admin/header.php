<!--admin header-->

<nav class="admin-nav">

    <a class="brand-name" href="/admin/users">bD-Admin</a>

    <ul class="user-info">
        <li>
            <a class="username">Logged in: <?php echo $this->session->userdata('username'); ?></a>
        </li>
        <li>
            <a href="<?php echo base_url('/user/logout'); ?>">Log Out</a>
        </li>
    </ul>

    <ul class="nav-links">
        <li>
            <a href="/admin/users">Users</a>
        </li>
        <li>
            <a>Cms</a>
            <ul class="nav-sub-links">
                <li>
                    <a href="/admin/cms/settings">Settings</a>
                </li>
                <li>
                    <a href="/admin/cms/categories">Categories</a>
                </li>
                <li>
                    <a href="/admin/cms/content">Contents</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="/admin/newsletters">Newsletter</a>
        </li>
    </ul>

    <ul class="back-page">
        <li>
            <a href="/">Main page</a>
        </li>
    </ul>
</nav>
