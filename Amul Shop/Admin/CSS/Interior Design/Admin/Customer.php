<?php
  session_start();
  include 'Connection.php';
  if(!isset($_SESSION['uid']))
  {
      header('location:index.php');
  }
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
          <th>ID</th>
          <th>NAME</th>
          <th>EMAIL</th>

        </tr>
        <?php
          include 'Connection.php';

          $query = "select * from registration";

          $res = mysqli_query($con,$query);

          while($data = mysqli_fetch_array($res))
          {
         ?>
        <tr align="center">
          <td><?php echo $data['id'];?></td>
          <td><?php echo $data['name'];?></td>
          <td><?php echo $data['email'];?></td>
        </tr>
        <tr><td colspan="3"><div id="line"></div></td></tr>
        <?php
          }
         ?>
      </table>
    </div>
  </body>
</html>
