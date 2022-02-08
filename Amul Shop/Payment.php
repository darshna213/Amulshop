<?php
session_start();
if(isset($_SESSION['uid']))
{
  $uid = $_SESSION['uid'];
}
else{
  header('location:Login.php');
}


include 'Connection.php';

  if(isset($_POST['d']))
  {
    $paymentoption = $_POST['paymentoption'];

    $query = "select * from temp_cart where cid=$uid";
    $res = mysqli_query($con,$query);
    $total = 0;
    while($data = mysqli_fetch_array($res))
    {
      $total = $total + ($data['price']*$data['qty']);
    }



    if($paymentoption == "COD")
    {
      $fname = $_POST['firstname'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $zip = $_POST['zip'];
      $query2 = "insert into payment(cid,name,email,address,city,state,zip,total) values($uid,'$fname','$email','$address','$city','$state',$zip,$total)";
      $res2 = mysqli_query($con,$query2);
      if ($res2)
      {
        echo "<script>alert('Order placed successfully');</script>";
      }
      else {
        echo "<script>alert('Order Error');</script>";
      }

    }
    if($paymentoption == "ONLINE PAYMENT")
    {
      $fname = $_POST['firstname'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $zip = $_POST['zip'];
      $cardname = $_POST['cardname'];
      $cardnumber = $_POST['cardnumber'];
      $expmonth = $_POST['expmonth'];
      $expyear = $_POST['expyear'];
      $cvv = $_POST['cvv'];
      $query3 = "insert into payment(cid,name,email,address,city,state,zip,cardname,cardnumber,expmonth,expyear,cvv,total) values($uid,'$fname','$email','$address','$city','$state',$zip,'$cardname','$cardnumber','$expmonth',$expyear,$cvv,$total)";
      $res3 = mysqli_query($con,$query3);
      if ($res3)
      {
        echo "<script>alert('Order placed successfully');</script>";
      }
      else {
        echo "<script>alert('Order Error');</script>";
      }
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
#paymentoption
{
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
</style>
</head>
<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

$(document).ready(function(){


});
</script>

<h2>Payment</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="#" method="post">

        <div class="row">


          <div class="col-50"><br>
            <label>Select Payment Mode</label>
            <select id="paymentoption" name="paymentoption" onchange="paymentmode()">
              <option value="COD">COD</option>
              <option value="ONLINE PAYMENT">ONLINE PAYMENT</option>
            </select>

            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Enter Name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="Enter Email ID">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Enter Address">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="Enter City">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="Enter State">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="Enter ZIP">
              </div>
            </div>
          </div>

          <div class="col-50" id="op" style="display:none;">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Enter Card Name">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="Enter Card Number">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="Enter Exp Month">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="Enter Exp Year">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" onkeypress="return onlyNumberKey(event)">
              </div>
            </div>
          </div>

        </div>

        <input id="d" type="submit" name="d" value="PLACE ORDER" class="btn" onclick="c()">
      </form>
    </div>
  </div>
  </div>

</body>

<script>
  function onlyNumberKey(evt)
  {
    var asciicode = (evt.which)?evt.which : evt.keyCode
    if(asciicode > 31 && (asciicode < 48 || asciicode > 57))
      return false;
    return true;
  }
  function paymentmode()
  {
    var sel = document.getElementById('paymentoption');
    var opt = sel.options[sel.selectedIndex];
    if (opt.text == "ONLINE PAYMENT")
    {
      $('#d').val('PAY NOW');
      $('#op').css('display','block');
    }
    if (opt.text == "COD")
    {
      $('#d').val('PLACE ORDER');
      $('#op').css('display','none');
    }
  }
</script>
</html>
