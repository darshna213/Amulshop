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
    #search
    {
      height:35px;
      width:200px;
      border-radius: 35px;
      border:none;
      padding-left:10px;
      outline: none;
    }
    #searchbtn
    {
      height:35px;
      width:100px;
      border-radius: 35px;
      border:none;
      background-color: black;
      color:white;
      margin-left:10px;
    }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
      $(document).ready(function(){
        $count = 1;
        setTimeout(show,2000);
        function show()
        {
          if($count == 7)
          {
            $count=1;
            setTimeout(show,2000);
          }
          else {

          $('#sliderimg').fadeOut(1000,function(){
            $('#sliderimg').attr('src','Images/Slider/s'+$count+'.jpg');
            $('#sliderimg').fadeIn(1000);
            $count = $count +1;

            setTimeout(show,2000);
          });

        }
        }
      });
    </script>
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
              <li><form action="Search Item.php" method="post"><input type="text" id="search" name="searchitem" placeholder="Search"/><input type="submit" value="SEARCH" id="searchbtn"/></form></li>
        </ul>
      </div>
    </div>

    <div id="slider">
      <div id="images">
        <img src="Images/Slider/s6.jpg" id="sliderimg"/>
      </div>
    </div>

    <div id="productbox">
      <!-- Categorys Menu Start -->

      <!-- Categorys Menu End -->

      <?php
      $query = "select * from products";

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
