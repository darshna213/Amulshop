<?php

  include 'Connection.php';


  if(isset($_POST['reg']))
  {
    $name = $_POST['name'];
    $email= $_POST['email'];
    $userid = $_POST['userid'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if($name != '' and $email != '' and $userid != '' and $pass != '' and $cpass != '')
    {
      if($pass==$cpass)
      {
        $query = "insert into registration(name,email,userid,pass) values('$name','$email','$userid','$pass')";

        $res = mysqli_query($con,$query);

        if($res)
        {
            echo "<script>alert('Registration Successful.');</script>";
            session_start();
            $last_id = $con->insert_id;
            $_SESSION['uid'] = $last_id;
            header('location:index.php');
        }
        else
        {
              echo "<script>alert('Registration Failed.');</script>";
        }
      }
      else {
        echo "<script>alert('Password and Confirm Password Not Match.');</script>";
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
    <link href="CSS/Register.css" rel="stylesheet"/>
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
        REGISTR<br>ATION
      </div>
      <form action="" method="post">
        <div id="username">
          <input type="text" placeholder="Name" name="name"/>
        </div>
        <div id="email">
          <input type="email" placeholder="E-Mail ID" name="email"/>
        </div>
        <div id="userid">
          <input type="text" placeholder="User ID" name="userid"/>
        </div>
        <div id="password">
          <input type="password" placeholder="Password" name="pass"/>
        </div>
        <div id="cpassword">
          <input type="password" placeholder="Confirm Password" name="cpass"/>
        </div>
        <div id="btn">
          <input type="submit" value="SUBMIT" name="reg"/>
        </div>
      </form>
    </div>
  </body>
</html>
