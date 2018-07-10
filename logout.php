<?php
require_once 'header.php';
unset($_SESSION["email"]);
session_destroy();
redirect("login.php");
?>
