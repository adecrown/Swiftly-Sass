<?php
include_once 'inc/checklogin.php';
include_once 'commoncodes/navSearch.php';
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <title>Group Chat</title>
  <link rel="stylesheet" type="text/css" href="lib/css/main.css">
  <link rel="stylesheet" type="text/css" href="lib/css/screen.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet" type="text/css">


</head>
<body onLoad="scrollDiv_init('messagesDetails')">
  <?php echo $nav;?>


  <article>
    <section class="topicsection">
      <section class="messagesFrom">

      </section>
      <section class="messagesDetails" onMouseOver="pauseDiv()" onMouseOut="resumeDiv()">

      </section>
      <section class="replyBox">
        <!--  <form  method="post" action="api/select/inbox.php"> -->
        <input type="text" name="hash" id="hash"  hidden>
        <input type="text" name="rec" id="rec"  hidden>
        <textarea class="replytextarea" name="rmessage" id="rmessage"></textarea>
        <input type="submit" class="but-go repbut" id="sendreply">
        <!--  </form> -->
      </section>
    </section>


    <?php include_once 'commoncodes/uploadfile.php'; //echo $file;?>

  </article>

  <!--  create new Message pop-up starts here-->

  <div id="errorws" class="darkCover">
    <div class="uploadPopup">
      <h2 id="socketws"></h2>
      <a class="close" href="#">×</a>
      <div class="content" id="wserror">
        <br>
        <p>Reasons why this may have happened:</p>

        <ul>
          <li>There is a problem with your connection</li>
          <li>The port is not opened</li>
          <li>The server is down</li>
        </ul>
        <br>
        <p>Restarting the server:</p>
        <ol>
          <li>Read the installation manual on how to start the sever</li>
          <li>Restart the server and refresh this page to try again.</li>
        </ol>
        <br>

        <p>If you deicde to continue sending your message, we can't promise that it will be received by your friend</p>
      </div>
    </div>
  </div>

  <!--  create new Message pop-up ends here-->



  <?php include_once 'commoncodes/footer.php';//echo $footer;?>
  <script type="text/JavaScript" src="lib/js/send.js"></script>
  <script type="text/JavaScript" src="lib/js/wbs.js"></script>
  <script type="text/JavaScript" src="lib/js/inbox.js"></script>
  <script type="text/JavaScript" src="lib/js/messagefrm.js"></script>
  <script type="text/JavaScript" src="lib/js/uploadFile.js"></script>
  <script type="text/JavaScript" src="lib/js/search.js"></script>


</body>
</html>
