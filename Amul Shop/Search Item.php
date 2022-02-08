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
            <li><a href="index.php">Home</a></li>
            <li  id="active"><a href="Products.php">Products</a></li>
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


    <div id="productbox">
      <?php
      $item = $_POST['searchitem'];
      
      $query = "select * from products where pname='$item' or category='$item'";
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

  </body>
</html>
