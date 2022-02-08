<?php
  session_start();
  if(isset($_SESSION['uid']))
  {
    $uid = $_SESSION['uid'];
  }
  include 'Connection.php';



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

    }
  }

?>

<html>
  <head>
    <title>Amul</title>
    <link href="CSS/Index.css" rel="stylesheet"/>
    <link href="CSS/cart.css" rel="stylesheet"/>
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


    <table border="0" cellspacing="50" cellpadding="10" style="margin-left:100px; border:1px solid silver; margin-top:50px; margin-bottom:50px;">
      <tr style="font-family:arial; font-size:20px; font-weight:bold;">
        <td>

        </td>
        <td>NAME</td>
        <td>PRICE</td>
        <td>QUANTITY</td>
        <td>TOTAL</td>
      </tr>
      <?php
        if(isset($_SESSION['uid']))
        {
          $query5 = "select * from temp_cart where cid=$uid and status=0";

          $res5 = mysqli_query($con,$query5);

          $totalprice = 0;

          while($data5=mysqli_fetch_array($res5))
          {
            $proid = $data5['pid'];
      ?>
      <tr style="font-family:arial; font-size:16px;">

        <td><?php
          $query6 = "select * from products where id=$proid";

          $res6 = mysqli_query($con,$query6);



          while($data6=mysqli_fetch_array($res6))
          {
          ?>
        <img src="<?php echo $data6['image'];?>" width="200px"/>

        </td>
        <td><?php echo $data6['pname'];?></td>
        <?php
        }
        ?>
        <td><?php echo $data5['price'];?></td>
        <td><?php echo $data5['qty'];?></td>
        <td><?php echo $data5['price']*$data5['qty'];?></td>
      </tr>
      <?php
          $totalprice = $totalprice + ($data5['price']*$data5['qty']);
        }
      }
       ?>
    </table>
    <table style="position:absolute; top:200px; right:100px; font-size:20px; font-family:arial;">
      <tr>
        <td>
          <b>Total : </b><?php if(isset($_SESSION['uid']))
          { echo $totalprice; }?>
          <a href="Payment.php"><button style="height:40px; width:150px; background:black; color:white; border:none; margin-left:60px;">CHECKOUT</button></a>
        </td>
      </tr>

    </table>
    <!-- Footer Start-->
    <div style="height:300px; width:100%; background-color:#00d1b1; margin-top:100px;">
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
