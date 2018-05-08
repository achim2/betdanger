<?php $user = $this->session->userdata(); ?>
<?php $user_type = $user['user_type']; ?>

<nav class="admin-nav">

    <a class="brand-name" href="/admin/users">bD-Admin</a>

    <ul class="user-info">
        <li>
            <a class="username">Logged in: <?php echo $this->session->userdata('username'); ?></a>
        </li>
        <li>
            <a href="<?php echo base_url('/user/profile'); ?>">Profile</a>
        </li>
        <li>
            <a href="<?php echo base_url('/user/logout'); ?>">Log Out</a>
        </li>
    </ul>

    <ul class="nav-links">
        <?php if ($user_type === 'moderator') : ?>
            <li <?php echo ($this->uri->segment(2) == 'users') ? 'class="is-active"' : ''; ?>>
                <a href="/admin/users">Users</a>
            </li>
        <?php endif; ?>
        <li <?php echo ($this->uri->segment(2) == 'cms') ? 'class="is-active"' : ''; ?>>
            <a>Cms</a>
            <ul class="nav-sub-links">
                <li <?php echo ($this->uri->segment(3) == 'settings') ? 'class="is-active"' : ''; ?>>
                    <a href="/admin/cms/settings">Settings</a>
                </li>
                <li <?php echo ($this->uri->segment(3) == 'categories') ? 'class="is-active"' : ''; ?>>
                    <a href="/admin/cms/categories">Categories</a>
                </li>
                <li <?php echo ($this->uri->segment(3) == 'content') ? 'class="is-active"' : ''; ?>>
                    <a href="/admin/cms/content">Contents</a>
                </li>
            </ul>
        </li>
        <li <?php echo ($this->uri->segment(2) == 'newsletters') ? 'class="is-active"' : ''; ?>>
            <a href="/admin/newsletters">Newsletter</a>
        </li>
    </ul>

    <ul class="back-page">
        <li>
            <a href="/">Main page</a>
        </li>
    </ul>
</nav>
