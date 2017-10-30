<?php
$logged_in = $this->session->userdata('logged_in');
?>

<?php
if ($logged_in == false) {

    $this->load->view('/user/lost_pass');
    $this->load->view('/user/login_form');
    $this->load->view('/user/signup_form');
}
$this->load->view('/search/search_form');
?>


<nav class="custom-navbar">
    <div class="navbar-container">

        <a href="/" class="navbar-brand">betDANGER!</a>

        <ul class="nav-items">

            <!-- nav menu toggler-->
            <li class="menu-toggler">
                <a class="menu-trigger" data-set-dropdown=".menu-items">
                    <span class="ti-menu"></span>
                </a>

                <ul class="menu-items">
                    <li><a <?php echo ($this->uri->segment(1) == '') ? 'class = "active"' : '' ?> href="/">news</a></li>
                    <li><a <?php echo ($this->uri->segment(1) == 'usefull') ? 'class = "active"' : 'usefull' ?> href="#">useful things</a></li>
                    <li><a <?php echo ($this->uri->segment(1) == 'blog') ? 'class = "active"' : 'blog' ?> href="#">blog</a></li>
                    <li><a <?php echo ($this->uri->segment(1) == 'contact') ? 'class = "active"' : 'contact' ?> href="/contact">contact</a></li>
                </ul>
            </li>

            <!-- nav search part-->
            <li class="search-part">
                <a class="search-trigger" data-toggle="modal" data-target="#search_modal">
                    <span class="ti-search"></span>
                </a>
            </li>

            <?php
            if ($logged_in) {
                ?>
                <!-- user logged in-->
                <li class="user-part">
                    <a class="username" data-set-dropdown=".user-part-dropdown">
                        <span class="ti-angle-up"></span>
                        <span class="uname"><?php echo $this->session->userdata('username'); ?></span>
                    </a>

                    <div class="user-part-dropdown">
                        <a href="<?php echo base_url('/user/profile'); ?>">profile</a>
                        <a href="<?php echo base_url('/user/logout'); ?>">log out</a>
                    </div>
                </li>

                <?php
            } else {
                ?>

                <!-- user not logged in-->
                <li class="user-part">
                    <a class="user-trigger" data-set-dropdown=".user-part-dropdown">
                        <span class="ti-user"></span>
                    </a>

                    <div class="user-part-dropdown">
                        <a data-toggle="modal" data-target="#login">login</a>
                        <a data-toggle="modal" data-target="#sign-up">sign up</a>
                    </div>
                </li>

                <?php
            }
            ?>

        </ul>

    </div>
</nav>

<?php

//SESSION MESSAGES ////////////////////////////
if ($this->session->flashdata('registered')) { ?>
    <p class="flash_alert text-center alert alert-dismissable alert-success"><?php echo $this->session->flashdata('registered'); ?></p>
    <?php
}

if ($this->session->flashdata('verification_notice')) { ?>
    <p class="flash_alert text-center alert alert-dismissable alert-success"><?php echo $this->session->flashdata('verification_notice'); ?></p>
    <?php
}

if ($this->session->flashdata('login_success')) { ?>
    <p class="flash_alert text-center alert alert-dismissable alert-success"><?php echo $this->session->flashdata('login_success'); ?></p>
    <?php
}

if ($this->session->flashdata('log_out')) { ?>
    <p class="flash_alert text-center alert alert-dismissable alert-success"><?php echo $this->session->flashdata('log_out'); ?></p>
    <?php
}

if ($this->session->flashdata('profile_deleted')) { ?>
    <p class="flash_alert text-center alert alert-dismissable alert-success"><?php echo $this->session->flashdata('profile_deleted'); ?></p>
    <?php
}
?>


