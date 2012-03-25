<?php 
  include('header.php');

  if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php?last_page=customers");
  }
?>

<div id="container">
  <div id="content">
  <h2>Customers</h2>

<?php
  $db = new DB();
  $customers = $db->customers;

  echo "<select name='customers'>";

  while($row = mysql_fetch_array($customers)) {
    $customer = $row['last_name'] . ", " . $row['first_name'];

    echo "<option>$customer</option>";
  }

  echo "</select>";
?>
  </div>
</div>
