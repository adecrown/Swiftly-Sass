<?php
include_once 'inc/db_connect.php';
include_once 'inc/sessionStart.php';

sec_session_start();

if (login_check() == true)
{
    //$logged = 'in';
    header("Location: home.html");
    //exit();
  }
  else
  {
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
        if (isset($_GET['error1'])) {
            echo '<p class="error">Username or Password is incorrect!</p>';
        }

            else if (isset($_GET['error2'])) {
                echo "<p class='error'>We've locked your account for two hours!</p>";
            }
            ?>
    <form action="inc/login.inc.php" autocomplete="off" method="post" name="login" class="loginCss">
      <p class="formTitle">SIGN IN</p>
      <input type="text" name="username" id="loginName" placeholder="USERNAME" class="login1" required>
      <input type="password" name="password" id="password" placeholder="PASSWORD" required>
      <input type="submit" value="SIGN IN" class="but-go">

    </form>
    <p class="register">
      <a href="register.php">REGISTER</a>
    </p>
  </section>
</body>

</html>
<?php
}
?>
