<?php
$user = $this->session->userdata();
$logged_in = (isset($user['logged_in'])) ? $user['logged_in'] : false;
$categories = $this->Content_model->get_categories();

?>

<?php
if ($logged_in == false) {

    $this->load->view('/user/lost_pass');
    $this->load->view('/user/login_form');
    $this->load->view('/user/signup_form');
}
$this->load->view('/search/search_form');
?>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">betDANGER!<sup>&copy;</sup></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto navbar-left">
                <!-- menu items -->
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(1) == '') ? 'active' : '' ?>" href="<?php echo base_url(); ?>">home</a>
                </li>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->id != 1): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($this->uri->segment(3) == $category->name) ? 'active' : '' ?>"
                               href="<?php echo base_url("/category/" . $category->name); ?>"
                            ><?php echo $category->name; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <ul class="navbar-nav ml-auto navbar-right">
            <!-- reg & login || profile-->
            <?php if ($logged_in) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-lg-block">Profile</span>
                        <div class="d-none"><?php echo $this->session->userdata('username'); ?></div>
                        <span class="icon icon-user d-lg-none"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <?php
                        $user_type = $user['user_type'];

                        if (($user_type === 'user') || ($user_type === 'administrator') || ($user_type === 'moderator')) {
                            echo '<a class="dropdown-item dropdown-user">' . $user['username'] . '</a>';
                        }

                        if ($user_type === 'moderator') {
                            echo "<a class=\"dropdown-item\" href=" . base_url('/admin') . ">admin</a>";
                        }

                        if (($user_type === 'user') || ($user_type === 'administrator') || ($user_type === 'moderator')) {
                            echo "<a class=\"dropdown-item\" href='/user/profile'>profile</a>";
                            echo "<a class=\"dropdown-item\" href='/user/logout'>log out</a>";
                        }
                        ?>
                    </div>
                </li>

            <?php else: ?>

                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-user"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" data-toggle="modal" data-target="#login">login</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#sign-up">sign up</a>
                    </div>
                </li>

            <?php endif; ?>

            <!-- nav search part-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#search_modal">
                    <span class="icon icon-search"></span>
                </a>
            </li>

            <!-- navbar toggler-->
            <li class="nav-item d-lg-none">
                <a class="nav-link" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon icon-align-justify"></span>
                </a>
            </li>

        </ul>
    </div>
</nav>

<main>
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

    if ($this->session->flashdata('unsubscribe')) { ?>
        <p class="flash_alert text-center alert alert-dismissable alert-success"><?php echo $this->session->flashdata('unsubscribe'); ?></p>
        <?php
    }
    ?>


