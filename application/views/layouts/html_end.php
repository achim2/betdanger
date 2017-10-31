<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ($this->uri->segment(1) == 'admin') {
    echo "</body>";
} else {
    echo "</main>";
    $this->load->view('/layouts/main/footer');
    echo "</body>";
}
?>

</html>