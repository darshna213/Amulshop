<?php
  session_start();
  if(isset($_SESSION['uid']))
  {
    $uid = $_SESSION['uid'];
  }
  include 'Connection.php';

  if(!isset($_GET['pid']))
  {
    header('location:Products.php');
  }
  else {
    $id = $_GET['pid'];

    $query = "select * from products where id=$id";

    $res = mysqli_query($con,$query);

  }

  if(isset($_POST['cart']))
  {
    if (isset($_SESSION['uid']))
    {
      $cid = $_SESSION['uid'];
      $pid = $_GET['pid'];
      $price = $_POST['price'];
      $qty = $_POST['qty'];
      $query2 = "insert into temp_cart(cid,pid,price,qty,status) values($cid,$pid,$price,$qty,0)";
      $res2 = mysqli_query($con,$query2);
      if($res2)
      {
          echo "<script>alert('Product inserted successfully.')</script>";

      }
      else {
          echo "<script>alert('Failed')</script>";
      }
    }
    else {
      echo "<script>alert('Please Login to your account.')</script>";
      echo "<script>window.location='Login.php';</script>";
    }
  }

?>

<html>
  <head>
    <title>Amul</title>
    <link href="CSS/Index.css" rel="stylesheet"/>
    <link href="CSS/Product Detail2.css" rel="stylesheet"/>
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
                $query3 = "select * from registration where id=$uid";

                $res3 = mysqli_query($con,$query3);

                while($data3 = mysqli_fetch_array($res3))
                {
              ?>
              <li><a href="Logout.php">Logout</a></li>
              <a href="My Account.php"><li style="color:black;">Welcome <?php echo $data3['name'];?></li></a>

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
                    $query4 = "select * from temp_cart where cid=$uid";

                    $res4 = mysqli_query($con,$query4);
                    $total = 0;
                    while($data4 = mysqli_fetch_array($res4))
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
              </li>
          </ul>
        </ul>
      </div>
    </div>



    <?php


        while($data = mysqli_fetch_array($res))
        {
     ?>
     <form action="" method="post">
    <div id="mainproductbox">
      <div id="mainproductimg">
        <img src="<?php echo $data['image'];?>"/>
      </div>
      <div id="productdetails">
        <div id="mainproducttitle">
          <?php echo $data['pname'];?>
        </div>
        <div id="mainproductdes">
          <div id="label">Description</div>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div id="mainproductprice">
          <div id="label">Price</div>
          Rs.<?php echo $data['price'];?>
          <input type="hidden" value="<?php echo $data['price'];?>" name="price"/>
          <br><br>
          <div id="mainproductqty">
            <div id="label">Quantity</div>
            <select name="qty" id="qty">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
          </div>
        </div>

        <div id="mainproductbtn">
          <input type="submit" id="cartbtn" value="ADD TO CART" name="cart"/>
        </div>
      </div>
    </div>
  </form>
    <?php
  }
   ?>

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
