<?php
  if(isset($_POST['login']))
  {
    $uid = $_POST['uid'];
    $pass = $_POST['pass'];

    if($uid=='admin' and $pass=='admin')
    {
      header('location:home.php');
      session_start();
      $_SESSION['admin'] = 1;
    }
    else {
      echo "<script>alert('Invalid UserID or Password');</script>";
    }
  }
?>
<html>
  <head>
    <link href="CSS/Login.css" rel="stylesheet"/>
    <style>
    a{
      text-decoration: none;
      color:black;
    }
    </style>
  </head>
  <body>
    <form action="" method="post">
    <div id="main">
      <div id="title">
        LOGIN
      </div>
      <div id="username">
        <input type="text" placeholder="User ID" name="uid"/>
      </div>
      <div id="password">
        <input type="password" placeholder="Password" name="pass"/>
      </div>
      <div id="btn">
        <input type="submit" value="LOGIN" name="login"/>
      </div>
      <div id="img">
        <img src="../Images/logo.png" />
      </div>
    </div>
  </form>
  </body>
</html>
