<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/sessionStart.php';
include_once '../data/data.php';

sec_session_start();

$user1 = $_SESSION['username'];
$user1ID = $_SESSION['user_id'];
$getID = intval($_GET['profile']);

$viewerID;
if($getID == 0)
{
	$viewerID = $_SESSION['user_id'];
}
else
{
	$viewerID = $getID;
}

$data = array();


//this call the count function in data.php
$message_count = countNum("new_m","messages",array("towho","userRead"),array($user1,"no"));
$followingCount = countNum("fC","follow",array("user1"),array($viewerID));
$followerCount = countNum("fW","follow",array("user2"),array($viewerID));
$groupcount = countNum("gc","`group`",array("groupAdmin"),array($viewerID));


//this call the selectData function in data.php
$userinfo = selectData(
array("username","school","picture","course","points"),
"users",
array("userID"),
array($viewerID),
array("="),
"userID");



//this call the selectTable function in data.php
$subjectuFollow = selectTable
(
array("`subject`","`usersFollowsSubject`"),
array("subjectName","subjectID"),
array("`usersFollowsSubject`.`subject_subjectID`","`usersFollowsSubject`.`users_userID`"),
array("`subject`.`subjectID`",$viewerID),"",
array("=","=")
);


$contribute = selectTable(
array("`comment`","`question`"),
array("`question`.`idquestion`","`question`.`title`"),
array("`question`.`idquestion`","`comment`.`users_userID`"),
array("`comment`.`question_idquestion`",$viewerID),"5",
array("=","=") );


$suggestcontribute = leftjoin(
array ("question","comment"),
array ("idquestion","users_userID"),
array ("question_idquestion",$viewerID),"4");


$groupUserBelong = selectTable(
array("`group`","`group_has_users`"),
array("idgroup","groupName"),
array("group.idgroup","group_has_users.users_userID"),
array("group_has_users.group_idgroup",$viewerID),"5",
array("=","=") );


$subjectucanFollow = leftjoin(
array ("subject","usersFollowsSubject"),
array ("subjectID","users_userID"),
array ("subject_subjectID",$viewerID),"3");


// gets users files
$fileresult = getFiles($viewerID);
if($fileresult !="")
{
	foreach($fileresult as $fileobj)
	{
		$data["file"][] = array('id' =>$fileobj->fileID,'name' => $fileobj->fileName, 'link' => $fileobj->fileLink,'protect'=> $fileobj->protect);
	}
}


$follCValue = $followingCount[0]->fC;
$follWValue = $followerCount[0]->fW;
$groupVal = $groupcount[0]->gc;


if($userinfo !="")
{
	// creates an array of user information

	foreach($userinfo as $obj)
	{
		//$decide;
		if($getID != 0) //checks if the profile showing is for the logged in user
		{
			$otherUserId = $viewerID;
			$field=array("`user1`","`user2`");
			$decide = follow($field,"`follow`",$user1ID,$otherUserId); // checks if the user is being followed
			//	$decide = follow($user1ID,$otherUserId); // checks if the user is being followed
		}
		$pointsNum = $obj->points ;
		$data["profile"][] = array('point'=>$pointsNum,'id'=>$viewerID,'userne'=>$obj->username,'school'=>$obj->school,'course'=> $obj->course,'folCount'=>$follWValue,'foll'=>$follCValue,'profilepic'=>$obj->picture,'rel' =>$decide,'group'=>$groupVal);
	}
}


if($groupUserBelong !="")
{
	foreach($groupUserBelong as $groupobj)
	{

		$data["usersgroup"][] = array('id' => $groupobj->idgroup,'name'=>$groupobj->groupName);
	}
}

if($subjectuFollow !="")
{
	// creates an array of subject user follows
	foreach($subjectuFollow as $obj2)
	{
		$subjecid = $obj2->subjectID;
		$field=array("`users_userID`","`subject_subjectID`");
		$subdecide = follow($field,"`usersFollowsSubject`",$user1ID,$subjecid);
		$data["subjecter"][] = array('id'=>$subjecid,'subjectName' => $obj2->subjectName,'subrel'=>$subdecide);
	}
}


if($contribute !="")
{
	// creates an array of users contribution
	foreach($contribute as $contribution)
	{

		$title = filter_var($contribution->title, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		$data["contributions"][] = array('id' => $contribution->idquestion,'title' => $title);

	}
}

if($suggestcontribute !="")
{
	// creates an array of topic suggestions
	foreach($suggestcontribute as $sugcontribution)
	{

		$title = filter_var($sugcontribution->title, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		$data["sugcontributions"][] = array('id' => $sugcontribution->idquestion,'title' => $title);

	}
}



if($subjectucanFollow !="")
{
	// creates an array of subject user can follow
	foreach($subjectucanFollow as $obj3)
	{
		$subjecid = $obj3->subjectID;
		$field=array("`users_userID`","`subject_subjectID`");
		$subdecide = follow($field,"`usersFollowsSubject`",$user1ID,$subjecid);
		$data["subjectFl"][] = array('id'=>$subjecid,'subjectName' => $obj3->subjectName,'subrel'=>$subdecide);
	}
}



if($getID == 0)
{
	$yung = $message_count[0]->new_m;
	$data["newmessage"][] = array('newM' => 	$yung );

}

echo json_encode($data);
?>
