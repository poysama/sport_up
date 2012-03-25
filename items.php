<?php 
  include('header.php');
  include('db.php');

  if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php?last_page=items");
  }
?>

<div id="container">
  <div id="content">
  <h2>Customers</h2>

<?php
  $db = new DB();
  $db->getItems();
  $items = $db->items;

  echo "<form action=items.php method=post>";
  echo "Customers: <select name='items'>";

  while($row = mysql_fetch_array($items)) {
    $item = $row['name'];
    $item_id = $row['id'];

    echo "<option value=$item_id>$item</option>";
  }

  echo "</select><br>";
  echo "<input type=submit value=Edit>";
  echo "<input type=submit value=Delete>";
  echo "</form>"
?>
  <h2>Add an item</h2>
  <form action="items.php" method="post">
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
