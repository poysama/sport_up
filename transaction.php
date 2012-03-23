<?php
  include('header.php');
  include('db.php');

  if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php?last_page=customers");
  }
?>

<!-- content -->
<div id="container">
  <div id="content">
    <h2>Transactions</h2>

    Date:
    <form action=transaction.php method=post>
      <?php
        include('calendar/calendar.php');
      ?>
      <p>&nbsp;</p>

<?php
  $db = new DB();
  $db->getItems();
  $db->getTransactions();
  $db->getCustomers();

  if(isset($_POST['filter'])) {
    if(isset($_POST['customer_check']) and
        isset($_POST['customers']) and
        !isset($_POST['date_from_check']) and
        !isset($_POST['date_to_check'])) { // if ONLY customer is selected and customer is not empty

      $customer_id = $_POST['customers'];

      $db->filterTransactionsByCustomer($customer_id);
    } elseif(isset($_POST['date_from_check']) and
              !isset($_POST['date_to_check']) and
              !isset($_POST['customer_check'])) {  // if ONLY one date is selected

      $date = $_REQUEST['date1'];
      $db->filterTransactionsByDate($date);
    } elseif(isset($_POST['date_from_check']) and
              isset($_POST['date_to_check']) and
              !isset($_POST['customer_check'])) {  // if ONLY a date range is selected
      
      $date_from = $_REQUEST['date1'];
      $date_to = $_REQUEST['date2'];

      $db->filterTransactionsByDateRange($date_from, $date_to);
    }
  } else {
    $db->transactions = '';
  }

  echo "Customer:<input type=checkbox name=customer_check>
          <select name=customers>
            <option>Select customer</option>";
              while($row = mysql_fetch_array($db->customers)) {
                $customer = $row['last_name'] . ", " . $row['first_name'];
                $id = $row['id'];

                echo "<option value=$id>$customer</option>";
               }

  echo "</select>";
  echo "<input type=hidden name=filter><br>";
  echo "<input type=submit value=Filter>";
  echo "</form>";

  if(isset($_POST['filter'])) {
    echo "<hr><center><table border=1>
        <tr>
          <th>Customer</th>
          <th>Item</th>
          <th>Discount</th>
          <th>Item Price</th>
          <th>Total Price</th>
          <th>Quantity</th>
          <th>Date Purchased</th>
          <td>Card number</td>
        </tr>";

    while($row = mysql_fetch_array($db->transactions)) {
      $id = $row['id'];

      $customer_id = $row['customer_id'];
      
      if(!$customer_id == NULL) {
        $db->getCustomer($customer_id);
        $customer = mysql_fetch_array($db->customer);
        $customer_name = $customer['last_name'] . ", " . $customer['first_name'];
      } else {
        $customer_name = "Deleted Customer";
      }

      $item_id = $row['item_id'];

      if(!$item_id == NULL) {
        $db->getItem($item_id);
        $item = mysql_fetch_array($db->item);
        $item_name = $item['name'];
      } else {
        $item_name = "Deleted Item";
      }

      $discount = $row['discount'];
      $item_price = $row['item_price'];
      $total_price = $row['total_price'];
      $quantity = $row['quantity'];
      $date_purchased = $row['date_purchased'];
      $payment_type = $row['payment_type'];

      echo "<tr>
            <td>$customer_name</td>
            <td>$item_name</td>
            <td>$discount</td>
            <td>$item_price</td>
            <td>$total_price</td>
            <td>$quantity</td>
            <td>$date_purchased</td>
            <td>$payment_type</td>
            </tr>";
    }
    echo "</table></center>";
  }
?>
  </div>
</div>

<?php include('footer.php') ?>
