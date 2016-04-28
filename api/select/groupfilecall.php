<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../../inc/sessionStart.php';
include_once '../data/data.php';
include_once 'fileupload.php';
sec_session_start();

$files_accepted = array(
  ".doc", ".xls", ".txt", ".pdf", ".gif", ".jpg", ".zip", ".rar", ".ppt",
  ".html", ".xml", ".tiff", ".jpeg", ".png" );

  $maxSize=1024*1000;//the max file size for images in bytes.
  $u=new uploader($maxSize, "../../uploadedfile/file/");
  $imageName=$u->upload("file",$files_accepted);

  // this function controls the group file upload 
  function opo($file)
  {
    global $conn,$op;
    try {
      if ($_POST) {
        $filename = $_POST['fname'];
        $filelink = $file;
        $fileowner = $_SESSION['user_id'];
        $groupowner = $_POST['groupown'];

        $sql = "INSERT INTO `groupFiles` (`Name`,`Link`,`groupID`,`userID`)
        VALUES ('$filename','$filelink',$groupowner,$fileowner)";
        if($conn->query($sql))
        {
          $newMess = "Added a new file called: $filename";
          postGroupMes($groupowner,$newMess,$fileowner);
        }
      }
    }
    catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
      echo "    Code". $e->getCode();
    }


  }


  opo($imageName);
  ?>
