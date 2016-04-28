<?php
include_once 'db_connect.php';
include_once 'sessionStart.php';

sec_session_start();

$out = "";
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //$res = login($username, $password, $conn);
global $conn;

    if (login($username, $password, $conn) == true )
    {
        // Login success
        header('Location: ../index.php');

    }
    else if ($hun === "yes")
    {
        header('Location: ../login.php?error2');
    }
    else
     {
        // Login failed
        if($warnLocked != "")
        {

        }

        header('Location: ../login.php?error1');
    }
}
else
 {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}
