<?php
try
{
  $dbs="";
  $connectVM = new PDO("mysql:host=127.0.0.1;dbname=$dbs", 'root', 'root');
  // set the PDO error mode to exception
  $connectVM->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
  //
  $stmt = $connectVM->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'up720163_test'");
  $resultVM = $stmt->fetchColumn();
  if($resultVM == 0)
  {
    $sql = "CREATE DATABASE up720163_test";
    $connectVM->query($sql);
    $dbs = "up720163_test";
    require_once 'inc/db_connect.php';
    createSql();
  }
}
catch(PDOException $e)
{
  echo "Connection failed: " . $e->getMessage();
  echo "    Code". $e->getCode();
}



function createSql()
{
  //echo "Database my_db created successfully\n";
  require_once 'inc/db_connect.php';
  $construct = "installDatabase/up720163Table.php";
  try {
    if(file_exists($construct))
    {
      global $conn;
      require_once($construct);
      $conn->query($sqlTable);


      $dump = "installDatabase/up720163Dump.sql";
      if(file_exists($dump))
      {
        global $conn;
        $sql = file_get_contents($dump);
        $sql = explode(";", $sql);
        foreach($sql as $s)
        {
          $conn->query($s);
        }

      }

    }
    chmod('uploadedfile/file/', 0777); // change permission
    chmod('uploadedfile/image/', 0777); // change permission
  }
  catch(PDOException $e)
  {
    $codeError = $e->getCode();
    if($codeError != 23000 && $codeError != 42000)
    {
      echo "Connection failed: " . $e->getMessage() ."\n";
      //echo "    Code". $e;
      echo "Code".  $codeError;
    }
  }
}

?>
