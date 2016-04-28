<?php
include_once '../../inc/sessionStart.php';
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/db_connect.php';


sec_session_start();
$userID = $_SESSION['user_id'];
$user1 = $_SESSION['username'];
//$user2 = $_GET['userT2'];
// inserts messages made into the database
if (isset($_POST['toWhom'],$_POST['message'])) {


    // Sanitize and validate the data passed in
    $Message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $toWhom = filter_input(INPUT_POST, 'toWhom', FILTER_SANITIZE_STRING);
    $ETagNumber = rand();
    //$questionid = $_POST['questionid'];
  //  $parentid = $_POST['parentid'];

      $cookie_name = "MessageAlert";
     $conversation = "SELECT `eTagHash` FROM `conversation` WHERE `userOne`= '$user1' AND `userTwo`= '$toWhom 'OR
     `userOne` = '$toWhom' AND `userTwo`= '$user1' ";

     $result = selectron($conversation, array());
     if(count($result) > 0)
     {
       // conversation already started
       header("Location: ../../messages.php");
       $cookie_value = "Conversation already exists";
     }
     else
     {

       $result = selectData(array ("username","userID"),"users",array("username"),array($toWhom),array("="),"username");

       // if user exists 
       if(count($result) > 0)
       {

         $read ="no";
         $val1=array("$user1","$toWhom","$ETagNumber");
         $val2=array("$ETagNumber","$user1","$toWhom","$Message","$read");
         $table1="conversation";
         $table2="messages";
         $field1=array("userOne","userTwo","eTagHash");
         $field2=array("conversationETag","sender","toWho","message","userRead");

         $direct = "no";
         insert($field1,$val1,$table1,$direct,"","") ;

         insert($field2,$val2,$table2,$direct,"","") ;
        $cookie_value = "Message Sent";
       }
       else
        {
         $cookie_value = "User does not exists";
       }
     }

     setcookie($cookie_name,$cookie_value, time() + (250 * 30), "/"); // 86400 = 1 day
}

    ?>
