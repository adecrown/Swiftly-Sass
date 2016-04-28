<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/sessionStart.php';
sec_session_start();
$data = array();

$q=$_GET["id"];

$getCTime = $_GET['timeNow'];
$groupIDNum = $q;

$groupinfo = selectTable(array("`group`","`users`"),array("`group`.groupName","`users`.userID","`users`.username","`users`.picture"),array("`users`.userID","group.idgroup"),array("`group`.groupAdmin",$groupIDNum),"",array("=","=") );

$groupmembers = selectTable(array("`users`","`group_has_users`"),array("userID","username","picture"),array("users.userID","group_has_users.group_idgroup"),array("group_has_users.users_userID",$groupIDNum),"",array("=","=") );


$getgroupfiles = selectData(array("`id`","Name","Link"),"`groupFiles`",array("groupID"),array($groupIDNum),array ("="),"id");

	//echo "show messaages";
	if($getCTime =="")
	{
		$message_query = selectData(array("`idMessage`","groupMessage","users_userID","timestamp"),"`groupMessage`",array("group_idgroup"),array($groupIDNum),array ("="),"timestamp");
	}
	else
	{
		//$message_query = selectData(array("`idMessage`","groupMessage","users_userID","timestamp"),"`groupMessage`",array("group_idgroup","timestamp"),array($groupIDNum,$getCTime),array ("=",">"),"timestamp");

		$sql = "SELECT distinct `idMessage`,groupMessage,users_userID,timestamp FROM `groupMessage` where group_idgroup = $groupIDNum AND timestamp > $getCTime  ORDER BY timestamp";

    $message_query = selectron($sql, array());
	}


	if(count($message_query) > 0)
	{

		foreach($message_query as $run_message)
		{
			$from_user = $run_message->users_userID;
			$message = filter_var($run_message->groupMessage, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

			$message_pic = selectData(array("`picture`","username"),"`users`",array("userID"),array($from_user),array ("="),"`picture`");

			if($message_pic !="")
			{
			foreach($message_pic as $run_messagepic )
			{
				$messagep = filter_var($run_messagepic->picture, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
				$messageSender = filter_var($run_messagepic->username, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
				$data["messageInbox"][] = array('from' => $messageSender, 'message' => $message, 'pict' =>$messagep,'stamp' =>$run_message->timestamp);
			}
}

		}
	}

	// gets users files
	$fileowner = $_SESSION['user_id'];
	$fileresult = getFiles($fileowner);
	if($fileresult !="")
	{
		foreach ($fileresult as $fileobj)
		{
			$data["file"][] = array('id' =>$fileobj->fileID,'name' => $fileobj->fileName, 'link' => $fileobj->fileLink);
		}
	}

	if($getgroupfiles !="")
	{
		foreach($getgroupfiles as $file)
		{
			$grName= filter_var($file->Name, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
			$data["groupfile"][] = array('id' => $file->id,'Name' => $grName,'Link' => $file->Link);
		}
	}


	if($groupinfo !="")
	{
		foreach ($groupinfo as $obj)
		{
			$grName= filter_var($obj->groupName, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
			$data["groupInfo"][] = array('usersId' => $obj->userID,'groupName' => $grName,'groupAdmin' => $obj->username,'avatar'=>$obj->picture);
		}
	}

	if($groupmembers !="")
	{
		foreach ($groupmembers as $obj2)
		{
			$data["groupMembers"][] = array('id' => $obj2->userID,'username' => $obj2->username,'avatar'=>$obj2->picture);
		}
	}

echo json_encode($data);
?>
