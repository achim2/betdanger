<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>betDANGER!</title>

    <meta name="robots" content="noindex" />

    <!-- Global stylesheets -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Global JS files -->
    <script src="/assets/js/dest/bundle.js"></script>

    <?php
    //add styles and scripts at Controller
    //    $this->mylib->add_style();
    $this->mylib->get_styles();
    //    $this->mylib->add_script('');
    $this->mylib->get_scripts();
    ?>

</head>

<?php
if ($this->uri->segment(1) == 'admin'){
    echo "<body class='admin'>";
    $this->load->view('/layouts/admin/header');
}else{
    echo "<body>";
    $this->load->view('/layouts/main/header');
}
?>
