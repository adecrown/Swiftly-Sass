<?php
include_once 'inc/db_connect.php';
include_once 'inc/sessionStart.php';

sec_session_start();

if (login_check() == false) {
    $logged = 'out';
    header("Location: login.php");
    exit();
}
?>
