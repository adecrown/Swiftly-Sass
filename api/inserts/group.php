<?php
include_once '../../inc/sessionStart.php';
include_once '../../inc/config.php';
include_once '../data/data.php';

sec_session_start();
$userID = $_SESSION['user_id'];
// inserts group created into the database
try {
  if (isset($_POST['gname']))
  {

    points($userID,3);
    // Sanitize and validate the data passed in
    $gname = filter_input(INPUT_POST, 'gname', FILTER_SANITIZE_STRING);

    $val=array("$gname","$userID");
    $table="`group`";
    $field=array("groupName","groupAdmin");
    $direct = "yes";
    $to = '../../group.php?id=';
    $getid = "yes";
    insert($field,$val,$table,$direct,$to,$getid);

  }

} catch(PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
  echo "    Code". $e->getCode();
}

?>
