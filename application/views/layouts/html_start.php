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

    <meta name="robots" content="noindex"/>

    <!-- Global stylesheets -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Global JS files -->
<!--    <script src="/node_modules/jquery/dist/jquery.min.js"></script>-->
    <script src="/node_modules/jquery/dist/jquery.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/src/general.js"></script>
    <script src="/assets/js/src/ajax_form_validation.js"></script>
    <script src="/assets/js/src/toggle.js"></script>
    <script src="/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.js"></script>

    <?php
    //add styles and scripts at Controller
    //    $this->mylib->add_style();
    $this->mylib->get_styles();
    //    $this->mylib->add_script('');
    $this->mylib->get_scripts();
    ?>

</head>
<body class="<?php echo ($this->uri->segment(1)) ? 'page-' . $this->uri->segment(1) : ''; ?>
<?php echo ($this->uri->segment(2)) ? ' page-' . $this->uri->segment(1) . '-' . $this->uri->segment(2) : ''; ?>"
>