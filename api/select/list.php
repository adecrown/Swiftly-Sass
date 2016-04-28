<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../../inc/sessionStart.php';
include_once '../data/data.php';

sec_session_start();

$user1 = $_SESSION['username'];

// lists all users a user have started a conversation with
$messageData = array();
$get_con = "SELECT `eTagHash`,`userOne`,`userTwo` FROM `conversation` WHERE `userOne`= '$user1' OR `userTwo`= '$user1'";

/*
below code formats all result into a proper json data
 */
$resultUser = selectron($get_con,array());

if(count($resultUser) > 0)
{
  foreach($resultUser as $run_con )
  {
    $eTagHash = filter_var($run_con->eTagHash, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    $userOne = filter_var($run_con->userOne, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    $userTwo = filter_var($run_con->userTwo, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

    if($userOne == $user1)
    {
      $userOne = $userTwo;
      $userTwo = $user1;
    }
    $messageData["messageInfo"][] = array('TagHash' => $eTagHash, 'user1n' => $userOne, 'user2n' => $userTwo);


    $select_User ="";

    if($userOne == $user1)
    {
           $select_User = $userTwo;
    }
    else
    {
         $select_User = $userOne;
    }

    $user_get = selectData(array("userID","username"),"`users`",array("username"),array($select_User),array ("="),"username");

    $myWebId = selectData(array("userID","picture"),"`users`",array("username"),array($user1),array ("="),"username");
    $myId = $myWebId[0]->userID;
    $myAvatar = $myWebId[0]->picture;
    $myName = $user1;

    foreach($user_get as $run_user)
    {
        $select_username = filter_var($run_user->username,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

        $messageData["messageLink"][] = array('TagHash' => $eTagHash, 'sender' => $select_username,'myId' => $myId,'toId'=>$run_user->userID,'myPicture' =>$myAvatar ,'myName'=>$myName);
    }

  }
}
else
{
}

echo json_encode($messageData);

?>
