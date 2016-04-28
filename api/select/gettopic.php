<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/sessionStart.php';
sec_session_start();

/*
this page returns a json data of a question along with it's comments
*/
$userloggedin = $_SESSION['user_id'];
$q=$_GET["question"];
$id = (int)$q;
$data = array();

// gets the question by using the given question id
$get_question = selectData(array("idquestion","title","note","users_userID","closed"),"`question`",array("idquestion"),array($id),array ("="),"`title`");

// gets the commensts by using the given question id
$getComment = selectTable(array("comment","users"),array("comment.idcomment","comment.comment","users.picture","users.username"),array("comment.question_idquestion","comment.child","users.userID"),array($id,"0","comment.users_userID"),"",array ("=","=","="));

// gets the commcnts reply by using the comment id
$getCommentreply = selectTable(array("comment","users"),array("comment.comment","comment.child","users.picture","users.username"),array("comment.question_idquestion","comment.child","users.userID"),array($id,"0","comment.users_userID"),"",array ("=",">","="));

/*
below code formats all result into a proper json data
 */
if($get_question !="")
{
	foreach ($get_question as $obj) {

		$title = filter_var($obj->title, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		$note = filter_var($obj->note, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		$checkIsClosed = $obj->closed;
		if($checkIsClosed == "1")
		{
			$isClosed = "Closed";
		}
		else {
			$isClosed = "Open";
		}
		$data["questioner"][] = array('id' => $obj->idquestion, 'title' => 	$title, 'note' => $note,'owner'=> $obj->users_userID,'user'=> $userloggedin,'status'=>$isClosed);
	}
}

if($getComment !="")
{
	foreach ($getComment as $obj2)
	{
		$comment = filter_var($obj2->comment, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		$data["comment"][] = array('id' => $obj2->idcomment, 'commentmade' => $comment,'pic' => $obj2->picture,'username' => $obj2->username);
	}
}

// reply to comments starts from here
if($getCommentreply !="")
{
	foreach($getCommentreply as $obj3)
	{
		$reply = filter_var($obj3->comment, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
		$data["reply"][] = array('replymade' => $reply,'child' => $obj3->child,'pic' => $obj3->picture,'username' => $obj3->username);
	}
}

// reply to comments ends from here


echo json_encode($data);
?>
