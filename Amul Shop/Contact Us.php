<?php
  session_start();
  include 'Connection.php';
  if(isset($_SESSION['uid']))
  {
    $uid = $_SESSION['uid'];
  }
?>
<html>
  <head>
    <link href="CSS/Index.css" rel="stylesheet"/>
    <link href="CSS/Contact Us.css" rel="stylesheet"/>
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
            <li  id="active"><a href="Contact Us.php">Contact Us</a></li>
            <?php
              if (isset($_SESSION['uid']))
              {
                $query = "select * from registration where id=$uid";

                $res = mysqli_query($con,$query);

                while($data = mysqli_fetch_array($res))
                {
              ?>
              <li><a href="Logout.php">Logout</a></li>
              <a href="My Account.php"><li style="color:black;">Welcome <?php echo $data['name'];?></li></a>

              <?php
                }
              }
              else
              {
              ?>
              <li><a href="Login.php">Login</a></li>
              <?php
              }
              ?>
          </ul>
        </ul>
      </div>
    </div>
    <div id="main">
      <div id="box1">
        Contact Us
        <div id="address">
          Bhavnagar,<br>
          Gujarat<br>
          test@gmail.com<br>
          +91 908765 4321
        </div>
      </div>
      <div id="box2">
        <form method="post" action="">
          <input type="text" placeholder="Name" name="name"/>
          <input type="text" placeholder="Phone" name="phone"/>
          <input type="email" placeholder="Email" name="email"/>
          <textarea placeholder="Message" name="address"></textarea>
          <br>
          <input type="submit" value="Send" name="submit" id="btn"/>
        </form>
      </div>
    </div>
    <!-- Footer Start-->
    <div style="height:300px; width:100%; background-color:#00d1b1; margin-top:-150px;">
      <div style="float:left;">
        <img src="Images/logo.png" width="100px" style="margin-left:200px; margin-top:100px;"/>
      </div>
      <div style="float:left; margin-top:50px; margin-left:300px;">
        <div style="font-family:arial black; font-size:20px;">Quick Links</div>
        <br>
        <ul style="list-style:none; font-family:arial; margin:0; padding:0px;">
          <li style="margin-top:10px;"><a href="index.php" style="text-decoration:none; color:black;">Home</a></li>
          <li style="margin-top:10px;"><a href="Products.php"style="text-decoration:none; color:black;">Products</a></li>
          <li style="margin-top:10px;"><a href="About.php" style="text-decoration:none; color:black;">About Us</a></li>
          <li style="margin-top:10px;"><a href="Contact Us.php" style="text-decoration:none; color:black;">Contact Us</a></li>

        </ul>
      </div>
      <div style="float:left; margin-top:50px; margin-left:300px;">
          <div style="font-family:arial black; font-size:20px;">Address</div>

          <div style="font-family:arial; font-size:20px;">101, xyz road,</div>
          <div style="font-family:arial; font-size:20px;">Bhavnagar,</div>
          <div style="font-family:arial; font-size:20px;">364001.</div><br>
          <div style="font-family:arial black; font-size:20px;">Email</div>

          <div style="font-family:arial; font-size:20px;">milky@gmail.com</div>

      </div>
    </div>
    <!-- Footer End-->
  </body>
</html>
<?php
  if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $query = "insert into contactus(name,phone,email,msg) values('$name',$phone,'$email','$address')";

    $res = mysqli_query($con,$query);

    if($res)
    {
      echo "<script>alert('Feedback Submitted.')</script>";
    }
    else {
      echo "<script>alert('Query Error.')</script>";
    }
  }

 ?>
