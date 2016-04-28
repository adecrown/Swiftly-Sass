<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/sessionStart.php';

sec_session_start();


$data = array();
$user1 = $_SESSION['user_id'];
$relationer = strval($_GET['relation']);
$result = moreInfo($user1,$relationer);

// displays my relationship with other users
if (count($result) > 0)
{
  foreach ($result as $obj)
  {
    $otherUserId = $obj->userID;
    $field=array("`user1`","`user2`");
    $decide = follow($field,"`follow`",$user1,$otherUserId);
    $data["followingDisplay"][] = array('id'=>$otherUserId,'image' => $obj->picture,'username' => $obj->username,'relation' => $decide);
  }
}

echo json_encode($data);
?>
