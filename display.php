<?php
include_once 'inc/checklogin.php';
include_once 'commoncodes/navSearch.php';
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <title>Welcome Home</title>
  <link rel="stylesheet" type="text/css" href="lib/css/main.css">
    <link rel="stylesheet" type="text/css" href="lib/css/screen.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet" type="text/css">




</head>
  <?php echo $nav;?>
<body>
  <article>
      <section class="topicsection unsquestion2">
<section class="sugest">
  <ul id="relationpo" class="suggestfollow">
  </ul>
</section>

      </section>


        <?php include_once 'commoncodes/uploadfile.php';//echo $file;?>


  </article>

  <?php include_once 'commoncodes/footer.php';//echo $footer;?>

    <script type="text/JavaScript" src="lib/js/send.js"></script>
  <script type="text/JavaScript" src="lib/js/display.js"></script>
  <script type="text/JavaScript" src="lib/js/uploadFile.js"></script>
  <script type="text/JavaScript" src="lib/js/search.js"></script>
</body>
</html>
