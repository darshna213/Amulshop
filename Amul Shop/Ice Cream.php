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
    <title>Milky</title>
    <link href="CSS/Index.css" rel="stylesheet"/>
  </head>
  <body>
    <div id="menu">
      <div id="logo">
        <img src="Images/logo.png"/>
      </div>
      <div id="rightmenu">
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
      </div>
    </div>

    <div id="slider">
      <div id="images">
        <img src="Images/Slider/s6.jpg"/>
      </div>
    </div>

    <div id="productbox">
      <!-- Categorys Menu Start -->

      <ul id="productcategory">
        <li id="catactive">All</li>
      <?php
      $query = "select * from category";

      $res = mysqli_query($con,$query);

      while($data = mysqli_fetch_array($res))
      {
      ?>
        <a href="<?php echo $data['name'];?>.php" style="color:black;"><li><?php echo $data['name'];?></li></a>
      <?php
      }
      ?>
    </ul>

      <!-- Categorys Menu End -->

      <?php
      $query = "select * from products where category = 'Ice Cream'";

      $res = mysqli_query($con,$query);

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

      ?>
      <div id="box">

      </div>
      <div id="box">

      </div>
      <div id="box">

      </div>
    </div>
  </body>
</html>
