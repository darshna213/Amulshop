<?php
session_start();
if(!isset($_SESSION['admin']))
{
  header('location:index.php');
}
include 'Connection.php';
?>
<?php
  $cid = $_GET['cid'];
?>
<html>
  <head>
    <link href="CSS/View Product.css" rel="stylesheet"/>
    <style>
    a{
      text-decoration: none;
      color:black;
    }
    </style>
  </head>
  <body>
    <div id="menu">
      <div id="mainmenu">
        <ul>
          <a href="Home.php"><li>HOME</li></a>
          <a href="Add Product.php"><li>ADD PRODUCT</li></a>
          <a href="View Products.php"><li>VIEW PRODUCT</li></a>
          <a href="Customer.php"><li>CUSTOMER LIST</li></a>
          <a href="Complete Order.php"><li>ORDER LIST</li></a>
          <a href="Logout.php"><li>LOGOUT</li></a>
        </ul>
      </div>
    </div>
    <div id="main">
      <table width="100%">
        <tr>
          <th>PRODUCT NAME</th>
          <th>QUANTITY</th>
          <th>PRICE</th>
          <th>TOTAL</th>
        </tr>
        <?php
          include 'Connection.php';

          $query = "select * from temp_cart where cid=$cid";

          $res = mysqli_query($con,$query);

          while($data = mysqli_fetch_array($res))
          {
            $pid = $data['pid'];
            $query2 = "select * from products where id=$pid";
            $res2 = mysqli_query($con,$query2);
            while($data2 = mysqli_fetch_array($res2))
            {
         ?>
        <tr align="center">
          <td><?php echo $data2['pname'];?></td>
          <td><?php echo $data['qty'];?></td>
          <td><?php echo $data2['price'];?></td>
          <td><?php echo $data['qty']*$data2['price'];?></td>
        </tr>
        <tr><td colspan="4"><div id="line"></div></td></tr>
        <?php
      }
          }
         ?>
      </table>
    </div>
  </body>
</html>
