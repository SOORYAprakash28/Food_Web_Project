<?php
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message'] = "<div class='error'> Please login for access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>


