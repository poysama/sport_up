<?php 
  include('header.php');
  include('db.php');

  if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php?last_page=customers");
  }
?>

<div id="container">
  <div id="content">
  <h2>Customers</h2>

<?php
  $db = new DB();
  $db->getCustomers();
  $customers = $db->customers;

  echo "<form action=customers.php method=post>";
  echo "Customers: <select name='customers'>";

  while($row = mysql_fetch_array($customers)) {
    $customer = $row['last_name'] . ", " . $row['first_name'];
    $customer_id = $row['id'];

    echo "<option value=$customer_id>$customer</option>";
  }

  echo "</select><br>";
  echo "<input type=submit value=Edit>";
  echo "<input type=submit value=Delete>";
  echo "</form>"
?>
  <h2>Add a customer</h2>
  <form action="customers.php" method="post">
    <table>
      <tr>
        <td>Last Name</td>
        <td><input type="text" name="last_name"></td>
      </tr>
      <tr>
        <td>First Name</td>
        <td><input type="text" name="last_name"></td>
      </tr>
      <tr>
        <td colspan=2><input type=submit value="Add"></td>
      </tr>
    </table>
  </form>
  </div>
</div>
