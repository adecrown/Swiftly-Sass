<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../../inc/sessionStart.php';
include_once '../data/data.php';

sec_session_start();

$user1 = $_SESSION['username'];
$senderID = $_SESSION['user_id'];
$messageDis = array();

// inserts message to the database
if (isset($_GET['hash'],$_GET['rmessage'],$_GET['rec'],$_GET['from']))
{
  $recv = $_GET['rec'];
  $fromWho = $_GET['from'];

  $result = selectData(array ("userID"),"users",array("username"),array($recv),array("="),"username");
  $toWhomID = $result[0]->userID;

  $rmessage = $_GET['rmessage'];
  $hash = $_GET['hash'];

  $curentTime = time();
  $val=array("$hash","$fromWho","$recv","$rmessage","no","$curentTime");
  $table="`messages`";
  $field=array("conversationETag","sender","towho","message","userRead","timestamp");

  $direct = "yes";

  insert($field,$val,$table,$direct,"","");
}
// select messages from the database
else if(isset($_GET['hash']) && !empty($_GET['hash']))
{
  $hash = $_GET['hash'];
  $getCTime = $_GET['timeNow'];

  //selects all message from the database with the given hash
  $message_query = selectData(array("`id`","toWho","sender","message","timestamp"),"`messages`",array("conversationETag"),array($hash),array ("="),"timestamp");

  /*
  below code formats all result into a proper json data
   */
  if(count($message_query) > 0)
  {
    foreach($message_query as $run_message)
    {
      $from_user = filter_var($run_message->sender, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
      $to_user = filter_var($run_message->toWho, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
      $message = filter_var($run_message->message, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

      $message_pic = selectData(array("`picture`"),"`users`",array("username"),array($from_user),array ("="),"`picture`");

      if(count($message_pic) > 0)
      {
        $messagep;
        foreach($message_pic as $run_messagepic )
        {
          $messagep = filter_var($run_messagepic->picture, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
          $messageDis["messageInbox"][] = array('from' => $from_user,'to' => $to_user,'message' => $message, 'pict' =>$messagep,'stamp' =>$run_message->timestamp);
        }
        if($messagep > 0)
        {
          $sql = "UPDATE messages SET userRead =  'yes' WHERE toWho = '$user1' AND conversationETag = '$hash'";
          if ($conn->query($sql)){}
          }

        }

      }
    }
  }
  else
  {

  }


  echo json_encode($messageDis);
  ?>
