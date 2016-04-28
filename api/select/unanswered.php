<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../data/data.php';
include_once '../../inc/sessionStart.php';

sec_session_start();

$data = array();
$result = unansweredQ(); // gets all unanswered question

/*
below code formats all result into a proper json data
 */
if (count($result) > 0)
{
  foreach ($result as $obj)
  {
    $title = filter_var($obj->title, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    $data["unanswered"][] = array('id'=>$obj->idquestion,'title' => $title);
  }
}

echo json_encode($data);
 ?>
