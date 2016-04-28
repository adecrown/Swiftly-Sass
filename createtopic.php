<?php
include_once 'inc/checklogin.php';
include_once 'commoncodes/navSearch.php';
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <title>Create A New Topic</title>
  <link rel="stylesheet" type="text/css" href="lib/css/main.css">
    <link rel="stylesheet" type="text/css" href="lib/css/screen.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet" type="text/css">




</head>
<body>
  <?php echo $nav;?>


<article>
  <section class="topicsection">
  <form class="questionform" method="post" action="api/inserts/topic.php" id="postform">
   <label>Title</label>
    <input type="text" id="topictitle"  name="topictitle" placeholder="Give your question a title" autocomplete="off" required>
    <textarea id="topic" name="topic" required>
    </textarea>
    <label>Tags</label>
      <input type="text" id="topictags" placeholder="Give your question some tags" autocomplete="off" alt="Tags" name="topictags">
        <input type="submit" id="submit" value="Submit" class="but-go topicsubmit">
  </form>
  </section>


    <?php include_once 'commoncodes/uploadfile.php';//echo $file;?>

</article>



<?php include_once 'commoncodes/footer.php';//echo $footer;?>
<script type="text/JavaScript" src="lib/js/send.js"></script>
<script type="text/JavaScript" src="lib/js/uploadFile.js"></script>
<script type="text/JavaScript" src="lib/js/search.js"></script>


</body>
</html>
