<?php
include_once '../../inc/sessionStart.php';
include_once '../../inc/config.php';
include_once '../data/data.php';

sec_session_start();
$userID = $_SESSION['user_id'];

// inserts topic created into the database
if (isset($_POST['topictitle'],$_POST['topic'], $_POST['topictags'])) {

    points($userID,5);
    // Sanitize and validate the data passed in
    $topictitle = filter_input(INPUT_POST, 'topictitle', FILTER_SANITIZE_STRING);
    $topic = filter_input(INPUT_POST, 'topic', FILTER_SANITIZE_STRING);
    $topictags = filter_input(INPUT_POST, 'topictags', FILTER_SANITIZE_STRING);

    $val=array("$topictitle", "$topic", "$topictags","$userID");
    $table="question";
    $field=array("title","note","tags","users_userID");

    $direct = "yes";
    $to = '../../viewtopic.php?question=';
    $getid = "yes";
    insert($field,$val,$table,$direct,$to,$getid);
}
?>
