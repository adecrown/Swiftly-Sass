<?php
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/sessionStart.php';
sec_session_start();
$data;
$userID = $_SESSION['user_id'];
$direct = "no";
// inserts group message made into the database
if (isset($_POST['groupid'],$_POST['gmessage'])) {

  // Sanitize and validate the data passed in
  $gmessage = filter_input(INPUT_POST, 'gmessage', FILTER_SANITIZE_STRING);
  $gID = $_POST['groupid'];
  postGroupMes($gID,$gmessage,$userID);

}
// inserts new group member into the database
elseif (isset($_GET['groupidl'],$_GET['newUsername'])) {

  $newUsername = $_GET['newUsername'];
  $grpid = $_GET['groupidl'];
  $getUserID = selectData(array("userID"),"`users`",array("username"),array($newUsername),array ("="),"userID");
  // checks if the user exist
  if(count($getUserID) > 0)
  {
    $user_ID = $getUserID[0]->userID;
    $findUser = selectData(array("group_idgroup","users_userID"),"`group_has_users`",array("group_idgroup","users_userID"),array($grpid,$user_ID),array ("=","="),"users_userID");
    // checks if user is already a member of the group
    if(count($findUser) > 0)
    {
      $error = "User already belongs to this group";
      $data = $error;

    }
    else
    {

      points($user_ID,3);
      $val=array("$grpid","$user_ID");
      $table="`group_has_users`";
      $field=array("group_idgroup","users_userID");
      insert($field,$val,$table,$direct,"","");
    }
  }
  else
  {
    $error = "User does not exist";
    $data = $error;
  }


}
echo json_encode($data);
?>
