<?php
  include('header.php');
  include('db.php');
?>

<!-- content -->
<div id="container">
  <div id="content">
    <form action=receipt.php method=post>
<?php
  echo "<h2>Confirm your order</h2>";

  $db = new DB();
  $db->getCustomers();
  $customers = array();

  while($row = mysql_fetch_array($db->customers)) {
    $customer = array();

    $customer['id'] = $row['id'];
    $customer['last_name'] = $row['last_name'];
    $customer['first_name'] = $row['first_name'];

    array_push($customers, $customer);

  }

  echo "Customer: <select name=customer>";

  foreach($customers as $c => $d) {
    $id = $d['id'];

    echo "<option value=$id>" . $d['last_name'] . ", " . $d['first_name'] . "</option>";
  }

  echo "</select>";

  echo "<p>Payment Type(Credit card only)<br>
        <img src=images/credit.gif><br>
        Card Number: <input type=text name=payment><br>";

  if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  if(!empty($_SESSION['cart'])) {
    $db = new DB();
    $cart_total = 0;
    echo "<h2>Items</h2>";

    foreach($_SESSION['cart'] as $id => $value) {
      $db->getItem($id);

      echo "<table>";
      while($row = mysql_fetch_array($db->item)) {
        $image = "images/" . $row['image_url'];
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'] * $value['quantity'];
        $cart_total = $cart_total + $price;

        echo "<tr>";
        echo "<td><span class=item_title>" . $row['name'] . "</span></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><img src='$image' class='thumbnail'></td>";
        echo "<input type='hidden' name='id' value=$id>";
        echo "</tr>";

        echo "<tr>";
        echo "<td><b>Quantity:" . $value['quantity'] . "</b></td>";
        echo "</tr>";
        echo "<td><hr></td>";
      }
      echo "</table>";
    }

    echo "<p>Cart Total: Php $cart_total </p>";
    echo "<input type=hidden name=cart_total value=$cart_total>";
    echo "<input type=submit value=Checkout>";
  }
?>
     </form>
  </div>
</div>

<?php include('footer.php') ?>
