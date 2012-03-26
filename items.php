<?php
  include('header.php');
  include('db.php');

  if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php?last_page=items");
  }
?>

<div id="container">
  <div id="content">
  <h2>Items</h2>

<?php
  $db = new DB();

  // delete
  if(isset($_POST['delete'])) {
    $db->deleteitem($_POST['cust_id']);
  }

  // update
  if( isset($_POST['item_name']) and
      isset($_POST['description']) and
      isset($_POST['quantity']) and
      isset($_POST['price']) and
      isset($_POST['image_url']) ) {

    if(isset($_POST['cust_id'])) {
      $item_name = $_POST['item_name'];
      $description = $_POST['description'];

      $db->updateitem($cust_id, $last_name, $first_name);
    }
  }

  // get all items for drop down box
  $db->getitems();
  $items = $db->items;

  echo "<center><form action=items.php method=get>";
  echo "Items: <select name='items'>";

  while($row = mysql_fetch_array($items)) {
    $item = $row['name'];
    $item_id = $row['id'];

    echo "<option value=$item_id>$item</option>";
  }

  echo "</select>";
  echo "<input type=submit value=Edit>";
  echo "</form></center>";

  if(!isset($_GET['items'])) {
    echo "<center><h2>Add a item</h2>
    <form action=items.php method=post>
      <table>
        <tr>
          <td>Name</td>
          <td><input type=text name=item_name></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><textarea cols=40 rows=10 name=description></textarea></td>
        </tr>
        <tr>
          <td>Quantity(Stock)</td>
          <td><input type=text size=1 name=quantity></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><input type=text size=5 name=price></td>
        </tr>
        <tr>
          <td>Image Url</td>
          <td><input type=text name=image_url></td>
        </tr>
        <tr>
          <td colspan=2><input type=submit value=Add></td>
        </tr>
      </table>
      </form></center>";
  } else {
    $db->getitem($_GET['items']);

    $item = mysql_fetch_array($db->item);
    $name = $item['name'];
    $description = $item['description'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $image_url = $item['image_url'];

    echo "<center><h2>Add a item</h2>
    <form action=items.php method=post>
      <table>
        <tr>
          <td>Name</td>
          <td><input type=text name=item_name value=$name></td>
        </tr>
        <tr>
          <td>Description</td>
          <td><textarea cols=40 rows=10 name=description>$description</textarea></td>
        </tr>
        <tr>
          <td>Quantity(Stock)</td>
          <td><input type=text size=1 name=quantity value=$quantity></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><input type=text size=5 name=price value=$price></td>
        </tr>
        <tr>
          <td>Image Url</td>
          <td><input type=text name=image_url value=$image_url></td>
        </tr>
        <tr>
          <td colspan=2><input type=submit value=Update></td>
        </tr>
      </table>
      </form></center>";
  }
?>
  </div>
</div>
