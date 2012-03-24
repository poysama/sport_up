<?php
  include('header.php');
  include('db.php');
?>

<!-- content -->
<div id="container">
  <div id="content">
  <h2>Receipt</h2>
<?php
 if(isset($_POST['customer'])) {
  $db = new DB();
  $db->getCustomer($_POST['customer']);

  $row = mysql_fetch_row($db->customer);

  $invoice_num = md5(uniqid(rand(), true));

  echo "Transaction #: <b>$invoice_num</b>";

  $customer_name = $row[1] . ', ' . $row[2];
  echo "<p>Customer name: <b>$customer_name</b></p>";

  if(isset($_POST['payment'])) {
   echo "<p>Payment type: <b>" . $_POST['payment'] . "</b></p>";
  }

  echo "<table border=1>
     <th>Name</th>
     <th>Price(Per Item)</th>
     <th>Quantity</th>
     <th>Total</th>
     ";

  foreach($_SESSION['cart'] as $item_id => $values) {
   $item_name = $values['item_name'];
   $price = $values['price'];
   $qty = $values['quantity'];
   $total = $price * $qty;

   $insert_values = array( 'id' => $invoice_num,
               'customer_id' => $_POST['customer'],
               'item_id' => $item_id,
               'discount' => $_POST['discount'],
               'item_price' => $price,
               'total_price' => $total,
               'date_purchased' => date("Y-m-d H:i:s"),
               'payment_type' => $_POST['payment']
              );

   $db->insertTransaction($insert_values);

   echo "<tr>
       <td>$item_name</td>
       <td>$price</td>
       <td>$qty</td>
       <td>$total</td>
      </tr>";
  }
  echo "</table>";

  if(isset($_POST['cart_total'])) {
   echo "<p>Cart Total: <b>" . $_POST['cart_total'] . "</b></p>";
  }

  if(isset($_POST['discount'])) {
   $discounted_total = $_POST['cart_total'] - ($_POST['cart_total'] * $_POST['discount']/100);
   echo "<p>Discounted Total: <b>$discounted_total</b></p>";
  }

    session_destroy();
 }
?>
  </div>
</div>

<?php include('footer.php') ?>
