<?php
include_once '../../inc/sessionStart.php';
include_once '../../inc/config.php';
include_once '../data/data.php';

sec_session_start();
$userID = $_SESSION['user_id'];

// inserts comment made into the database
if (isset($_POST['pcomment'],$_POST['questionid']))
{
  // $objp = new insertdata();
  // Sanitize and validate the data passed in
  $comment = filter_input(INPUT_POST, 'pcomment', FILTER_SANITIZE_STRING);
  $questionid = $_POST['questionid'];
  $parentid = $_POST['parentid'];

  $val=array("$comment","$questionid","$userID","$parentid");
  $table="comment";
  $field=array("comment","question_idquestion","users_userID","child");

  $direct = "no";
  insert($field,$val,$table,$direct,"","");
}
?>
