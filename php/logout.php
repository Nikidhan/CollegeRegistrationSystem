<?php
    session_start();

    //$old_user store the old session to test if they *were* logged in
    $old_user = $_SESSION['user_id'];
    unset($_SESSION['valid_user']);
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    unset($_SESSION['fail_register']);
    unset($_SESSION['new_register']);
    unset($_SESSION['user_email']);
    session_unset();
  session_destroy();
  header("location: home.php");
