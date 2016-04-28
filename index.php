<?php
include_once 'install.php';
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
    <section class="profile">

      <div class="profileimage">


        <div class="pic">

        </div>
        <form method="post" action="api/select/profileimagecall.php" enctype="multipart/form-data">

          <div id="pictureName" class="changepic">

            <span>Click to change Avatar</span>
          </div>

          <div class="hidebutton">

            <input type="file"  size="40" id="up" name="file"  multiple hidden>
          </div>
          <input type="text" name="fname"  placeholder="Rename" hidden="hidden">
        </form>



      </div>

      <div class="coursename">
        <p class="cname"></p>
      </div>
      <div class="universityname">
        <p class="uniname"></p>
      </div>

      <div class="following">
        <a class="ftitle" href="display.php?relation=followers">FOLLOWERS</a>
        <a class="ftitle" href="display.php?relation=following">FOLLOWING</a>
        <a class="ftitle">GROUPS</a>
        <a class="ptitle" id="pt" href="display.php?relation=followers"></a>
        <a class="ptitle" id="pt1" href="display.php?relation=following"></a>
        <a class="ptitle" id="groupC">0</a>

      </div>
      <div class="level">
        <p class="lvl" id="point">Points</p>
        <a href="messages.php">
          <p class="lvl"> Messages> </p>
        </a>
      </div>
      <div class="message">
        <a href="messages.php">
          <img src="images/mes.png" alt="Messages"></a>
          <a href="messages.php">
            <p id="newmesage" class="newmesage"></p>
          </a>
        </div>
      </section>

      <section class="groupsName">
        <section>
        <a>Groups You Belong To</a>
      </section>

      </section>

      <?php include_once 'commoncodes/uploadfile.php';//echo $file;?>

      <section class="fivecontribution">
        <section>
          <a>Last 5 Contribution</a>
      </section>
      </section>

      <section class="subjectTitle">
        <a>Subject you follow</a>
      </section>
      <section class="subjectF">
        <!--  list of subject you follow-->

      </section>


      <section class="liveproblems">
        <section>
          <a>
        Other Users Problem You Can Contribute To
      </a>
    </section>
      </section>

      <section class="subjectTitle">
        <a>Subject to follow</a>
      </section>
      <section class="subjectT">

      </section>

    </article>

<?php include_once 'commoncodes/footer.php'; //echo $footer;?>


    <script type="text/JavaScript" src="lib/js/send.js"></script>
    <script type="text/JavaScript" src="lib/js/uploadFile.js"></script>
    <script type="text/JavaScript" src="lib/js/profile.js"></script>
    <script type="text/JavaScript" src="lib/js/search.js"></script>



  <!--  <script type="text/JavaScript" src="lib/js/testing.js"></script>-->


  </body>
  </html>
