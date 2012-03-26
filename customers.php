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

  // delete
  if(isset($_POST['delete'])) {
    $db->deleteCustomer($_POST['cust_id']);
  }

  // update
  if( isset($_POST['last_name']) and !empty($_POST['last_name']) and
      isset($_POST['first_name']) and !empty($_POST['first_name'])) {

    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];

    if(isset($_POST['cust_id'])) {
      $cust_id = $_POST['cust_id'];

      $db->updateCustomer($cust_id, $last_name, $first_name);
    } else {
      $db->insertCustomer($last_name, $first_name);
    }
  }

  // get all customers for drop down box
  $db->getCustomers();
  $customers = $db->customers;

  echo "<center><form action=customers.php method=get>";
  echo "Customers: <select name='customers'>";

  while($row = mysql_fetch_array($customers)) {
    $customer = $row['last_name'] . ", " . $row['first_name'];
    $customer_id = $row['id'];

    echo "<option value=$customer_id>$customer</option>";
  }

  echo "</select>";
  echo "<input type=submit value=Edit>";
  echo "</form></center>";

  if(!isset($_GET['customers'])) {
    echo "<center><h2>Add a customer</h2>
    <form action=customers.php method=post>
      <table>
        <tr>
          <td>Last Name</td>
          <td><input type=text name=last_name></td>
        </tr>
        <tr>
          <td>First Name</td>
          <td><input type=text name=first_name></td>
        </tr>
        <tr>
          <td colspan=2><input type=submit value=Add></td>
        </tr>
      </table>
      </form></center>";
  } else {
    $db->getCustomer($_GET['customers']);

    $customer = mysql_fetch_array($db->customer);
    $last_name = $customer['last_name'];
    $first_name = $customer['first_name'];
    $customer_id = $_GET['customers'];

    echo "<center><h2>Update</h2>
    <form action=customers.php method=post>
      <table>
        <tr>
          <td>Last Name</td>
          <td><input type=text name=last_name value=$last_name></td>
        </tr>
        <tr>
          <td>First Name</td>
          <td><input type=text name=first_name value=$first_name></td>
        </tr>
        <tr>
          <td><input type=submit value=Update></td>
          <td><input type=hidden value=$customer_id name=cust_id></td>
        </tr>
      </table>
      </form></center>";
  }
?>
  </div>
</div>
