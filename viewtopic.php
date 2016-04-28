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
<body>
  <?php echo $nav;?>

<article>
    <section class="topicsection">

      <p id="vtitle">kl</p>
      <div class="suggestion closeq">
      <p id="closeq">kl</p>
    </div>
      <p id="vnote">m,</p>

      <section id="comment">

      </section>

      <section class="replyform">
        <p class="replyt">Reply to this question</p>
        <form   method="post" action="api/inserts/comment.php">
          <textarea id="pcomment" name="pcomment" required></textarea>
          <input type="text" id="questionid" name="questionid"  readonly hidden>
          <input type="text" id="parentid" name="parentid"  readonly hidden>
          <input type="submit" class="but-go" id="qcomment" name="qcomment">
        </form>
      </section>

    </section>


      <?php include_once 'commoncodes/uploadfile.php';?>

</article>

<?php include_once 'commoncodes/footer.php';// echo $footer;?>
<script type="text/JavaScript" src="lib/js/send.js"></script>
<script type="text/JavaScript" src="lib/js/uploadFile.js"></script>
<script type="text/JavaScript" src="lib/js/gettopic.js"></script>

<script type="text/JavaScript" src="lib/js/search.js"></script>

</body>

</html>
