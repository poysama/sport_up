<?php include('header.php') ?>
<?php include('db.php') ?>

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
				<th>Customer ID</th>
				<th>Item ID</th>
				<th>Discount</th>
				<th>Item Price</th>
				<th>Total Price</th>
				<th>Date Purchased</th>
				<td>Payment</td>
			</tr>";
			
	while($row = mysql_fetch_array($db->transactions)) {
		$id = $row['id'];
		$customer_id = $row['customer_id'];
		$item_id = $row['item_id'];
		$discount = $row['discount'];
		$item_price = $row['item_price'];
		$total_price = $row['total_price'];
		$date_purchased = $row['date_purchased'];
		$payment_type = $row['payment_type'];
		
		echo "<tr>
					<td>$id</td>
					<td>$customer_id</td>
					<td>$item_id</td>
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
