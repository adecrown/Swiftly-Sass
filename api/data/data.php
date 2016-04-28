<?php
include_once '../../inc/db_connect.php';


if(isset($_GET['functionName']))
{
  $myID = $_GET['myid'];
  $folID = $_GET['otherid'];
  $pd = $_GET['pd'];
  $val = $_GET['val'];
  $filename = $_GET['name'];
  $filelink = $_GET['link'];
  $groupid = $_GET['gid'];
  $quesID= $_GET['questionid'];

  switch($_GET['functionName'])
  {
    case 'followCallm': userfollowCall($myID,$folID,$pd); break;
    case 'followCallsub': subjectfollowCall($myID,$folID,$pd); break;
    case 'files': fileProtectCall($myID,$val); break;
    case 'questionclose': closequestion($quesID); break;
    case 'store': addfilefromOthers($filename,$filelink,$myID); break;
    case 'togroup': addfiletogroup($filename,$filelink,$myID,$groupid); break;
    default: break;
  }
}

// inserts to the database
function insert($fields,$values,$table,$redirect,$url,$getid)
{

  //insertdata();
  global $conn;
  try {
    $val=null;
    $str=implode(",",$fields);
    $val=implode("','",$values);
    //$tab=implode("``",$table);
    $sql="INSERT INTO $table ($str) VALUES ('$val')";
    $conn->exec($sql);

    if($redirect === "yes")
    {
      if($getid === "yes")
      {
        $id = $conn->lastInsertId();
        header("Location: $url$id");
      }
      else
      {
        header("Location: $url");
      }

    }

  } catch(PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
    echo "    Code". $e->getCode();
  }


}

// allows group member to post messages
function postGroupMes($gID,$gmessage,$userID)
{
  $curentTime = time();
  $val=array("$gmessage","$gID","$userID","$curentTime");
  $table="`groupMessage`";
  $field=array("groupMessage","group_idgroup","users_userID","timestamp");
  $direct = "no";
  insert($field,$val,$table,$direct,"","");
}


function sanitize($what, $method = INPUT_POST)
{
  $filtered = filter_input($method,$what, FILTER_SANITIZE_STRING);
  return $filtered;
}

function extractVars($method = INPUT_GET)
{
  $out = array();
  foreach ($_REQUEST as $key => $value) {
    $out[$key] = stripslashes(strip_tags(urldecode(filter_input($method,$key, FILTER_SANITIZE_STRING))));
  }

  return $out; // $_REQUEST;
}

// gets the poeople am following
function follow($fields,$table,$userID,$otherId)
{
  $decide;

  $str=implode(",",$fields);

  //$sql = "SELECT followID,`user1`,`user2` FROM follow WHERE `user1` = '$userID'AND `user2` = '$otherUserId'";
  $sql ="SELECT $str FROM $table WHERE $fields[0] =:user AND $fields[1] =:other";
  $sqlArray = array(':user' => $userID, ':other' => $otherId);
  //'$userID' AND $fields[1] = '$otherId'";

  $result = selectron($sql, $sqlArray);
  if(count($result) > 0)
  {
    $decide = "Unfollow";
  }
  else {
    $decide = "Follow";
  }

return $decide;
}

// lets user follow another user
function userfollowCall($myID,$folID,$pd)
{
  $table="follow";
  $field=array("user1","user2");
  followChange($field,$table,$myID,$folID,$pd);
}

// lets user follow a subject
function subjectfollowCall($myID,$folID,$pd)
{
  $table="usersFollowsSubject";
  $field=array("`users_userID`","`subject_subjectID`");
  followChange($field,$table,$myID,$folID,$pd);
}


// lets user follow a subject or another user
function followChange(array $field,$table,$myID,$folID,$pd)
{

  if ($pd =="") {

    $val=array("$myID","$folID");
    $direct = "no";
    insert($field,$val,$table,$direct,"","");

  }
  else {
    global $conn;
    $sql = "DELETE FROM $table WHERE $field[0]='$myID' AND $field[1]='$folID'";
    //$sql = "DELETE FROM follow WHERE `user1`='$myID' AND `user2`='$folID'";
    $conn->query($sql);
  }

}

// displays the user am following and user following me
function moreInfo($userID,$switch)
{

  if($switch == "following")
  {
    $result = selectTable(
    array("`follow`","users"),
    array ("users.userID","users.picture","users.username"),
    array ("users.userID","`user1`"),
    array ("`user2`",$userID),"",
    array("=","="));

  }
  elseif($switch == "followers")
  {
    $result = selectTable(
    array("`follow`","users"),
    array ("users.userID","users.picture","users.username"),
    array ("users.userID","`user2`"),
    array ("`user1`",$userID),"",
    array("=","="));

  }

  return $result;

}

// gets files belonging to a user
function getFiles($userID)
{

  $result = selectData(array ("fileID","fileName","fileLink","protect"),"filer",array("users_userID"),array($userID),array("="),"fileID");

  return $result;

}

// updates the protect level of a file 0 or 1
function fileProtectCall($myID,$val)
{
  global $conn;
  $sql = "UPDATE `filer` SET `protect` = '$val' WHERE `fileID` = '$myID'";
  $conn->query($sql);

}

// allows user to add a file uploaded by another user into their account
function addfilefromOthers($fileName,$fileLink,$myID)
{
  $val=array("$fileName","$fileLink",$myID);
  $table="filer";
  $field=array("fileName","fileLink","users_userID");

  $direct = "no";
  insert($field,$val,$table,$direct,"","");
}

// adds a file to group
function addfiletogroup($fileName,$fileLink,$myID,$groupid)
{
  $val=array("$fileName","$fileLink","$groupid","$myID");
  $table="groupFiles";
  $field=array("`Name`","`Link`","groupID","userID");

  $direct = "no";
  insert($field,$val,$table,$direct,"","");
  $newMess = "Added a new file called: ".$fileName;
  postGroupMes($groupid,$newMess,$myID);
}

// returns 50 unanswered questions
function unansweredQ()
{
  global $mysqli;
  $conn = $mysqli;
  $remQ = "a.idquestion";

  $result = leftjoin(array ("question","comment"),array ("idquestion","question_idquestion"),array("question_idquestion",$remQ),"50");

  return $result;
}


// gies the user point
function points($id,$num)
{
  global $conn;
  $getPoint = selectData(array("points"),"users",array ("userID"),array ($id),array ("="),"points");
  $points =   $getPoint[0]->points;
  $pointsIncre = $points + $num;
  $sql = "UPDATE `users` SET `points` = '$pointsIncre' WHERE `userID` = '$id'";
  $conn->exec($sql);
}


// counts the number of a result
function countNum($name,$from,array $where,array $val)
{
  //  global $mysqli; $conn = $mysqli;

  if(count($where)==1)
  {
    $whereQuery = "$where[0] =:valOne";
    $arrayVal = array(':valOne' => $val[0]);
  }
  else
  {
    $whereQuery = "$where[0] =:valOne AND $where[1]=:valTwo";
    $arrayVal = array(':valOne' => $val[0], ':valTwo' => $val[1]);
  }
  $sql = "SELECT count(*) as $name FROM $from where $whereQuery";
  $result = selectron($sql,$arrayVal);
  return $result;
}

//select table using left join
function leftjoin(array $tables,array $where,array $val,$limit)
{
  //global $mysqli; $conn = $mysqli;
  $sql = "SELECT *
  FROM $tables[0] as a
  WHERE NOT EXISTS(SELECT *
  FROM $tables[1] as b WHERE a.$where[0] = b.$val[0] and b.$where[1]=$val[1]) ORDER BY RAND() LIMIT $limit ";


  $arrayVal = array();
  $result = selectron($sql,$arrayVal);
  return $result;
}

// select table
function selectData(array $fields,$from,array $where,array $val,array $arit,$orby)
{
  //global $mysqli; $conn = $mysqli;
  $str=implode(",",$fields);
  if(count($where)==1)
  {
    $whereQuery = "$where[0] $arit[0]:valOne";
    $arrayVal = array(':valOne' => $val[0]);
    //'$val[0]'";
  }
  else
  {
    $whereQuery = "$where[0] $arit[0]:valOne AND $where[1] $arit[1]:valTwo";
    $arrayVal = array(':valOne' => $val[0], ':valTwo' => $val[1]);
  }

  $sql = "SELECT distinct $str FROM $from where $whereQuery ORDER BY $orby";
  $result = selectron($sql,$arrayVal);
  return $result;

}

// select table using inner join
function selectTable(array $table,array $column,array $joinon,array $joinVal,$limit,array $arit)
{
  //global $mysqli; $conn = $mysqli;
  $col = implode(",",$column);
  if($limit !="")
  {
    $limitVal = $limit;
  }
  else {
    $limitVal = 20;
  }

  if(count($joinon)==3)
  {
    //$selectCont = "AND $joinon[2] $arit[2]:valThree LIMIT";
    //$arrayVal = array(':valTwo' => $joinVal[1],':valThree' => $joinVal[2]);
    $selectCont = "AND $joinon[2] $arit[2] $joinVal[2] LIMIT";
    $arrayVal = array(':valTwo' => $joinVal[1]);
  }
  else
  {
    $selectCont = "LIMIT";
    $arrayVal = array(':valTwo' => $joinVal[1]);
  }
  $sql = "SELECT distinct $col FROM $table[0] INNER JOIN $table[1] ON $joinon[0] $arit[0] $joinVal[0] AND $joinon[1] $arit[1]:valTwo $selectCont $limitVal";


  //$joinVal[0] AND $joinon[1] $arit[1] $joinVal[1] $selectCont $limitVal";

  $result = selectron($sql,$arrayVal);
  return $result;
}

// closes a question
function closequestion($quesID)
{
  global $conn;
  $sql = "UPDATE `question` SET `closed` = 1 WHERE `idquestion` = '$quesID'";
  $conn->query($sql);
}

//pdo select fuction
function selectron($sql, $param = array())
{
  global $conn;

  try
  {
    $stmt = $conn->prepare($sql);
    $stmt->execute($param);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $result = $stmt->fetchAll();
    return $result;
  }
  catch(PDOException $e)
  {
    echo "Connection failed: " . $e->getMessage();
    echo "    Code". $e->getCode();
  }

}

?>
