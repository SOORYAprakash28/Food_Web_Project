<?php
// distroy the session 
// include constants.php for siteurl

include('../config/constants.php');
session_destroy(); //usets $_SESSON['user']

header('location:http://localhost/foodordering/admin/login.php');
?>

