<?php include('header.php') ?>
<?php include('db.php') ?>

<!-- content -->
<div id="container">
  <div id="content">
  <h2>Items for sale</h2>

    <table>

<?php
  $db = new DB();
  $db->getItems();

  while($row = mysql_fetch_array($db->items)) {
    $image = "images/" . $row['image_url'];
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];

    echo "<form method='post' action='cart.php'>";
    echo "<tr>";
    echo "<td colspan=2><input type=hidden name=item_name value='$name'><span class=item_title>" . $row['name'] . "</span></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><img src='$image' class='thumbnail'></td>";
    echo "<input type='hidden' name='id' value=$id>";
    echo "<input type='hidden' name='price' value=$price>";
    echo "<td>
      Quantity:
      <select name=quantity>
      <option value=1>1</option>
      <option value=2>2</option>
      <option value=3>3</option>
      <option value=4>4</option>
      <option value=5>5</option>
      </select>
      Price:<b style='font-size: 10px;'>Php $price</b>
      <input type='submit' value='Add to cart'>
          </td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td colspan=2><b>Description:</b> " . $row['description'] . "</td>";
    echo "</tr>";
    echo "<td colspan=2><hr></td>";
    echo "</form>";
  }
?>
    </table>
  </div>
</div>

<?php include('footer.php') ?>
