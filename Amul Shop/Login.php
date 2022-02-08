<?php
session_start();
include 'Connection.php';
if(isset($_SESSION['uid']))
{
  header('location:index.php');
}

if(isset($_POST['login']))
{
  $userid = $_POST['userid'];
  $pass = $_POST['pass'];

  if($userid != '' and $pass != '')
  {
    $query = "select * from registration where userid='$userid' and pass='$pass'";

    $res = mysqli_query($con,$query);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        echo "<script>alert('Login Successful.');</script>";

        session_start();
        while($data=mysqli_fetch_array($res))
        {
          $last_id = $data['id'];
        }

        $_SESSION['uid'] = $last_id;
        header('location:index.php');
    }
    else
    {
          echo "<script>alert('Invalid User ID or Password.');</script>";
    }
  }
  else {
    echo "<script>alert('Please fill all the fields.');</script>";
  }
}
?>
<html>
  <head>
    <link href="CSS/Index.css" rel="stylesheet"/>
    <link href="CSS/Login.css" rel="stylesheet"/>
    <style>
    #reg
    {
      height: 40px;
      width: 160px;
      background-color: #b2c0ce;
      border:none;
      border-radius: 40px;
      margin-top:-55px;
      margin-left:650px;
      display: block;
      text-decoration: none;
    }
    a{
      text-decoration: none;
    }
    </style>
  </head>
  <body>
    <div id="menu">
      <div id="logo">
        <img src="Images/logo.png"/>
      </div>
      <div id="rightmenu">
        <ul>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="Products.php">Products</a></li>
            <li><a href="About.php">About Us</a></li>
            <li><a href="Contact Us.php">Contact Us</a></li>
            <li id="active"><a href="Login.php">Login</a></li>
          </ul>
        </ul>
      </div>
    </div>
    <div id="main">
      <div id="title">
        LOGIN
      </div>
      <form action="" method="post">
        <div id="username">
          <input type="text" placeholder="User ID" name="userid"/>
        </div>
        <div id="password">
          <input type="password" placeholder="Password" name="pass"/>
        </div>
        <div id="btn" style="margin-left:-100px;">
          <input type="submit" value="LOGIN" name="login" id="login"/>
        </div>

      </form>

        <a href="Registration.php"><input type="button" value="REGISTER" id="reg"/></a>

    </div>
  </body>
</html>
