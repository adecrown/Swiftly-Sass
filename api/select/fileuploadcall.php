<?php

include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../../inc/sessionStart.php';
include_once 'fileupload.php';
sec_session_start();

//
$files_accepted = array(
    ".doc",".docx", ".xls", ".txt", ".pdf", ".gif", ".jpg", ".zip", ".rar", ".ppt",
    ".html", ".xml", ".tiff", ".jpeg", ".png" );

$maxSize=1024*1000;//the max file size for images in bytes.
$u=new uploader($maxSize, "../../uploadedfile/file/");
$imageName=$u->upload("file",$files_accepted);


// uploads file to the database
function opo($file)
{
	global $conn,$op;

try
{
  if ($_POST) {
    $filename = $_POST['fname'];
    $filelink = $file;
    if($_POST['fPrivate'] == 1)
    {
      $filepro = $_POST['fPrivate'];
    }
    else
    {
        $filepro = 0;
    }

    $filetags = $_POST['ftags'];
    $fileowner = $_SESSION['user_id'];

    $sql = "INSERT INTO `filer` (`fileName`,`fileLink`,`fileTags`,`users_userID`,`protect`)
    VALUES ('$filename','$filelink','$filetags',$fileowner,$filepro)";

    if ($conn->query($sql))
    {
        header("Location: ../../index.php");//successfully
    }
    else
    {
      header("Location: ../error.html#upload"); //Error
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
