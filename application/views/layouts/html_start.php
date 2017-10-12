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

    <!-- Global stylesheets -->
    <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="/assets/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">

    <!-- Global JS files -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/js/general.js"></script>

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
    echo "<body class='main'>";
    $this->load->view('/layouts/main/header');
}
?>
