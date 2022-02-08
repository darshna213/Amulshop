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
    <title>Amul</title>
    <link href="CSS/Index.css" rel="stylesheet"/>
    <style>
      a{
        text-decoration: none;
        color:black;
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
            <li id="active"><a href="Products.php">Products</a></li>
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
              <li style="color:black;">Welcome <?php echo $data['name'];?></li>

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


    <div id="productbox">
      <!-- Categorys Menu Start -->
      <div id="mainright">
      <ul id="productcategory">
        <li><a href="Products.php">All</a></li>
      <?php
      $query = "select * from category";

      $res = mysqli_query($con,$query);

      while($data = mysqli_fetch_array($res))
      {
      ?>
        <a href="Products <?php echo $data['name'];?>.php" style="color:black;"><li><?php echo $data['name'];?></li></a>
      <?php
      }
      ?>
    </ul>
  </div>
  <div id="mainleft">

      <!-- Categorys Menu End -->

      <?php
      $query = "select * from products where category = 'Ice Cream'";

      $res = mysqli_query($con,$query);
      $num = mysqli_num_rows($res);

      while($data = mysqli_fetch_array($res))
      {
      ?>
      <a href="Product Detail.php?pid=<?php echo $data['id'];?>">
      <div id="box">
        <div id="imgbox">
          <img src="Images/Product/<?php echo $data['image'];?>"/>
        </div>
        <div id="productdes">
          <div id="productname"><?php echo $data['pname'];?></div>
          <div id="productprice">Rs.<?php echo $data['price'];?></div>
        </div>
      </div>
    </a>
      <?php
      }
      if($num==0)
      {
        echo "<div style='position:absolute; left:120px; margin-top:30px; font-family:arial; font-size:20px;'>Item not available.</div>";
      }
      ?>
      <div id="box">

      </div>
      <div id="box">

      </div>
      <div id="box">

      </div>
    </div>
    </div>
    <!-- Footer Start-->
    <div style="height:300px; width:100%; background-color:#00d1b1; margin-top:250px;">
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
