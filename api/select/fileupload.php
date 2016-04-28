<?php
include_once '../../inc/db_connect.php';
include_once '../../inc/config.php';

// this calls for files and image upload
class uploader
{
	var $maxFileSize;
	var $uploadDir;
	var $op ;

	function uploader($max, $dir)
	{
		$this->maxFileSize=$max;
		$this->uploadDir=$dir;
	}
	function upload($object,$cls_arr_ext_accepted)
	{
		$file_size=$_FILES[$object]['size'];
		$file_name=$_FILES[$object]['name'];

		if( !in_array( strtolower( strrchr($file_name, "." )), $cls_arr_ext_accepted )){
			return "EXTENSION_FAILURE";
		}
		else
		{

			if($file_size <= $this->maxFileSize && strlen($file_name)>0)
			{
				$temp = explode(".", 	$file_name);
				$newfilename = round(microtime(true)) . '.' . end($temp);

				$op = $newfilename;
				move_uploaded_file($_FILES[$object]['tmp_name'], $this->uploadDir.$newfilename) ;
				return ($op);
			}
			else
			{
				return('NOFILE.jpg');
			}
		}
	}
}

?>
