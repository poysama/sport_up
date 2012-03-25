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

    <table>

<?php
  $db = new DB();
	$db->getItems();
	$db->getTransactions();

	echo "<table border=1 cellpadding=10>
			<tr>
				<th>Transaction ID</th>
				<th>Customer</th>
				<th>Item</th>
				<th>Discount</th>
				<th>Item Price</th>
				<th>Total Price</th>
				<th>Date Purchased</th>
				<td>Payment</td>
			</tr>";

	while($row = mysql_fetch_array($db->transactions)) {
		$id = $row['id'];

		$customer_id = $row['customer_id'];
    $db->getCustomer($customer_id);
    $customer = mysql_fetch_array($db->customer);
    $customer_name = $customer['last_name'] . ", " . $customer['first_name'];

		$item_id = $row['item_id'];
    $db->getItem($item_id);
    $item = mysql_fetch_array($db->item);
    $item_name = $item['name'];

		$discount = $row['discount'];
		$item_price = $row['item_price'];
		$total_price = $row['total_price'];
		$date_purchased = $row['date_purchased'];
		$payment_type = $row['payment_type'];

		echo "<tr>
					<td>$id</td>
					<td>$customer_name</td>
					<td>$item_name</td>
					<td>$discount</td>
					<td>$item_price</td>
					<td>$total_price</td>
					<td>$date_purchased</td>
					<td>$payment_type</td>
					</tr>";
	}
	echo "</table>";
?>
  </div>
</div>

<?php include('footer.php') ?>
