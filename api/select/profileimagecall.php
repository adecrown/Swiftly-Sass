<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';
include_once '../../inc/sessionStart.php';
include_once  'fileupload.php';
sec_session_start();


$cls_arr_ext_accepted = array(
	".gif", ".jpg",".jpeg", ".png" );

$maxSize=1024*1000;//the max file size for images in bytes.
$u=new uploader($maxSize, "../../uploadedfile/image/");
$imageName=$u->upload("file",$cls_arr_ext_accepted);


function opo($file)
{
	global $conn,$op;

		if ($_POST) {

			$filelink = $file;
			$fileowner = $_SESSION['user_id'];


			$sql = "UPDATE users SET picture =  '$filelink' WHERE userID = $fileowner";

			if ($conn->query($sql))
			{
				//echo "New record created successfully".$op;
					header("Location: ../../index.php");//successfully
			}
			else
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				//header("Location: ../error.html#upload"); //Error
			}

		}
	}

opo($imageName);
?>
