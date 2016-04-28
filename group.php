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
<body onLoad="scrollDiv_init('groupMessages')">
  <?php echo $nav;?>


  <article>
    <section class="topicsection">
      <section>
        <p id="groupName"></p>
        <div class="groupMem"></div>
        <div class="groupMessages" onMouseOver="pauseDiv()" onMouseOut="resumeDiv()"></div>

      </section>
      <section class="replyBox groupreplybox">
        <form  method="post" action="api/inserts/groupMessage.php">
          <input type="text" name="groupid" id="groupid" hidden>
          <textarea class="replytextarea groupreplytextarea" name="gmessage" id="gmessage"></textarea>
          <input type="submit" class="but-go repbut" id="sendreply">
        </form>
      </section>


    </section>

    <section class="groupfile">
      <p>Group Files</p>
      <br>

      <div class="groupfilename">
      </div>

      <div class="addfile">
        <a href="#groupupload">
          <p class="addfilebutton">Add File</p>
        </a>
      </div>
    </section>


    <section class="addUser">

        <input type="text" name="groupidl" id="groupidl" hidden>
        <input type="text" name="newUsername" id="newUsername" placeholder="USERNAME" >
        <input  value="Add New User" class="but-go" id="newUser"  readonly>

      <div id="errorSub"></div>
    </section>
  </article>




  <!--  upload form pop-up starts here-->
  <div id="groupupload" class="darkCover">
    <div class="uploadPopup">
      <a href="#filefrom">
        <p class="addfilebutton">Add File from account</p>
      </a>
      <h2>Add file from computer</h2>
      <a class="close" href="#">×</a>
      <div class="content">

        <form method="post" action="api/select/groupfilecall.php" enctype="multipart/form-data">
          <div class="uploadButton">
            <div  id="fileName" class="uploadbt">
              <span>Drag or click to upload your files</span>
            </div>

            <div class="hidebutton">
              <input type="file"  size="40" id="i" name="file" multiple>

            </div>
          </div>

          <div class="uploadRestriction">
            <br>
            <input type="text" name="fname"  placeholder="Rename" id="fname">
            <input type="text" name="groupown" id="groupown" hidden>
            <br>
          </div>
          <input type="submit" value="submit" id="groupfileup" class="but-go formButton">
        </form>
        <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>

      </div>
    </div>
  </div>

  <!--  upload form ends-up starts here-->



  <!--  see your files pop-up starts here-->

  <div id="filefrom" class="darkCover">
    <div class="filecontentloadFull uploadPopup">
      <a href="#groupupload">
        <p class="addfilebutton">Add File from computer</p>
      </a>
      <h2>Uploaded Files</h2>
      <a class="close" href="#">×</a>
      <div class="content">

        <section class="filecontentload" id="hidefileload">

        </section>
        <section class="filePreview">

        </section>

        <section class="downloadbtn" id="bnt">

        </section>
      </div>
    </div>
  </div>

  <!--  see your files pop-up ends here-->

  <div id="filesp" class="darkCover">
    <div class="uploadPopup">
      <h2>Files</h2>
      <a class="close" href="#">×</a>
      <div class="content">


        <section class="filePreview1">

        </section>

        <section class="downloadbtn" id="bnt1">

        </section>
      </div>
    </div>
  </div>

  <?php include_once 'commoncodes/footer.php'; //echo $footer;?>
  <script type="text/JavaScript" src="lib/js/send.js"></script>
  <script type="text/JavaScript" src="lib/js/uploadFile.js"></script>

  <script type="text/JavaScript" src="lib/js/search.js"></script>

<script type="text/JavaScript" src="lib/js/groupinfo.js"></script>
</body>
</html>
