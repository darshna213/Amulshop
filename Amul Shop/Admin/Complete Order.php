<?php
session_start();
if(!isset($_SESSION['admin']))
{
  header('location:index.php');
}
include 'Connection.php';
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
          <th>ORDER ID</th>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>ADDRESS</th>
          <th>CITY</th>
          <th>TOTAL</th>
          <th></th>
        </tr>
        <?php
          include 'Connection.php';

          $query = "select * from payment";

          $res = mysqli_query($con,$query);

          while($data = mysqli_fetch_array($res))
          {
         ?>
        <tr align="center">
          <td><?php echo $data['id'];?></td>
          <td><?php echo $data['name'];?></td>
          <td><?php echo $data['email'];?></td>
          <td><?php echo $data['address'];?></td>
          <td><?php echo $data['city'];?></td>
          <td><?php echo $data['total'];?></td>
          <td><a href="Order Detail.php?cid=<?php echo $data['cid'];?>"><button style="height:35px; width:100px; background-color:black; color:white; border:none;">SHOW</button></a></td>
        </tr>
        <tr><td colspan="7"><div id="line"></div></td></tr>
        <?php
          }
         ?>
      </table>
    </div>
  </body>
</html>
