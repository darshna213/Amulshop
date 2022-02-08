<?php
  session_start();
  include 'Connection.php';
  if(isset($_SESSION['uid']))
  {
    $uid = $_SESSION['uid'];
  }
  else {
    header('location:index.php');
  }

  if(isset($_POST['update']))
  {
    $uname = $_POST['uname'];
    $email = $_POST['uemail'];
    $userid = $_POST['uid'];
    $pass = $_POST['upass'];

    $query2 = "update registration set name='$uname',email='$email',userid='$userid',pass='$pass' where id=$uid";
    $res2 = mysqli_query($con,$query2);
    if($res2)
    {
      echo "<script>alert('Record Updated successfully');</script>";
    }
    else {
      echo "<script>alert('Failed');</script>";
    }
  }
?>
<html>
  <head>
    <style>
      input{
        height: 40px;
        width:300px;
        margin-bottom:40px;
      }
      label{
        font-family: arial;
        font-size: 15px;
      }
      #main
      {
        position: absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
      }
      #btn{
        background-color: black;
        border:none;
        color:white;
      }
    </style>
    <link href="CSS/Index.css" rel="stylesheet"/>
    <style>
    #totalitem
    {
      height:20px;
      width:20px;
      background-color: white;
      border-radius: 50%;
      color:black;
      line-height: 20px;
      text-align: center;
      position: absolute;
      margin-top:-25px;
      margin-left:17px;
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
            <li id="active"><a href="index.php">Home</a></li>
            <li><a href="Products.php">Products</a></li>
            <li><a href="About.php">About Us</a></li>
            <li><a href="Contact Us.php">Contact Us</a></li>
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
              <li><img src="images/supermarket.png" width="23px"/>
                <?php
                  if (isset($_SESSION['uid']))
                  {
                    $query5 = "select * from temp_cart where cid=$uid";

                    $res5 = mysqli_query($con,$query5);
                    $total = 0;
                    while($data5 = mysqli_fetch_array($res5))
                    {
                        $total = $total + 1;
                    }
                  }
                 ?>
                <a href="cart.php"><div id="totalitem">
                <?php
                if (isset($_SESSION['uid']))
                {
                echo $total;
                }
                else
                {
                  echo "0";
                }
                ?></div></a>
          </ul>
        </ul>
      </div>
    </div>

      <div id="main">
          <form action="" method="post">
            <?php
              $query = "select * from registration where id=$uid";

              $res = mysqli_query($con,$query);

              while($data = mysqli_fetch_array($res))
              {
             ?>
              <label>USER NAME</label><br>
              <input type="text" name="uname" value="<?php echo $data['name'];?>"/><br>
              <label>EMAIL-ID</label><br>
              <input type="email" name="uemail" value="<?php echo $data['email'];?>"/><br>
              <label>USER ID</label><br>
              <input type="text" name="uid" value="<?php echo $data['userid'];?>"/><br>
              <label>PASSWORD</label><br>
              <input type="text" name="upass" value="<?php echo $data['pass'];?>"/><br>
              <input type="submit" value="UPDATE" name="update" id="btn"/>
              <?php
              }
               ?>
          </form>
      </div>
      <!-- Footer Start-->
      <div style="height:300px; width:100%; background-color:#00d1b1; margin-top:550px;">
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
