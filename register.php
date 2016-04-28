<?php
include_once 'inc/sessionStart.php';
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <title>SWIFTLY SASS</title>
  <link rel="stylesheet" type="text/css" href="lib/css/login.css">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet" type="text/css">
</head>

<body>
  <section>
    <p class="nameTitle">SWIFTLY SASS</p>
    <?php
       if (!empty($error_msg)) {
           echo $error_msg;
       }
       ?>
    <form action="inc/register.inc.php" autocomplete="off" method="post" name="login" class="loginCss" >
      <p class="formTitle">REGISTER</p>
      <input type="text" name="username" id="username" placeholder="USERNAME" class="login1" required>
      <p id="userError"></p>
      <input type="password" name="password" id="password" placeholder="PASSWORD" required>
      <p id="passError"></p>
      <input type="password" name="confirmpwd" id="confirmpwd" placeholder="PASSWORD" required>
      <p id="passComError"></p>
      <input type="email" name="useremail" id="useremail" placeholder="SCHOOL EMAIL" class="login1" required>
      <p id="emailError"></p>
      <input type="text" name="usercourse" id="usercourse" placeholder="COURSE" class="login1" required>
      <p id="courseError"></p>
      <input type="text" name="school" id="school" placeholder="SCHOOL NAME" class="login1" required>
      <p id="schoolError"></p>

      <input type="submit" value="REGISTER" class="but-go">

    </form>
    <p class="register">
      <a href="login.php">SIGN IN</a>
    </p>
  </section>
</body>
</html>
