<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/sessionStart.php';

sec_session_start();
$data = array();

$user1 = $_SESSION['user_id'];
$currentUser = $_SESSION['username'];
$q=$_GET["keywords"];


if (strlen($q)>0) {
	$keywords = $q;
	//$keywords = $mysqli->real_escape_string($_GET["keywords"]);

	$searchusers = "SELECT userID, username,picture FROM users WHERE username LIKE '%".$keywords."%' AND username != '$currentUser'";

	$searchsubject = "SELECT subjectID, subjectName FROM subject WHERE subjectName LIKE '%".$keywords."%'";

	$searchquestion = "SELECT idquestion, title FROM question WHERE title LIKE '%".$keywords."%'";
	$sql4 = "SELECT fileID, fileName,fileLink FROM filer WHERE fileName LIKE '%".$keywords."%' AND protect = 0 AND users_userID != '$user1'";

	$searchusersresult =  selectron($searchusers,  array());
	$searchsubjectresult = selectron($searchsubject,  array());
	$searchquestionresult = selectron($searchquestion,  array());
	$result4 = selectron($sql4,  array());

	/*
	below code formats all result into a proper json data
	 */
	foreach ($searchusersresult as $obj) {

		$otherUserId = $obj->userID;
		$field=array("`user1`","`user2`");
		$decide = follow($field,"`follow`",$user1,$otherUserId);

		$data["users"][] = array('id' => $otherUserId, 'title' => $obj->username,'relation' => $decide,'pics'=>$obj->picture);
	}

	foreach($searchsubjectresult as $obj2)
	{
		$subjectID = $obj2->subjectID;

		$field=array("`users_userID`","`subject_subjectID`");
		$subdecide = follow($field,"`usersFollowsSubject`",$user1,$subjectID);
		$data["subject"][] = array('sid' => $subjectID, 'stitle' => $obj2->subjectName,'relation' => $subdecide,);
	}

	foreach($searchquestionresult as $obj3)
	{
		$tile = filter_var($obj3->title, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

		$data["quest"][] = array('qid' => $obj3->idquestion, 'qtitle' => $tile);

	}

	foreach($result4 as $obj4)
	{
		$fileName = filter_var($obj4->fileName, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);

		$data["sfiles"][] = array('id' => $obj4->fileID, 'fileName' => $fileName, 'fileLink' => $obj4->fileLink);

	}

}
echo json_encode($data);
